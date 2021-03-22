
document.getElementById("inputUsername").addEventListener("change", e => {
 
    let data = new FormData()

    data.set("username",e.target.value)
    data.set("action", "checkUsername")

    
    $.ajax({
        method: "POST",
        url: window.location.origin + "/register",
        data: data,
        processData: false,
        enctype: "multipart/form-data",
        contentType: false,
        cache: false,
        success: e => {
            e = JSON.parse(e)
            if(e.valid == false){

                $("#inputUsername").popover({ title: 'Username taken', content: "This username is already taken." })
                    .blur(function () {
                        $(this).popover('hide');
                    });
                $("#inputUsername").popover('enable')

                $("#inputUsername").removeClass("is-valid")
                $("#inputUsername").addClass("is-invalid")

            }else{
                $("#inputUsername").popover('disable')

                $("#inputUsername").removeClass("is-invalid")
                $("#inputUsername").addClass("is-valid")
            }
        }
    })

})
document.getElementById("inputEmail").addEventListener("change", e => {
 
    let data = new FormData()

    data.set("email",e.target.value)
    data.set("action", "checkEmail")

    
    $.ajax({
        method: "POST",
        url: window.location.origin + "/register",
        data: data,
        processData: false,
        enctype: "multipart/form-data",
        contentType: false,
        cache: false,
        success: e => {
            e = JSON.parse(e)
            if(e.valid == false){

                $("#inputEmail").popover({ title: 'Email taken', content: "This email is already taken." })
                    .blur(function () {
                        $(this).popover('hide');
                    });
                $("#inputEmail").popover('enable')

                $("#inputEmail").addClass("is-invalid")
                $("#inputEmail").removeClass("is-valid")

            } else {
                $("#inputEmail").popover('disable')

                $("#inputEmail").removeClass("is-invalid")
                $("#inputEmail").addClass("is-valid")
            }
        }
    })

})