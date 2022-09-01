<?global $config;
$model_heads = explode("," , $dt_params['dt_headings'] );
?>
<div class="row">
  <div class="col-md-12">
    <!-- BEGIN VALIDATION STATES-->
      <div class="tabbable tabbable-custom boxless tabbable-reversed">
        <ul class="nav nav-tabs">
              <li class="active">
                <a href="#tab_0" data-toggle="tab">
                Brand </a>
              </li>
              <?if($form_data){?>
              <li>
                <a href="#tab_1" data-toggle="tab">
                Size Charts </a>
              </li>
              <?}?>
            </ul>
        <div class="tab-content">
            <div class="tab-pane active" id="tab_0">
              <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-shopping-cart"></i><?=humanize($class_name)?>
                        <small>Add Details to <?=humanize($class_name)?></small>
                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                  </div>
                </div>
                <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  <?=$this->load->view("admin/widget/form_generator");?>
                  <!-- END FORM-->
                </div>
                <!-- END VALIDATION STATES-->
              </div>
            </div>
            <?
            // Images only in edit mode.  
            if($form_data){?>
            <div class="tab-pane" id="tab_1">
                  <div class="portlet box green">
                <div class="portlet-title">
                  <div class="caption">
                    <i class="fa fa-shopping-cart"></i><?=humanize($class_name)?>
                        <small>Subset for <?=humanize($class_name)?></small>

                  </div>
                  <div class="tools">
                    <a href="javascript:;" class="collapse">
                    </a>
                    <a href="javascript:;" class="reload">
                    </a>
                  </div>
                </div>
                <div class="portlet-body form">
                  <!-- BEGIN FORM-->
                  <?=$this->load->view("admin/brand/size_charts");?>
                  <!-- END FORM-->
                </div>
                <!-- END VALIDATION STATES-->
              </div>
            </div>
            <?}?>
          </div>
      </div>
  </div>
</div>
<script>
  $(document).ready(function() {    
      Metronic.init(); // init metronic core components
      QuickSidebar.init(); // init quick sidebar
      Demo.init(); // init demo features
      UIAlertDialogApi.init(); //UI Alert API
	  if(!<?=$id?>) // when add brand detail, disabled images and item set tab
	  {
		$('.tabbable li a[href=\#tab_1]').css({"background-color": "#CFD1CF",
												"color": "#fff"
												});
		$('.tabbable li a[href=\#tab_1]').click(false);
	  }	
	  if('<?=$_GET["msgtype"]?>' == 'success'){ // when add/edit brand detail, switched to images tab
		$('.tabbable li a[href=\#tab_1]').click();
	  }
	  
      <?if($error)
          echo "AdminToastr.error('".str_replace("\n","",validation_errors('<div>', '</div></br>'))."');";
      ?>
  });
</script>
