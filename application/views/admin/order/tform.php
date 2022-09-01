<?global $config;
 $discount_base = discount_value( $order_detail[ 'order_discount' ] , $order_detail[ 'order_discount_type' ] , $order_detail[ 'order_total' ] );
 $discount = discount_text( $order_detail[ 'order_discount' ] , $order_detail[ 'order_discount_type' ] , $order_detail[ 'order_currency' ] , $order_detail[ 'order_currency_rate' ] ,false ) ;
?>
<div class="portlet box green">
	<div class="portlet-title">
	<div class="caption">
	<i class="fa fa-shopping-cart"></i>
	<strong>#<?=order_mask($order_detail[ 'order_id' ]);?> </strong>
	<small> / <?=csl_date($order_detail[ 'order_created_on' ]);?></small>
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
				<img alt="" class="img-responsive" src="<?=$config['admin_images_root'];?>logo.png" />
			</div>
			<div class="col-xs-6">
				<p>
					 #<?=order_mask($order_detail[ 'order_id' ]);?> <span class="muted">
					On: <?=csl_date($order_detail[ 'order_created_on' ]);?>  </span>
				</p>
			</div>
		</div>
		<hr>
		<div class="row">
			<div class="col-xs-3">
				<h3>Details:</h3>
				<ul class="list-unstyled">
					<li> <?=$order_detail[ 'user_username' ];?> ( <?=$order_detail[ 'user_email' ];?> ) </li>
					<li> <strong>Carrier:</strong> <?=$config[ 'carriers' ][ $order_detail[ 'order_shipment_method_id' ] ];?> </li>
					<li> <strong>Payment method:</strong> <?=$order_detail[ 'payment_method_name' ];?> </li>
					<li><strong>Amount</strong> : <?=price($order_detail[ 'order_total' ] , $order_detail[ 'order_currency' ] , $order_detail['order_currency_rate'])?></li>
					<? if( $order_detail[ 'order_gift_wrapped' ] ){ ?>
					<li> <strong> <i class="fa fa-gift"></i>  </strong>Gift Wrap this order </li>
					<li> <strong>Gift Note:</strong> <?=$order_detail[ 'order_gift_note' ]?>  </li>
					<?}?>
					</ul>
			</div>
			<div class="col-xs-3">
				<h3>Shipping Address</h3>
				<button class="btn blue btn-xs left updt-address" data-id="<?=$shpping_address[ 'oa_id' ]?>" style="float:right"><i class="fa fa-edit"></i></button>
				<ul class="list-unstyled">
					<li><?=$shpping_address[ 'oa_firstname' ] . " " .$shpping_address[ 'oa_lastname' ] ;?></li>
					<li><?=$shpping_address[ 'oa_company' ];?></li>
					<li><?=$shpping_address[ 'oa_address1' ];?></li>
					<li><?=$shpping_address[ 'oa_address2' ];?></li>
					<li><?=$shpping_address[ 'oa_postalcode' ];?> <?=$shpping_address[ 'oa_city' ];?></li>
					<li><?=$shpping_address[ 'oa_country' ];?></li>
					<li>Tel: <?=$shpping_address[ 'oa_telephone' ];?></li>
					<li>Mob: <?=$shpping_address[ 'oa_mobile' ];?></li>
				</ul>
			</div>
			<div class="col-xs-3">
				<h3>Billing Address</h3>
				<button class="btn blue btn-xs left updt-address" data-id="<?=$billing_address[ 'oa_id' ]?>" style="float:right"><i class="fa fa-edit"></i></button>
					<ul class="list-unstyled">
					<li><?=$billing_address[ 'oa_firstname' ] . " " .$billing_address[ 'oa_lastname' ] ;?></li>
					<li><?=$billing_address[ 'oa_company' ];?></li>
					<li><?=$billing_address[ 'oa_address1' ];?></li>
					<li><?=$billing_address[ 'oa_address2' ];?></li>
					<li><?=$billing_address[ 'oa_postalcode' ];?> <?=$billing_address[ 'oa_city' ];?></li>
					<li><?=$billing_address[ 'oa_country' ];?></li>
					<li>Tel: <?=$billing_address[ 'oa_telephone' ];?></li>
					<li>Mob: <?=$billing_address[ 'oa_mobile' ];?></li>
				</ul>
			</div>
			<div class="col-xs-3 invoice-payment">
				<h3>Payment Details:</h3>
				<ul class="list-unstyled">
					<li>
						<strong>Payment method:</strong> <?=$order_detail[ 'payment_method_name' ];?>
					</li>
					<?if(array_filled($payment_method_fields)){?>
						<strong>Details:</strong>
						<?foreach ($payment_method_fields as $key => $value) {
							echo "<li><strong>$key</strong>: $value</li>" ;
						}?>
					<?}?>
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
								 Description
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
						<?foreach ($order_items as $item) {
							$img = Links::img($item[ 'pi_image_path' ] , $item[ 'pi_image_thumb' ] , true) ;
						?>
							<tr>
							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<img src="<?=$img;?>" class="product_img_thumb"/> 
								</td>

							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<a href="<?=Links::product_detail( $item[ 'product_slug' ] );?>" target="_blank" >
							  			<?=$item[ 'product_name' ]?> 
										</a>
							  		</br>
							  		<?=$item[ 'size_name' ] ? "- Size: " . $item[ 'size_name' ] : "" ?>  <?=$item[ 'color_name' ] ? "- Color: " . $item[ 'color_name' ] : "" ?> 
								</td>

							  	<td style="padding:10px 0; vertical-align:middle;">
						  			<?=truncate( $item[ 'product_short_desc' ] )?> 
								</td>

							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<?=$item[ 'oitem_qty' ]?> 
								</td>

							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<?=price($item[ 'oitem_price' ] , $item[ 'oitem_currency' ] , $item[ 'oitem_currency_rate' ])?> 
									<?if( ! $item[ 'oitem_stitched' ] ){?>
										<br/> 
						  				(Stitching: <?=price($item[ 'oitem_itemset_price' ] , $item[ 'oitem_currency' ] , $item[ 'oitem_currency_rate' ])?> )
									<?}?>
								</td>

							  	<td style="padding:10px 0; vertical-align:middle;">
							  		<?=price($item[ 'oitem_total' ] , $item[ 'oitem_currency' ] , $item[ 'oitem_currency_rate' ])?> 
								</td>
							</tr>

							<?if(array_filled($item[ 'addon_list' ])){ ?>

								<?foreach($item[ 'addon_list' ] AS $addon){
									$img = Links::img($addon[ 'addon_image_path' ] , $addon[ 'addon_image_thumb' ] , true) ;
									?>
									<tr class="oi_addon">
									  	<td style="padding:10px 0; vertical-align:middle;">
									  		<img src="<?=$img;?>" class="product_img_thumb"/> 
								  		</td>
									  	<td style="padding:10px 0; vertical-align:middle;"><strong>Addon:</strong></td>
									  	<td style="padding:10px 0; vertical-align:middle;">
									  			<?=$addon[ 'addon_name' ]?> 
								  		</td>
									  	<td style="padding:10px 0; vertical-align:middle;">
									  		<?=$addon[ 'oitem_qty' ]?> 
								  		</td>
									  	<td style="padding:10px 0; vertical-align:middle;">
									  		<?=price($addon[ 'oitem_price' ] , $addon[ 'oitem_currency' ] , $addon[ 'oitem_currency_rate' ])?> 
								  		</td>
									  	<td style="padding:10px 0; vertical-align:middle;">
									  		<?=price($addon[ 'oitem_total' ] , $addon[ 'oitem_currency' ] , $addon[ 'oitem_currency_rate' ])?> 
								  		</td>
									</tr>
								<?}?>

							<?}?>
						<?}?>
		  			</tbody>
				</table>
			</div>
		</div>
		<div class="row">
			<div class="col-xs-4">
					<div class="well col-md-12">
						<address>
						<strong>Discount:</strong><br>
							<label class="col-md-1">
								<?=$order_detail[ 'order_currency' ]?>
							</label>
							<div class="col-md-4">
								<input type="text" name="order[order_discount]" class="form-control"  
									value="<?=$discount?>" 
								/>
							</div>
							<div class="col-md-4">
								<select type="text" name="order[order_discount_type]" class="form-control"  >
									<?=generate_options_html( 
											array_value_as_key( array('percent','value') ) , 
											$order_detail[ 'order_discount_type' ]  	
										);
									?>
								</select>
							</div>
							<div class="col-md-3">
								<button  class="btn green discount_update"  data-id="<?=$order_detail[ 'order_id' ]?>" >Update</button>
							</div>
						</address>
					</div>
			</div>
			<div class="col-xs-8 invoice-block">
				<ul class="list-unstyled amounts">
					<li><strong style="color:#333">Total Products</strong> : <?=count($order_items)?> </li>
					<li><strong style="color:#333">No of Items</strong> : <?=$order_detail[ 'order_total_items' ]?> </li>
					<li><strong style="color:#333">Price</strong> : <?=price($order_detail[ 'order_total' ] , $order_detail[ 'order_currency' ] , $order_detail['order_currency_rate'])?> </li>
					<input type="hidden" class="order_price" value="<?=$order_detail[ 'order_total' ]?>" />
					<li><strong style="color:#333">Discount</strong> : <?=price( $discount_base , $order_detail[ 'order_currency' ] , $order_detail['order_currency_rate'])?> </li>
					<li><strong style="color:#333">Total Price</strong> : <?=price($order_detail[ 'order_total' ] - $order_detail[ 'order_discount' ] , $order_detail[ 'order_currency' ] , $order_detail['order_currency_rate'])?> </li>
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