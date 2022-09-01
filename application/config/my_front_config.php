<?
//Get already set config variables from other files.
$config = $this->config;

//Set your own Configurations...
$config['base_url'];
$config['base_url_portal'] = $config['base_url'] . "customer-portal/";
$config['base_url_dashboard'] = $config['base_url'] . "dashboard/";
$config['assets_root'] = $config['base_url'] . "assets/front_assets/";
$config['css_root'] = $config['assets_root'] . "css/";
$config['js_root'] = $config['assets_root'] . "js/";
$config['images_root'] = $config['assets_root'] . "images/";
$config['slider_root'] = $config['images_root'] . "slider/";
$config['font_root'] = $config['assets_root'] . "font/";
// Prepare JSCONFIg
$config['js_config'] = $config;


//Upload Roots
$config['upload_img_root'] = "assets/images/";
$config['upload_img_root_new'] = "assets/uploads/";
$config['upload_cat_root'] = $config['upload_img_root']."categories/";
$config['upload_acc_root'] = $config['upload_img_root']."accessories/";
$config['upload_is_root'] = $config['upload_img_root']."industry_solutions/";
$config['upload_prd_root'] = $config['upload_img_root_new']."product/";
$config['upload_os_root'] = $config['upload_img_root']."os/";
$config['upload_download_root'] = $config['upload_img_root']."download/";

/** product validation array */
$config['product_validation_array'] = array('product_name','product_average_price','product_current_discount','product_summary',
										'product_description','product_features','product_logo_image','product_display_image');

/*
 * MY CUSTOM FUNCTIONS
 *
 * **/

// constant veriable
define('PACKAGE_ERROR_MSG','Please select your package.');
define('CATEGORY_ERROR_MSG','Please select atleast one category.');
define('PARENT_CATEGORY_ERROR_MSG','Please set primary category.');

?>