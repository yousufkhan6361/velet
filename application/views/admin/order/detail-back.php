<?global $config;
 //$discount_base = discount_value( $order_detail[ 'order_discount' ] , $order_detail[ 'order_discount_type' ] , $order_detail[ 'order_total' ] );
 //$discount = discount_text( $order_detail[ 'order_discount' ] , $order_detail[ 'order_discount_type' ] , $order_detail[ 'order_currency' ] , $order_detail[ 'order_currency_rate' ] ,false ) ;
//debug($order_detail);
?>
<div class="portlet box green">
	<div class="portlet-title">
	<div class="caption">
	<i class="fa fa-shopping-cart"></i>
	<strong>Order #<?=$order_detail[ 'order_id' ]?> </strong>
	<small> / <?=date("Y-m-d",strtotime($order_detail[ 'order_createdon' ]))?></small>
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
	<div class="invoice">
		<div class="row invoice-logo">
			<div class="col-xs-6 invoice-logo-space">
				<a href="<?=$config['base_url']?>admin">
					<img src="<?=get_image($this->layout_data['logo'][0]['logo_image_path'],$this->layout_data['logo'][0]['logo_image'])?>" alt="logo" class="main-tem-logo"/>
				</a>
			</div>
			<div class="col-xs-6">
				<p>
					 Order #<?=$order_detail[ 'order_id' ]?> <span class="muted">
					On: <?=date("Y-m-d",strtotime($order_detail[ 'order_createdon' ]))?> </span>
				</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-4">
				<h3>Personal Info:</h3>
				<ul class="list-unstyled">
					<li>Name: <?=$order_detail[ 'order_firstname' ];?> </li>
					<li>Last Name: <?=$order_detail[ 'order_firstname' ];?></li>
					<li>Email: <?=$order_detail[ 'order_email' ];?> </li>
					<li>Contact: <?=$order_detail[ 'order_phone' ];?> </li>					
				</ul>
			</div>
			<div class="col-xs-4">
				<h3>Address:</h3>
				<ul class="list-unstyled">
					<li>Address: <?=$order_detail[ 'order_address1' ];?> </li>
					<li>City: <?=$order_detail[ 'order_city' ];?> </li>
					<li>State: <?=$order_detail[ 'order_state' ];?> </li>
					<li>Zip: <?=$order_detail[ 'order_zip' ];?> </li>
					<li>Country: <?=$order_detail[ 'order_country' ];?> </li>
				</ul>
			</div>
			<div class="col-xs-4">
				<h3>Payment Info:</h3>
				
				<ul class="list-unstyled">
					
					<li> <strong>Payment Status:</strong> <?=$this->model_order->get_payment_status($order_detail[ 'order_payment_status' ]);?></li>					
					<li> <strong>Total Quantity:</strong> <?=$total_quantity?>  </li>
					<li> <strong>Total Amount:</strong> 
					<?=price($total_amount)?></li>	
					
				</ul>
			</div>
			
		</div>
		

		<div class="row">
			<div class="col-xs-12">
				<table class="table table-striped table-hover">
					<thead>
						<tr>
							<th>
								 Thumb
							</th>
							<th>
								 Item
							</th>
							
							<th class="hidden-480">
								 Quantity
							</th>
							<th class="hidden-480">
								 Unit Cost
							</th>
							<th>
								 Total
							</th>
						</tr>
					</thead>
					<tbody>
					<?

						foreach ($order_items as $item) {							

						?>
							<tr>
							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<img src="<?=get_image($item['pi_image_path'],$item['pi_image'])?>" class="product_img_thumb"/> 
								</td>

							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<?=$item[ 'product_name' ]?> 	<br>							
							  		<?							  		





$subtotal_g = $item[ 'order_item_subtotal' ];

?>
								</td>

							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<?=$item[ 'order_item_qty' ]?> 
								</td>

							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<?=price($item[ 'order_item_price' ])?>							  		
								</td>

							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<?=price($subtotal_g+$attribute_price)?>
								</td>
							</tr>

						<?}

						?>
						
		  			</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
								</div>
			<div class="col-xs-8 invoice-block">
				<ul class="list-unstyled amounts">
					<li><strong style="color:#333">Total Products</strong> : <?=count($order_items)?> </li>
					<li><strong style="color:#333">No of Items</strong> : <?=$total_quantity?> </li>
					<li><strong style="color:#333">Price</strong> : <?=price($total_amount)?> </li>
					<li><strong style="color:#333">Total Price</strong> : <?=price($total_amount+$attribute_price)?> </li>
				</ul>
				<br>
				<!--a onclick="javascript:window.print();" class="btn btn-lg blue hidden-print margin-bottom-5">
				Print <i class="fa fa-print"></i>
				</a>
				<a class="btn btn-lg green hidden-print margin-bottom-5">
				Submit Your Invoice <i class="fa fa-check"></i>
				</a-->
			</div>
		</div>
	</div>
    </div>
<!-- END VALIDATION STATES-->
</div>
<?create_modal_html("address_update","", "",'method="POST" action="'.$config['base_url'].'admin/order/save_address"',false)?>