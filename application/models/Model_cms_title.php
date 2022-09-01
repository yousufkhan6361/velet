<?

class Model_cms_title extends MY_Model
{


    protected $_table = 'cms_title';
    protected $_field_prefix = 'cms_title_';
    protected $_pk = 'cms_title_id';
    protected $_status_field = 'cms_title_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // $this->type = (intval($this->uri->segment(4)) == 2 ? 'editor' : 'hidden');
        // $this->file = (intval($this->uri->segment(4)) == 2 ? 'fileupload' : 'hidden');

        // Call the Model constructor
        $this->pagination_params['fields'] = "cms_title_id,cms_title_page,cms_title_text,cms_title_status";


        parent::__construct();
    }

public function get_page($id = 0)
    {
        $param['where']['cms_title_status'] = '1';

        if (intval($id) > 0)
            $param['where']['cms_title_id'] = intval($id);

        $param['fields'] = "cms_title_id,cms_title_page,cms_title_name,cms_title_title,cms_title_other_content,cms_title_content,
        cms_title_image,cms_title_image_path,cms_title_button_label,cms_title_button_url,cms_title_status";

        $param['order'] = 'cms_title_id DESC';

        return $this->model_cms_title->find_one_active($param);
    }

    // Get all records by Page
    public function find_all_by_page($page)
    {
        $params['where']['cms_title_page'] = $page;
        $result = $this->find_all_active();

        return $result;
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
    public function get_fields($specific_field = "")
    {
        // Allow images
        $image_segment = array(3);
        $segment_id = $this->uri->segment(4);

        // Use only in SUBSCRIBE PAGE
        //$image_status = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)==18))?'hidden':'fileupload';

        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';
        
  
        $fields['cms_title_id'] = array(
                'table' => $this->_table,
                'name' => 'cms_title_id',
                'label' => 'ID',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            );


            $fields['cms_title_page'] = array(
                'table' => $this->_table,
                'name' => 'cms_title_page',
                'label' => 'Page',
                'type' => 'dropdown',
                'attributes' => array(),
                'list_data'=>array(
                    'home'=>'Home'
                ),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            );
            $fields['cms_title_text'] = array(
                'table' => $this->_table,
                'name' => 'cms_title_text',
                'label' => 'Text',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            );



             $fields['cms_title_status'] = array(
                'table' => $this->_table,
                'name' => 'cms_title_status',
                'label' => 'Status',
                'type' => 'hidden',
                'type_dt' => 'dropdown',
                'type_filter_dt' => 'dropdown',
                'list_data_key' => "cms_title_status",
                'list_data' => array(),
                'default' => '1',
                'attributes' => array(),
                'dt_attributes' => array("width" => "7%"),
                'rules' => 'trim'
            );

        if ($specific_field)
            return $fields[$specific_field];
        else
            return $fields;
    }

}

?>