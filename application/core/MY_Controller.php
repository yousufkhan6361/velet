<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

//Include Admin Wrapper. Break down things abit
include_once(APPPATH . "core/MY_Controller_Admin.php");

/**
 * Controller Wrapper Class.
 *
 * @package
 * @author
 * @version        1.0
 * @since        Version 1.0 2017
 * @comments    Please think of it as fun :P AND ENJOY
 */
class MY_Controller extends MY_Controller_Admin
{

    private static $instance;

    /**
     * Constructor
     */
    protected $layout;
    public $layout_data = array();
    public $view_pre;       

    public function __construct()
    {

        global $config;
        parent::__construct();
        // As soon as controller starts, configure timezone if set in tkd_config.php
        $this->set_time_zone();

        //Commmon HElpers
        $this->load->library('form_validation');
        $uid = $this->session_data['id'];

        // Load DB Config Parameters in GLOBAL $config['db']
        $config['db'] = $this->model_config->load_config();

        $this->layout_data['modals'] = array();

        if (isset($_REQUEST['msg_error']) && $_REQUEST['msg_error']) {
            $this->layout_data['msg']['error'] = $_REQUEST['msg_error'];
        }

        // FOR ADMIN
        if ($this->router->directory == "admin/") {
            $this->is_admin = true;

            /** Get Logo **/
            $this->layout_data['logo'] = $this->model_logo->find_all_active();

            $this->layout = "admin/admin_main";
            $this->view_pre = "admin/" . $this->router->class . "/";
            //IF Not logged in, redirect to login page.
            $this->login_redirect_check("logged_in", "is_admin");

            $title = $config['admin_title'] . " - Admin Panel";
            $meta_data = array("keywords" => "$title", "description" => "$title", "robots" => "noindex, follow");

            $this->layout_data['css_files'] = array(
                //"pages/tasks.css",
                "components.css",
                "plugins.css",
                "layout.css",
                //"themes/default.css",

                /*"theme_light.css",*/
                "main-responsive.css",
                "clip-style.css",
                "custom.css",
                "toastr.min.css",
            );
            $this->layout_data['js_files'] = array(
                "jquery.min.js",
                "jquery-migrate.min.js",
                "metronic.js",
                "layout.js",
                "quick-sidebar.js",
                "demo.js",
                "jquery.blockui.min.js",
                "jquery.cokie.min.js",
                "jquery.pulsate.min.js",
                "jquery.sparkline.min.js",
                "tkd_script.js",
                "toastr.min.js",
                "ui-alert-dialog-api.js",
            );

        }
        else {

            // check session
            $this->userid = 0;
            $this->user_type = 0;
            if (isset($this->session->userdata['userdata']))
            {
                $this->userid = intval((isset($this->session->userdata['userdata']['signup_id']))?$this->session->userdata['userdata']['signup_id'] : $this->session->userdata['userdata']['kid_id']);
                /*$this->cuser_model = (isset($this->session->userdata['userdata']['signup_id']))?'model_signup' : 'model_kid';
                $this->user_type = $this->session->userdata['userdata']['type'];*/
                $this->user_info = $this->session->userdata['userdata'];
            }


            //$this->userid = (intval($this->session->userdata['session_user_id']) > 0 ? intval($this->session->userdata['session_user_id']) : 0);
            // FRONT END>..
            // Autoloads specific to FRONT END;

            // FOR FRONTEND
            $this->is_admin = false;
            $this->view_pre = "";
            //$this->login_redirect_check("logged_in");

            // For dashboard
            if ($this->router->directory == "dashboard/"){
                $page_layout = "front_dashboard";
                $this->layout = $page_layout;
                $this->view_pre = "dashboard/" . $this->router->class . "/";
            }
            // For front end other pages
            else{
                $page_layout = "front_main";
                $this->layout = $page_layout;
                $this->view_pre = $this->router->class . "/";
            }


            $title = $config['title'];
            $meta_data = array(
                "keywords" => 'Roshlashes, Business Of The Month, Promotions, Packages, News, Categories of Businesses,Alix Anderson',
               // "description" => "$title",
                "viewport" => "width=device-width, initial-scale=1, maximum-scale=1",
                "google-site-verification" => "EBmHN36nzhcHbJnx1UNvq3BuJMluoiNUvSUtMwViV18",
            );


           /* $this->layout_data['js_files'] = array(
                "jquery.min.js",
                "bootstrap.min.js",
                "slick.js",
                "app.js",
                "query.fittext.js",
                "jquery.lettering.js",
                "jquery.textillate.js",
                "custom.js",
                "script.js",*/

            // For dashboard
            if ($this->router->directory == "dashboard/"){
                // Minify files check
                if(ENVIRONMENT=='development'){
                    $this->layout_data['css_files'] = array(
                        "bootstrap.min.css",
                        "custom.css",
                        "font-awesome.min.css",
                        "hover.css",
                        "lightbox.css",
                        "imagehover.css",
                        "bootstrap-slider.css",
                        "loader.css",   // for loader
                        "toastr.min.css",
                    );

                    $this->layout_data['js_files_init'] = array(
                        "jquery.min.js",
                    );
                    $this->layout_data['js_files'] = array(
                        "bootstrap.min.js",
                        "lightbox.js",
                        "jquery.lightroom.js",
                        "imagesloaded.pkgd.js",
                        "jquery.elevatezoom.js",
                        "bootstrap-slider.js",
                        "custom.js",
                        "toastr.min.js",
                        "notifications.js",
                        "tkd_script.js",
                        "spm-script.js",
                    );

                    $this->register_plugins(array('slick'));
                }
                // Use minify file in Demo and Production
                else{
                    $this->layout_data['css_files'] = array(
                        "bootstrap.min.css",
                        "custom.min.css",
                        "font-awesome.min.css",
                        "hover.min.css",
                        "lightbox.min.css",
                        "imagehover.min.css",
                        "bootstrap-slider.min.css",
                        "loader.min.css",   // for loader
                        "toastr.min.css",
                    );
                    $this->layout_data['js_files_init'] = array(
                        "jquery.min.js",
                    );
                    $this->layout_data['js_files'] = array(
                        "bootstrap.min.js",
                        "lightbox.min.js",
                        "jquery.lightroom.min.js",
                        "imagesloaded.pkgd.min.js",
                        "jquery.elevatezoom.min.js",
                        "bootstrap-slider.js",
                        "custom.min.js",
                        "toastr.min.js",
                        "notifications.min.js",
                        "tkd_script.min.js",
                        "spm-script.min.js",
                    );
                }
            }
            // For front end other pages
            else{
                $this->layout_data['css_files'] = array(
                    "bootstrap.min.css",
                    "vendors/simplebar.css",
                    "style.css",
                    "examples.css",
                    "vendors/@coreui/chartjs/css/coreui-chartjs.css",
                    // "all.css",
                    // "custom.css",
                    // "animate.css",
                    // "hover.css",
                    // "fb/style.css",
                    "toastr.css",
                    "loader.css",   // for loader
                    "account.css",
                    //"slick.css",
                    //"slick-theme.css",
                    //"account.css",   // for Profile
                );

                $this->layout_data['js_files_init'] = array(
                    "jquery.min.js",
                );
                $this->layout_data['js_files'] = array(
                    "bootstrap.min.js",
                    "vendors/@coreui/coreui/js/coreui.bundle.min.js",
                    "vendors/simplebar/js/simplebar.min.js",
                    "vendors/chart.js/js/chart.min.js",
                    "vendors/@coreui/chartjs/js/coreui-chartjs.js",
                    "vendors/@coreui/utils/js/coreui-utils.js",
                    "main.js",
                   // "slick.js",
                   // "slick.min.js",
                    // "all.js",
                    // "custom.js",
                    "jquery.mixitup.min.js",
                    "fb/jquery.fancybox.min.js",
                    "toastr.js",
                    "notifications.js",
                    "tkd_script.js",
                    "g-script.js",

                );

                //$this->register_plugins(array('fb'));
                // $this->register_plugins(array('fancybox','owl-carousel','slick'));
                // $this->register_plugins(array('owl'));
            }
            //get featured stock
            //$this->register_plugins(array("ui-touch-punch",));

            // $cms_page = $this->model_cms_page->get_page();

            //$this->layout_data['menu_categories'] = $this->model_category->get_menu_categories();
            //$fcat_params = array();
            //$fcat_params['limit'] = 5 ;
            //$this->layout_data['footer_categories'] = $this->model_category->find_all_list_active($fcat_params , "category_name", "category_slug");
            //$param['where'] = array('config_variable'=>CONTACTUS_EMAIL);

            /** Get social media **/
            $this->layout_data['config_info'] = $config['db'];

            /** Get Logo **/
            $this->layout_data['logo'] = $this->model_logo->find_one(
                array('where' => array('logo_status' => 1))
            );

            // $this->layout_data['footer_about'] = $this->model_cms_page->find_by_pk(7);
            // $this->layout_data['footer_social'] = $this->model_cms_page->find_by_pk(8);


            /** get featured categories **/
            // $this->layout_data['category'] = $this->model_category->find_all_active();

            // Get All currecny list
            $title = (isset($cms_page['meta_title']) && $cms_page['meta_title']) ? $cms_page['meta_title'] : $title;
            $meta_data['keywords'] = (isset($cms_page['meta_keyword']) && $cms_page['meta_keyword']) ? $cms_page['meta_keyword'] : $meta_data['keywords'];
            $meta_data['description'] = (isset($cms_page['meta_description']) && $cms_page['meta_description']) ? $cms_page['meta_description'] : $meta_data['description'];

            //$this->layout_data['cms_content'] = $this->model_cms_page->get_current_page_contents();

            // Save Agent
            $this->save_user_agent();


        }
        if (isset($menu))
            $this->layout_data['menu'] = $menu;
        $this->layout_data['title'] = $title;
        $this->layout_data['meta_data'] = $meta_data;
        $this->admin_path = $this->view_pre;
        $this->admin_current = $this->view_pre . $config['ci_method'] . "/";

        $this->layout_data['config'] = $config;


        $config['js_config']['my_id'] = $this->session_data['id'];
        $request = $this->router->class . '/' . $this->router->method;
        $this->layout_data['request_uri'] = $request;

        // Set class name and method
        $this->layout_data['class_name'] = $this->router->class;
        $this->layout_data['method_name'] = $this->router->method;

        // Get Media types
        // $this->layout_data['media'] = $this->model_media->get_all_media();

        //Setup Default title for template
    }

