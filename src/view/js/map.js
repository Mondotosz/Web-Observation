

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