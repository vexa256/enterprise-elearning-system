<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Hello ' . Auth::user()->name . ' This interface monitors the status of your course application. ', $Msg = null) !!}


    {!! Alert($icon = 'fa-info', $class = 'alert-danger', $Title = 'After your application\'s approval, You will be redirected to the Course Pre-Test Assessment', $Msg = null) !!}
</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">

    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Student</th>
                <th>Course Applied For</th>
                <th class="bg-danger text-light fw-bolder">Approval Status</th>

                <th>Institution</th>
                <th>Mobile Phone</th>
                <th>Email</th>
                <th>Nationality</th>
                <th>Gender</th>
                <th>Application Date</th>
                <th>Course Details</th>




            </tr>
        </thead>
        <tbody>
            @isset($Apps)
                @foreach ($Apps as $data)
                    <tr>

                        <td>{{ $data->name }}</td>
                        <td>{{ $data->CourseName }}</td>

                        @if ($data->ApprovalStatus == 'false')
                            <td class="bg-dark text-light">Application Pending
                                Approval</td>
                        @else
                            <td class="bg-dark text-light">
                                {{ $data->ApprovalStatus }}</td>
                        @endif


                        <td>{{ $data->institution }}</td>
                        <td>{{ $data->phone }}</td>
                        <td>{{ $data->email }}</td>
                        <td>{{ $data->nationality }}</td>
                        <td>{{ $data->gender }}</td>
                        <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>


                        <td>
                            <a data-bs-toggle="modal"
                                class="btn btn-dark shadow-lg btn-sm"
                                href="#Desc{{ $data->id }}">

                                <i class="fas fa-binoculars" aria-hidden="true"></i>
                            </a>

                        </td>




                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->



@isset($Apps)
    @include('viewer.viewer', [
        'PassedData' => $Apps,
        'Title' => 'View  Description of the course',
        'DescriptionTableColumn' => 'CourseDescription',
    ])
@endisset
