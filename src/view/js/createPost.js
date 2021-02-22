// Todo : preview image

// Contains each image file
let images = [];

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
        success: (e) => {
            window.location.replace(window.location.origin + "/post/" + e)
        }
    });
}

// Get post data and pack it
function getPost() {
    // Create FormData object
    let post = new FormData();

    post.set("handler", "ajax")
    post.set("title", document.getElementById("postTitle").value)
    post.set("description", document.getElementById("postDescription").value)

    // Todo : handle multiple tags
    post.append("tags[]", document.getElementById("postTags").value)

    // Append images
    images.forEach((image, i) => {
        post.append(i, image)
    });
    return post;
}

// Send post on button click
document.getElementById("create").addEventListener("click", (e) => {
    e.preventDefault();
    let post = getPost();
    submitForm(post);
});

// Handle drag and drop
let dropArea = document.getElementById('postCarousel')

    // Prevent default action
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, preventDefaults, false)
    })

function preventDefaults(e) {
    e.preventDefault()
    e.stopPropagation()
}

;['dragenter', 'dragover'].forEach(eventName => {
    dropArea.addEventListener(eventName, highlight, false)
})

    ;['dragleave', 'drop'].forEach(eventName => {
        dropArea.addEventListener(eventName, unHighlight, false)
    })

// un/Highlight drop area
function highlight(e) {
    dropArea.classList.add('highlight')
}

function unHighlight(e) {
    dropArea.classList.remove('highlight')
}

// handle drop
dropArea.addEventListener('drop', handleDrop, false)

function handleDrop(e) {
    let dt = e.dataTransfer
    let files = dt.files

    handleFiles(files)
}

// add image to file list
function handleFiles(files) {
    ([...files]).forEach(file => {
        images.push(file);
    })
}