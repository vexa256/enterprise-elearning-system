@isset($Courses)
    @foreach ($Courses as $data)
        <div class="modal fade" id="TestQn{{ $data->id }}">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title">

                            Review and Score the selected assessments for the
                            student

                            <span class="text-danger fw-bolder">
                                {{ $data->StudentName }}
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
                        <form action="{{ route('MassUpdate') }}"
                            class="row" method="POST">

                            <div class="col-md-12">
                                <div class="mt-3  mb-3 col-md-12  ">
                                    <label id="label" for=""
                                        class=" required form-label">Score
                                        Student</label>
                                    <input required class="form-control IntOnlyNow"
                                        type="text" name="UserScore" id="">
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mt-3  mb-3 col-md-12  ">
                                    <label id="label" for=""
                                        class=" required form-label">Test
                                        Questions</label>
                                    <textarea class="editorme">

                                    {!! $data->TestQuestion !!}

                            </textarea>
                                </div>
                            </div>


                            <input type="hidden" name="MarkingStatus" value="true">

                            <input type="hidden" name="id"
                                value="{{ $data->id }}">

                            @csrf
                            <input type="hidden" name="TableName"
                                value="attempt_modular_tests">


                            <div class="col-md-12">
                                <div class="mt-3  mb-3 col-md-12  ">
                                    <label id="label" for=""
                                        class=" required form-label">User
                                        Answer</label>
                                    <textarea class="editorme">

                                    {!! $data->UserAnswer !!}

                            </textarea>
                                </div>
                            </div>

                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-info"
                            data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-dark">Save
                            Changes</button>

                        </form>

                    </div>

                </div>
            </div>
        </div>
    @endforeach
@endisset
