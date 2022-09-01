<style type="text/css">
  .otherbtn{
    background-color: #d9dde0;
    border-color: #c5c9ce;
    color: black;
    width: 86px;
  }

  .alertmsg{
    /*color: #004085;*/
    background-color: #b70c0c;
    border-color: #f7f7f7;
    font-size: 23px;
    text-align: center;
    color: white;
  }

  /*Radio button Css*/
  /* Custom Radio Button Start*/

.radiotextsty {
  color: #A5A4BF;
  font-size: 18px;
}

.customradio {
  display: block;
  position: relative;
  padding-left: 30px;
  margin-bottom: 0px;
  cursor: pointer;
  font-size: 18px;
  -webkit-user-select: none;
  -moz-user-select: none;
  -ms-user-select: none;
  user-select: none;
}

/* Hide the browser's default radio button */
.customradio input {
  position: absolute;
  opacity: 0;
  cursor: pointer;
}

/* Create a custom radio button */
.checkmark {
  position: absolute;
  top: 0;
  left: 0;
  height: 22px;
  width: 22px;
  background-color: white;
  border-radius: 50%;
  border:1px solid #BEBEBE;
}

/* On mouse-over, add a grey background color */
.customradio:hover input ~ .checkmark {
  background-color: transparent;
}

/* When the radio button is checked, add a blue background */
.customradio input:checked ~ .checkmark {
  background-color: white;
  border:1px solid #BEBEBE;
}

/* Create the indicator (the dot/circle - hidden when not checked) */
.checkmark:after {
  content: "";
  position: absolute;
  display: none;
}

/* Show the indicator (dot/circle) when checked */
.customradio input:checked ~ .checkmark:after {
  display: block;
}

/* Style the indicator (dot/circle) */
.customradio .checkmark:after {
  top: 2px;
  left: 2px;
  width: 16px;
  height: 16px;
  border-radius: 50%;
  background: #A3A0FB;
}


.customradio{
  width: 200px;
}

.navbar{

  margin-bottom: 0 !important;
}
/* Custom Radio Button End*/

button{
  padding: 12px 20px;
  font-size: 13px;
  line-height: 18px;
  position: relative;
  display: inline-flex;
  align-items: center;
  justify-content: center;
  outline: 0;
  border-width: 0;
  border-style: solid;
  border-color: transparent;
  border-radius: 0;
  box-shadow: none;
  vertical-align: middle;
  text-align: center;
  text-decoration: none;
  text-transform: uppercase;
  text-shadow: none;
  letter-spacing: .3px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s ease-in-out;
  background: #1171b4;
  color: #fff;
  width: 100%;
  font-family: Lato;
  margin-top: 20px;
}
</style>
<style type="text/css">
  .editForm{
    width: 90%;
    background: #e8e6e6;
    padding: 30px 40px;
    border-radius: 5px;
    box-shadow: 1px 1px 10px 1px #00000026;
  }
</style>





<? $this->load->view("account/header"); ?>

<div class="signup"  style="">

