<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\EmployeeRole;
use DateTime;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Http\Response;
use App\Models\DrivingLicense;
use App\Models\Contact;
use App\Models\ContactType;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\QueryException;

class EmployeeController extends Controller
{
    use AuthorizesRequests;
    use SoftDeletes;

    public function index(Request $request)
    {
        try {
            $this->authorize('viewAny', Employee::class);

            $query = Employee::query();

            if ($request->has('clear_filters')) {
                $request->session()->forget(['search', 'employee_role_id']);
            }

            if ($request->filled('name')) {
                $query->where('name', 'ilike', '%' . $request->input('name') . '%');
            }

            if ($request->filled('role')) {
                $query->whereHas('role', function ($query) use ($request) {
                    $query->where('name', $request->input('role'));
                });
            }

            $employees = $query->orderBy('id', 'asc')->paginate(10);

            return view('pages.Employees.list', [
                'employees' => $employees,
                'roles' => EmployeeRole::all(),
            ]);
        } catch (AuthorizationException $e) {
            return redirect()->route('error.403');
        }
    }

    public function create()
    {
        try {
            $this->authorize('create', Employee::class);

            $roles = EmployeeRole::all();
            $drivingLicenses = DrivingLicense::all();
            $contactTypes = ContactType::all();
            $isAdmin = Auth::user()->isAdmin();

            return view('pages.Employees.create', [
                'roles' => $roles,
                'drivingLicenses' => $drivingLicenses,
                'contactTypes' => $contactTypes,
                'isAdmin' => $isAdmin
            ]);
        } catch (AuthorizationException $e) {
            return redirect()->route('error.403');
        }
    }

    public function store(StoreEmployeeRequest $request)
    {
        $this->authorize('create', Employee::class);

        if (Auth::user()->isManager() && $request->employee_role_id == 1) {
            return redirect()->back()->with('error', 'You are not authorized to create administrators.');
        }

        $employee = Employee::create([
            'name' => $request->name,
            'employee_number' => $request->employee_number,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'CC' => $request->CC,
            'NIF' => $request->NIF,
            'address' => $request->address,
            'employee_role_id' => $request->employee_role_id,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
        ]);

        if ($request->has('driving_licenses')) {
            $employee->drivingLicenses()->sync($request->driving_licenses);
        }

        if ($request->has('contacts')) {
            foreach ($request->contacts as $contact) {
                if (isset($contact['value']) && isset($contact['type'])) {
                    $employee->contacts()->create([
                        'contact_value' => $contact['value'],
                        'contact_type_id' => $contact['type']
                    ]);
                }
            }
        }

        return redirect()->route('employees.index')->with('success', 'Funcionario ' . $employee->name . ' adicionado com sucesso.');
    }

    public function show(Request $request, $id)
    {
        try {
            if (!is_numeric($id) || intval($id) <= 0) {
                return redirect()->route('error.403')->with('error', 'Invalid employee ID.');
            }

            $employee = Employee::findOrFail($id);

            $isAdminOrManager = Auth::user()->isMaster();

            if (!$isAdminOrManager) {
                $employeeId = Auth::id();
                if ($employee->id != $employeeId) {
                    return redirect()->route('employees.index')->with('error', 'Access denied.');
                }
            }

            $employee->load('drivingLicenses', 'role', 'contacts.contactType');
            return view('pages.Employees.show', [
                'employee' => $employee,
                'contactTypes' => ContactType::all(),
            ]);
        } catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }

