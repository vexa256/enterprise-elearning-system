<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Mark submitted post tests for the courses you instruct | Refer to the facilitators guide for more information', $Msg = null) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {{ HeaderBtn($Toggle = 'Incomplete', $Class = 'btn-danger', $Label = 'Incomplete Post Tests', $Icon = 'fa-times') }}

    {{ HeaderBtn($Toggle = 'Marked', $Class = 'btn-dark', $Label = ' Marked Post Tests', $Icon = 'fa-check') }}
    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Student Name</th>
                <th>Course Name</th>
                <th>Module Name</th>
                <th>Assessment</th>
                <th>From Date</th>
                <th>To Date</th>
                <th>Date Attempted</th>
                <th class="bg-dark text-light"> Mark Assessment </th>




            </tr>
        </thead>
        <tbody>
            @isset($Courses)
                @foreach ($Courses as $data)
                    <tr>

                        <td>{{ $data->StudentName }}</td>
                        <td>{{ $data->CourseName }}</td>
                        <td>{{ $data->ModuleName }}</td>
                        <td>{{ $data->TestBriefDescription }}</td>

                        <td>{!! date('F j, Y', strtotime($data->FromDate)) !!}</td>
                        <td>{!! date('F j, Y', strtotime($data->ToDate)) !!}</td>

                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>


                        <td>
                            <a data-bs-toggle="modal"
                                class="btn btn-dark shadow-lg btn-sm"
                                href="#TestQn{{ $data->id }}">

                                Mark
                            </a>

                        </td>


                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>


@include(
    'MarkExams.PostTests.ViewTestQuestion'
)

@include('MarkExams.PostTests.Incomplete')
@include('MarkExams.PostTests.Marked')
