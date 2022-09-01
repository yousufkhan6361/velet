<div class="form-body">

    <div class="">
       <!--  <a class='btn btn-primary pull-left' href="<?=la('product_size/add/?product_id='.$form_data['product']['product_id'])?>" style='margin-bottom: 10px;'>Add new Size </a> -->
    </div>
    <?php
       $adsId = $form_data['ads']['ads_id'];
       $par5['where']['ads_videolinks_ads_id'] = $adsId;
       $adsVideos = $this->model_ads_videolinks->find_all($par5);
       //debug($adsGallery,1); 
       ?>

<?php if(empty($adsVideos)){ ?>

    <h3>Ads video links not found</h3>

<?php }else{ ?>

<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Video Links</th>
      <th scope="col">Delete</th>
      <!-- <th scope="col">Download</th> -->
     
    </tr>
  </thead>
  <tbody>
    <?php foreach ($adsVideos as $key => $video){  ?>
    <tr>
      <th scope="row"><?=$video['ads_videolinks_id']?></th>
        
        <td>
        <a target="_blank" href="<?=$video['ads_videolinks']?>">
        <span style="font-size: 14px;font-weight: bold;color: #32c5d2;"><?=$video['ads_videolinks']?></span>
        </a>
      </td>

       <th scope="row">
      <a href="<?=la('ads/deleteAdsVideolink/'.$video["ads_videolinks_id"]).'?adid='.$this->uri->segment(4)?>">
        <i class="fa fa-trash fa-lg" style="color: red;" aria-hidden="true"></i>
      </a>
      </th>

    
      
    </tr>

    <?php 
   
} ?>
    
  </tbody>
</table>

<br>
<form action="<?=la('ads/addlinks')?>" method="POST" enctype="multipart/form-data">
  <input type="text" placeholder="Add Video Link" class="form-control" name="links" style="width: 40%;">
  <br>
  <input type="hidden" name="adId" value="<?=$this->uri->segment(4)?>">
  <input type="submit" style="width: 29%;background: #007aff;color: white;" type="submit" class="form-control" name="" value="Add link">
</form>

<?php } ?>

</div>