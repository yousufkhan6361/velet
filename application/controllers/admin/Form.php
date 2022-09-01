<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Form extends MY_Controller {

	/**
	 * CSL Achievements page
	 *
	 * @package		form
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "form_id,form_name,form_email,form_message,form_status";
        $this->dt_params['searchable'] = array("form_id","form_name","form_heading","form_email","form_status");
        $this->dt_params['action'] = array(
										"hide_add_button" => true ,
                                        "hide" => false ,
                                        "order_field" => false ,
                                        "show_view" => true ,
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
		parent::add($id);
	}

	public function ajax_view($id='')
	{
		if($id)
		{
			$this->model_form->update_by_pk($id, array("form_status" => 0));
		}
		parent::ajax_view($id);
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
