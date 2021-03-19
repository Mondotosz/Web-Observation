import { disableScroll } from "./helpers.js"
import "/node_modules/jquery/dist/jquery.min.js"

$("#btnDeletePost").on("click", e => {
    e.preventDefault()
    // Confirmation
    disableScroll($("body")[0])
    // !ADD popup for confirmation

    // Prepare request
    let id = window.location.pathname.match(/\/post\/(\d+)\/?/)[1]
    let data = new FormData();
    data.set("id", id)

    // Send request
    $.ajax({
        type: "POST",
        enctype: "multipart/form-data",
        url: `${window.location.origin}/post/delete`,
        data: data,
        contentType: false,
        processData: false,
        cache: false,
        timeout: 60000,
        success: (e) => {
            e = JSON.parse(e)
            if (e.response == "success") {
                console.log(e)
                window.location.replace("/")
            }
        }
    })
})