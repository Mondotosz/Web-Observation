import "/node_modules/jquery/dist/jquery.min.js"
import * as helpers from "/view/js/helpers.js"

// form validation on form submission
document.getElementById("btnRegister").addEventListener("click", e => {

    var email = $("#inputEmail")
    var username = $("#inputUsername")
    var password = $("#inputPassword")
    var passwordCheck = $("#inputPasswordCheck")
    var tOS = $("#inputTOS")

    // Check for empty fields and updates styling
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
    } else {
        destroyPop(password)
    }
    if (passwordCheck.val() == "") {
        e.preventDefault();
        toggleClassInvalid(passwordCheck)
        popEmpty(passwordCheck)
    } else {
        destroyPop(passwordCheck)
    }
    // Double check password
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

    // ! issues with email availability overwriting class
    // Validate email format
    if (!helpers.validateEmail(email.val())) {
        toggleClassInvalid(email)
        e.preventDefault()
    } else {
        toggleClassValid(email)
    }

    // prevent submission on empty values
    if (email.val() !== "" && username.val() !== "" && password.val() !== "" && passwordCheck.val() !== "") {
        if (password.val() !== passwordCheck.val()) {
            e.preventDefault();
        }
        if (!tOS.is(":checked")) {
            e.preventDefault();
        }
    }
})

// live double password confirmation

// first password field
document.getElementById("inputPassword").addEventListener("change", e => {

    var password = $("#inputPassword")
    var passwordCheck = $("#inputPasswordCheck")

    //
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

// second password field
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

// styles element as valid
function toggleClassValid(e) {
    e.removeClass("is-invalid")
    e.addClass("is-valid")
}

// styles element as invalid
function toggleClassInvalid(e) {
    e.addClass("is-invalid")
    e.removeClass("is-valid")
}

// add empty field popover next to element
function popEmpty(e) {
    e.popover({ title: 'Empty field', content: "Please fill this field before clicking on the button." })
        .blur(function () {
            $(this).popover('hide');
        });
    e.popover('enable')
}

// add empty field popover next to element
function destroyPop(e) {
    e.popover('disable')
}