<?php

namespace App\Http\Controllers;

use App\Models\EventCategory;
use Artesaos\SEOTools\Facades\SEOTools;
class EventCategoryController extends Controller
{
    public function index()
    {
        SEOTools::setTitle('Event Category | Admin');
        $category = EventCategory::all();

        return view('admin.eventcategory.eventcategory', compact('category'));
    }

    public function create()
    {
        SEOTools::setTitle('Create Event Category | Admin');
        return view('admin.eventcategory.create');
    }
}
