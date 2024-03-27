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
        $projects = Task::latest()->get();
        return view('backend.Task.index',compact(
            'title','projects'
        ));
    }



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function list()
    {
        $title = 'projects';
        $projects = Task::latest()->get();
        return view('backend.projects.list',compact(
            'title','projects'
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
            'name' => 'required',
            'client' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
            'rate' => 'required',
            'rate_type' => 'required',
            'priority' => 'required',
            'leader' => 'required',
            'team' => 'required',
            'description' => 'required',
            'project_files' => 'nullable'
        ]); 
        $project = Task::findOrfail($request->id);
        $files = $project->files;
        if($request->hasFile('project_files')){
            $files = array();
            foreach($request->project_files as $file){
                $fileName = time().'.'.$file->extension();
                $file->move(public_path('storage/projects/'), $fileName);
                array_push($files,$fileName);
            }
        }
        $project->update([
            'name' => $request->name,
            'client_id' => $request->client,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'rate' => $request->rate,
            'rate_type' => $request->rate_type,
            'priority' => $request->priority,
            'leader' => $request->leader,
            'team' => $request->team,
            'description' => $request->description,
            'files' => $files,
            'progress' => $request->progress,
        ]);
        $notification = notify('project has been updated');
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
