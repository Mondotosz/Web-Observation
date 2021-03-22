
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
                alert("This username is already used.")
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
                alert("This email is already used.")
            }
        }
    })

})