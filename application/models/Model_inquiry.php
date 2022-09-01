<?
class Model_inquiry extends MY_Model {
  
    /**
     * Inquiry MODEL
     *
     * @package     inquiry Model
     * 
     * @version     1.0
     * @since       2017 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'inquiry';
    protected $_field_prefix    = 'inquiry_';
    protected $_pk    = 'inquiry_id';
    protected $_status_field    = 'inquiry_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "
        inquiry_id,
        inquiry_fullname,
        inquiry_email,
        inquiry_createdon,
        inquiry_status";
        parent::__construct();
    }

    // Get unread inquiries
    public function get_unread_inquiry()
    {
        // Set params
        $params['where_string'] = " inquiry_status!=0";
        $result = $this->find_count($params);
        return $result;
    }

    public function get_records()
    {
        $params['fields'] = "MONTH(inquiry_createdon) as month , COUNT(inquiry_createdon) as count";
        $params['where_string'] = "inquiry_createdon >= NOW() - INTERVAL 1 YEAR AND YEAR(inquiry_createdon) = YEAR(CURRENT_DATE())";
        $params['group'] = "MONTH(inquiry_createdon)";

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
        
              'inquiry_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'inquiry_id',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),
              // 'inquiry_firstname' => array(
              //    'table'   => $this->_table,
              //    'name'   => 'inquiry_firstname',
              //    'label'   => 'Fisrt Name',
              //    'type'   => 'text',
              //    'attributes'   => array(),
              //    'js_rules'   => '',
              //    'rules'   => 'strtolower|trim|htmlentities|min_length[2]|max_length[10]'
              // ),
              // 'inquiry_lastname' => array(
              //    'table'   => $this->_table,
              //    'name'   => 'inquiry_lastname',
              //    'label'   => 'Last Name',
              //    'type'   => 'text',
              //    'attributes'   => array(),
              //    'js_rules'   => '',
              //    'rules'   => 'strtolower|trim|htmlentities|min_length[2]|max_length[10]'
              // ),
            'inquiry_fullname' => array(
                'table'   => $this->_table,
                'name'   => 'inquiry_fullname',
                'label'   => 'Name',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'required|strtolower|trim|htmlentities|min_length[2]|max_length[25]'
            ),

            'inquiry_email' => array(
                'table'   => $this->_table,
                'name'   => 'inquiry_email',
                'label'   => 'Email',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'required|valid_email|strtolower|trim|htmlentities'
            ),
            // 'inquiry_company' => array(
            //     'table'   => $this->_table,
            //     'name'   => 'inquiry_company',
            //     'label'   => 'Company',
            //     'type'   => 'text',
            //     'attributes'   => array(),
            //     'js_rules'   => '',
            //     'rules'   => 'required|strtolower|trim|htmlentities'
            // ),
            // 'inquiry_website' => array(
            //     'table'   => $this->_table,
            //     'name'   => 'inquiry_website',
            //     'label'   => 'Website',
            //     'type'   => 'text',
            //     'attributes'   => array(),
            //     'js_rules'   => '',
            //     'rules'   => 'required|strtolower|trim|htmlentities'
            // ),
            // 'inquiry_phone' => array(
            //          'table'   => $this->_table,
            //          'name'   => 'inquiry_phone',
            //          'label'   => 'Phone',
            //          'type'   => 'text',
            //          'attributes'   => array(),
            //          'js_rules'   => '',
            //          'rules'   => 'required|trim|htmlentities|regex_match[/^[\d\(\)\-+ ]+$/]'
            //       ),

            'inquiry_subject' => array(
                'table'   => $this->_table,
                'name'   => 'inquiry_subject',
                'label'   => 'Subject',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'required|trim'
            ),

            
              'inquiry_comments' => array(
                     'table'   => $this->_table,
                     'name'   => 'inquiry_comments',
                     'label'   => 'Message',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim'
                  ),

              // 'inquiry_inche' => array(
              //        'table'   => $this->_table,
              //        'name'   => 'inquiry_inche',
              //        'label'   => 'Inches',
              //        'type'   => 'text',
              //        'attributes'   => array(),
              //        'js_rules'   => '',
              //        'rules'   => 'required'
              //     ),
              
              // 'inquiry_address' => array(
              //        'table'   => $this->_table,
              //        'name'   => 'inquiry_address',
              //        'label'   => 'Address',
              //        'type'   => 'text',
              //        'attributes'   => array(),
              //        'js_rules'   => '',
              //        'rules'   => 'required|trim'
              //     ),
              /*
              'inquiry_city' => array(
                     'table'   => $this->_table,
                     'name'   => 'inquiry_city',
                     'label'   => 'City',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim'
                  ),
              'inquiry_state' => array(
                     'table'   => $this->_table,
                     'name'   => 'inquiry_state',
                     'label'   => 'State',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim'
                  ),
              'inquiry_zip' => array(
                     'table'   => $this->_table,
                     'name'   => 'inquiry_zip',
                     'label'   => 'Zip',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'required|trim'
                  ),*/
              
              /*'inquiry_about' => array(
                     'table'   => $this->_table,
                     'name'   => 'inquiry_about',
                     'label'   => 'About Us',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                  ),*/



              /*'inquiry_community' => array(
                     'table'   => $this->_table,
                     'name'   => 'inquiry_community',
                     'label'   => 'Community',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => '',
                     'rules'   => '|trim'
                  ),*/

              'inquiry_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'inquiry_status',
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


            'inquiry_createdon' => array(
                'table'   => $this->_table,
                'name'   => 'inquiry_createdon',
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