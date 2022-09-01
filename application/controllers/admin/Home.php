<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		global $config;
		//Set template configurations before calling load_template
		//Visit MY_Controller for details
		$this->layout_data['page_title'] = "Dashboard";
		//$this->layout_data['page_title_min'] = "Dashboard";
		$this->layout_data['bread_crumbs'] = array(array("home/"=>"Home"));
		$this->layout_data['additional_tools'] = array(						
														"jquery-ui",
														"bootstrap",
														"bootstrap-hover-dropdown",
														"jquery-slimscroll",
														"boots",
														"font-awesome",
														"simple-line-icons" ,
													);

		$this->add_script(array("pages/tasks.css","agent_analytics.css"));
		$this->add_script(array("tasks.js" , "index.js","real-time.js","canvasjs.min.js") , "js");

        $this->register_plugins(array('fullcalendar2'));
		
		//$data[ 'products' ] = $this->model_product->find_count_active();
		
		
		//$profit_params = array();
		//$profit_params[ 'fields' ] = "SUM(order_total - order_discount) AS total";
		//$data[ 'profit' ] = $this->model_order->find_one_active($profit_params);
		
		//$data[ 'orders' ] = $this->model_order->find_count_active();
		
		//$params_today = array() ;
		//$params_today['where']['DATE(order_created_on)'] = date("Y-m-d") ;
		//$data[ 'today_orders' ] = $this->model_order->find_count_active($params_today);

        $data[ 'total_members' ] = $this->model_signup->get_total_members();
        $data[ 'unread_inquiry' ] = $this->model_inquiry->get_unread_inquiry();
        $data[ 'subscribe' ] = $this->model_subscribe->find_count();
        //$data[ 'total_company' ] = $this->model_company->get_total_company();

        // Get all calendar events
        $data['events'] = $this->model_admin_event->get_admin_event_list();
        // Get all records (total users, Desktop , mobile)
        $data['agent'] = $this->model_agent->get_records();
        //$data['subscribers_list'] = $this->model_subscribe->get_records();
        $data['inquiries'] = $this->model_inquiry->get_records();


		$data['config'] = $this->config->config;
		$this->load_view("dashboard",$data);
	}

	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */