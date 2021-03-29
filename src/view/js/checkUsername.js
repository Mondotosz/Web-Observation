import "/node_modules/jquery/dist/jquery.min.js"

// !double click triggers bug
jQuery(() => {

    // get input elements
    let usernameInput = $("#inputUsername")
    let emailInput = $("#inputEmail")
    // initialize popovers
    popoverInit(usernameInput, 'Username taken', "This username is already taken.")
    popoverInit(emailInput, 'Email taken', "This email is already taken.")

    // make a request to check username availability
    usernameInput.on("change", e => {
        // create the form data
        let data = new FormData()

        // get the current username in input
        data.set("username", e.target.value)
        // add action value for backend handling
        data.set("action", "checkUsername")

        // create POST request
        sendRequest(data, e => {
            e = JSON.parse(e)
            // Change styling according to response
            if (e.valid == false) {
                invalidInput(usernameInput)
            } else {
                validInput(usernameInput)
            }
        })

    })

    // make a request to check email availability
    emailInput.on("change", e => {

        // create the form data
        let data = new FormData()

        // get the current email in input
        data.set("email", e.target.value)
        // add action value for backend handling
        data.set("action", "checkEmail")

        // create POST request
        sendRequest(data, e => {
            e = JSON.parse(e)
            // Change styling according to response
            if (e.valid == false) {
                invalidInput(emailInput)
            } else {
                validInput(emailInput)
            }
        })

    })

})


// initialize popover
function popoverInit(input, popoverTitle, popoverContent) {
    $(input).popover({ title: popoverTitle, content: popoverContent })
        .blur(function () {
            $(this).popover('hide');
        });
    $(input).popover("disable")
}

// applies invalid style to the input element
function invalidInput(input) {
    $(input).popover('enable')

    $(input).removeClass("is-valid")
    $(input).addClass("is-invalid")

}

// applies valid style to the input element
function validInput(input) {
    $(input).popover('disable')

    $(input).removeClass("is-invalid")
    $(input).addClass("is-valid")

}

// Send request to register controller, response is handled with a callback function
function sendRequest(data, callback) {
    $.ajax({
        method: "POST",
        url: window.location.origin + "/register",
        data: data,
        processData: false,
        enctype: "multipart/form-data",
        contentType: false,
        cache: false,
        success: callback
    })

}