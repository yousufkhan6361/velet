<?global $config;
//Prepare tools array Plugin
$my_tools = array(
    "jquery-ui" => array(
        "js" => array("jquery-ui-1.10.3.custom.min.js"),
    ),
    "bootstrap" => array(
        "css" => array("css/bootstrap.min.css"),
        "js" => array("js/bootstrap.min.js"),
    ),
    "select2" => array(
        "css" => array("select2.css"),
        "js" => array("select2.min.js","select2_custom.js"),
    ),
    "bootstrap-hover-dropdown" => array(
        "js" => array("bootstrap-hover-dropdown.min.js"),

    ),
    "jquery-slimscroll" => array(
        "js" => array("jquery.slimscroll.min.js"),

    ),
    "uniform" => array(
        "css" => array("css/uniform.default.css"),
        "js" => array("jquery.uniform.min.js"),
    ),
    "bootstrap-switch" => array(
        "css" => array("css/bootstrap-switch.min.css"),
        "js" => array("js/bootstrap-switch.min.js"),
    ),
    "bootstrap-colorpicker" => array(
        "css" => array("css/colorpicker.css"),
        "js" => array("js/bootstrap-colorpicker.js"),
    ),
    "bootstrap-daterangepicker" => array(
        "css" => array("daterangepicker-bs3.css"),
        "js" => array("moment.min.js","daterangepicker.js"),
    ),
    "fullcalendar" => array(
        "css" => array("fullcalendar.min.css"),
        "js" => array("fullcalendar.min.js"),
    ),
    "fullcalendar2" => array(
        "css" => array("fullcalendar/fullcalendar.css"),
        "js" => array("fullcalendar/fullcalendar.js","fullcalendar/form-calendar.js"),
    ),
    "jquery-easypiechart" => array(
        "js" => array("jquery.easypiechart.min.js"),
    ),
    "font-awesome" => array(
        "css" => array("css/font-awesome.min.css"),
    ),
    "simple-line-icons" => array(
        "css" => array("simple-line-icons.min.css"),
    ),
    /*"bootstrap-datepicker" => array(
        "css" => array("css/datepicker.css"),
        "js" => array("js/bootstrap-datepicker.js"),
    ),*/
    "bootstrap-datetimepicker" => array(
        "css" => array("css/datetimepicker.css"),
        "js" => array("js/bootstrap-datetimepicker.js"),
    ),
    /*"datatables" => array(
        "css" => array("plugins/bootstrap/dataTables.bootstrap.css"),
        "js" => array("media/js/jquery.dataTables.min.js","plugins/bootstrap/dataTables.bootstrap.js"),
    ),*/
    "datatables" => array(
        "css" => array("plugins/bootstrap/datatables.bootstrap.css"),
        "js" => array("datatables.min.js","plugins/bootstrap/datatables.bootstrap.js"),
    ),
    "bootbox"=> array(
        "js" => array("bootbox.min.js"),
    ),
    "ckeditor"=> array(
        "js" => array("ckeditor.js","config.js"),
    ),
    "bootstrap-toastr"=> array(
        "css" => array("toastr.min.css"),
        "js" => array("toastr.min.js"),
    ),
    "bootstrap-fileupload" => array(
        "js" => array("bootstrap-fileupload.js"),
        "css" => array("bootstrap-fileupload.css")
    ),
    "pace" => array(
        "js" => array("pace.min.js"),
        "css" => array("themes/pace-theme-barber-shop.css")
    ),
    "jstree" => array(
        "js" => array("dist/jstree.min.js"),
        "css" => array("dist/themes/default/style.min.css")
    ),
    "jquery-multi-select" => array(
        "js" => array("js/jquery.multi-select.js"),
        "css" => array("css/multi-select.css")
    ),
    "jquery-file-upload"=> array(
        "js" => array(
            "js/vendor/jquery.ui.widget.js",
            "js/vendor/tmpl.min.js",
            "js/vendor/load-image.min.js",
            "js/vendor/canvas-to-blob.min.js",
            //"blueimp-gallery/jquery.blueimp-gallery.min.js",
            "js/jquery.iframe-transport.js",
            "js/jquery.fileupload.js",
            "js/jquery.fileupload-process.js",
            "js/jquery.fileupload-image.js",
            "js/jquery.fileupload-audio.js",
            "js/jquery.fileupload-video.js",
            "js/jquery.fileupload-validate.js",
            "js/jquery.fileupload-ui.js",
        ),
        "css" => array(
            "blueimp-gallery/blueimp-gallery.min.css",
            "css/jquery.fileupload.css",
            //"css/jquery.fileupload-ui.css",
        ),
    ),
    "fancybox" => array(
        "css" => array("source/jquery.fancybox.css"),
        "js" => array("source/jquery.fancybox.js"),
    ),
    "counterup" => array(
        "js" => array("jquery.waypoints.min.js","jquery.counterup.min.js"),
    ),
    "bootstrap-datetimepicker1" => array(
      "css" => array("css/datetimepicker.css"),
      "js" => array("js/datetimepicker.js"),
    ),


);
?>
<!DOCTYPE html>

