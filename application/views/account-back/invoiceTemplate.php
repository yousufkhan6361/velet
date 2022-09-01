<style type="text/css">

  .invoice-title h2, .invoice-title h3 {

    display: inline-block;

}



.table > tbody > tr > .no-line {

    border-top: none;

}



.table > thead > tr > .no-line {

    border-bottom: none;

}



.table > tbody > tr > .thick-line {

    border-top: 2px solid;

}

</style>

<div class="container">

<div class="row">

<div class="col-xs-12">

<div class="invoice-title">

<h3 class="pull-right">Order # <?=$order_detail['order_id']?></h3>

</div>



<div class="row">

<div class="col-xs-6">

<address>

<strong>Billed To:</strong><br>

<?=$order_detail['order_firstname']?> <?=$order_detail['order_lastname']?><br>

<?=$order_detail['order_address1']?>

</address>

</div>

<div class="col-xs-6 text-right">

<address>

<strong>Shipped To:</strong><br>

<?=$order_detail['order_firstname']?> <?=$order_detail['order_lastname']?><br>

<?=$order_detail['order_address1']?>

</address>

</div>

</div>

<div class="row">

<div class="col-xs-6">

<address>

<strong>Payment Email:</strong><br>

<?=$order_detail['order_email']?>

</address>

</div>

<div class="col-xs-6 text-right">

<address>

<strong>Order Date:</strong><br>

<?=date("d M Y",strtotime($order_detail['order_createdon']))?><br><br>

</address>

</div>

</div>

</div>

</div>



<div class="row">

<div class="col-md-12">

<div class="panel panel-default">

<div class="panel-heading">

<h3 class="panel-title"><strong>Order summary</strong></h3>

</div>

<div class="panel-body">

<div class="table-responsive">

<table class="table table-condensed">

<thead>

<tr>
<td>S.NO.</td>
<td style="text-align: left;"><strong>Order Id</strong></td>

<td class="text-center"><strong>Price</strong></td>

<td class="text-center"><strong>Quantity</strong></td>
<td class="text-center"><strong>Shipping</strong></td>

<td class="text-right"><strong>Totals</strong></td>

</tr>

</thead>

<tbody>



<!-- foreach ($order->lineItems as $line) or some such thing here -->



<?php

$total = 0;

foreach ($order_items as $key => $value) {

  $itemName = $this->model_product->find_by_pk($value['order_item_product_id']);

?>

<tr>
<td><?=$key+1?></td>
<td style="text-align: left;" ><?=$value['order_item_order_id']?></td>

<td class="text-center"><?=price($value['order_item_price'])?></td>

<td class="text-center"><?=$value['order_item_qty']?></td>
<td class="text-right"><?=price($value['order_item_subtotal'])?></td>
<td class="text-right"><?=price($value['order_item_subtotal'])?></td>

</tr>



<?php

$total += $value['order_item_subtotal'];

}

?>





<tr>

<td class="thick-line"></td>
<td class="thick-line"></td>

<td class="thick-line"></td>

<td class="thick-line text-center"><strong>Subtotal</strong></td>

<td class="thick-line text-right"><?=price($total)?></td>

</tr>





<tr>

<td class="thick-line"></td>
<td class="thick-line"></td>

<td class="thick-line"></td>

<td class="thick-line text-center"><strong>Shipping</strong></td>

<td class="thick-line text-right"><?=price($order_detail['order_shipment_price'])?></td>

</tr>





<tr>

<td class="no-line"></td>
<td class="no-line"></td>

<td class="no-line"></td>

<td class="no-line text-center"><strong>Total</strong></td>

<td class="no-line text-right"><?=price($total+$order_detail['order_shipment_price'])?></td>

</tr>

</tbody>

</table>

</div>

</div>

</div>

</div>

</div>

</div>