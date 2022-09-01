<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Gallery_image extends MY_Controller {

	/**
	 * product_image page
	 *
	 * @package		TKD 
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        
		$_POST = $this->input->post(NULL, false);
	}
	
	public function upload_images($id=0)
	{
		global $confg;
		
		$id = intval($id);
		$class_name = $this->router->class;
		$model_name = 'model_'.$class_name ;
		$model_obj = $this->$model_name ;
		$pk = $model_obj->get_pk();
		$form_fields = $model_obj->bulk_image_fields();

		if(!$id)
			pre("Invalid ID");
		else
		{
			$foreign_model = "model_" . $form_fields[ 'foreign_key' ][ 'table' ] ;
			$foreign_obj = $this->$foreign_model ;
			$data = $foreign_obj->find_by_pk($id);
			if(!$data)
			{
				echo "Invalid Gallery" ;
				exit();
			}
		}

		$return = array();
		$ret_params = array();
		$ret_params['where'][ $form_fields[ 'foreign_key' ][ 'name' ] ] = $id;

		if($_POST && strlen($_FILES['gallery_image']['name']['pi_image']))
		{
			if( $this->bulk_validate(array($model_name)) )
			{
				// Validation Successful
				// Merge FILES field with POST DATA
				$user_data = $_POST[$class_name] + $_FILES[$class_name]['name'] ;

				$model_obj->set_attributes($user_data);

				$ret_params['where'][ $pk ] = $model_obj->save();
				if($ret_params['where'][ $pk ])
					$this->check_featured($id);

			}
			else
			{
				$return["files"][] = array("error"=>validation_errors());
			}
			
		}
		
		$return["files"] = $model_obj->get_images($ret_params);

		echo json_encode($return);

		exit();

	}

	public function delete_image($id=0, $token)
	{
		global $confg;
		
		$class_name = $this->router->class;
		$model_name = 'model_'.$class_name ;
		$model_obj = $this->$model_name ;
		$pk = $model_obj->get_pk();
		$form_fields = $model_obj->bulk_image_fields();

		$id = intval($id);
		if(!$id || !$token)
			return false;

		$rec = $model_obj->find_by_pk($id);
		if($token == $model_obj->img_salt($rec))
		{
			$deleted = $model_obj->delete_by_pk($id);
			if($deleted)
			{
				$img_path = $rec[ $form_fields['image_path']['name'] ] . $rec[ $form_fields['image']['name'] ] ;
				$thumb_path = $rec[ $form_fields['image_path']['name'] ] . $rec[ $form_fields['image_thumb']['name'] ] ;
				
				if(is_file($img_path))
					unlink($img_path);
				if(is_file($thumb_path))
					unlink($thumb_path);
			}
		}
		else
			echo "Invalid Request.";

		exit();

	}

	public function check_featured($pi_gallery_id=0)
	{
		$pi_gallery_id = intval($pi_gallery_id);

		if($pi_gallery_id)
		{
			$params['where']['pi_is_featured'] = STATUS_ACTIVE;
			$params['where']['pi_gallery_id'] = $pi_gallery_id ;
			$already_featured = $this->model_gallery_image->find_one($params);
			if(!$already_featured)
			{
				$this->model_gallery_image->autonomous_featured($pi_gallery_id);
			}
		}
	}

	public function featured_image($pi_gallery_id=0, $pi_id)
	{
		global $confg;

		$pi_id = intval($pi_id);
		$pi_gallery_id = intval($pi_gallery_id);
		
		$class_name = $this->router->class;
		$model_name = 'model_'.$class_name ;
		$model_obj = $this->$model_name ;
		$pk = $model_obj->get_pk();
		$form_fields = $model_obj->bulk_image_fields();

		if(!$pi_id || !$pi_gallery_id)
			return false;

		$rec = $model_obj->find_by_pk($pi_id);
		if($rec)
		{
			$params = array();
			$record = array();
			$params['where']['pi_gallery_id'] = $pi_gallery_id ;
			$record['pi_is_featured'] = STATUS_INACTIVE;
			$unFeatured = $model_obj->update_model($params , $record);
			
			$params = array();
			$record = array();
			$params['where']['pi_id'] = $pi_id ;
			$record['pi_is_featured'] = STATUS_ACTIVE;
			$unFeatured = $model_obj->update_model($params , $record);
			
		}
		else
			echo "Invalid Request.";

		$this->upload_images($rec['pi_gallery_id']);
		exit();

	}

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
