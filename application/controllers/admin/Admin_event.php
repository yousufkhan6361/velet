<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Admin_event extends MY_Controller {

	/**
	 * Admin_event Achievements page
	 *
	 * @package		Admin_event
	 *
     * @version		1.0 --
     * @since		Version 1.0 2019
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "admin_event_id,admin_event_name,admin_event_category,admin_event_created,admin_event_status";
        $this->dt_params['searchable'] = array("admin_event_id","admin_event_name","admin_event_status");
        $this->dt_params['action'] = array(
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                        "hide_add_button"=>false
                                      );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

        $this->_list_data['admin_event_status'] = array(
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
		// For use IN JS Files

		//$this->_list_data['admin_event_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");

		$config['js_config']['paginate'] = $this->dt_params['paginate'];

		$_POST = $this->input->post(NULL, false);
	}


	public function add($id='', $data=array())
	{
		// Popluated LISTDATA in constructor

		//$this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
		//$this->register_plugins("jquery-file-upload");
		/*$this->form_data['admin_event_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");
		$this->_list_data['admin_event_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");*/
		
		
		parent::add($id, $data);
	}

    public function save()
    {
        // Get post data
        $post = $this->input->post();
        // Success
        if(count($post) > 0)
        {
            $_POST['admin_event']['admin_event_name'] =$post['title'];
            $_POST['admin_event']['admin_event_category'] =$post['category'];
            $_POST['admin_event']['admin_event_created'] =$post['cdate'];

            // Validation success
            if($this->validate("model_admin_event"))
            {
                // Get data
                $data = $_POST['admin_event'];
                // Set status 1
                $data['admin_event_created'] = $_POST['cdate'];
                $data['admin_event_status'] = 1;
                // Set attributes
                $this->model_admin_event->set_attributes($data);
                // Save record
                $inserted_id = $this->model_admin_event->save();

                // Insert successfully
                if($inserted_id > 0)
                {
                    $this->json_param['status'] = 1;
                    $this->json_param['txt'] = 'Event added.';
                }
                else
                {
                    $this->json_param['status'] = 0;
                    $this->json_param['txt'] = 'Something went wrong.Please try later.';
                }
            }
            // Validation error
            else
            {
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = validation_errors();
            }
        }
        else{
            $this->json_param['status'] = 0;
            $this->json_param['txt'] = 'No parameters found';
        }

        echo json_encode($this->json_param);
    }

    public function update($id = 0)
    {
        // Get post data
        $post = $this->input->post('admin_event');
        // Success
        if(count($post) > 0 && ($id>0) && (!empty($post['admin_event_name'])))
        {
            // Get data
            $data = $post;
            // update  record
            $updated = $this->model_admin_event->update_by_pk($id, $post);

            // updated successfully
            if($updated)
            {
                $this->json_param['status'] = 1;
                $this->json_param['txt'] = 'Event updated.';
            }
            else
            {
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = 'Record not updated.';
            }
        }
        else{
            $this->json_param['status'] = 0;
            $this->json_param['txt'] = 'Invalid parameter.';
        }

        echo json_encode($this->json_param);
    }

    public function delete()
    {
        // Get post data
        $id = $this->input->post('id');
        // Success
        if($id>0)
        {
            // update  record
            $updated = $this->model_admin_event->delete_by_pk($id);

            // updated successfully
            if($updated)
            {
                $this->json_param['status'] = 1;
                $this->json_param['txt'] = 'Event removed.';
            }
            else
            {
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = 'Failed to delete event.';
            }
        }
        else{
            $this->json_param['status'] = 0;
            $this->json_param['txt'] = 'Invalid parameter.';
        }

        echo json_encode($this->json_param);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
