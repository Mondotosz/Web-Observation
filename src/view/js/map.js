import "/node_modules/jquery/dist/jquery.min.js"

// update on latitude change in input
$("#postLatitude").change(e => {
    window.lat = e.target.value
    if ($("#postLongitude")) {
        map.panTo(new L.LatLng(window.lat, window.lon))
    }
})

// update on longitude change in input
$("#postLongitude").change(e => {
    window.lon = e.target.value
    if ($("#postLatitude")) {
        map.panTo(new L.LatLng(window.lat, window.lon))
    }
})

// move marker by dragging
marker.addEventListener("moveend", e => {
    var markerLatLng = marker.getLatLng()
    var lat = markerLatLng.lat
    var lng = markerLatLng.lng

    var txtLat = document.getElementById("postLatitude")
    var txtLng = document.getElementById("postLongitude")

    txtLat.value = lat;
    txtLng.value = lng;

    console.log(lat, lng)
})

// move marker by clicking
map.addEventListener("click", e => {

    var txtLat = document.getElementById("postLatitude")
    var txtLng = document.getElementById("postLongitude")

    var latlng = e.latlng
    var lat = latlng.lat
    var lng = latlng.lng

    txtLat.value = lat;
    txtLng.value = lng;

    marker.setLatLng(latlng)

})