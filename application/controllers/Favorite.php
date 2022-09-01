<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Favorite extends MY_Controller {

	/**
	 * Contact US Controller
	 */
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Page
    public function store()
    {
        // Get post data
        $product_id = ($this->input->post('id'));
        // Success
        if( (intval($product_id)) && ($this->userid>0))
        {
            // Validation success
            $result = $this->model_favorite->favorite_status(0,$product_id,$this->userid);
            // Check already up status
            if(array_filled($result)){
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = 'You have already added this video.';
            }
            else{
                //$data['favorite_cat_id'] = $cat_id;
                $data['favorite_product_id'] = $product_id;
                $data['favorite_user_id'] = $this->userid;
                $data['favorite_status'] = STATUS_ACTIVE;
                // Set attributes
                $this->model_favorite->set_attributes($data);
                // Save record
                $inserted_id = $this->model_favorite->save();

                // Insert successfully
                if($inserted_id > 0)
                {
                    $this->json_param['status'] = 1;
                    $this->json_param['txt'] = 'Success';
                }
                else
                {
                    $this->json_param['status'] = 0;
                    $this->json_param['txt'] = 'Something went wrong.Please try later.';
                }
            }
        }
        else{
            $this->json_param['status'] = 0;
            $this->json_param['txt'] = 'No parameters found';
        }

        echo json_encode($this->json_param);
    }

}
