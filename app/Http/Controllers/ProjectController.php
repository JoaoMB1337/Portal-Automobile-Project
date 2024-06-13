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


class ProjectController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Verifica se o usuário logado é administrador ou gestor
        $isAdminOrManager = Auth::user()->isAdmin() || Auth::user()->isManager(); // Supondo que existe um método isManager() no modelo User
    
        // Construir a consulta para listar os projetos
        $query = Project::query();
    
        if (!$isAdminOrManager) {
            // Se não for administrador ou gestor, filtra apenas os projetos associados ao funcionário logado
            $employeeId = Auth::id();
            $query->whereHas('trips.employees', function ($q) use ($employeeId) {
                $q->where('employees.id', $employeeId);
            });
        }
    
        // Limpar filtro
        if ($request->has('clear_filters')) {
            $request->session()->forget(['search', 'project_status_id']);
        }
    
        if ($request->has('country_id') && $request->country_id) {
            $query->where('country_id', $request->country_id);
        }
    
        if ($request->has('district_id') && $request->district_id) {
            $query->where('district_id', $request->district_id);
        }
    
        // Filtrar através de pesquisa
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
    
        $projects = $query->orderBy('id', 'asc')->paginate(10);
    
        $countries = Country::all();
        $districts = District::all();
        $projectstatuses = ProjectStatus::all();
    
        return view('pages.Projects.list', [
            'projects' => $projects,
            'countries' => $countries,
            'districts' => $districts,
            'projectstatuses' => $projectstatuses
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        $countries = Country::all();
        $districts = District::all()->groupBy('country_id');
        $projectstatuses = ProjectStatus::all();
        return view('pages.Projects.create', [
            'countries'         => $countries,
            'districts'         => $districts,
            'projectstatuses'   => $projectstatuses
        ]);
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
    public function show(Project $project)
    {
        $trips = $project->trips;
        $totalProjectCost = $trips->sum(function ($trip) {
            return $trip->tripDetails->sum('cost');
        });
        return view('pages.Projects.show', [
            'project'           => $project,
            'trips'             => $trips,
            'totalProjectCost'  => $totalProjectCost,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $countries = Country::all();
        $districts = District::all()->groupBy('country_id');
        $projectstatuses = ProjectStatus::all();
        return view('pages.Projects.edit', [
            'project' => $project,
            'countries' => $countries,
            'districts' => $districts,
            'projectstatuses' => $projectstatuses
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->name = $request->name;
        $project->address = $request->address;
        $project->project_status_id = $request->projectstatus;
        $project->district_id = $request->district;
        $project->country_id = $request->country;

        $project->save();

        return redirect()->route('projects.index')->with('success', 'Project updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
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
