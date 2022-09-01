<div class="form-body">

    <div class="">
       <!--  <a class='btn btn-primary pull-left' href="<?=la('product_size/add/?product_id='.$form_data['product']['product_id'])?>" style='margin-bottom: 10px;'>Add new Size </a> -->
    </div>
    <?php
       $adsId = $form_data['ads']['ads_id'];
       $par5['where']['ads_socialmedialinks_ads_id'] = $adsId;
       $adsSocialmedia = $this->model_ads_socialmedialinks->find_all($par5);
       //debug($adsGallery,1); 
       ?>

<?php if(empty($adsSocialmedia)){ ?>

    <h3>Ads social media links not found</h3>

<?php }else{ ?>

<table class="table table-bordered table-hover">
  <thead class="thead-dark">
    <tr>
      <th scope="col">Id</th>
      <th scope="col">Links</th>
      <!-- <th scope="col">Download</th> -->
     
    </tr>
  </thead>
  <tbody>
    <?php foreach ($adsSocialmedia as $key => $media){  ?>
    <tr>
      <th scope="row"><?=$media['ads_socialmedialinks_id']?></th>
      <td>
      
        <span style="font-size: 14px;font-weight: bold;color: #32c5d2;"><?=$media['ads_socialmedialinks']?></span>
      </td>
    
    </tr>

    <?php 
   
} ?>
    
  </tbody>
</table>
<?php } ?>

</div>