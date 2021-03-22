import { disableScroll, enableScroll } from "./helpers.js"
import "/node_modules/jquery/dist/jquery.min.js"

$("#btnDeletePost").on("click", e => {
    e.preventDefault()
    // Confirmation
    showConfirmation()

})

function showConfirmation() {
    disableScroll($("body")[0])
    $("#loadTarget").load("/view/content/components/html/modal-confirm-delete.html", () => {
        // Add event listeners
        $("#modalConfirmDeleteCross").on("click", e => {
            hideConfirmation()
        })
        $("#modalConfirmDeleteCancel").on("click", e => {
            hideConfirmation()
        })
        $("#modalConfirmDeleteCancel").focus()
        $("#modalConfirmDeleteConfirm").on("click", e => {
            sendDeletionRequest()
            hideConfirmation()
        })
    })
}

function hideConfirmation() {
    $("#loadTarget").html("")
    enableScroll($("body")[0])
}

function sendDeletionRequest() {
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

}

// TODO trap focus in modal