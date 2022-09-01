<?
/**
 * Admin Controller Wrapper Class.
 *
 * @package		Admin Controller
 * @author
 * @version		1.0
 * @since		Version 1.0 2017
 * @comments	Please think of it as fun :P AND ENJOY
 */
class MY_Controller_Admin extends CI_Controller {
	private static $instance;

	/**
	 * Constructor
	 */
	protected $layout_data = array();
	protected $layout;
	// FOR Add methods, to prevent_return on Success
	public $prevent_return_on_success = false;
	public $dt_params = array();

	public function __construct() {

		global $config;
		parent::__construct();
		
		$config = $this->config->config;
		$this->session_data = $this->layout_data['session_data'] = $this->session->userdata('logged_in');
		$this->user_data = $this->session->userdata("logged_in");
		$this->chk_currency() ;
		$config['js_config']['ci_class'] = $config['ci_class'] = $this->router->class;
		$config['js_config']['ci_method'] = $config['ci_method'] = $this->router->method;
		$config['js_config']['ci_index_page'] = $config['ci_index_page'] = $config['ci_class'] ."_". $config['ci_method'];
		
		$this->layout_data['query_string'] = $_SERVER['QUERY_STRING'];
		$this->layout_data['additional_tools'] = array();
		
		if(!isset( $this->dt_params['paginate'] ))
			$this->dt_params['paginate'] = array();
		
		$this->dt_params['paginate']['class'] = $config['ci_class'];
		$this->dt_params['paginate']['uri'] = "paginate";
		$this->dt_params['paginate']['update_status_uri'] = "update_status";
		$this->layout_data['template_config'] = array ( 
			'show_toolbar' => true ,
		);
		$config['js_config']['paginate'] = $this->dt_params['paginate'];

	}


	//public function index($dt_params = array())
	public function index()
	{
		global $config;
		
		$class_name = $this->router->class;
		$model_name = "model_".$class_name;

		$model_obj = $this->$model_name ;
		//$pg_config['order_field'] = $model_obj->get_order_field_name();

		$this->layout_data['bread_crumbs'] = array(
												array(
													"home/"=>"Home" , 
													$class_name => humanize($class_name)
												)
											);

		$this->register_plugins( array(						
										"jquery-ui",
										"bootstrap",
										"bootstrap-hover-dropdown",
										"jquery-slimscroll",
										"uniform",
										"bootstrap-switch",
										"bootstrap-datepicker",
										"boots",
										"font-awesome",
										"simple-line-icons" ,
										"select2",
										"datatables",
										"bootbox",
										"bootstrap-toastr",

								));

		$this->add_script("pages/tasks.css");
		$this->add_script(array("table-ajax.js" , "datatable.js") , "js");

		$data['page_title_min'] = "Management";
		$data['page_title'] = $class_name;
		$data['class_name'] = $class_name;
		$data['model_name'] = $model_name;
		$data['model_obj'] = $model_obj;
		$data['model_fields'] = $model_obj->get_fields();
		$data['dt_params'] = $this->dt_params ;

		$data['model'] = "$model_name";
		$this->before_index_render($data);
		$this->load_view("datatable" , $data );
	}
	
	public function client_email ($to,$template,$title)
       {
           // debug($to);
           // debug($template);
           // debug($title,1);
        $this->load->library('email');
    
        $db_to = g("db.admin.email");
        $name = g('site_name');
        $send_to = $to;
        $message = $template;
        $this->email->from($db_to, $name);
        $this->email->to($send_to);
        $this->email->subject($title);
        $this->email->set_mailtype("html");
        $this->email->message($message);
        return $this->email->send();
    }

	public function paginate($dt_params = array())
	{
		global $config;
		$params = array();
		$pg_request = $_POST;

		$class_name = $this->router->class;
		$model_name = "model_".$class_name;
		$model_obj = $this->$model_name ;

		$params = $model_obj->pagination_params;
        if(!isset($params['order'])){
            $sort_col = $pg_request['order'][0]['column'] ;

            if($sort_col!==null)
            {
                $sort_type = $pg_request['order'][0]['dir'] ;
                $params['order'] = $sort_col ." ".$sort_type;
            }
        }
		


		$length = intval($pg_request['length']);

		$model_obj->_per_page = $length ? $length : $model_obj->_per_page;
		
		$records = $model_obj->pagination_query($params);

		// $dt_params['order_field'] = $model_obj->get_order_field_name();
		if(is_array($records['data']))
			$data = $this->prepare_datatable($records['data']);

		$dt_record = array();
		$dt_record["data"] = $data; 
		$dt_record["draw"] = $pg_request["draw"]; 
		$dt_record["recordsTotal"] = $records["count"]; 
		$dt_record["recordsFiltered"] = $records["count"]; 
		echo json_encode($dt_record); 

		exit();
		
	}


