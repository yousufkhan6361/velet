<!DOCTYPE html>
<html>
<head>
    <title>404 Error</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="keywords" content="" />
    <!-- Custom Theme files -->
    <link href="<?php echo config_item('base_url'); ?>assets/front_assets/css/error404.css" rel="stylesheet" type="text/css" media="all" />
    <!-- //Custom Theme files -->
    <!-- web font -->
    <link href='//fonts.googleapis.com/css?family=Open+Sans:400,300,600,700,800' rel='stylesheet' type='text/css'><!--web font-->
    <!-- //web font -->
</head>
<body>
<!-- main -->
<div class="agileits-main">
    <div class="agileinfo-row">
        <div class="w3top-nav">
            <!--<div class="w3top-nav-left">
                <h1><a href="index.html">My Error Page</a></h1>
            </div>-->
            <!--<div class="w3top-nav-right">
                <ul>
                    <li><a href="index.html" class="active">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>-->
            <div class="clear"></div>
        </div>
        <div class="w3layouts-errortext">
            <img src="<?php echo config_item('base_url'); ?>assets/front_assets/images/error404-2.png" alt=""/>
            <h2>Sorry! The page you were looking for could not be found </h2>
            <p class="w3lstext">You have been tricked into click on a link that can not be found. Please check the url or go to main page and see if you can locate what you are looking for </p>
            <p><a href="<?php echo config_item('base_url'); ?>" class="back_btn">Home</a> </p>
            <!--<div class="agile-search">
                <form action="#" method="post">
                    <input type="text" name="Search" placeholder="Enter your search term..." id="search" required="">
                    <input type="submit" value="Search">
                </form>
            </div>-->
        </div>
    </div>
</div>
<!-- //main -->
<!-- copyright -->
<!--<div class="copyright w3-agile">
    <p>© 2017 All rights reserved </p>
</div>-->
<!-- //copyright -->
</body>
</html>