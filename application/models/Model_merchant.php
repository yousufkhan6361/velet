<?
class Model_merchant extends MY_Model
{
    /**
     * TKD merchant MODEL
     *
     * @package     merchant Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'merchant';
    protected $_field_prefix = 'merchant_';
    protected $_pk = 'merchant_id';
    protected $_status_field = 'merchant_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "merchant_id,merchant_name,,merchant_status";

        parent::__construct();
    }

    public function get_page_merchant($page='')
    {
        // Set params
        $params['fields'] = 'merchant_page,merchant_name,,merchant_status';
        $params['where']['merchant_page'] = $page;
        return $this->model_merchant->find_one_active($params);

    }

    // Get categories with total number of post
    public function get_recent_categories()
    {
        $params['fields'] = "merchant_id,merchant_name,merchant_slug,(select count(*) from yt_blog where merchant = merchant_id) as total_post";
        return $this->find_all_active($params);
    }

    // Check slug exists or not
    public function find_by_slug($slug)
    {
        $param['where']['merchant_slug'] = $slug;
        // JOIN
        $param['joins'][] = array(
            "table"=>"blog" ,
            "joint"=>"blog.merchant = merchant.merchant_id",
        );

        // Query

        $result = $this->find_all_active($param);
        // Return result;

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
    public function get_fields( $specific_field = "" )
    {

        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(
        
              'merchant_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'merchant_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              // 'merchant_name' => array(
              //        'table'   => $this->_table,
              //        'name'   => 'merchant_name',
              //        'label'   => 'Category Name',
              //        'type'   => 'text',
              //        'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
              //        'js_rules'   => 'required',
              //        'rules'   => 'required|trim|htmlentities'
              //     ),

              'merchant_paypal' => array(
                'table' => $this->_table,
                'name' => 'merchant_paypal',
                'label' => 'Paypal Merchant ?',
                'type' => 'switch',
                'type_dt' => 'dropdown',
                'type_filter_dt' => 'dropdown',
                'list_data_key' => "merchant_paypal" ,
                'list_data' => array(),
                'default' => '1',
                'attributes' => array(),
                'dt_attributes' => array("width" => "7%"),
                'rules' => 'trim'
            ),

            'merchant_stripe' => array(
                'table' => $this->_table,
                'name' => 'merchant_stripe',
                'label' => 'Stripe Merchant ?',
                'type' => 'switch',
                'type_dt' => 'dropdown',
                'type_filter_dt' => 'dropdown',
                'list_data_key' => "merchant_stripe" ,
                'list_data' => array(),
                'default' => '1',
                'attributes' => array(),
                'dt_attributes' => array("width" => "7%"),
                'rules' => 'trim'
            ),

              

              // 'merchant_status' => array(
              //        'table'   => $this->_table,
              //        'name'   => 'merchant_status',
              //        'label'   => 'Status?',
              //        'type'   => 'switch',
              //        'type_dt'   => 'dropdown',
              //        'type_filter_dt' => 'dropdown',
              //        'list_data_key' => "merchant_status" ,
              //        'list_data' => array(),
              //        'default'   => '1',
              //        'attributes'   => array(),
              //        'dt_attributes'   => array("width"=>"7%"),
              //        'rules'   => 'trim'
              //      ),

        );

        if ($specific_field)
            return $fields[$specific_field];
        else
            return $fields;

    }

}

?>