<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Affiliate extends MY_Controller {

	/**
	 * affiliate page
	 *
	 * @package
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "affiliate_id,affiliate_username,affiliate_useremail,affiliate_link,affiliate_status";
        $this->dt_params['searchable'] = array("affiliate_id","affiliate_username","affiliate_useremail","affiliate_status");
        $this->dt_params['action'] = array(
                                        "hide" => false ,
                                        "hide_add_button" => true ,
                                        "show_delete" => false ,
                                        "show_edit" => false ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array(

                                        	'<a title="View Referral Users" href="'.$config['admin_base_url'].'affiliate/detail/%d/" class="btn-xs btn btn-primary order_details_btn"><i class="icon-picture"></i></a>',
                                		) ,
                                      );
        
        $this->_list_data['affiliate_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files
		$config['js_config']['paginate'] = $this->dt_params['paginate'];
		
		// Populating LISTDATA

		$_POST = $this->input->post(NULL, false);
	}



	public function detail($affiliateId='')
	{  

		$this->layout_data['template_config']['show_toolbar'] = false;
		$this->register_plugins(array(						
									"jquery-ui",
									"bootstrap",
									"bootstrap-hover-dropdown",
									"jquery-slimscroll",
									"uniform",
									"boots",
									"font-awesome",
									"simple-line-icons" ,
									"select2",
									"bootbox",
									"bootstrap-toastr",
									"bootstrap-datetimepicker"
								));

		//debug($affiliateId);

		$par['where']['affiliate_id'] = $affiliateId;
        $data['affiliateData'] = $this->model_affiliate->find_one($par);

        $affUserId = $data['affiliateData']['affiliate_userid'];

        $que13 = $this->db->query("SELECT * FROM fb_referral WHERE referral_userid = $affUserId");
       
        $data['ReferralData'] = $que13->result_array();

        $this->load_view("detail" , $data);

        //debug($ReferralData);
  		//$this->db->select('*');
		// $this->db->from('fb_referral');
		// $this->db->where('referral_userid', $affUserId);
		// //$this->db->join('comments', 'comments.id = blogs.id');
		// $query = $this->db->get();

        //debug($query);

	}
	
}


/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
