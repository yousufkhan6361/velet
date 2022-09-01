<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Quote extends MY_Controller {

	/**
	 *
	 * @package		Quote
	 *
     * @version		1.0 --
     * @since		Version 1.0 2019
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "
        quote_id,
        quote_fullname,
        quote_email,
        quote_createdon,
        quote_status";
        $this->dt_params['searchable'] = array("quote_id","quote_email","quote_status",);
        $this->dt_params['action'] = array(
										"hide_add_button" => true ,
                                        "hide" => false ,
                                        "show_delete" => true ,
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

	public function add($id='', $data=array())
	{
		parent::add($id, $data=array());
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
