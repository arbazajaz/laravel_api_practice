<?php

namespace App\Http\Controllers;

// use Illuminate\Console\View\Components\Task;
use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Resources\TaskCollection;

class TaskController extends Controller
{
    public function index(){
        return new TaskCollection(Task::all());
        
    }
}
