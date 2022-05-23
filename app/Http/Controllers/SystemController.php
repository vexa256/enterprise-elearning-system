<?php

namespace App\Http\Controllers;

use Auth;
use DB;

class SystemController extends Controller
{
    public function LoadStudentApprovalStatus(Type $var = null)
    {
        $Apps = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('users AS U', 'U.UserID', 'S.uuid')
            ->select('C.CourseName', 'U.*', 'C.CourseDescription', 'S.*')
            ->get();

        $data = [
            'Page' => 'Application.ViewApplication',
            'Title' =>
                'SRL E-Learning Student Application Approval Status Dashboard',
            'Desc' => 'Course Application ',
            'Apps' => $Apps,
        ];

        return view('scrn', $data);
    }

    public function LoadPretestExam(Type $var = null)
    {
        $Timer = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('pre_tests AS P', 'P.CID', 'S.CID')
            ->select('P.*')
            ->first();

        $Apps = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('pre_tests AS P', 'P.CID', 'S.CID')
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('users AS U', 'U.UserID', 'S.uuid')
            ->select(
                'P.*',
                'U.name',
                'S.Name',
                'S.ParentOrganization',
                'S.Email',
                'S.Nationality',
                'C.CourseName'
            )
            ->limit(1)
            ->get();

        $data = [
            'Page' => 'Students.AttemptPretest',
            'Title' => 'Pre-Test Assessment, Your Application Was Approved',
            'Desc' => ' Attempt Pre-Test Assessment To Proceed',
            'Apps' => $Apps,
            'Pretest' => 'true',
            'rem' => ['test'],
            'Form' => $Timer,
            'Timer' => $Timer->TestDurationInMinutes,
        ];

        return view('scrn', $data);
    }

    public function ConvertMinutesToSeconds()
    {
        $counter = DB::table('pre_tests')
            ->where('converted', 'false')
            ->count();

        if ($counter > 0) {
            $up = DB::table('pre_tests')
                ->where('converted', 'false')
                ->get();

            foreach ($up as $data) {
                DB::table('pre_tests')
                    ->where('id', $data->id)
                    ->update([
                        'TestDurationInMinutes' =>
                            $data->TestDurationInMinutes * 60000,
                        'converted' => 'true',
                    ]);
            }
        }
    }

    public function ConvertMinutesToSecondsPostTest()
    {
        $counter = DB::table('post_tests')
            ->where('converted', 'false')
            ->count();

        if ($counter > 0) {
            $up = DB::table('post_tests')
                ->where('converted', 'false')
                ->get();

            foreach ($up as $data) {
                DB::table('post_tests')
                    ->where('id', $data->id)
                    ->update([
                        'DurationInMinutes' => $data->DurationInMinutes * 60000,
                        'converted' => 'true',
                    ]);
            }
        }
    }

    public function ConvertMinutesToSecondsPracTest()
    {
        $counter = DB::table('practical_tests')
            ->where('converted', 'false')
            ->count();

        if ($counter > 0) {
            $up = DB::table('practical_tests')
                ->where('converted', 'false')
                ->get();

            foreach ($up as $data) {
                DB::table('practical_tests')
                    ->where('id', $data->id)
                    ->update([
                        'DurationInMinutes' => $data->DurationInMinutes * 60000,
                        'converted' => 'true',
                    ]);
            }
        }
    }

    public function ConvertMinutesToSecondsModularTest()
    {
        $counter = DB::table('modular_tests')
            ->where('converted', 'false')
            ->count();

        if ($counter > 0) {
            $up = DB::table('modular_tests')
                ->where('converted', 'false')
                ->get();

            foreach ($up as $data) {
                DB::table('modular_tests')
                    ->where('id', $data->id)
                    ->update([
                        'DurationInMinutes' => $data->DurationInMinutes * 60000,
                        'converted' => 'true',
                    ]);
            }
        }
    }

    public function ApprovedStudent(Type $var = null)
    {
        return redirect()->route('ViewUserCourseStats');
    }

    public function CustomUacMiddleware(Type $var = null)
    {
        if (Auth::check()) {
            if (
                Auth::user()->role == 'student' &&
                Auth::user()->ApprovalStatus == 'false'
            ) {
                return $this->LoadStudentApprovalStatus();
            } elseif (
                Auth::user()->role == 'student' &&
                Auth::user()->ApprovalStatus == 'Pretest'
            ) {
                return $this->LoadPretestExam();
            } elseif (
                Auth::user()->ApprovalStatus == 'Approved' &&
                Auth::user()->role == 'ApprovedStudent'
            ) {
                return $this->ApprovedStudent();
            }
        }
    }
}