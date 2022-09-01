<!--Inner Start-->
<div class="container">
<div class="row">
<div class="col-xs-12 col-md-12 col-lg-12 col-sm-12">
<section id="login">
<div class="inner">
<div class="col-xs-12">
<div class="form-wrap">
<h1>Sign Up for Free!</h1>
<p>Welcome! Sign up for free to be able to write and share your own amazing stories, and to be able to rate your favorite stories.</p>
<center>
<hr>
</center>
<center>
<form role="form" action="" method="post" id="login-form" autocomplete="off">

<div class="col-lg-12">
<div class="form-group">
<label for="email" class="sr-only">Email</label>
<input type="email" name="signup[signup_email]" id="email" class="form-control" placeholder="Email">
</div>
<div class="form-group">
<label for="email" class="sr-only">First Name </label>
<input type="email" name="signup[signup_firstname]" class="form-control" placeholder="First Name ">
</div>
<div class="form-group">
<label for="email" class="sr-only">Last Name </label>
<input type="email" name="signup[signup_lastname]" class="form-control" placeholder="Last Name ">
</div>
<a class="btn btn-default btn-select">
<input type="hidden" class="btn-select-input" id="" name="signup[signup_age_group]" value="" />
<span class="btn-select-value class="selected"">Age</span>
<span class='btn-select-arrow fa fa-chevron-down'></span>
<ul>
<li>Under 5</li>
<li>5-7</li>
<li>8-10</li>
<li>11-13</li>
<li>14-17</li>
<li>18 and Over</li>
</ul>
</a>
<a class="btn btn-default btn-select">
<input type="hidden" class="btn-select-input" id="" name="signup[signup_reading_level]" value="" />
<span class="btn-select-value class="selected"">Reading Level</span>
<span class='btn-select-arrow fa fa-chevron-down'></span>
<ul>
<li>Pre-K and Kindergarten</li>
<li>1st and 2nd Grade</li>
<li>3rd and 4th Grade</li>
<li>5th and 6th Grade</li>
<li>7th and 8th Grade</li>
<li>9th and 10th Grade</li>
<li>11th and 12th Grade</li>
</ul>
</a>
<a class="btn btn-default ">

<span class="btn-select-value"  style="color:#fff;left: 3%;position: absolute;font-size: 16px;">Favorite Genres </span>

<span style="margin: 0 10px;"> &nbsp; </span>

Biography <input value="Biography" type="checkbox" name="signup[signup_genre][]" >
Drama <input value="Drama" type="checkbox" name="signup[signup_genre][]" >
Fantasy <input value="Fantasy" type="checkbox" name="signup[signup_genre][]" >
Humor <input value="Humor" type="checkbox" name="signup[signup_genre][]" > <br/>
History <input value="History" type="checkbox" name="signup[signup_genre][]" >
Horror <input value="Horror" type="checkbox" name="signup[signup_genre][]" >
Science Fiction <input value="Science Fiction" type="checkbox" name="signup[signup_genre][]" >


</a>
<div class="form-group">
<p><label><input type="checkbox" id="test" name="signup[signup_newsletter]">Would you like to receive updates about new, top-rated stories in your favorite genres?</label></p>
</div>
<div class="form-group">
<label for="email" class="sr-only">Password</label>
<input type="password" name="signup[signup_password]" id="email" class="form-control" placeholder="Password">
</div>

<div class="form-group">
<label for="email" class="sr-only">Confirm Password</label>
<input type="password" name="signup[retype]" id="email" class="form-control" placeholder="Confirm Password">
</div>


<p class="alin"><label>
<input type="checkbox" name="terms" id="terms">By checking this box, I certify that I am either at least 13 years of age, or that this account is being created under the supervision of, and monitored by, a parent or guardian of legal age. I further agree that I, or my parent/guardian, have read and understand The Story Den’s
<a href="<?=g('base_url')?>privacy-policy">Privacy Policy</a> and
<a href="<?=g('base_url')?>terms-of-service">Terms of Service</a>
</label></p>
</div>

<center>
<a href="javascript:void(0);" id="submitSignup" class="btn btn-default form-sec">Submit</a>
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