<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en" class="no-js">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title><?=$title?></title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="width=device-width, initial-scale=1" name="viewport"/>
    <meta content="" name="description"/>
    <meta content="Perks Global" name="author"/>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?=Links::img($logo[0]['logo_image_path'],$logo[0]['logo_favicon'])?>">

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <?
    foreach ($meta_data AS $meta_name => $meta_val)
        echo '<meta name="' . $meta_name . '" content="' . $meta_val . '">';
    ?>
    <script type="text/javascript">
        //For all JS Global Variable Initializtion
        var $js_config = <?=json_encode($config['js_config'])?>;
    </script>

    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css"/>
    <?
    //Additional files
    if(is_array($additional_tools) && count($additional_tools))
    {
        foreach($additional_tools AS $tool){
            //if(is_array($my_tools[$tool]['css']))
            if(isset($my_tools[$tool]['css']))
                foreach($my_tools[$tool]['css'] AS $script)
                {
                    if($script){
                        ?><link rel="stylesheet" href="<?=$config['plugins_root'] .$tool ."/". $script; ?>"/><?
                    }

                }
        }
    }
    ?>
    <?foreach($css_files AS $file){?>
        <link rel="stylesheet" href="<?=$config['admin_css_root'] . $file; ?>" type="text/css" />
    <?}?>

    <link rel="stylesheet" href="<?=$config['admin_css_root'];?>theme_light.css" type="text/css" id="skin_color">

    <!-- END THEME STYLES -->

    <? // Atleast load JQUERY in the header. ?>
    <script src="<?=$config['admin_js_root'];?>jquery.min.js"></script>
    <script> var base_url = '<?php echo g('admin_base_url');?>';</script>

</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="">
<div id="preloader" style="display:none;"><div id="load"><div>G</div><div>N</div><div>I</div><div>D</div><div>A</div><div>O</div><div>L</div></div></div>
<!-- BEGIN HEADER -->
<?=implode("", $modals );?>

<!-- Start HEADER -->
<header class="page-header">
    <nav class="navbar" role="navigation">
        <div class="container-fluid">
            <div class="havbar-header">
                <?
                if(array_filled($logo)){?>
                    <a href="<?=$config['base_url']?>admin">
                        <img src="<?=Links::img($logo[0]['logo_image_path'],$logo[0]['logo_image'])?>" alt="logo" class="main-tem-logo" style="position: absolute;margin-top: 6px;height: 47px;"/>
                    </a>
                <?}
                ?>
                <div class="topbar-actions">
                    <!-- BEGIN GROUP NOTIFICATION -->
                    <!--<div class="btn-group-notification btn-group" id="header_notification_bar">
                        <button type="button" class="btn md-skip dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <span class="badge">9</span>
                        </button>
                        <ul class="dropdown-menu-v2">
                            <li class="external">
                                <h3>
                                    <span class="bold">12 pending</span> notifications</h3>
                                <a href="#">view all</a>
                            </li>
                            <li>
                                <ul class="dropdown-menu-list scroller" style="height: 250px; padding: 0;" data-handle-color="#637283">
                                    <li>
                                        <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-success md-skip">
                                                            <i class="fa fa-plus"></i>
                                                        </span> New user registered. </span>
                                            <span class="time">just now</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:;">
                                                    <span class="details">
                                                        <span class="label label-sm label-icon label-danger md-skip">
                                                            <i class="fa fa-bolt"></i>
                                                        </span> Server #12 overloaded. </span>
                                            <span class="time">3 mins</span>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>-->
                    <!-- END GROUP NOTIFICATION -->
                    <!-- BEGIN USER PROFILE -->
                    <div class="btn-group-img btn-group">
                        <!--<button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img src="<?/*=g('admin_images_root')*/?>avatar1.jpg" alt="">
                        </button>-->
                        <button type="button" class="btn btn-sm dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <!--<img src="<?/*=g('admin_images_root')*/?>avatar1.jpg" alt="">-->
                            <span class="glyphicon glyphicon-align-justify" aria-hidden="true"></span>
                        </button>
                        <ul class="dropdown-menu-v2" role="menu">
                            <!--<li>
                                <a href="page_user_profile_1.html">
                                    <i class="icon-user"></i> My Profile
                                    <span class="badge badge-danger">1</span>
                                </a>
                            </li>
                            <li>
                                <a href="app_calendar.html">
                                    <i class="icon-calendar"></i> My Calendar </a>
                            </li>
                            <li>
                                <a href="app_inbox.html">
                                    <i class="icon-envelope-open"></i> My Inbox
                                    <span class="badge badge-danger"> 3 </span>
                                </a>
                            </li>
                            <li>
                                <a href="app_todo_2.html">
                                    <i class="icon-rocket"></i> My Tasks
                                    <span class="badge badge-success"> 7 </span>
                                </a>
                            </li>
                            <li class="divider"> </li>
                            <li>
                                <a href="page_user_lock_1.html">
                                    <i class="icon-lock"></i> Lock Screen </a>
                            </li>-->
                            <li>
                                <a href="<?=g('admin_base_url')?>logout">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </div>
                    <!-- END USER PROFILE -->
                </div>
            </div>
        </div>
    </nav>
