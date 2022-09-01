<? $this->load->view('account/header_main') ?>

<?

if(!empty($userdata['signup_logo_image'])){
    $img = get_image($userdata['signup_logo_image_path'],$userdata['signup_logo_image']);
}
else{
    $img = g('images_root') ."fan-img.png";
}
?>

<!-- BEGIN CONTENT -->
<div class="col-md-9 col-sm-7">
    <div class="content-page ">

        <div class="row">

            <!-- Profile image start -->
            <div class="col-md-8">
                <div class="form-group">
                    <form action="<?=g('base_url').'account/update-profile-image'?>" method="post" enctype="multipart/form-data" id="form-image" class="profileimg">
                        <input type="hidden" name="signup_id" value="<?=$this->userid?>">
                        <img src="<?= $img ?>" alt="" class="img-circle" />
                        <!-- <label class="fileContainer fdImg">Change Profile Image<input type="file"  name="file"></label>  -->
                          <div class="upload-btn-wrapper">
                            <label>Change Profile Image</label>
                          <button class="mybtn" >Upload a file</button>
                          <input type="file" name="file" id="btn-profile" / >
                          </div>
                    </form>
                </div>
            </div>
            <!-- Profile image end -->

            <form action="<?= g('base_url') ?>account/update_info"
                  method="post" id="saveForm" class="footTop">
                <input type="hidden" name="signup[signup_password]"
                       value="<?= $userdata['signup_password'] ?>">
                <input type="hidden" name="signup[signup_id]"
                       value="<?= $this->userid ?>">
                <input type="hidden" name="signup[signup_type]"
                       value="<?= $userdata['signup_type'] ?>">

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <label>Name</label>
                    <input type="text"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?= $userdata['signup_firstname'] ?>"
                           placeholder="Name *"
                           name="signup[signup_firstname]">

                    <label>Email</label>
                    <input type="text"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?= $userdata['signup_email'] ?>"
                           placeholder="Your Email"
                           name="signup[signup_email]" readonly>

                    <label>Zipcode</label>
                    <input type="number"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?=($userdata['signup_zip']==0)?'':$userdata['signup_zip']?>"
                           placeholder="Zipcode"
                           name="signup[signup_zip]">



                    <!--<label>Business Name</label>
                    <input type="text"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?/*= $userdata['signup_business_name'] */?>"
                           placeholder="Business Name *"
                           name="signup[signup_business_name]">

                    <label>Company</label>
                    <input type="text"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?/*= $userdata['signup_company'] */?>"
                           placeholder="Company"
                           name="signup[signup_company]">-->



                    <div class="white-space-15"></div>
                </div>

                <div class="col-lg-6 col-md-6 col-sm-6">
                    <!--<label>Last Name</label>
                    <input type="text"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?/*= $userdata['signup_lastname'] */?>"
                           placeholder="Last Name *"
                           name="signup[signup_lastname]">-->
                    <label>Address</label>
                    <input type="text"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?= $userdata['signup_address'] ?>"
                           placeholder="Address"
                           name="signup[signup_address]">

                    <label>Country</label>
                    <select name="signup[signup_country]" id="" class="form-control my-form-control my-margin-bottom-15">
                        <?php
                        foreach($countries as $key=>$value):?>
                            <option value="<?php echo $value['country'];?>" <?php echo ($value['country']==$userdata['signup_country'])?'selected':''?>><?php echo $value['country'];?></option>
                        <? endforeach;
                        ?>
                    </select>

                    <label>Contact</label>
                    <input type="text"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?= $userdata['signup_contact'] ?>"
                           placeholder="Contact"
                           name="signup[signup_contact]">
                   <!-- <label>Business Address</label>
                    <input type="text"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?/*= $userdata['signup_address2'] */?>"
                           placeholder="Business Address"
                           name="signup[signup_address2]">-->

                    <!--<label>Industry</label>
                    <input type="text"
                           class="form-control my-form-control my-margin-bottom-15"
                           value="<?/*= $userdata['signup_industry'] */?>"
                           placeholder="Industry *"
                           name="signup[signup_industry]">-->
                </div>

                <div class="col-lg-12 col-md-6 col-sm-6">

                    <!--<input type="text"
                                                                               class="form-control my-form-control my-margin-bottom-15"
                                                                               placeholder="Phone *"
                                                                               value="<? /*= $userdata['signup_telephone'] */ ?>"
                                                                               name="signup[signup_telephone]">-->

                </div>

                <div class="col-lg-6 col-md-6 col-sm-6 mtop10">
                  <button value="Save Now" id="submitInfo" class="">Save Now</button>
                </div>

            </form>
        </div>

    </div>
</div>
<!-- END CONTENT -->

<? $this->load->view('account/footer_main') ?>

<script type="text/javascript">
    $(document).ready(function () {
        $("#submitInfo").click(function () {
            var data = $("#saveForm").serialize();
            var url = $("#saveForm").attr("action");
            AjaxRequest.fire(url, data);
            //window.location = '<?=g("base_url")?>';
            return false;
        });

        // Profile image update start (not implement)
        $("#btn-profile").on('change', function() {
            // Get file obj
            var file_obj = $(this);
            // Define allow extension
            var ext = file_obj.val().split('.').pop().toLowerCase();

            // Check ext empty or not (empty means no file selected)
            if(ext!=''){
                // Other extension
                if($.inArray(ext, ['png','jpg','jpeg']) == -1) {
                    file_obj.val('');
                    AdminToastr.error('Invalid file','Error');
                }
                // Upload file
                else{
                    var data = new FormData(document.getElementById("form-image"));
                    var url = $("#form-image").attr("action");

                    FileUploadScript.fire(url, data, 'json',true) ;

                }
            }
        });
        // Profile image update end

    });
</script>