<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;

class TaskController extends Controller
{
   public function index(){
    $tasks=Task::all();
    return view('task.layouts.app',compact('tasks'));
   }
   public function create()
    {
        $users=User::all();
        return view('task.layouts.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required|string',
        'description' => 'required',
        'due_date' => 'required',
        'assigneduser_id' => 'required'
    ]);

    // Register new task
    try {
        $new_task = new Task;
        $new_task->title = $request->title;
        $new_task->description = $request->description;
        $new_task->due_date = $request->due_date;

        $new_task->save();

        return redirect()->route('admin-page')->with('success', 'Successfully Added');
    } catch (\Throwable $e) {
        return redirect('/create')->with('fail', $e->getMessage());
    }
}
  

public function editTask($taskId)
{
    $task=Task::findOrFail($taskId);
    return view('/edit/{id}',compact($task));
}

    /**
     * Display the specified resource.
     */
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

