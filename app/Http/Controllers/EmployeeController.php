<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployeeRequest;
use App\Http\Requests\UpdateEmployeeRequest;
use App\Models\EmployeeRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Response;
use App\Models\DrivingLicense;
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Employee::query();

        if ($request->filled('name')) {
            $query->where('name', 'like', '%' . $request->input('name') . '%');
        }

        if ($request->filled('role')) {
            $query->whereHas('role', function ($query) use ($request) {
                $query->where('name', $request->input('role'));
            });
        }

        $employees = $query->orderBy('id', 'asc')->paginate(15);

        return view('pages.employees.list', [
            'employees' => $employees,
            'roles' => EmployeeRole::all(),
        ]);
    }



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = EmployeeRole::all();
        $drivingLicenses = DrivingLicense::all();
        return view('pages.employees.create', ['roles' => $roles, 'drivingLicenses' => $drivingLicenses]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'employee_number' => 'nullable|string|max:255|unique:employees,employee_number',
            'gender' => 'required|string',
            'birth_date' => 'required|date',
            'CC' => 'required|string|max:255|unique:employees,CC',
            'NIF' => 'required|string|max:255|unique:employees,NIF',
            'address' => 'nullable|string|max:255',
            'employee_role_id' => 'required|exists:employee_roles,id',
            'email' => 'nullable|email|max:255|unique:employees,email',
            'phone' => 'nullable|string|max:255|unique:employees,phone',
            'password' => 'required|string|min:8|confirmed',
            'driving_licenses' => 'nullable|array',
            'driving_licenses.*' => 'exists:driving_licenses,id',
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

        return redirect()->route('employees.index')->with('success', 'Employee created successfully.');
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        $employee = Employee::with('drivingLicenses', 'role')->findOrFail($employee->id);
        return view('pages.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $employee = Employee::with('drivingLicenses', 'role')->findOrFail($employee->id);
        $roles = EmployeeRole::all();
        $drivingLicenses = DrivingLicense::all();
        return view('pages.employees.edit',
        [
            'employee' => $employee,
            'roles' => $roles,
            'drivingLicenses' => $drivingLicenses,

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $data = $request->all();

        if ($request->has('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $employee->update($data);

        if ($request->has('driving_licenses')) {
            $employee->drivingLicenses()->sync($request->driving_licenses);
        } else {
            $employee->drivingLicenses()->detach();
        }

        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Employee $employee)
    {
        $employee->delete();
        return redirect()->route('employees.index');
    }

    public function deleteSelected(Request $request)
    {
        $selected_ids = json_decode($request->input('selected_ids'),true);
        if(!empty($selected_ids)) {
            Employee::whereIn('id', $selected_ids)->delete();
            return redirect()->route('employees.index');
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
