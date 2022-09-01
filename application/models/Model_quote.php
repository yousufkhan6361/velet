<?
class Model_quote extends MY_Model {
  
    /**
     * quote MODEL
     *
     * @package     quote Model
     * 
     * @version     1.0
     * @since       2017 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'quote';
    protected $_field_prefix    = 'quote_';
    protected $_pk    = 'quote_id';
    protected $_status_field    = 'quote_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "
        quote_id,
        quote_fullname,
        quote_email,
        quote_createdon,
        quote_status";
        parent::__construct();
    }

    // Get unread inquiries
    public function get_unread_quote()
    {
        // Set params
        $params['where_string'] = " quote_status!=0";
        $result = $this->find_count($params);
        return $result;
    }

    public function get_records()
    {
        $params['fields'] = "MONTH(quote_createdon) as month , COUNT(quote_createdon) as count";
        $params['where_string'] = "quote_createdon >= NOW() - INTERVAL 1 YEAR AND YEAR(quote_createdon) = YEAR(CURRENT_DATE())";
        $params['group'] = "MONTH(quote_createdon)";

        $result = $this->find_all($params);
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
    public function get_fields( $specific_field = "" )
    {

        $fields = array(
        
              'quote_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'quote_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),
              // 'quote_firstname' => array(
              //    'table'   => $this->_table,
              //    'name'   => 'quote_firstname',
              //    'label'   => 'Fisrt Name',
              //    'type'   => 'text',
              //    'attributes'   => array(),
              //    'js_rules'   => '',
              //    'rules'   => 'strtolower|trim|htmlentities|min_length[2]|max_length[10]'
              // ),
              // 'quote_lastname' => array(
              //    'table'   => $this->_table,
              //    'name'   => 'quote_lastname',
              //    'label'   => 'Last Name',
              //    'type'   => 'text',
              //    'attributes'   => array(),
              //    'js_rules'   => '',
              //    'rules'   => 'strtolower|trim|htmlentities|min_length[2]|max_length[10]'
              // ),
              /*'quote_comments' => array(
                     'table'   => $this->_table,
                     'name'   => 'quote_comments',
                     'label'   => 'Message',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim'
                  ),*/
              'quote_fullname' => array(
                 'table'   => $this->_table,
                 'name'   => 'quote_fullname',
                 'label'   => 'Name',
                 'type'   => 'text',
                 'attributes'   => array(),
                 'js_rules'   => '',
                 'rules'   => 'required|strtolower|trim|htmlentities|min_length[2]|max_length[25]'
              ),

              'quote_email' => array(
                     'table'   => $this->_table,
                     'name'   => 'quote_email',
                     'label'   => 'Email',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|valid_email|strtolower|trim|htmlentities'
                  ),
              // 'quote_inche' => array(
              //        'table'   => $this->_table,
              //        'name'   => 'quote_inche',
              //        'label'   => 'Inches',
              //        'type'   => 'text',
              //        'attributes'   => array(),
              //        'js_rules'   => '',
              //        'rules'   => 'required'
              //     ),
              // 'quote_phone' => array(
              //        'table'   => $this->_table,
              //        'name'   => 'quote_phone',
              //        'label'   => 'Phone',
              //        'type'   => 'text',
              //        'attributes'   => array(),
              //        'js_rules'   => '',
              //        'rules'   => 'required|trim|htmlentities|regex_match[/^[\d\(\)\-+ ]+$/]'
              //     ),
              // 'quote_address' => array(
              //        'table'   => $this->_table,
              //        'name'   => 'quote_address',
              //        'label'   => 'Address',
              //        'type'   => 'text',
              //        'attributes'   => array(),
              //        'js_rules'   => '',
              //        'rules'   => 'required|trim'
              //     ),
              /*
              'quote_city' => array(
                     'table'   => $this->_table,
                     'name'   => 'quote_city',
                     'label'   => 'City',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim'
                  ),
              'quote_state' => array(
                     'table'   => $this->_table,
                     'name'   => 'quote_state',
                     'label'   => 'State',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim'
                  ),
              'quote_zip' => array(
                     'table'   => $this->_table,
                     'name'   => 'quote_zip',
                     'label'   => 'Zip',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim'
                  ),*/
             /* 'quote_subject' => array(
                'table'   => $this->_table,
                'name'   => 'quote_subject',
                'label'   => 'Subject',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'required|trim'
            ),*/
              /*'quote_about' => array(
                     'table'   => $this->_table,
                     'name'   => 'quote_about',
                     'label'   => 'About Us',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                  ),*/



              /*'quote_community' => array(
                     'table'   => $this->_table,
                     'name'   => 'quote_community',
                     'label'   => 'Community',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => '|trim'
                  ),*/

              'quote_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'quote_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt'   => 'dropdown',
                     'list_data' => array( 
                                        0 => "<span class=\"label label-danger\">Read</span>" ,
                                        1 =>  "<span class=\"label label-primary\">Unread</span>"  
                                    ) ,
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),


            'quote_createdon' => array(
                'table'   => $this->_table,
                'name'   => 'quote_createdon',
                'label'   => 'Created',
                'type'   => 'none',
                'type_dt'   => 'text',
                'attributes'   => array(),
                'dt_attributes'   => array("width"=>"10%"),
                'js_rules'   => '',
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