<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Login extends MY_Controller {

	/**
	 * Login page
	 *
	 * @package		Login
	 * 
	 * @version		2.0 -- Robust , Advanced And More Frustating...
	 * @since		Version 2.0 2014
	 */

	public function __construct() {

		parent::__construct();

		$session = $this->session->userdata('logged_in');
		if ($session && $session['is_admin'])
		{
			if( $_GET['redirect_url'] )
				redirect( urldecode( $_GET['redirect_url'] ) );
			else
				redirect("/admin");
		}
		$this->admin_dir = "admin/" . $this->router->class;
	}

	public function index() {

        global $config;
		$data['logo'] = $this->model_logo->find_all_active();
		$this->layout = "admin/admin_plain";
        $user_data['login'] = array();
		$user_data['login'] = $this->input->post(NULL, true);
		$this->layout_data['css_files'] = array(
											"pages/login.css",
											"plugins.css",
											"components.css",
											"layout.css", 
											"themes/default.css", 
											"custom.css",
											"plugins.css",
										);
		$this->layout_data['js_files'] = array(
											"metronic.js",
											"layout.js",
											"demo.js",
											"login.js",
											"tkd_script.js",
										);
		if ($_POST) {
			
			$redirect = urldecode($_POST['redirect_url']) ;
			if(!$redirect)
				$redirect = $config['base_url'] . 'admin';
			
			if($this->model_user->login())
				redirect($redirect);
			else
				$data['error'] = "Invalid Credentials";
		}

		$data['user_input'] = $user_data['login'];
		$this->load_view("_form", $data);
	}


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
