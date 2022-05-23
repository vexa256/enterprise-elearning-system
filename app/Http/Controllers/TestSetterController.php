<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\FormEngine;
use App\Http\Controllers\SystemController;

class TestSetterController extends Controller
{
    public function SelectCourseForPreTest(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page' => 'PreTests.SelectCourse',
            'Title' => 'Select course to attache  a Pre-Test Assessment to',
            'Desc' => 'Pre Test Assessment Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptCoursePretest(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtPreTest', ['id' => $id]);
    }

    public function MgtPreTest($id)
    {
        $SystemController = new SystemController();

        $SystemController->ConvertMinutesToSeconds();

        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $Pretest = DB::table('pre_tests')
            ->where('CID', '=', $Courses->CID)
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();
        $data = [
            'Page' => 'PreTests.MgtPretests',
            'Title' => 'Manage Pre-Tests attached to the selected course',
            'Desc' => $Courses->CourseName,
            'Pretests' => $Pretest,
            'CourseName' => $Courses->CourseName,
            'CID' => $Courses->CID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('pre_tests'),
        ];

        return view('scrn', $data);
    }

    public function SelectCourseForPostTest(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page' => 'PostTests.SelectCourse',
            'Title' => 'Select course to attache  a Post-Test Assessment to',
            'Desc' => 'Post Test Assessment Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptCoursePostTest(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtPostTest', ['id' => $id]);
    }

    public function MgtPostTest($id)
    {
        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $PostTests = DB::table('post_tests')
            ->where('CID', '=', $Courses->CID)
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();
        $data = [
            'Page' => 'PostTests.MgtPostTest',
            'Title' => 'Manage Post-Tests attached to the selected course',
            'Desc' => $Courses->CourseName,
            'PostTests' => $PostTests,
            'CourseName' => $Courses->CourseName,
            'CID' => $Courses->CID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('post_tests'),
        ];

        return view('scrn', $data);
    }

    public function SelectCoursePractical(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page' => 'Practicals.SelectCourse',
            'Title' => 'Select course to attache  a Practical  Assessment to',
            'Desc' => 'Practical Assessment Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptCoursePractical(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtPracticalTest', ['id' => $id]);
    }

    public function MgtPracticalTest($id)
    {
        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $Practicals = DB::table('practical_tests')
            ->where('CID', '=', $Courses->CID)
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();
        $data = [
            'Page' => 'Practicals.MgtPracticals',
            'Title' => 'Manage Practical Tests attached to the selected course',
            'Desc' => $Courses->CourseName,
            'Practicals' => $Practicals,
            'CourseName' => $Courses->CourseName,
            'CID' => $Courses->CID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('practical_tests'),
        ];

        return view('scrn', $data);
    }

    public function ModularSelectCourse(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page' => 'ModularTests.SelectCourse',
            'Title' => 'Select the course whose modular tests are required',
            'Desc' => 'Modular Tests Assessment Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function ModularSelectModule(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;
        $Courses = DB::table('courses')
            ->where('id', $id)
            ->first();
        $Modules = DB::table('modules')
            ->where('CID', $Courses->CID)
            ->get();

        $data = [
            'Page' => 'ModularTests.SelectModule',
            'Title' => 'Select the module to attach tests to',
            'Desc' => 'Modular Tests Assessment Settings',
            'Modules' => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptModuleSelection(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtModularTests', ['id' => $id]);
    }

    public function MgtModularTests($id)
    {
        $Modules = DB::table('modules')
            ->where('id', '=', $id)
            ->first();

        $Courses = DB::table('courses')
            ->where('CID', '=', $Modules->CID)
            ->first();

        $ModularTests = DB::table('modular_tests')
            ->where('MID', '=', $Modules->MID)
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'uuid', 'CID', 'MID'];

        $FormEngine = new FormEngine();
        $data = [
            'Page' => 'ModularTests.MgtModularTests',
            'Title' =>
                'Manage Modular Tests attached to the selected course module',
            'Desc' => $Modules->ModuleName,
            'ModularTests' => $ModularTests,
            'CourseName' => $Courses->CourseName,
            'ModuleName' => $Modules->ModuleName,
            'CID' => $Courses->CID,
            'MID' => $Modules->MID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('modular_tests'),
        ];

        return view('scrn', $data);
    }

    public function SelectModuleToAttachInstructorTo(Type $var = null)
    {
        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id')
            ->get();

        $data = [
            'Page' => 'Instructors.SelectModule',
            'Title' => 'Select course to attach  an Instructor to',
            'Desc' => 'Instructor  Settings',
            'Modules' => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptInstructorModuleSelection(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtInstructors', ['id' => $id]);
    }

    public function MgtInstructors($id)
    {
        $CourseDetails = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id', 'C.CID', 'M.MID')
            ->first();

        $Instructors = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->select('M.ModuleName', 'C.CourseName', 'I.*')
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'uuid', 'CID', 'MID', 'IID'];

        $FormEngine = new FormEngine();

        $data = [
            'Page' => 'Instructors.MgtInstructors',
            'Title' =>
                'Manage Instructors Attached to the selected Course Module',
            'Desc' => 'Instructor Settings',
            'Instructors' => $Instructors,
            'CourseName' => $CourseDetails->CourseName,
            'ModuleName' => $CourseDetails->ModuleName,
            'CID' => $CourseDetails->CID,
            'MID' => $CourseDetails->MID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('instructors'),
        ];

        return view('scrn', $data);
    }

    public function NewInstructor(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
            'Email' => 'unique:instructors',
            'Email' => 'unique:users,email',
        ]);

        DB::table($request->TableName)->insert(
            $request->except(['_token', 'TableName', 'id', 'files'])
        );

        DB::table('users')->insert([
            'name' => $request->Name,
            'email' => $request->Email,
            'password' => \Hash::make($request->Email),
            'nationality' => $request->Nationality,
            'phone' => $request->Phone,
            'role' => 'Instructor',
            'UserID' => $request->IID,
        ]);

        return redirect()
            ->back()
            ->with('status', 'The selected record was created successfully');
    }

    public function DeleteInstructor($id)
    {
        $up = DB::table('instructors')
            ->where('id', $id)
            ->first();

        DB::table('users')
            ->where('UserID', $up->uuid)
            ->delete();

        DB::table('instructors')
            ->where('id', $id)
            ->delete();

        return redirect()
            ->back()
            ->with('status', 'The selected record was deleted successfully');
    }
}