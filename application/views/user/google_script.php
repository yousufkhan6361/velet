<script src="https://apis.google.com/js/api:client.js"></script>
<script>
    var googleUser = {};
    var startApp = function() {
        gapi.load('auth2', function(){
            // Retrieve the singleton for the GoogleAuth library and set up the client.
            auth2 = gapi.auth2.init({
                client_id: '373044294045-860bvi7oeifd4ocrpldqcnbukehor161.apps.googleusercontent.com',
                cookiepolicy: 'single_host_origin',
                // Request scopes in addition to 'profile' and 'email'
                //scope: 'additional_scope'
            });
            attachSignin(document.getElementById('customGoogleBtn'));
        });
    };

    function attachSignin(element) {
        console.log(element.id);
        auth2.attachClickHandler(element, {},
            function(googleUser) {
                console.log(googleUser.getBasicProfile().getEmail());
                console.log(googleUser.getBasicProfile().getName());

                var signup_type = $('#signup_type').val();

                var data = {id: googleUser.getBasicProfile().getId(), email: googleUser.getBasicProfile().getEmail(), name: googleUser.getBasicProfile().getName(), signup_type: signup_type};

                var url = "<?php echo g('base_url');?>hauth/google_login";
                var response = AjaxRequest.fire(url, data);

                if (response.status) {
                    Loader.hide();
                    location.reload();
                } else {
                    //window.location = response.url;
                    Loader.show();
                }
                //googleUser.getBasicProfile().getName();
            }, function(error) {
                //Loader.hide();
                //alert(JSON.stringify(error, undefined, 2));
                //console.log(JSON.stringify(error, undefined, 2));
                AdminToastr.error(JSON.stringify(error.error, undefined, 2), 'Error');
            });
    }
</script>
<script>startApp();</script>