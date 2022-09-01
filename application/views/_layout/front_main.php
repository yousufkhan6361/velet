<? global $config;
// Define plugins for page
$my_tools = array(
    "datetime-picker" => array(
        "css" => array("css/jquery.datetimepicker.css"),
        "js" => array("js/jquery.datetimepicker.js"),
    ),
    "datatables" => array(
        "css" => array("datatables.min.css"),
        "js" => array("datatables.min.js"),
    ),
    "select2" => array(
        "css" => array("select2.css"),
        "js" => array("select2.js","select2_custom.js"),
    ),
    "fb" => array(
        "css" => array("style.css"),
        "js" => array("jquery.fancybox.min.js"),
    ),
    "fancybox" => array(
        "css" => array("jquery.fancybox.min.css"),
        "js" => array("jquery.fancybox.min.js"),
    ),
    "owl-carousel" => array(
        "css" => array("owl.carousel.css","owl.theme.css"),
        "js" => array("owl.carousel.js"),
    ),
    "slick" => array(
        "css" => array("slick.css","slick-theme.css"),
        "js" => array("slick.js"),
    ),
);

?>

<!DOCTYPE html>
<html class="no-js" lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">

    
    <?php
/*        $class = $this->router->fetch_class();
    */?><!--
    <?php
/*        if ($class == 'home') {
    */?>
        <title><?/*= $title */?></title>
    <?php
/*        }
        else{
    */?>
        <title><?/*= ucfirst(humanize($class))." | ".$title */?></title>
    --><?php
/*        }
    */?>

    <title>Ireland Business Directory | The Northern Ireland Connection</title>
    <meta name="description" content="List your Business on The Northern Ireland connection directory and get customers for your Business">
    <meta name="author" content="">

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/png" href="<?=Links::img($layout_data['logo']['logo_image_path'],$layout_data['logo']['logo_favicon'])?>">

    <?
    foreach ($meta_data AS $meta_name => $meta_val) {
        ?>
        <meta name="<?= $meta_name ?>" content="<?= $meta_val ?>"> 
    <? } ?>

    <!-- Google Fonts -->
    <!--<link href="<?php /*echo l('assets/front_assets/fonts/font.css')*/?>" rel="stylesheet">-->

    <!-- Loading css file -->
    <? foreach ($css_files AS $css) { ?>
        <link href="<?= g('css_root') . $css ?>" rel="stylesheet" type="text/css"/>
    <?
    }
    // Load js file
    if (is_array($js_files_init)) {
        foreach ($js_files_init as $js) { ?>
            <script src="<?= g('js_root') . $js ?>"></script>
        <?
        }
    }
    // Load additional files css
    if (is_array($additional_tools) && count($additional_tools)) {
        foreach ($additional_tools AS $tool) {
            if (is_array($my_tools[$tool]['css']))
                foreach ($my_tools[$tool]['css'] AS $script) {
                    if ($script) {
                        ?>
                        <link rel="stylesheet" href="<?= g('plugins_root') . $tool . "/" . $script; ?>"/><?
                    }

                }
        }
    }
    // Load additional files js
    if (array_filled($additional_tools)) {
        foreach ($additional_tools AS $tool) {
            if (is_array($my_tools[$tool]['js']))
                foreach ($my_tools[$tool]['js'] AS $script) {
                    $tool_activators .= "toolset.tool_" . str_replace("-", "_", $tool) . " = true;";
                    ?>
                    <script src="<?= g('plugins_root') . $tool . "/" . $script; ?>"></script>
                <?
                }
        }
    }
    ?>

    <script type="text/javascript"> var base_url = "<?php  echo base_url(); ?>";</script>

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->

    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

    <!--[if lt IE 9]>

    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>

    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>

    <![endif]-->

<!-- fonts -->

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/prismjs@1.23.0/themes/prism.css" />

<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

</head>

<body>

<div id="preloader" style="display:none;">  
    <div class="loading">
        <!--<span>Loading...</span>-->
    </div>
</div>

<!-- PRE LOADER start-->
<div id="st-preloader">
    <div id="pre-status">
        <div class="preload-placeholder"></div>
    </div>
</div>
<!-- PRE LOADER end-->

<!-- PRE LOADER start-->
<!-- <div id="st-preloader">
    <div id="pre-status">
        <div class="preload-placeholder"></div>
    </div>
</div> -->
<!-- PRE LOADER end-->

<!-- Wrapper Start -->
<?php if($this->uri->segment(2) != "signup" && $this->uri->segment(2) != "login"){ ?>
    <?$this->load->view("_layout/header");
}

// Page content Start
echo $content_block;
// Page content End
//$this->load->view("_layout/footer");
// Search
// $this->load->view("_layout/search");
// Wrapper End

// Load modal

// Load js files
foreach ($js_files as $js) { ?>
    <script src="<?= g('js_root') . $js ?>"></script>
<?
}
?>


<!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.3/jquery.easing.min.js"></script> -->

  <!-- <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>

 <script >
    $(document).ready(function(){
    $(".dropdown").hover(            
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideDown("200");
            $(this).toggleClass('open');        
        },
        function() {
            $('.dropdown-menu', this).not('.in .dropdown-menu').stop(true,true).slideUp("200");
            $(this).toggleClass('open');       
        }
    );
});
  </script>
   <script>
  AOS.init();
</script> -->

 </body>
 
</html>