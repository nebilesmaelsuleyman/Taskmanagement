<?php

namespace App\Http\Controllers;
use App\Models\Task;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\User;

class TaskController extends Controller
{
   public function index(){
    $tasks=Task::search($request->search ?? '')->get();
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
    public function store(Request $request, $taskId=null)
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
        $task= Task::updateOrCreate(['id'=>$taskId],$validatedData);

       $message= $taskId?'Task updated succesfully':'Task created successfully';
       $task->users()->attach($request->input('assigneduser_id'));

        return redirect()->route('admin-page')->with('success', $message)->withInput();
    } catch (\Throwable $e) {
        return redirect()->back()->withErrors('error', $e->getMessage())->withInput();
    }
}
// Show the form for editing the specified resource.
public function editTask($id)
{
    $task=Task::find($id);
    //dd($task);

    $assignedUsers =$task->users;
   
    // Retrieve all users (excluding those already assigned)
    $availableUsers = User::wherenotIn('id', $assignedUsers->pluck('id'))->get();
    return view('task.layouts.editTask',compact('task','assignedUsers','availableUsers'));
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
    public function DeleteTask( $id)
    {
        try{
            Task::where('id',$id)->delete();
            return redirect('/admin-page')->with('success','Task deleted succesfully');

        }catch(\Exception $e){
            return redirect('/admin-page')-with('fail', $e->getmessage());

        }
    }
}

