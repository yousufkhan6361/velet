<!-- Footer Section Starts Here -->
<footer id="footer">
    <div class="container">
        <div class="row">
            <div class="main-fot">
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="call_area">
                        <div class="media">
                            <div class="media-left"><img alt="Phone" class="media-object" src="<?php echo g('images_root');?>phone-icon.png"></div>
                            <div class="media-body">
                                <h4 class="media-heading">Call Now:</h4>
                                <a href="javascript:void(0)"><?php echo g('db.admin.company_phone_1');?></a> </div>
                        </div>
                    </div>
                    <div class="site_link">
                        <h3>Site Links</h3>
                        <ul>
                            <li> <a href="javascript:void(0)">Lorem Ipsem</a> </li>
                            <li> <a href="javascript:void(0)">Dolor Sit</a> </li>
                            <li> <a href="javascript:void(0)">Amed is</a> </li>
                            <li> <a href="javascript:void(0)">Consecuter</a> </li>
                            <li> <a href="javascript:void(0)">Dummy Text</a> </li>
                            <li> <a href="javascript:void(0)">Available</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="follow_area">
                        <h4>Follow Us:</h4>
                        <ul>
                            <li> <a href="<?php echo g('db.admin.facebook');?>" target="_blank"><i aria-hidden="true" class="fa fa-facebook"></i></a> </li>
                            <li> <a href="<?php echo g('db.admin.instagram');?>" target="_blank"><i aria-hidden="true" class="fa fa-instagram"></i></a> </li>
                            <li> <a href="<?php echo g('db.admin.twitter');?>" target="_blank"><i aria-hidden="true" class="fa fa-twitter"></i></a> </li>
                        </ul>
                    </div>
                    <div class="site_link">
                        <h3>Usefull Links</h3>
                        <ul>
                            <li> <a href="javascript:void(0)">Lorem Ipsem</a> </li>
                            <li> <a href="javascript:void(0)">Dolor Sit</a> </li>
                            <li> <a href="javascript:void(0)">Amed is</a> </li>
                            <li> <a href="javascript:void(0)">Consecuter</a> </li>
                            <li> <a href="javascript:void(0)">Dummy Text</a> </li>
                            <li> <a href="javascript:void(0)">Available</a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="request-area">
                        <h4>Request A Qoute</h4>
                        <form action="<?php echo g('base_url');?>contact-us/store" method="post" id="contact-form">
                            <div class="col-md-6">
                                <input name="inquiry[inquiry_fullname]" placeholder="Name" type="text" >
                            </div>
                            <div class="col-md-6">
                                <input name="inquiry[inquiry_email]" placeholder="Email" type="text">
                            </div>
                            <div class="col-md-12">
                                <select name="inquiry[inquiry_inche]" id="">
                                   <option value="">Select Inches</option>
                                    <option value="8 x 10">8 x 10</option>
                                    <option value="8 x 12">8 x 12</option>
                                    <option value="10 x 12">10 x 12</option>
                                    <option value="10 x 16">10 x 16</option>
                                    <option value="11 x 14">11 x 14</option>
                                    <option value="11 x 17">11 x 17</option>
                                    <option value="12 x 12">12 x 12</option>
                                    <option value="12 x 16">12 x 16</option>
                                    <option value="12 x 18">12 x 18</option>
                                    <option value="12 x 20">12 x 20</option>
                                    <option value="16 x 16">16 x 16</option>
                                    <option value="16 x 20">16 x 20</option>
                                    <option value="16 x 24">16 x 24</option>
                                    <option value="18 x 18">18 x 18</option>
                                    <option value="18 x 24">18 x 24</option>
                                    <option value="20 x 20">20 x 20</option>
                                    <option value="20 x 24">20 x 24</option>
                                    <option value="20 x 30">20 x 30</option>
                                    <option value="24 x 24">24 x 24</option>
                                    <option value="24 x 30">24 x 30</option>
                                    <option value="24 x 36">24 x 36</option>
                                    <option value="30 x 36">30 x 36</option>
                                    <option value="30 x 40">30 x 40</option>
                                    <option value="30 x 45">30 x 45</option>
                                    <option value="36 x 40">36 x 40</option>
                                    <option value="36 x 48">36 x 48</option>
                                    <option value="38 x 57">38 x 57</option>
                                </select>
                            </div>
                            <div class="clearfix"></div>
                            <div class="col-md-12">
                                <textarea cols="30" id="" name="inquiry[inquiry_comments]" placeholder="Message" rows="10"></textarea>
                            </div>
                            <div class="col-md-12">
                                <?php $this->load->view('widgets/google_captcha');?>
                                <br/>
                            </div>
                            <div class="form-btn"> <a href="javascript:void(0)" class="btn-send">Submit Now</a> </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-md-6 no-padd">
            <div class="copy-left pull-left">
                <p><?php echo str_replace(array('{YEAR}'), array(date('Y')), g('db.admin.copyright'));?></p>
            </div>
        </div>
        <div class="col-md-6 no-padd">
            <div class="copy-right pull-right"> <a href="<?php echo g('base_url');?>terms-and-conditions">Terms & Conditions</a> <span>|</span> <a href="<?php echo g('base_url');?>privacy-policy">Privacy Policy</a> </div>
        </div>
    </div>
</footer>
<!--Footer Content End-->

<!-- Search box start -->
<div id="search">
    <button class="close" type="button">×</button>
    <form>
        <input placeholder="SEARCH" type="search" value="">
    </form>
</div>
<!-- Search box end -->