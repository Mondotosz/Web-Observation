//todo add tag with button
//todo prevent empty post
// Preview Carousel
let postCarousel = document.querySelector('#postCarousel')
let carousel = new bootstrap.Carousel(postCarousel)
let placeholder = document.getElementById("previewPlaceHolder").cloneNode(true)

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
    post.set("coordinates[lon]", document.getElementById("postLongitude").value)
    post.set("coordinates[lat]", document.getElementById("postLatitude").value)

    tags.forEach(tag => {
        if (tag !== null) post.append("tags[]", tag)
    })

    images = removeNullInArray(images)
    // Append images
    images.forEach((image, i) => {
        if (image !== null) post.append(i, image)
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

        // Remove placeholder
        if (document.getElementById("previewPlaceHolder") != null) {
            document.getElementById("previewPlaceHolder").remove();
        }
    }
}

// Handling add button

// Sends to postImage input
$('#btnAddImage').click(function () { $('#postImage').trigger('click'); });

// Tags
let tags = [];

let tagsContainer = document.getElementById("tagsContainer");

document.getElementById("addTags").addEventListener("keypress", event => {
    if (event.key === "Enter") {
        // Avoid sending form on enter
        event.preventDefault();
        // Check if empty
        const pattern = /^\s*$/
        if (!pattern.test(event.target.value)) {
            // save tag in array and get index
            let index = tags.push(event.target.value) - 1
            // create html element
            let tagElement = document.createElement("div");
            tagElement.innerText = event.target.value;
            tagElement.classList.add("badge", "bg-primary", "p2", "me-2", "mt-2", "fs-6")
            // remove tag control
            let removeTagIcon = document.createElement("img")

            removeTagIcon.src = "/view/content/icons/x.svg"
            removeTagIcon.style.height = "1rem"
            removeTagIcon.classList.add("removeTagIcon")
            removeTagIcon.id = `removeTagIcon-${index}`


            tagElement.appendChild(removeTagIcon)


            // Append it to the tags container
            tagsContainer.appendChild(tagElement)

            document.getElementById(`removeTagIcon-${index}`).addEventListener("click", (e) => {
                // get index from id
                let pattern = /^removeTagIcon-(\d+)$/
                let res = e.target.id.match(pattern)[1]
                // null value in tags array
                tags[res] = null;
                // remove tag item
                e.target.parentNode.remove(e.target)
            })

            // Empty input
            event.target.value = "";
        }
    }
})

// remove image handler

let removeItemModal = $("#removeItemModal")
let removeItemCancel = $("#removeItemCancel")
let removeItemConfirm = $("#removeItemConfirm")
let btnRemoveImage = $("#btnRemoveImage");
let removeItemContainer = $("#removeItemContainer")

// used to disable certain controls when modal is displayed
// TODO implement this
let modalTab = false

// show modal trigger
btnRemoveImage.click((e) => {
    removeItemModal.show()
    modalTab = true

    // load images as selectable
    images.forEach((img, i) => {
        // check for null value
        if (img === null) {
            return
        }

        let element = document.createElement("div")
        element.style.height = "200px"
        element.style.backgroundRepeat = "no-repeat";
        element.style.backgroundPosition = "center center";
        element.style.backgroundSize = "contain";

        element.setAttribute("data-image-index", i)


        element.classList.add("col-4")


        let reader = new FileReader()
        reader.readAsDataURL(img)
        reader.onload = function () {
            element.style.backgroundImage = `url("${reader.result}")`

        }



        element.addEventListener("click", (e) => {
            if (e.target.classList.contains("removeImageSelected")) {
                e.target.classList.remove("removeImageSelected")
            } else {
                e.target.classList.add("removeImageSelected")
            }
        })

        removeItemContainer.append(element)

    })

})

// hide on cancel
removeItemCancel.click(e => {
    removeItemModal.hide();
    modalTab = false
    removeItemContainer.empty()
})

// remove images
removeItemConfirm.click(e => {
    // get indexes
    let selectedItems = removeItemContainer.find(".removeImageSelected").toArray()
    // remove from preview
    $("#carouselInner").empty()

    // remove selected images
    selectedItems.forEach(item => {
        images[item.getAttribute("data-image-index")] = null;
    })

    let noImage = true

    images.forEach(item => {
        if (item !== null) {
            previewFile(item)
            noImage = false
        }
    })

    if (noImage) {
        document.getElementById("carouselInner").appendChild(placeholder)
    }

    // hide modal
    removeItemModal.hide();
    modalTab = false
    removeItemContainer.empty()
})

// quick fix for null array indexes
function removeNullInArray(array) {
    let tmp = []
    array.forEach(item => {
        if (item !== null) tmp.push(item)
    })
    return tmp
}
//map

$("#postLatitude").change(e => {
    window.lat = e.target.value
    if ($("#postLongitude")) {
        map.panTo(new L.LatLng(window.lat, window.lon))
    }
})

$("#postLongitude").change(e => {
    window.lon = e.target.value
    if ($("#postLatitude")) {
        map.panTo(new L.LatLng(window.lat, window.lon))

    }
})