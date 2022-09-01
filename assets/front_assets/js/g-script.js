
var Pscript = {

    init: function () {
        Pscript.subscribe();
        Pscript.quote();
        Pscript.subscribe_btn();
        Pscript.contact_us();
        Pscript.event_subcribe();
        Pscript.change_pass();
        Pscript.signup();
        Pscript.report();
        Pscript.favourites();
        Pscript.affiliate_link();

    },

     // favourites start
    favourites: function(){
        $('.fav').on('click', function (e) {
            
            //console.log('test')            
            Loader.show();
            var obj = $(this).closest('form');
            setTimeout(function () {
                //var obj = $(this).parent().parent().closest('.favForm');
                // console.log(obj);
                // return false;
                // Get form data
                var data = obj.serialize();
                // Get post url
                var url = obj.attr('action');
                // Submit action
                var response = AjaxRequest.fire(url, data);
                // console.log(response);
                // return false;
                if(response.status == 1){

                   // AdminToastr.success("Add to Favourites", 'Success');

                    setTimeout(function(){

                    //location.reload();
                    },1000);
                }
                // Add return
                return false;
            },1000);
        });
    },
    // favourites end

    // Subscribe start
    subscribe: function(){
        $("#form-subscribe").on('submit',function (e) {
            // Prevent form submitting
            e.preventDefault();
            var obj = $(this).closest('form');
            Loader.show();
            setTimeout(function () {
                //var data = $('#form-subscribe').serialize();

                var data = obj.serialize();
                var action = obj.attr('action');
                var response = AjaxRequest.fire(action, data);
                // success
                if (response.status) {
                    $('#subs-email').val('');
                    $('#subs-email-inner').val('');
                    location.reload();
                }
                return false;
            },1000);
        });
    },
    // Subscribe end

    // Quote start
    quote: function(){
        $("#form-quote").on('submit',function (e) {

            // Prevent form submitting
            e.preventDefault();
            var obj = $(this).closest('form');
            Loader.show();
            setTimeout(function () {
                //var data = $('#form-subscribe').serialize();

                var data = obj.serialize();
                var action = obj.attr('action');
                var response = AjaxRequest.fire(action, data);
                // success
                if (response.status) {
                    $('#quote-fullname').val('');
                    $('#quote-email').val('');
                }
                return false;
            },1000);
        });
    },
    // Subscribe end

    // Subscribe anchor start
    subscribe_btn: function(){
        $(".btn-subscribe").on('click',function (e) {
            $("#form-subscribe").submit();
        });
    },
    // Subscribe anchor end

    // Contact us form start
    contact_us: function(){
        $('.btn-send').on('click', function (e) {
            // Prevent form submit
            e.preventDefault();
            Loader.show();
            setTimeout(function () {
                var obj = $("#contact-form");
                // Get form data
                var data = obj.serialize();
                // Get post url
                var url = obj.attr('action');
                // Submit action
                var response = AjaxRequest.fire(url, data);
                if(response.status){
                    location.reload();
                }
                // Add return
                return false;
            },1000);
        });
    },
    // Contact us form end


    // affiliate_link us form start
    affiliate_link: function(){
        $('.btnAffiliate').on('click', function (e) {
            // Prevent form submit
            e.preventDefault();
            Loader.show();
            setTimeout(function () {
                var obj = $("#affiliate-form");
                // Get form data
                var data = obj.serialize();
                // Get post url
                var url = obj.attr('action');
                // Submit action
                var response = AjaxRequest.fire(url, data);
                if(response.status){
                    location.reload();
                }
                // Add return
                return false;
            },1000);
        });
    },
    // affiliate_link us form end

    

    // Contact us form start
    event_subcribe: function(){
        $("#form-event-subscribe").on('submit',function (e) {
            e.preventDefault();
            Loader.show();
            setTimeout(function () {
                // Prevent form submit
                e.preventDefault();
                var obj = $("#form-event-subscribe");
                // Get form data
                var data = obj.serialize();
                // Get post url
                var url = obj.attr('action');
                // Submit action
                var response = AjaxRequest.fire(url, data);
                if(response.status){
                    location.reload();
                }
                // Add return
                return false;
            },1000);
        });
    },
    // Contact us form end

    // Contact us form start
    change_pass: function(){
        $("#typebtn").click(function () {
            var forgotpass = $('#forgotpass').val();
            if (forgotpass == "") {
                AdminToastr.error("Please Enter Password", 'Error');
            }
            else if(forgotpass.length<6){
                AdminToastr.error('Minimum Password length is 6 characters','Error');
            }
            else {
                Loader.show();
                setTimeout(function () {
                    // Prevent form submit
                    //e.preventDefault();
                    var obj = $("#forgotform");
                    // Get form data
                    var data = obj.serialize();
                    // Get post url
                    var url = base_url + "account/update_password";
                    // Submit action
                    var response = AjaxRequest.fire(url, data);
                    if(response.status){
                        location.reload();
                    }
                },1000);
                // Add return
                return false;
            }
        });

    },
    // Contact us form end

    // Subscribe start
    signup: function(){
        $("#btn-signup").click(function(e){

            var form = $(this).closest('form');

            setTimeout(function () {
                // Prevent form submitting
                e.preventDefault();
                //var data = $('#form-subscribe').serialize();
                // Get action url
                var url = form.attr('action');
                var data = new FormData(document.getElementById('signupForm'));
                var response = FileUploadScript.fire(url, data, 'json',true);
                return false;
            },1000);


            return false;
        });


    },
    // Subscribe end


    // Subscribe start
    report: function(){
        $("#btn-report").click(function(e){

            var email = $("#reportemail").val();
            var desc = $("#reportdesc").val();
            var report_subject = $("#report_subject").val();
            

            if(email == ""){
                AdminToastr.error('Email field is empty','Error');
                return false;
            }

            if(desc == ""){
                AdminToastr.error('Reason field is empty','Error');
                return false;
            }

             if(report_subject == ""){
                AdminToastr.error('Subject field not selected','Error');
                return false;
            }

            var form = $(this).closest('form');

            setTimeout(function () {
                // Prevent form submitting
                e.preventDefault();
                //var data = $('#form-subscribe').serialize();
                // Get action url
                var url = form.attr('action');
                var data = new FormData(document.getElementById('reportForm'));
                var response = FileUploadScript.fire(url, data, 'json',true);
                return false;
            },1000);


            return false;
        });


    },
    // Subscribe end
};


$(document).ready(function () {
    Pscript.init();
});

