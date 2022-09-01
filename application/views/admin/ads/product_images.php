<div class="form-body">

    <div class="">
       <!--  <a class='btn btn-primary pull-left' href="<?=la('product_size/add/?product_id='.$form_data['product']['product_id'])?>" style='margin-bottom: 10px;'>Add new Size </a> -->
    </div>
    <?php
       $adsId = $form_data['ads']['ads_id'];
       $par5['where']['ads_gallery_ads_id'] = $adsId;
       $adsGallery = $this->model_ads_gallery->find_all($par5);
       //debug($adsGallery,1); 
       ?>

<?php if(empty($adsGallery)){ ?>

    <h3>Ads images not found</h3>

<?php }else{ ?>

<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Images</th>
      <th scope="col">Delete</th>
     
    </tr>
  </thead>
  <tbody>
    <?php foreach ($adsGallery as $key => $image){  ?>
    <tr>
      <th scope="row"><?=$image['ads_gallery_id']?></th>
      <td><img style="width: 100px; height: 100px; object-fit: cover;" src="<?=get_image($image['ads_gallery_image_path'],$image['ads_gallery_image'])?>"></td>

      <th scope="row">
      <a href="<?=la('ads/deleteAdsImage/'.$image["ads_gallery_id"]).'?adid='.$this->uri->segment(4)?>">
        <i class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i>
      </a>
      </th>
      
    </tr>

    <?php 
   
} ?>
    
  </tbody>
</table>
<br>
<form action="<?=la('ads/uploadImages')?>" method="POST" enctype="multipart/form-data">
  <input style="width: 29%;" type="file" class="form-control" name="multiImages[]" multiple><br>
  <input type="hidden" name="adId" value="<?=$this->uri->segment(4)?>">
  <input style="width: 29%;background: #007aff;color: white;" type="submit" class="form-control" name="" value="Upload">
</form>


<?php } ?>

</div>