@if (Auth::user()->role == 'admin')
    <div data-kt-menu-trigger="click"
        class="menu-item viewer_only menu-accordion">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas text-light fw-bolder fa-2x me-1 fa-person-booth"
                    aria-hidden="true"></i>
            </span>
            <span class="menu-title ms-2 fs-6">Instructor Actions</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">

            <?php
            MenuItem($link = route('ViewCourseTimeTable'), $label = 'Course Timetable');

            MenuItem($link = route('ViewNotes'), $label = 'Videos and Notes ');

            MenuItem($link = route('ViewSelectModule'), $label = 'Facilitator Guides');

            MenuItem($link = route('FacilitatorCheckList'), $label = 'Facilitator Checklist');

            MenuItem($link = route('StudentAttendance'), $label = 'Attendance Registration', $class = 'LOCKED');

            // MenuItem($link = '#', $label = 'Test Schedule', $class = 'LOCKED');

            MenuItem($link = route('MarkModularExams'), $label = 'Mark Modular Tests', $class = 'LOCKED');

            MenuItem($link = route('MarkPostExams'), $label = 'Mark Post Tests', $class = 'LOCKED');

            MenuItem($link = route('MarkPracticalExams'), $label = 'Mark Practical Tests', $class = 'LOCKED');

            MenuItem($link = '#', $label = 'Student Scoreboard', $class = 'Number');

            //MenuItem($link = route('RestockDrugInventory'), $label = 'Insurance Claims');

            ?>


        </div>
    </div>
    <div data-kt-menu-trigger="click"
        class="menu-item viewer_only menu-accordion">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas text-light fw-bolder fa-2x me-1 fa-user-astronaut"
                    aria-hidden="true"></i>
            </span>
            <span class="menu-title ms-2 fs-6">Course Settings</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">

            <?php
            MenuItem($link = route('MgtCourses'), $label = 'Courses');

            MenuItem($link = route('SelectCourse'), $label = 'Course Modules');

            MenuItem($link = route('SelectCourseTimetable'), $label = 'Course Timetable');

            MenuItem($link = route('GuideSelectModule'), $label = 'Facilitator Guides');

            MenuItem($link = route('NotesSelectModule'), $label = 'Document Notes');

            MenuItem($link = route('VideoSelectModule'), $label = 'Video Notes');

            MenuItem($link = route('SelectCourseForPreTest'), $label = 'Course Pre-Tests');

            MenuItem($link = route('SelectCourseForPostTest'), $label = 'Course Post-Tests');

            MenuItem($link = route('SelectCoursePractical'), $label = 'Course Practical Test');

            MenuItem($link = route('ModularSelectCourse'), $label = 'Modular Tests');

            MenuItem($link = route('SelectModuleToAttachInstructorTo'), $label = 'Module Instructors');
            ?>


        </div>
    </div>

    <div data-kt-menu-trigger="click"
        class="menu-item viewer_only menu-accordion">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas text-light fw-bolder fa-2x me-1 fa-chalkboard"
                    aria-hidden="true"></i>
            </span>
            <span class="menu-title ms-2 fs-6">Course Core Actions</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">

            <?php

            MenuItem($link = route('ApproveStudentApps'), $label = 'Approve Students');

            MenuItem($link = '#', $label = 'Student Certification', $class = 'LOCKED');

            //MenuItem($link = route('RestockDrugInventory'), $label = 'Insurance Claims');

            ?>


        </div>
    </div>
@endif
