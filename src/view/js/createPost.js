//todo add tag with button
//todo prevent empty post
// create placeholder element using jquery syntax
function createPlaceHolder() {
    let placeHolder = $("<div>", { id: "previewPlaceHolder", class: "carousel-item text-center active" })
    placeHolder.append($("<div>", { class: "d-flex align-items-center justify-content-center", style: "height:800px;background:black url('/view/content/icons/dragAndDrop.svg') no-repeat center center;" }))
    // return dom element from jquery object
    return placeHolder
}


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
    post.set("title", $("#postTitle").val())
    post.set("description", $("#postDescription").val())
    post.set("coordinates[lon]", $("#postLongitude").val())
    post.set("coordinates[lat]", $("#postLatitude").val())

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
let dropArea = $('#postCarousel');

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
});

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
        let wrapper = $("<div>", {
            class: "carousel-item active"
        })

        wrapper.append(img)

        // Remove active class from other items
        $(".carousel-item").each((index, item) => {
            item.classList.remove("active")
        })

        // Append it to a container element
        $("#carouselInner").append(wrapper)

        // Remove placeholder
        if ($("#previewPlaceHolder") != null) {
            $("#previewPlaceHolder").remove()
        }
    }
}

// Handling add button

// Sends to postImage input
$('#btnAddImage').click(function () { $('#postImage').trigger('click'); });

// ANCHOR Tags
let tags = [];

$("#btnAddTags").on("click", () => {
    addTag($("#addTags")[0])
})

$("#addTags").on("keypress", event => {
    if (event.key === "Enter") {
        // Avoid sending form on enter
        event.preventDefault();
        // Check if empty
        addTag(event.target)

    }
})

function addTag(domElement) {
    const pattern = /^\s*$/
    if (!pattern.test(domElement.value) && !tags.includes(domElement.value)) {

        // save tag in array and get index
        let index = tags.push(domElement.value) - 1

        // create html element
        let tagElement = $("<div>", {
            text: domElement.value,
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
        $("#tagsContainer").append(tagElement)

        $(`[data-tags-id=${index}]`).click(e => {
            // null value in tags array
            tags[index] = null
            // remove tag item
            e.target.parentNode.remove()
        })

        // Empty input
        domElement.value = "";
    }

}

// remove image handler

let removeItemModal = $("#removeItemModal")
let removeItemContainer = $("#removeItemContainer")

// used to disable certain controls when modal is displayed
let modalTab = false

// show modal trigger
$("#btnRemoveImage").click((e) => {
    removeItemModal.show()
    modalTab = true
    $("body").addClass("overflow-hidden")

    // load images as selectable
    images.forEach((img, i) => {
        // check for null value
        if (img === null) {
            return
        }

        let element = $("<div>", {
            "data-image-index": i,
            class: "col-12 col-md-4",
            style: "height:200px;background:no-repeat center center;background-size:contain"
        })

        let reader = new FileReader()
        reader.readAsDataURL(img)
        reader.onload = function () {
            // ele.style.backgroundImage = `url("${reader.result}")`
            element.css("background-image", `url("${reader.result}")`)

        }

        element.click(e => {
            if (e.target.classList.contains("removeImageSelected")) {
                e.target.classList.remove("removeImageSelected")
            } else {
                e.target.classList.add("removeImageSelected")
            }
        })

        removeItemContainer.append(element)

    })

})

function hideModal() {
    removeItemModal.hide();
    modalTab = false
    $("body").removeClass("overflow-hidden")
    removeItemContainer.empty()
}

// cancel with esc
$('body').keydown(e => {
    if (e.key == "Escape" && modalTab) {
        e.preventDefault()
        hideModal()
    }
})

// hide on cancel
$("#removeItemCancel").click(hideModal)
$("#removeItemCross").click(hideModal)

// remove images
$("#removeItemConfirm").click(e => {
    // get indexes
    let selectedItems = removeItemContainer.find(".removeImageSelected").toArray()
    // remove from preview
    $("#carouselInner").empty()

    // remove selected images
    selectedItems.forEach(item => {
        images[item.getAttribute("data-image-index")] = null;
    })

    // clean image array
    images = removeNullInArray(images)

    let noImage = true

    images.forEach(item => {
        if (item !== null) {
            // regenerate previews
            previewFile(item)
            noImage = false
        }
    })

    // add placeholder when there are no images left
    if (noImage) {
        $("#carouselInner").append(createPlaceHolder())
    }

    // hide modal
    hideModal()
})

// quick fix for null array indexes
function removeNullInArray(array) {
    let tmp = []
    array.forEach(item => {
        if (item !== null) tmp.push(item)
    })
    return tmp
}
