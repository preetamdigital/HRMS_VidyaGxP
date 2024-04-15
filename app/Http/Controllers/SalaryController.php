<?php

namespace App\Http\Controllers;
use App\Models\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function create(){
        $employees = Employee::all();
        return view('backend.EmpSalary.employeesalary', compact('employees'));
    }
    public function store(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|exists:employees,id',
            'amount' => 'required|numeric|min:0',
        ]);

        Salary::create([
            'employee_id' => $request->employee_id,
            'amount' => $request->amount,
        ]);

        return redirect()->back()->with('success', 'Salary details added successfully!');
    }
}
