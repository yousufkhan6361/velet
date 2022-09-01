<!--Inner Start-->
<div class="container">
<div class="row">
<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
</div>
<div class="col-xs-6 col-md-6 col-lg-6 col-sm-6">
<section id="login">
<div class="inner">
<div class="col-xs-12">
<div class="form-wrap">
<h1>Login to Your Account</h1>
<center>
<hr>
</center>
<center>

 <form role="form" method="post" id="FormLogin" action="">
  <div class="form-group ">
    <label for="email">Email Address</label>
    <input type="email" class="form-control" id="email" placeholder="Email" name="signup[signup_email]">
  </div>

  <div class="form-group">
    <label for="pwd">Password</label>
    <input type="password" class="form-control" id="pwd" placeholder="Password" name="signup[signup_password]">
  </div>

  <button type="submit" class="btn btn-default login-button LoginSubmit">Submit</button>
</form>

</center>
</div>
</div> <!-- /.col-xs-12 -->
</div> <!-- /.container -->
</section>
</div>
<div class="col-xs-3 col-md-3 col-lg-3 col-sm-3">
</div>
</div>
</div>



<script type="text/javascript">
	$(document).ready(function(){
		$(".LoginSubmit").click(function(){
			var data = jQuery("#FormLogin").serialize();
			var url = "<?=g('base_url')?>account/do_login";
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
		});
	});
</script>