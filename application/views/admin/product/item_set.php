<?global $config;
$productOthers = $this->model_product_other->find_all_active(array('where'=>array('product_other_pid'=>$id)));
?>



	<div class="form-body">
        
        <div class="alert alert-danger display-hide">
          <button class="close" data-close="alert"></button>
          You have some form errors. Please check below.
        </div>
        <div class="alert alert-success display-hide">
          <button class="close" data-close="alert"></button>
          Your form validation is successful!
        </div>

    	<input type = "hidden" value="<?=$id?>" name = "product_item_set[pis_product_id]" />
        
			<div class="portlet box red">
			<div class="portlet-title">

				<div class="caption">
				<div class="tools">
				<a href="javascript:void(0);" style="color:#fff;" id="addMore">
				<i class="fa fa-plus"></i> Add New
				</a>
				</div>

				
				</div>
			</div>
			<div class="table-scrollable item_set">
				<table class="table table-striped table-hover">
					<thead>
	        		<?
	        		if(count($productOthers) > 0){
	        		$columns = array(/*"color",*/"Name","Image","action");
		        	foreach ($columns as $col) {?>
			            <th>
							<?=label_encode($col)?>
			            </th>
		        	<?}?>
					</thead>
					<tbody class="data-holder">
					<?php
	        		
	        		foreach ($productOthers as $key => $value) {
	        		?>
					<tr  class="item_set template">
	        		
	        		<td  class="form-group">
			        	<?=$value['product_other_name']?>	    
			        </td>
			        <td  class="form-group">

			        	<img width="50" height="50" src="<?=g('base_url')?><?=$value['product_other_image_path']?><?=$value['product_other_image']?>">
			        </td>
			        <td  class="form-group">
			        	<a href="javascript:void(0);" style="color:#000;" id="addMoreEdit" data-otherid="<?=$value['product_other_id']?>">Edit</a> | 
			        	<a href="<?=g('base_url')?>admin/product/delete_other/<?=$id?>" style="color:#000;">Delete</a>
			        </td>
			        </tr>
			        <?php
			    	}
			    	}
			    	else{
			    		echo "<span style='color:#fff'>No record found</span>";
			    	}
			        ?>
					
					</tbody>
		        </table>
	        </div>
	        </div>

</div>


<div class="modal fade" id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Edit Other Sections</h4>
      </div>
      <div class="modal-body">
        
      <form class="cmxform horizontal-form tasi-form" 
	id="product_other2" 
	method="POST" 
	action="<?=$config['base_url']?>admin/product/product_other_edit" 
>	
		<input type = "hidden" value="" name = "product_other[product_other_id]" id="id" />
      	<input type = "hidden" value="<?=$id?>" name = "product_other[product_other_pid]" id="product_id" />
      	<input placeholder="Title" id="name" class="form-control" type="text" name="product_other[product_other_name]">
      	<br>
      	<textarea placeholder="Detail" id="detail" class=" form-control " name="product_other[product_other_detail]"></textarea>
      	<br>
      	<img src="" id="image" width="50" height="50">
      	<input style="height:unset !important;" type="file" name="product_other[product_other_image]" class="form-control">

      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitOther2">Save changes</button>
      </div>
    </div>
  </div>
</div>


<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Add Other Sections</h4>
      </div>
      <div class="modal-body">
        
      <form class="cmxform horizontal-form tasi-form" 
	id="product_other" 
	method="POST" 
	action="<?=$config['base_url']?>admin/product/product_other" 
>
      	<input type = "hidden" value="<?=$id?>" name = "product_other[product_other_pid]" />
      	<input placeholder="Title" class="form-control" type="text" name="product_other[product_other_name]">
      	<br>
      	<textarea placeholder="Detail" class=" form-control " name="product_other[product_other_detail]"></textarea>
      	<br>
      	<input style="height:unset !important;" type="file" name="product_other[product_other_image]" class="form-control">

      </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" id="submitOther">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script>
	$(document).ready(function() {

		$("#addMoreEdit").click(function () {
			var otherid = $(this).attr("data-otherid");
			var url = "<?=$config['base_url']?>admin/product/get_update_record";
			var data = "otherid="+otherid;
	        $.ajax({
	            url: url,
	            type: "POST",
	            data: data,
	            dataType: "json",  // Has to be false to be able to return response
	            success: function(response) 
	            {
	                //if(response.status == true){
	                	$('#myModal2').modal('show') ;
	                    //AdminToastr.success(response.txt);
	                    //location.reload(); 
	                    $("#product_id").val(response.product_id);
	                    $("#name").val(response.name);
	                    $("#detail").val(response.detail);
	                    $("#id").val(response.id);
	                    $("#image").attr('src', response.image);
	                    
	                //}	                
	            }
	        });  // JQUERY Native Ajax End*/
	        return false;			
		});		
	

		$("#addMore").click(function () {
			$('#myModal').modal('show') ;               // initializes and invokes show immediately
		});		

		$("#submitOther2").click(function () {
			
			var url = $("#product_other2").attr("action");
			var data = new FormData(document.getElementById("product_other2"));
	        $.ajax({
	            url: url,
	            type: "POST",
	            data: data,
	            dataType: "json",  // Has to be false to be able to return response
	            processData: false,
	            contentType: false,
	            success: function(response) 
	            {
	                if(response.status == true){
	                    AdminToastr.success(response.txt);
	                    location.reload(); 
	                }
	                else{
	                	AdminToastr.error(response.txt);
	                }
	            }
	        });  // JQUERY Native Ajax End*/
	        return false;
		});

		$("#submitOther").click(function () {
			
			var url = $("#product_other").attr("action");
			var data = new FormData(document.getElementById("product_other"));
	        $.ajax({
	            url: url,
	            type: "POST",
	            data: data,
	            dataType: "json",  // Has to be false to be able to return response
	            processData: false,
	            contentType: false,
	            success: function(response) 
	            {
	                if(response.status == true){
	                    AdminToastr.success(response.txt);
	                    location.reload(); 
	                }
	                else{
	                	AdminToastr.error(response.txt);
	                }
	            }
	        });  // JQUERY Native Ajax End*/
	        return false;
		});
	});
		
</script>
