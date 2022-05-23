<?php

namespace App\Http\Controllers;

use App\Http\Controllers\FormEngine;
use DB;
use Illuminate\Http\Request;

// use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function MgtCourses()
    {
        $rem = ['id', 'created_at', 'updated_at', 'uuid', 'CID', 'Thumbnail'];

        $FormEngine = new FormEngine();

        $Courses = DB::table('courses')->get();
        $data = [
            'Page' => 'Courses.MgtCourses',
            'Title' => 'Manage all supported courses',
            'Desc' => 'Course Settings',
            'Courses' => $Courses,
            'rem' => $rem,
            'Form' => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function SelectCourse(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page' => 'Modules.SelectCourse',
            'Title' => 'Select course to attache modules to',
            'Desc' => 'Course module Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function ModuleCourseSelected(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtModules', ['id' => $id]);
    }

    public function MgtModules($id)
    {
        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $Modules = DB::table('modules')
            ->where('CID', '=', $Courses->CID)
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();
        $data = [
            'Page' => 'Modules.MgtModules',
            'Title' => 'Manage modules attached to the selected course',
            'Desc' => 'Course module Assignment',
            'Modules' => $Modules,
            'CourseName' => $Courses->CourseName,
            'CID' => $Courses->CID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('modules'),
        ];

        return view('scrn', $data);
    }
}