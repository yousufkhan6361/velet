<style type="text/css">
  .link{
    background: #ded0b3;
    padding: 11px;
    border-radius: 10px;
    font-family: 'Lato';
  }
</style>
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
    <div class="col-sm-12">
    <?php if($affiliateLink == ""){ ?>
      <h3 class="link">Link not generated</h3>

    <?php }else{ ?>

      <h3 class="link" id="copyLink"><?=$affiliateLink?></h3>
  <button class="btn btn-warning" style="margin-top: -47px;font-size: 10px;color: black;font-weight: bold;font-family: 'Lato';" onclick="copyToClipboard('#copyLink')">Copy Link</button>
      
    <?php } ?>



      <!-- <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p> -->
    </div>
    
    
  </div>

<div class="row">
  <div class="col-md-12">
    <form class="" id="affiliate-form" action="<?=g('base_url')?>contact_us/affiliate" method="post">
      <input type="hidden" name="affiliate[affiliate_userid]" value="<?=$userId?>">
      <input type="hidden" name="affiliate[affiliate_username]" value="<?=$userName?>">
      <input type="hidden" name="affiliate[affiliate_useremail]" value="<?=$userEmail?>">
      <button class="btn btn-info btn-lg btnAffiliate">Generate Link</button>
    </form>
  </div>
</div>
</div>
</div>
<!-- END CONTENT -->
</div>
<!-- END SIDEBAR & CONTENT -->
</div>
</div>
<!--Signup-->

<script>
function copyToClipboard(element) {
  var $temp = $("<input>");
  $("body").append($temp);
  $temp.val($(element).text()).select();
  document.execCommand("copy");
  $temp.remove();
  AdminToastr.success('Link Copied!','success'); 
}
</script>


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