    // Only for Home page
    private function save_user_agent()
    {
        $method = $this->router->fetch_method();
        $class  = $this->router->fetch_class();
        if(($this->router->directory=='') && ($class=='home') && ($method=='index')){
            if ($this->agent->is_mobile())
            {
                $type = "mobile";
                $agent = $this->agent->mobile();
            }
            elseif ($this->agent->is_browser())
            {
                $type = "desktop";
                $agent = $this->agent->browser();
            }

            $data = array(
                'agt_name'=> $agent,
                'agt_type'=> $type,
                'agt_status'=>STATUS_ACTIVE
            );
            $this->model_agent->set_attributes($data);
            $this->model_agent->save();
        }

    }


    public function get_site_information($config_info)
    {
        $config_value = array();
        if (count($config_info) > 0) {
            foreach ($config_info as $key => $value) {
                $config_value[$value['config_variable']][] = $value;
            }
        }
        return $config_value;
    }

    // Set Currency setup for config
    public function chk_currency()
    {
        global $config;
        $currency_conf = $this->session->userdata('currency');
        if ($currency_conf) {
            $config['currency'] = $currency_conf['currency'] ? $currency_conf['currency'] : $config['currency'];
            $config['currency_rate'] = $currency_conf['currency_rate'] ? $currency_conf['currency_rate'] : $config['currency_rate'];
        }
    }

