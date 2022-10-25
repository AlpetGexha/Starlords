<?php

namespace App\Http\Controllers;

use Artesaos\SEOTools\Facades\SEOTools;

class TeamMemberController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Team Members | Admin');
        return view('admin.teammember.teammember');
    }

    public function create()
    {
        SEOTools::setTitle('Create Team Members | Admin');
        return view('admin.teammember.create');
    }
}
