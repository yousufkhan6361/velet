<!--FACEBOOK LOGIN START-->
<script>
    var test;
    window.fbAsyncInit = function () {
        FB.init({
            appId: '1535745989876524',
            cookie: true,
            xfbml: true,
            version: 'v2.11'
        });
        FB.AppEvents.logPageView();
        checkLoginState();
    };

    function returnLoginStateFB() {
        var result = '';
        FB.getLoginStatus(function (response) {
            result = response.status;
        });
        return result;
    }

    function login() {
        FB.api('/me', {locale: 'en_US', fields: 'name, email'},
            function (e) {

                var id = e.id;
                var email = e.email;
                var name = e.name;

                var data = {id: id, email: email, name: name};

                var url = "<?=l('hauth/fb_login')?>";
                var response = AjaxRequest.fire(url, data);

                if (response.status) {
                    location.reload();
                } else {
                    //window.location = response.url;
                }


            }
        );
    }

    function logoutFB() {
        FB.logout(function (response) {
            checkLoginState();
        });
    }

    function loginFB() {

        FB.login(function (response) {
            checkLoginState();
            login();
        }, {scope: 'email,public_profile,user_friends'});
        login();

    }

    function checkLoginState() {
        FB.getLoginStatus(function (response) {
            console.log("1");
            if (response.status == 'connected') {
                $('#fbLinkLog').html('').append('<a id="linkId" href="#" onclick="logoutFB();"> Logout</a>');
            } else {
                $('#fbLinkLog').html('').append('<a id="linkId" href="#" onclick="loginFB();"> Login</a>');
            }
        });
    }

    function showError(id, msg) {
        $('#' + id).html('');
        $('#' + id).show();
        $('#' + id).html('<div class="alert alert-danger fade in alert-dismissable"><a href="#" class="close" data-dismiss="alert" aria-label="close" title="close">Ã—</a><strong>Error!</strong> ' + msg + '.</div>').delay(1000).fadeOut();
    }

    function showSuccess(id, msg) {
        $('#' + id).html('');
        $('#' + id).show();
        $('#' + id).html('<div class="alert alert-success"><strong>Success! </strong>' + msg + '</div>').delay(1000).fadeOut();
    }

    function postOnwallFB() {
        var checkLinked = $('#check-fb').prop('checked');
        if (!checkLinked) return;
        if (returnLoginStateFB() == 'connected') {
            var hash = {link: $('#link').val(), url: $('#imagepath').val()};
            var postingMethod = false;
            var prefix = '';
            if (hash['url'] == "" && hash['link'] == "") {
                postingMethod = true;
            }
            if (hash['link'] != "" && !postingMethod) {
                hash['message'] = $('#fb_description').val();
                hash['link'] = $('#link').val();
                postingMethod = true;
                prefix = 'feed';
            }
            if (hash['url'] != "" && !postingMethod) {
                hash['message'] = $('#fb_description').val();
                postingMethod = true;
                prefix = 'photos';
            }
            FB.api('/me/' + prefix, 'post', hash, function (response) {
                if (!response || response.error) {
                    showError('msg', 'Some error occured.');
                } else {
                    showSuccess('msg', 'Posted on your wall.');
                }
            });
        } else {
            showError('msg', 'Facebook Account is not logged in');
        }
    }

    (function (d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) {
            return;
        }
        js = d.createElement(s);
        js.id = id;
        js.src = "//connect.facebook.net/en_US/sdk.js";
        fjs.parentNode.insertBefore(js, fjs);
    }(document, 'script', 'facebook-jssdk'));
</script>
<!--FACEBOOK LOGIN END--><?php
