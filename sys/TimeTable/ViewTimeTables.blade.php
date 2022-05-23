<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'View the timetable for the selected course', $Msg = null) !!}


</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">

    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th>Time Table Title</th>
                <th>View Timetable</th>





            </tr>
        </thead>
        <tbody>
            @isset($TimesTables)
                @foreach ($TimesTables as $data)
                    <tr>

                        <td>{{ $CourseName }}</td>
                        <td>{{ $data->TimeTableTitle }}</td>


                        <td>
                            <a data-doc="  {{ $data->TimeTableTitle }} "
                                data-source="{{ asset('assets/data/' . $data->url) }}"
                                data-bs-toggle="modal" href="#PdfJS"
                                class="btn btn-sm  PdfViewer btn-info"> <i
                                    class="fas fa-file-pdf" aria-hidden="true"></i>
                            </a>
                        </td>








                    </tr>
                @endforeach
            @endisset



        </tbody>
    </table>
</div>
<!--end::Card body-->



@include('pdf.PDFJS')
