<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\EmployeeRole;

class RegisterController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/home';

    public function __construct()
    {
        $this->middleware('guest');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'gender' => ['required', 'string', 'in:male,female,other'],
            'birth_date' => ['required', 'date'],
            'company_position' => ['required', 'string', 'max:255'],
            'driving_license_id' => ['required', 'string', 'max:255', 'unique:employees'],
            'CC' => ['required', 'string', 'max:255', 'unique:employees'],
            'NIF' => ['required', 'string', 'max:255', 'unique:employees'],
            'address' => ['string', 'max:255', 'nullable'],
            'mobile_number' => ['required', 'string', 'max:15'],
            'employee_role_id' => ['required', 'integer', 'exists:employee_roles,id'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employees'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    protected function create(array $data)
    {
        return Employee::create([
            'name' => $data['name'],
            'gender' => $data['gender'],
            'birth_date' => $data['birth_date'],
            'company_position' => $data['company_position'],
            'driving_license_id' => $data['driving_license_id'],
            'CC' => $data['CC'],
            'NIF' => $data['NIF'],
            'address' => $data['address'] ?? null,
            'mobile_number' => $data['mobile_number'],
            'employee_role_id' => $data['employee_role_id'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }


    public function showRegistrationForm()
    {
        $roles = EmployeeRole::all();
        return view('auth.register', ['roles' => $roles]);
    }

    protected function register(Request $request)
    {
        $this->validator($request->all())->validate();

        $user = $this->create($request->all());

        event(new Registered($user));

        $this->guard()->login($user);

        return $this->registered($request, $user)
            ?: redirect($this->redirectPath());
    }

    protected function registered(Request $request, $user)
    {
        return redirect()->route('login')->with('success', 'Registration successful! Please login.');
    }

}
