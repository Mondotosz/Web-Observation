function submitForm(data) {
    $.ajax({
        type: "POST",
        url: window.location.origin + "/post/create",
        data: data,
        success: (e) => {
            console.log(e);
        },
        dataType: "JSON",
    });
}

function getPost() {
    let title = document.getElementById("inputTitle").value;
    let description = document.getElementById("inputDescription").value;
    //format object
    let post = {
        post: {
            "title": title,
            "description": description,
            "coordinates": {
                "lon": "dummy",
                "lat": "dummy"
            }
        }
    };
    return post;
}

document.getElementById("create").addEventListener("click", () => {
    let post = getPost();
    submitForm(post);
});