<div class="container" id='goTo'>
       <?php $this->load->view('widgets/breadcrum'); ?>
        <!-- BEGIN SIDEBAR & CONTENT -->
        <div class="row margin-bottom-40">
          <!-- BEGIN SIDEBAR -->
          <div class="sidebar col-md-3 col-sm-3">
         <? $this->load->view("account/menu"); ?>
         </div>
          <!-- END SIDEBAR -->
          <!-- BEGIN CONTENT -->
          <div class="col-md-9 col-sm-7">
            <div class="content-page">
              <div class="row">

            <?php if($userPackageId == 1){ ?>

              <form class="editForm" id="adsForm1" action="<?=g('base_url')?>account/updateAdForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Ad Title</label>
                  <input type="text" id="title" name="ads[ads_title]" value="<?=$adsData[0]['ads_title']?>" required="" class="form-control ">
                  <input type="hidden" name="ads[ads_category_id]" id="category_id" value="">
                  <input type="hidden" name="adId" value="<?=$adsId?>">
                  <input type="hidden" name="paidPackageId" value="<?=$userPackageId?>">

                  <input type="hidden" name="ads[ads_category_id]" id="category_id" value="<?=$adsData[0]['ads_category_id']?>">
                  <input type="hidden" name="ads[ads_user_id]" id="user_id" value="<?=$this->userid?>">

                </div>

                <div class="form-group">
                  <label for="inputState">Select Category</label>
                  <select style="height: auto;" id="category" name="ads[ads_category]" class="form-control">
                    <option value="" selected>-select-</option>
                      <option value="Other">Other</option>
                    <?php foreach ($categories as $key => $category){ ?>
                    <option <?php if($category['category_id'] == $adsData[0]['ads_category_id']){ ?> selected <?php } ?> value="<?=$category['category_slug']?>" catid="<?=$category['category_id']?>">
                      <?=$category['category_name']?>
                        
                    </option>
                    <?php } ?>
                  </select>
                  <small id="emailHelp" class="form-text text-muted">Select a category for your product</small>
                </div>

                <!-- <div class="form-group">
                  <input type="text" name="ads[ads_other_category]" class="form-control " id="otherCategoryField" placeholder="Enter Category">
                </div> -->

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Ad Description</label>
                  <textarea class="form-control" id="question_text" required name="ads[ads_description]" rows="10">
                    <?=html_entity_decode($adsData[0]['ads_description'])?>
                  </textarea>
                  <small id="emailHelp" name="ads[ads_description2]" class="form-text text-muted">Provide a short description of your product</small>
                </div>


                <div class="form-group">
                  <label for="">Email </label>
                  <input type="text" name="ads[ads_email]" class="form-control " value="<?=$adsData[0]['ads_email']?>">
                </div>

                <div class="form-group">
                  <label for="">Phone </label>
                  <input type="text" name="ads[ads_phone]" class="form-control " value="<?=$adsData[0]['ads_phone']?>">
                </div>

                <div class="form-group">
                  <label for="">Address </label>
                  <input type="text" name="ads[ads_address]" class="form-control " value="<?=$adsData[0]['ads_address']?>">
                </div>

                <div class="form-group">
                  <label for="">Website Link </label>
                  <input type="text" name="ads[ads_websitelink]" class="form-control " value="<?=$adsData[0]['ads_websitelink']?>">
                  <input type="hidden" id="tiny_html" name="tiny_html" />
                </div>

                <!-- <div class="form-group">
                  <label for="">Facebook </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div> -->

                <?php foreach ($soicialMediaLinks as $key => $slink) { ?>
                  <div class="form-group">
                    <label for="">Social Media link <?=$key+1?> </label>
                    <input type="text" name="socialMediaLins[]" class="form-control " value="<?=$slink['ads_socialmedialinks']?>">
                    <input type="hidden" name="ids[]" class="form-control " value="<?=$slink['ads_socialmedialinks_id']?>">
                  </div>
                <?php } ?>
                <hr>

               <!--  <div class="form-group">
                  <label for="">Twitter </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div> -->

                <div class="form-group">
                  <label >Add Logo</label>
                  <br>
                  <img class="responsive" style="width: 100px; height: 100px; object-fit: cover;" src="<?=get_image($adsData[0]['ads_image_path'],$adsData[0]['ads_image'])?>">
                  <br>
                  <input style="padding-top: 11px;" type="file" name="ads[ads_image]" class="form-control-file">
                  <small id="emailHelp" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                <div class="form-group">
                  <label >Add Gallery Images</label>
                  <input type="file" class="form-control-file" id="multiImages" name="multiImages[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional pictures of your ad and will be shown as image gallery</small>
                </div>

                <div class="row">

                <?php foreach ($adsGallery as $key => $gallery){ ?>
                
                  <div class="col-md-3">
                   
                  <div class="thumbnail" style="text-align: center;">
                    <img style="width: 100px; height: 100px; object-fit: cover;" src="<?=get_image($gallery['ads_gallery_image_path'],$gallery['ads_gallery_image'])?>">

                    <a href="<?=g('base_url')?>account/delete-image/<?=$gallery['ads_gallery_id']?>">
                      <i class="fa fa-trash" style="color: #a50909;" title="Delete Image" aria-hidden="true"></i>
                    </a>
                  </div>
                  </div>




                <?php } ?>

                </div>

                <button type="button" class="btn-form hvr-grow tc-image-effect-shine formSubmitbtn1">Update Ad</button>
              </form>

            <?php } ?>


            <?php if($userPackageId == 2){ ?>

              <form class="editForm" id="adsForm1" action="<?=g('base_url')?>account/updateAdForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Ad Title</label>
                  <input type="text" id="title" name="ads[ads_title]" value="<?=$adsData[0]['ads_title']?>" class="form-control ">

                  <input type="hidden" name="adId" value="<?=$adsId?>">

                  <input type="hidden" name="paidPackageId" value="<?=$userPackageId?>">

                  <input type="hidden" name="ads[ads_category_id]" id="category_id" value="<?=$adsData[0]['ads_category_id']?>">

                  <input type="hidden" name="ads[ads_user_id]" id="user_id" value="<?=$this->userid?>">

                </div>

                <div class="form-group">
                  <label for="inputState">Select Category</label>
                  <select style="height: auto;" id="category" name="ads[ads_category]" class="form-control">
                    <option value="" selected>-select-</option>
                      <option value="Other">Other</option>
                    <?php foreach ($categories as $key => $category){ ?>
                    <option <?php if($category['category_id'] == $adsData[0]['ads_category_id']){ ?> selected <?php } ?> value="<?=$category['category_slug']?>" catid="<?=$category['category_id']?>">
                      <?=$category['category_name']?>
                        
                    </option>
                    <?php } ?>
                  </select>
                  <small id="emailHelp" class="form-text text-muted">Select a category for your product</small>
                </div>

                <!-- <div class="form-group">
                  <input type="text" name="ads[ads_other_category]" class="form-control " id="otherCategoryField" placeholder="Enter Category">
                </div> -->

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Ad Description</label>
                  <textarea id="question_text" class="form-control " required name="ads[ads_description]" rows="10">
                    <?=html_entity_decode($adsData[0]['ads_description'])?>
                  </textarea>
                  <small id="emailHelp" name="ads[ads_description2]" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                <div class="form-group">
                  <label for="">Email </label>
                  <input type="text" name="ads[ads_email]" class="form-control " value="<?=$adsData[0]['ads_email']?>">
                </div>

                <div class="form-group">
                  <label for="">Phone </label>
                  <input type="text" name="ads[ads_phone]" class="form-control " value=" <?=$adsData[0]['ads_phone']?>">
                </div>

                <div class="form-group">
                  <label for="">Address </label>
                  <input type="text" name="ads[ads_address]" class="form-control " value="<?=$adsData[0]['ads_address']?>">
                </div>

                <div class="form-group">
                  <label for="">Website Link </label>
                  <input type="text" name="ads[ads_websitelink]" class="form-control " value="<?=$adsData[0]['ads_websitelink']?>">
                  <input type="hidden" id="tiny_html" name="tiny_html" />
                </div>

                <?php foreach ($soicialMediaLinks as $key => $slink) { ?>
                  <div class="form-group">
                    <label for="">Social Media Link <?=$key+1?> </label>
                    <input type="text" name="socialMediaLins[]" class="form-control " value="<?=$slink['ads_socialmedialinks']?>">
                    <input type="hidden" name="ids[]" class="form-control " value="<?=$slink['ads_socialmedialinks_id']?>">
                  </div>
                <?php } ?>
                <hr>

                <div class="form-group">
                  <label >Ad Logo</label>
                  <br>
                  <img class="responsive" style="width: 100px; height: 100px; object-fit: cover;" src="<?=get_image($adsData[0]['ads_image_path'],$adsData[0]['ads_image'])?>">

                  <input style="padding-top: 11px;" type="file" required name="ads[ads_image]" class="form-control-file">
                  <small id="emailHelp" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                <div class="form-group">
                  <label >Add Gallery Images</label>
                  <input type="file" class="form-control-file" id="multiImages" name="multiImages[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional pictures of your ad and will be shown as image gallery</small>
                </div>

                <div class="row">

                <?php foreach ($adsGallery as $key => $gallery){ ?>
                
                  <div class="col-md-3">
                  <div class="thumbnail" style="text-align: center;">
                    <img style="width: 100px; height: 100px; object-fit: cover;" src="<?=get_image($gallery['ads_gallery_image_path'],$gallery['ads_gallery_image'])?>">

                    <a href="<?=g('base_url')?>account/delete-image/<?=$gallery['ads_gallery_id']?>">
                      <i class="fa fa-trash" style="color: #a50909;" title="Delete Image" aria-hidden="true"></i>
                    </a>
                  </div>
                  </div>

                <?php } ?>

                </div>


              <?php if($adsVideoLinks){ ?>

              <div class="videoLinkSection">
                <?php foreach ($adsVideoLinks as $key => $videoLink){ ?>
                  <div class="form-group">
                      <label for="">Video Link <?=$key+1?></label>
                      <input type="text" name="videoLinks[]" class="form-control " value="<?=$videoLink['ads_videolinks']?>">
                      <input type="hidden" name="vids[]" class="form-control " value="<?=$videoLink['ads_videolinks_id']?>">
                  </div>
                <?php } ?>

              </div>

              <?php }else{ ?>

                <div class="form-group videoSection">
                <label >Add Videos</label>
                <input type="file" id="multiVideos" class="form-control-file" name="multiVideos[]" multiple>
                <small id="emailHelp" class="form-text text-muted">Upload additional videos of your ad and will be shown as video gallery
                  <br>
                  Allowed extensions : mp4 | mov | flv
                </small>
              </div>

              <div class="row">

              <?php foreach ($adsVideos as $key => $adsvideo){ ?>
                <div class="col-md-3" style="text-align: center;">
                  <video width="200" height="150" controls>
                    <source src="<?=g('base_url').$adsvideo['ads_video_image_path'].'/'.$adsvideo['ads_video_image']?>" type="video/mp4">
                    <source src="<?=g('base_url').$adsvideo['ads_video_image_path'].'/'.$adsvideo['ads_video_image']?>" type="video/mp4" type="video/ogg">
                    Your browser does not support the video tag.
                  </video>

                  <a href="<?=g('base_url')?>account/delete-video/<?=$adsvideo['ads_video_id']?>">
                    <i class="fa fa-trash" style="color: #a50909;" title="Delete Video" aria-hidden="true"></i>
                  </a>

                </div>
              <?php } ?>
              </div>
              <?php } ?>  
              
              <hr>

                <div class="form-group">
                  <label >Add Documents</label>
                  <input type="file" id="multiDocs" class="form-control-file" name="multiDocs[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional documents of your ad and will be shown as document listing
                    <br>
                    Allowed extensions : doc | docx
                  </small>
                </div>

                <div class="row" style="text-align: center;">
                <?php foreach ($adsDocs as $key => $adsDoc){ ?>
                <div class="col-md-3" style="text-align: center;">
                <a href="<?=g('base_url').$adsDoc['ads_docs_image_path'].'/'.$adsDoc['ads_docs_image']?>" target="_blank">
                  <img style="width: 100px; height: 100px; object-fit: cover;" src="<?=g('base_url')?>assets/front_assets/images/doc-pngrepo-com.png">
                  <small id="emailHelp" class="form-text text-muted"><?=$adsDoc['ads_docs_image']?></small>
                </a>

                <a href="<?=g('base_url')?>account/delete-doc/<?=$adsDoc['ads_docs_id']?>">
                  <i class="fa fa-trash" style="color: #a50909;" title="Delete Doc" aria-hidden="true"></i>
                </a>

                </div>
                <?php } ?>
              </div>

                <button type="button" class="btn-form hvr-grow tc-image-effect-shine formSubmitbtn1">Update Ad</button>
              </form>

            <?php } ?>


            <?php if($userPackageId == 3){ ?>

              <form class="editForm" id="adsForm1" action="<?=g('base_url')?>account/updateAdForm" method="post" enctype="multipart/form-data">
                <div class="form-group">
                  <label for="">Ad Title</label>
                  <input type="text" id="title" name="ads[ads_title]" value="<?=$adsData[0]['ads_title']?>" class="form-control ">

                  <input type="hidden" name="adId" value="<?=$adsId?>">

                  <input type="hidden" name="paidPackageId" value="<?=$userPackageId?>">

                  <input type="hidden" name="ads[ads_category_id]" id="category_id" value="<?=$adsData[0]['ads_category_id']?>">

                  <input type="hidden" name="ads[ads_user_id]" id="user_id" value="<?=$this->userid?>">

                </div>

                <div class="form-group">
                  <label for="inputState">Select Category</label>
                  <select style="height: auto;" id="category" name="ads[ads_category]" class="form-control">
                    <option value="" selected>-select-</option>
                      <option value="Other">Other</option>
                    <?php foreach ($categories as $key => $category){ ?>
                    <option <?php if($category['category_id'] == $adsData[0]['ads_category_id']){ ?> selected <?php } ?> value="<?=$category['category_slug']?>" catid="<?=$category['category_id']?>">
                      <?=$category['category_name']?>
                        
                    </option>
                    <?php } ?>
                  </select>
                  <small id="emailHelp" class="form-text text-muted">Select a category for your product</small>
                </div>

                <div class="form-group">
                  <label for="exampleFormControlTextarea1">Ad Description</label>
                  <textarea id="question_text" class="form-control " required name="ads[ads_description]" rows="10">
                    <?=html_entity_decode($adsData[0]['ads_description'])?>
                  </textarea>
                  <small id="emailHelp" name="ads[ads_description2]" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                <div class="form-group">
                  <label for="">Website Link </label>
                  <input type="text" name="ads[ads_websitelink]" class="form-control " value="<?=$adsData[0]['ads_websitelink']?>">
                  <input type="hidden" id="tiny_html" name="tiny_html" />
                </div>

                 <div class="form-group">
                  <label for="">Email </label>
                  <input type="text" name="ads[ads_email]" class="form-control " value="<?=$adsData[0]['ads_email']?>">
                </div>

                <div class="form-group">
                  <label for="">Phone </label>
                  <input type="text" name="ads[ads_phone]" class="form-control " value=" <?=$adsData[0]['ads_phone']?>">
                </div>

                <div class="form-group">
                  <label for="">Address </label>
                  <input type="text" name="ads[ads_address]" class="form-control " value="<?=$adsData[0]['ads_address']?>">
                </div>

                <?php foreach ($soicialMediaLinks as $key => $slink) { ?>
                  <div class="form-group">
                    <label for="">Social Media link <?=$key+1?> </label>
                    <input type="text" name="socialMediaLins[]" class="form-control " value="<?=$slink['ads_socialmedialinks']?>">
                    <input type="hidden" name="ids[]" class="form-control " value="<?=$slink['ads_socialmedialinks_id']?>">
                  </div>
                <?php } ?>
                <hr>

                <!-- <div class="form-group">
                  <label for="">Twitter </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Instagram </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Youtube </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div>

                <div class="form-group">
                  <label for="">Pinterest </label>
                  <input type="text" name="socialMediaLins[]" class="form-control " value="">
                </div> -->

                <div class="form-group">
                  <label >Ad Logo</label>
                  <br>
                  <img class="responsive" style="width: 100px; height: 100px; object-fit: cover;" src="<?=get_image($adsData[0]['ads_image_path'],$adsData[0]['ads_image'])?>">

                  <input style="padding-top: 11px;" type="file" required name="ads[ads_image]" class="form-control-file">
                  <small id="emailHelp" class="form-text text-muted">Provide a short description of your product</small>
                </div>

                <div class="form-group">
                  <label >Add Gallery Images</label>
                  <input type="file" id="multiImages" class="form-control-file" name="multiImages[]" multiple>
                  <small id="emailHelp" class="form-text text-muted">Upload additional pictures of your ad and will be shown as image gallery</small>
                </div>

                <div class="row">

                <?php foreach ($adsGallery as $key => $gallery){ ?>
                
                  <div class="col-md-3">
                  <div class="thumbnail" style="text-align: center;">

                    <img style="width: 100px; height: 100px; object-fit: cover;" src="<?=get_image($gallery['ads_gallery_image_path'],$gallery['ads_gallery_image'])?>">
                    <a href="<?=g('base_url')?>account/delete-image/<?=$gallery['ads_gallery_id']?>">
                      <i class="fa fa-trash" style="color: #a50909;" title="Delete Image" aria-hidden="true"></i>
                    </a>
                  </div>
                  </div>

                <?php } ?>

                </div>

                <hr>

              <?php if($adsVideoLinks){ ?>

              <div class="videoLinkSection">
                <?php foreach ($adsVideoLinks as $key => $videoLink){ ?>
                  <div class="form-group">
                      <label for="">Video Link <?=$key+1?></label>
                      <input type="text" name="videoLinks[]" class="form-control " value="<?=$videoLink['ads_videolinks']?>">
                      <input type="hidden" name="vids[]" class="form-control " value="<?=$videoLink['ads_videolinks_id']?>">
                  </div>
                <?php } ?>

              </div>

              <?php }else{ ?>

                <div class="form-group videoSection">
                <label >Add Videos</label>
                <input type="file" id="multiVideos" class="form-control-file" name="multiVideos[]" multiple>
                <small id="emailHelp" class="form-text text-muted">Upload additional videos of your ad and will be shown as video gallery
                  <br>
                  Allowed extensions : mp4 | mov | flv
                </small>
              </div>

              <div class="row">

              <?php foreach ($adsVideos as $key => $adsvideo){ ?>
                <div class="col-md-3" style="text-align: center;">
                  <video width="200" height="150" controls>
                    <source src="<?=g('base_url').$adsvideo['ads_video_image_path'].'/'.$adsvideo['ads_video_image']?>" type="video/mp4">
                    <source src="<?=g('base_url').$adsvideo['ads_video_image_path'].'/'.$adsvideo['ads_video_image']?>" type="video/mp4" type="video/ogg">
                    Your browser does not support the video tag.
                  </video>
                  <a href="<?=g('base_url')?>account/delete-video/<?=$adsvideo['ads_video_id']?>">
                      <i class="fa fa-trash" style="color: #a50909;" title="Delete Video" aria-hidden="true"></i>
                    </a>
                </div>
              <?php } ?>
              </div>
              <?php } ?>  
              
              <hr>
              

              <div class="form-group">
                <label >Add Documents</label>
                <input type="file" id="multiDocs" required class="form-control-file" name="multiDocs[]" multiple>
                <small id="emailHelp" class="form-text text-muted">Upload additional documents of your ad and will be shown as document listing
                  <br>
                  Allowed extensions : doc | docx
                </small>
              </div>

              <div class="row" style="text-align: center;">
                <?php foreach ($adsDocs as $key => $adsDoc){ ?>
                <div class="col-md-3">
                <a href="<?=g('base_url').$adsDoc['ads_docs_image_path'].'/'.$adsDoc['ads_docs_image']?>" target="_blank">
                  <img style="width: 100px; height: 100px; object-fit: cover;" src="<?=g('base_url')?>assets/front_assets/images/doc-pngrepo-com.png">
                  <small id="emailHelp" class="form-text text-muted"><?=$adsDoc['ads_docs_image']?></small>
                </a>

                <a href="<?=g('base_url')?>account/delete-doc/<?=$adsDoc['ads_docs_id']?>">
                      <i class="fa fa-trash" style="color: #a50909;" title="Delete Doc" aria-hidden="true"></i>
                    </a>
                </div>
                <?php } ?>
              </div>

                <button type="button" class="btn-form hvr-grow tc-image-effect-shine formSubmitbtn1">Update Ad</button>
              </form>

              

            <?php } ?>



          </div>
          </div>
          </div>
          <!-- END CONTENT -->
        </div>
        <!-- END SIDEBAR & CONTENT -->
      </div>

