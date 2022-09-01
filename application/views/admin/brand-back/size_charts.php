<?global $config;
$tkd_helper = new Tkd_form_helper("brand_sizechart");
?>
<form class="cmxform horizontal-form tasi-form" 
	id="brand_size_chart_form" 
	method="POST" 
	action="<?=$config['base_url']?>admin/brand_size_chart/add" 
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

        	<input type = "hidden" value="<?=$form_data['brand']['brand_id']?>" name = "brand_size_chart[bsc_brand_id]" />

            <div class="row size_chart">
	            
	            <div class="col-md-12">
	            <div class="form-group">
	            	
					<label class="control-label col-md-1" for=""> 
							Title
					</label>
					<div class="col-md-2">
			        	<?
			        	$params = array(
			        		'additional' => 'required' ,
			        		'id' => 'brand_sizechart-bsc_title' ,
			        		'field_data' => '' ,
			        		'field_name' => 'brand_sizechart[bsc_title]' ,
		        		);
						echo $tkd_helper->gen_text($params);
						?>
					</div>
					<label class="control-label col-md-1" for=""> 
							Size Chart
					</label>
					<div class="col-md-8">
			        	<?
			        	$params = array(
			        		'additional' => 'required' ,
			        		'id' => 'bsc_html' ,
			        		'field_data' => '' ,
			        		'field_name' => 'brand_sizechart[bsc_html]' ,
		        		);
						echo $tkd_helper->gen_editor($params);
						?>
					</div>
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
        
    	<input type = "hidden" value="0" name = "brand_size_chart[bsc_id]" />
    	<input type = "hidden" value="<?=$form_data['brand']['brand_id']?>" name = "brand_size_chart[bsc_brand_id]" />
        
			<div class="portlet box red">
			<div class="portlet-title">
				<div class="caption">
				<div class="tools">
				<i class="fa fa-cogs"></i> Brand Size Charts.
				</div>
				</div>
			</div>
				<div class="table-scrollable size_chart">
					<table class="table table-striped table-hover">
						<thead>
		        		<?
		        		$columns = array("title","html","action");
			        	foreach ($columns as $col) {?>
				            <th>
								<?=label_encode($col)?>
				            </th>
			        	<?}?>
						</thead>
						<tbody class="data-holder">
						<tr  class="size_chart template">
		        		<?
		        		$columns = array("title","html","action");
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

			var url = $("#brand_size_chart_form").attr("action");
			var form = $("#brand_size_chart_form") ;
			
			form.validate();
			if(!form.valid())
				return false;
			
			var data = {};
			data.bsc_id = $("[name='brand_size_chart[bsc_id]']").val();
			data.bsc_brand_id = $("[name='brand_size_chart[bsc_brand_id]']").val();
			data.bsc_title = $("[name='brand_sizechart[bsc_title]']").val();
			data.bsc_html = CKEDITOR.instances.bsc_html.getData();
			
			response = AjaxRequest.fire(url, data);
			if(parseInt(response) > 0)
				AdminToastr.success( "Record Saved" , "Success" );
			else
				AdminToastr.error( "Record could not be saved. Please fill all fields" , "Failed" );
			clear_size_form();
			get_size_charts();
		});

		$("body").on("click",".prd_size_chart_btn_edit", function () {
			AdminScript.moveToTop();
			var bsc_id = $(this).attr("data-id");
			var url = $js_config.base_url + "admin/brand_size_chart/get_set/" + bsc_id ;
			var data = AjaxRequest.fire(url, {});
			if(data.bsc_id>0)
			{
				$("[name='brand_size_chart[bsc_id]']").val(data.bsc_id);
				$("[name='brand_size_chart[bsc_brand_id]']").val(data.bsc_brand_id);
				$("[name='brand_sizechart[bsc_title]']").val(data.bsc_title);
				CKEDITOR.instances.bsc_html.setData(data.bsc_html);
			}
		});

		$("body").on("click",".prd_size_chart_btn_delete", function () {
			var bsc_id = $(this).attr("data-id");
			var url = $js_config.base_url + "admin/brand_size_chart/delete" ;
			var data =  {} ;
			data.params = {pk:bsc_id , model:"brand_size_chart"};
			var response = AjaxRequest.fire(url, data);
			AdminToastr.success( "Record Deleted" , "Success" );
			get_size_charts();
		});

		get_size_charts();
	});

	var item_template = $(".size_chart.template");
	function get_size_charts(){
		var brand_id = $("[name='brand_size_chart[bsc_brand_id]']").val();
		var url = $js_config.base_url + "admin/brand_size_chart/index/" + brand_id ;
		response = AjaxRequest.fire(url,{});
		if(response.count>0)
		{
			var data_holder = $(".data-holder");
			data_holder.html("");
			$(response.data).each(function(index,dt){
				clone = item_template.clone();
				console.log(clone);
				clone.find(".title").html(dt.bsc_title);
				clone.find(".html").html(dt.bsc_html);
				clone.find(".action").html(
										'<input type="button" class="btn prd_size_chart_btn_delete green red" data-id="'+dt.bsc_id+'" value="Delete" />' +
										'<input type="button" class="btn prd_size_chart_btn_edit green edit" data-id="'+dt.bsc_id+'" value="Edit" />'
									);
				data_holder.append(clone);
			});
		}
	}

	function clear_size_form () {
		 $("[name='brand_size_chart[bsc_id]']").val('');
		 $("[name='brand_sizechart[bsc_title]']").val('');
		 CKEDITOR.instances.bsc_html.setData('');
	}
</script>
