<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = ' Attempt the Modular Assessment', $Msg = null) !!}

    <input type="text" class="d-none ExamTimerValue" value="{{ $Timer }}">

    <div class="bg-dark fs-5 shadow-lg alert text-light fw-bolder">
        <span class="fs-5">
            Please Attempt Assessment Within The Assigned Time
        </span>
        <div class="spanTimer fs-3">
        </div>


    </div>
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">

    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course</th>
                <th>Course Module</th>
                <th>Assessment</th>
                <th>Duration (Mins)</th>
                <th class="bg-danger text-light fw-bolder">Description</th>
                <th>Student</th>

                <th>Attempt Test</th>
                <th>Start Date</th>
                <th>End Date</th>

            </tr>
        </thead>
        <tbody>
            @isset($Apps)
                @foreach ($Apps as $data)
                    <tr>
                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->ModuleName }}</td>
                        <td> Modular Assessment</td>
                        <td>{{ $data->DurationInMinutes / 60000 }}
                        </td>
                        <td>{{ $data->TestBriefDescription }}
                        </td>

                        <td>{{ $data->Name }}
                        </td>


                        <td class="ToggleButton">
                            <a class="btn TimerRemover StartExamTimer btn-dark shadow-lg bt-lg"
                                href="#AnswerQtn">

                                Start Exam
                            </a>

                        </td>


                        <td>{!! date('F j, Y', strtotime($data->FromDate)) !!}
                        </td>

                        <td>{!! date('F j, Y', strtotime($data->ToDate)) !!}
                        </td>


                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->


@include(
    'Students.ModularTests.RecordAnswer'
)
{{-- @include('Students.RecordAnswer') --}}
