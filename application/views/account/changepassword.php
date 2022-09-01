<? $this->load->view("account/header"); ?>

<div class="signup"  style=" 

">



<div class="container" id='goTo'>

       <?php $this->load->view('widgets/breadcrum'); ?>

        <!-- BEGIN SIDEBAR & CONTENT -->

        <div class="row margin-bottom-40">

          <!-- BEGIN SIDEBAR -->

          <div class="sidebar1 col-md-3 col-sm-3">

         <? $this->load->view("account/menu"); ?>

         </div>

          <!-- END SIDEBAR -->



          <!-- BEGIN CONTENT -->

          <div class="col-md-9 col-sm-7">

            <div class="content-page">

              

              <div class="row">



<form action="" id="forgotform">



                <div class="col-lg-6 col-md-6 col-sm-6">

                    <label>Current Password *</label>

                    <input type="password"

                           class="form-control my-form-control my-margin-bottom-15"

                           name="signup_password_current">

                   <label>New Password *</label>

                    <input type="password"

                           class="form-control my-form-control my-margin-bottom-15"

                           name="signup[signup_password]">



                    <label>Confirm Password *</label>

                    <input type="password"

                           class="form-control my-form-control my-margin-bottom-15" 

                           name="signup_password_confirm" >

                    







                    <div class="white-space-15"></div>

                </div>







                <div class="col-lg-12 col-md-6 col-sm-6">



  

                </div>



                <div class="col-lg-6 col-md-6 col-sm-6">

                    <input type="button" class="hvr-shutter-out-vertical registerSec"

                           value="Change Now" id="typebtn">

                </div>



</form>

        </div>



            </div>

          </div>

          <!-- END CONTENT -->

        </div>

        <!-- END SIDEBAR & CONTENT -->

      </div>



</div>

<script>

$("#typebtn").click(function () {

            // Loader.show();

            setTimeout(function () {

                // Prevent form submit

                //e.preventDefault();

                var obj = $("#forgotform");

                // Get form data

                var data = obj.serialize();

                // Get post url

                var url = base_url + "account/update-password";

                // Submit action

                var response = AjaxRequest.fire(url, data);

                if(response.status){

                    setTimeout(function () {

                    location.reload();

                },2000);

                }

            },1000);

            // Add return

            return false;

        });

</script>