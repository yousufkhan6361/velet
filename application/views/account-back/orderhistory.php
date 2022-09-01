<br>
<br>
<br>
<br>
<br>
<br>
<br>

<? $this->load->view("account/header"); ?>
<!--login-banner-->

<div class="signup myfont">

<div class="container" id='goTo'>
        <ul class="breadcrumb">
            <li><a href="<?=g('base_url')?>">Home</a></li>
            <li class="active"><?=$title?></li>
        </ul>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <? $this->load->view("account/menu"); ?>
          <!-- END SIDEBAR -->

          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            
            <div class="content-page">
              
            	<div class="row">
                <div class="portlet grey-cascade box">
                          <div class="portlet-body">
                            <div class="table-responsive">
                              <table class="table table-hover table-bordered table-striped">
                              <thead>
                              <tr>
                                <th>Order#</th>
                                <th>Order Date</th>
                                <th>Total</th>
                                <th>Item Status</th>
                                <th>View Detail</th>
                              </tr>
                              </thead>
                              <tbody>
                              <?php
                             // / debug($orders);exit;
                              foreach ($orders as $key => $value) {                               
                              ?>
                              <tr>
                                <td><?=$value['order_id']?></td>
                                <td>
                                   <?=date('d M Y',strtotime($value['order_createdon']))?>
                                </td>
                                <td>
                                   <?=price($value['order_item_subtotal']);?>
                                </td>
                                <td>
                                <?php
                                if($value['order_payment_status'] == 1){
                                ?>
                                  <span class="label label-sm label-success" style="font-size: 22px">
                                  Payment Accepted
                                  </span>
                                <?php
                                }
                                elseif($value['order_payment_status'] == 2){
                                ?>
                                  <span class="label label-sm label-warning" style="font-size: 22px">
                                  Payment Declined
                                  </span>
                                <?php
                                }
                                elseif($value['order_payment_status'] == 3){
                                ?>
                                  <span class="label label-sm label-danger" style="font-size: 22px">
                                  Transaction Failed
                                  </span>
                                <?php
                                }
                                elseif($value['order_payment_status'] == 4){
                                ?>
                                  <span class="label label-sm label-info" style="font-size: 22px">
                                  Held for Review
                                  </span>
                                <?php
                                }
                                elseif($value['order_payment_status'] == 0){
                                ?>
                                  <span class="label label-sm label-default" style="font-size: 22px">
                                  Order Placed
                                  </span>
                                <?php
                                }
                                ?>
                                </td>
                                  <td>
                                  <a href="javascript:void(0);" data-invoiceID="<?=$value['order_id']?>" class="popupInvoice" style="color:#000">View</a>
                                </td>
                                
                              </tr>
                              <?php
                              }
                              ?>
                              </tbody>
                              </table>
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

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
<div class="modal-dialog" role="document" style="width: 1300px;">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
<h4 class="modal-title" id="myModalLabel" style="color:#000;">Invoice Detail</h4>
</div>
<div class="modal-body" id="bodyID"  style="color:#000;">

</div>
</div>
</div>
</div>
<!--Signup-->

<script type="text/javascript">
$(document).ready(function () {	
	$("#submitInfo").click(function(){
	var data = $("#saveForm").serialize();
	var url = $("#saveForm").attr("action");
	AjaxRequest.fire(url, data) ;
	//window.location = '<?=g("base_url")?>';
	return false;
	});





    $(".popupInvoice").click(function(){

    // console.log('dsf');
    var order_id = $(this).attr("data-invoiceID");
    //$('#myModal').modal('show');
    var site_url = "<?=g('base_url')?>";
    $.ajax({
    type: "POST",
    url: site_url+"account/getinvoice",
    data:  "order_id="+order_id,
    dataType: "html",
    success: function(response)
    {
      Loader.hide();
      $('#myModal').modal('show');
      $("#bodyID").html(response);
    },    
    beforeSend: function()
    {
      Loader.show();
    }
    });



  });

});



</script>