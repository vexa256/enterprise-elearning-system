<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CrudController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\OpenController;
use App\Http\Controllers\NotesController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\SystemController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\MarkExamsController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\TestSetterController;
use App\Http\Controllers\FacilitatorsController;

Route::controller(SystemController::class)->group(function () {
    Route::any('LoadPretestExam', 'LoadPretestExam')->name('LoadPretestExam');
});

Route::controller(OpenController::class)->group(function () {
    Route::any('NewStudent', 'NewStudent')->name('NewStudent');

    Route::any('/', 'ViewCourses')->name('ViewCourses');

    Route::any('dashboard', 'ViewCourses')->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    /**
     *
     */
    Route::controller(MarkExamsController::class)->group(function () {
        Route::any('MarkModularExams', 'MarkModularExams')->name(
            'MarkModularExams'
        );

        Route::any('MarkPracticalExams', 'MarkPracticalExams')->name(
            'MarkPracticalExams'
        );

        Route::any('MarkPostExams', 'MarkPostExams')->name('MarkPostExams');
    });

    Route::controller(AttendanceController::class)->group(function () {
        Route::any('AcceptStudent', 'AcceptStudent')->name('AcceptStudent');

        Route::any('MgtAttendance/{id}', 'MgtAttendance')->name(
            'MgtAttendance'
        );

        Route::any('StudentAttendance', 'StudentAttendance')->name(
            'StudentAttendance'
        );
    });

    Route::controller(StudentController::class)->group(function () {
        Route::any('ViewUserCourseStats', 'ViewUserCourseStats')->name(
            'ViewUserCourseStats'
        );

        Route::any('RecordExamAnswer', 'RecordExamAnswer')->name(
            'RecordExamAnswer'
        );

        Route::any('AttemptModularTest/{id}', 'AttemptModularTest')->name(
            'AttemptModularTest'
        );

        Route::any('AttemptPracticalTest/{id}', 'AttemptPracticalTest')->name(
            'AttemptPracticalTest'
        );

        Route::any('AttemptPostTest', 'AttemptPostTest')->name(
            'AttemptPostTest'
        );
    });

    Route::controller(FacilitatorsController::class)->group(function () {
        Route::any('ViewNotes', 'ViewNotes')->name('ViewNotes');

        Route::any('FacilitatorCheckList', 'FacilitatorCheckList')->name(
            'FacilitatorCheckList'
        );

        Route::any('ViewGuideSelection', 'ViewGuideSelection')->name(
            'ViewGuideSelection'
        );

        Route::any('ViewSelectModule', 'ViewSelectModule')->name(
            'ViewSelectModule'
        );

        Route::any('ViewCourseSelectionTime', 'ViewCourseSelectionTime')->name(
            'ViewCourseSelectionTime'
        );

        Route::any('ViewCourseTimeTable', 'ViewCourseTimeTable')->name(
            'ViewCourseTimeTable'
        );

        Route::any('ViewGuides/{id}', 'ViewGuides')->name('ViewGuides');

        Route::any('ViewTimeTable/{id}', 'ViewTimeTable')->name(
            'ViewTimeTable'
        );

        Route::any('MgtTimeTimetables/{id}', 'MgtTimeTimetables')->name(
            'MgtTimeTimetables'
        );

        Route::any(
            'AcceptCourseSelectionTime',
            'AcceptCourseSelectionTime'
        )->name('AcceptCourseSelectionTime');

        Route::any('SelectCourseTimetable', 'SelectCourseTimetable')->name(
            'SelectCourseTimetable'
        );

        Route::any('MgtGuides/{id}', 'MgtGuides')->name('MgtGuides');

        Route::any('AcceptGuideSelection', 'AcceptGuideSelection')->name(
            'AcceptGuideSelection'
        );

        Route::any('GuideSelectModule', 'GuideSelectModule')->name(
            'GuideSelectModule'
        );
    });

    Route::controller(NotesController::class)->group(function () {
        Route::any('MgtVideNotes/{id}', 'MgtVideNotes')->name('MgtVideNotes');

        Route::any(
            'AcceptVideoModuleSelection',
            'AcceptVideoModuleSelection'
        )->name('AcceptVideoModuleSelection');

        Route::any('VideoSelectModule', 'VideoSelectModule')->name(
            'VideoSelectModule'
        );

        Route::any('DeleteDoc/{id}/{TableName}', 'DeleteDoc')->name(
            'DeleteDoc'
        );

        Route::any('NewDoc', 'NewDoc')->name('NewDoc');

        Route::any('MgtCourseNotes/{id}', 'MgtCourseNotes')->name(
            'MgtCourseNotes'
        );

        Route::any(
            'AcceptNotesModuleSelection',
            'AcceptNotesModuleSelection'
        )->name('AcceptNotesModuleSelection');

        Route::any('NotesSelectModule', 'NotesSelectModule')->name(
            'NotesSelectModule'
        );
    });

    Route::controller(TestSetterController::class)->group(function () {
        Route::any('DeleteInstructor/{id}', 'DeleteInstructor')->name(
            'DeleteInstructor'
        );

        Route::any('NewInstructor', 'NewInstructor')->name('NewInstructor');

        Route::any('MgtInstructors/{id}', 'MgtInstructors')->name(
            'MgtInstructors'
        );

        Route::any(
            'AcceptInstructorModuleSelection',
            'AcceptInstructorModuleSelection'
        )->name('AcceptInstructorModuleSelection');

        Route::any(
            'SelectModuleToAttachInstructorTo',
            'SelectModuleToAttachInstructorTo'
        )->name('SelectModuleToAttachInstructorTo');

        Route::any('MgtModularTests/{id}', 'MgtModularTests')->name(
            'MgtModularTests'
        );

        Route::any('AcceptModuleSelection', 'AcceptModuleSelection')->name(
            'AcceptModuleSelection'
        );

        Route::any('ModularSelectModule', 'ModularSelectModule')->name(
            'ModularSelectModule'
        );

        Route::any('ModularSelectCourse', 'ModularSelectCourse')->name(
            'ModularSelectCourse'
        );

        Route::any('MgtPracticalTest/{id}', 'MgtPracticalTest')->name(
            'MgtPracticalTest'
        );

        Route::any('AcceptCoursePractical', 'AcceptCoursePractical')->name(
            'AcceptCoursePractical'
        );

        Route::any('SelectCoursePractical', 'SelectCoursePractical')->name(
            'SelectCoursePractical'
        );

        Route::any('MgtPostTest/{id}', 'MgtPostTest')->name('MgtPostTest');

        Route::any('AcceptCoursePostTest', 'AcceptCoursePostTest')->name(
            'AcceptCoursePostTest'
        );

        Route::any('SelectCourseForPostTest', 'SelectCourseForPostTest')->name(
            'SelectCourseForPostTest'
        );

        Route::any('MgtPreTest/{id}', 'MgtPreTest')->name('MgtPreTest');

        Route::any('AcceptCoursePretest', 'AcceptCoursePretest')->name(
            'AcceptCoursePretest'
        );

        Route::any('SelectCourseForPreTest', 'SelectCourseForPreTest')->name(
            'SelectCourseForPreTest'
        );
    });

    Route::controller(CourseController::class)->group(function () {
        Route::any('/MgtModules/{id}', 'MgtModules')->name('MgtModules');

        Route::any('/ModuleCourseSelected', 'ModuleCourseSelected')->name(
            'ModuleCourseSelected'
        );

        Route::get('/SelectCourse', 'SelectCourse')->name('SelectCourse');

        Route::get('/MgtCourses', 'MgtCourses')->name('MgtCourses');
    });

    Route::controller(MainController::class)->group(function () {
        // Route::get('/', 'SrlVirtualAccount')->name('SrlVirtualAccount');

        Route::get('/MarkAppAsDeclined/{id}', 'MarkAppAsDeclined')->name(
            'MarkAppAsDeclined'
        );

        Route::get('/MarkAppAsApproved/{id}', 'MarkAppAsApproved')->name(
            'MarkAppAsApproved'
        );

        Route::get('/ApproveStudentApps', 'ApproveStudentApps')->name(
            'ApproveStudentApps'
        );

        // Route::get('/dashboard', 'SrlVirtualAccount')->name('dashboard');
    });

    Route::controller(CrudController::class)->group(function () {
        Route::get('DeleteData/{id}/{TableName}', 'DeleteData')->name(
            'DeleteData'
        );

        Route::post('MassUpdate', 'MassUpdate')->name('MassUpdate');

        Route::post('MassInsert', 'MassInsert')->name('MassInsert');
    });
});

require __DIR__ . '/auth.php';