	public function get_mysqli() { 
	$db = (array)get_instance()->db;
	return mysqli_connect('localhost', $db['username'], $db['password'], $db['database']);
	}

	public function prepare_datatable($record,$dt_params=array()) {
		
		global $config;
		$class = $this->router->class ;
		
		$model_name = "model_".$class;
		$model_obj = $this->$model_name ;
		$model_fields = $model_obj->get_fields();
		$model_pk = $model_obj->get_pk();
		
		if(!array_filled($dt_params))
			$dt_params = $this->dt_params;

		// If Record is an array. - Avoid annoying foreach warnings
		if(is_array($record))
		{
			$dt_row = array();
			// Start Record Parsing .... Watt
			foreach ($record as $row_key => $row) 
			{
				$table_data = array();

				$dt_row[ $row_key ] = array() ;

				$field_key = 0 ;
				// Prepare Data Fields
				foreach ($row as $field => $value) {

					// Dont need to show ordering field in DT
					/*if(!trim($field) || $field==$model_obj->get_order_field_name)
						continue;*/
					

					$value = mysqli_real_escape_string($this->get_mysqli(),$value);
					$field_attr = $model_fields[ $field ];
					$field_type = (isset($field_attr['type_dt'])) ? $field_attr['type_dt'] : $field_attr['type'] ;

					//  IF Field is PK, generate checkbox for MULTIPLE ROW SELECTION
					if($model_pk == $field)
					{
						// Do PK related types
						$itemId = intval($value) ;
						$dt_row[ $row_key ][ $field_key ] = '<input type="checkbox" value="'.$itemId.'" name="selected['.$model_pk.'][]">' ;
						$field_key++ ;
					}

					switch( $field_type )
					{
						case 'text':
						case 'textarea':
						case 'label':
						case 'label_custom':
						case 'editor':
							$value = html_entity_decode(strip_tags($value));
							$value = truncate($value,256);
							# code...
							break;
						
						case 'image':
							$image_url = $value ? $config['base_url'].$value : $config['image_not_found'] ;
							$value = '<img src="' . $image_url .'" style="max-height:30px;"/>' ;
							break;
						
						case 'switch':
							$list_data = (isset($field_attr['list_data']))?$field_attr['list_data']:array();
							if(!array_filled($list_data))
							{
								$list_data = array( 
	                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"  ,
	                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,  
	                                    ) ;
							}
							$value = $list_data[$value] ;
							break;
						case 'dropdown':
							$list_data = $field_attr['list_data'];
							if(!array_filled($list_data))
							{
								$list_data_key = (isset($field_attr['list_data_key'])) ? $field_attr['list_data_key'] : $field ;
								$list_data = $this->_list_data[$list_data_key];
							}
							$value = $list_data[$value] ;
							break;
						
						case 'hidden':
							continue;
							break;
					}

					$dt_row[ $row_key ][ $field_key ] = $value ;

					$field_key++ ;

				} // End - Data Fields Prep

                $delete_button ="";
                $edit_button ="";
                $order_field ="";

				// DELETE Button
				if((isset($dt_params['action']['show_delete'])) && ($dt_params['action']['show_delete']))
					$delete_button = '<button title="Delete" class="btn_delete_product btn btn-icon-only red"'.
										' data-model="model_'.$class.'" data-pk="'.$itemId.'"  >'.
									 '<i class="icon-trash "></i></button>';
				
				// EDIT Button
				if((isset($dt_params['action']['show_edit'])) && ($dt_params['action']['show_edit']))
					$edit_button = '<a title="Edit" href="'.$config['admin_base_url'].$class.'/add/'.$itemId.'/"'.
										' target="_blank"><button class="btn btn-icon-only yellow" '.
										'data-model="model_'.$class.'" data-pk="'.$itemId.'" '.
									'>'.
									'<i class="fa fa-edit"></i></button></a>';
				
				// ORDER FIELD- HIDDEN
				if((isset($dt_params['action']['order_field'])) && ($dt_params['action']['order_field']))
					//$order_field = '<input type="hidden" class="order_field_val" value="'.$row[$pg_config['order_field']].'" data-item-id="'.$itemId.'">';
					$order_field = '<input type="hidden" class="order_field_val" value="'.''.'" data-item-id="'.$itemId.'">';

				// VIEW BUTTON
				if((isset($dt_params['action']['show_view'])) && ($dt_params['action']['show_view']))
					$edit_button = '<button title="View" data-href="'.$config['admin_base_url'].$class.'/ajax_view/'.$itemId.'/" class="btn-xs btn btn_view_product btn-primary" data-pk="'.$itemId.'"><i class="icon-picture"></i></button>';
				
				$extra_buttons = '' ;
				
				// If Controller Has EXTRA BUTTONS defined , render them as well.
				if(array_filled($dt_params['action']['extra']))
				{
					foreach ($dt_params['action']['extra'] as $btn) {
						$extra_buttons .= sprintf($btn,$itemId) ;
					}
				} // End - IF extra_buttons

				if(!$dt_params['action']['hide'])
					$dt_row[ $row_key ][ $field_key ] = $edit_button . $delete_button . $extra_buttons . $order_field ;

			} // End Record Parsing...

		} // End if - Record is array

		return $dt_row;
	}

