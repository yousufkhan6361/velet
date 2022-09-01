<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Quote extends MY_Controller {

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
            if($this->validate("model_quote"))
            {
                // Get data
                $data = $post['quote'];
                // Set status 1
                $data['quote_status'] = 1;
                // Set attributes
                $this->model_quote->set_attributes($data);
                // Save record
                $inserted_id = $this->model_quote->save();

                // Insert successfully
                if($inserted_id > 0)
                {
                    if(ENVIRONMENT!='development'){
                        //$this->model_email->_quote_email($data['quote_email']);
                    }
                    $this->json_param['status'] = 1;
                    $this->json_param['txt'] = 'Thank you for your Request. We will contact you shortly.';
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
