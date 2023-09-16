<?php

namespace App\Http\Controllers;

// use Illuminate\Console\View\Components\Task;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Resources\TaskResource;
use Illuminate\Auth\Events\Validated;
use Spatie\QueryBuilder\QueryBuilder;
use App\Http\Resources\TaskCollection;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;

class TaskController extends Controller
{
    public function index(Request $request){
        $tasks = QueryBuilder::for(Task::class)
        ->allowedFilters('is_done')
        ->defaultSort('-created_at')
        ->allowedSorts(['title','is_done','created_at'])
        ->get();

        return new TaskCollection($tasks);
        
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
