<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $user = Auth::user();

    $vehicles = Vehicle::where('manager_id', $user->id)->get();   

        return view('admin.index',compact('vehicles'));
    }

    public function settings()
    {
        return view('admin.settings');
    }
}
