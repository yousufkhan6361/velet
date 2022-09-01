<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Exam extends MY_Controller {

	/**
	 *
	 * @package		Exam
	 *
     * @version		1.0 --
     * @since		Version 1.0 2020
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "exam_id,product_name,exam_status";
        $this->dt_params['searchable'] = array("exam_id", "product_name", "exam_status");
        
        $this->dt_params['action'] = array(
        								"hide_add_button" => false ,
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );
        $this->_list_data['exam_status'] = array(
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"
                                    );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files

		$config['js_config']['paginate'] = $this->dt_params['paginate'];


        /*$this->_list_data['exam_page'] = array(
            'home'=>'Home',
            'wireless'=>'Wireless',
            'accessories'=>'Accessories',
            'about_us'=>'About Us',
            'news_info'=>'News & Info',
            'contact_us'=>'Contact Us',
        );*/

		$this->_list_data['exam_product_id'] = $this->model_product->find_all_list_active(array('order'=>'product_name ASC'),"product_name");
		//$this->_list_data['exam_product_id'] = $this->model_product->find_all_list_active(array(),"product_name");

        $this->_list_data['exam_answer'] = array(
            '1'=>'Option # 1',
            '2'=>'Option # 2',
            '3'=>'Option # 3',
            '4'=>'Option # 4',
            //'5'=>'Option # 5',
        );

		$_POST = $this->input->post(NULL, true);
	}

	public function add($id='', $data=array())
	{
        // When edit record
        if(!$id){
            $this->_list_data['exam_answer'] = array(
                '1'=>'Option # 1',
                '2'=>'Option # 2',
                '3'=>'Option # 3',
                '4'=>'Option # 4',
                //'5'=>'Option # 5',
            );
        }

        /*$this->form_params = array(
            "action" => array(
                "hide_save" => true ,
                "hide_save_edit" => true,
                "hide_save_new" => false ,
                "hide_cancel" => true ,
            ),
        );*/

		parent::add($id, $data);
	}

    public function get_list()
    {
        $id = $this->input->post("search_val");
        $param['fields'] = "exam_list_id,exam_list_title";
        $param['where']['exam_list_product_id'] = $id ;
        $data = $this->_list_data['exam_e_list'] = $this->model_exam_list->find_all_active($param);
        echo json_encode($data);
    }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
