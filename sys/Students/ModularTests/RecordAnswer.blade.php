@isset($Apps)
    @foreach ($Apps as $data)
        <div class="modal fade" id="AnswerQtn">
            <div class="modal-dialog modal-dialog-scrollable modal-fullscreen">
                <div class="modal-content">
                    <div class="modal-header bg-gray">
                        <h5 class="modal-title"> Hello,
                            {{ Auth::user()->name }},
                            Use this editor to record your answers to the modular
                            assessment

                            <span class="spanTimer fs-3" class="text-danger">
                            </span>
                        </h5>

                        <button type="button" class="btn btn-info"
                            data-bs-dismiss="modal">Close</button>
                        <form action="{{ route('RecordExamAnswer') }}"
                            class="row" method="POST">
                            <button type="submit" class="btn btn-dark">Submit
                                Answer</button>



                    </div>

                    <div class="modal-body ">

                        @csrf
                        <div class="row">


                            <input type="hidden" id="TableName" name="TableName"
                                value="attempt_modular_tests">

                            <input type="hidden" id="AttemptStatus"
                                name="AttemptStatus" value="true">



                            <input type="hidden" id="created_at" name="created_at"
                                value="{{ date('Y-m-d') }}">



                            <input type="hidden" id="status" name="status"
                                value="true">

                            <input type="hidden" id="uuid" name="uuid"
                                value="{{ Hash::make(Auth::user()->UserID . date('Y-m-d')) }}">

                            <input type="hidden" id="CID" name="CID"
                                value="{{ $Form->CID }}">


                            <input type="hidden" id="MID" name="MID"
                                value="{{ $Form->MID }}">

                            <input type="hidden" id="ModularTestID"
                                name="ModularTestID" value="{{ $Form->uuid }}">

                            <input type="hidden" id="UserID" name="UserID"
                                value="{{ Auth::user()->UserID }}">

                            <input type="hidden" id="TestQuestion"
                                name="TestQuestion"
                                value="{{ $Form->TestQuestion }}">

                            <div class="col-md-12">
                                <div class="mt-3  mb-3 col-md-12  ">
                                    <label id="label" for=""
                                        class=" required form-label">Questions</label>
                                    <textarea class="editorme">

                                        {!! $data->TestQuestion !!}

                                </textarea>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="mt-3  mb-3 col-md-12  ">
                                    <label id="label" for=""
                                        class=" required form-label">Record
                                        Answer</label>

                                    <textarea name="UserAnswer" class="editorme">

                                            <h1>TYPE YOUR ANSWERS HERE</h1>
                                    </textarea>


                                </div>
                            </div>
                            </form>
                        </div>



                    </div>
                </div>
            </div>
    @endforeach
@endisset