    /*
    * Adds Script
    * @params	file (mixed) 		File name/ Relevant to CSS/JS folder
    * @params	filetype 	js OR css
    */
    public function add_script($files = '', $file_type = "css")
    {
        $file_type .= '_files';
        // If array is passed, push all
        if (array_filled($files)) {
            foreach ($files as $file)
                $this->layout_data[$file_type][] = $file;
        } // Else if single file is pass, push it in
        elseif ($files)
            $this->layout_data[$file_type][] = $files;
        else return "empty";
    }

    /*
    * Set Meta Data for Layout
    */
    public function set_meta($meta_data = '')
    {
        // If array is passed, push all
        if (array_filled($meta_data)) {
            $this->layout_data['meta_data'] = $this->layout_data['meta_data'] + $meta_data;
        }
    }

    public function set_social_meta($data = array())
    {
        $meta["og:type"] = FB_OG_TYPE;
        $meta["fb:app_id"] = FB_APP_ID;
        $meta["og:title"] = $data['title'];
        $meta["og:site_name"] = SITE_NAME;
        $meta["og:description"] = $data['description'];
        $meta["og:image"] = $data['image'];
        $meta["og:url"] = $config['base_url'] . $_SERVER['REQUEST_URI'];

        $meta["twitter:card"] = TW_CR_TYPE;
        $meta["twitter:title"] = $meta["og:title"];
        $meta["twitter:description"] = $meta["og:description"];
        $meta["twitter:image"] = $meta["og:image"];
        $meta["twitter:url"] = $meta["og:url"];
        $meta["twitter:site"] = SITE_NAME;
        $meta["twitter:creator"] = FB_OG_CREATOR;


        $this->set_meta($meta);
    }

