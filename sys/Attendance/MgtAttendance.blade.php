@include('Attendance.Stats')
<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">

    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Instructor Student Attendance Management', $Msg = null) !!}


</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'New', $Class = 'btn-danger', $Label = 'New Attendance Record Notes ', $Icon = 'fa-plus') }}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course</th>
                <th>Module</th>
                {{-- <th>Module Lecture Sessions</th> --}}
                <th>Instructor</th>
                <th>Student</th>
                <th>Phone</th>
                <th>Attendance</th>
                <th>Attendance Date</th>

            </tr>
        </thead>
        <tbody>
            @isset($Students)
                @foreach ($Students as $data)
                    <tr>

                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->ModuleName }}</td>
                        {{-- <td>{{ $data->TotalLessonSessions }}</td> --}}
                        <td>{{ $data->Name }}</td>
                        <td>{{ $data->Student }}</td>
                        <td>{{ $data->MobileNumber }}</td>

                        <td>
                            @if ($data->Attendance == 1)
                                Present
                            @else
                                Absent
                            @endif
                        </td>


                        <td>{!! date('F j, Y', strtotime($data->AttendanceRecordDate)) !!}</td>



                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->


@include('Attendance.NewAttedance')
