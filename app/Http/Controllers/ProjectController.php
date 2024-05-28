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


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //$project = Project::orderby('id', 'asc')->paginate(15);
        //return view('pages.projects.list', ['projects' => $project]);

        $query = Project::query();

        //Limpar filtro
        if ($request->has('clear_filters')) {
            $request->session()->forget(['search', 'project_status_id']);
        }

        //Para filtar por nome
        //if ($request->has('name') && $request->name) {
        //    $query->where('name', 'like', '%' . $request->name . '%');
        //}

        if ($request->has('country_id') && $request->country_id) {
            $query->where('country_id', $request->country_id);
        }

        if ($request->has('district_id') && $request->district_id) {
            $query->where('district_id', $request->district_id);
        }

        //if ($request->has('project_status_id') && $request->project_status_id) {
        //    $query->where('project_status_id', $request->project_status_id);
        //}


        //Filtrar atraves de pesquisa
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', '%' . $search . '%')
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

        $projects = $query->orderBy('id', 'asc')->paginate(3);

        $countries = Country::all();
        $districts = District::all();
        $projectstatuses = ProjectStatus::all();

        return view('pages.Projects.list', [
            'projects'          => $projects,
            'countries'         => $countries,
            'districts'         => $districts,
            //'projectstatuses'   => $projectstatuses
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
        $project->district_id = $request->district;
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
        return view('pages.Projects.show', [
            'project' => $project,
            'trips' => $trips,
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
