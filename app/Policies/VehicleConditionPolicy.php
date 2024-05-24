<?php

namespace App\Policies;

use App\Models\Employee;
use App\Models\VehicleCondition;
use Illuminate\Auth\Access\Response;

class VehicleConditionPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Employee $employee): bool
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Employee $employee, VehicleCondition $vehicleCondition): bool
    {
        //
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
    public function update(Employee $employee, VehicleCondition $vehicleCondition): bool
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Employee $employee, VehicleCondition $vehicleCondition): bool
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(Employee $employee, VehicleCondition $vehicleCondition): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(Employee $employee, VehicleCondition $vehicleCondition): bool
    {
        //
    }
}
