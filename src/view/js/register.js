import "/node_modules/jquery/dist/jquery.min.js"

document.getElementById("btnRegister").addEventListener("click", e => {

    var email = $("#inputEmail")
    var username = $("#inputUsername")
    var password = $("#inputPassword")
    var passwordCheck = $("#inputPasswordCheck")
    var tOS = $("#inputTOS")

    if (email.val() == "") {
        e.preventDefault()
        toggleClassInvalid(email)
        popEmpty(email)
    } else {
        toggleClassValid(email)
        destroyPop(email)
    }
    if (username.val() == "") {
        e.preventDefault()
        toggleClassInvalid(username)
        popEmpty(username)
    } else {
        toggleClassValid(username)
        destroyPop(username)
    }
    if (password.val() == "") {
        e.preventDefault();
        toggleClassInvalid(password)
        popEmpty(password)
    }else {
        destroyPop(password)
    }
    if (passwordCheck.val() == "") {
        e.preventDefault();
        toggleClassInvalid(passwordCheck)
        popEmpty(passwordCheck)
    }else {
        destroyPop(passwordCheck)
    }
    if (password.val() !== passwordCheck.val()) {
        e.preventDefault()
        if (password.val() == "") {
            toggleClassInvalid(password)
            popEmpty(password)
        }
        if (passwordCheck.val() == "") {
            toggleClassInvalid(passwordCheck)
            popEmpty(passwordCheck)
        }
    }

    if (email.val() !== "" && username.val() !== "" && password.val() !== "" && passwordCheck.val() !== "") {
        if (password.val() !== passwordCheck.val()) {
            e.preventDefault();
        }
        if (!tOS.is(":checked")) {
            e.preventDefault();
        }
    }
})

document.getElementById("inputPassword").addEventListener("change", e => {

    var password = $("#inputPassword")
    var passwordCheck = $("#inputPasswordCheck")

    if (password.val() !== passwordCheck.val() && passwordCheck.val() != "") {
        e.preventDefault()
        toggleClassInvalid(password)
        toggleClassInvalid(passwordCheck)
        popEmpty(password)
        popEmpty(passwordCheck)
    } else if (password.val() == passwordCheck.val()) {
        toggleClassValid(password)
        toggleClassValid(passwordCheck)
        destroyPop(password)
        destroyPop(passwordCheck)
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
        destroyPop(password)
        destroyPop(passwordCheck)
    }
})

function toggleClassValid(e) {
    e.removeClass("is-invalid")
    e.addClass("is-valid")
}
function toggleClassInvalid(e) {
    e.addClass("is-invalid")
    e.removeClass("is-valid")
}

function popEmpty(e) {
    e.popover({ title: 'Empty field', content: "Please fill this field before clicking on the button." })
        .blur(function () {
            $(this).popover('hide');
        });
    e.popover('enable')
}

function destroyPop(e) {
    e.popover('disable')
}