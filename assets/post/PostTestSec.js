global.PostTestSec = () => {
    let FORM_DATA = {
        "CID": $('#CID').val(),
        "created_at": $('#created_at').val(),
        "uuid": $('#uuid').val(),
        "PostTestID": $('#PostTestID').val(),
        "UserID": $('#UserID').val(),
        "TestQuestion": $('#TestQuestion').val(),
        "status": 'false',
        "UserAnswer": 'User Exam Time Limit Exceeded, Exam was canceled',


    }
    axios.post(API_PATH + 'PostTestSecurity', FORM_DATA)
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            CatchAxiosError(error);
        });




}
