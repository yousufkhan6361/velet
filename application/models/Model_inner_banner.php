<?
class Model_inner_banner extends MY_Model
{
    /**
     * TKD inner_banner MODEL
     *
     * @package     inner_banner Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'inner_banner';
    protected $_field_prefix = 'inner_banner_';
    protected $_pk = 'inner_banner_id';
    protected $_status_field = 'inner_banner_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "inner_banner_id,inner_banner_name,inner_banner_status";

        parent::__construct();
    }

    public function get_banner($id = 0)
    {
        $params['where']['inner_banner_id'] = $id;
        $params['where']['inner_banner_status'] = STATUS_ACTIVE;
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
        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(

            'inner_banner_id' => array(
                'table' => $this->_table,
                'name' => 'inner_banner_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

            /*'inner_banner_position' => array(
                   'table'   => $this->_table,
                   'name'   => 'inner_banner_position',
                   'label'   => 'Position',
                   'type'   => 'dropdown',
                   'list_data'    => array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5") ,
                   'attributes'   => array(),
                   'js_rules'   => '',
                   'rules'   => '',
                ),*/

            'inner_banner_name' => array(
                'table' => $this->_table,
                'name' => 'inner_banner_name',
                'label' => 'Name',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),
            // 'inner_banner_page' => array(
            //     'table' => $this->_table,
            //     'name' => 'inner_banner_page',
            //     'label' => 'Page',
            //     'type' => 'dropdown',
            //     'list_data'=>array(),
            //     'attributes' => array(),
            //     'js_rules' => 'required',
            //     'rules' => 'required|trim|htmlentities'
            // ),



            // 'inner_banner_image' => array(
            //     'table' => $this->_table,
            //     'name' => 'inner_banner_image',
            //     'label' => 'Image',
            //     'name_path' => 'inner_banner_image_path',
            //     'upload_config' => 'site_upload_inner_banner',
            //     'type' => 'fileupload',
            //     'type_dt' => 'image',
            //     'randomize' => true,
            //     'preview' => 'true',
            //     'attributes'   => array(
            //         'image_size_recommended'=>'1344px × 381px',
            //         'allow_ext'=>'png|jpeg|jpg',
            //     ),
            //     'dt_attributes' => array("width" => "10%"),
            //     'rules' => 'trim|htmlentities',
            //     'js_rules'=>$is_required_image
            // ),


            'inner_banner_status' => array(
                'table' => $this->_table,
                'name' => 'inner_banner_status',
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

        );

        if ($specific_field)
            return $fields[$specific_field];
        else
            return $fields;

    }

}

?>