</header>
<!-- END HEADER -->

<!-- BEGIN CONTAINER -->
<div class="main-container nopadding">

    <!-- BEGIN SIDEBAR -->
    <?$this->load->view("_layout/admin/left_menu");?>
    <!-- END SIDEBAR -->

    <!-- BEGIN CONTENT -->
    <div class="main-content">
        <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
        <div class="modal fade" id="portlet-config" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                        <h4 class="modal-title">Modal title</h4>
                    </div>
                    <div class="modal-body">
                        Widget settings form goes here
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn blue">Save changes</button>
                        <button type="button" class="btn default" data-dismiss="modal">Close</button>
                    </div>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
        <!-- END SAMPLE PORTLET CONFIGURATION MODAL FORM-->

        <div class="container" style="min-height: 845px;">
            <!-- BEGIN BREADCRUMBS -->
            <div class="row">
                <div class="col-sm-12">

                    <!-- start: STYLE SELECTOR BOX -->
                    <div id="style_selector" class="hidden-xs">
                        <div id="style_selector_container">
                            <div class="style-main-title">
                                Style Selector
                            </div>

                            <div class="box-title">
                                5 Predefined Color Schemes
                            </div>
                            <div class="images icons-color">
                                <a id="light" href="#"><img class="active" alt="" src="<?php echo g('admin_images_root');?>lightgrey.png"></a>
                                <a id="dark" href="#"><img alt="" src="<?php echo g('admin_images_root');?>darkgrey.png"></a>
                                <a id="black_and_white" href="#"><img alt="" src="<?php echo g('admin_images_root');?>blackandwhite.png"></a>
                                <a id="navy" href="#"><img alt="" src="<?php echo g('admin_images_root');?>navy.png"></a>
                                <a id="green" href="#"><img alt="" src="<?php echo g('admin_images_root');?>green.png"></a>
                            </div>

                            <div style="height:25px;line-height:25px; text-align: center">
                                <a class="clear_style" href="#">
                                    Clear Styles
                                </a>
                                <a class="save_style" href="#">
                                    Save Styles
                                </a>
                            </div>
                        </div>
                        <div class="style-toggle close"></div>
                    </div>
                    <!-- end: STYLE SELECTOR BOX -->

                    <ol class="breadcrumb">
                        <?if((isset($bread_crumbs) && (array_filled($bread_crumbs)))){
                            // return always index 0. 0 has multiple array
                            foreach($bread_crumbs AS $key=>$bdcm){
                                $i=0;
                                $count = count($bdcm);
                                foreach($bdcm AS $brdlk => $brdcrm){?>
                                    <li class="<?php echo ($i>0)?'active':''?>">
                                        <?php
                                        if(($i==0)){?>
                                            <i class="clip-home-3"></i>
                                            <a href="<?=$config['base_url'].'admin/'.$brdlk?>"><?=$brdcrm?></a>
                                        <?php }
                                        elseif($i==$count-1){
                                            echo $brdcrm;
                                        }
                                        else{?>

                                            <a href="<?=$config['base_url'].'admin/'.$brdlk?>"><?=$brdcrm?></a>
                                        <?php }?>
                                    </li>
                                <?$i++; }
                            } }?>
                    </ol>
                </div>
            </div>
            <!-- END BREADCRUMBS -->

            <!-- BEGIN DASHBOARD STATS -->
            <?=$content_block?>
        </div>
        <div class="clearfix">
        </div>
        <div class="clearfix">
        </div>
        <div class="clearfix">
        </div>
    </div>
    <!-- END CONTENT -->
    <!-- BEGIN QUICK SIDEBAR -->
    <a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
    <!-- END QUICK SIDEBAR -->
