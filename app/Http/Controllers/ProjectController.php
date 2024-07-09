<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Country;
use App\Models\District;
use App\Models\ProjectStatus;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\QueryException;


class ProjectController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $isAdminOrManager = Auth::user()->isMaster();
        $query = Project::query();

        if (!$isAdminOrManager) {
            $employeeId = Auth::id();
            $query->whereHas('trips.employees', function ($q) use ($employeeId) {
                $q->where('employees.id', $employeeId);
            });
        }

        // Clear filter
        if ($request->has('clear_filters')) {
            $request->session()->forget(['search', 'project_status_id', 'start_date', 'end_date']);
        }

        if ($request->has('country_id') && $request->country_id) {
            $query->where('country_id', $request->country_id);
        }

        if ($request->has('district_id') && $request->district_id) {
            $query->where('district_id', $request->district_id);
        }

        // Filter by search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'ilike', '%' . $search . '%')
                    ->orWhere('address', 'like', '%' . $search . '%')
                    ->orWhereHas('projectstatus', function ($q) use ($search) {
                        $q->where('status_name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('district', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    })
                    ->orWhereHas('country', function ($q) use ($search) {
                        $q->where('name', 'like', '%' . $search . '%');
                    });
            });
        }

        if ($request->session()->has('project_status_id')) {
            $project_status_id = $request->session()->get('project_status_id');
            $query->where('project_status_id', $project_status_id);
        }

        if ($request->has('start_date') && $request->has('end_date')) {
            $start_date = $request->start_date;
            $end_date = $request->end_date;
            $request->session()->put('start_date', $start_date);
            $request->session()->put('end_date', $end_date);
        } else if ($request->session()->has('start_date') && $request->session()->has('end_date')) {
            $start_date = $request->session()->get('start_date');
            $end_date = $request->session()->get('end_date');
        }

        if (isset($start_date) && isset($end_date)) {
            $query->whereBetween('created_at', [$start_date, $end_date]);
        }


        $projects = $query->orderBy('id', 'desc')->paginate(10) ->appends($request->query());

        $countries = Country::all();
        $districts = District::all();
        $projectstatuses = ProjectStatus::all();

        return view('pages.Projects.list', [
            'projects' => $projects,
            'countries' => $countries,
            'districts' => $districts,
            'projectstatuses' => $projectstatuses,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date
        ]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        try{
            $this ->authorize('viewAny', Project::class);

            $countries = Country::all();
            $districts = District::all()->groupBy('country_id');
            $projectstatuses = ProjectStatus::all();
            return view('pages.Projects.create', [
                'countries'         => $countries,
                'districts'         => $districts,
                'projectstatuses'   => $projectstatuses
            ]);
        }catch (
            QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $project = new Project();
        $project->name = $request->name;
        $project->address = $request->address;
        $project->project_status_id = $request->projectstatus;
        if ($request->district) {
            $project->district_id = $request->district;
        }
        $project->country_id = $request->country;

        $project->save();

        return redirect()->route('projects.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, $id)
    {
        try {
            if (!is_numeric($id)) {
                abort(400, 'Invalid project ID');
            }

            $project = Project::findOrFail($id);

            $isAdminOrManager = Auth::user()->isMaster();

            if (!$isAdminOrManager) {
                $employeeId = Auth::id();
                $isAssociated = $project->trips()->whereHas('employees', function ($q) use ($employeeId) {
                    $q->where('employees.id', $employeeId);
                })->exists();

                if (!$isAssociated) {
                    abort(403, 'Access denied');
                }
            }

            $trips = $project->trips;
            $totalProjectCost = $trips->sum(function ($trip) {
                return $trip->tripDetails->sum('cost');
            });

            return view('pages.Projects.show', [
                'project' => $project,
                'trips' => $trips,
                'totalProjectCost' => $totalProjectCost,
            ]);
        } catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        try {
            $this->authorize('update', $project);
            $countries = Country::all();
            $districts = District::all()->groupBy('country_id');
            $projectstatuses = ProjectStatus::all();
            return view('pages.Projects.edit', [
                'project' => $project,
                'countries' => $countries,
                'districts' => $districts,
                'projectstatuses' => $projectstatuses
            ]);
        }catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        try{
            $this->authorize('update', $project);
            $project->name = $request->name;
            $project->address = $request->address;
            $project->project_status_id = $request->projectstatus;
            $project->district_id = $request->district;
            $project->country_id = $request->country;

            $project->save();

            return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
        }catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.' . $e->getMessage());
           }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        try{
            $this-> authorize('delete', $project);
            $project->delete();
            return redirect()->route('projects.index');
        }catch (QueryException $e) {
            return redirect()->route('error.403')->with('error', 'Database query error.');
        } catch (\Exception $e) {
            return redirect()->route('error.403')->with('error', 'An unexpected error occurred.');
        }

    }

    public function deleteSelected(Request $request)
    {

        if ($request->has('selected_ids')) {



            if (!empty($request->selected_ids)) {

                Project::whereIn('id', $request->selected_ids)->delete();
            }
        }


        return redirect()->route('projects.index');
    }
}
