<?php

namespace App\Http\Controllers;
use DB;
use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\FormEngine;

class AttendanceController extends Controller
{
    public function StudentAttendance(Type $var = null)
    {
        $Students = DB::table('students AS S')
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('instructors AS I', 'I.CID', 'C.CID')
            ->where('I.IID', Auth::user()->UserID)
            ->select('S.*')
            ->get();

        $data = [
            'Page' => 'Attendance.SelectStudent',
            'Title' => 'Select Student To Attach Daily Attendance Report To',
            'Desc' => 'Daily Attendance',
            'Students' => $Students,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptStudent(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtAttendance', ['id' => $id]);
    }

    public function MgtAttendance($id)
    {
        $MyStudents = DB::table('students AS S')
            ->where('S.id', $id)
            ->first();

        $Details = DB::table('modules AS M')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->select('I.IID', 'I.MID', 'M.TotalLessonSessions')
            ->first();

        $MyAtt = DB::table('student_attendances')
            ->where('StudentID', $MyStudents->uuid)
            ->get();

        $rem = [
            'id',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'StudentID',
            'Attendance',
            'IID',
        ];

        $FormEngine = new FormEngine();

        $Students = DB::table('students AS S')
            ->where('S.id', $id)
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('modules AS M', 'M.CID', 'C.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->join('student_attendances AS A', 'A.MID', 'M.MID')
            ->where('A.StudentID', $MyStudents->uuid)
            ->select(
                'A.Attendance',
                'A.created_at AS AttendanceRecordDate',
                'S.*',
                'S.Name AS Student',
                'C.CID',
                'M.MID',
                'M.ModuleName',
                'C.CourseName',
                'M.TotalLessonSessions',
                'I.Name'
            )
            ->get();

        $data = [
            'Page' => 'Attendance.MgtAttendance',
            'Title' => 'Register Attendance Record For the Selected Student',
            'Desc' => 'Attendance',
            'Students' => $Students,
            'MyAtt' => $MyAtt,
            'StudentName' => $MyStudents->Name,
            'CID' => $MyStudents->CID,
            'StudentID' => $MyStudents->uuid,
            'IID' => $Details->IID,
            'MID' => $Details->MID,
            'TotalLessonSessions' => $Details->TotalLessonSessions,
            'rem' => $rem,
            'Form' => $FormEngine->Form('student_attendances'),
        ];

        return view('scrn', $data);
    }
}