<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TaskController extends Controller
{
    public function list(Request $req) {
        return view('site.tasks.list', [
            'tasks'=>tasksOfLoggedUser($req),
            'projects'=>projectsOfLoggedUser($req)
        ]);
    }

    public function create(Request $req) {
        return view('site.tasks.create', [
            'projects'=>projectsOfLoggedUser($req)
        ]);
    }

    public function store(Request $req) {
        $req->validate([
            'name'=>'required'
        ]);

        $task = new Task();

        $task->name = $req->name;
        $task->priority = nextPriority();
        $task->project_id = $req->project;
        $task->user_id = loggedUser($req)->id;

        $task->created_at = date('Y-m-d H:i:s');
        $task->updated_at = date('Y-m-d H:i:s');

        $task->reference = Str::uuid();

        $task->save();

        return redirect()->route('site.tasks.list');
    }

    public function edit(Request $req, $taskReference) {
        $task = Task::where('reference', $taskReference)->first();

        return view('site.tasks.edit', [
            'task'=>$task,
            'projects'=>projectsOfLoggedUser($req)
        ]);
    }

    public function update(Request $req) {
        $req->validate([
            'name'=>'required'
        ]);

        $task = Task::where("reference", $req->reference)->first();

        if(!$task)
            return back()->withErrors("Task doesn't exists");

        $task->name = $req->name;
        $task->priority = nextPriority();
        $task->project_id = $req->project;
        $task->user_id = loggedUser($req)->id;

        $task->updated_at = date('Y-m-d H:i:s');

        $task->save();

        return redirect()->route('site.tasks.list');
    }

    public function delete(Request $req, $taskReference) {

        $task = Task::where('reference', $taskReference)->first();

        if(userCanDelete(loggedUser($req), $task))
            $task->delete();
        return redirect()->route('site.tasks.list');
    }

    public function reorder(Request $req) {
        $sortingItems = $req->sortingItems;

        foreach($sortingItems as $key => $task_id) {

            $task = Task::find($task_id);

            if(!$task)
                return response()->json(['status'=>false]);

            $task->priority = $key + 1;
            $task->save();
        }

        return response()->json(['status'=>true]);
    }

    public function changeProject(Request $req) {
        if($req->project != 0)
            $tasks = Task::where('project_id', $req->project)->orderBy('priority', 'ASC')->get();
        else
            $tasks = Task::orderBy('priority', 'ASC')->get();

        $tasksHtml = ''; // Because of lack of time, I will not componentize this

        foreach($tasks as $task) {

            $tasksHtml .= '
            <li task_id="'.$task->id.'" class="item-single">
                <div class="flex flex-wrap">
                    <div class="w80">
                        <h4>'.$task->name.'</h4>
                    </div>
                    <div class="w20 text-right">
                    <a href="'.route('site.tasks.edit', $task->reference).'"><i class="fas fa-pencil-alt"></i></a>
                    <a href="'.route('site.tasks.delete', $task->reference).'"><i class="fas fa-trash"></i></a>
                    </div>
                </div>
            </li>';
        }

        return response()->json(['status'=>true, 'tasks'=>$tasksHtml]);
    }
}

function userCanDelete($user, Task $task) {
    if($user->id == $task->user_id)
        return true;
    return false;
}

function loggedUser(Request $req) {
    return $req->session()->get('login');
}
function tasksOfLoggedUser(Request $req) {

    $loggedUser = loggedUser($req);

    return Task::where('user_id', $loggedUser->id)->orderBy('priority', 'ASC')->get();
}
function projectsOfLoggedUser(Request $req) {

    $loggedUser = loggedUser($req);

    return Project::where('user_id', $loggedUser->id)->get();
}

function nextPriority() {
    if(Task::first())
        return (Task::orderBy('priority', 'DESC')->first()->priority + 1);
    else
        return 1;
}
