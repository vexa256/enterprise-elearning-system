<div class="row mb-4 pb-4">

    <div class="col">
        <a data-bs-toggle="modal"
            class="btn  StartExamTimer btn-danger shadow-lg bt-lg"
            href="#PostExams"> <i class="fas fa-university "></i>

            Post Tests
        </a>
    </div>


    <div class="col">
        <a data-bs-toggle="modal"
            class="btn  StartExamTimer btn-info shadow-lg bt-lg"
            href="#ModularExams"> <i class="fas fa-question "></i>

            Modular Tests
        </a>
    </div>


    <div class="col">
        <a data-bs-toggle="modal"
            class="btn  StartExamTimer btn-info shadow-lg bt-lg"
            href="#PracticalExams"> <i class="fas fa-flask "></i>

            Practical Tests
        </a>
    </div>


    <div class="col">
        <td>
            <a data-doc="  {{ $TimeTable->TimeTableTitle }}"
                data-source="{{ asset('assets/data/' . $TimeTable->url) }}"
                data-bs-toggle="modal" href="#PdfJS"
                class="btn  PdfViewer btn-info"> <i class="fas fa-chalkboard"
                    aria-hidden="true"></i> Lecture
                Plan
            </a>
        </td>


    </div>


    <div class="col">
        <a target="_blank"
            class="btn  StartExamTimer btn-danger shadow-lg bt-lg"
            href="{{ $TimeTable->VideoCallLink }}"> <i
                class="fas fa-chalkboard "></i>

            Start Class
        </a>
    </div>





</div>