    /*
    * Register Plugins
    * @params	file (mixed) 		File name/ Relevant to CSS/JS folder
    * @params	filetype 	js OR css
    */
    public function register_plugins($plugins = '')
    {
        // If array is passed, push all
        if (array_filled($plugins)) {
            foreach ($plugins as $plg)
                $this->layout_data['additional_tools'][$plg] = $plg;
        } // Else if single file is pass, push it in
        elseif ($plugins)
            $this->layout_data['additional_tools'][$plugins] = $plugins;
        else false;
    }

    /*
    * UN-REGISTER Plugins
    * @params	file (mixed) 		File name/ Relevant to CSS/JS folder
    * @params	filetype 	js OR css
    */
    public function unregister_plugins($plugins = '')
    {
        // If array is passed, push all
        if (array_filled($plugins)) {
            foreach ($plugins as $plg)
                unset($this->layout_data['additional_tools'][$plg]);
        } // Else if single file is pass, push it in
        elseif ($plugins)
            unset($this->layout_data['additional_tools'][$plugins]);
        else false;
    }

    /*
    * Sets Default Php timezone for Projects
    * $dit PHP_TIME_ZONE constaint from tkd_config.php
    */
    private function set_time_zone()
    {
        if (PHP_TIME_ZONE)
            date_default_timezone_set(PHP_TIME_ZONE);
    }

    /*
    * Redirect If not logged in.
    */
    public function login_redirect_check($session = "", $is_admin = "")
    {
        global $config;
        $class = $this->router->class;
        $login_session = $this->session->userdata($session);
        if (!in_array($class, array('login', 'register'))) {

            $redirect_url = $config['base_url'] . $this->uri->uri_string;
            if ((!$login_session) && ($class != 'logout')) {
                redirect("/admin/login?redirect_url=" . urlencode($redirect_url));
                exit();
            } elseif ($is_admin && !$login_session[$is_admin]) {
                redirect("/admin/login");
                exit();
            }
        }
    }

