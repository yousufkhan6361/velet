<style type="text/css">
  .notfound{
    text-align: center;
    background-color: #1562ae;
    color: white;
    padding: 11px;
    border-radius: 15px;
    /* font-family: inherit; */
    font-family: 'Poppins';
    line-height: initial;
  }
</style>

<style type="text/css">
  .section-beauty-head {
    background-image: url(<?=$imgPath?>);
    background-size: cover;
    background-position: center center;
    background-repeat: no-repeat;
    position: relative;
    padding: 100px 0px;
}



.section-beauty-head:before {
    position: absolute;
    content: '';
    background: #00000087;
    height: 100%;
    width: 100%;
    top: 0;
}

.temp1{
  position: relative;
    z-index: 99;
}
h2.vc_custom_heading {
    font-size: 15px;
    margin: 0;
}
h4.menu-price-title {
    font-size: 15px;
    margin: 8px 0px;
}



.listing{
    color: #777;
    margin-bottom: 20px;
    /* float: left; */
    padding: 0px 35px 0px 17px;
}


.listing li{
  position: relative;
    padding: 5px 0 5px 15px;
    font-size: 13px;
}

.listing li:before{
position: absolute;
    top: 5px;
    left: 0;
    color: #777;
    font-size: 13px;
    content: "\f105";
    font-family: "Font Awesome 5 Pro";
}

h2{
    display: block;
    font-size: 25px;
    color: #2d2a2a;
    font-family: 'Poppins';
    font-weight: 600;
    line-height: 1;
    padding-bottom:15px;
    margin-bottom: 0px;
    text-transform: uppercase;
    letter-spacing: 2px;
    margin-top: 0;
}


</style>


<style type="text/css">
  <style type="text/css">

.myTable {
  border-collapse: collapse;
    width: 100%;
    /* border: 1px solid #ddd; */
    font-size: 18px;
    margin-left: 2px;
}

.myTable th, .myTable td {
   text-align: left;
    padding: 8px;
    background: #fff;
    font-size: 15px;
    font-family: 'Poppins', sans-serif;
    line-height: 2;
}
.myTable th, .myTable td:hover{
  background: #1562ae;
}
.myTable th, .myTable td:hover a{
  color: #fff;
}
.myTable th, .myTable td a{
  color: #000;
}
.myTable th, .myTable td a:hover{
  color: #fff;
}

.myTable tr {
  border-bottom: 1px solid #ddd;
}

.myTable tr.header, .myTable tr:hover {
  background-color: #1562ae;
  color: white;
}

.header a {
  color: white;
}
.result{
    width: 56.9%;
    margin: 0px auto;  
}


.featurebox h2:hover {
    font-weight: bold;
    cursor: pointer;
}

.buisnessbox h4:hover {
    font-weight: bold;
}

