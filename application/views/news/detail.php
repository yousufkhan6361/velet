<link href="<?=g('base_url')?>assets/front_assets/css/font-awesome.css" rel="stylesheet" type="text/css"> 
<style type="text/css">
  div#home1 {
    margin-bottom: 81px;
}

.descriptiontext.mt-3 p {
    font-size: 16px;
    line-height: 1.9;
    color: #777;
}
</style>
<section class="shopdetailsec">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-5 col-lg-5 col-md-offset-3">
          <div class="shopdetailimg">
            <img style="width: 100%" src="<?=get_image($detail['news_image_path'],$detail['news_image'])?>" class="img-fluid" alt="img">
          </div>
        </div>
        
        <!--<div class="col-12 col-sm-12 col-md-7 col-lg-7">-->
        <!--  <div class="shopdetailtext">-->
        <!--    <h3 style="font-size: 28px;"><?=$detail['news_title']?></h3>-->
        <!--    <?=html_entity_decode(word_limiter($detail['news_description'],100))?>-->
        <!--  </div>-->
         

          
        <!--    </ul> -->
        <!--  </div> -->
        </div>
      </div>
    </div>
  </section>
  <!-- shop detetail sec end -->

  <!-- sec description start -->
  <section class="descriptionsec">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <div class="descriptionlist">
      <ul class="nav nav-tabs" id="myTab" role="tablist">
  <li class="nav-item">
    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home1" role="tab" aria-controls="home" aria-selected="true"></a>
  </li>
  <!-- <li class="nav-item">
    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile1" role="tab" aria-controls="profile" aria-selected="false">Reviews (0)</a>
  </li> -->
  
</ul>
<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home1" role="tabpanel" aria-labelledby="home-tab">
    <div class="descriptiontext mt-3">
        
     <?=html_entity_decode($detail['news_description'])?>
    </div>
  </div>
  <!-- <div class="tab-pane fade" id="profile1" role="tabpanel" aria-labelledby="profile-tab">
    <div class="reviewslist mt-3">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-6 col-lg-6">
          <div class="Reviewstext">
            <h4>REVIEWS</h4>
            <p>There are no reviews yet.</p>
          </div>
        </div>
         <div class="col-12 col-sm-12 col-md-6 col-lg-6">
           <form>
             <div class="Reviewsformtext">
               <h5>BE THE FIRST TO REVIEW “AUTOMOBILE 1”</h5>
               <p>Your email address will not be published. Required fields are marked *</p>
               <ul>
                 <li>Your rating *:</li>
                 <li><a href="#"><i class="far fa-star"></i></a></li>
                  <li><a href="#"><i class="far fa-star"></i></a></li>
                   <li><a href="#"><i class="far fa-star"></i></a></li>
                    <li><a href="#"><i class="far fa-star"></i></a></li>
                     <li><a href="#"><i class="far fa-star"></i></a></li>
               </ul>
             </div>
             <div class="row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
             <div class="Reviewslistinput">
               <label>Your review *</label>
               <textarea></textarea>
             </div>
           </div>
           </div>
           <div class="row">
              <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="Reviewslistinput">
               <label>Name *</label>
              <input type="text" name="">
             </div>
              </div>
               <div class="col-12 col-sm-12 col-md-6 col-lg-6">
                 <div class="Reviewslistinput">
               <label>Email  *</label>
              <input type="text" name="">
             </div>
              </div>
           </div>
           <div class="row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
             <div class="custom-control custom-checkbox">
    <input type="checkbox" class="custom-control-input" id="defaultUnchecked">
    <label class="custom-control-label" for="defaultUnchecked">Save my name, email, and website in this browser for the next time I comment.</label>
</div>
           </div>
           </div>
             <div class="row">
               <div class="col-12 col-sm-12 col-md-12 col-lg-12">
             <div class="Reviewslistinput">
               <button>Submit</button>
             </div>
           </div>
           </div>
           </form>
         </div>
      </div>
    </div>
  </div> -->
  
</div>
          </div>
        </div>
      </div>
    </div>
  </section> 