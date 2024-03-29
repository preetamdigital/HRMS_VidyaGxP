<?php

namespace App\Http\Controllers\Admin;

use App\Models\Task;
use App\Models\Client;
use App\Models\Employee;
use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index(){
        $title = 'Dashboard';
        $clients_count = Client::count();
        $employee_count = Employee::count();
//$task_count = Task::count();
        $new_employee_count = Employee::where('created_at','DESC')->count();
        
        $project_count =Project::count();


        return view('backend.dashboard',compact(
            'title','clients_count','employee_count','project_count','new_employee_count','task_count'
        ));
    }

    
}
