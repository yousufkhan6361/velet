<?global $config;?>
<div class="table-scrollable product">
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption">
			<div class="tools">
			<i class="fa fa-cogs"></i> Payment Details: (Select Payment method first)
			</div>
			</div>
		</div>
	</div>
	<div class="pay_cont_main" >
		<div class="form-group col-md-4 payment_field_cont" >
			<label class="col-md-4 pay_label">Test</label>
			<div class="col-md-8">
				<input type="text" name="" class="form-control pay_field" required />
			</div>
		</div>
	</div>
</div>

<div class="table-scrollable product">
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption">
			<div class="tools">
			<i class="fa fa-cogs"></i> Add Products
			</div>
			</div>
		</div>
	</div>
	<table class="table table-striped table-hover">
		<thead>
            <th>Product</th>
            <th>Size</th>
            <th>Addons</th>
            <th>Actions</th>
		</thead>
		<tbody class="data-holder">
		<tr  class="product template cart_container">

			<? $form = new Tkd_form_helper("oitem"); ?>

            <td  class="form-group oitem_product_id"> <?=$form->gen_dropdown(array(
        			"field"=>array("list_data"=>$available_products) ,
            		"field_name" => "oitem[oitem_product_id]",
            		"id" => "oitem_product_id",
            	));?> 
        	</td>
            <td  class="form-group oitem_itemset_id"> <?=$form->gen_dropdown(array(
            		"field_name" => "oitem[oitem_itemset_id]",
            		"id" => "oitem_itemset_id",
            	));?> 
        	</td>
            <td  class="form-group addons"> 
            	<?=$form->gen_multiselect(array(
            		"field_name" => "oitem[addons]",
            		"id" => "addons",
            		"field"=>array("attributes" => array("class" => "oitem-addons") ),
            	));?> 
        	</td>

            <td  class="form-group product_id">
            	<input type="button" class="btn green add_cart" value="Add" />
            	<input type="button" class="btn green load_cart" value="Refresh Cart" />
        	</td>
        	
		</tr>
		</tbody>
    </table>
</div>


<div class="table-scrollable product">
	<div class="portlet box red">
		<div class="portlet-title">
			<div class="caption">
			<div class="tools">
			<i class="fa fa-cogs"></i> Cart Items
			</div>
			</div>
		</div>
	</div>
	<table class="table table-striped table-hover">
		<thead>
			<th><b>Product</b></th>
			<th><b>Ref.</b></th>
			<th><b>Description</b></th>
			<th><b>Price</b></th>
			<th><b>Quantity</b></th>
			<th><b>Item Total</b></th>
			<th></th>
		</thead>
		<tbody class="cart_body">
		</tbody>
    </table>
</div>
<div class="row">
	<div class="col-xs-4 invoice-block" style="float:right;text-align:right;">
		<ul class="list-unstyled amounts">
			<li><strong style="color:#333">Total Products</strong> : <span id="cart_total_items"></span> </li>
			<li><strong style="color:#333">Total Weight</strong> : <span id="cart_total_weight"></span>  </li>
			<li><strong style="color:#333">Total Price</strong> : <span id="cart_total"></span>  </li>
		</ul>
		<br>
	</div>
</div>