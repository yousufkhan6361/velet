<div class="form-body">

    <div class="">
       <!--  <a class='btn btn-primary pull-left' href="<?=la('product_size/add/?product_id='.$form_data['product']['product_id'])?>" style='margin-bottom: 10px;'>Add new Size </a> -->
    </div>
    <?php
       $adsId = $form_data['ads']['ads_id'];
       $par5['where']['ads_docs_ads_id'] = $adsId;
       $adsDocs = $this->model_ads_docs->find_all($par5);
       //debug($adsGallery,1); 
       ?>

<?php if(empty($adsDocs)){ ?>

    <h3>Ads documents not found</h3>

<?php }else{ ?>

<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Documents</th>
      <th scope="col">Download</th>
      <th scope="col">Delete</th>
     
    </tr>
  </thead>
  <tbody>
    <?php foreach ($adsDocs as $key => $doc){  ?>
    <tr>
      <th scope="row"><?=$doc['ads_docs_id']?></th>
      <td>
      
        <img style="width: 100px; height: 100px; object-fit: cover;" src="<?=g('base_url')?>assets/front_assets/images/doc-pngrepo-com.png">
      
      </td>
      <td>
        <a href="<?=g('base_url')?><?=$doc['ads_docs_image_path']?>/<?=$doc['ads_docs_image']?>">
        <span style="font-size: 14px;
    font-weight: bold;
    color: #32c5d2;">Download</span>
        </a>
      </td>

      <th scope="row">
      <a href="<?=la('ads/deleteAdsDocs/'.$doc["ads_docs_id"]).'?adid='.$this->uri->segment(4)?>">
        <i class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i>
      </a>
      </th>
      
    </tr>

    <?php 
   
} ?>
    
  </tbody>
</table>

<br>
<form action="<?=la('ads/uploadDocs')?>" method="POST" enctype="multipart/form-data">
  <input style="width: 29%;" type="file" class="form-control" name="multiDocs[]" multiple><br>
  <input type="hidden" name="adId" value="<?=$this->uri->segment(4)?>">
  <input style="width: 29%;background: #007aff;color: white;" type="submit" class="form-control" name="" value="Upload">
</form>


<?php } ?>

</div>