	public function configure_add_page()
	{
		$this->add_script(array( "jquery.validate.min.js") , "js" );
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
								));

		# code...
	}

	public function add($id=0 , $data = array()) {

		global $config;
		$id = intval($id);
		$this->configure_add_page();
		$class_name = $this->router->class;
		$model_name = 'model_'.$class_name ;
		$model_obj = $this->$model_name ;
		$form_fields = $model_obj->get_fields();
		
		// Prepare models used in this action
		$model_array = array();
		//$model_array = $this->_extra_models_add;
		$model_array[] = $model_name;
		
		$this->_validation_models_add[] = $model_name;
		

		$pk = $model_obj->get_pk() ;

		if($id)
		{

			$params['where'][$pk] = $id;
			$this->form_data[$class_name] = $this->$model_name->find_one($params);
			
			// Load relation fields data
			$this->form_data['relation_data'] = $this->$model_name->get_relation_data($id);

			if(count($this->form_data[$class_name])==0)
			{
				redirect($this->admin_path."?msgtype=error&msg=404+-+Record+not+found.", 'refresh');
				exit();
			}
		}
	
		//$pg_config['order_field'] = $model_obj->get_order_field_name();


		$this->layout_data['bread_crumbs'] = array(
												array(
													"home/"=>"Home" , 
													$class_name => humanize($class_name),
													$class_name."/add/" => "Add ".humanize($class_name),
												)
											);

		$user_data = $this->input->post(NULL, true);

		$data['form_data'] = (isset($this->form_data))?$this->form_data:array();

		$data['user_input'] = (isset($user_data['login']))?$user_data['login']:array();

		if($_POST)
		{
			//debug($_POST);
			//debug($id);exit;
			//debug($_POST,1);
			if( $this->bulk_validate($this->_validation_models_add) )
			{
				// Validation Successful
				
				$user_data = $_POST[$class_name]  ;
			
				// Merge FILES field with POST DATA
				if( (isset($user_data)) && (is_array($user_data)) && (isset($_FILES[$class_name]['name'])))
					$user_data = $user_data + $_FILES[$class_name]['name'] ;
				

				$this->$model_name->set_attributes($user_data);

				$insertId = $this->$model_name->save();

				if($insertId)
				{
					$this->$model_name->update_relations($insertId);
					$this->afterSave($insertId , $this->$model_name);

					// Prevent Return From Parent Add Method(current), 
					// since we need to perform operations in Child Class's Method
					if($this->prevent_return_on_success)
						return $insertId;

					$this->add_redirect_success($insertId);
				}
				else
				{
					redirect($this->admin_path."?msgtype=error&msg=Couldnt Save Data.", 'refresh');
			 		exit();
				}
			}
			else
			{
				$data['error'] = validation_errors();
			}
			
		}
		
		$data['page_title_min'] = "Management";
		$data['page_title'] = $class_name;
		$data['class_name'] = $class_name;
		$data['model_name'] = $model_name;
		$data['model_obj'] = $model_obj;
		$data['form_fields'][$class_name] = $form_fields;
		$data['dt_params'] = $this->dt_params ;
		$data['id'] = $id; 

		$this->before_add_render($data);
		$this->load_view("_form", $data);

	}


	public function afterSave($insertId , $model)
	{
		return true ;
	}
	
	public function ajax_view($id=0) {
		 echo json_encode($this->get_view($id)) ;
	}

	public function get_view($id=0) {

		global $config;
		$result = array();
		$class_name = $this->router->class;
		$model_name = 'model_'.$class_name ;
		$model_obj = $this->$model_name ;
		$form_fields = $model_obj->get_fields();
		if($id)
		{
			$result['record'] = $this->$model_name->find_by_pk($id);
			$result['record'] = $this->$model_name->prepare_view_data($result['record']);
			if(!$result['record'] )
				$result['failure'] = "No Item Found";
				// Load relation fields data
			$relation_data = $this->$model_name->get_relation_data($id);
			if(array_filled($relation_data))
				$result['record']['relation_data'] = $relation_data;
		}
		else
		{
			$result['failure'] = "No Item Found";
		}
	
		return $result;

	}

	public function add_redirect_success($id)
	{
		switch($_POST['submit'])
		{
			case "SaveNEdit":
				$path = $this->admin_current.$id;
			break;
			case "SaveNNew":
				$path = $this->admin_current;
			break;
			default:
				$path = $this->admin_path;
			break;
		}
		redirect($path."?msgtype=success&msg=Record updated successfully.", 'refresh');
		return $id;
	}

	/*
	* Default Action to Bulk Delete from admin
	*/
	public function delete_selected() {

		$id_array = explode(",", rtrim($_POST['params']['pk'],","));
		
		foreach ($id_array as $id) {
			$_POST['params']['pk'] = intval($id);
			if(intval($id))
				$this->delete();
		}

	}

	// BeforeRender Hook to manipulate Overrides... for Add Method
	public function before_add_render(&$data)
	{
		// To access from Child Class
		return true;
	}

	// BeforeRender Hook to manipulate Overrides... for INdex Method
	public function before_index_render(&$data)
	{
		// To access from Child Class
		return true;
	}
	/*
	* Default Action to Delete
	*/
	public function delete() {

		$id = intval($_POST['params']['pk']);

		if($id){
			$model = $_POST['params']['model'];
			$model_obj = $this->{$model};
			$pk = $model_obj->get_pk();
			$status_field = $model_obj->get_status_field();
			$data[$status_field] = 2;
			
			if($this->router->class==$model){

				$this->db->where($pk, $id);
				$update = $this->db->update($model,$data); 
				if($update==true)
				echo "1";	

			}	
		}
		
	}

	/*
	* Default Action to Delete Permanently
	*/
	public function permanent_delete() {

		$id = intval($_POST['params']['pk']);

		if($id){
			$class_name = $this->router->class;
			$model_name = 'model_'.$class_name ;
			$model_obj = $this->$model_name ;
			return $model_obj->delete_by_pk($id);
		}
		
	}

	/*
	* Default Action to Update Record
	* Mostly to update Status
	*/
	public function update_status() {

		extract($_POST);
		if( array_filled($idList) && $model ){
			
			$updateVal = intval($updateVal);
			$model_obj = $this->{$model};
			$status_field = $model_obj->get_status_field();
			$pk = $model_obj->get_pk();
			if($status_field && $pk)
			{
				$record[$status_field] = $updateVal;
				$params['where_in'][$pk] = $idList;
				$ret['affected'] = $model_obj->update_model($params, $record) ;
				end_script( json_encode($ret) );

			}
		}
		
	}


	/*
	* Default Action to Update Record
	* Mostly to update Status
	*/
	public function update() {
		if(is_array($_POST['params']) && count($_POST['params'])){
			$model = $_POST['params']['model'];
			$pk = $_POST['params']['pk'];
			$val = $_POST['params']['val']==0?1:0;
			$field = $_POST['params']['field'];

			$data[$field] = $val;
			
			if($this->router->class==$model){
				$this->db->where($pk , $pk);
				$update = $this->db->update($model,$data); 
				if($update==true)echo 1;
				else echo 0;
			}	
		}
		
	}

	/*
	* Default Action to Reorder Objects. Requre DnD plugin in datatables
	*/
	public function reorder() {

		global $config;
		extract($_POST);
		$this->load->model(array($model));
		$effected = $this->$model->reorder_records($_POST) ;
		
		echo $effected;
		exit();

	}

	/*
	* Parse Records for Excel
	* $record MUST HAVE key : $records['data'], that  hold record
	*/
	public function parse_for_excel($records=array())
	{
		$data = $records['data'];
		if(array_filled($data))
		{
			if($data[0])
			{
				foreach ($data[0] as $heads => $value) {
					$records['headers'][] = $heads;
				}
			}
		}
		$records['heading'] = $records['heading'] ? $records['heading'] : $this->router->class;
		return $records;
	}

	/*
	* Default Admin Action to Export files to Excel
	* Export to Excel
	*/
	public function export_excel($params = array())
	{
		$model_name = "model_".$this->router->class;

		$this->load->model($model_name);
		$model_obj = $this->$model_name ;
		$model_obj->pagination_params ['limit'] = 1000000000;
		// Merge $params with child params
		$params += $model_obj->pagination_params ;
		$records = $model_obj->pagination_query($params);
		$data['records'] = $this->parse_for_excel($records);
		$data['filename'] = $this->router->class;

		$this->load_view("excel_export" , $data , false, false);
	}


}
?>