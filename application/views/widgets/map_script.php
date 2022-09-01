<div id="map" style="height: 360px;"></div>

<?php
// Get Lat Lng using address
$address_details = file_get_contents("https://maps.googleapis.com/maps/api/geocode/json?address=" . rawurlencode(g('db.admin.company_address')) . "&key=" . GOOGLE_MAP_API);
$json = json_decode($address_details, true);
// Set lat lng (if not found set default lat lng to US
$lat = (!empty($json['results'][0]['geometry']['location']['lat']))?$json['results'][0]['geometry']['location']['lat']:'39.842205';
$lng = (!empty($json['results'][0]['geometry']['location']['lat']))?$json['results'][0]['geometry']['location']['lng']:'-101.388611';
?>

<!-- Google map Start -->
<script>
    var marker;
    // On page load function
    function initMap() {
        var uluru = {lat: <?=$lat?>, lng: <?=$lng?>};
        var map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            center: uluru
        });
        marker = new google.maps.Marker({
            position: uluru,
            map: map,
            // drop marker (animate)
            animation: google.maps.Animation.DROP
        });

        // on click to start toggle marker bounce
        marker.addListener('click', toggleBounce);
    }

    function toggleBounce() {
        if (marker.getAnimation() !== null) {
            marker.setAnimation(null);
        } else {
            marker.setAnimation(google.maps.Animation.BOUNCE);
        }
    }
</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?=GOOGLE_MAP_API?>&callback=initMap">
</script>
<!-- Google map end -->