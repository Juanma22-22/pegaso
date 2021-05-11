<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use DB;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view('admin.index');
    }

    // public function viewCustomer()
    // {
    //     return view('admin.customersadmin.indexcustomers');
    // }
}
