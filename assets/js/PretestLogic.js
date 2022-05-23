
document.addEventListener('DOMContentLoaded', () => {

    global.ExamTimeOutAction = () => {
        let timerInterval
        Swal.fire({
            title: 'The Exam Time Ran Out.',
            html: 'The page will be closed in  <b></b> milliseconds.',
            timer: 10000,
            timerProgressBar: true,
            allowOutsideClick: false,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                    b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
            }
        }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')

                window.location.reload();

            }
        })
    }

    $('.HideSecondaryShowBtn').hide();

    global.RecordExamModal = new bootstrap.Modal(document.getElementById('AnswerQtn'), {
        keyboard: false
    })

    global.ExamTimerValue = $('.ExamTimerValue').val();

    $('.spanTimer').html('Assessment Duration: ' + ExamTimerValue / 60000 + ' Minutes');


    global.StartTimer = () => {
        $('.spanTimer').html(' ');

        var ExamTime = new Date().getTime() + parseInt(ExamTimerValue);

        if ($('.spanTimer').length > 0) {
            $('.spanTimer')
                .countdown(ExamTime) // removed the elapsed: true
                .on('update.countdown', function (event) {
                    var $this = $(this)
                    if (event.elapsed) {
                        $this.html(event.strftime('After end: <span>%H:%M:%S</span>'))
                    } else {
                        $this.html(
                            event.strftime(
                                'Time left to the end of exam  : <span>%H:%M:%S</span>',
                            ),
                        )
                    }
                })
                // added a finish.countdown callback, to
                //  hide the countdown altogether and
                //  have a little fun.
                .on('finish.countdown', function () {
                    ExamTimeOutAction();
                })
        }
    }

    $(document).on("click", ".StartExamTimer", function () {


        Swal.fire({
            title: 'You are starting the assessment answering',
            text: "You won't be able to cancel once you start. The timer will also be started. Please attempt the question in the assigned time. In the event the time assigned to this exam session elapses before you submit. This test will be canceled",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Start Assessment'
        }).then((result) => {
            if (result.isConfirmed) {
                RecordExamModal.show();
                StartTimer();
                $('.HideSecondaryShowBtn').show();

                $('.TimerRemover').remove('.StartExamTimer');
                $('.ToggleButton').html(`  <a data-bs-toggle="modal" class="btn   btn-dark shadow-lg btn-sm"
                href="#AnswerQtn">

                Record Answer
            </a>`);

                PretestSec();

                Swal.fire('Important Notice', 'Please Do Not Refresh This Page, Doing So Will Result In Termination of This Exam Session. You Will Not Be Able to Re-Do the Test. Scroll Up and Down To Alternate between the Question and Answer. Do Not Attempt To Open Any Other Browser Tabs or Engage In Examination Malpractice. Doing So Will Lead To Cancellation of This Test Automatically', 'info');

            }


        })










    });
})
