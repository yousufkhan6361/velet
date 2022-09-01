<div class="form-body">

    <div class="">
       <!--  <a class='btn btn-primary pull-left' href="<?=la('product_size/add/?product_id='.$form_data['product']['product_id'])?>" style='margin-bottom: 10px;'>Add new Size </a> -->
    </div>
    <?php
       $adsId = $form_data['ads']['ads_id'];
       $par5['where']['ads_video_ads_id'] = $adsId;
       $adsVideos = $this->model_ads_video->find_all($par5);
       //debug($adsVideos,1); 
       ?>

<?php if(empty($adsVideos)){ ?>

    <h3>Ads images not found</h3>

<?php }else{ ?>

<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Videos</th>
      <th scope="col">Delete</th>
     
    </tr>
  </thead>
  <tbody>
    <?php foreach ($adsVideos as $key => $video){  ?>
    <tr>
      <th scope="row"><?=$video['ads_video_id']?></th>
      <td>

        <video width="300" height="200" controls>
          <source src="<?=g('base_url')?><?=$video['ads_video_image_path']?>/<?=$video['ads_video_image']?>" type="video/mp4">
          <source src="<?=g('base_url')?><?=$video['ads_video_image_path']?>/<?=$video['ads_video_image']?>" type="video/ogg">
          Your browser does not support the video tag.
        </video>
      </td>

      <th scope="row">
      <a href="<?=la('ads/deleteAdsVideo/'.$video["ads_video_id"]).'?adid='.$this->uri->segment(4)?>">
        <i class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i>
      </a>
      </th>
      
    </tr>

    <?php 
   
} ?>
    
  </tbody>
</table>
<br>
<form action="<?=la('ads/uploadVideos')?>" method="POST" enctype="multipart/form-data">
  <input style="width: 29%;" type="file" class="form-control" name="multiVideos[]" multiple><br>
  <input type="hidden" name="adId" value="<?=$this->uri->segment(4)?>">
  <input style="width: 29%;background: #007aff;color: white;" type="submit" class="form-control" name="" value="Upload">
</form>


<?php } ?>

</div>