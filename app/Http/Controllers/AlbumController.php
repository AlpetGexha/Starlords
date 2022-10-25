<?php

namespace App\Http\Controllers;

use App\Models\Album;

class AlbumController extends Controller
{

    public function index()
    {
        $albums = Album::with('media')->orderBy('id', 'desc')->get();

        return view('album.album', compact('albums'));
    }
}
