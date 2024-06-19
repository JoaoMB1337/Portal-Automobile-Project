<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\Response;
use App\Models\Trip;
use App\Models\User;

class TripPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Employee $employee): bool
    {
        //
        if ($employee->isMaster()) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(Employee $employee, Trip $trip): bool
    {
        //
        if ($employee->isMaster()) {
            return true;
        }
        else {
            return $trip->employees->contains($employee);
        }
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(Employee $employee): bool
    {
        //
        if ($employee->isMaster()) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Employee $employee, Trip $trip): bool
    {
        //
        if ($employee->isMaster()) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(Employee $employee, Trip $trip): bool
    {
        //
        if ($employee->isMaster()) {
            return true;
        }
        else {
            return false;
        }
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Trip $trip): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Trip $trip): bool
    {
        //
    }
}
