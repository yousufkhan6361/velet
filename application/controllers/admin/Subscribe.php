<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Subscribe extends MY_Controller {

	/**
	 *
	 * @package		Subscribe
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "
        subscribe_id,
        subscribe_email,
        subscribe_createdon,
        subscribe_status";
        $this->dt_params['searchable'] = array("subscribe_id","subscribe_email","subscribe_status",);
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

    public function send_mail()
    {
        $this->configure_add_page();
        $this->layout_data['bread_crumbs'] = array(
            array(
                "home/"=>"Home" ));
        // Send email
        if(isset($_POST) && count($_POST)>0){
            $data = $this->input->post();
            $subject = $data['subject'];
            $message = $data['message'];
            /*debug($subject);
            debug($message,1);*/
            if((empty($subject)) || (empty($message))){
                redirect($this->admin_path.'send_mail'."?msgtype=error&msg=fields required.", 'refresh');
            }
            else{
                // Get data
                $result = $this->model_subscribe->find_all_active(array('fields'=>'subscribe_email'));
                $email = array_column($result,'subscribe_email');

                if(array_filled($email)){
                    foreach($email as $key=>$value):
                        $this->model_email->_send_all_subscribers($value, $data['subject'], $data['message']);
                    endforeach;

                    redirect($this->admin_path.'send_mail'."?msgtype=success&msg=Sent successfully.", 'refresh');

                }

            }
        }

        // :pad view
        $this->load_view('send_mail');
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
