<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SponzorController extends Controller
{
    public function index(){
        $Sponzor = \App\Models\Sponzor::all();

        return view('admin.Sponzor.Sponzor', compact('Sponzor'));
    }
}
