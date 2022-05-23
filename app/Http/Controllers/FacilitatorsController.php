<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use Auth;
class FacilitatorsController extends Controller
{
    public function ViewNotes()
    {
        $MyCourse = DB::table('courses AS C')
            ->join('instructors AS I', 'I.CID', 'C.CID')
            ->select('C.*')
            ->first();

        $Mods = DB::table('modules AS M')
            ->join('video_notes AS V', 'V.MID', 'M.MID')
            ->join('document_notes AS D', 'D.MID', 'M.MID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->where('I.IID', Auth::user()->UserID)
            ->select(
                'M.*',
                'I.Name',
                'I.InstructorProfile',
                'D.NotesTitle',
                'D.BriefDescription',
                'D.url AS DURL',
                'V.url AS VURL',
                'V.BriefDescription AS VBriefDescription',
                'V.NotesTitle AS VNotesTitle'
            )
            ->get();

        $data = [
            'Page' => 'Instructors.ViewNotes',
            'Title' => 'Instructor Course Module Materials',
            'Desc' => 'Your assigned course is ' . $MyCourse->CourseName,
            'Mods' => $Mods,
        ];

        return view('scrn', $data);
    }

    public function GuideSelectModule(Type $var = null)
    {
        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id')
            ->get();

        $data = [
            'Page' => 'FacilitatorGuides.SelectModule',
            'Title' => 'Select course module to attach facilitator guides to',
            'Desc' => 'Facilitator Guides Settings',
            'Modules' => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptGuideSelection(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtGuides', ['id' => $id]);
    }

    public function MgtGuides($id)
    {
        $CourseDetails = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id', 'C.CID', 'M.MID')
            ->first();

        $Guides = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->join('facili_tator_guides AS D', 'D.MID', 'M.MID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->select('M.ModuleName', 'C.CourseName', 'D.*', 'I.Name')
            ->get();

        $rem = [
            'id',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'IID',
            'url',
        ];

        $FormEngine = new FormEngine();

        $data = [
            'Page' => 'FacilitatorGuides.MgtFacGuides',
            'Title' => 'Manage Modular Facilitator Guides',
            'Desc' => ' Facilitator Guides Settings',
            'Guides' => $Guides,
            'CourseName' => $CourseDetails->CourseName,
            'ModuleName' => $CourseDetails->ModuleName,
            'CID' => $CourseDetails->CID,
            'MID' => $CourseDetails->MID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('facili_tator_guides'),
        ];

        return view('scrn', $data);
    }

    public function SelectCourseTimetable(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page' => 'TimeTable.SelectCourse',
            'Title' => 'Select course to attache  a timetable to',
            'Desc' => 'Course Schedule Settings',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function AcceptCourseSelectionTime(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('MgtTimeTimetables', ['id' => $id]);
    }

    public function MgtTimeTimetables($id)
    {
        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $TimesTables = DB::table('course_time_tables')
            ->where('CID', '=', $Courses->CID)
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'uuid', 'CID', 'MID', 'url'];

        $FormEngine = new FormEngine();
        $data = [
            'Page' => 'TimeTable.MgtTimeTables',
            'Title' => 'Manage Course Timetables For The Select Course',
            'Desc' => $Courses->CourseName,
            'TimesTables' => $TimesTables,
            'CourseName' => $Courses->CourseName,
            'CID' => $Courses->CID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('course_time_tables'),
        ];

        return view('scrn', $data);
    }

    public function ViewCourseTimeTable(Type $var = null)
    {
        $Courses = DB::table('courses')->get();

        $data = [
            'Page' => 'TimeTable.ViewSelectCourse',
            'Title' => 'Select course whose timetable is required',
            'Desc' => 'Course Schedule ',
            'Courses' => $Courses,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function ViewCourseSelectionTime(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('ViewTimeTable', ['id' => $id]);
    }

    public function ViewTimeTable($id)
    {
        $Courses = DB::table('courses')
            ->where('id', '=', $id)
            ->first();

        $TimesTables = DB::table('course_time_tables')
            ->where('CID', '=', $Courses->CID)
            ->get();

        $rem = ['id', 'created_at', 'updated_at', 'uuid', 'CID', 'MID', 'url'];

        $FormEngine = new FormEngine();
        $data = [
            'Page' => 'TimeTable.ViewTimeTables',
            'Title' => 'Manage Course Timetables For The Select Course',
            'Desc' => $Courses->CourseName,
            'TimesTables' => $TimesTables,
            'CourseName' => $Courses->CourseName,
            'CID' => $Courses->CID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('course_time_tables'),
        ];

        return view('scrn', $data);
    }

    public function ViewSelectModule(Type $var = null)
    {
        $Modules = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id')
            ->get();

        $data = [
            'Page' => 'FacilitatorGuides.ViewSelectModule',
            'Title' =>
                'Select course module whose facilitator guides are required',
            'Desc' => 'Facilitator Guides ',
            'Modules' => $Modules,
            // "rem" => $rem,
            // "Form" => $FormEngine->Form('courses'),
        ];

        return view('scrn', $data);
    }

    public function ViewGuideSelection(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        $id = $request->id;

        return redirect()->route('ViewGuides', ['id' => $id]);
    }

    public function ViewGuides($id)
    {
        $CourseDetails = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->select('M.ModuleName', 'C.CourseName', 'M.id', 'C.CID', 'M.MID')
            ->first();

        $Guides = DB::table('modules AS M')
            ->where('M.id', $id)
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->join('facili_tator_guides AS D', 'D.MID', 'M.MID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->select('M.ModuleName', 'C.CourseName', 'D.*', 'I.Name')
            ->get();

        $rem = [
            'id',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'IID',
            'url',
        ];

        $FormEngine = new FormEngine();

        $data = [
            'Page' => 'FacilitatorGuides.ViewGuides',
            'Title' => 'View Modular Facilitator Guides',
            'Desc' => ' Facilitator Guides',
            'Guides' => $Guides,
            'CourseName' => $CourseDetails->CourseName,
            'ModuleName' => $CourseDetails->ModuleName,
            'CID' => $CourseDetails->CID,
            'MID' => $CourseDetails->MID,
            'rem' => $rem,
            'Form' => $FormEngine->Form('facili_tator_guides'),
        ];

        return view('scrn', $data);
    }

    public function FacilitatorCheckList(Type $var = null)
    {
        $rem = [
            'id',
            'created_at',
            'updated_at',
            'uuid',
            'CID',
            'MID',
            'IID',
            'url',
            'Checklist',
        ];

        $FormEngine = new FormEngine();

        $Checklist = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            ->join('facili_tator_check_lists AS D', 'D.IID', 'I.IID')
            ->where('I.IID', \Auth::user()->UserID)
            ->select('M.ModuleName', 'C.CourseName', 'D.*', 'I.Name')
            ->get();

        $Details = DB::table('modules AS M')
            ->join('courses AS C', 'C.CID', 'M.CID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
            //->join('facili_tator_check_lists AS D', 'D.IID', 'I.IID')
            ->where('I.IID', \Auth::user()->UserID)
            ->select('M.ModuleName', 'M.MID', 'C.CourseName', 'C.CID', 'I.*')
            ->first();

        //  dd($Details->MID);

        $data = [
            'Page' => 'Checklist.Checklist',
            'Title' => 'Submit your facilitator checklist',
            'Desc' => 'facilitator checklist',
            'CourseName' => $Details->CourseName,
            'ModuleName' => $Details->ModuleName,
            'CID' => $Details->CID,
            'MID' => $Details->MID,
            'IID' => $Details->IID,
            'rem' => $rem,
            'Checklist' => $Checklist,
            'Form' => $FormEngine->Form('facili_tator_check_lists'),
        ];

        return view('scrn', $data);
    }
}