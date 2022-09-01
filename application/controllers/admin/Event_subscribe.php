<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Event_subscribe extends MY_Controller {

	/**
	 *
	 * @package		Event_event_subscribe
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "
        event_subscribe_id,
        event_subscribe_email,
        event_subscribe_createdon,
        event_subscribe_status";
        $this->dt_params['searchable'] = array("event_subscribe_id","event_subscribe_email","event_subscribe_status",);
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
                $result = $this->model_event_subscribe->find_all_active(array('fields'=>'event_subscribe_email'));
                $email = array_column($result,'event_subscribe_email');

                if(array_filled($email)){
                    foreach($email as $key=>$value):
                        $this->model_email->_send_all_event_subscribers($value, $data['subject'], $data['message']);
                    endforeach;

                    redirect($this->admin_path.'send_mail'."?msgtype=success&msg=Sent successfully.", 'refresh');

                }

            }
        }

        // :pad view
        $this->load_view('send_mail');
    }

    public function ajax_view($id='')
    {
        if($id)
        {
            $this->model_event_subscribe->update_by_pk($id, array("event_subscribe_status" => 1));
        }


        //parent::ajax_view($id);
        echo  json_encode($this->get_view_custom($id));
    }

    public function get_view_custom($id=0) {

        global $config;
        $result = array();
        $class_name = $this->router->class;
        $model_name = 'model_'.$class_name ;
        $model_obj = $this->$model_name ;
        $form_fields = $model_obj->get_fields();
        if($id)
        {
            $result['record'] = $this->$model_name->find_by_pk($id);
            $result['record'] = $this->prepare_view_data_custom($result['record']);
            if(!$result['record'] )
                $result['failure'] = "No Item Found";
            // Load relation fields data
            $relation_data = $this->$model_name->get_relation_data($id);
            if(array_filled($relation_data))
                $result['record']['relation_data'] = $relation_data;
        }
        else
        {
            $result['failure'] = "No Item Found";
        }

        return $result;

    }

    public function prepare_view_data_custom($record='')
    {
        $model_fields = $this->model_event_subscribe->get_fields();
        if(array_filled($record))
        {
            foreach ($record as $field => $value) {
                if(!$value)
                    continue;
                $head = $model_fields[ $field ][ 'label' ] ;

                // Check data is serialize or not
                $data = @unserialize($value);
                if ($data !== false) {
                    $return[$head] = implode("<br/>",$data);
                } else {
                    $return[$head] = $value ;
                }

            }
            return $return;
        }
    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
