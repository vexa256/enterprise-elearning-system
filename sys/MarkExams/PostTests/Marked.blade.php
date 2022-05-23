<div class="modal fade" id="Marked">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Marked Post Test Assessments
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
                    class=" mytable table table-rounded table-bordered  border gy-3 gs-3">
                    <thead>
                        <tr
                            class="fw-bold  text-gray-800 border-bottom border-gray-200">
                            <th>Student Name</th>
                            <th class="bg-danger text-light fw-bolder">Score
                            </th>
                            <th>Course Name</th>
                            <th>Module Name</th>
                            <th>Assessment</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Date Attempted</th>



                        </tr>
                    </thead>
                    <tbody>
                        @isset($Marked)
                            @foreach ($Marked as $data)
                                <tr>

                                    <td>{{ $data->StudentName }}</td>
                                    <td class="bg-danger text-light fw-bolder">
                                        {{ $data->UserScore }}
                                    </td>
                                    <td>{{ $data->CourseName }}</td>
                                    <td>{{ $data->ModuleName }}</td>
                                    <td>{{ $data->TestBriefDescription }}</td>

                                    <td>{!! date('F j, Y', strtotime($data->FromDate)) !!}</td>
                                    <td>{!! date('F j, Y', strtotime($data->ToDate)) !!}</td>

                                    <td>{!! date('F j, Y', strtotime($data->created_at)) !!}</td>



                                </tr>
                            @endforeach
                        @endisset



                    </tbody>
                </table>




            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-info"
                    data-bs-dismiss="modal">Close</button>

            </div>

        </div>
    </div>
</div>
