document.addEventListener("DOMContentLoaded", e => {

    var email = document.getElementById("inputEmail")
    var username = document.getElementById("inputUsername")
    var password = document.getElementById("inputPassword")
    var passwordCheck = document.getElementById("inputPasswordCheck")

    const param = new URLSearchParams(window.location.search)

    if (param.get("error")){
        if (!(email.value)) {
            email.classList.add("is-invalid")
        }
        if (!(username.value)) {
            username.classList.add("is-invalid")
        }
        if (!(password.value)) {
            password.classList.add("is-invalid")
        }
        if (!(passwordCheck.value)) {
            passwordCheck.classList.add("is-invalid")
        }
    }




})