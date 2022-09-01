<?php
$class = $this->router->fetch_class();
$method = $this->router->fetch_method();
?>
<!-- Header Start -->
<header id="head">
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="sidenav" id="mySidenav"> <a class="closebtn" href="javascript:void(0)" onclick="closeNav()">×</a> </div>
                <div class="mobilecontainer hidden-lg hidden-md"> <a href="<?php echo g('base_url');?>"><!--  <img src="images/logo.png" alt="" class="img-responsive pull-left"> --></a> <span class="pull-right" onclick="openNav()" style="font-size:30px;cursor:pointer">☰</span> </div>
                <div class="col-md-12 col-sm-12 col-xs-12 text-center">
                    <p><?php echo g('db.admin.quote');?></p>
                </div>
                <div class="col-md-2 col-sm-2 col-xs-8">
                    <!--<div class="top_logo"><img alt="" class="img-responsive" src="images/logo.png"></div>-->
                </div>
                <div class="col-md-7 col-sm-7 col-xs-12">
                    <div class="main_menu">

                        <ul class="navbar-set hidden-xs">
                            <li> <a href="<?php echo g('base_url');?>#head" class="<?php echo ($class=='home')?'active':'';?>">Home</a> </li>
                            <li> <a href="<?php echo g('base_url');?>#abt" class="goDown <?php echo ($class=='about_us')?'active':'';?>">About Us</a> </li>
                            <li class="dropdown"><a href="<?php echo g('base_url');?>media-type" class="dropdown-toggle <?php echo ($class=='media_type')?'active':'';?>"> Media Types <span class="caret"></span></a>
                                <?
                                $media = $this->layout_data['media'];
                                if(array_filled($media)){ ?>
                                    <ul class="dropdown-menu subMenuservice1">
                                        <?php
                                        foreach ($media as $key=>$value): ?>
                                            <li class="sub_menu"><a href="<?php echo g('base_url') . "media-type/" .$value['media_slug'];?>"> <?php echo $value['media_name'];?> <i class="fa fa-angle-right"></i></a></li>
                                        <?php endforeach;
                                        ?>
                                    </ul>
                                <?php }
                                ?>
                            </li>
                            <li> <a href="<?php echo g('base_url');?>#footer" class="goDown <?php echo ($class=='contact_us')?'active':'';?>">Contact Us</a> </li>

                            <!--<li class="dropdown"><a href="#" class="dropdown-toggle"> Methods Of Payment <span class="caret"></span></a>
                              <ul class="dropdown-menu subMenuservice1">
                                <li class="sub_menu"><a href="#">Visa</a></li>
                                <li class="sub_menu"><a href="#">Master Card</a></li>
                                <li class="sub_menu"><a href="#">Discover</a></li></ul></li>-->

                            <li> <a class="searchbr" href="#search"><i aria-hidden="true" class="fa fa-search"></i></a> </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-3 col-sm-3 col-xs-12">
                    <div class="shop_area">
                        <ul>
                            <li> <a href="javascript:void(0)"><i aria-hidden="true" class="fa fa-shopping-cart"></i></a> </li>
                            <li> <a href="javascript:void(0)"><i aria-hidden="true" class="fa fa-heart-o"></i></a> </li>

                            <?php
                            // Login
                            if($this->userid>0){?>
                                <li> <a href="<?php echo g('base_url');?>user/logout"><i aria-hidden="true" class=""></i>Logout</a></li>
                            <?php }
                            // Not login
                            else{?>
                                <li> <a href="<?php echo g('base_url');?>user"><i aria-hidden="true" class=""></i>Sign In</a></li>
                                <li> <a href="<?php echo g('base_url');?>user"><i aria-hidden="true" class=""></i>Sign Up</a></li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

</header>
<!-- Header End -->