<style type="text/css">
  .login-form input {
    height: 55px;
    line-height: 55px;
    margin-bottom: 20px;
    background: #f2f2f2;
    border: #f2f2f2;
}
</style>
<style type="text/css">
 .productBanner.retailBanner {
    background: url() no-repeat;
    background-size: cover;
    padding: 7% 0;
}
</style>
<section class="innerBanner productBanner blogBanner">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-sm-12">
        <!-- <h3><?=$banners['banner_title']?></h3> -->
      </div>
    </div>
  </div>
</section>
<!-- <section class="contact-Sec ">

  <div class="container" style="padding: 55px;">

<div class="col-md-6 col-xs-12 col-sm-6 col-md-offset-3" style="border: 1px solid #dedede;padding: 38px;">
      <h1 style="text-align: center;">Reset Password</h1>

      <form id="forgotPassword" action="javascript:void(0)" method="post" class="conpageform">
        <input type="hidden" class="form-control" name="user_id"  value="<?=$user_id?>">
          <input type="password" class="form-control" name="newPassword"  placeholder="Enter Your New Password">
          <span class="help-block"></span>
            <div class="top-search">
                <button id="submitForgot" class="loginbutton btn btn-default">Reset</button>
        </div>
        <div class="row omb_row-sm-offset-3">
        </div>  
        </form>
    </div>

  </div>

</section> -->

<section class="loginlogout-sec" style="padding:30px;">
    <div class="container">
      <div class="row">
        <div class="col-md-9 col-md-offset-1 col-sm-10 col-xs-12">
          <div class="login-form">
            <h2 class="text-center" style="text-transform: uppercase;color: black; font-size: 22px;"> Reset Password</h2>
         <form id="forgotPassword" action="javascript:void(0)" method="post" class="conpageform">

            <div class="form-group">
              <div class="col-md-6 col-md-offset-3">
                <input type="hidden" class="form-control" name="user_id"  value="<?=$user_id?>">
                <input type="password" class="form-control" name="password"  placeholder="Enter Your New Password">
              </div>
            </div>


            <div class="form-group">
              <!-- <label class="control-label col-md-2 col-sm-2 col-xs-12" for="email">Email:</label> -->
              <div class="col-md-6 col-md-offset-3">
           <button class="btn btn-success btn-lg" id="submitForgot" style="width: 100%; background: #da3038;">Reset</button>
                </div>
            </div>
        </form>
        </div>
      </div>
    </div>
  </div>
  </section>


<script type="text/javascript">

    $(document).ready(function(){

        $("#submitForgot").click(function(){

            var data = jQuery("#forgotPassword").serialize();
            var url = "<?=g('base_url')?>account/resetpasswordclient";
            var response = AjaxRequest.formrequest(url, data) ;
            
            // console.log(response);
            // return false;

            if(response.status == 1)
            {
                AdminToastr.success("Your password has been changed.",'Success');

                setTimeout(function(){
                window.location='<?=g('base_url')?>';
                },2000)
            }
            else
            {
                AdminToastr.error("Your provided email is not correct.",'Error'); 
            }
            return false;
        });

    });

</script>











