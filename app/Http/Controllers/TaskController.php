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
    $validatedData= $request->validate([
        'title' => 'required|string',
        'description' => 'required',
        'due_date' => 'required',
        'assigneduser_id' => 'required'
    ]);

    // Register new task
    try {
        //create new Task
        Task::create($validatedData);
        return redirect()->route('admin-page')->with('success','TAsk created succesfully');
    } catch (\Throwable $e) {
        return redirect()->back()->withErrors('error', 'failed to add tasl');
    }
}
// Show the form for editing the specified resource.
public function editTask($id)
{
    $task=Task::find($id);

    $users=User::all();
    return view('task.layouts.editTask',compact('task','users'));
}

public function Update(Request $request, Task $task)
{
    $validatedData=$request->validate([
        'title' => 'required|string',
        'description' => 'required',
        'due_date' => 'required',
        'assigneduser_id' => 'required'
    ]);
  

    $task->update($validatedData);

    return redirect()->route('admin-page')->with('success', 'Post updated successfully');
}
    /**
     * Display the specified resource.
     */
    /**
     * 
     */


    /**
     * Update the specified resource in storage.
     */
    public function search(Request $request)
    {
       // $query =$request ->input('query');
        $tasks=Task::search($request->search ?? '')->get();
        return view('task.layouts.app',compact('tasks'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function DeleteTask($id)
    {
        try{
            Task::where('id',$id)->delete();
            return redirect('/admin-page')->with('success','Task deleted succesfully');

        }catch(\Exception $e){
            return redirect('/admin-page')-with('fail', $e->getmessage());

        }
    }
}

