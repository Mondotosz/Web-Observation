import "/node_modules/jquery/dist/jquery.min.js"
import { submitSuccessHandler, getPost, removeNullInArray, images, tags } from "/view/js/postUtils.js"

// Get the file objects from the server
jQuery(() => {
    $("[data-image-filename]").each((_e, div) => {
        fetch(window.location.origin + "/view/content/img/original/" + div.getAttribute("data-image-filename"))
            .then(response => response.blob())
            .then(data => {
                images.push(data)
            })
    })
})

// Submit form
function submitForm(data) {
    // get id from the first match
    let postId = window.location.pathname.match(/\/post\/(\d+)\/edit\/?/)[1]

    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: window.location.origin + "/post/" + postId + "/edit",
        data: data,
        processData: false,
        contentType: false,
        cache: false,
        timeout: 60000,
        success: submitSuccessHandler
    });
}

// Send post on button click
$("#create").click((e) => {
    e.preventDefault();
    let post = getPost(images, tags);

    // Check for required fields
    let emptyPattern = /$\s*^/
    if (emptyPattern.test(post.get("title")) || emptyPattern.test(post.get("description")) || removeNullInArray(images).length <= 0) {
        alert("please fill all required fields")
    } else {
        submitForm(post);
    }

});

// ANCHOR Tags

jQuery(() => {
    let tagElements = $("img[data-tags-id]")

    tagElements.each((value, element) => {
        element.addEventListener("click", (e) => {
            tags[value] = null
            e.target.parentNode.remove(e.target)
        })
    })

    tagElements.parent().each((id, element) => {
        tags[id] = element.textContent
    })
})

