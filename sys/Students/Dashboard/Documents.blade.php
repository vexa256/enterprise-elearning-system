@isset($Mods)
    @foreach ($Mods as $data)
        <div class="modal fade" id="Docs{{ $data->id }}">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title"> Document notes attached to course
                            module

                            <span class="text-danger">

                                {{ $data->ModuleName }}

                            </span>

                        </h5>

                        <!--begin::Close-->
                        <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                            data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                        </div>
                        <!--end::Close-->
                    </div>

                    <div class="modal-body ">
                        <table
                            class="  table table-rounded table-bordered  border gy-3 gs-3">
                            <thead>
                                <tr
                                    class="fw-bold  text-gray-800 border-bottom border-gray-200">

                                    <th>Module Name</th>
                                    <th>Instructor</th>
                                    <th>Notes Title</th>
                                    <th>Brief Description</th>
                                    <th>View Notes</th>


                                </tr>
                            </thead>
                            <tbody>

                                <tr>


                                    <td>{{ $data->ModuleName }}</td>
                                    <td>{{ $data->Name }}</td>
                                    <td>{{ $data->NotesTitle }}</td>
                                    <td>{{ $data->BriefDescription }}</td>

                                    <td>
                                        <a data-doc="  {{ $data->NotesTitle }} ({{ $data->BriefDescription }})"
                                            data-source="{{ asset('assets/data/' . $data->DURL) }}"
                                            data-bs-toggle="modal" href="#PdfJS"
                                            class="btn btn-sm  PdfViewer btn-info">
                                            <i class="fas fa-file-pdf"
                                                aria-hidden="true"></i>
                                        </a>
                                    </td>

                                </tr>



                            </tbody>
                        </table>

                    </div>


                </div>
            </div>
        </div>
    @endforeach
@endisset


@include('pdf.PDFJS')
