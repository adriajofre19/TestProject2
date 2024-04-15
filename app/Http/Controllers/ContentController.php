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

    public function create(Request $request)
    {

        $content = new Content();

        $content->title = $request['title'];
        $content->description = $request['description'];
        $content->visibility = $request['visibility'];
        $content->course_id = 1;

        $content->save();

        return redirect()->route('cursos.index');
    }
}
