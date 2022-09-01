<?global $config;
$allowed_fields = array(
	"reference_address",
	"firstname",
	"lastname",
	"company",
	"address1",
	"address2",
	"postalcode",
	"city",
	"state",
	"additonal_info",
	"mobile",
	"telephone",
);
?>
<div class="portlet box green">
	<div class="portlet-title">
	<div class="caption">
	<i class="fa fa-shopping-cart"></i>
	<strong>Modify  Address </strong>
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
		<div class="row">
			<div class="col-xs-12">
				
				<input type="hidden" name="order_address[oa_id]" value="<?=$address['oa_id']?>"/>
					<div class="form-actions">

				    	<?foreach ($allowed_fields as $field) {?>
				    		<div class="form-group ">
								<label class="control-label col-md-4">
									<?=humanize($field)?>
								</label>
								<div class="col-md-8">
									<input name="order_address[oa_<?=$field?>]" value="<?=$address['oa_'.$field]?>" class="form-control" type="text" />
								</div>
				    		</div>
				    	<?}?>
			    		<div class="form-group ">
							<label class="control-label col-md-4">
								Country
							</label>
							<div class="col-md-8">
								<select name="order_address[oa_country]" value="<?=$address['oa_country']?>" class="form-control" >
									<?=generate_options_html( $this->model_country->get_country_list() , $address['oa_country'] )?>
								</select>
							</div>
			    		</div>
					    <div class="form-group">
					        <button type="button" name="submit" value="Save" class="btn green submitter">Save</button>
					    </div>
				  	</div>

			</div>
		</div>
	</div>
    </div>
<!-- END VALIDATION STATES-->
</div>
<?create_modal_html("address_update","Modify Your Address")?>