    public function edit(Request $request, $id)
    {
        try {
            if (!is_numeric($id) || intval($id) <= 0) {
                return redirect()->route('error.403')->with('error', 'Invalid employee ID.');
            }

            $employee = Employee::findOrFail($id);
            if (Auth::user()->isManager() && $employee->employee_role_id == 1) {
                return redirect()->route('error.403');
            }

            $this->authorize('update', $employee);

            $employee->load('drivingLicenses', 'role', 'contacts.contactType');
            $roles = EmployeeRole::all();
            $drivingLicenses = DrivingLicense::all();
            $contactTypes = ContactType::all();
            $isAdmin = Auth::user()->isAdmin();

            return view('pages.Employees.edit', [
                'employee' => $employee,
                'roles' => $roles,
                'drivingLicenses' => $drivingLicenses,
                'contactTypes' => $contactTypes,
                'isAdmin' => $isAdmin,
            ]);
        } catch (AuthorizationException $e) {
            return redirect()->route('error.403')->with('error', 'Unauthorized access.');
        } catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }


    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $this->authorize('update', $employee);

        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        // Atualiza os campos básicos do funcionário
        $employee->update($data);

        // Atualiza ou cria os novos contatos enviados
        if ($request->has('contacts')) {
            $currentContactIds = $employee->contacts()->pluck('id')->toArray();
            $newContactIds = [];

            foreach ($request->contacts as $contact) {
                if (isset($contact['value']) && isset($contact['type'])) {
                    $existingContact = $employee->contacts()->where('contact_type_id', $contact['type'])->first();
                    if ($existingContact) {
                        // Atualiza o valor do contato existente
                        $existingContact->update(['contact_value' => $contact['value']]);
                        $newContactIds[] = $existingContact->id;
                    } else {
                        // Cria um novo contato
                        $newContact = $employee->contacts()->create([
                            'contact_value' => $contact['value'],
                            'contact_type_id' => $contact['type']
                        ]);
                        $newContactIds[] = $newContact->id;
                    }
                }
            }

            // Remove os contatos que não foram enviados no formulário
            $contactsToDelete = array_diff($currentContactIds, $newContactIds);
            if (!empty($contactsToDelete)) {
                $employee->contacts()->whereIn('id', $contactsToDelete)->delete();
            }
        }

        // Atualiza as licenças de condução, se houver
        if ($request->has('driving_licenses')) {
            $employee->drivingLicenses()->sync($request->driving_licenses);
        } else {
            $employee->drivingLicenses()->detach();
        }

