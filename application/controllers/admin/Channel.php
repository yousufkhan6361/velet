<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Channel extends MY_Controller {

	/**
	 * Channel page
	 *
	 * @package		faq
	 * 
	 * @version		1.0 -- Robust , Advanced And More Frustating...
	 * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "channel_id,channel_type,channel_status";
        $this->dt_params['searchable'] = array("channel_id","channel_name","channel_status");
        $this->dt_params['action'] = array(
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "multi_lang" => false ,
                                        "extra" => array() ,
                                      );
        
        $this->_list_data['channel_status'] = array(
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );

        //$this->_list_data['channel_category_id'] = $this->model_channel_category->find_all_list_active(array(),"channel_category_name");

		// For use IN JS Files
		$config['js_config']['paginate'] = $this->dt_params['paginate'];

        //$_POST = $this->input->post(NULL, true);  // return POST with xss filter
        $_POST = $this->input->post(NULL, false); // return POST without xss filter
		//$language = get_lang_details($_GET);
		//$config['js_config']['paginate']['uri'] .= '?lang=' . $language['lang_id'];
	}

	public function add($id='', $data=array())
	{
		// Popluated LISTDATA in constructor
		$this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
		parent::add($id);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
