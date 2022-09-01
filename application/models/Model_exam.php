<?

class Model_exam extends MY_Model
{
    /**
     * @package     exam Model
     * @version     1.0
     * @since       2018
     */

    protected $_table = 'exam';
    protected $_field_prefix = 'exam_';
    protected $_pk = 'exam_id';
    protected $_status_field = 'exam_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "exam_id,product_name,exam_status";
        $this->pagination_params['joins'][] = array(
            "table"=>"product" ,
            "joint"=>"product.product_id = exam.exam_product_id",
            // add left to get import records
            "type"=>"left"
        );

        parent::__construct();
    }

    public function get_exam_slide_answers($product_id = 0, $exam_e_list_id)
    {
        $params['fields'] = "exam_answer";
        $params['where']['exam_product_id'] = $product_id;
        $params['where']['exam_e_list_id'] = $exam_e_list_id;
        $result = $this->find_all($params);

        return $result;
    }

    public function get_exams()
    {
        // Set params
        return $this->model_exam->find_all_active();

    }

    // Get course exam by module ID
    public function get_module_exams($module_id)
    {
        // Set params
        $params['where']['exam_module_id'] = $module_id;
        return $this->model_exam->find_all_active($params);

    }

    // Get exam info
    /*public function get_exam_info($exam_id)
    {
        // Set params
        $params['where']['exam_id'] = $exam_id;
        // Query
        $result = $this->find_one_active($params);
        return $result;

    }*/

    // 2nd and 3rd arguments are optional
    public function get_exam_info($product_id = 0, $exam_id = 0,$exam_e_list_id=0)
    {
        // Set params
        $params['where']['exam_product_id'] = $product_id;
        $params['where']['exam_e_list_id'] = $exam_e_list_id;
        if($exam_id>0){
            $params['where']['exam_id > '] = $exam_id;
        }
        $params['order'] = "exam_id ASC";
        // Query
        $result = $this->find_one_active($params);
        return $result;

    }

    // Get all module exam count by ID
    /*public function exam_count($id)
    {
        // Set params
        $params['where']['exam_module_id'] = $id;
        $result = $this->find_count_active($params);
        return $result;

    }*/

    public function exam_count($product_id= 0, $exam_e_list_id=0 )
    {
        // Set params
        $params['where']['exam_product_id'] = $product_id;
        $params['where']['exam_e_list_id'] = $exam_e_list_id;
        $result = $this->find_count_active($params);
        return $result;

    }

    // Get total exam count + user answer count (execute only index)
    public function exam_counter($module_id)
    {
        $user_id = $this->session->userdata('rca_logged_in')['id'];
        // Set params
        $params['fields'] = "(select count(exam_module_id) from ".$this->db->dbprefix('exam')." where exam_module_id = $module_id) as module_section_exam_count,
        (select count(user_slide_exam_user_id) from ".$this->db->dbprefix('user_slide_exam')." where user_slide_exam_module_id = $module_id and user_slide_exam_user_id=$user_id and user_slide_exam_status=1) as user_slide_attempt_count";
        $params['where']['exam_module_id'] = $module_id;
        $params['group'] = "exam_module_id";
        $result = $this->find_all_active($params);
        return array($result[0]['module_section_exam_count'],$result[0]['user_slide_attempt_count']);

    }

    // Get first exam PK id
    public function get_first_exam_id($module_id)
    {
        // Set params
        $params['fields'] = "exam_id";
        $params['where']['exam_module_id'] = $module_id;
        $params['limit'] = 1;
        $result = $this->find_one_active($params);
        return $result;

    }

    // Check Course ID(skip), module ID and section ID exist
    public function check_ids($module_id,$exam_id)
    {
        // Set params
        $params['where']['exam_module_id'] = $module_id;
        $params['where']['exam_id'] = $exam_id;
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

            'exam_id' => array(
                'table' => $this->_table,
                'name' => 'exam_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

            'exam_question' => array(
                'table' => $this->_table,
                'name' => 'exam_question',
                'label' => 'Question',
                //'type' => 'textarea',
                'type' => 'editor',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),
            'exam_product_id' => array(
                'table' => $this->_table,
                'name' => 'exam_product_id',
                'label' => 'Product',
                'type' => 'dropdown',
                'attributes'   => array("class"=>"ajax-populate",
                    "additional" => 'data-target="exam-exam_e_list_id" '
                ),
                'type_filter_dt'   => 'dropdown',
                //'type' => ($is_required_image)?'select2':'hidden',
                /*'attributes' => array(
                    'width'=>'350px',
                    'title'=>'Search Course Module',
                    'url'=>g('admin_base_url') . 'module/search',
                    'field_name'=>'exam[exam_module_id]'
                ),*/
                'js_rules' => array('required'),
                'rules' => 'required|trim'
            ),
            'exam_e_list_id' => array(
                'table' => $this->_table,
                'name' => 'exam_e_list_id',
                'label' => 'Exam List',
                'type' => 'dropdown',
                'type_dt'   => 'text',
                'type_filter_dt'   => 'dropdown',
                'attributes'   => array("class"=>"ajax-populate",
                    "additional" => ' 
                                                            data-populate-uri="get_list"
                                                            data-uri="exam"
                                                            data-dd_key="exam_list_id"
                                                            data-dd_value="exam_list_title"'
                ),
                //'type' => ($is_required_image)?'select2':'hidden',
                /*'attributes' => array(
                    'width'=>'350px',
                    'title'=>'Search Course Module',
                    'url'=>g('admin_base_url') . 'module/search',
                    'field_name'=>'exam[exam_module_id]'
                ),*/
                'js_rules' => array('required'),
                'rules' => 'required|trim'
            ),

            'exam_option_1' => array(
                'table' => $this->_table,
                'name' => 'exam_option_1',
                'label' => 'Option # 1',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),
            'exam_option_2' => array(
                'table' => $this->_table,
                'name' => 'exam_option_2',
                'label' => 'Option # 2',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),
            'exam_option_3' => array(
                'table' => $this->_table,
                'name' => 'exam_option_3',
                'label' => 'Option # 3',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim|htmlentities|required'
            ),
            'exam_option_4' => array(
                'table' => $this->_table,
                'name' => 'exam_option_4',
                'label' => 'Option # 4',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim|htmlentities|required'
            ),
            /*'exam_option_5' => array(
                'table' => $this->_table,
                'name' => 'exam_option_5',
                'label' => 'Option # 5',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim|htmlentities|required'
            ),*/
            'exam_answer' => array(
                'table' => $this->_table,
                'name' => 'exam_answer',
                'label' => 'Answer',
                'type' => 'dropdown',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),
            'exam_answer_description' => array(
                'table' => $this->_table,
                'name' => 'exam_answer_description',
                'label' => 'Answer Desc',
                'type' => 'editor',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),
            /*'exam_min_correct' => array(
                'table' => $this->_table,
                'name' => 'exam_min_correct',
                'label' => 'Correct answers',
                'type' => 'number',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),*/

            /*'exam_user_id' => array(
                'table' => $this->_table,
                'name' => 'exam_user_id',
                'label' => 'User ID',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),*/

            'exam_status' => array(
                'table' => $this->_table,
                'name' => 'exam_status',
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
            'exam_createdon'  => array(
                'table'   => $this->_table,
                'name'   => 'exam_createdon',
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