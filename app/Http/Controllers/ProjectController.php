<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    public function list(Request $req) {
        return view('site.projects.list', [
            'projects'=>projectsOfLoggedUser($req)
        ]);
    }

    public function create(Request $req) {
        return view('site.projects.create', [

        ]);
    }

    public function store(Request $req) {
        $req->validate([
            'name'=>'required'
        ]);

        $project = new Project();

        $project->name = $req->name;
        $project->reference = Str::uuid();
        $project->user_id = loggedUser($req)->id;
        $project->created_at = date('Y-m-d H:i:s');
        $project->updated_at = date('Y-m-d H:i:s');

        $project->save();

        return redirect()->route('site.projects.list');
    }

    public function edit(Request $req, $projectReference) {
        $project = Project::where('reference', $projectReference)->first();

        return view('site.projects.edit', [
            'project'=>$project
        ]);
    }

    public function update(Request $req) {
        $req->validate([
            'name'=>'required'
        ]);

        $project = Project::where('reference', $req->reference)->first();

        if(!$project)
            return back()->withErrors("Project doesn't exists");

        $project->name = $req->name;
        $project->reference = Str::uuid();
        $project->user_id = loggedUser($req)->id;
        $project->created_at = date('Y-m-d H:i:s');
        $project->updated_at = date('Y-m-d H:i:s');

        $project->save();

        return redirect()->route('site.projects.list');
    }

    public function delete(Request $req, $projectReference) {

        $project = Project::where('reference', $projectReference)->first();

        if(userCanDelete(loggedUser($req), $project))
            $project->delete();
        return redirect()->route('site.projects.list');
    }
}

function userCanDelete($user, Project $project) {
    if($user->id == $project->user_id)
        return true;
    return false;
}

function loggedUser(Request $req) {
    return $req->session()->get('login');
}

function projectsOfLoggedUser(Request $req) {

    $loggedUser = loggedUser($req);

    return Project::where('user_id', $loggedUser->id)->get();
}
