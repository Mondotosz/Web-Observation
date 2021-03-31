import "/node_modules/jquery/dist/jquery.min.js"

let container

// get toast container if it doesn't exists
if ($(".toast-container").length == 0) {
    // Create container
    container = $("<div>", {
        class: "toast-container position-fixed bottom-0 end-0 p-3",
        style: "z-index:2000"
    })

    $("body").append(container)
} else {
    container = $(".toast-container").first()
}

/**
 * @description Creates a dismissible toast
 * @param title: string will be set as innerHtml
 * @param body: string will be set as innerHtml
 * @param icon: string url to toast icon
 */
export function showToast(title, body, icon = null) {
    $.get("/view/content/components/html/toast-template.html", (e) => {
        let toast = $(jQuery.parseHTML(e))

        // Set title
        toast.find(".toast-title").html(title)

        // Set body
        toast.find(".toast-body").html(body)

        // Set icon
        toast.find(".toast-img").attr("src", icon ?? "/view/content/icons/info.svg")

        // Set time
        let timer = toast.find(":contains({{time}})").last()
        timer.attr("data-toast-timer", Date.now())
        timer.text("just now")
        setInterval((e) => {
            timeSince(e)
        }, 1000, timer)

        // Hide on click
        let btnClose = toast.find(".btn-close")
        btnClose.on("click", (e) => {
            $(e.target).closest(".toast").addClass("hide").removeClass("show")
        })

        container.append(toast)
    })
}

// handles timer on element
function timeSince(e) {
    let timeDiff = new Date(Date.now() - e.attr("data-toast-timer"))
    if (timeDiff > 3599500) {
        e.text(`${timeDiff.getHours()} hours ago`)
    } else if (timeDiff > 59500) {
        e.text(`${timeDiff.getMinutes()} minutes ago`)
    } else {
        e.text(`${timeDiff.getSeconds()} seconds ago`)
    }
}