    /*
    * Load View for Template
    * view_file 	mst exist within class folder inside view(admin/product/view_file.php). If not , will search in default folder. Elese throws error
    * view_data
    * render 		Render output. (Boolean)
    * use_template 	Render template (Boolean).
    */
    public function load_view($view_file, $view_data = array(), $render = false, $use_template = true)
    {

        global $config;

        $view = $this->view_pre . $view_file;
        $view = view_exists($view, $this->router->class);
        //adding layout data array *START-Abdul Samad*
        $view_data['layout_data'] = $this->layout_data;
        $view_data['cms_content'] = isset($this->layout_data['cms_content']) ? $this->layout_data['cms_content'] : array();
        $view_data['session_data'] = $this->session->userdata('logged_in');
        //adding layout data array
        if ($use_template) {
            $this->layout_data['content_block'] = $this->load->view($view, $view_data, true);
            //Load Layout
            $this->load->view("_layout/" . $this->layout, $this->layout_data);
        } else
            return $this->load->view($view, $view_data, $render);
    }

    /*
    * Form Validation
    */
    public function validate($model, $custom_rules=array())
    {
        $rules = $this->$model->get_rules();
        // Append custom rules if has
        if(array_filled($custom_rules)){
            foreach($custom_rules as $key=>$value):
                $rules[$key]['field'] = $value['field'];
                    $rules[$key]['label'] = $value['label'];
                $rules[$key]['rules'] = $value['rules'];
            endforeach;
        }
        $this->form_validation->set_rules($rules);
        $this->form_validation->set_error_delimiters("<span for=\"%s\" style='color:#fff' class=\"has-error help-block\">", '</span>');

        return $this->form_validation->run();
    }

    /*
    * Custom Form Validation
    */
    public function custom_validate($model, $fields=array())
    {
        $rules = $this->$model->get_rules();
        $custom_rules = array();
        // Append custom rules if has
        foreach($fields as $key=>$value):
            $custom_rules[$value]['field'] = $rules[$value]['field'];
            $custom_rules[$value]['label'] = $rules[$value]['label'];
            $custom_rules[$value]['rules'] = $rules[$value]['rules'];
        endforeach;
        $this->form_validation->set_rules($custom_rules);
        $this->form_validation->set_error_delimiters("<span for=\"%s\" style='color:#fff' class=\"has-error help-block\">", '</span>');

        return $this->form_validation->run();
    }

    /*
    * Bulk form validation
    */
    public function bulk_validate($models)
    {
        if (array_filled($models)) {
            foreach ($models as $model) {
                if ($this->validate($model) !== true)
                    return false;
            }
            return true;
        }
    }

    public function send_inquiry_mail($data, $params = array())
    {
        global $config;

        $to = $params['to'] ? $params['to'] : $config['email_sales'];
        $cc = $params['cc'] ? $params['cc'] : $config['email_cc'];
        $subject = $params['subject'] ? $params['subject'] : "Recieved Inquiry";
        $message = $this->load->view("_layout/email_template/query_ticket", $data, true);

        $this->load->library('email');
        $this->email->from($config['email_no_reply'], 'Kansai Group- Reply');
        $this->email->to($to);

        if ($cc)
            $this->email->cc($cc);

        $this->email->subject($subject);
        $this->email->message($message);
        return $this->email->send();
    }

    // Validations ----- callback_is_slug
    public function is_slug($str, $attr)
    {
        $match = preg_match('/^([a-zA-Z0-9\-_]+)$/', $str);
        if (!$match) {
            $this->form_validation->set_message('is_slug', 'The field can only contain alphanums and "-" and "_"');
            return FALSE;
        } else {
            return TRUE;
        }
    }

