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
<!-- END THEME STYLES -->

<? // Atleast load JQUERY in the header. ?>
<script src="<?=$config['admin_js_root'];?>jquery.min.js"></script>

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
<div class="container-fluid nopadding"">

    <div class="page-content page-content-popup">
        <!-- BEGIN BREADCRUMBS -->
        <div class="page-content-fixed-header">
            <ul class="page-breadcrumb">
                <!--<li>
                    <?/*
                    $page_title = (isset($page_title))?$page_title:'';
                    $page_title_min = (isset($page_title_min))?$page_title_min:'';
                    */?>
                    <?/*=humanize($page_title)*/?> <small><?/*=$page_title_min*/?></small>
                </li>-->
                <?if((isset($bread_crumbs) && (array_filled($bread_crumbs)))){
                foreach($bread_crumbs AS $bdcm){
                    foreach($bdcm AS $brdlk => $brdcrm){?>
                        <li>
                            <a href="<?=$config['base_url'].'admin/'.$brdlk?>"><?=$brdcrm?></a>
                        </li>
                    <?} } }?>
            </ul>
            <!-- END BREADCRUMBS -->
            <div class="content-header-menu">
                <!-- BEGIN DROPDOWN AJAX MENU -->
                <!--<div class="dropdown-ajax-menu btn-group">
                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                        <i class="fa fa-circle"></i>
                        <i class="fa fa-circle"></i>
                        <i class="fa fa-circle"></i>
                    </button>
                    <ul class="dropdown-menu-v2">
                        <li>
                            <a href="start.html">Application</a>
                        </li>
                        <li>
                            <a href="start.html">Reports</a>
                        </li>
                        <li>
                            <a href="start.html">Templates</a>
                        </li>
                        <li>
                            <a href="start.html">Settings</a>
                        </li>
                    </ul>
                </div>-->
                <!-- END DROPDOWN AJAX MENU -->

                <div class="page-toolbar">
                    <div id="nav-datetime" class="pull-right tooltips btn btn-fit-height grey-salt" data-placement="top" data-original-title="Change dashboard date range">
                        <i class="icon-calendar"></i>&nbsp;
                        <?=date("l, dS M, Y")?>
                        <i class="fa fa-angle-down"></i>
                    </div>
                </div>

                <!-- BEGIN MENU TOGGLER -->
                <button type="button" class="menu-toggler responsive-toggler" data-toggle="collapse" data-target=".navbar-collapse">
                            <span class="toggle-icon">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </span>
                </button>
                <!-- END MENU TOGGLER -->



            </div>
        </div>
        <!-- END BREADCRUMBS -->

        <!-- BEGIN SIDEBAR -->
        <div class="page-sidebar-wrapper">
            <?$this->load->view("_layout/admin/left_menu")?>
        </div>
        <!-- END SIDEBAR -->

        <!-- BEGIN CONTENT -->
        <div class="page-fixed-main-content">
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

            <!-- BEGIN DASHBOARD STATS -->
            <?=$content_block?>
            <div class="clearfix">
            </div>
            <div class="clearfix">
            </div>
            <div class="clearfix">
            </div>
        </div>
        <!-- END CONTENT -->


    </div>
	<!-- BEGIN QUICK SIDEBAR -->
	<a href="javascript:;" class="page-quick-sidebar-toggler"><i class="icon-close"></i></a>
	<!-- END QUICK SIDEBAR -->
</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">

	<div class="scroll-to-top">
		<i class="icon-arrow-up"></i>
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

		});
	</script>
<!-- END PAGE LEVEL PLUGINS -->
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>