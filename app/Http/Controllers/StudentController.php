<?php

namespace App\Http\Controllers;
use Auth;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\SystemController;

class StudentController extends Controller
{
    public function __construct()
    {
        $SystemController = new SystemController();
        $SystemController->CustomUacMiddleware();
        $SystemController->ConvertMinutesToSeconds();
        $SystemController->ConvertMinutesToSecondsPostTest();
        $SystemController->ConvertMinutesToSecondsPracTest();
        $SystemController->ConvertMinutesToSecondsModularTest();
    }

    public function ViewUserCourseStats(Type $var = null)
    {
        $PostExams = DB::table('post_tests')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->get();

        $PracticalExams = DB::table('practical_tests')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->get();

        $TimeTable = DB::table('course_time_tables')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->first();

        $ModularExams = DB::table('modular_tests AS T')
            ->where('T.CID', Auth::user()->CourseAppliedFor)
            ->join('modules AS M', 'M.MID', 'T.MID')
            ->select('T.*', 'M.ModuleName', 'M.id AS ModuleID')
            ->get();

        $Mods = DB::table('modules AS M')
            ->where('M.CID', Auth::user()->CourseAppliedFor)
            ->join('video_notes AS V', 'V.MID', 'M.MID')
            ->join('document_notes AS D', 'D.MID', 'M.MID')
            ->join('instructors AS I', 'I.MID', 'M.MID')
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

        $MyCourse = DB::table('courses')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->first();

        $Modules = DB::table('modules')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->count();

        $ModularTests = DB::table('modular_tests')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->count();

        $PostTests = DB::table('post_tests')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->count();

        $Practicals = DB::table('practical_tests')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->count();
        $data = [
            'Page' => 'Students.Dashboard.StudentConsole',
            'Title' => 'Student Course Dashboard',
            'Desc' => 'Your course is ' . $MyCourse->CourseName,
            'Modules' => $Modules,
            'Practicals' => $Practicals,
            'ModularTests' => $ModularTests,
            'PostTests' => $PostTests,
            'PostExams' => $PostExams,
            'Mods' => $Mods,
            'ModularExams' => $ModularExams,
            'PracticalExams' => $PracticalExams,
            'TimeTable' => $TimeTable,
        ];

        return view('scrn', $data);
    }

    public function AttemptPracticalTest($id)
    {
        $id = DB::table('practical_tests')
            ->where('uuid', $id)
            ->first();

        $counter = DB::table('attempt_practical_tests')
            //->where('AttemptStatus', 'true')
            //->where('PracticalTestID', $id->uuid)
            ->where('TimerStarted', 'true')
            ->where('UserID', Auth::user()->UserID)
            ->count();

        if ($counter > 0) {
            return redirect()
                ->route('ViewUserCourseStats')
                ->with(
                    'status',
                    'You have already attempted this Modular Assessment.'
                );
        }
        $MyCourse = DB::table('courses')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->first();

        $Timer = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('practical_tests AS P', 'P.CID', 'S.CID')
            ->where('P.uuid', $id->uuid)
            ->select('P.*')
            ->first();

        $Apps = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('practical_tests AS P', 'P.CID', 'S.CID')
            ->where('P.uuid', $id->uuid)
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('users AS U', 'U.UserID', 'S.uuid')
            ->select(
                'P.*',
                'U.name',
                // 'M.ModuleName',
                'S.Name',
                'S.ParentOrganization',
                'S.Email',
                'S.Nationality',
                'C.CourseName'
            )
            ->limit(1)
            ->get();

        $data = [
            'Page' => 'Students.PracTests.AttemptPracTest',
            'Title' =>
                'Attempt  The Selected Practical Test, Please Read the Instructions',
            'Desc' => '' . $MyCourse->CourseName,
            'Apps' => $Apps,
            'PracticalTest' => 'true',
            'rem' => ['test'],
            'Form' => $Timer,
            'Timer' => $Timer->DurationInMinutes,
        ];

        return view('scrn', $data);
    }

