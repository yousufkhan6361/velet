<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Logout extends MY_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */

	public function __construct() {
		parent::__construct();
	}

	public function index() {
		$this->session->unset_userdata('logged_in');
		//$this->session->sess_destroy();
		redirect('/admin/login');
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
