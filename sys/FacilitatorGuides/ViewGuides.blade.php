<!--begin::Card body-->
<div class="card-body pt-3 bg-light shadow-lg table-responsive">
    {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = $CourseName . ' (' . $ModuleName . ')', $Msg = null) !!}


</div>
<div class="card-body pt-3 bg-light shadow-lg table-responsive">

    <table class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
        <thead>
            <tr class="fw-bold  text-gray-800 border-bottom border-gray-200">
                <th>Course Name</th>
                <th>Module Name</th>
                <th>Facilitator Guide Title</th>
                <th>View Guide</th>



            </tr>
        </thead>
        <tbody>
            @isset($Guides)
                @foreach ($Guides as $data)
                    <tr>

                        <td>{{ $CourseName }}</td>
                        <td>{{ $ModuleName }}</td>
                        <td>{{ $data->FacilitatorGuideTitle }}</td>


                        <td>
                            <a data-doc="  {{ $data->FacilitatorGuideTitle }} "
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
