<link href="<?=g('base_url')?>assets/front_assets/css/font-awesome.css" rel="stylesheet" type="text/css"> 
  
<style type="text/css">
  .news{
    font-size: 54px;
    font-family: 'Poppins';
    background: #1562ae;
    padding: 15px;
    color: white;
    border-radius: 18px;
  }
 


.ContactForm
{
  /*background-color: #ff99bb;*/
  display: inline-block;
  width: 100%;
  /*padding: 50px 0;*/
}

.ContactForm h2
{
  font-size: 31px;
  font-weight: 400;
  font-family: 'Abel',Helvetica,Arial,Lucida,sans-serif;
  text-align: center;
  padding: 30px;
}


.ContactForm h4 a
{
  text-align: center;
  color: #c37cc6;
  display: block;
  padding: 20px 10px 5px 1px;
  text-decoration: none;
  font-size: 20px;
  font-weight: 500;
}

.ContactForm p
{
  color:#7d7a7a;;
  display: block;
  font-size: 17px;
  font-weight: 500;
  text-align: center;
  padding: 5px 5px;
}

.blog-txt
{
  background-color: #fff;
    padding: 5px 15px;
    box-shadow: 10px 10px 18px 0px rgb(0 0 0 / 30%);
   height: 150px;

}

.bloger_ul
{
  text-align: center;
}

.bloger_ul li
{
  font-size: 12px;
  font-style: italic;
  color: #7d7a7a;
  display: inline-block;
  position: relative;
}

.bloger_ul li:nth-child(1)::after
{
  content: '';
    position: absolute;
    height: 13px;
    width: 1px;
    background-color:#7d7a7a;;
    right: -7px;
    top: 3px;
}

.bloger_ul li:nth-child(2)::after
{
  content: '';
    position: absolute;
    height: 13px;
    width: 1px;
    background-color:#7d7a7a;;
    right: -7px;
    top: 3px;
}

.blog_img{
  display: inline-block;
  width: 100%;
  position: relative;
}
.bloger_ul li a
{
  font-size: 12px;
  font-style: italic;
  color:#7d7a7a;;
}

.sochal_ul
{
  text-align: center;
}

.sochal_ul a .fa
{
  color: #fff;
  padding: 10px;
  background: #1176b7;
  width: 41px;
  
}

.sochal_ul a .fa:hover{
  background: #000;color: #FFF;
}

.blog_img:hover img{
  background: #000;
  position: absolute;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  content: '';
}

.hover_sec {
    position: absolute;
    top: 0;
    left: 0;
    bottom: 0;
    right: 0;
    display: flex;
    align-items: center;
    justify-content: center;
}


.overlay_img {
  position: relative;
  width: 100%;
}

.image {
  opacity: 1;
  display: block;
  width: 100%;
  height: auto;
  transition: .5s ease;
  backface-visibility: hidden;
}

.middle {
  transition: .5s ease;
  opacity: 0;
  position: absolute;
  top: 0;
  left: 8px;
  transform: translate(0%, 0%);
  -ms-transform: translate(-50%, -50%);
  text-align: center;
  bottom: 0;
  height: 100%;
  right: 0;
}

.overlay_img:hover .image {
  opacity: 0.3;
}

.overlay_img:hover .middle {
  opacity: 1;
}

.text {
  background-color:transparent;
  color: white;
  font-size: 16px;
  padding: 16px 32px;
}

.text .fa{
  font-size: 25px;
  position: absolute;
  top: 105px;
  color: #000;
}

.save{
  position: absolute;
  top: 10px;
  left: 10px;
  background: #000;
  padding: 4px 12px;
  font-size: 13px;
  border-radius: 5px;
}
  </style>

<section class="section-alexbanner">
      <div class="container">
        <h1>News</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb align-items-center justify-content-center">
           <!--  <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item active" aria-current="page"><a
              href="#" >News</a></li> -->
          </ol>
        </nav>
      </div>
    </section>
  <!-- news bannersec end-->

  <!-- sec news start -->
  <section class="ContactForm">
  <div class="container">
    <h2>LATEST NEWS</h2>
    <div class="row">   

<?php foreach ($newss as $key => $news){ 

$originalDate = $news['news_date'];
$newDate = date("M d, Y", strtotime($originalDate));

?>

<?php if($key%3==0){ ?>
<div class="clearfix"></div>
<?php } ?>

      <div class="col-xs-12 col-sm-4 col-md-4" style="padding-bottom: 50px;">
        <a href="<?=g('base_url')?>news/<?=$news['news_slug']?>">
          <div class="overlay_img">
          
            <img src="<?=get_image($news['news_image_path'],$news['news_image'])?>" alt="Avatar" class="image" style="width:360px; height: 225px;object-fit: fill;
    border: 1px solid #e1e1e1;">
          

          <div class="middle">
          <!-- <div class="text">
            <span class="save">Save</span>
            <a href=""><i class="fa fa-heart-o" aria-hidden="true"></i></a>
          </div> -->
          </div>
          </div>
          </a>

          <div class="blog-txt">
          <h4><a href="<?=g('base_url')?>news/<?=$news['news_slug']?>"><?=$news['news_title']?></a></h4>
          <ul class="list-inline bloger_ul">
            <li class="list-inline-item"><a href="">by <?=$news['news_auhtor']?></a></li>
            <li class="list-inline-item"><?=$newDate?></li>
           <!--  <li class="list-inline-item"><a href="">Members Blog</a></li> -->
          </ul>
          
          <!--<button class="btn btn-primary">Learn More</button>-->
          
          <? //html_entity_decode(word_limiter($news['news_description'],30))?>

          <ul class="list-inline sochal_ul">
          <?php if($news['news_facebook'] != null){ ?>

            <!--<li class="list-inline-item">-->
            <!--  <a target="_blank" href="<?=$news['news_facebook']?>">-->
            <!--    <i class="fa fa-facebook" aria-hidden="true"></i>-->
            <!--  </a>-->
            <!--</li>-->

          <?php } ?>

          <?php if($news['news_twitter'] != null){ ?>

            <!--<li class="list-inline-item">-->
            <!--  <a target="_blank" href="<?=$news['news_twitter']?>"><i class="fa fa-twitter" aria-hidden="true"></i></a>-->
            <!--</li>-->

          <?php } ?>

          <?php if($news['news_instagram'] != null){ ?>

            <!--<li class="list-inline-item">-->
            <!--  <a target="_blank" href="<?=$news['news_instagram']?>"><i class="fa fa-instagram" aria-hidden="true"></i></a>-->
            <!--</li>-->

          <?php } ?>

          <?php if($news['news_youtube'] != null){ ?>

            <!--<li class="list-inline-item">-->
            <!--  <a target="_blank" href="<?=$news['news_youtube']?>"><i class="fa fa-linkedin" aria-hidden="true"></i></a>-->
            <!--</li>-->

          <?php } ?>
          
          </ul>
          </div>
      </div>

<?php } ?>

      
    </div>
  </div>  
</section>

  <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->