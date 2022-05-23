<div class="modal fade" id="PostExams">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Post Tests Attached to the course
                    your enrolled in. |

                    <span class="text-danger">
                        The attempt test button will only become active on the
                        due date
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
                            <th>Post Test</th>
                            <th>Time Duration</th>
                            <th>Starts On</th>
                            <th>Ends On</th>
                            <th>Attempt Post Test</th>





                        </tr>
                    </thead>
                    <tbody>
                        @isset($PostExams)
                            @foreach ($PostExams as $data)
                                <tr>


                                    <td>{{ $data->TestBriefDescription }}</td>
                                    <td>{{ $data->DurationInMinutes / 60000 }}
                                        Minutes
                                    </td>

                                    <td>{!! date('F j, Y', strtotime($data->FromDate)) !!}</td>

                                    <td>{!! date('F j, Y', strtotime($data->ToDate)) !!}</td>



                                    <td>
                                        <a target="_blank"
                                            class="btn btn-dark shadow-lg btn-sm"
                                            href="{{ route('AttemptPostTest') }}">

                                            Attempt Test
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
</div>
