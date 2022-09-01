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
		<form class="cmxform horizontal-form tasi-form" >
	        <div class="row item_set">
	            <div class="col-md-12">
		            <div class="form-group">
		            	
						<div class="col-md-1" for=""> 
								Message:
						</div>
		            	<div class="col-md-7">
		            	<textarea class="form-control" name="message[message]" ></textarea> 
		            	</div>
			            <div class="col-md-2">
			            	<input type="checkbox" value="1" name="message[is_private]" id="message-is_private"/>
			            	<label for="message-is_private">Is Private?</label>
			            </div>
			            <div class="col-md-2">
			        		<button type="button" class="btn sub-btn green updt-message" data-id="<?=$order_detail['order_id']?>">Save</button>
			            </div>
			        </div>
	            </div>
	        </div>
		</form>
		<div class=""></div>
		<div class="form-body">

	    		<div class="portlet box red">
				<div class="portlet-title">
					<div class="caption">
					<div class="tools">
					<i class="fa fa-cogs"></i> Order Messages
					</div>
					</div>
				</div>
					<div class="table-scrollable messages">
						<table class="table table-striped table-hover">
							<thead>
					            <th style="width:10%;">From</th>
					            <th style="width:10%;">Type</th>
					            <th style="width:15%;">Date</th>
					            <th style="width:55%;">Message</th>
					            <th style="width:10%;">Mark as Read</th>
							</thead>
							<tbody class="data-holder">
							</tbody>
				        </table>
			        </div>
		        </div>
	    	</div>
    	</div>
    </div>
</div>
</div>