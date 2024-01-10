<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Technology;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::all();

        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $valid = $request->validate([
            'type_id' => 'nullable|exists:types,id',
            'technology.*' => 'exists:technologies,id'
        ]);

        $data = $request->all();
        $technology_ids = ($request->has('technology')) ? $request->get('technology') : [];
        $data['slug'] = Str::slug($data['title'], '_');
        $new_project = Project::create($data);

        if (count($technology_ids)) {
            $new_project->technologies()->attach($technology_ids);
        }

        return redirect()->route('admin.projects.show', $new_project);
        //dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        //$project = Project::findOrFail($project);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::orderBy('name', 'ASC')->get();

        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'technology.*' => 'exists:technologies,id'
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($data['title'], '_');
        $project->update($data);

        if($request->has('technology')){
            $project->technologies()->sync($data['technology']);
        }else{
            $project->technologies()->detach();
        }

        return redirect()->route('admin.projects.show', $project);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return redirect()->route('admin.projects.index');
    }
}
