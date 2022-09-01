<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Stock_email extends MY_Controller {

	/**
	 * stock_email page
	 *
	 * @package		stock_email
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "stock_email_id,stock_email_email,stock_email_createdon,stock_email_status";
        $this->dt_params['searchable'] = array("stock_email_id","stock_email_email","stock_email_status");
        $this->dt_params['action'] = array(
										"hide_add_button" => true ,
                                        "hide" => false ,
                                        "order_field" => false ,
                                         "show_delete" => true ,
                                        "show_view" => true ,
                                        "extra" => array() ,
                                      );
        $this->_list_data['stock_email_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
                 $this->form_params['action'] = array(
						        	'hide_save' => true,
						        	'hide_save_new' => false
						    	);


       
		$config['js_config']['paginate'] = $this->dt_params['paginate'];

		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='', $data=array())
	{
		parent::add($id, $data=array());
	}

	public function ajax_view($id='')
	{
		if($id)
		{
			$this->model_stock_email->update_by_pk($id, array("stock_email_status" => 0));
		}
		parent::ajax_view($id);
	}

}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
