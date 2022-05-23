<div class="row">
    <div class="col-12">
        <div class="card-body pt-3 bg-light shadow-lg table-responsive">
            {!! Alert($icon = 'fa-info', $class = 'alert-primary', $Title = 'Your Course Modules And Course Materials', $Msg = null) !!}
        </div>
        <div class="card-body pt-3 bg-light shadow-lg table-responsive">
            @include('Students.Dashboard.Btns')
            <table
                class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
                <thead>
                    <tr
                        class="fw-bold  text-gray-800 border-bottom border-gray-200">
                        <th>Module Name</th>
                        <th>Module Description</th>
                        <th class="bg-dark text-light"> Video Notes </th>
                        <th class="bg-danger fw-bolder text-light"> Document
                            Notes </th>



                    </tr>
                </thead>
                <tbody>
                    @isset($Mods)
                        @foreach ($Mods as $data)
                            <tr>

                                <td>{{ $data->ModuleName }}</td>


                                <td>
                                    <a data-bs-toggle="modal"
                                        class="btn btn-danger shadow-lg btn-sm"
                                        href="#Desc{{ $data->id }}">

                                        <i class="fas fa-binoculars"
                                            aria-hidden="true"></i>
                                    </a>

                                </td>

                                <td>
                                    <a data-bs-toggle="modal"
                                        class="btn btn-dark shadow-lg btn-sm"
                                        href="#VideoNotes{{ $data->id }}">

                                        <i class="fas fa-binoculars"
                                            aria-hidden="true"></i>
                                    </a>

                                </td>

                                <td>
                                    <a data-bs-toggle="modal"
                                        class="btn btn-warning shadow-lg btn-sm"
                                        href="#Docs{{ $data->id }}">

                                        <i class="fas fa-binoculars"
                                            aria-hidden="true"></i>
                                    </a>

                                </td>





                            </tr>
                        @endforeach
                    @endisset



                </tbody>
            </table>
        </div>

    </div>
</div>
@include('Students.Dashboard.Videos')
@include('Students.Dashboard.Documents')