.more_btn{
    background-image: linear-gradient(90deg ,#04a4ce, #175caa);
    color: white;
    padding: 10px 30px;
    border-radius: 5px;
    font-weight: 700;
    letter-spacing: 1px;
    margin: 0 auto;
    display: table;
}

.featurebox h2{
        margin-bottom: 0px;
    color: #2d2a2a;
    font-weight: 600;
    line-height: 1.4;
    font-family: 'Ubuntu', sans-serif;
}

.featurebox  p{
        color: #777;
    font-size: 14px;
    text-align:center;
    line-height: 20px;
    font-weight: 400;
    padding-bottom:5px;
    font-family: 'Lato', sans-serif;
}

.featurebox .overlayfavourite{
    top: 234px;
    bottom: inherit;
}

.featurebox .overlayfavourite a{
    text-align:center;
    display:block;
}

.featurebox img {
    margin: 0 auto;
    display: table;
}

section.featuresec {
    padding-top: 0px !important;
   
}

</style>
</style>



<main>
    <section class="section-beauty-head">
      <div class="container">

        <div class="temp1">
          
        <h1><?=$catName?></h1>
        <nav aria-label="breadcrumb">
         <!--  <ol class="breadcrumb align-items-center justify-content-center">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page">Beauty</li>
          </ol> -->
        </nav>
        </div>
      </div>
    </section>


<section class="featuresec">
    <div class="container">
      <div class="row">
        <div class="col-12 col-sm-12 col-md-12 col-lg-12">
          <div class="featureproducts">
           


<div class="tab-content" id="myTabContent">
  <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">

    <?php if(empty($ads)){ ?>
      <!--<div class="row">-->
      <!--  <div class="col-md-12">-->
      <!--    <h1 class="notfound">Ads not found in <?=ucfirst($catName)?></h1>-->
      <!--  </div>-->
      <!--</div>-->

      <?php }else{ ?>
      
    <div class="row mt-5">


      <?php foreach ($ads as $key => $ad){ ?>
    
      <div class="col-12 col-sm-12 col-md-4 col-lg-4">
        <div class="featurebox" data-aos="zoom-in" data-aos-delay="800" data-aos-easing="linear">
          <a href="<?=g('base_url')?>ad/<?=$ad['ads_slug']?>">
            <img style="width: 276px; height: 276px; object-fit: contain;" src="<?=get_image($ad['ads_image_path'],$ad['ads_image'])?>" class="img-fluid" alt="img"></a>
         <!--  <span class="hot">Premium</span> -->
          <div class="overlayfavourite">
            
            <form method="post" class="favForm" action="<?=g('base_url')?>home/addToFavourites">

            <a href="javascript:void(0);" class="fav"><i class="far fa-heart"></i>Add to Favourite</a></div>
              <input type="hidden" name="ads_id" value="<?=$ad['ads_id']?>">
              <input type="hidden" name="user_id" value="<?=$this->userid?>">
              <input type="hidden" name="ads_title" value="<?=$ad['ads_title']?>">
              <input type="hidden" name="ads_slug" value="<?=$ad['ads_slug']?>">
              <input type="hidden" name="ads_image_path" value="<?=$ad['ads_image_path']?>">
              <input type="hidden" name="ads_image" value="<?=$ad['ads_image']?>">

            </form>
          <h2 style="font-size: 16px !important;"><?=$ad['ads_title']?></h2>
          <p class="text-center cent_para"><?=html_entity_decode(word_limiter($ad['ads_description2'],16))?></p> 
          <a class="more_btn" href="<?=g('base_url')?>ad/<?=$ad['ads_slug']?>" class="hvr-grow tc-image-effect-shine">Read More</a>
        </div>
      </div>
      
    <?php } ?>


    </div>
    <?php } ?>
  </div>
</div>
          </div>
        </div>
      </div>
    </div>
  </section>




<!--
    <section class="section-beauty">
      <div class="container">




      <?php if(empty($ads)){ ?>

        <h1 class="notfound">Ads not found in <?=ucfirst($catName)?></h1>
        
      <?php }else{ ?>

      <?php foreach ($ads as $key => $ad){ ?>


        <div class="row align-items-center justify-content-center" style="padding: 20px;">
          
           <div class="col-md-12 col-sm-12 col-12 col-lg-12 col-xl-12">
           
            <div class="card-beauty" style="padding-top: 15px;">
              <div class="row d-flex align-items-center justify-content-center">
                <div class="col-md-4 pt-4 pb-4 d-flex align-items-center">
                  <div class="card-beauty-img">
                    <img src="<?=get_image($ad['ads_image_path'],$ad['ads_image'])?>" alt="" class="img-card-resp">
                  </div>
                </div>

                <div class="col-md-5 pt-4 pb-4">
                  <div class="card-beauty-body">
                    <h3 class="card-beauty-body-head"><?=$ad['ads_title']?></h3>
                    <span class="card-beauty-body-para"><?=ucfirst($catName)?></span>
                    <br><br>
                    <?=html_entity_decode($ad['ads_description'])?>
                  </div>
                </div>

                  <div class="col-md-2 pt-3 pb-5 d-flex align-items-end custom-border">
                    <div class="card-beauty-info">
                      <a href="<?=g('base_url')?>ad/<?=$ad['ads_slug']?>" class="card-beauty-btn">More Info</a>
                    </div>
                  </div>
                </div>
              </div>
             
            </div>
          
        </div>
       
      <?php } ?>
      <?php } ?>


      </div>
    </section>
  -->

  </main>