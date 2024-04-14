<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

use App\Models\User;
use App\Models\Notes;

class HomeController extends Controller
{
    public function index()
    {
        return Inertia::render('Home', [
            'users' => User::all(),
            'notes' => Notes::all(),
        ]);
    }

    public function create(Request $request)
    {
        
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        Notes::create([
            'title' => $request->title,
            'content' => $request->content,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('notes.index');


    }
}
