<?
class Model_reportads extends MY_Model
{
    /**
     * TKD reportads MODEL
     *
     * @package     reportads Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'reportads';
    protected $_field_prefix = 'reportads_';
    protected $_pk = 'reportads_id';
    protected $_status_field = 'reportads_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "reportads_id,reportads_adid,reportads_userid,reportads_email,reportads_status";

        parent::__construct();
    }
    public function get_total_count($params = array() , $keyword='')
    {

      // debug($keyword,1);

      // For search
      if(!empty($keyword)){
      $params['where_like'][] = array(
        'column'=>'reportads_title',
        'value'=>$keyword,
        'type'=>'both',
        );
      }

      $params['joins'][] = array(
            'table' => 'reportads_category',
            'joint' => 'reportads_category.reportads_category_id = reportads.reportads_category',
            'type' => 'right'
        );  


      // $params['where']['reportads_id'] = $id;
      // Set params
      $params['order'] = 'reportads_id DESC';


      return $this->find_count_active($params);
    }

    // Get pagination data
    public function get_pagination_data($limit = '', $offset = '', $param = array() ,$keyword = '')
    {
      $prefix = $this->db->dbprefix;

      $param['fields'] = "*,(select count(*) from yt_comment where comment_post_id=reportads_id and comment_status=1) as comments_count";

      // LEFT JOIN
     $param['joins'][] = array(
            'table' => 'reportads_category',
            'joint' => 'reportads_category.reportads_category_id = reportads.reportads_category',
            'type' => 'right'
        ); 
      // For search
      if(!empty($_GET['search'])  && $_GET['search'] != ''){
        $param['where_like'][] = array(
          'column'=>'reportads_title',
          'value'=>$keyword,
          'type'=>'both',
        );
      }
      $param['order'] = 'reportads_id DESC';
      $param['limit'] = $limit;
      $param['offset'] = $offset;

      // debug($param,1);
      
      // Query data
      $data = $this->find_all_active($param);
       // debug($data,1);

      return $data;
    }

    public function get_page_reportads($page='')
    {
        // Set params
        $params['fields'] = 'reportads_page,reportads_title,reportads_category,reportads_image_path,reportads_image,reportads_status';
        $params['where']['reportads_page'] = $page;
        return $this->model_reportads->find_one_active($params);

    }

    // Check slug exists or not
    public function find_by_slug($slug)
    {
        $prefix = $this->db->dbprefix;

        // Set params

        /*$param['fields'] = "reportads_id,reportads_name,reportads_slug,reportads_detail,reportads_image,reportads_image_thumb,reportads_image_path,reportads_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = reportads_id and comment_status=1) AS total_comments,reportads_category_name";*/

        $param['fields'] = "reportads_id,reportads_title,reportads_slug,reportads_detail,reportads_image,reportads_image_thumb,reportads_image_path,reportads_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = reportads_id and comment_status=1) AS total_comments";



        // LEFT JOIN

        /*$param['joins'][] = array(

            "table"=>"reportads_category" ,

            "joint"=>"reportads_category.reportads_category_id = reportads.reportads_category_id and reportads_category.reportads_category_status =1",

            "type"=>"left"

        );*/



        $param['where']['reportads_slug'] = $slug;

        // Query

        $result = $this->find_one_active($param);



        // Return result;

        return $result;

    }

    // Get news comments
    public function get_comments($slug)
    {
        // Set params
        $params['fields'] = "reportads_id,reportads_title,comment_post_id,comment_name,comment_description,comment_created_on";
        $params['where']['reportads_slug'] = $slug;
        // Join
        $params['joins'][] = array(
            "table"=>"comment" ,
            "joint"=>"reportads.reportads_id = comment_post_id and comment_status=1",
        );
        $params['order'] = 'comment_id DESC';

        return $this->model_reportads->find_all_active($params);
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

            'reportads_id' => array(
                'table' => $this->_table,
                'name' => 'reportads_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

           'reportads_userid' => array(
                 'table'   => $this->_table,
                 'name'   => 'reportads_userid',
                 'label'   => 'User',
                 'type'   => 'dropdown',
                 'list_data' => array(),
                 'attributes'   => array(),
                 'js_rules'   => 'required',
                 'rules'   => 'required|trim'
             ),

           'reportads_adid' => array(
                 'table'   => $this->_table,
                 'name'   => 'reportads_adid',
                 'label'   => 'Ad ',
                 'type'   => 'dropdown',
                 'list_data' => array(),
                 'attributes'   => array(),
                 'js_rules'   => 'required',
                 'rules'   => 'required|trim'
             ),
        
          'reportads_email' => array(
                               'table'   => $this->_table,
                               'name'   => 'reportads_email',
                               'label'   => 'Email',
                               'type'   => 'text',
                               'attributes'   => array(),
                               'js_rules'   => 'required',
                               'rules'   => 'required|trim|htmlentities'
                      ),

           'reportads_name' => array(
                               'table'   => $this->_table,
                               'name'   => 'reportads_name',
                               'label'   => 'Name',
                               'type'   => 'text',
                               'attributes'   => array(),
                               'js_rules'   => '',
                               'rules'   => 'trim|htmlentities'
                      ),

           'reportads_subject' => array(
                               'table'   => $this->_table,
                               'name'   => 'reportads_subject',
                               'label'   => 'Subject',
                               'type'   => 'text',
                               'attributes'   => array(),
                               'js_rules'   => '',
                               'rules'   => 'trim|htmlentities'
                      ),

          'reportads_msg' => array(
                               'table'   => $this->_table,
                               'name'   => 'reportads_msg',
                               'label'   => 'Reason',
                               'type'   => 'textarea',
                               'attributes'   => array(),
                               'js_rules'   => 'required',
                               'rules'   => 'required|trim|htmlentities'
                      ),

          

              
            'reportads_status' => array(
                'table' => $this->_table,
                'name' => 'reportads_status',
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