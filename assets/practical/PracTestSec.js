global.PracTestSec = () => {

    let FORM_DATA = {
        "CID": $('#CID').val(),
        "created_at": $('#created_at').val(),
        "uuid": $('#uuid').val(),
        "PracticalTestID": $('#PracticalTestID').val(),
        "UserID": $('#UserID').val(),
        "TestQuestion": $('#TestQuestion').val(),
        "status": 'false',
        "UserAnswer": 'User Exam Time Limit Exceeded, Exam was canceled',


    }
    axios.post(API_PATH + 'PracticalTestSecurity', FORM_DATA)
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            CatchAxiosError(error);
        });




}
