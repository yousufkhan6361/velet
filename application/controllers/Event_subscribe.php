<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Event_subscribe extends MY_Controller {

	/**
	 * Subscribe Controller
	 */

    private $json_param = array();
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Page
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store()
    {
        // Get post data
        $post = $this->input->post();
        // Success
        if(count($post) > 0)
        {
            // Validation success
            if($this->validate("model_event_subscribe"))
            {
                // Get data
                $data = $post['event_subscribe'];
                $data['event_subscribe_interest'] = serialize($data['event_subscribe_interest']);
                // Set status 1
                $data['subscribe_status'] = 1;
                // Set attributes
                $this->model_event_subscribe->set_attributes($data);
                // Save record
                $inserted_id = $this->model_event_subscribe->save();

                // Insert successfully
                if($inserted_id > 0)
                {
                    //$this->model_email->_subscribe_email($data['subscribe_email']);
                    $this->json_param['status'] = 1;
                    $this->json_param['txt'] = 'Thank you for your Subscribe';
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



}
