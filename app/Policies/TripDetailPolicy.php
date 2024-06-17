<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\TripDetail;
use App\Models\Employee;

class TripDetailPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Employee $employee): bool
    {
        return $employee->employee_role_id === 3;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Employee $employee ,TripDetail $tripDetail): bool
    {

        return $tripDetail->trip->employees()->where('employee_id', $employee->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Employee $employee): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Employee $employee, TripDetail $tripDetail): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Employee $employee, TripDetail $tripDetail): bool
    {
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Employee $employee, TripDetail $tripDetail): bool
    {
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Employee $employee, TripDetail $tripDetail): bool
    {
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;
    }
}
