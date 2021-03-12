import "/node_modules/jquery/dist/jquery.min.js"

document.getElementById("btnRegister").addEventListener("click", e => {

    var email = $("#inputEmail")
    var username = $("#inputUsername")
    var password = $("#inputPassword")
    var passwordCheck = $("#inputPasswordCheck")

    if (email.val() == "") {
        e.preventDefault()
        toggleClassInvalid(email)
        popEmpty(email)
    }else{
        toggleClassValid(email)
    }
    if (username.val() == "") {
        e.preventDefault()
        toggleClassInvalid(username)
        popEmpty(username)
    } else {
        toggleClassValid(username)
    }
    if (password.val() == "") {
        e.preventDefault()
        toggleClassInvalid(password)
        popEmpty(password)
    } else {
        toggleClassValid(password)
    }
    if (passwordCheck.val() == "") {
        e.preventDefault()
        toggleClassInvalid(passwordCheck)
        popEmpty(passwordCheck)
    } else {
        toggleClassValid(passwordCheck)
    }

    if (email.val() !== "" && username.val() !== "" && password.val() !== "" && passwordCheck.val() !== "") {
        // if (password.val() !== passwordCheck.val()) {
        //     e.preventDefault()
        //     toggleClassInvalid(password)
        //     toggleClassInvalid(passwordCheck)
        // }else{
        //     toggleClassValid(password)
        //     toggleClassValid(passwordCheck)
        // }
    }
})

document.getElementById("inputPassword").addEventListener("change", e => {

    var password = $("#inputPassword")
    var passwordCheck = $("#inputPasswordCheck")

    if (password.val() !== passwordCheck.val() && passwordCheck.val() != "") {
        e.preventDefault()
        toggleClassInvalid(password)
        toggleClassInvalid(passwordCheck)
    } else if (password.val() == passwordCheck.val()) {
        toggleClassValid(password)
        toggleClassValid(passwordCheck)
    }
})
document.getElementById("inputPasswordCheck").addEventListener("change", e => {

    var password = $("#inputPassword")
    var passwordCheck = $("#inputPasswordCheck")

    if (passwordCheck.val() !== password.val() && password.val() != "") {
        e.preventDefault()
        toggleClassInvalid(password)
        toggleClassInvalid(passwordCheck)
    } else if (passwordCheck.val() == password.val()) {
        toggleClassValid(password)
        toggleClassValid(passwordCheck)
    }
})

function toggleClassValid(e){
    e.removeClass("is-invalid")
    e.addClass("is-valid")
}
function toggleClassInvalid(e) {
    e.addClass("is-invalid")
    e.removeClass("is-valid")
}

function popEmpty(e){
    e.popover({ title: 'Champ Vide', content: "Veuillez remplir ce champ avant de cliquer sur le bouton." })
        .blur(function () {
            $(this).popover('hide');
        });
}