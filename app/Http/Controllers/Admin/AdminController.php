<?php

namespace App\Http\Controllers\Admin;

use App\Models\Car;
use App\Models\Vote;
use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'registrations'     => Car::where('is_test', false)->count(),
            'registrations_test'=> Car::where('is_test', true)->count(),
            'checked_in'        => Car::where('is_test', false)->where('checked_in',true)->count(),
            'checked_in_test'   => Car::where('is_test', true)->where('checked_in',true)->count(),
            'shirts'            => Car::where('is_test', false)->where('tshirt_given',true)->count(),
            'shirts_test'       => Car::where('is_test', true)->where('tshirt_given',true)->count(),
            'votes'             => Vote::count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
