<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> SRL Uganda Student Course Application


                    <small class="text-danger">

                        On form submission, An account is created for you with
                        the
                        default password and username as the email provided.
                        This must be changed after you login

                    </small>


                </h5>

                <!--begin::Close-->
                <div class="btn btn-icon btn-sm btn-active-light-primary ms-2"
                    data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-2x fa-times" aria-hidden="true"></i>
                </div>
                <!--end::Close-->
            </div>

            <div class="modal-body ">

                <form action="{{ route('NewStudent') }}" class="row"
                    method="POST" enctype="multipart/form-data"> @csrf
                    <div class="row">

                        @include(
                            'ViewCourses.SelectCourse'
                        )

                        <div class="mt-3  mb-3 col-md-4  ">
                            <label id="label" for=""
                                class=" required form-label">Gender</label>
                            <select required name="Gender"
                                class="form-select  " data-control="select2"
                                data-placeholder="Select an option">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>



                            </select>

                        </div>


                        <input type="hidden" name="created_at"
                            value="{{ date('Y-m-d h:i:s') }}">

                        <input type="hidden" name="TableName" value="students">

                        @foreach ($Form as $data)
                            @if ($data['type'] == 'string')
                                {{ CreateInputText($data, $placeholder = null, $col = '4') }}
                            @elseif ('smallint' == $data['type'] || 'bigint' === $data['type'] || 'integer' == $data['type'] || 'bigint' == $data['type'])
                                {{ CreateInputInteger($data, $placeholder = null, $col = '4') }}
                            @elseif ($data['type'] == 'date' || $data['type'] == 'datetime')
                                {{ CreateInputDate($data, $placeholder = null, $col = '4') }}
                            @endif
                        @endforeach

                        <div class="mt-3  mb-3 col-md-4 ">
                            <label id="label" for=""
                                class=" required form-label">Upload Your CV
                                (Only PDF )</label>

                            <input type="file" required name="CV"
                                class="form-control" id="">

                        </div>

                        <div class="mt-3  mb-3 col-md-4 ">
                            <label id="label" for=""
                                class=" required form-label">Upload Your ID
                                Document (Only PDF )</label>

                            <input type="file" required name="StudentID"
                                class="form-control" id="">

                        </div>



                    </div>

                    <div class="row">
                        <div class="mt-5  mb-5 col-md-12 ">
                            <label id="label" for=""
                                class=" required form-label">Briefly describe
                                your reasons for applying for this course and
                                how
                                you are hoping it will help you and your
                                organization. </label>
                            <textarea class="editorme" name="ReasonsForJoining" id="" cols="30"
                                rows="10"></textarea>

                        </div>

                        <div class="mt-5  mb-5 col-md-12 ">
                            <label id="label" for=""
                                class=" required form-label">Please describe any
                                special needs of which we should be aware
                                (Disability, etc) </label>
                            <textarea class="editorme" name="SpecialNeed" id="" cols="30" rows="10">

                                Special Needs

                            </textarea>

                        </div>
                        @foreach ($Form as $data)
                            @if ($data['type'] == 'text')
                                {{ CreateInputEditor($data, $placeholder = null, $col = '12') }}
                            @endif
                        @endforeach

                    </div>



                    <input type="hidden" name="uuid"
                        value="{{ \Hash::make(uniqid() . 'AFC' . date('Y-m-d H:I:S')) }}">




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
