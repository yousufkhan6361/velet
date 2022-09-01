<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Signup extends MY_Controller {


    public $_list_data = array();

	public function __construct() {

		global $config;


		parent::__construct();
        $this->dt_params['dt_headings'] = "signup_id, signup_firstname, signup_lastname, signup_email, signup_status";
        //$this->dt_params['searchable'] = array("signup_id","signup_firstname","signup_status");
        $this->dt_params['action'] = array(
                                        "hide_add_button" => false ,
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );

/*
        $this->_list_data['signup_status'] = array(
                                        STATUS_INACTIVE => "<span class=\"label label-danger\">Inactive</span>",
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"
                                    );*/

        $config['js_config']['paginate'] = $this->dt_params['paginate'];

        /*$this->_list_data['signup_category'] = $this->model_category->find_all_list_active(array(),"category_name");
        $this->_list_data['signup_level'] = $this->model_item->get_fields('item_level')['list_data'];
        $this->_list_data['signup_item_type'] = $this->model_item->get_fields('item_type')['list_data'];*/

		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='', $data=array())
	{
	    // Unset password to avoid pass change
	    if((isset($_POST)) && (count($_POST)>0) && (!empty($id))){
	        unset($_POST['signup']['signup_password']);
        }
		parent::add($id, $data);
	}

    // update_password
    public function update_password(){
        $data = $this->input->post('signup');
        if((count($_POST) > 0) && (isset($data['signup_password'])) && (!empty($data['signup_password']))) {
            $param['signup_password'] = md5($data['signup_password']);
            $status = $this->model_signup->update_by_pk($data['signup_id'],$param);
            if($status){
                $msg = 'Password changed successfully.';
                redirect($this->admin_path."?msgtype=success&msg=$msg", 'refresh');
            }
            else{
                $msg = "Unable to change password. Please user different password";
                redirect($this->admin_path."?msgtype=error&msg=$msg", 'refresh');
            }
        }
        else{
            $msg = "Record not updated.";
            redirect($this->admin_path."?msgtype=error&msg=$msg", 'refresh');
        }
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
