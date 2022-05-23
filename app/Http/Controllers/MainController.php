<?php

namespace App\Http\Controllers;

use DB;
use Auth;
use App\Http\Controllers\SystemController;

class MainController extends Controller
{
    # protected $property;

    public function __construct()
    {
        $SystemController = new SystemController();

        $SystemController->ConvertMinutesToSeconds();
        $SystemController->CustomUacMiddleware();
    }

    public function LoadStudentViewApplication(Type $var = null)
    {
        $SystemController = new SystemController();
        return $SystemController->LoadStudentApprovalStatus();
    }

    public function SrlVirtualAccount(Type $var = null)
    {
        return redirect()->route('MgtCourses');
    }

    public function ApproveStudentApps(Type $var = null)
    {
        $Apps = DB::table('students AS S')
            ->join('courses AS C', 'C.CID', 'S.CID')
            ->join('users AS U', 'U.UserID', 'S.uuid')
            ->where('U.ApprovalStatus', 'false')
            ->select(
                'C.CourseName',
                'U.*',
                'C.CourseDescription',
                'S.*',
                'U.id AS Uid'
            )
            ->get();
        $data = [
            'Page' => 'Application.ApproveApplication',
            'Title' => 'Approve Student Course Application',
            'Desc' => 'Course Application Approval ',
            'Apps' => $Apps,
        ];

        return view('scrn', $data);
    }

    public function MarkAppAsApproved($id)
    {
        $users = DB::table('users')
            ->where('id', $id)
            ->update([
                'ApprovalStatus' => 'Pretest',
            ]);

        return redirect()
            ->back()
            ->with(
                'status',
                'The student application has been approved successfully'
            );
    }
    public function MarkAppAsDeclined($id)
    {
        $users = DB::table('users')
            ->where('id', $id)
            ->update([
                'ApprovalStatus' => 'Declined',
            ]);

        return redirect()
            ->back()
            ->with(
                'status',
                'The student application was declined successfully'
            );
    }
}