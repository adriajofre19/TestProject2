<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Course;
use App\Models\Content;

use Inertia\Inertia;

class CoursesController extends Controller
{
    public function index()
    {
        $courses = Course::all();
        
        return Inertia::render('Cursos', [
            'courses' => $courses,
        ]);
    }

    public function show($id){
        $course = Course::find($id);
        $contents = Content::where('course_id', $id)->get();
        return Inertia::render('Course', [
            'course' => $course,
            'contents' => $contents,
        ]);
    }

    public function update(Request $request, $id){

        $validatedData = $request->validate([
            'nom' => 'required|string|max:255',
            'descripcio' => 'required|string|max:255',
            'actiu' => 'required|numeric',

        ]);

        $course = Course::findOrFail($id);

        $course->nom = $validatedData['nom'];
        $course->descripcio = $validatedData['descripcio'];
        $course->actiu = $validatedData['actiu'];

        $course->save();
    }

    public function destroy($id){
        $course = Course::findOrFail($id);
        $course->delete();
    }

}
