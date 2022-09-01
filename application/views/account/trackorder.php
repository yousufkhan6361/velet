

<? $this->load->view('account/header_main') ?>


<!-- BEGIN CONTENT -->
<div class="col-md-9 col-sm-7">


    <div class="content-page">


        <h3>Track Your Order</h3>


        <div class="row">

            <div class="col-md-12">
      <div class="contactform trackorder">
        <div class="demo">
          <p>It's easy. Enter your tracking number and click on track order.</p>
        </div>
        <form action="<?=g('base_url')?>account/trackorder" method="get">
          <div class="row">
            <div class="col-md-6">
              <input type="text" required="" name="tracking_number" placeholder="Enter tracking number" class="form-control tracking_number">
            </div>
          </div>
          <br>
          <div class="row">
            <div class="col-md-6">
                <input type="submit" value="Track  Order" class="btn btn-custom track_btn">
            </div>
          </div>
        </form>
      </div>
            

<?php
    if(!empty($order)){
        // debug($track_order_detail,1);
?>
        <div class="invoice-div" id="invoice">
          <div class="container">
            <div class="row">
              <div class="col-xs-6">
                <div class="invoice-title">
                  <h2>Invoice</h2>
                  <h3 class="pull-right">Order # <?=$order['order_id']?></h3>
                </div>
                <hr>
                <div class="row">
                  <div class="col-xs-6 invoice_all">
                    <address>
                      <strong>Billed To:</strong><br>
                      <?=$order['order_firstname']?><br>
                      <?=$order['order_email']?><br>
                      <?=$order['order_address1']?><br>
                      <?=$order['order_city']?><br>
                    </address>
                  </div>
                  <div class="col-xs-6 text-right invoice_all">
                    <address>
                      <strong>Shipped To:</strong><br>
                      <?=$order['order_firstname']?><br>
                      <?=$order['order_email']?><br>
                      <?=$order['order_address1']?><br>
                      <?=$order['order_city']?><br>            
                    </address>
                  </div>
                </div>
                <div class="row invoice_all">
                  <?php
          $order_status = array('1' => "Completed", '2' => "Pending",'3' => "Denied" ,'4' => "Failed",'5' => "Reversed",'0' => "Order Placed",'6' => "Order Dispatched",'7' => "Awaiting Dispatch",'8' => "Order Cancel");
          // $arrayName = array('' => , );
          // debug($order,1);
        ?>
          

          <?php
          if($order['order_dispatch_status'] == 1)
          {
              $order['order_payment_status'] = 6;
          }
            if ($order_status[$order['order_payment_status']] == "Order Dispatched") {
          ?>
              <div class="col-xs-4">
                <address>
                  <strong>Order Status:</strong><br>
                 <span style="color: #88af36;"><?=$order_status[$order['order_payment_status']];?><span/><br><br>
                </address>
              </div>

              <div class="col-xs-4">
                <!--<address>-->
                <!--  <strong>Order Dispatch Date:</strong><br>-->
                <!-- <?=$order['order_dispatch_date'];?><br><br>-->
                <!--</address>-->
              </div>
              <div class="col-xs-4 text-right">
                <address>
                  <strong>Order Date:</strong><br>
                 <?=substr($order['order_createdon'],0,10);?><br><br>
                </address>
              </div>
          <?php
            }
            else{
          ?>
              <div class="col-xs-6">
                <address>
                  <strong>Order Status:</strong><br>
                 <span style="color: #88af36;"><?=$order_status[$order['order_payment_status']];?><span/><br><br>
                </address>
              </div>
              <div class="col-xs-6 text-right">
                <address>
                  <strong>Order Date:</strong><br>
                 <?=substr($order['order_createdon'],0,10);?><br><br>
                </address>
              </div>
          <?php
            }
          ?>
                </div>
              </div>
            </div>
            <div class="row invoice_all">
      <div class="col-md-6">
        <div class="panel panel-default">
          <div class="panel-heading">
            <h3 class="panel-title"><strong>Order summary</strong></h3>
          </div>
          <div class="panel-body">
            <div class="table-responsive">
               <table class="table table-condensed"><thead>                <tr>      <td><strong>Item</strong></td>      <td class="text-center"><strong>Price</strong></td>      <td class="text-center"><strong>Quantity</strong></td>      <td class="text-right"><strong>Totals</strong></td>                </tr></thead><tbody>  <!-- foreach ($order->lineItems as $line) or some such thing here -->
  <?  $total = 0;  foreach ($order as $key => $value) {    $total += $value['order_item_subtotal'];      ?><tr>    <td><?=$value['product_name']?></td>    <td class="text-center"><?=price($value['order_item_price']);?></td>    <td class="text-center"><?=$value['order_item_qty']?></td>    <td class="text-right"><?=price($value['order_item_subtotal']);?></td>  </tr>
      <?  }  ?>    <td class="thick-line"></td>    <td class="thick-line"></td>    <td class="thick-line text-center"><strong>Subtotal</strong></td>    <td class="thick-line text-right"><?=price($order['order_total']);?></td>  </tr>
<tr>    <td class="no-line"></td>    <td class="no-line"></td>    <td class="no-line text-center"><strong>Shipping</strong></td>    <td class="no-line text-right"><?=price($order['order_shipping']);?></td>  </tr>
<tr>    <td class="no-line"></td>    <td class="no-line"></td>    <td class="no-line text-center"><strong>Tax</strong></td>    <td class="no-line text-right"><?=price($order['order_tax']);?></td>  </tr>
<tr>    <td class="no-line"></td>    <td class="no-line"></td>    <td class="no-line text-center"><strong>Total</strong></td>    <td class="no-line text-right"><?=price($order['order_amount']);?></td>  </tr>
    </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
</div>
        </div>


<?php
    }
?>

    
        </div>

        </div>


    </div>

</div>

<script>
    $(".track_btn").click(function(){
        if($(".tracking_number").val() != "")
        {
            var action_u = $(this).closest('form').attr("action");
            console.log(action_u);
            window.location.href = action_u+"?tracking_number="+$(".tracking_number").val();
        }
    });
</script>
<? $this->load->view('account/footer_main') ?>


<!-- END CONTENT -->