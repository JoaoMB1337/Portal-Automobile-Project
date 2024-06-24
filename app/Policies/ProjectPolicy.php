<?php

namespace App\Policies;

use App\Models\Employee;
use Illuminate\Auth\Access\Response;
use App\Models\Project;
use App\Models\User;
use function Webmozart\Assert\Tests\StaticAnalysis\false;

class ProjectPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(Employee $employee): bool
    {
        //
        return $employee->isMaster();
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Project $project): bool
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(Employee $employee): bool
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
    public function delete(Employee $employee): bool
    {
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
    public function restore(User $user, Project $project): bool
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Project $project): bool
    {
        //
    }


}
