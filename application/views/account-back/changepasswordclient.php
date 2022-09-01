<!--Inner Start-->
<div class="container">
<div class="row">
<div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
<section id="login">
<div class="inner">
<div class="col-xs-12">
<div class="form-wrap">
<h1>Forgot Password</h1>

<center>
<hr>
</center>
<center>
<form role="form" method="post" id="changePassword" action="">

<div class="col-lg-12">

<div class="form-group">
<label for="email" class="sr-only">Enter your new password</label>
<input type="hidden" name="id" value="<?=$_GET['id']?>">
<input type="password" name="password" class="form-control" style="width: 50%;" />
</div>


</div>

<center>
<a href="javascript:void(0);" id="submitPassword" class="btn btn-default form-sec">Submit</a>
<hr>
</center>
</form>
</center>
</div>
</div> <!-- /.col-xs-12 -->
</div> <!-- /.container -->
</section>
</div>
</div>
</div>



<script type="text/javascript">
$(document).ready(function () {
    $(".btn-select").each(function (e) {
        var value = $(this).find("ul li.selected").html();
        if (value != undefined) {
            $(this).find(".btn-select-input").val(value);
            $(this).find(".btn-select-value").html(value);
        }
    });
});

$(document).on('click', '.btn-select', function (e) {
    e.preventDefault();
    var ul = $(this).find("ul");
    if ($(this).hasClass("active")) {
        if (ul.find("li").is(e.target)) {
            var target = $(e.target);
            target.addClass("selected").siblings().removeClass("selected");
            var value = target.html();
            $(this).find(".btn-select-input").val(value);
            $(this).find(".btn-select-value").html(value);
        }
        ul.hide();
        $(this).removeClass("active");
    }
    else {
        $('.btn-select').not(this).each(function () {
            $(this).removeClass("active").find("ul").hide();
        });
        ul.slideDown(300);
        $(this).addClass("active");
    }
});

$(document).on('click', function (e) {
    var target = $(e.target).closest(".btn-select");
    if (!target.length) {
        $(".btn-select").removeClass("active").find("ul").hide();
    }
});

    </script>
    <script>
        $('#test').prop('checked', true);
    </script>


<script type="text/javascript">
    $(document).ready(function(){
        $("#submitSignup").click(function(){
            if($("#terms").prop('checked') == true){
                var data = jQuery("#login-form").serialize();
                var url = "<?=g('base_url')?>account/save_signup";
                var response = AjaxRequest.formrequest(url, data) ;


                if(response.checkout == 1)
                {
                    AdminToastr.success(response.txt,'Success');
                    //window.location='<?=g('base_url')?>checkout';
                    window.location='<?=g('base_url')?>';
                }
                else if(response.status == 1)
                {
                    AdminToastr.success(response.txt,'Success');
                    window.location='<?=g('base_url')?>';
                }
                else
                {
                    AdminToastr.error(response.txt,'Error'); 
                }
                return false;
            }
            else{
                AdminToastr.error("Please accept the terms of use.",'Error'); 
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        $("#submitForgot").click(function(){
            var data = jQuery("#forgotPassword").serialize();
            var url = "<?=g('base_url')?>account/forgotpasswordemail";
            var response = AjaxRequest.formrequest(url, data) ;


            if(response.status == 1)
            {
                AdminToastr.success("Please check your inbox with name Forgot Password.",'Success');
                //window.location='<?=g('base_url')?>checkout';
                //window.location='<?=g('base_url')?>';
            }
            else
            {
                AdminToastr.error("Your provided email is not correct.",'Error'); 
            }
            return false;
        });
    });
</script>



<script type="text/javascript">
    $(document).ready(function(){
        $("#submitPassword").click(function(){
            var data = jQuery("#changePassword").serialize();
            var url = "<?=g('base_url')?>account/resetpasswordclient";
            var response = AjaxRequest.formrequest(url, data) ;

            if(response.status == 1)
            {
                AdminToastr.success(response.txt,'Success');
                //window.location='<?=g('base_url')?>checkout';
                //window.location='<?=g('base_url')?>';
            }
            else
            {
                AdminToastr.error(response.txt,'Error'); 
            }
            return false;
        });
    });
</script>