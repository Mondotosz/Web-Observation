// Todo : Add controls
// TODO : Add image with click option

// Preview Carousel
let postCarousel = document.querySelector('#postCarousel')
let carousel = new bootstrap.Carousel(postCarousel)

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
let dropArea = document.getElementById('postCarousel');

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
        previewFile(file);
    })
}

// Image preview
function previewFile(file) {
    // Create file reader
    let reader = new FileReader();
    // Read file
    reader.readAsDataURL(file);
    // Once ready
    reader.onload = function () {
        //TODO add an id to reference controls
        //TODO add slide indicator
        // Create a div element
        let img = document.createElement('div');
        // Style it as a bootstrap carousel item
        img.style.height = "800px";
        img.style.backgroundColor = "black";
        img.style.backgroundRepeat = "no-repeat";
        img.style.backgroundPosition = "center center";
        img.style.backgroundSize = "contain";
        img.classList.add("w-100");

        // Set the image as its source
        img.style.backgroundImage = `url("${reader.result}")`

        // Add carousel item wrapper
        let wrapper = document.createElement("div");
        wrapper.classList.add("carousel-item", "active")
        wrapper.appendChild(img);

        // Remove active class from other items
        let items = document.getElementsByClassName("carousel-item")
        Array.prototype.forEach.call(items, (item) => {
            item.classList.remove("active");
        })

        // Append it to a container element
        document.getElementById("carouselInner").appendChild(wrapper)

        // carousel.cycle();

        // Remove placeholder
        if (document.getElementById("previewPlaceHolder") != null) {
            document.getElementById("previewPlaceHolder").remove();
        }
    }
}

// Handling add button

// Sends to postImage input
$('#btnAddImage').click(function () { $('#postImage').trigger('click'); });
