<?php

namespace App\Http\Controllers\Public;

use App\Models\Car;
use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegistrationController extends Controller
{
    public function store(Request $r)
    {
        $token = $r->input('submission_token');
        abort_if(!$token || $token !== $r->session()->pull('reg_token'), 419);

        $data = $r->validate([
            'first_name'   => 'required|max:50',
            'last_name'    => 'required|max:50',
            'email'        => 'nullable|email|max:120',
            'phone'        => 'nullable|max:25',
            'address'      => 'nullable|max:100',
            'city'         => 'nullable|max:50',
            'state'        => 'nullable|max:20',
            'zip'          => 'nullable|max:10',
            'vehicle_type' => ['nullable', Rule::in(['car','truck','motorcycle','other'])],
            'year'         => 'nullable|integer|min:1900|max:2100',
            'make'         => 'nullable|max:40',
            'model'        => 'nullable|max:40',
            'color'        => 'nullable|max:40',
            'tshirt_size'  => 'nullable|in:S,M,L,XL,2XL,3XL',
            'home_church'  => 'nullable|max:80',
            'party_size'   => 'nullable|integer|min:0|max:50',
            'previously_attended' => 'nullable|boolean',
            'comments'     => 'nullable|max:2000',
            'is_test'      => 'nullable|boolean',
        ]);

        Car::create($data + ['submission_token' => $token]);
        return redirect()->route('reg.thanks'); // PRG (prevents refresh dupes)
    }
}
