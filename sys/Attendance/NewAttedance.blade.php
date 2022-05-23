<div class="modal fade" id="New">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
        <div class="modal-content">
            <div class="modal-header bg-gray">
                <h5 class="modal-title"> Register a new attendance record for
                    the student
                    <span class="text-danger">
                        {{ $StudentName }}
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

                <form action="{{ route('MassInsert') }}" class="row"
                    method="POST">
                    @csrf
                    <div class="row">
                        <div class="mb-3 col-md-12   my-5">
                            <label id="label" for=""
                                class=" required form-label">Select
                                Attendance Option</label>
                            <select required name="Attendance"
                                class="form-select form-select-solid"
                                data-control="select2"
                                data-placeholder="Select a option">
                                <option>Attendance Option</option>
                                <option value="1">Present</option>
                                <option value="0">Absent</option>


                            </select>

                        </div>

                        <input type="hidden" name="created_at"
                            value="{{ date('Y-m-d h:i:s') }}">

                        <input type="hidden" name="TableName"
                            value="student_attendances">

                        @foreach ($Form as $data)
                            @if ($data['type'] == 'string')
                                {{ CreateInputText($data, $placeholder = null, $col = '12') }}
                            @elseif ('smallint' == $data['type'] || 'bigint' === $data['type'] || 'integer' == $data['type'] || 'bigint' == $data['type'])
                                {{ CreateInputInteger($data, $placeholder = null, $col = '4') }}
                            @elseif ($data['type'] == 'date' || $data['type'] == 'datetime')
                                {{ CreateInputDate($data, $placeholder = null, $col = '6') }}
                            @endif
                        @endforeach

                    </div>

                    <div class="row">
                        @foreach ($Form as $data)
                            @if ($data['type'] == 'text')
                                {{ CreateInputEditor($data, $placeholder = null, $col = '12') }}
                            @endif
                        @endforeach

                    </div>


                    <input type="hidden" name="CID" value="{{ $CID }}">
                    <input type="hidden" name="MID" value="{{ $MID }}">
                    <input type="hidden" name="IID" value="{{ $IID }}">
                    <input type="hidden" name="StudentID"
                        value="{{ $StudentID }}">


                    <input type="hidden" name="uuid"
                        value="{{ md5(\Hash::make(uniqid() . 'AFC' . date('Y-m-d H:I:S'))) }}">




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
