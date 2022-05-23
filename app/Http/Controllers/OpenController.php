<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\FormEngine;
use App\Http\Controllers\SystemController;
use Auth;
use DB;
use Illuminate\Http\Request;

class OpenController extends Controller
{
    public function __construct()
    {
        $SystemController = new SystemController();

        $SystemController->ConvertMinutesToSeconds();
        $SystemController->ConvertMinutesToSecondsPostTest();
        $SystemController->ConvertMinutesToSecondsPracTest();
        $SystemController->ConvertMinutesToSecondsModularTest();

        // return $SystemController->CustomUacMiddleware();
    }

    public function PretestSecurity(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
        ]);

        DB::table('attempt_pretests')->insert(
            $request->except(['_token', 'TableName', 'id', 'files'])
        );

        DB::table('users')
            ->where('UserID', $request->UserID)
            ->update([
                'ApprovalStatus' => 'Approved',
                'role' => 'ApprovedStudent',
            ]);

        return response()->json([
            'status' => 'true',
        ]);
    }

    public function PostTestSecurity(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
        ]);

        $counter = DB::table('attempt_post_tests')
            ->where('PostTestID', $request->PostTestID)
            ->where('UserID', $request->UserID)
            ->count();

        if ($counter > 0) {
            return response()->json([
                'status' => 'false',
            ]);
        } else {
            DB::table('attempt_post_tests')->insert(
                $request->except(['_token', 'TableName', 'id', 'files'])
            );

            return response()->json([
                'status' => 'true',
            ]);
        }
    }

    public function PracticalTestSecurity(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
        ]);

        $counter = DB::table('attempt_practical_tests')
            ->where('PracticalTestID', $request->PracticalTestID)
            ->where('UserID', $request->UserID)
            ->count();

        if ($counter > 0) {
            return response()->json([
                'status' => 'false',
            ]);
        } else {
            DB::table('attempt_practical_tests')->insert(
                $request->except(['_token', 'TableName', 'id', 'files'])
            );

            return response()->json([
                'status' => 'true',
            ]);
        }
    }

    public function ModularTestSecurity(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
        ]);

        $counter = DB::table('attempt_modular_tests')
            ->where('ModularTestID', $request->ModularTestID)
            ->where('MID', $request->MID)
            ->where('UserID', $request->UserID)
            ->count();

        if ($counter > 0) {
            return response()->json([
                'status' => 'false',
            ]);
        } else {
            DB::table('attempt_modular_tests')->insert(
                $request->except(['_token', 'TableName', 'id', 'files'])
            );

            return response()->json([
                'status' => 'true',
            ]);
        }
    }

    public function ViewCourses(Type $var = null)
    {
        $SystemController = new SystemController();
        if (Auth::check()) {
            if (
                Auth::user()->role == 'student' &&
                Auth::user()->ApprovalStatus == 'false'
            ) {
                return $SystemController->LoadStudentApprovalStatus();
            } elseif (
                Auth::user()->role == 'student' &&
                Auth::user()->ApprovalStatus == 'Pretest'
            ) {
                return $SystemController->LoadPretestExam();
            } elseif (
                Auth::user()->ApprovalStatus == 'Approved' &&
                Auth::user()->role == 'ApprovedStudent'
            ) {
                return $SystemController->ApprovedStudent();
            }
        }

        $rem = [
            'id',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'ReasonsForJoining',
            'SpecialNeed',
            'Gender',
            'CV',
            'StudentID',
        ];

        $FormEngine = new FormEngine();
        $Courses = DB::table('courses')->get();
        $Students = DB::table('students')->get();

        $data = [
            //"Page" => "users.MgtUsers",
            'Page' => 'ViewCourses.CourseView',
            'Title' =>
                'SRL Uganda Course Catalog | SRL Uganda Course Selection',
            'Desc' => 'Select a course to enroll for',
            'Courses' => $Courses,
            'Students' => $Students,
            'Policy' => 'true',
            'rem' => $rem,
            'Form' => $FormEngine->Form('students'),
        ];

        return view('scrn', $data);
    }

    public function NewStudent(Request $request)
    {
        $request->validate([
            '*' => 'required',
            'CV' => 'required|mimes:pdf|max:30048',
            'Email' => 'required|unique:students',
            'StudentID' => 'required|mimes:pdf|max:30048',
        ]);

        $CV = time() . '.' . $request->CV->extension();
        $request->CV->move(public_path('assets/data'), $CV);

        $StudentID = time() . '.' . $request->StudentID->extension();
        $request->StudentID->move(public_path('assets/data'), $CV);

        DB::table($request->TableName)->insert(
            $request->except(['_token', 'TableName', 'id', 'files'])
        );

        DB::table('users')->insert([
            'UserID' => $request->uuid,
            'password' => \Hash::make($request->Email),
            'email' => $request->Email,
            'role' => 'student',
            'phone' => $request->MobileNumber,
            'name' => $request->Name,
            'ApplicationLetter' => $request->ReasonsForJoining,
            'institution' => $request->ParentOrganization,
            'nationality' => $request->Nationality,
            'CourseAppliedFor' => $request->CID,
            'gender' => $request->Gender,
        ]);

        DB::table($request->TableName)
            ->where('uuid', $request->uuid)
            ->update([
                'StudentID' => $StudentID,
                'CV' => $CV,
            ]);

        return redirect()
            ->route('login')
            ->with(
                'status',
                'Your course application has been submitted successfully and is pending review, Login into your SRL E-learning account using the email ' .
                    $request->Email .
                    ' and the password ' .
                    $request->Email .
                    '. Remember to update your credentials upon login'
            );
    }
}