<?php

namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\TripDetail;
use App\Models\Employee;
use App\Models\Trip;

class TripDetailPolicy
{

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Employee $employee): bool
    {
        return $employee->isMaster();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Employee $employee ,TripDetail $tripDetail): bool
    {
        //o user ou e master ou esta dentro do trip
        return $employee->isMaster() || $employee->trips->contains($tripDetail->trip);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Employee $employee, Trip $trip): bool
    {
        return $employee->isMaster() || $employee->trips->contains($trip);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Employee $employee, Trip $trip): bool
    {
        return $employee->isMaster() || $employee->trips->contains($trip);
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