</div>


 <script src="https://cdn.tiny.cloud/1/ufv1dbighol5piud5530h18x4lije4p5dhdzuxrbcrzvt88i/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>


<script>

$(document).ready(function (){    
        $(".formSubmitbtn1").click(function (){
         
         $('#tiny_html').val(tinyMCE.get('question_text').getContent());

         var url = $("#adsForm1").attr("action");

         var form_data = new FormData(document.getElementById("adsForm1"));
         //e.preventDefault();
         // AJAX request
         $.ajax({
           url: url, 
           type: 'POST',
           data: form_data,
           dataType: 'json',
           contentType: false,
           processData: false,
           success: function (response) {
            console.log(response);
            //return false;
            if(response.status == 1){

                  AdminToastr.success(response.txt, 'Success');
                  setTimeout(function(){
                  //window.location="<?=$_SERVER['HTTP_REFERER']?>";
                  window.location="<?=g('base_url')?>account/edit-form/<?=$this->uri->segment(3)?>";
                  },2000)
                  
                  //AdminToastr.success("Success", 'Success');
              }
              else{

                //AdminToastr.error(response.txt);
                AdminToastr.error(response.txt, 'Error');
                //AdminToastr.success("Error", 'Error');
              }

           }
         });
            
        });
    });

</script>





<script>
  
tinymce.init({
  selector: 'textarea#question_text',
  height: 500,
  plugins: [
    'advlist autolink lists link image charmap print preview anchor',
    'searchreplace visualblocks code fullscreen',
    'insertdatetime media table paste imagetools wordcount'
  ],
  toolbar: 'insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image',
  content_style: 'body { font-family:Helvetica,Arial,sans-serif; font-size:14px }'
});


</script>