    public function AttemptModularTest($id)
    {
        $MID = DB::table('modules')
            ->where('id', $id)
            ->first();

        $counter = DB::table('attempt_modular_tests')
            ->where('AttemptStatus', 'true')
            ->where('MID', $MID->MID)
            ->where('TimerStarted', 'true')
            ->where('UserID', Auth::user()->UserID)
            ->count();

        if ($counter > 0) {
            return redirect()
                ->route('ViewUserCourseStats')
                ->with(
                    'status',
                    'You have already attempted this Modular Assessment.'
                );
        }

        $MyCourse = DB::table('courses')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->first();

        $Timer = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('modular_tests AS P', 'P.CID', 'S.CID')
            ->where('P.MID', $MID->MID)
            ->select('P.*')
            ->first();

        $Apps = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('modular_tests AS P', 'P.CID', 'S.CID')
            ->join('modules AS M', 'M.MID', 'P.MID')
            ->where('M.MID', $MID->MID)
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('users AS U', 'U.UserID', 'S.uuid')
            ->select(
                'P.*',
                'U.name',
                'M.ModuleName',
                'S.Name',
                'S.ParentOrganization',
                'S.Email',
                'S.Nationality',
                'C.CourseName'
            )
            ->limit(1)
            ->get();

        $data = [
            'Page' => 'Students.ModularTests.AttemptModularTest',
            'Title' =>
                'Attempt The Selected Modular Test, Please Read the Instructions',
            'Desc' => '' . $MyCourse->CourseName,
            'Apps' => $Apps,
            'ModularTest' => 'true',
            'rem' => ['test'],
            'Form' => $Timer,
            'Timer' => $Timer->DurationInMinutes,
        ];

        return view('scrn', $data);
    }

    public function AttemptPostTest(Type $var = null)
    {
        $counter = DB::table('attempt_post_tests')
            ->where('AttemptStatus', 'true')
            ->where('TimerStarted', 'true')
            ->where('UserID', Auth::user()->UserID)
            ->count();

        if ($counter > 0) {
            return redirect()
                ->route('ViewUserCourseStats')
                ->with(
                    'status',
                    'You have already attempted this Post Assessment.'
                );
        }

        $MyCourse = DB::table('courses')
            ->where('CID', Auth::user()->CourseAppliedFor)
            ->first();
        $Timer = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('post_tests AS P', 'P.CID', 'S.CID')
            ->select('P.*')
            ->first();

        $Apps = DB::table('students AS S')
            ->where('S.uuid', Auth::user()->UserID)
            ->join('post_tests AS P', 'P.CID', 'S.CID')
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
            'Page' => 'Students.PostTests.AttemptPostTest',
            'Title' =>
                'Attempt The Selected Post Test, Please Read the Instructions',
            'Desc' => '' . $MyCourse->CourseName,
            'Apps' => $Apps,
            'PostTest' => 'true',
            'rem' => ['test'],
            'Form' => $Timer,
            'Timer' => $Timer->DurationInMinutes,
        ];

        return view('scrn', $data);
    }

    public function RecordExamAnswer(Request $request)
    {
        $validated = $request->validate([
            '*' => 'required',
            'files' => 'nullable',
        ]);

        if ($request->TableName == 'attempt_post_tests') {
            $counter = DB::table('attempt_post_tests')
                ->where('AttemptStatus', 'true')
                ->where('UserID', Auth::user()->UserID)
                ->count();

            if ($counter > 0) {
                return redirect()
                    ->route('ViewUserCourseStats')
                    ->with(
                        'status',
                        'You have already attempted this Post Assessment.'
                    );
            } else {
                DB::table($request->TableName)
                    ->where('uuid', $request->uuid)

                    ->update(
                        $request->except(['_token', 'TableName', 'id', 'files'])
                    );

                return redirect()
                    ->route('ViewUserCourseStats')
                    ->with(
                        'status',
                        'You have successfully submitted your assessment, Results will appear in your scoreboard once marking is done'
                    );
            }
        } elseif ($request->TableName == 'attempt_practical_tests') {
            $counter = DB::table('attempt_practical_tests')
                ->where('AttemptStatus', 'true')
                ->where('UserID', Auth::user()->UserID)
                ->count();

            if ($counter > 0) {
                return redirect()
                    ->route('ViewUserCourseStats')
                    ->with(
                        'status',
                        'You have already attempted this Practical Assessment.'
                    );
            } else {
                DB::table($request->TableName)
                    ->where('uuid', $request->uuid)

                    ->update(
                        $request->except(['_token', 'TableName', 'id', 'files'])
                    );

                return redirect()
                    ->route('ViewUserCourseStats')
                    ->with(
                        'status',
                        'You have successfully submitted your assessment, Results will appear in your scoreboard once marking is done'
                    );
            }
        } elseif ($request->TableName == 'attempt_modular_tests') {
            $counter = DB::table('attempt_modular_tests')
                ->where('AttemptStatus', 'true')
                ->where('MID', $request->MID)
                ->where('UserID', Auth::user()->UserID)
                ->count();

            if ($counter > 0) {
                return redirect()
                    ->back()
                    ->with(
                        'status',
                        'You have already attempted this Modular Assessment.'
                    );
            } else {
                DB::table($request->TableName)
                    ->where('uuid', $request->uuid)

                    ->update(
                        $request->except(['_token', 'TableName', 'id', 'files'])
                    );

                return redirect()
                    ->route('ViewUserCourseStats')
                    ->with(
                        'status',
                        'You have successfully submitted your assessment, Results will appear in your scoreboard once marking is done'
                    );
            }
        }
    }
}