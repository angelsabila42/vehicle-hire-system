<?php

namespace App\Http\Controllers\Customer;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class CustomerController extends Controller
{
    public function index()
    {
        $vehicles = Vehicle::where('status', 'available')->get();
        return view('customer.index', compact('vehicles'));
    }
}
