<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Cms_content extends MY_Controller {

	/**
	 * CMS Content
	 *
	 * @package		Cms_content
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "cms_content_id,cms_content_page_id,cms_content_position,cms_content_status";
        $this->dt_params['searchable'] = array("cms_content_id","cms_content_name","cms_content_desc_short","cms_content_meta_title","cms_content_status");
        $this->dt_params['action'] = array(
										"hide_add_button" => true ,
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files

		$config['js_config']['paginate'] = $this->dt_params['paginate'];

		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='')
	{
		$this->layout_data['additional_tools'][] = "jstree";
		$this->_list_data['cms_content_page_id'] = $this->model_cms_page->find_all_list_active(array(),"cms_page_name");
		$this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
		parent::add($id);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
