<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Models;
use Illuminate\Http\Request;

class ChartController extends Controller
{
    public function index()
    {
        // Retrieve dynamic data (e.g., sales data for each year)
        $salesData = Sales::select('year', 'amount')->get();

        // Pass the dynamic data to the view
        return view('chart', ['salesData' => $salesData]);
    }
}
