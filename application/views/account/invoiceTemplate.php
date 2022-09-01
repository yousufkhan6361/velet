<?php $logo = $this->model_logo->find_one(); ?>

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
#myModal .modal.fade .modal-dialog{
    transform: inherit;
}
</style>

<div class="row">
    <!-- <div class="col-xs-1">
    </div> -->  
    <div class="col-xs-3">
    <img src="<?=Links::img($logo['logo_image_path'],$logo['logo_image'])?>" style="width: 96px ;height: 84px ;margin-left: 100px;margin-top: 20px;">
    </div>  
            <div class="col-xs-4">
                <h3><strong>Billing Information:</strong></h3>
                <ul class="list-unstyled">
<?php if (!empty($order_detail['order_company'])):?>
                    <li class="text-left"><strong>Compnay Name:</strong> <?=$order_detail[ 'order_company' ];?> </li>

<?php endif; ?>

                    <li class="text-left"><strong>Name:</strong> <?=$order_detail[ 'order_fname' ];?> <?=$order_detail[ 'order_lname' ];?> </li>
                    <li class="text-left"><strong>Phone #:</strong>  <?=$order_detail[ 'order_phone' ];?></li>
                    <li class="text-left"><strong>Email:</strong> <?=$order_detail[ 'order_email' ];?> </li>                

                </ul>

            </div>

            <div class="col-xs-5">
                <h3><strong>Address:</strong></h3>
                <ul class="list-unstyled">
                    <li class="text-left"><strong>Address:</strong> <?=$order_detail[ 'order_address' ];?></li>
                    <li class="text-left"><strong>Country:</strong> <?=$order_detail[ 'order_country' ];?></li>
                    <li class="text-left"><strong>City:</strong>  <?=$order_detail[ 'order_city' ];?> </li>
                    <li class="text-left"><strong>Postcode:</strong> <?=$order_detail[ 'order_zip_code' ];?></li>
                </ul>
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
<td><strong>Thumb</strong></td>
<td><strong>Item</strong></td>
 <td class="text-center"><strong>Size</strong></td> 
 <td class="text-center"><strong>Color</strong></td>  
<td class="text-center"><strong>Price</strong></td>
<td class="text-center"><strong>Quantity</strong></td>
<td class="text-right"><strong>Sub Total</strong></td>
</tr>
</thead>
<tbody>
<?php
   $total_quantity = 0;
   $total_amount = 0;
   $subtotal_g = 0;

foreach ($order_items as $key => $item) {
  $options = unserialize($item['order_item_option']);
   // debug($item,1);
  $itemName = $this->model_product->find_by_pk($item['order_item_product_id']);
?>

<tr>
<td><img src="<?=$options['product_img']?>" style="width:45px !important;height:45px !important;"></td>
<td><?=$itemName['product_name']?></td>
<td><?=$options['product_size']?></td>
<td><?=$options['product_color']?></td> 
<td class="text-center">  <?=price($item[ 'order_item_price' ])?></td>
<td class="text-center"><?=$item[ 'order_item_qty' ]?></td>
<td class="text-right"> <?=price($item[ 'order_item_subtotal'])?></td>
</tr>

<?php
  $amount = $item['order_item_subtotal'];
  $total_amount += $amount;
  $total_quantity += $item['order_item_qty'];
  $subtotal_g += $item[ 'order_item_price' ] * $item[ 'order_item_qty' ];
  $data[ 'total_quantity' ] = $total_quantity;
  $data[ 'total_amount' ] = $total_amount;
  $data[ 'order_items' ] = $item_data;
}
?>

 <tr>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class="thick-line text-center"><strong>Subtotal</strong></td>
<td class="thick-line text-right"> <?=price($order_detail['order_total'])?></td>
</tr> 
 <?php if (!empty($order_detail[ 'order_shipping' ])): ?>
 <tr>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class="thick-line text-center"><strong>Shipping Charges</strong></td>
<td class="thick-line text-right"> <?=price($order_detail['order_shipping']);?></td>
</tr>
<?php if (!empty($order_detail[ 'order_coupon_discount' ])): ?>
 <tr>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class="thick-line text-center"><strong>Discount</strong></td>
<td class="thick-line text-right"> - <?=price($order_detail[ 'order_coupon_discount' ]);?></td>
</tr>                    
<?php endif ?> 
<tr>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class="thick-line text-center"><strong>Grand Total</strong></td>
<td class="thick-line text-right"> <?=price($order_detail['order_gtotal'])?></td>
</tr>
<?php endif;?> 

<tr>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class=""></td>
<td class="thick-line text-center"></td>
<td class="thick-line text-right"></td>
</tr>
</tbody>

</table>

</div>

</div>

</div>

</div>

</div>