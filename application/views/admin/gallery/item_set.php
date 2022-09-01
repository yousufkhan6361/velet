<?global $config;
// If Stitched, use qty, else use price
if($form_data[ 'product' ][ 'product_stitched' ] ){
	$qty_price = "qty" ;
}else{
	$qty_price = "price" ;

}
?>

<form class="cmxform horizontal-form tasi-form" 
	id="product_item_set_form" 
	method="POST" 
	action="<?=$config['base_url']?>admin/product_item_set/add" 
>
		<div class="form-body">
            
            <div class="alert alert-danger display-hide">
              <button class="close" data-close="alert"></button>
              You have some form errors. Please check below.
            </div>
            <div class="alert alert-success display-hide">
              <button class="close" data-close="alert"></button>
              Your form validation is successful!
            </div>

        	<input type = "hidden" value="<?=$form_data['product']['product_id']?>" name = "product_item_set[pis_product_id]" />

            <div class="row item_set">
	            <?/*
	            <div class="col-md-4">
	            <div class="form-group">
	            	
					<label class="control-label" for=""> 
							Color
					</label>
	            	<select class="form-control" name="product_item_set[pis_color_id]">
	            		<?=generate_options_html($form_data['color'] , $form_data['product_item_set']['pis_color_id'])?>
	            	</select>
		        </div>
	            </div>
				*/?>

	            <div class="col-md-4">
	            <div class="form-group">
	            	
					<label class="control-label" for=""> 
							Size
					</label>
	            	<select class="form-control" name="product_item_set[pis_size_id]">
	            		<?=generate_options_html($form_data['size'] , $form_data['product_item_set']['pis_size_id'])?>
	            	</select>
		        </div>
	            </div>

	            <div class="col-md-4">
		            <div class="form-group">
						<label class="control-label" for=""> <?=$qty_price?> </label>
		            	<input type="text" value="<?=$form_data['product_item_set']['pis_'.$qty_price]?>" class="form-control" name="product_item_set[pis_<?=$qty_price?>]"/>
			        </div>
	            </div>

	        </div>

		</div>

	<div class="form-actions">
	    <div class="row">
	      <div class="col-md-offset-3 col-md-9">
	        <button type="button" class="btn sub-btn green">Save</button>
	        <button type="button" class="btn default">Cancel</button>
	      </div>
	    </div>
  	</div>
</form>
	<div class="form-body">
        
        <div class="alert alert-danger display-hide">
          <button class="close" data-close="alert"></button>
          You have some form errors. Please check below.
        </div>
        <div class="alert alert-success display-hide">
          <button class="close" data-close="alert"></button>
          Your form validation is successful!
        </div>

    	<input type = "hidden" value="<?=$form_data['product']['product_id']?>" name = "product_item_set[pis_product_id]" />
        
			<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
				<div class="tools">
				<i class="fa fa-cogs"></i> Item Sets in This Product
				</div>
				</div>
			</div>
			<div class="table-scrollable item_set">
				<table class="table table-striped table-hover">
					<thead>
	        		<?
	        		$columns = array(/*"color",*/"size",$qty_price,"action");
		        	foreach ($columns as $col) {?>
			            <th>
							<?=label_encode($col)?>
			            </th>
		        	<?}?>
					</thead>
					<tbody class="data-holder">
					<tr  class="item_set template">
	        		<?
	        		$columns = array(/*"color",*/"size",$qty_price,"action");
		        	foreach ($columns as $col) {?>
			            <td  class="form-group <?=$col?>">
			            </td>
		        	<?}?>
					</tr>
					</tbody>
		        </table>
	        </div>
	        </div>

<script>
	$(document).ready(function() {
		$(".sub-btn").click(function () {
			var data = $("#product_item_set_form").serialize();
			var url = $("#product_item_set_form").attr("action");
			response = AjaxRequest.fire(url, data);
			if(parseInt(response) > 0)
				AdminToastr.success( "Record Saved" , "Success" );
			else
				AdminToastr.error( "Record could not be saved. Please fill all fields" , "Failed" );
			get_item_sets();
		});

		$("body").on("click",".prd_item_set_btn_edit", function () {
			AdminScript.moveToTop();
			var pis_id = $(this).attr("data-id");
			var url = $js_config.base_url + "admin/product_item_set/get_set/" + pis_id ;
			var response = AjaxRequest.fire(url, {});
			if(response.pis_id>0)
			{
				$("[name='product_item_set[pis_<?=$qty_price?>]']").val(response.pis_<?=$qty_price?>);
				$("[name='product_item_set[pis_size_id]']").val(response.pis_size_id);
				$("[name='product_item_set[pis_color_id]']").val(response.pis_color_id);
			}
		});

		$("body").on("click",".prd_item_set_btn_delete", function () {
			var pis_id = $(this).attr("data-id");
			var url = $js_config.base_url + "admin/product_item_set/permanent_delete" ;
			var data =  {} ;
			data.params = {pk:pis_id , model:"product_item_set"};
			var response = AjaxRequest.fire(url, data);
			AdminToastr.success( "Record Deleted" , "Success" );
			get_item_sets();
		});

		get_item_sets();
	});

	var item_template = $(".item_set.template");
	function get_item_sets(){
		var product_id = $("[name='product_item_set[pis_product_id]']").val();
		var url = $js_config.base_url + "admin/product_item_set/index/" + product_id ;
		response = AjaxRequest.fire(url,{});
		if(response.count>0)
		{
			var data_holder = $(".data-holder");
			data_holder.html("");
			$(response.data).each(function(index,dt){
				clone = item_template.clone();
				clone.find(".color").html(dt.color_name);
				clone.find(".size").html(dt.size_name);
				clone.find(".<?=$qty_price?>").html(dt.pis_<?=$qty_price?>);
				clone.find(".action").html(
										'<input type="button" class="btn prd_item_set_btn_delete green red" data-id="'+dt.pis_id+'" value="Delete" />' +
										'<input type="button" class="btn prd_item_set_btn_edit green edit" data-id="'+dt.pis_id+'" value="Edit" />'
									);
				data_holder.append(clone);
			});
		}
	}
</script>
