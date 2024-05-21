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
        return view('pages.employees.create', ['roles' => $roles]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'gender' => 'required|string|max:255',
            'birth_date' => 'required|date',
            'CC' => 'required|string|max:255|unique:employees',
            'NIF' => 'required|string|max:255|unique:employees',
            'address' => 'nullable|string|max:255',
            'employee_role_id' => 'required|integer|exists:employee_roles,id',
            'contact_type' => 'required|string|in:email,phone',
            'email' => 'nullable|required_if:contact_type,email|email|max:255|unique:employees',
            'phone' => 'nullable|required_if:contact_type,phone|string|max:15|unique:employees',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $employee = Employee::create([
            'name' => $request->name,
            'gender' => $request->gender,
            'birth_date' => $request->birth_date,
            'CC' => $request->CC,
            'NIF' => $request->NIF,
            'address' => $request->address,
            'employee_role_id' => $request->employee_role_id,
            'email' => $request->contact_type === 'email' ? $request->email : null,
            'phone' => $request->contact_type === 'phone' ? $request->phone : null,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($employee);

        return redirect()->route('employees.index');
    }


    /**
     * Display the specified resource.
     */
    public function show(Employee $employee)
    {
        return view('pages.employees.show', compact('employee'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Employee $employee)
    {
        $roles = EmployeeRole::all();
        return view('pages.employees.edit', ['employee' => $employee, 'roles' => $roles]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateEmployeeRequest $request, Employee $employee)
    {
        $employee->update($request->all());
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


}