        return redirect()->route('employees.index') ->with('error', 'Funcionário ' . $employee->name . ' editado com sucesso.');
    }


    public function destroy(Employee $employee)
    {

        if ($employee->id == Auth::id()) {
            return redirect()->route('error.403');
        }
        if (Auth::user()->isManager() && $employee->employee_role_id == 1) {
            return redirect()->route('error.403');
        }
        try {
            $this->authorize('delete', $employee);
            $employee->delete();
            return redirect()->route('employees.index') ->with('error', 'Funcionário ' . $employee->name . ' excluido com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para excluir esse funcionário.');
        }
    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete', Employee::class);

        $ids = $request->input('selected_ids', []);
        $authUserId = Auth::id();
        $authUserIsManager = Auth::user()->isManager();

        // Filter out the authenticated user's ID to prevent self-deletion
        $filteredIds = array_filter($ids, function($id) use ($authUserId, $authUserIsManager) {
            $employee = Employee::find($id);
            if (!$employee) {
                return false;
            }

            if ($employee->id == $authUserId) {
                return false;
            }

            if ($authUserIsManager && $employee->employee_role_id == 1) {
                return false;
            }

            return true;
        });

        try {
            Employee::whereIn('id', $filteredIds)->delete();
            return redirect()->route('employees.index')->with('success', 'Funcionário exluido com sucesso.');
        } catch (\Exception $e) {
            return redirect()->route('employees.index')->with('error', 'Erro ao excluir funcionários.');
        }
    }

    public function exportCsv($id)
    {
        $employee = Employee::findOrFail($id);
        $data = [
            [
                'ID' => $employee->id,
                'Nome' => $employee->name,
                'Numero de funcionario' => $employee->employee_number,
                'Email' => $employee->email,
                'Cargo' => $employee->role->name,
                'Data de nascimento' => $employee->birth_date,
                'Endereço' => $employee->address,
                'NIF' => $employee->NIF,
                'CC' => $employee->CC,
            ]
        ];

        $fileName = 'employee_' . $employee->name . '.csv';

        $file = fopen('php://temp', 'w+');
        fputcsv($file, array_keys($data[0]));
        foreach ($data as $row) {
            fputcsv($file, $row);
        }
        rewind($file);

        return response()->stream(
            function () use ($file) {
                fpassthru($file);
            },
            200,
            [
                'Content-Type' => 'text/csv',
                'Content-Disposition' => 'attachment; filename="' . $fileName . '"',
            ]
        );
    }

    public function import(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');
        $path = $file->getRealPath();
        $data = array_map('str_getcsv', file($path));
        $header = array_shift($data);

        $defaultEmployeeRoleId = 3;
        $defaultGender = 'Não especificado';
        $defaultBirthDate = '2000-01-01';
        $defaultCC = '000000000';
        $defaultNIF = '000000000';
        $defaultAddress = 'Não tem endereço';
        $defaultEmailPrefix = 'employee';
        $defaultEmailDomain = '@example.com';
        $defaultPhone = '000000000';
        $defaultPassword = 'defaultpassword';
        $defaultRole = 'Funcionário';

        $addedCount = 0;
        $duplicateCount = 0;

        foreach ($data as $index => $row) {
            $row = array_combine($header, $row);

            if (!isset($row['numFuncionario']) || empty($row['nome'])) {
                continue;
            }

            $employeeNumber = $row['numFuncionario'];
            $name = $row['nome'];


            if (!preg_match('/^[a-zA-Z\s]+$/', $name)) {
                continue;
            }


            $existingEmployee = Employee::where('employee_number', $employeeNumber)->first();
            if ($existingEmployee) {
                $duplicateCount++;
                continue;
            }

            $gender = $defaultGender;
            $birthDate = $defaultBirthDate;

            $CC = $row['CC'] ?? $defaultCC;
            $ccSuffix = 1;
            while (Employee::where('CC', $CC)->exists()) {
                $CC = $defaultCC . str_pad($ccSuffix++, 1, '0', STR_PAD_LEFT);
            }

            $NIF = $row['NIF'] ?? $defaultNIF;
            $nifSuffix = 1;
            while (Employee::where('NIF', $NIF)->exists()) {
                $NIF = $defaultNIF . str_pad($nifSuffix++, 1, '0', STR_PAD_LEFT);
            }

            $address = $row['address'] ?? $defaultAddress;

            $email = $row['email'] ?? ($defaultEmailPrefix . $index . $defaultEmailDomain);
            $emailSuffix = 1;
            while (Employee::where('email', $email)->exists()) {
                $email = $defaultEmailPrefix . $index . str_pad($emailSuffix++, 1, '0', STR_PAD_LEFT) . $defaultEmailDomain;
            }

            $phone = $row['phone'] ?? $defaultPhone;
            $phoneSuffix = 1;
            while (Employee::where('phone', $phone)->exists()) {
                $phone = $defaultPhone . str_pad($phoneSuffix++, 1, '0', STR_PAD_LEFT);
            }

            $role = $defaultRole;


            Employee::create([
                'name' => $name,
                'employee_number' => $employeeNumber,
                'gender' => $gender,
                'birth_date' => $birthDate,
                'CC' => $CC,
                'NIF' => $NIF,
                'address' => $address,
                'employee_role_id' => $defaultEmployeeRoleId,
                'email' => $email,
                'phone' => $phone,
                'password' => Hash::make($defaultPassword),
                'role' => $role,
            ]);

            $addedCount++;
        }

        $message = "Importação concluída. $addedCount funcionários adicionados.";
        if ($duplicateCount > 0) {
            $message .= " $duplicateCount funcionários duplicados não foram adicionados.";
        }

        session()->flash('message', $message);
        return redirect()->route('employees.index');
    }
}
