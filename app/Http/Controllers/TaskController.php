<?php

namespace App\Http\Controllers;

use App\Models\Task;
use DateTime;
use DateTimeZone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class TaskController extends Controller
{
    public function index()
    {
        //Gets the IP Address from the visitor
        $PublicIP = $_SERVER['REMOTE_ADDR'];
        $json = file_get_contents("http://ipinfo.io/$PublicIP/geo");
        $json = json_decode($json, true);
        $timezone = $json['timezone'];
        $tasks = Task::where("iscompleted", false)->get();
        $completed_tasks = Task::where("iscompleted", true)->get();
        return view("welcome", compact("tasks", "completed_tasks", "timezone"));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'task' => 'required|unique:tasks',
            'deadline' => 'required',
        ]);
        $input = $request->all();
        $new_str = new DateTime(request("deadline"), new DateTimeZone(request("timezone")));
        $new_str->setTimeZone(new DateTimeZone('UTC'));
        $task = new Task();
        $task->task = request("task");
        $task->deadline = $new_str->format('Y-m-d h:i A');
        $task->iscompleted = false;
        $task->save();
        return Redirect::back()->with("message", "Task has been added");
    }
}
