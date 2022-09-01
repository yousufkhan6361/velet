<?global $config;
$model_heads = explode("," , $dt_params['dt_headings'] );
?>
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN VALIDATION STATES-->
    <div class="portlet box green">
      <div class="portlet-title">
        <div class="caption">
          <i class="fa fa-shopping-cart"></i><?=humanize($class_name)?>
              <small>Update <?=humanize($class_name)?></small>

        </div>
        <div class="tools">
          <a href="javascript:;" class="collapse">  
          </a>
          <a href="#portlet-config" data-toggle="modal" class="config">
          </a>
          <a href="javascript:;" class="reload">
          </a>
          <a href="javascript:;" class="remove">
          </a>
        </div>
      </div>
      <div class="portlet-body form">
        <!-- BEGIN FORM-->
        <form class="cmxform form-horizontal tasi-form" id="<?=$form_id ?>" method="POST" action="" enctype="multipart/form-data">
          <div class="form-body">
            
            <div class="alert alert-danger display-hide">
              <button class="close" data-close="alert"></button>
              You have some form errors. Please check below.
            </div>
            <div class="alert alert-success display-hide">
              <button class="close" data-close="alert"></button>
              Your form validation is successful!
            </div>

          <h3 class="form-section">SET Currency PARAMETERS</h3>
            <div>
              <?foreach ($currency as $curr) { ?>
                <div class="form-group ">
                      <label class="control-label col-md-2 " for="con<?=$curr['currency_id']?>"> 
                          <?=humanize($curr['currency_name'])?>
                      </label>
                      <div class="col-md-9">
                        <input  type="text" name="currency_attr[<?=$curr['currency_id']?>]"  value="<?=$curr['currency_rate']?>"  id="con<?=$curr['currency_id']?>" class="form-control"/>
                      </div>
                </div>
              <?}?>  
            </div>
        </section>
        
      <script>
        $().ready(function() {
          // validate the <?=$form ?> 
          $("#<?=$form_id?>").validate({
            rules:{ <?=rtrim($validation_string, ",") ?> } ,
            errorElement:'span' ,
            errorClass:'has-error help-block',
            highlight: function(element, errorClass, validClass) {
              $(element).closest(".form-group").addClass("has-error");
            },
            unhighlight: function(element, errorClass, validClass) {
              $(element).closest(".form-group").removeClass("has-error");
            },
            invalidHandler: function(event, validator) {
            // 'this' refers to the form AdminToastr
            var errors = validator.numberOfInvalids();
            console.log(errors);

              if (errors) {
                var message = 'Failed to validate form. Total of ' + errors + ' invalid fields found.';
                AdminToastr.error(message, "Form Submission Failed");
              } 
            }
          });
        });
      </script>

      <div class="form-actions">
            <div class="row">
              <div class="col-md-offset-3 col-md-9">
                <button type="submit" class="btn green">Submit</button>
                <button type="button" class="btn default">Cancel</button>
              </div>
            </div>
          </div>
        </form>
        <!-- END FORM-->
      </div>
      <!-- END VALIDATION STATES-->
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {    
      Metronic.init(); // init metronic core components
      Layout.init(); // init current layout
      QuickSidebar.init(); // init quick sidebar
      Demo.init(); // init demo features
      UIAlertDialogApi.init(); //UI Alert API
      <?if($error)
          echo "AdminToastr.error('".str_replace("\n","",validation_errors('<div>', '</div></br>'))."');";
      ?>
  });
</script>
