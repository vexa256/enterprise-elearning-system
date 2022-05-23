<div class="row" style="max-height: 100%; overflow-y:scroll">

    @isset($Courses)
        @foreach ($Courses as $data)
            <div class="col-md-4 mb-3">
                <div class="card shadow-sm">
                    <div class="card-header">
                        <h3 class="card-title">{{ $data->CourseName }}</h3>

                    </div>
                    <div class="card-body p-0">

                        <div class="text-center px-4">
                            <img class="mw-100 shadow-xl h-200px card-rounded-bottom"
                                alt=""
                                src="{{ asset('assets/data/' . $data->Thumbnail) }}" />
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="card-toolbar">
                            <a data-bs-toggle="modal"
                                href="#Desc{{ $data->id }}"
                                class="btn btn-sm btn-danger me-2">
                                View More
                            </a>
                            <a data-bs-toggle="modal" href="#New"
                                class="btn btn-sm btn-dark">
                                Apply
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endisset
</div>


@include('ViewCourses.Viewer')

@include('ViewCourses.NewApp')
