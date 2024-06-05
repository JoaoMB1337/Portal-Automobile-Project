<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\Response;
use App\Models\Insurance;
use App\Models\User;

class InsurancePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Employee $employee): bool
    {
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view( Employee $employee): bool
    {
        //
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;

    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Employee $employee): bool
    {
        //
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;

    }

    /**
     * Determine whether the user can update the model.
     */
    public function update( Employee $employee): bool
    {
        //
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;

    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete( Employee $employee): bool
    {
        //
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;

    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore( Employee $employee): bool
    {
        //
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;

    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete( Employee $employee): bool
    {
        //
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;

    }
}