    /**
     *    function will return the all news.
     **/
    public function get_all_news($limit = "")
    {
        $news_data = array();
        /** if limit pass **/
        if (!empty($limit))
            $param['limit'] = $limit;

        /** order **/
        $param['order'] = 'news_createdon desc';

        /** get all news **/
        $news = $this->model_news->find_all_active($param);
        foreach ($news as $key => $value) {
            $date = date('F Y', strtotime($value['news_createdon']));
            $news_data[$date][] = $value;
        }

        return $news_data;
    }



    public function fp_email($to,$template,$title){
        
        $this->load->library('email');

        $send_from = 'info@thenorthernirelandconnection.com';
        $name = 'Thenorthernireland';
        $send_to = $to;
        $title = 'Forgot Paasword';
        $message = $template;

        // debug($send_from);
        // debug($send_to);
        // debug($message,1);
        


        $this->email->from($send_from, $name);
        $this->email->to($send_to);
        $this->email->subject($title);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        //$this->email->protocol('smtp');
        $mail = $this->email->send();
        //debug($mail,1);   

    }



    public function email_structure_contact($form,$title)
    {
        
         global $config;
        $this->load->library('email');
        
        $send_to = g('db.admin.email');
            if(isset($_POST[$form]['contact_us_inquiry_email']))
                $send_from =  $_POST[$form]['contact_us_inquiry_email'];
            else
                $send_from = g('db.admin.email');
                
        $name = 'Contact Us Inquiry';
        
        
        
        $message = $this->load->view("_layout/email_template/query3",
            array(
                "form_input"=>$_POST[$form]
            ),
            true
        );


        $this->email->from($send_from, $name);
        $this->email->to($send_to);
        $this->email->subject($name);

        
        $this->email->set_mailtype("html");
        $this->email->message($message);
        
        // debug($message);
        // debug($send_from);
        // debug($name);
        // debug($send_to,1);
       
        if($this->email->send())
        {
            $param['status'] = 1;
            $param['txt'] = 'Thank you for your input. We will contact you shortly.';
            echo json_encode($param);
        }
        else
        {
            echo $this->email->print_debugger();
        }       
    }
       public function client_email ($to,$template,$title)
       {
        $this->load->library('email');

        $db_to = g("db.admin.email");
        $name = g('site_name');
        $send_to = $to;
        $message = $template;
        //debug($message,1);
        $this->email->from($db_to, $name);
        $this->email->to($send_to);
        $this->email->subject($title);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        $this->email->send();
        
    }
    
    // public function send_report_email($from,$reportAdsData)
    //   {
           
    //     $this->load->library('email');
        
    //     $title = $name .' – Report Ad Email Notification';

    //     $template = $this->load->view("_layout/email_template/reportademail",
    //         array(
    //             "form_input"=>$reportAdsData
    //         ),
    //         true
    //     );
    
    //     $send_from = $from;
    //     $db_to = g("db.admin.email");
    //     $name = g('site_name');
    //     $send_to = $db_to;
    //     $message = $template;
        
    //     //debug($message,1);
    //     $this->email->from($send_from, $name);
    //     $this->email->to($send_to);
    //     $this->email->subject($title);
    //     $this->email->set_mailtype("html");
    //     $this->email->message($message);
    //     $send = $this->email->send();
    //     if($send){
    //          echo "send";
    //      }else{
    //          echo "not send";
    //      }
         
    //      exit;
    // }
    
