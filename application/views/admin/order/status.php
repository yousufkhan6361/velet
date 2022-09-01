<?global $config;?>
<div class="portlet box green">
	<div class="portlet-title">
		<div class="caption">
			<i class="fa fa-shopping-cart"></i>
			<strong>#<?=order_mask($order_detail[ 'order_id' ]);?> </strong>
			<small> / <?=csl_date($order_detail[ 'order_created_on' ]);?></small>
		</div>
	</div>
	<div class="portlet-body form">
	                  <!-- BEGIN FORM-->
		<div class="invoice row">
		<div class="col-md-12">

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


		            <div class="row item_set">
			            <div class="col-md-12">
				            <div class="form-group">
				            	
								<div class="col-md-3" for=""> 
										Update Status:
								</div>
				            	<div class="col-md-7">
				            	<select class="form-control" name="ostatus_id">
				            		<?=generate_options_html($ostatuses , $order_detail['ostatus_payment_method_status_id'] , false )?>
				            	</select>
				            	</div>
					            <div class="col-md-2">
						        		<button type="button" class="btn sub-btn green updt-status" data-id="<?=$order_detail['order_id']?>">Save</button>
					            </div>
					        </div>
			            </div>

			        </div>

				</div>

			</form>
			<div class="form-body">

		    		<div class="portlet box red">
					<div class="portlet-title">
						<div class="caption">
						<div class="tools">
						<i class="fa fa-cogs"></i> Order Status History
						</div>
						</div>
					</div>
						<div class="table-scrollable history">
							<table class="table table-striped table-hover">
								<thead>
						            <th>Previous Status</th>
						            <th>New Status</th>
						            <th>User</th>
						            <th>Time</th>
								</thead>
								<tbody class="data-holder">
				        		<?
					        	/*if ( is_array( $order_history ) ) 
					        	foreach ($order_history as $history) {?>
								<tr  class="item_set template">
						            <td  class="form-group"> <?=$history[ 'ochange_previous_comment' ]?> </td>
						            <td  class="form-group"> <?=$history[ 'ochange_new_comment' ]?> </td>
						            <td  class="form-group"> <?=$history[ 'user_username' ]?> </td>
						            <td  class="form-group"> <?=$history[ 'ochange_ondate' ]?> </td>
								</tr>
					        	<?}*/?>
								</tbody>
					        </table>
				        </div>
			        </div>
		    	</div>
	    	</div>
	    </div>
    </div>
</div>

<script>
	$(document).ready(function() {

		reload_status();

		$("body").on("click",".updt-status", function () {
			var order_id = $(this).attr("data-id");
			var url = $js_config.base_url + "admin/order/change_status/" + order_id ;
			var data = {"ostatus_id" : $('[ name="ostatus_id"]').val() } ;
			var response = AjaxRequest.fire(url, data);
			if(response.success)
			{
				reload_status();
				AdminToastr.success("Order Status Updated!" , "Successful");
			}
			else
				AdminToastr.warning("No change in Order Status!" , "Warning");

		});
	});

	function reload_status() {
		var order_id = $(".updt-status").attr("data-id") ;
		var url = $js_config.base_url + "admin/order/get_order_status/" + order_id ;
		var response = AjaxRequest.fire(url , {});
		var container = $(".history tbody");
		container.html('') ;
		$.each(response, function (ind , dt) {
			var row = $("<tr>")
							.append( $("<td>").html(dt.ochange_previous_comment) )
							.append( $("<td>").html(dt.ochange_new_comment) )
							.append( $("<td>").html(dt.user_username) )
							.append( $("<td>").html(dt.ochange_ondate) );

			container.append(row) ;
		});
	}
</script>
