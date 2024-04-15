<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Content;

use Inertia\Inertia;

class ContentController extends Controller
{
    public function index()
    {
        $contents = Content::all();

        return Inertia::render('Content', [
            'contents' => $contents
        ]);
    }
}
