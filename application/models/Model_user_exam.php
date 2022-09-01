<?
class Model_user_exam extends MY_Model {
    /**
     * user_exam MODEL
     *
     * @package     user_exam Model
     */

    protected $_table    = 'user_exam';
    protected $_field_prefix    = 'ue_';
    protected $_pk    = 'ue_id';
    protected $_status_field    = 'ue_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "ue_id,ue_status";

        $this->pagination_params['joins'][] = array(
            "table" => "product",
            "joint" => "product.product_id = user_exam.ue_post_id",
            // add left to get import records
            "type" => "left"
        );


        parent::__construct();
    }

    // User exam count only
    public function user_exam_count($oi_id=0, $userid=0, $position=0,$exam_list_id=0)
    {
        $params['fields'] = "ue_position";
        $params['where']['ue_order_item_id'] = $oi_id;
        $params['where']['ue_user_id'] = $userid;
        $params['where']['ue_exam_list_id'] = $exam_list_id;
        $params['where']['ue_position'] = $position;
        $result = $this->find_one($params);

        return $result['ue_position'];
    }

    public function get_user_slide_exam_report($oi_id=0, $exam_id=0,$userid=0, $exam_e_list_id)
    {
        $params['fields'] = "ue_exam_answer";
        $params['where']['ue_order_item_id'] = $oi_id;
        $params['where']['ue_exam_list_id'] = $exam_e_list_id;
        //$params['where']['ue_exam_id'] = $exam_id;
        $params['where']['ue_user_id'] = $userid;
        $result = $this->find_all($params);

        return $result;
    }

    // Get difference count exam (use in report)
    public function get_diff($exam_answers, $user_exam_answers)
    {
        $diff = array();
        foreach($exam_answers as $key=>$value):
            if($value!=$user_exam_answers[$key])
            {
                $diff[] = $value;
            }
        endforeach;

        return $diff;
    }


    /*
    * table             Table Name
    * Name              FIeld Name
    * label             Field Label / Textual Representation in form and DT headings
    * type              Field type : hidden, text, textarea, editor, etc etc. 
    *                                 Implementation in form_generator.php
    * type_dt           Type used by prepare_datatables method in controller to prepare DT value
    *                                 If left blank, prepare_datatable Will opt to use 'type'
    * type_filter_dt    Used by DT FILTER PREPRATION IN datatables.php
    * attributes        HTML Field Attributes
    * js_rules          Rules to be aplied in JS (form validation)
    * rules             Server side Validation. Supports CI Native rules

    * list_data         For dropdown etc, data in key-value pair that will populate dropdown 
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    * list_data_key     For dropdown etc, if you want to define list_data in CONTROLLER (public _list_data[$key]) list_data_key is the $key which identifies it
    *                   -----Incase list_data_key is not defined, it will look for field_name as a $key
    *                   -----USED IN ADMIN_CONTROLLER AND admin's database.php
    */
    public function get_fields( $specific_field = "" )
    {

        $fields = array(
        
              'ue_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'ue_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'ue_user_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'ue_user_id',
                     'label'   => 'User ID',
                     'type'   => 'text',
                     'type_dt'   => 'text',
                     'type_filter_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"10%"),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim'
                ),

              'ue_order_item_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'ue_order_item_id',
                     'label'   => 'Order Item ID',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'ue_exam_list_id'  => array(
                  'table'   => $this->_table,
                  'name'   => 'ue_exam_list_id',
                  'label'   => 'Exam Item ID',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array(),
                  'rules'   => 'required|htmlentities'
              ),
              'ue_exam_id'  => array(
                  'table'   => $this->_table,
                  'name'   => 'ue_exam_id',
                  'label'   => 'Exam ID',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array(),
                  'rules'   => 'required|htmlentities'
              ),
              'ue_position'  => array(
                  'table'   => $this->_table,
                  'name'   => 'ue_position',
                  'label'   => 'Position',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array(),
                  'rules'   => 'required|htmlentities'
              ),
              'ue_exam_answer'  => array(
                  'table'   => $this->_table,
                  'name'   => 'ue_exam_answer',
                  'label'   => 'Answer',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array(),
                  'rules'   => 'required|htmlentities'
              ),

              'ue_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'ue_status',
                     'label'   => 'Status?',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "user_exam_status" ,
                  'list_data' => array(
                      0 => "<span class=\"label label-default\">Inactive</span>" ,
                      1 =>  "<span class=\"label label-primary\">Active</span>"
                  ) ,
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),
              
            );
        
        if($specific_field)
            return $fields[ $specific_field ];
        else
            return $fields;
    }

}
?>