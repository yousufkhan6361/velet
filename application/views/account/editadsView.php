<style type="text/css">

.table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {

padding: 8px;
line-height: 1.42857143;
vertical-align: middle;
border-top: 1px solid #ddd;
color: #555555;
}
th {
text-align: center;
}
td {
text-align: center;
}
td {
text-align: -webkit-center;
}
.update-icon {
color: #fc5a5a;
background: white;
font-size: 20px;
display: block;
text-align: center;
width: 32px;
height: 32px;
border: 1px solid #d8d8d8;
border-radius: 50px;
line-height: 30px;
margin-top: 15px;
margin-right: 7px;
}

.update-icon:hover {
background: #282828;
color: #fff;
}

.breadcrumba:hover,.breadcrumba a:focus {
color: #fff!important;
text-decoration:none!important;
}

.editOption{
    color: #fc5a5a;
    background: white;
    font-size: 20px;
    display: block;
    text-align: center;
    /* width: 49px; */
    height: 32px;
    border: 1px solid #d8d8d8;
    border-radius: 50px;
    line-height: 30px;
    margin-top: 15px;
    margin-right: 7px;
}

.hd{
  font-size: 20px;
    /* text-align: center; */
    /* color: #000; */
    font-weight: 700;
   /* margin-bottom: 40px;*/
    float: left;
}
</style>

<? $this->load->view("account/header"); ?>

<div class="signup">
<div class="container" id='goTo'>

<?php $this->load->view('widgets/breadcrum'); ?>

<!-- BEGIN SIDEBAR & CONTENT -->
<div class="row margin-bottom-40">
<!-- BEGIN SIDEBAR -->
<div class="sidebar1 col-md-3 col-sm-3">
<? $this->load->view("account/menu"); ?>

<?php //debug($ordersData); ?>
</div>
<!-- END SIDEBAR -->
<!-- BEGIN CONTENT -->
<div class="col-md-9 col-sm-7">
<div class="content-page">
<div class="">
<div class="portlet grey-cascade box">
    <div class="portlet-body">
      <div class="table-responsive">

      <?php if(empty($adsData)){ ?>

        <h2 style="margin-bottom: -15px;font-weight: 700;">Ads not added yet </h2>
        <h1 class="hd">You may submit your ad now 
          <a href="<?=g('base_url')?>form_add">
            <button class="btn btn-info btn-sm">Submit Ad</button></a>        
        </h1>

      <?php }else{ ?>

        <table class="table table-hover table-bordered table-striped">
         <thead>
        <tr>
          <th>No.</th>
          <th>Ad Image</th>
          <th>Ad Title</th>
          <th>Ad Category</th>
          <th>Email</th>
          <th>Action</th>
        </tr>
        </thead>
        <tbody>
      <?php foreach ($adsData as $key => $ad) { ?>

      <?php
      $catId = $ad['ads_category_id'];

      $par['where']['category_id'] = $catId;
      $catData = $this->model_category->find_one($par);

      ?>
        
        <tr>
          <td><?=$key+1?></td>
          <td><img class="response" style="width: 100px; height: 100px;object-fit: cover;" src="<?=get_image($ad['ads_image_path'],$ad['ads_image'])?>"></td>

          <td><?=$ad['ads_title']?></td>
          <td><?=$catData['category_name']?> </td>
          <td><!-- <span class="label label-sm label-success" style="font-size: 14px"> -->
          <?=$ad['ads_email']?>
          <!-- </span> --></td>

          <td align="center">
            <a href="<?=g('base_url')?>account/edit-form/<?=$ad['ads_slug']?>" data-invoiceid="49" class="" style="color:#000">
              <i class="fas fa-edit editOption"></i></a>
          </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>

      <?php } ?>
      </div>
    </div>
  </div>
</div>
</div>
</div>
<!-- END CONTENT -->
</div>
<!-- END SIDEBAR & CONTENT -->
</div>
</div>

<style type="text/css">
.modal-dialog {
margin: 30px auto;
width: 90%;
}
</style>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog modal-lg" style="transform: inherit;" role="document">
<div class="modal-content">
<!-- <div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
</button>
<h4 class="modal-title" id="myModalLabel" style="color:#000;">Invoice Detail</h4>
</div> -->
<div class="modal-body" id="bodyID"  style="color:#000;">
<div class="container bootdey">
</div>
</div>
</div>
</div>
</div>

<script type="text/javascript">
$(document).ready(function () { 
$("#submitInfo").click(function(){
var data = $("#saveForm").serialize();
var url = $("#saveForm").attr("action");
AjaxRequest.fire(url, data) ;
//window.location = '<?=g("base_url")?>';
return false;
});
});


// $(document).ready(function(){
// $(".popupInvoice").click(function(){
// var order_id = $(this).attr("data-invoiceID");
// //$('#myModal').modal('show');
// var site_url = "<?=g('base_url')?>";
// $.ajax({
// type: "POST",
// url: site_url+"account/getinvoice2",
// data:  "order_id="+order_id,
// dataType: "html",
// success: function(response)
// {
// Loader.hide();
// $('#myModal').modal('show');
// $(".bootdey").html(response);
// },    
// beforeSend: function()
// {
// Loader.show();
// }
// });
// });
// });

</script>