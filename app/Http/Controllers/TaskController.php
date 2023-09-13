<?php

namespace App\Http\Controllers;

// use Illuminate\Console\View\Components\Task;

use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TaskResource;
use Illuminate\Auth\Events\Validated;
use App\Http\Resources\TaskCollection;

class TaskController extends Controller
{
    public function index(Request $request){
        return new TaskCollection(Task::all());
        
    }
    public function show(Request $request, Task $task)
    {
        return new TaskResource($task);
    }

    public function store(StoreTaskRequest $request)
    {
        // get data from api 
        $validated=$request->validated();

        // create record after validating 
        // $task=Task::create($request);

        $task=DB::table('tasks')->insert([
            'title'=> $request->title,
            'is_done'=>1,
            'created_at'=>now()
        ]);

        // send record to taskresource 
        return new TaskResource($task);
    }
    public function update(UpdateTaskRequest $request,Task $task)
    {
        // get data from api 
        $validated=$request->validated();

        // create record after validating 
        // $task=Task::create($request);

        $task->update($validated);

        // send record to taskresource 
        return new TaskResource($task);
    }

    public function destroy(Request $request, Task $task)
    {
        $task->delete();
        return 'deleted';
    }
}
