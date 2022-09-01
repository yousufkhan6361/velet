<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Package extends MY_Controller {

	/**
	 * Contact US Controller
	 */
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Page
    public function detail($id)
    {
        global $config;
        // Get banner
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(1);
        $package_detail = $this->model_pricing->find_by_pk($id);
        $user_detail = $this->model_signup->find_by_pk($this->userid);

        // debug($package_detail,1);
        $param = array();
        $param['order_user_id'] = $this->userid;
        $param['order_package'] = $id;
        $get_order_details = $this->model_order->find_one($param);
        if (!array_filled($get_order_details)) {
            if (array_filled($package_detail)) {
                if($package_detail['pricing_amount'] != '0' || $package_detail['pricing_amount'] != '0.00' || !empty($package_detail['pricing_amount']))
                {
                    $contact_us_data['order_firstname'] = $user_detail['signup_firstname'];
                    $contact_us_data['order_lastname'] = $user_detail['signup_lastname'];
                    $contact_us_data['order_email'] = $user_detail['signup_email'];
                    $contact_us_data['order_user_id'] = $this->userid;
                    $contact_us_data['order_package'] = $id;
                    $contact_us_data['order_amount'] = $package_detail['pricing_amount'];
                    $contact_us_data['order_total'] = $package_detail['pricing_amount'];
                    $contact_us_data['order_payment_status'] = 0;
                    $contact_us_data['order_status'] = 0;
                    //$contact_us_data['order_shipment_price'] = $this->layout_data['config_info']['admin']['shipping_flat_rate'];
                    // debug($contact_us_data,1);
                    //debug($contact_us_data);

                    $inserted_id = $this->model_order->insert_record($contact_us_data);
                    $data['flag'] = 1;
                }
                else{
                    $data['flag'] = 0;
                }
            }
            else{
                $data['flag'] = 0;
            }
        }
        else{
            $data['flag'] = 3;
        }
        
        // Load View
        $this->load_view("detail", $data);
    }
}