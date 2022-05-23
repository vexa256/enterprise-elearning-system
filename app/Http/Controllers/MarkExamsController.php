<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;

class MarkExamsController extends Controller
{
    public function MarkModularExams(Type $var = null)
    {
        $Courses = DB::table('courses AS C')
            // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->join('attempt_modular_tests AS A', 'A.MID', 'M.MID')
            ->join('modular_tests AS T', 'T.uuid', 'A.ModularTestID')
            ->where('A.MarkingStatus', 'false')
            ->where('A.status', 'true')
            ->select(
                'M.ModuleName',
                'C.CourseName',
                'I.Name',
                'T.FromDate',
                'T.ToDate',
                'T.TestBriefDescription',
                'A.*',
                'S.Name AS StudentName'
            )
            ->get();

        $Marked = DB::table('courses AS C')
            // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->join('attempt_modular_tests AS A', 'A.MID', 'M.MID')
            ->join('modular_tests AS T', 'T.uuid', 'A.ModularTestID')
            ->where('A.MarkingStatus', 'true')
            ->where('A.status', 'true')
            ->select(
                'M.ModuleName',
                'C.CourseName',
                'I.Name',
                'T.FromDate',
                'T.ToDate',
                'T.TestBriefDescription',
                'A.*',
                'S.Name AS StudentName'
            )
            ->get();

        $Incomplete = DB::table('courses AS C')
            // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->join('attempt_modular_tests AS A', 'A.MID', 'M.MID')
            ->join('modular_tests AS T', 'T.uuid', 'A.ModularTestID')
            ->where('A.status', 'false')
            ->select(
                'M.ModuleName',
                'C.CourseName',
                'I.Name',
                'T.FromDate',
                'T.ToDate',
                'T.TestBriefDescription',
                'A.*',
                'S.Name AS StudentName'
            )
            ->get();

        $data = [
            'Page' => 'MarkExams.Modular',
            'Title' => 'Mark Modular Assessments For Modules You  Instruct ',
            'Desc' => 'Assessments Marking',
            'Courses' => $Courses,
            'Marked' => $Marked,
            'Incomplete' => $Incomplete,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function MarkPostExams(Type $var = null)
    {
        $Courses = DB::table('courses AS C')
            // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->join('attempt_post_tests AS A', 'A.CID', 'M.CID')
            ->join('post_tests AS T', 'T.uuid', 'A.PostTestID')
            ->where('A.MarkingStatus', 'false')
            ->where('A.status', 'true')
            ->select(
                'M.ModuleName',
                'C.CourseName',
                'I.Name',
                'T.FromDate',
                'T.ToDate',
                'T.TestBriefDescription',
                'A.*',
                'S.Name AS StudentName'
            )
            ->get();

        $Marked = DB::table('courses AS C')
            // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->join('attempt_post_tests AS A', 'A.CID', 'M.CID')
            ->join('post_tests AS T', 'T.uuid', 'A.PostTestID')
            ->where('A.MarkingStatus', 'true')
            ->where('A.status', 'true')
            ->select(
                'M.ModuleName',
                'C.CourseName',
                'I.Name',
                'T.FromDate',
                'T.ToDate',
                'T.TestBriefDescription',
                'A.*',
                'S.Name AS StudentName'
            )
            ->get();

        $Incomplete = DB::table('courses AS C')
            // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->join('attempt_post_tests AS A', 'A.CID', 'M.CID')
            ->join('post_tests AS T', 'T.uuid', 'A.PostTestID')
            ->where('A.status', 'false')
            ->select(
                'M.ModuleName',
                'C.CourseName',
                'I.Name',
                'T.FromDate',
                'T.ToDate',
                'T.TestBriefDescription',
                'A.*',
                'S.Name AS StudentName'
            )
            ->get();

        $data = [
            'Page' => 'MarkExams.PostTests.PostTest',
            'Title' => 'Mark Post Test Assessments For Courses You  Instruct ',
            'Desc' => 'Assessments Marking',
            'Courses' => $Courses,
            'Marked' => $Marked,
            'Incomplete' => $Incomplete,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function MarkPracticalExams(Type $var = null)
    {
        $Courses = DB::table('courses AS C')
            // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->join('attempt_practical_tests AS A', 'A.CID', 'M.CID')
            ->join('practical_tests AS T', 'T.uuid', 'A.PracticalTestID')
            ->where('A.MarkingStatus', 'false')
            ->where('A.status', 'true')
            ->select(
                'M.ModuleName',
                'C.CourseName',
                'I.Name',
                'T.FromDate',
                'T.ToDate',
                'T.TestBriefDescription',
                'A.*',
                'S.Name AS StudentName'
            )
            ->get();

        $Marked = DB::table('courses AS C')
            // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->join('attempt_practical_tests AS A', 'A.CID', 'M.CID')
            ->join('practical_tests AS T', 'T.uuid', 'A.PracticalTestID')
            ->where('A.MarkingStatus', 'true')
            ->where('A.status', 'true')
            ->select(
                'M.ModuleName',
                'C.CourseName',
                'I.Name',
                'T.FromDate',
                'T.ToDate',
                'T.TestBriefDescription',
                'A.*',
                'S.Name AS StudentName'
            )
            ->get();

        $Incomplete = DB::table('courses AS C')
            // ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('students AS S', 'S.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->join('attempt_practical_tests AS A', 'A.CID', 'M.CID')
            ->join('practical_tests AS T', 'T.uuid', 'A.PracticalTestID')
            ->where('A.status', 'false')
            ->select(
                'M.ModuleName',
                'C.CourseName',
                'I.Name',
                'T.FromDate',
                'T.ToDate',
                'T.TestBriefDescription',
                'A.*',
                'S.Name AS StudentName'
            )
            ->get();

        $data = [
            'Page' => 'MarkExams.Practicals.Practicals',
            'Title' => 'Practical Test Assessments For Courses You  Instruct ',
            'Desc' => 'Assessments Marking',
            'Courses' => $Courses,
            'Marked' => $Marked,
            'Incomplete' => $Incomplete,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }
}