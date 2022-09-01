<?

class Model_exam_list extends MY_Model
{
    /**
     * @package     exam_list Model
     * @version     1.0
     * @since       2018
     */

    protected $_table = 'exam_list';
    protected $_field_prefix = 'exam_list_';
    protected $_pk = 'exam_list_id';
    protected $_status_field = 'exam_list_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "exam_list_id,exam_list_title,product_name,exam_list_status";
        $this->pagination_params['joins'][] = array(
            "table"=>"product" ,
            "joint"=>"product.product_id = exam_list.exam_list_product_id",
            // add left to get import records
            "type"=>"left"
        );

        parent::__construct();
    }

    public function get_product_exam($product_id = 0)
    {
        $params['fields'] = "*,(SELECT COUNT(*) FROM cpje_exam WHERE exam_product_id=exam_list_product_id AND 
        exam_e_list_id=exam_list_id)  as exam_count";
        $params['where']['exam_list_product_id'] = $product_id;

        $result = $this->find_all_active($params);

        return $result;
    }

    public function get_exam_list_slide_answers($product_id = 0)
    {
        $params['fields'] = "exam_list_answer";
        $params['where']['exam_list_product_id'] = $product_id;
        $result = $this->find_all($params);

        return $result;
    }

    public function get_exam_lists()
    {
        // Set params
        return $this->model_exam_list->find_all_active();

    }

    // Get course exam_list by module ID
    public function get_module_exam_lists($module_id)
    {
        // Set params
        $params['where']['exam_list_module_id'] = $module_id;
        return $this->model_exam_list->find_all_active($params);

    }

    // Get exam_list info
    /*public function get_exam_list_info($exam_list_id)
    {
        // Set params
        $params['where']['exam_list_id'] = $exam_list_id;
        // Query
        $result = $this->find_one_active($params);
        return $result;

    }*/

    // 2nd and 3rd arguments are optional
    public function get_exam_list_info($product_id = 0, $exam_list_id = 0)
    {
        // Set params
        $params['where']['exam_list_product_id'] = $product_id;
        if($exam_list_id>0){
            $params['where']['exam_list_id > '] = $exam_list_id;
        }
        // Query
        $result = $this->find_one_active($params);
        return $result;

    }

    // Get all module exam_list count by ID
    /*public function exam_list_count($id)
    {
        // Set params
        $params['where']['exam_list_module_id'] = $id;
        $result = $this->find_count_active($params);
        return $result;

    }*/

    public function exam_list_count($product_id= 0 )
    {
        // Set params
        $params['where']['exam_list_product_id'] = $product_id;
        $result = $this->find_count_active($params);
        return $result;

    }

    // Get total exam_list count + user answer count (execute only index)
    public function exam_list_counter($module_id)
    {
        $user_id = $this->session->userdata('rca_logged_in')['id'];
        // Set params
        $params['fields'] = "(select count(exam_list_module_id) from ".$this->db->dbprefix('exam_list')." where exam_list_module_id = $module_id) as module_section_exam_list_count,
        (select count(user_slide_exam_list_user_id) from ".$this->db->dbprefix('user_slide_exam_list')." where user_slide_exam_list_module_id = $module_id and user_slide_exam_list_user_id=$user_id and user_slide_exam_list_status=1) as user_slide_attempt_count";
        $params['where']['exam_list_module_id'] = $module_id;
        $params['group'] = "exam_list_module_id";
        $result = $this->find_all_active($params);
        return array($result[0]['module_section_exam_list_count'],$result[0]['user_slide_attempt_count']);

    }

    // Get first exam_list PK id
    public function get_first_exam_list_id($module_id)
    {
        // Set params
        $params['fields'] = "exam_list_id";
        $params['where']['exam_list_module_id'] = $module_id;
        $params['limit'] = 1;
        $result = $this->find_one_active($params);
        return $result;

    }

    // Check Course ID(skip), module ID and section ID exist
    public function check_ids($module_id,$exam_list_id)
    {
        // Set params
        $params['where']['exam_list_module_id'] = $module_id;
        $params['where']['exam_list_id'] = $exam_list_id;
        $params['limit'] = 1;
        $result = $this->find_one_active($params);
        return $result;

    }

    /*
    * table       Table Name
    * Name        FIeld Name
    * label       Field Label / Textual Representation in form and DT headings
    * type        Field type : hidden, text, textarea, editor, etc etc. 
    *                           Implementation in form_generator.php
    * type_dt     Type used by prepare_datatables method in controller to prepare DT value
    *                           If left blank, prepare_datatable Will opt to use 'type'
    * attributes  HTML Field Attributes
    * js_rules    Rules to be aplied in JS (form validation)
    * rules       Server side Validation. Supports CI Native rules
    */
    public function get_fields($specific_field = "")
    {
        // Use when edit
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(

            'exam_list_id' => array(
                'table' => $this->_table,
                'name' => 'exam_list_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

            'exam_list_title' => array(
                'table' => $this->_table,
                'name' => 'exam_list_title',
                'label' => 'List Title',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),


            'exam_list_product_id' => array(
                'table' => $this->_table,
                'name' => 'exam_list_product_id',
                'label' => 'Product',
                'type' => 'dropdown',
                //'type' => ($is_required_image)?'select2':'hidden',
                /*'attributes' => array(
                    'width'=>'350px',
                    'title'=>'Search Course Module',
                    'url'=>g('admin_base_url') . 'module/search',
                    'field_name'=>'exam_list[exam_list_module_id]'
                ),*/
                'js_rules' => array('required'),
                'rules' => 'required|trim'
            ),
            'exam_list_status' => array(
                'table' => $this->_table,
                'name' => 'exam_list_status',
                'label' => 'Status?',
                'type' => 'switch',
                'type_dt' => 'switch',
                'type_filter_dt' => 'dropdown',
                'list_data' => array(),
                'default' => '1',
                'attributes' => array(),
                'dt_attributes' => array("width" => "7%"),
                'rules' => 'trim'
            ),
            'exam_list_createdon'  => array(
                'table'   => $this->_table,
                'name'   => 'exam_list_createdon',
                'label'   => 'Created',
                'type'   => 'none',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),

            'product_name'  => array(
                'table'   => $this->_table,
                'name'   => 'product_name',
                'label'   => 'Product',
                'type'   => 'none',
                'attributes'   => array(),
                'rules'   => 'trim'
            ),
        );

        if ($specific_field)
            return $fields[$specific_field];
        else
            return $fields;

    }

}

?>