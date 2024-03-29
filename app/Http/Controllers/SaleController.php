<?php

namespace App\Http\Controllers;
use App\Models\sale;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SaleController extends Controller
{
    public function index()
    {
        $sales=sale::all();
        dd($sales);
        return view('');
    }
}
