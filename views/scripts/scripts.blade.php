<!--begin::Javascript-->
<!--begin::Global Javascript Bundle(used by all pages)-->


<script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>



<script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

<script
src="{{ asset('assets/plugins/custom/datatables/datatables.bundle.js') }}">
</script>

<script
src="{{ asset('assets/plugins/custom/fslightbox/fslightbox.bundle.js') }}">
</script>

@include('scripts.editor')

<script src="https://documentcloud.adobe.com/view-sdk/main.js"></script>
<script src="{{ asset('js/custom.js') }}"></script>
@include('not.not')


<script src="{{ asset('js/notify.js') }}"></script>



@isset($Pretest)
    <script src="{{ asset('js/ExamCounter.js') }}"></script>
    <script src="{{ asset('js/Pretest.js') }}"></script>
@endisset

@isset($PostTest)
    <script src="{{ asset('js/ExamCounter.js') }}"></script>
    <script src="{{ asset('js/PostTest.js') }}"></script>
@endisset


@isset($ModularTest)
    <script src="{{ asset('js/ExamCounter.js') }}"></script>
    <script src="{{ asset('js/ModularTest.js') }}"></script>
@endisset


@isset($PracticalTest)
    <script src="{{ asset('js/ExamCounter.js') }}"></script>
    <script src="{{ asset('js/PracticalTest.js') }}"></script>
@endisset



<script>
    $(document).ready(function() {

        $(document).on("click", ".Number", function() {
            Swal.fire(
                'No Student Has Attempted All Required Exams',
                'This option wil become available once one or more students have completed all the tests',
                'info'
            )
        });

    });
</script>
</body>
<!--end::Body-->

</html>
