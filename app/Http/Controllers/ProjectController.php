<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Country;
use App\Models\District;
use App\Models\ProjectStatus;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $project = Project::orderby('id', 'asc')->paginate(15);
        return view('pages.projects.list', ['projects' => $project]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $countries = Country::all();
        $districts = District::all();
        $projectstatuses = ProjectStatus::all();

        return view('pages.projects.create', ['countries' => $countries, 'districts' => $districts, 'projectstatuses' => $projectstatuses]);
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

        return redirect()->route('project.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('pages.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $countries = Country::all();
        $districts = District::all();
        $projectstatuses = ProjectStatus::all();

        return view('pages.projects.edit', ['project' => $project, 'countries' => $countries, 'districts' => $districts, 'projectstatuses' => $projectstatuses]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $project->update($request->all());
        return redirect()->route('projects.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('projects.index');
    }
}
