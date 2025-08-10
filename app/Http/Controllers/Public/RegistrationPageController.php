<?php

namespace App\Http\Controllers\Public;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RegistrationPageController extends Controller
{
    public function show(Request $r) {
        $open = false; // flip false to close the form without removing the page
        $token = (string) Str::uuid();
        $r->session()->put('reg_token', $token);
        return view('public.register', compact('open','token'));
    }

    public function thanks() {
        return view('public.thanks');
    }
}
