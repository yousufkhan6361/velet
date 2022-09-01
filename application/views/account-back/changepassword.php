<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<? $this->load->view('account/header_main') ?>




<!-- BEGIN CONTENT -->
<div class="col-md-9 col-sm-7">



    <div class="content-page">



        <h3>Change Password</h3>



        <div class="row">

            <form id="forgotform" method="post">

                <div class="col-lg-6 col-md-6 col-sm-6">

                    <input type="password" name="signup[signup_password]" class="form-control my-form-control my-margin-bottom-15" id="forgotpass" value="" placeholder="Enter Your New Password *">

                    <div class="white-space-15"></div>
                    <br>
                    <a href="javascript:void(0)" id="typebtn" class="btn btn-danger cancel btnnext">Proceed</a>

                </div>





            </form>

        </div>



    </div>

</div>



<? $this->load->view('account/footer_main') ?>



<!-- END CONTENT -->

<script type="text/javascript">

    $(document).ready(function () {

        $("#submitInfo").click(function () {

            var data = $("#saveForm").serialize();

            var url = $("#saveForm").attr("action");

            var response = AjaxRequest.fire(url, data);

            // success

            if (response.status) {

                location.reload();

            }

            return false;

        });




           $("#typebtn").click(function(){
    var forgotpass = $('#forgotpass').val();
    if(forgotpass == "")
    {
      AdminToastr.error("Please Enter Password",'Error');
    }
    else{
      var data = $("#forgotform").serialize();
      var url = $("#forgotform").attr("action");
      $.ajax({
            type: "POST",
            url:  "<?=g('base_url')?>account/update_password",
            data:  data,
             success: function(response)
            {
                Loader.hide();
                // var res = JSON.parse(response.html);
               

                 if(response.status == 1){
                    AdminToastr.success('Success','Success');
                }
                else{
                  AdminToastr.success('Password Successfully Changed','Success');
                }
            },
            beforeSend: function()
            {
                Loader.show();
            }
        });
        return false;
}
  });

    });

</script>