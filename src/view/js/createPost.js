import "/node_modules/jquery/dist/jquery.min.js"
import { submitSuccessHandler, getPost, removeNullInArray, images, tags } from "/view/js/postUtils.js"

// Submit form
function submitForm(data) {
    $.ajax({
        type: "POST",
        enctype: 'multipart/form-data',
        url: window.location.origin + "/post/create",
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
