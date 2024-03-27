<?php
namespace App\Http\Controllers\Admin;

use App\Models\Task;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TaskController extends Controller
{
       /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'TaskHRMS';
        $tasks = Task::latest()->get();
        return view('backend.Task.index',compact(
            'title','tasks'
        ));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function lists()
    {
        $title = 'projects';
        $tasks = Task::get();
        return view('backend.Task.task-list',compact(
            'title','tasks'
        ));
    }


    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function leads(){
        $title = 'project leads';
        $projects = Task::get();
        return view('backend.projects.leads',compact(
            'title','projects'
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'firstname'=>'required',
            'lastname'=>'required',
            'email'=>'required|email',
            'phone'=>'nullable|max:15',
            'image'=>'file|image|mimes:jpg,jpeg,png,gif',
      
        ]); 
        // $files = null;
        // if($request->hasFile('image')){
        //     $files = array();
        //     foreach($request->image as $file){
        //         $fileName = time().'.'.$file->extension();
        //         $file->move(public_path('storage/tasks/'.$request->name), $fileName);
        //         array_push($files,$fileName);
        //     }
        // }

        $imageName = null;
        if($request->image != null){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/tasks'), $imageName);
        }
      
        Task::create([
            'firstname'=>$request->firstname,
            'lastname'=>$request->lastname,
            'email'=>$request->email,
            'phone'=>$request->phone,
            'company'=>$request->company,
            'image' => $imageName,
                ]);
                return back()->with('success','Task has been added successfully!!!');
    }
    /**
     * Display the specified resource.
     *
     * @param  string  $project_name
     * @return \Illuminate\Http\Response
     */
    public function show($project_name)
    {
        $title = 'view project';
        $project = Task::where('name','=',$project_name)->firstOrFail();
        return view('backend.projects.show',compact(
            'title','project'
        ));
    }

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * 
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $request->validate([
            'firstname' => 'required',
            'lastname' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'image'=>'file|image|mimes:jpg,jpeg,gif',
      
        ]); 
        
        

        $imageName = null;
        if($request->image != null){
            $imageName = time().'.'.$request->image->extension();
            $request->image->move(public_path('storage/tasks'), $imageName);
        }
       $task =Task::findorfail($request->id);
        
        $task->update([
             'firstname'=>$request->firstname,
             'lastname'=>$request->lastname,
             'email'=>$request->email,
             'phone'=>$request->phone,
             'image'=>$imageName,
             'company'=>$request->company
        ]);
        $notification = notify('task has been updated');
        return back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Task::findOrfail($request->id)->delete();
        $notification = notify('project has been added');
        return back()->with($notification);
    }

}
