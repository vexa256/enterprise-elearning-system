global.ModularTestSec = () => {
    let FORM_DATA = {
        "CID": $('#CID').val(),
        "created_at": $('#created_at').val(),
        "uuid": $('#uuid').val(),
        "MID": $('#MID').val(),
        "ModularTestID": $('#ModularTestID').val(),
        "UserID": $('#UserID').val(),
        "TestQuestion": $('#TestQuestion').val(),
        "status": 'false',
        "UserAnswer": 'User Exam Time Limit Exceeded, Exam was canceled',


    }
    axios.post(API_PATH + 'ModularTestSecurity', FORM_DATA)
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            CatchAxiosError(error);
        });




}