</div>



<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="footer clearfix">
    <div class="footer-items">

        <span class="go-top"><i class="clip-chevron-up"></i></span>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<!-- BEGIN CORE PLUGINS -->
<!--[if lt IE 9]>
<script src="<?=$config['plugins_root']?>respond.min.js"></script>
<script src="<?=$config['plugins_root']?>excanvas.min.js"></script>
<![endif]-->

<!-- END PAGE LEVEL SCRIPTS -->
<?
foreach($js_files AS $file){
    ?><script src="<?=$config['admin_js_root'] . $file; ?>"></script><?
}
if(array_filled($additional_tools))
{
    $tool_activators = "";
    foreach($additional_tools AS $tool){
        //if(is_array($my_tools[$tool]['js']))
        if(isset($my_tools[$tool]['js']))
            foreach($my_tools[$tool]['js'] AS $script)
            {
                $tool_activators .= "var tool_".str_replace("-","_",$tool)." = true;";
                ?>
                <script src="<?=$config['plugins_root'] .$tool."/". $script; ?>"></script>
            <?
            }
    }
}

?>
<script>
    <?=$tool_activators?>
    $(document).ready(function(){

        <?if((isset($_GET['msgtype'])) && ($_GET['msgtype']) && ($_GET['msg'])){?>
        AdminToastr.<?=$_GET['msgtype']?>("<?=$_GET['msg']?>", "<?=$_GET['msgtype']?>" , {positionClass:"toast-top-full-width"} );
        <?}?>

        //function to activate the Go-Top button
        $('.go-top').on('click', function(e) {
            $("html, body").animate({
                scrollTop: 0
            }, "slow");
            e.preventDefault();
        });

    });

    //Set of functions for Style Selector
    var runStyleSelector = function() {
        $('.style-toggle').on('click', function() {
            if($(this).hasClass('open')) {
                $(this).removeClass('open').addClass('close');
                $('#style_selector_container').hide();
            } else {
                $(this).removeClass('close').addClass('open');
                $('#style_selector_container').show();
            }
        });
        setColorScheme();
    };

    var setColorScheme = function() {
        $('.icons-color a').on('click', function() {
            $('.icons-color img').each(function() {
                $(this).removeClass('active');
            });
            $(this).find('img').addClass('active');
            if($('#skin_color').attr("rel") == "stylesheet/less") {
                $('#skin_color').next('style').remove();
                $('#skin_color').attr("rel", "stylesheet");

            }
            $('#skin_color').attr("href", "<?php echo g('admin_css_root');?>theme_" + $(this).attr('id') + ".css");

        });
    };
    //function to clear user settings
    var runClearSetting = function() {
        $('.clear_style').on('click', function() {
            $.removeCookie("clip-setting");
            $('body').removeClass("layout-boxed header-default footer-fixed");
            $('body')[0].className = $('body')[0].className.replace(/\bbg_style_.*?\b/g, '');
            if($('#skin_color').attr("rel") == "stylesheet/less") {
                $('#skin_color').next('style').remove();
                $('#skin_color').attr("rel", "stylesheet");

            }

            $('.icons-color img').first().trigger('click');
            runDefaultSetting();
        });
    };

    //function to restore user settings
    var runDefaultSetting = function() {
        $('#style_selector select[name="layout"]').val('default');
        $('#style_selector select[name="header"]').val('fixed');
        $('#style_selector select[name="footer"]').val('default');
        $('     .boxed-patterns img').removeClass('active');
        $('.color-base').val('#FFFFFF').next('.dropdown').find('i').css('background-color', '#FFFFFF');
        $('.color-text').val('#555555').next('.dropdown').find('i').css('background-color', '#555555');
        $('.color-badge').val('#007AFF').next('.dropdown').find('i').css('background-color', '#007AFF');
    };

    //function to save user settings
    var runSaveSetting = function() {
        $('.save_style').on('click', function() {
            var clipSetting = new Object;
            if($('body').hasClass('rtl')) {
                clipSetting.rtl = true;
            } else {
                clipSetting.rtl = false;
            }
            if($('body').hasClass('layout-boxed')) {
                clipSetting.layoutBoxed = true;
                $("body[class]").filter(function() {
                    var classNames = this.className.split(/\s+/);
                    for(var i = 0; i < classNames.length; ++i) {
                        if(classNames[i].substr(0, 9) === "bg_style_") {
                            clipSetting.bgStyle = classNames[i];
                        }
                    }

                });
            } else {
                clipSetting.layoutBoxed = false;
            }
            if($('body').hasClass('header-default')) {
                clipSetting.headerDefault = true;
            } else {
                clipSetting.headerDefault = false;
            }
            if($('body').hasClass('footer-fixed')) {
                clipSetting.footerDefault = false;
            } else {
                clipSetting.footerDefault = true;
            }
            if($('#skin_color').attr('rel') == 'stylesheet') {
                clipSetting.useLess = false;
            } else if($('#skin_color').attr('rel') == 'stylesheet/less') {
                clipSetting.useLess = true;
                clipSetting.baseColor = $('.color-base').val();
                clipSetting.textColor = $('.color-text').val();
                clipSetting.badgeColor = $('.color-badge').val();
            }
            clipSetting.skinClass = $('#skin_color').attr('href');

            $.cookie("clip-setting", JSON.stringify(clipSetting));

            var el = $('#style_selector_container');
            el.block({
                overlayCSS: {
                    backgroundColor: '#fff'
                },
                message: '<img src="<?php echo g('admin_images_root');?>loading2.gif" /> Just a moment...',
                css: {
                    border: 'none',
                    color: '#333',
                    background: 'none'
                }
            });
            window.setTimeout(function() {
                el.unblock();
            }, 1000);
        });
    };

    //function to load user settings
    var runCustomSetting = function() {
        if($.cookie("clip-setting")) {
            var loadSetting = jQuery.parseJSON($.cookie("clip-setting"));
            if(loadSetting.layoutBoxed) {

                $('body').addClass('layout-boxed');
                $('#style_selector select[name="layout"]').find('option[value="boxed"]').attr('selected', 'true');
            }
            if(loadSetting.headerDefault) {
                $('body').addClass('header-default');
                $('#style_selector select[name="header"]').find('option[value="default"]').attr('selected', 'true');
            }
            if(!loadSetting.footerDefault) {
                $('body').addClass('footer-fixed');
                $('#style_selector select[name="footer"]').find('option[value="fixed"]').attr('selected', 'true');
            }
            if($('#style_selector').length) {
                if(loadSetting.useLess) {

                    $('.color-base').val(loadSetting.baseColor).next('.dropdown').find('i').css('background-color', loadSetting.baseColor);
                    $('.color-text').val(loadSetting.textColor).next('.dropdown').find('i').css('background-color', loadSetting.textColor);
                    $('.color-badge').val(loadSetting.badgeColor).next('.dropdown').find('i').css('background-color', loadSetting.badgeColor);
                    runActivateLess();
                } else {
                    $('.color-base').val('#FFFFFF').next('.dropdown').find('i').css('background-color', '#FFFFFF');
                    $('.color-text').val('#555555').next('.dropdown').find('i').css('background-color', '#555555');
                    $('.color-badge').val('#007AFF').next('.dropdown').find('i').css('background-color', '#007AFF');
                    $('#skin_color').attr('href', loadSetting.skinClass);
                }
            }
            $('body').addClass(loadSetting.bgStyle);
        } else {
            runDefaultSetting();
        }
    };
    runCustomSetting();



    runStyleSelector();

    runClearSetting();
    runSaveSetting();

    <?php
    if($this->router->fetch_class()=='home'){?>
        Calendar.init();
    <?php }
    ?>

</script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>