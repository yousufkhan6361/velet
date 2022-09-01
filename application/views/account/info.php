<? $this->load->view("account/header"); ?>
<? if(!empty($userdata['signup_profile_image'])){
   $img = get_image($userdata['signup_profile_image_path'],$userdata['signup_profile_image']);
}else{
    $img = g('images_root') ."fan-img.png";
}

//debug($userdata);
?>
<div class="signup"  style="">
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
<form action="<?= g('base_url') ?>account/update_info" method="post" id="saveForm">
<input type="hidden" name="signup[signup_password]" value="<?=$userdata['signup_password']?>">
<!-- <input type="hidden" name="signup[signup_password_confirm]" value="<?= $userdata['signup_password_confirm'] ?>"> -->
<input type="hidden" name="signup[signup_id]" value="<?= $this->userid ?>">
<!-- <input type="hidden" name="signup[signup_type]" value="<?= $userdata['signup_type'] ?>"> -->
<!-- <input type="hidden" name="signup[signup_form]" value="1"> -->
<div class="col-lg-6 col-md-6 col-sm-6">
<label>Name</label>
<input type="text" class="form-control my-form-control my-margin-bottom-15" value="<?= $userdata['signup_firstname'] ?>"placeholder="Name *" name="signup[signup_firstname]">
<label>Email</label>
<input type="text" class="form-control my-form-control my-margin-bottom-15" value="<?= $userdata['signup_email'] ?>" placeholder="Email" name="signup[signup_email]" readonly>
<label>Phone</label>
<input type="text" class="form-control my-form-control my-margin-bottom-15" value="<?=$userdata['signup_phone']?>" placeholder="Phone *" name="signup[signup_phone]">
<label>Address</label>
<input type="text" class="form-control my-form-control my-margin-bottom-15" value="<?= $userdata['signup_address'] ?>" placeholder="Address *"name="signup[signup_address]">
<div class="white-space-15"></div>
</div>
<div class="col-lg-12 col-md-6 col-sm-6">
</div>
<div class="col-lg-6 col-md-6 col-sm-6">
<input type="submit" class="hvr-shutter-out-vertical registerSec" value="Save Now" id="submitInfo">
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
<!--Signup-->
<script type="text/javascript">
    $(document).ready(function () {
        $("#submitInfo").click(function () {
            var data = $("#saveForm").serialize();
            var url = $("#saveForm").attr("action");
            var response = AjaxRequest.formrequest(url, data);
            // success
            if (response.status==1) {
              AdminToastr.success(response.txt,'Success');
              setTimeout(function() {
                window.location.reload();
                    }, 2000);
            }else{
              AdminToastr.error(response.txt,'error'); 
            }
            return false;
        });     
    });
</script>
<script>
function isNumberKey_num(evt)
{
 var charCode = (evt.which) ? evt.which : event.keyCode
 if (charCode > 31 && (charCode < 48 || charCode > 57))
 return false;
return true;
}
</script>