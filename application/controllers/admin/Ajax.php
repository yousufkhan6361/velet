<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');
class Ajax extends MY_Controller {

	/**
	 * ajax page
	 *
	 * @package		ajax
	 * 
	 * @version		1.0 -- Robust , Advanced And More Frustating...
	 * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();

		$_POST = $this->input->post(NULL, false);
	}

	public function populate()
	{
		// Popluated LISTDATA in constructor
		$model = "model_" . $_POST['search_model'];
		$model_obj = $this->{$model};
		$pk = $model_obj->get_pk();
		$dd_key = $_POST['dd_key'] ? $_POST['dd_key'] : $pk ;
		$dd_value = $_POST['dd_value'] ;

		$params[ 'where' ][ $_POST['search_key'] ] = $_POST['search_val'] ;
		$params[ 'fields' ] = "$dd_value, $dd_key";
		if( $_POST[ 'search_model_relation' ] )
		{
			$relation = $model_obj->relations[ $_POST['search_model_relation'] ] ;

			$params['joins'][] = array(
										"table" => $_POST['search_model_relation'],
										"joint" => $relation['own_key'] . "=" . $pk,
									);
		}

		$data = $model_obj->find_all_active($params,"");
		
		if(is_array($data))
			end_script(json_encode($data));
	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
