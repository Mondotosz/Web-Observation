
// Check for get parameters matching an error and displays a basic alert with error message
document.addEventListener("DOMContentLoaded", e => {

    const param = new URLSearchParams(window.location.search)

    switch (param.get("error")) {
        case 'creationFailed':
            alert("The creation of your account has failed!")
            break;
        case 'emptyFields':
            alert("Please, fill all the fields.")
            break;
        case 'pswNotMatch':
            alert("The two passwords do not match.")
            break;
        case 'pswNotRight':
            alert("The password is not right.")
            break;
        case 'emailAlreadyUsed':
            alert("This email is already used.")
            break;
    }

})

