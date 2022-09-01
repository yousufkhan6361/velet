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
    <?php if(count($ordersData) > 0 && $orderStatus == "manual"){ ?>

      <table class="table table-hover table-bordered table-striped">
         <thead>
        <tr>
          <th>No.</th>
          <th>Order#</th>
          <th>Order Date</th>
          <th>Total</th>
          <th>Item Status</th>
          <th>Order Details</th>
        </tr>
        </thead>
        <tbody>
       
      <?php //debug($orderStatus); ?>
       <?php foreach ($ordersData as $key => $value) {  ?>

        <tr>
          <td><?=$key+1;?></td>
          <td><?=$value['order_id']?></td>
          <td>
             <?=date('d M Y',strtotime($value['order_createdon']))?>
          </td>
          <td>
              £<?=number_format((float)$value['order_total'], 2, '.', '')?> 
            <!--  <?=$value['order_currency_symbol'];?> <?=number_format((float)$value['order_total'], 2, '.', '');?> -->
          </td>
          <td>
      <?php if($value['order_payment_status'] == 1){ ?>
            <span class="label label-sm label-success" style="font-size: 14px">
            Payment Accepted
            </span>
          <?php } elseif($value['order_payment_status'] == 2){ ?>
            <span class="label label-sm label-warning" style="font-size: 14px">
            Payment Declined
            </span>
          <?php } elseif($value['order_payment_status'] == 3){ ?>

            <span class="label label-sm label-danger" style="font-size: 14px">
            Transaction Failed
            </span>
          <?php }elseif($value['order_payment_status'] == 4){ ?>
            <span class="label label-sm label-info" style="font-size: 14px">
            Held for Review
            </span>
          <?php }elseif($value['order_payment_status'] == 0){ ?>
            <span class="label label-sm label-warning" style="font-size: 14px">
            Payment Pending
            </span>
          <?php } ?>
          </td>
          <td align="center">
            <a href="<?=g('base_url')?>account/getinvoice2?order_id=<?=$value['order_id']?>&status=<?=$orderStatus?>" data-invoiceID="<?=$value['order_id']?>" class="popupInvoice" style="color:#000">
              <i class="fa update-icon fa fa-eye" aria-hidden="true" title="View Order"></i></a>
          </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>


    <?php }else if(count($ordersData) > 0 && $orderStatus == "autorenewal"){ ?>

      <table class="table table-hover table-bordered table-striped">
         <thead>
        <tr>
          <th>No.</th>
          <th>Order#</th>
          <th>Order Date</th>
          <th>Total</th>
          <th>Item Status</th>
          <th>Order Details</th>
        </tr>
        </thead>
        <tbody>
       
      <?php //debug($orderStatus); ?>
       <?php foreach ($ordersData as $key => $value) {  ?>

        <tr>
          <td><?=$key+1;?></td>
          <td><?=$value['subscription_id']?></td>
          <td>
             <?=date('d M Y',strtotime($value['subscription_package_start']))?>
          </td>
          <td>
              £<?=number_format((float)$packageDetail['packages_price'], 2, '.', '')?> 
            <!--  <?=$value['order_currency_symbol'];?> <?=number_format((float)$value['order_total'], 2, '.', '');?> -->
          </td>
          <td>
      <?php if($value['subscription_payment_status'] == 1){ ?>
            <span class="label label-sm label-success" style="font-size: 14px">
            Payment Accepted
            </span>
          <?php } elseif($value['subscription_payment_status'] == 2){ ?>
            <span class="label label-sm label-warning" style="font-size: 14px">
            Payment Declined
            </span>
          <?php } elseif($value['subscription_payment_status'] == 3){ ?>

            <span class="label label-sm label-danger" style="font-size: 14px">
            Transaction Failed
            </span>
          <?php }elseif($value['subscription_payment_status'] == 4){ ?>
            <span class="label label-sm label-info" style="font-size: 14px">
            Held for Review
            </span>
          <?php }elseif($value['subscription_payment_status'] == 0){ ?>
            <span class="label label-sm label-warning" style="font-size: 14px">
            Payment Pending
            </span>
          <?php } ?>
          </td>
          <td align="center">
            <a href="<?=g('base_url')?>account/getinvoice2?order_id=<?=$value['subscription_id']?>&status=<?=$orderStatus?>" data-invoiceID="<?=$value['order_id']?>" class="popupInvoice" style="color:#000">
              <i class="fa update-icon fa fa-eye" aria-hidden="true" title="View Order"></i></a>
          </td>
        </tr>
        <?php } ?>
        </tbody>
        </table>


    <?php }else{ ?>

    <div class="aboutUs">
    <h2><center>No record found</center></h2>
    </div>
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