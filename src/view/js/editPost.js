//todo add tag with button
//todo prevent empty post

// create placeholder element using jquery syntax
function createPlaceHolder() {
    let placeHolder = $("<div>", { id: "previewPlaceHolder", class: "carousel-item text-center active" })
    placeHolder.append($("<div>", { class: "d-flex align-items-center justify-content-center", style: "height:800px;background:black url('/view/content/icons/dragAndDrop.svg') no-repeat center center;" }))
    // return dom element from jquery object
    return placeHolder
}

// declare images array containing each image file
let images = [];

// Get the file objects from the server
$(document).ready(() => {
    $("[data-image-filename]").toArray().forEach(div => {
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
        success: (e) => {
            e = JSON.parse(e)
            if (e.response == "success") {
                window.location.replace(window.location.origin + "/post/" + e.postId)
            } else if (e.response == "fail") {
                console.log(e.error)
            }
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

    removeNullInArray(tags).forEach(tag => {
        if (tag !== null) post.append("tags[]", tag)
    })

    // Append images
    removeNullInArray(images).forEach((image, i) => {
        if (image !== null) post.append(i, image)
    });
    return post;
}

// Send post on button click
$("#create").click((e) => {
    e.preventDefault();
    let post = getPost();

    // Check for required fields
    let emptyPattern = /$\s*^/
    if (emptyPattern.test(post.get("title")) || emptyPattern.test(post.get("description")) || removeNullInArray(images).length <= 0) {
        alert("please fill all required fields")
    } else {
        submitForm(post);
    }

});

// Handle drag and drop
let dropArea = $('#postCarousel')

    // Prevent default action
    ;['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
        dropArea.on(eventName, preventDefaults, false)
    })

function preventDefaults(e) {
    e.preventDefault()
    e.stopPropagation()
}

;['dragenter', 'dragover'].forEach(eventName => {
    dropArea.on(eventName, highlight)
})

    ;['dragleave', 'drop'].forEach(eventName => {
        dropArea.on(eventName, unHighlight)
    })

// un/Highlight drop area
function highlight(e) {
    dropArea.addClass('highlight')
}

function unHighlight(e) {
    dropArea.removeClass('highlight')
}

// handle drop
dropArea[0].addEventListener('drop', handleDrop, false)

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
        let img = $("<div>", {
            style: `height:800px;background:black url("${reader.result}") no-repeat center center;background-size:contain`,
            class: "w-100"
        })

        // Add carousel item wrapper
        let wrapper = $("<div>",{
            class:"carousel-item active"
        })

        wrapper.append(img)

        // Remove active class from other items
        let items = document.getElementsByClassName("carousel-item")
        Array.prototype.forEach.call(items, (item) => {
            item.classList.remove("active");
        })

        // Append it to a container element
        document.getElementById("carouselInner").appendChild(wrapper[0])

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

let tagsContainer = $("#tagsContainer")

$(document).ready(() => {
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
            let tagElement = $("<div>", {
                text: event.target.value,
                class: "badge bg-primary p2 me-2 mt-2 fs-6"
            })

            // remove tag control
            let tagElementRemoveIcon = $("<img>", {
                src: "/view/content/icons/x.svg",
                style: "height:1rem;",
                class: "removeTagIcon",
                "data-tags-id": index
            })

            tagElement.append(tagElementRemoveIcon)


            // Append it to the tags container
            tagsContainer.append(tagElement)

            $(`[data-tags-id=${index}]`).click(e => {
                // null value in tags array
                tags[index] = null
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

        let element = $("<div>", { "data-image-index": i, class: "col-12 col-md-4", style: "height:200px" })

        let ele = document.createElement("div")
        ele.style.height = "200px"
        ele.style.backgroundRepeat = "no-repeat";
        ele.style.backgroundPosition = "center center";
        ele.style.backgroundSize = "contain";

        ele.setAttribute("data-image-index", i)


        ele.classList.add("col-4")


        let reader = new FileReader()
        reader.readAsDataURL(img)
        reader.onload = function () {
            ele.style.backgroundImage = `url("${reader.result}")`

        }



        ele.addEventListener("click", (e) => {
            if (e.target.classList.contains("removeImageSelected")) {
                e.target.classList.remove("removeImageSelected")
            } else {
                e.target.classList.add("removeImageSelected")
            }
        })

        removeItemContainer.append(ele)

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

    images = removeNullInArray(images)

    let noImage = true

    images.forEach(item => {
        if (item !== null) {
            previewFile(item)
            noImage = false
        }
    })

    if (noImage) {
        $("#carouselInner").append(createPlaceHolder())
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