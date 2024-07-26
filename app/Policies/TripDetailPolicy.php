<?php
namespace App\Policies;

use Illuminate\Auth\Access\Response;
use App\Models\TripDetail;
use App\Models\Employee;
use App\Models\Trip;

class TripDetailPolicy
{
    public function viewAny(Employee $employee): bool
    {
        return $employee->isMaster();
    }

    public function view(Employee $employee, TripDetail $tripDetail): bool
    {
        return $employee->isMaster() || $employee->trips->contains($tripDetail->trip);
    }

    public function create(Employee $employee, Trip $trip): bool
    {
        return $employee->isMaster() || $employee->trips->contains($trip);
    }

    public function update(Employee $employee, TripDetail $tripDetail): bool
    {
        return $employee->isMaster() || $employee->trips->contains($tripDetail->trip);
    }

    public function delete(Employee $employee, TripDetail $tripDetail): bool
    {
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;
    }

    public function restore(Employee $employee, TripDetail $tripDetail): bool
    {
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;
    }

    public function forceDelete(Employee $employee, TripDetail $tripDetail): bool
    {
        return $employee->employee_role_id === 1 || $employee->employee_role_id === 2;
    }
}
