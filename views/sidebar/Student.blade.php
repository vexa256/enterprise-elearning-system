@auth
    @if (Auth::user()->role != 'admin' || Auth::user()->role != 'instructor')
        <div data-kt-menu-trigger="click"
            class="menu-item menu-accordion viewer_only">
            <span class="menu-link">
                <span class="menu-icon">
                    <i class="fas text-light fw-bolder fa-2x me-1 fa-people-carry"
                        aria-hidden="true"></i>
                </span>
                <span class="menu-title ms-2 fs-6">Student Actions</span>
                <span class="menu-arrow"></span>
            </span>
            <div class="menu-sub menu-sub-accordion menu-active-bg">

                <?php

                MenuItem($link = route('ViewUserCourseStats'), $label = 'Home');
                // MenuItem($link = "#", $label = 'Course Application Form');
                // MenuItem($link = "#", $label = 'Attempt Pre Test');
                ?>


            </div>
        </div>
    @endif
@endauth

{{-- @auth
    <div data-kt-menu-trigger="click" class="menu-item menu-accordion viewer_only">
        <span class="menu-link">
            <span class="menu-icon">
                <i class="fas text-light fw-bolder fa-2x me-1 fa-chalkboard-teacher"
                    aria-hidden="true"></i>
            </span>
            <span class="menu-title ms-2 fs-6">Virtual Class Room</span>
            <span class="menu-arrow"></span>
        </span>
        <div class="menu-sub menu-sub-accordion menu-active-bg">

            <?php

            // MenuItem($link = '#', $label = 'Attend Lectures', $class = 'LOCKED');
            // MenuItem($link = '#', $label = 'Daily Training Evaluation', $class = 'LOCKED');

            // MenuItem($link = '#', $label = 'Overall Training Evaluation', $class = 'LOCKED');
            // MenuItem($link = '#', $label = 'Contact Instructor', $class = 'LOCKED');
            // MenuItem($link = '#', $label = ' Course Materials', $class = 'LOCKED');
            // MenuItem($link = '#', $label = 'Attempt Modular Tests', $class = 'LOCKED');
            // MenuItem($link = '#', $label = 'Attempt Practical Test', $class = 'LOCKED');
            // MenuItem($link = '#', $label = 'Attempt Post Test', $class = 'LOCKED');
            // MenuItem($link = '#', $label = 'Course Scoreboard', $class = 'LOCKED');
            // MenuItem($link = '#', $label = 'Course Certification', $class = 'LOCKED');
            ?>


        </div>
    </div>

@endauth --}}
