<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\EmployeeRole;
use DateTime;
use Exception;
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

class EmployeeController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $this -> authorize('viewAny', Employee::class);

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
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $this -> authorize('create', Employee::class);

        $roles = EmployeeRole::all();
        $drivingLicenses = DrivingLicense::all();
        $contactTypes = ContactType::all();
        return view('pages.Employees.create', [
            'roles' => $roles,
            'drivingLicenses' => $drivingLicenses,
            'contactTypes' => $contactTypes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEmployeeRequest $request)
    {
        $request->validate([
            'name' => 'required|string|regex:/^[a-zA-Z\s]+$/|max:255',
            'employee_number' => 'required|nullable|string|max:255|unique:employees,employee_number',
            'gender' => 'required|string',
            'birth_date' => ['required', 'date', function ($attribute, $value, $fail) {
                if (!\DateTime::createFromFormat('Y-m-d', $value)) {
                    $fail('A data de nascimento não é uma data válida.');
                }
            }],            'CC' => 'required|string|digits:9|unique:employees,CC',
            'NIF' => 'required|string|digits:9|unique:employees,NIF',
            'address' => 'nullable|string|max:255',
            'employee_role_id' => 'required|exists:employee_roles,id',
            'email' => 'nullable|email|max:255|unique:employees,email',
            'phone' => 'nullable|string|max:255|unique:employees,phone',
            'password' => 'required|string|min:8|confirmed',
            'driving_licenses' => 'nullable|array',
            'driving_licenses.*' => 'exists:driving_licenses,id',
            'contacts' => 'nullable|array',
            'contacts.*.value' => 'nullable|string|max:255',
            'contacts.*.type' => 'nullable|exists:contact_types,id',
        ]);

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

        foreach ($request->contacts as $contact) {
            if (isset($contact['value']) && isset($contact['type'])) {
                $employee->contacts()->create([
                    'contact_value' => $contact['value'],
                    'contact_type_id' => $contact['type']
                ]);
            }
        }



        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $this -> authorize('view', $employee);

        $employee = Employee::with('drivingLicenses', 'role')->findOrFail($employee->id);
        return view('pages.Employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {

        $this -> authorize('update', $employee);

        $employee = Employee::with('drivingLicenses', 'role')->findOrFail($employee->id);
        $roles = EmployeeRole::all();
        $drivingLicenses = DrivingLicense::all();
        $contactTypes = ContactType::all();
        return view('pages.Employees.edit',
        [
            'employee' => $employee,
            'roles' => $roles,
            'drivingLicenses' => $drivingLicenses,
            'contactTypes' => $contactTypes

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->all();

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        } else {
            unset($data['password']);
        }

        $employee->update($data);

        if ($request->has('driving_licenses')) {
            $employee->drivingLicenses()->sync($request->driving_licenses);
        } else {
            $employee->drivingLicenses()->detach();
        }

        $employee->contacts()->delete(); // Remove os contatos antigos

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
        return redirect()->route('employees.index')->with('success', 'Employee updated successfully.');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $this -> authorize('delete', $employee);
        $employee->delete();
        return redirect()->route('employees.index');
    }

    public function deleteSelected(Request $request)
    {

        $this -> authorize('delete', Employee::class);
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
        //Validações de arquivos
        $request->validate([
            'file' => 'required|mimes:csv,txt|max:2048',
        ],
        [
            'file.required' => 'O campo arquivo é obrigatório.',
            'file.mimes'    => 'Arquivo inválido, necessário enciar arquivo CSV.',
            'file.max'      => 'Tamanho do arquivo execede :max Mb'
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
            // Adicione outros cargos e seus IDs correspondentes aqui
        ];

        $nifAlterar = 0;
        $cartaoCidadaoAlterar = 0;

        // Receber o arquivo, ler os dados e converter a string em array
        $dataFile = array_map('str_getcsv', file($request->file('file')));

        $arryValues = []; // Inicializa o array que armazenará os dados formatados

        $numRegisto = 0;
        // Percorrer as linhas do arquivo
        foreach ($dataFile as $keyData => $row) {
            $values = array_map('trim', explode(';', $row[0]));

            // Verifica se o número de valores corresponde ao número de colunas esperadas
            if (count($values) != count($employeeImports)) {
                throw new Exception("Número de valores na linha " . ($keyData + 1) . " não corresponde ao número de colunas esperadas.");
            }

            $isDuplicate = false;

            foreach ($employeeImports as $key => $employeeImport) {
                $arryValues[$keyData][$employeeImport] = $values[$key];
                if ($employeeImport == 'NIF') {
                    // Verificar se a coluna é NIF
                    if (Employee::where('NIF', $values[$key])->exists()) {
                        $nifAlterar++;
                        $isDuplicate = true;
                    }
                }

                if ($employeeImport == "CC") {
                    // Verificar se a coluna é Cartão de Cidadão
                    if (Employee::where('CC', $values[$key])->exists()) {
                        $cartaoCidadaoAlterar++;
                        $isDuplicate = true;
                    }
                }

                if ($isDuplicate) {
                    continue; // Pula este registro se for duplicado
                }

                if ($employeeImport === 'birth_date') {
                    // Se o campo é 'birth_date', converte a data para o formato correto
                    $date = DateTime::createFromFormat('m/d/Y', $values[$key]);
                    if ($date) {
                        $arryValues[$keyData][$employeeImport] = $date->format('Y-m-d');
                    } else {
                        // Trata o erro se a data não puder ser convertida
                        throw new Exception("Data inválida na linha " . ($keyData + 1) . ": " . $values[$key]);
                    }
                } elseif ($employeeImport === 'employee_role_id') {
                    // Verifique se o valor existe no mapeamento
                    if (array_key_exists($values[$key], $roleMapping)) {
                        $arryValues[$keyData][$employeeImport] = $roleMapping[$values[$key]];
                    } else {
                        throw new Exception("Cargo inválido na linha " . ($keyData + 1) . ": " . $values[$key]);
                    }
                } else {
                    $arryValues[$keyData][$employeeImport] = $values[$key];
                }

                //Verifica se a coluna e senha
                if ($employeeImport == "password") {
                    //$arryValues[$kayData][$employeeImport] = Hash::make(
                    //    $arryValues[$kayData]['password'],
                    //);

                    //Para atribuir senha a um array. Gerar uma senha aleatoria
                    $arryValues[$keyData][$employeeImport] = Hash::make(Str::random(7));
                }
            }
            $numRegisto++;
        }


        if ($nifAlterar > 0 || $cartaoCidadaoAlterar > 0) {
            return back()->with('error', 'Dados não importados. Alguns registros já estão cadastrados.
            <br>Quantidade de NIF duplicados: ' . $nifAlterar . '<br>Quantidade de Cartões de Cidadão duplicados: ' . $cartaoCidadaoAlterar);
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
