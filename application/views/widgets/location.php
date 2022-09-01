<!-- What we offer start -->
<div class="what-we">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="offer text-center">
                    <h1>Location</h1>
                    <input type="number" name="search_zipcode" value="" placeholder="Search by ZipCode" class="form-control search-zipcode-input"/>
                </div>
                <div id="map"></div>
            </div>
        </div>
    </div>
</div>
<!-- What we offer end -->

<script>

    // If you're adding a number of markers, you may want to drop them on the map
    // consecutively rather than all at once. This example shows how to use
    // window.setTimeout() to space your markers' animation.

    <?php
    /*$latlng = "{lat: 29.491972, lng: -98.616351},
        {lat: 29.487114, lng: -98.466380},
        {lat: 29.384257, lng: -98.620188},
        {lat: 29.386651, lng: -98.352396}";*/
    ?>

    var neighborhoods = [];
    //console.log(neighborhoods);
    //var neighborhoods;



    var markers = [];
    var map;

    function initMap(lat, lng) {
        map = new google.maps.Map(document.getElementById('map'), {
            zoom: 6,
            //center: {lat: 52.520, lng: 13.410}
            //center: {lat: 29.451246, lng: -98.503458}
            center: {lat: lat, lng: lng}
        });

        drop();

        //var image = 'https://developers.google.com/maps/documentation/javascript/examples/full/images/beachflag.png';
        var image = '<?php echo g('images_root')?>user-marker.png';

        var infowindow = new google.maps.InfoWindow({
            content: 'My Location'
        });


        var marker = new google.maps.Marker({
            position: {lat: lat, lng: lng},
            map: map,
            //title: 'My Location',
            animation: google.maps.Animation.DROP,
            icon: image
            //title: 'Uluru (Ayers Rock)'
        });
        markers.push(marker);

        marker.addListener('click', function() {
            infowindow.open(map, marker);
        });
    }

    function drop() {
        clearMarkers();
        for (var i = 0; i < neighborhoods.length; i++) {
            addMarkerWithTimeout(neighborhoods[i], i * 200);
        }
    }

    function addMarkerWithTimeout(position, timeout) {
        window.setTimeout(function() {
            var infowindow = new google.maps.InfoWindow({
                content: '<a href="'+ position.url +'" target="_blank">'+ position.name +'</a>'
            });

            var marker = new google.maps.Marker({
                position: position.position,
                map: map,
                animation: google.maps.Animation.DROP
            });
            markers.push(marker);

            marker.addListener('click', function() {
                infowindow.open(map, marker);
            });

        }, timeout);

    }

    function clearMarkers() {
        for (var i = 0; i < markers.length; i++) {
            markers[i].setMap(null);
        }
        markers = [];
    }

    function dropmarkers() {
        for (var i = 0; i < neighborhoods.length; i++) {
            addMarkerWithTimeout(neighborhoods[i], i * 200);
        }
    }

    // On page load to get location start
    function getLocation() {
        if (navigator.geolocation) {
            //navigator.geolocation.getCurrentPosition(savePosition, positionError, {timeout:10000});
            navigator.geolocation.getCurrentPosition(savePosition, positionError);
        } else {
            //Geolocation is not supported by this browser
        }
    }

    // handle the error here
    function positionError(error) {
        var errorCode = error.code;
        var message = error.message;

        // Set to default
        //initMap(29.451246, -98.503458); // San Antonio
        initMap(39.945532, -101.328954); // USA

        AdminToastr.error(message, 'Error');
    }

    function savePosition(position) {
        //$.post("geocoordinates.php", {lat: position.coords.latitude, lng: position.coords.longitude}
        /*console.log("Lat:" +  position.coords.latitude);
         console.log("Lng:" +  position.coords.longitude);*/
        var lat = position.coords.latitude;
        var lng = position.coords.longitude;
        /*console.log(lat);
        console.log(lng);*/

        var url = "https://maps.googleapis.com/maps/api/geocode/json?latlng=" + lat + "," + lng +"&sensor=true&key=" + '<?php echo GOOGLE_MAP_API;?>';

        initMap(lat, lng);

        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            //success: processJSON
        }).success(function(data){
            if(data.status=="OK"){
                var data2 = {lat:lat, lng:lng};
                var url = "<?php echo g('base_url')?>adshare/get-nearest-location";
                // Submit action
                var response = AjaxRequest.formrequest(url, data2);
                console.log(response);
                // Register success
                if (response.status) {
                    neighborhoods = response.content;
                    console.log(neighborhoods);
                    dropmarkers();
                    //drop();
                    //$form.find('#btn-login').prop('disabled', false);
                    // Reset form
                    //$form[0].reset();
                    // Redirect to Time line page
                    //window.location.href = response.refer;
                    //location.reload();

                }
                // Register fail
                else {
                    // Enable form
                    //$form.find('#btn-login').prop('disabled', false);

                }
                //processJSON(data);
            }
            else{
                alert('Unable to find location');
            }
        });

        function processJSON(json) {
            // Do stuff here
            console.log(json);
            //alert("Name:" + json.results[0].address_components[6].long_name);
            //alert("Zip Code:" + json.results[0].address_components[7].long_name);
        }

    }
    // On page load to get location end

    // Search by zipcode start
    $('input[name=search_zipcode]').keyup(function(e){
        if(e.keyCode == 13) {
            var zipcode = $(this).val();
            var data = {zipcode: zipcode};

            var url2 = "https://maps.googleapis.com/maps/api/geocode/json?address=" + zipcode + "&sensor=true&key=" + '<?php echo GOOGLE_MAP_API;?>';

            $.ajax({
                type: "GET",
                url: url2,
                dataType: "json"
                //success: processJSON
            }).success(function (data) {
                if (data.status == "OK") {

                    var lat = data.results[0].geometry.location.lat;
                    var lng = data.results[0].geometry.location.lng;

                    map = new google.maps.Map(document.getElementById('map'), {
                        zoom: 6,
                        //center: {lat: 52.520, lng: 13.410}
                        //center: {lat: 29.451246, lng: -98.503458}
                        center: {lat: lat, lng: lng}
                    });

                    //initMap(lat, lng);

                    var data2 = {lat: lat, lng: lng};
                    var url = "<?php echo g('base_url')?>adshare/get-location-by-zip";
                    // Submit action
                    var response = AjaxRequest.formrequest(url, data2);
                    console.log(response);
                    // Register success
                    if (response.status) {
                        neighborhoods = response.content;
                        console.log(neighborhoods);
                        dropmarkers();
                        //drop();
                        //$form.find('#btn-login').prop('disabled', false);
                        // Reset form
                        //$form[0].reset();
                        // Redirect to Time line page
                        //window.location.href = response.refer;
                        //location.reload();

                    }
                    // Register fail
                    else {
                        // Enable form
                        //$form.find('#btn-login').prop('disabled', false);

                    }
                    //processJSON(data);
                }
                else {
                    alert('Unable to find location');
                }

                // Submit action
                /*var response = AjaxRequest.fire(url, data);
                 // Register success
                 if (response.status) {
                 neighborhoods = response.content;
                 console.log(neighborhoods);
                 dropmarkers();
                 }*/

                return false;
            });
        }
    });
    // Search by zipcode end

</script>
<script async defer
        src="https://maps.googleapis.com/maps/api/js?key=<?echo GOOGLE_MAP_API?>&callback=getLocation">
</script>