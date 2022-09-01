<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Newsletter extends MY_Controller {

	/**
	 * newsletter page
	 *
	 * @package		newsletter
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "newsletter_id,newsletter_email,newsletter_createdon,newsletter_status";
        $this->dt_params['searchable'] = array("newsletter_id","newsletter_email","newsletter_status");
        $this->dt_params['action'] = array(
										"hide_add_button" => true ,
                                        "hide" => false ,
                                        "order_field" => false ,
                                         "show_delete" => true ,
                                        "show_view" => true ,
                                        "extra" => array() ,
                                      );
        $this->_list_data['newsletter_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  
                                    );
                 $this->form_params['action'] = array(
						        	'hide_save' => true,
						        	'hide_save_new' => false
						    	);


       
		$config['js_config']['paginate'] = $this->dt_params['paginate'];

		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='', $data=array())
	{
		parent::add($id, $data=array());
	}

	public function ajax_view($id='')
	{
		if($id)
		{
			$this->model_newsletter->update_by_pk($id, array("newsletter_status" => 0));
		}
		parent::ajax_view($id);
	}
    
    public function generate_excel_data()
    {   
        require_once(APPPATH."third_party/export-xls.class/export-xls.class.php");
        $s = $this->model_newsletter->find_all();
        $filename = 'Subscribersdata.xls'; // The file name you want any resulting file to be called.
        $xls = new ExportXLS($filename);
        $header = "All Subscribers Data"; // single first col text
        $xls->addHeader($header);
        #add blank line
        $header = null;
        $xls->addHeader($header);
        $header[] = "ID";
        $header[] = "Email";
        $header[] = "Createdon";
        $xls->addHeader($header);
        $row = array();
        foreach($s as $key=>$val){
            $row[$key][0] = $val['newsletter_id'];
            $row[$key][1] = $val['newsletter_email'];
            $row[$key][2] = $val['newsletter_createdon'];
            
        }
        $xls->addRow($row);
        $xls->sendFile();
    }
}
/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
