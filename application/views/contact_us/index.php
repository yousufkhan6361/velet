<style type="text/css">
  .btn-send {
    display: inline-block;
    font-weight: 400;
    color: #212529;
    text-align: center;
    vertical-align: middle;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    user-select: none;
    background-color: transparent;
    border: 1px solid transparent;
    padding: .375rem .75rem;
    font-size: 1rem;
    line-height: 1.5;
    border-radius: .25rem;
    transition: all 0.2s ease-in-out;
    color: #fff;
    height: 59px;
    width: 200px;
    /* background-color: #fd6b1c; */
    font-family: 'Roboto', sans-serif;
    font-weight: 400;
    font-size: 18px;
    position: relative;
    margin-top: 20px;
    background-image: linear-gradient( 
90deg
 ,#04a4ce, #175caa);
}
.navbar {
    position: relative;
    min-height: 50px;
    border: 1px solid transparent;
    padding: 0px 0 10px 0px;
}
</style>
<section class="section-alexbanner">
      <div class="container">
        <h1>Contact</h1>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb align-items-center justify-content-center">
            <!--<li class="breadcrumb-item"><a href="#">Home</a></li>-->
            <!--<li class="breadcrumb-item active" aria-current="page"><a-->
            <!--  href="#" >Contact</a></li>-->
          </ol>
        </nav>
      </div>
    </section>
  <!-- news bannersec end-->
  <section class="section-contact">
          <div class="container">
            <div class="row flex-Row">
              <div class="col-md-12 col-lg-12 col-sm-12 col-12">
                <h1>Contact</h1>
              </div>
            </div>
            <div class="row flex-Row no-gutters">
              <div class="col-md-12 col-lg-4 col-sm-12 col-xs-12 col-12 col-lg-4">
                  <div class="contact-details">
                    <h5>Contact Details</h5>
                    <ul class="ul-location">

                      <li class="li-location li-location-img">4 Glenview close</li>
                      <li class="li-location">Lisburn</li>
                      <li class="li-location">BT28 3HW</li>
                      <li class="li-location">Co. Antrim</li>
                      <li class="li-location">N. Ireland</li>
                    </ul>

                    <ul class="ul-phone">
                      <li class="li-phone li-phone-img">For Your Inquiry</li>
                      <li class="li-phone">07956619660</li>
                    </ul>


                    <ul class="ul-globe">
                      <li class="li-globe li-globe-img">The Office Hours</li>
                      <li class="li-globe">Monday 9-5</li>
                      <li class="li-globe">Tuesday 9-5</li>
                      <li class="li-globe">Wednesday 9-5</li>
                      <li class="li-globe">Thursday 9-5</li>
                      <li class="li-globe">Friday 9-5</li>
                      <li class="li-globe">Saturday closed</li>
                      <li class="li-globe">Sunday closed</li>
                    </ul>

                    <ul class="ul-message">
                      <li class="li-message li-message-img">Send Us Email</li>
                      <li class="li-message">info@thenorthernirelandconnection.com</li>
                    </ul>
                  </div>
                </div>
                <div class="col-md-12 col-lg-8 col-sm-12 col-xs-12 col-12">
                  <div class="contact-bg">

<form class="contact-form" id="contact-form" action="<?=g('base_url')?>contact-us/store" method="post">
  <h1>Send a Message</h1>
  <p>Your email address will not be published. Required fields are marked with *</p>
  <div class="form-row">
    <div class="col-sm-6 col-md-6 col-xs-12 col-12 col-lg-6">
      <input type="text" class="form-control contact-form" name="inquiry[inquiry_fullname]" placeholder="Name">
    </div>
    <div class="col-sm-6 col-md-6 col-xs-12 col-12 col-lg-6">
      <input type="email" class="form-control contact-form" name="inquiry[inquiry_email]" placeholder="Email">
    </div>
  </div>
  <div class="row">
   <div class="col-md-12 col-lg-12 col-sm-12 col-12 col-lg-12">
  <div class="form-group">
    <input type="text" class="form-control contact-form" name="inquiry[inquiry_subject]" id="" aria-describedby="emailHelp" placeholder="subject">
    </div>
     </div>
   </div>
   <div class="row">
     <div class="col-md-12 col-lg-12 col-sm-12 col-12 col-lg-12">
    <div class="form-group">
      <textarea class="form-control contact-form" name="inquiry[inquiry_comments]" id="exampleFormControlTextarea1" rows="3" placeholder="Your Message"></textarea>
      </div>
    </div>
  </div>
  <div class="row">
    
    <div class="col-md-12 col-lg-12 col-sm-12 col-12 col-lg-12">
      <div class="contact-btn-main">
      <button style="cursor: pointer;" type="button" class="btn-send" class=" button-contact">Send Message</button>
    </div>
    </div>
  </div>
</form>

                </div>
                </div>
              </div>
            </div>
          </div>

        </section>

<!-- <section class="contac-info CleaningServices attchedinhirit">
  <div class="container">
    <div class="row">
      <div class="col-md-12 col-md-12 col-xs-12">
        <div class="centerheading aos-init aos-animate" data-aos="fade-down">
          <span>Get in Touch with Us</span>
        </div>
      </div>
    </div>
    <div class="row mt-40">
      <div class="col-sm-6 col-md-8 col-xs-12">
        <div class="cont-fr">
          <form class="contact-form" id="contact-form" action="<?=g('base_url')?>contact-us/store" method="post">
            <div class="row ">
              <div class="col-sm-12 col-md-6 col-xs-12">
                <div class="form-input">
                  <input type="text" class="form-control" placeholder="Your Full name" name="inquiry[inquiry_fullname]">
                  <i class="fa fa-user"></i>
                </div>
              </div>
              <div class="col-sm-12 col-md-6 col-xs-12">
                <div class="form-input">
                  <input type="text" class="form-control" placeholder="Your Phone" name="inquiry[inquiry_phone]">
                  <i class="fa fa-user"></i>
                </div>
              </div>
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="form-input">
                  <input type="email" class="form-control" placeholder="Your Email Address" name="inquiry[inquiry_email]">
                  <i class="fa fa-phone"></i>
                </div>
              </div>
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="form-input">
                  <textarea type="text" rows="10" class="form-control" placeholder="Comment" name="inquiry[inquiry_comments]"></textarea>
                  <i class="fa fa-envelope"></i>
                </div>
              </div>
              <div class="col-md-12 ">
                <div class="form-group"> 
                    <?php $this->load->view('widgets/google_captcha');?>
                </div>
              </div>
              <div class="col-md-12 col-xs-12 col-sm-12">
                <div class="form-c-btn">
                  <button type="button" class="btn-send">Send Message</button>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
      <div class="col-sm-6 col-md-4 col-xs-12">
      <div class="">
        <div class="contactinfo-box">
          <i class="fa fa-map-marker"></i>
          <div class="ci-box">
            <p><strong>Mailing Address:</strong></p>
            <a href="javascript:void(0)"><?=g('db.admin.address')?></a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="">
        <div class="contactinfo-box">
          <i class="fa fa-phone"></i>
          <div class="ci-box">
            <p><strong>Phone:</strong></p>
            <a href="tel:<?=g('db.admin.phone')?>"><?=g('db.admin.phone')?></a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      <div class="">
        <div class="contactinfo-box">
          <i class="fa fa-envelope"></i>
          <div class="ci-box">
            <p><strong>Email At:</strong></p>
            <a href="mailto:<?=g('db.admin.email')?>"><?=g('db.admin.email')?></a>
          </div>
          <div class="clearfix"></div>
        </div>
      </div>
      </div>
    </div>
  </div>
</section> -->