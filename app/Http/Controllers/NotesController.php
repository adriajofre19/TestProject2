<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notes;

use Inertia\Inertia;

class NotesController extends Controller
{
    public function index()
    {
        return Inertia::render('Notes', [
            // get all notes of the user logged in
            'notes' => Notes::where('user_id', auth()->id())->get()
        ]);
    }


}
