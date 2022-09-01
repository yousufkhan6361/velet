<!-- Banner Row -->
<div class="topRow">
  <div class="container">
    <h3> <a href="<?=g('base_url')?>">Home </a> <i class="fa fa-angle-right" aria-hidden="true"></i> Resources <i class="fa fa-angle-right" aria-hidden="true"></i> <span> Newsletter </span></h3>
  </div>
</div>

<!-- Banner Row  Ends--> 

<!-- Inpage-->

<section class="inpage resources">
  <div class="container">
    <div class="row">      
      <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
        <div class="reRight">
          <div class="row">
            <div class="col-xs-12 col-sm-6 col-sm-offset-3 col-md-6 col-md-offset-3">

                        <h1 class="mainh text-center"> newsletter </h1>

                <div class="rnesleter">
<form id="newsletter_form" method="post" action="<?=g('base_url')?>contact_us/newsletter">
                  <div class="newform">
                    <label> Enter your Name, Email & SUbsribing newsletter </label>
                    <div class="form_field">
                      <input type="text" class="form-control"  placeholder="Name" name="newsletter[newsletter_name]">
                      <div class="clearfix"> </div>
                       <span>  <i class="fa fa-user" aria-hidden="true"></i> </span>
                    </div>
                       <div class="form_field">
                      <input type="text"  class="form-control" placeholder="Email" name="newsletter[newsletter_email]">
                        <span>  <i class="fa fa-envelope" aria-hidden="true"></i> </span>
                        <div class="clearfix"> </div>
                    </div>
                       <div class="form-group text-center">
                      <a href="javascript:void(0)" type="submit"  placeholder="" value="Subscribe" class="form-control" onclick="ajax_newsletter_form('newsletter_form')">Subscribe</a> 
                    <!--  <a href="javascript:void(0)" class="btn btn1 " onclick="ajaxform('contact_us_form')"> send my message</a> -->                     
                    </div>
                  </div>
</form>                  
                </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<script>       
function ajax_newsletter_form(form) {
          var data  = $('#'+form).serialize();
          var url = $('#'+form).attr('action');
          var res = AjaxRequest.formrequest(url, data) ;
          if(res.status === 1)
          {
                AdminToastr.success(res.txt,'Success');

                $('#'+form)[0].reset();
                setTimeout(function() {
                      location.reload();
                    }, 2000);
                
                if(res.reload === 1)
                {
                  // window.location  = res.url;
                  // window.location.reload();
                }
                return false;
          }
          else
          {
                AdminToastr.error(res.txt,'Error');
                
          }
          return false;
}
</script>