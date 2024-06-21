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

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
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
        // Atualiza ou cria os novos contatos enviados
        if ($request->has('contacts')) {

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
            $currentContactTypes = $employee->contacts()->pluck('contact_type_id')->toArray();
            $requestContactTypes = collect($request->contacts)->pluck('type')->toArray();
            $contactsToDelete = array_diff($currentContactTypes, $requestContactTypes);

            if (!empty($contactsToDelete)) {
                $employee->contacts()->whereIn('contact_type_id', $contactsToDelete)->delete();
            }
        }

        // Atualiza as licenças de condução, se houver
        if ($request->has('driving_licenses')) {
            $employee->drivingLicenses()->sync($request->driving_licenses);
        } else {
            $employee->drivingLicenses()->detach();
        }
        // Remove os contatos que não foram enviados no formulário
        $currentContactTypes = $employee->contacts()->pluck('contact_type_id')->toArray();
        $requestContactTypes = collect($request->contacts)->pluck('type')->toArray();
        $contactsToDelete = array_diff($currentContactTypes, $requestContactTypes);

        if (!empty($contactsToDelete)) {
            $employee->contacts()->whereIn('contact_type_id', $contactsToDelete)->delete();
        }

        // Atualiza as licenças de condução, se houver

        if ($request->has('driving_licenses')) {
            $employee->drivingLicenses()->sync($request->driving_licenses);
        } else {
            $employee->drivingLicenses()->detach();
        }

        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }

    public function destroy(Employee $employee)
    {

        if ($employee->id == Auth::id()) {
            return redirect()->route('error.403');
        }
        if (Auth::user()->isManager() && $employee->employee_role_id == 1) {
            return redirect()->route('error.403');
        }
        try{
            $this->authorize('delete', $employee);
            $employee->delete();
            return redirect()->route('employees.index');
        }catch (\Exception $e){
            return redirect()->route('error.403')->with('error', 'Você não tem permissão para excluir esse funcionário.');
        }

    }

    public function deleteSelected(Request $request)
    {
        $this->authorize('delete', Employee::class);
        $ids = $request->input('selected_ids', []);
        Employee::whereIn('id', $ids)->delete();
        return redirect()->route('employees.index')->with('success', 'Funcionários excluídos com sucesso.');
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
            'file' => 'required|mimes:csv,txt|max:2048',
        ], [
            'file.required' => 'O campo arquivo é obrigatório.',
            'file.mimes' => 'Arquivo inválido, necessário enviar arquivo CSV.',
            'file.max' => 'Tamanho do arquivo excede :max Mb'
        ]);

        $employeeImports = [
            'name',
            'CC',
            'NIF',
            'birth_date',
            'employee_role_id',
            'gender',
            'password'
        ];

        $roleMapping = [
            'Administrador' => 1,
            'Gerente' => 2,
            'Funcionario' => 3,
        ];

        $nifAlterar = 0;
        $cartaoCidadaoAlterar = 0;

        $dataFile = array_map('str_getcsv', file($request->file('file')));

        $arryValues = [];

        $numRegisto = 0;

        foreach ($dataFile as $keyData => $row) {
            $values = array_map('trim', explode(';', $row[0]));

            if (count($values) != count($employeeImports)) {
                throw new Exception("Número de valores na linha " . ($keyData + 1) . " não corresponde ao número de colunas esperadas.");
            }

            $isDuplicate = false;

            foreach ($employeeImports as $key => $employeeImport) {
                $arryValues[$keyData][$employeeImport] = $values[$key];
                if ($employeeImport == 'NIF') {
                    if (Employee::where('NIF', $values[$key])->exists()) {
                        $nifAlterar++;
                        $isDuplicate = true;
                    }
                }

                if ($employeeImport == "CC") {
                    if (Employee::where('CC', $values[$key])->exists()) {
                        $cartaoCidadaoAlterar++;
                        $isDuplicate = true;
                    }
                }

                if ($isDuplicate) {
                    continue;
                }

                if ($employeeImport === 'birth_date') {
                    $date = DateTime::createFromFormat('m/d/Y', $values[$key]);
                    if ($date) {
                        $arryValues[$keyData][$employeeImport] = $date->format('Y-m-d');
                    } else {
                        throw new Exception("Data inválida na linha " . ($keyData + 1) . ": " . $values[$key]);
                    }
                } elseif ($employeeImport === 'employee_role_id') {
                    if (array_key_exists($values[$key], $roleMapping)) {
                        $arryValues[$keyData][$employeeImport] = $roleMapping[$values[$key]];
                    } else {
                        throw new Exception("Cargo inválido na linha " . ($keyData + 1) . ": " . $values[$key]);
                    }
                } else {
                    $arryValues[$keyData][$employeeImport] = $values[$key];
                }

                if ($employeeImport == "password") {
                    $arryValues[$keyData][$employeeImport] = Hash::make(Str::random(7));
                }
            }
            $numRegisto++;
        }

        if ($nifAlterar > 0 || $cartaoCidadaoAlterar > 0) {
            return back()->with('error', 'Dados não importados. Alguns registros já estão cadastrados.<br>Quantidade de NIF duplicados: ' . $nifAlterar . '<br>Quantidade de Cartões de Cidadão duplicados: ' . $cartaoCidadaoAlterar);
        }

        try {
            Employee::insert($arryValues);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao inserir dados: ' . $e->getMessage());
        }

        return back()->with('sucesso', 'Dados importados com sucesso. <br>Quantidade: ' . $numRegisto);
    }

    public function importCsv(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:csv,txt',
        ]);

        $file = $request->file('file');

        $path = $file->getRealPath();

        $data = array_map('str_getcsv', file($path));

        foreach ($data as $row) {
            Employee::create([
                'name' => $row[0],
                'employee_number' => $row[1],
                'gender' => $row[2],
                'birth_date' => $row[3],
                'CC' => $row[4],
                'NIF' => $row[5],
                'address' => $row[6],
                'employee_role_id' => $row[7],
                'email' => $row[8],
                'phone' => $row[9],
                'password' => Hash::make($row[10]),
            ]);
        }

        return redirect()->route('employees.index');
    }
}
