global.PretestSec = () => {
    let FORM_DATA = {
        "CID": $('#CID').val(),
        "created_at": $('#created_at').val(),
        "uuid": $('#uuid').val(),
        "PretestID": $('#PretestID').val(),
        "UserID": $('#UserID').val(),
        "PretestQuestion": $('#PretestQuestion').val(),
        "status": 'false',
        "UserAnswer": 'User Exam Time Limit Exceeded, Exam was canceled',


    }
    axios.post(API_PATH + 'PretestSecurity', FORM_DATA)
        .then(function (response) {
            console.log(response.data);
        })
        .catch(function (error) {
            CatchAxiosError(error);
        });




}
