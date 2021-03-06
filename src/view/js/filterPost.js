import '/node_modules/jquery/dist/jquery.min.js';

let toggleStatus = false;

// Create and append filter component
function createFilterComponent() {
    // fetch get parameters
    const param = new URLSearchParams(window.location.search)

    // Create container
    let container = $("<div>", {
        class: "container-filter"
    })

    // Create form
    let form = $("<form>", {
        method: "GET",
        action: window.location.pathname,
        class: "form-filter form-filter-off"
    })

    // Create hidden filter true value
    form.append($("<input>", {
        type: "hidden",
        name: "filter",
        value: "true"
    }))

    // Create search by title
    form.append($("<input>", {
        type: "text",
        name: "title",
        placeholder: "title",
        class: "form-control",
        value: param.get('title') ?? ""
    }))

    // Create search by author
    form.append($("<input>", {
        type: "text",
        name: "author",
        placeholder: "author",
        class: "form-control",
        value: param.get('author') ?? ""
    }))

    // Create filter button
    form.append($("<button>", {
        type: "submit",
        class: "btn btn-primary",
        text: "filter"
    }))

    // Create reset button
    form.append(($("<button>", {
        class: "btn btn-primary",
        text: "clear"
    })).click(e => {
        e.preventDefault()
        $(".form-filter").children("input").each((_index, input) => {
            input.value = input.name == "filter" ? "true" : "";
        })
    }))

    container.append(form)

    // Create toggler with logic
    container.append($("<div>", {
        class: "toggler-filter chevron-left"
    }).click(e => {

        let formFilter = $(".form-filter")

        if (toggleStatus) {
            e.target.classList.remove("chevron-down")
            e.target.classList.add("chevron-left")
            formFilter.removeClass("form-filter-on")
            formFilter.addClass("form-filter-off")
            toggleStatus = false
        } else {
            e.target.classList.remove("chevron-left")
            e.target.classList.add("chevron-down")
            formFilter.removeClass("form-filter-off")
            formFilter.addClass("form-filter-on")
            toggleStatus = true
        }
    }))


    $("main").append(container)
}

jQuery(() => {
    let stylesheet = $("<link>", {
        rel: "stylesheet",
        href: "/view/css/filterPost.css"
    })

    $("head").append(stylesheet)

    createFilterComponent()
})