    public function send_report_email22($sendfrom,$reportAdsData)
    {
        // debug($sendfrom);
        // debug($reportAdsData,1);
        global $config;
        $this->load->library('email');

       // $db_to = $to ;
        // $db_to = 'johndavid78663@gmail.com' ;
        $send_from = $sendfrom;
        $send_to = g('db.admin.email');
        $name = g('site_name');
        $title = $name .' – Report Ad Email Notification';
        $message = $this->load->view("_layout/email_template/reportademail",
            array(
                "form_input"=>$reportAdsData
            ),
            true
        );

        $headers = "From: " . strip_tags($send_from) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($send_to) . "\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=UTF-8\r\n";

        mail($send_to,$title,$message,$headers);

        // debug($send_from);
        // debug($send_to);
        // debug($name);
        // debug($title);
        // debug($message,1);

        // $this->email->from($send_from, $name);
        // $this->email->to($send_to);
        // $this->email->subject($title);
        // $this->email->set_mailtype("html");
        // $this->email->message($message);
        // $this->email->send();
        // if($send){
        //     echo "send";
        // }else{
        //     echo "not send";
        // }
        
        // exit;

    }
    
    public function send_report_email($sendfrom,$reportAdsData)
   {
    $this->load->library('email');
    $name = g('site_name').' - Membership Subscription';
    $send_to = $db_to;
    $title = $name .' – Report Ad Email Notification';
    
    $template = $this->load->view("_layout/email_template/reportademail",
            array(
                "form_input"=>$reportAdsData
            ),
            true
        );
    $message = $template;
    // $this->email->from($db_to, $name);
    // $this->email->to($send_to);
    // $this->email->subject($title);
    // $this->email->set_mailtype("html");
    // $this->email->message($message);
    // $this->email->send();
    
    
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        $headers .= 'From: '.$sendfrom."\r\n";
        //$headers .= 'Bcc: ericwalter.developer@gmail.com' . "\r\n";
        //$headers .= 'Cc: myboss@example.com' . "\r\n";
        // debug($to);
        // debug($subject);
        // debug($message);
        // debug($headers);


         mail($to,$subject,$message,$headers);
}
    
    
    public function client_email_order ($send_to,$message,$title)
   {
    $this->load->library('email');
    $db_to = g("db.admin.email");
    $name = g('site_name').' - Membership Confirmation';
    $send_to = $to;
    $title = $name;
    $message = $template;
    $this->email->from($db_to, $name);
    $this->email->to($send_to);
    $this->email->subject($title);
    $this->email->set_mailtype("html");
    $this->email->message($message);
    return $this->email->send();
}

public function client_email_stock ($to,$template,$title)
   {
    $this->load->library('email');

    $db_to = g("db.admin.email");
    $name = g('site_name');
    $send_to = $to;
    // $title = $name;
    $message = $template;
    $this->email->from($db_to, $name);
    $this->email->to($send_to);
    $this->email->subject($title);
    $this->email->set_mailtype("html");
    $this->email->message($message);
    return $this->email->send();
}
public function invoice($id,$email)
     {

          global $config;
          $this->load->library('email');
          
          // $email = $_POST['order']['order_email'];
          $send_from =  g('db.admin.email');
          $name = g('site_name');
          $title = g('site_name')." Invoice";
          // $cc = g("db.admin.email");
          $message = $this->load->view("_layout/email_template/invoice",array('invoiceID'=>$id),true);

          // debug($email);
          // debug($send_from);
          // debug($name);
          // debug($message,1);

          
            $headers = "From: " . strip_tags($send_from) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($email) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
        
          mail($email,$title,$message,$headers);
          
     }
     public function invoice_admin($id,$email)
     {
          global $config;
          $this->load->library('email');
          // $email = $_POST['order_email'];
          $send_from =  g('db.admin.email');
          $name = g('site_name');
          $title = g('site_name')." You Received a New Order";
          // $cc = g("db.admin.email");
          $message = $this->load->view("_layout/email_template/invoice_admin",array('invoiceID'=>$id),true);
          
          // debug($email);
          // debug($send_from);
          // debug($name);
          // debug($message,1);
            $headers = "From: " . strip_tags($email) . "\r\n";
            $headers .= "Reply-To: ". strip_tags($send_from) . "\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
          mail($send_from,$title,$message,$headers);
     }

}

// END Controller class

/* End of file Controller.php */
/* Location: ./system/core/Controller.php */
