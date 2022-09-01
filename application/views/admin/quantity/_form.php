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
              <small>Add Details to <?=humanize($class_name)?></small>

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
        <?$this->load->view("admin/widget/form_generator");?>
        <!-- END FORM-->
      </div>
      <!-- END VALIDATION STATES-->
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
      Metronic.init(); // init metronic core components
      QuickSidebar.init(); // init quick sidebar
      Demo.init(); // init demo features
      UIAlertDialogApi.init(); //UI Alert API
      <?if(isset($error))
          echo "AdminToastr.error('".str_replace("\n","",validation_errors('<div>', '</div></br>'))."');";
      ?>
      <?
      // select2-chosen-1
      // Set Select 2 value edit
      if($this->uri->segment(4)!=null){
      $data = $this->model_product->get_course_name($form_data['quantity']['quantity_product_id']);
      ?>
      window.onload = function(){
          $('#select2_cus_quantity_product_id').val(<?=$form_data['quantity']['quantity_product_id']?>);
          $('#select2-chosen-1').html('<?=$data['product_name']?>');
      };
      <? }?>
  });
</script>

