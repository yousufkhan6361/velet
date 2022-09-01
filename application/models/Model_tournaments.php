<?
class Model_tournaments extends MY_Model {
    /**
     * tournaments MODEL
     *
     * @package     tournaments Model
     * @version     1.0
     * @since       2017
     */

    protected $_table    = 'tournaments';
    protected $_field_prefix    = 'tournaments_';
    protected $_pk    = 'tournaments_id';
    protected $_status_field    = 'tournaments_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "tournaments_id,tournaments_name,tournaments_status";
        
        parent::__construct();

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

    // Get tournaments post for home page (3 post)
    public function get_post($limit=1)
    {
        // Set params
        $params['fields'] = "tournaments_id,tournaments_name,tournaments_slug,tournaments_description,tournaments_image,tournaments_image_thumb,tournaments_image_path,tournaments_createdon";

        $params['order'] = 'tournaments_id DESC';
        $params['limit'] = $limit;
        // Query
        $result = $this->model_tournaments->find_all_active($params);

        // Return result
        return $result;
    }

    // Get recent post
    public function get_recent_post($limit=5)
    {
        // Set params
        $params['fields'] = "tournaments_id,tournaments_name,tournaments_slug,tournaments_createdon";

        $params['order'] = 'tournaments_id DESC';
        $params['limit'] = $limit;
        // Query
        $result = $this->model_tournaments->find_all_active($params);

        // Return result
        return $result;
    }

    // Get recommended post
   /* public function get_recommended_posts()
    {
        // Set params
        $params['fields'] = "comment_id,comment_post_id,SUM(`comment_rating`) as total_rating,tournaments_id,tournaments_name,tournaments_slug,
        tournaments_image,tournaments_image_path,(SELECT COUNT(comment_post_id) FROM 480_comment WHERE comment_post_id = tournaments_id and comment_status=1) AS total_comments";
        // Join
        $params['joins'][] = array(
            "table"=>"comment" ,
            "joint"=>"tournaments.tournaments_id = 480_comment.comment_post_id and 480_comment.comment_status=1",
        );
        $params['group'] = 'comment_post_id';
        $params['order'] = 'total_rating DESC';
        $params['limit'] = 3;

        return $this->model_tournaments->find_all_active($params);
    }*/

    // Check slug exists or not (Not Join with Category)
    /*public function find_by_slug($slug)
    {
        $prefix = $this->db->dbprefix;

        // Set params
        $param['fields'] = "tournaments_id,tournaments_name,tournaments_slug,tournaments_description,tournaments_image,tournaments_image_thumb,tournaments_image_path,tournaments_createdon,
        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = tournaments_id and comment_status=1) AS total_comments";

        $param['where']['tournaments_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }*/

    // Check slug exists or not (Join to fetch category)
    public function find_by_slug($slug)
    {
        $prefix = $this->db->dbprefix;

        // Set params
        $param['fields'] = "tournaments_id,tournaments_name,tournaments_slug,tournaments_description,tournaments_image,tournaments_image_thumb,tournaments_image_path,tournaments_createdon";
        // (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = tournaments_id and comment_status=1) AS total_comments,tournaments_category_name";

        // LEFT JOIN
        // $param['joins'][] = array(
        //     "table"=>"tournaments_category" ,
        //     "joint"=>"tournaments_category.tournaments_category_id = tournaments.tournaments_category_id and tournaments_category.tournaments_category_status =1",
        //     "type"=>"left"
        // );

        $param['where']['tournaments_slug'] = $slug;
        // Query
        $result = $this->find_one_active($param);

        // Return result;
        return $result;
    }

    // Get total post active
    public function get_total_count($keyword='')
    {
        // For search
        if(!empty($keyword)){
            $params['where_like'][] = array(
                'column'=>'tournaments_name',
                'value'=>$keyword,
                'type'=>'both',
            );
        }
        // Set params
        $params['order'] = 'tournaments_id DESC';

        return $this->model_tournaments->find_count_active($params);
    }

    // Get tournaments comments
    public function get_comments($slug)
    {
        // Set params
        $params['fields'] = "tournaments_id,tournaments_name,comment_post_id,comment_name,comment_description,comment_created_on";
        $params['where']['tournaments_slug'] = $slug;
        // Join
        $params['joins'][] = array(
            "table"=>"comment" ,
            "joint"=>"tournaments.tournaments_id = comment_post_id and comment_status=1",
        );
        $params['order'] = 'comment_id DESC';

        return $this->model_tournaments->find_all_active($params);
    }

    // Get pagination data
    public function get_pagination_data($limit = '', $offset = '', $keyword = '')
    {
        $prefix = $this->db->dbprefix;
        // Set params
        $param['fields'] = "tournaments_id,tournaments_name,tournaments_slug,tournaments_image, tournaments_image_thumb,,tournaments_image_path,tournaments_description,tournaments_image,tournaments_image_thumb,tournaments_image_path,tournaments_createdon,
        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = tournaments_id and comment_status=1) AS total_comments, tournaments_category_name";
        // LEFT JOIN
        // $param['joins'][] = array(
        //     "table"=>"tournaments_category" ,
        //     "joint"=>"tournaments_category.tournaments_category_id = tournaments.tournaments_category_id and tournaments_category.tournaments_category_status =1",
        //     "type"=>"left"
        // );
        // For search
        if(!empty($keyword)){
            $param['where_like'][] = array(
                'column'=>'tournaments_name',
                'value'=>$keyword,
                'type'=>'both',
            );
        }
        $param['order'] = 'tournaments_id DESC';
        $param['limit'] = $limit;
        $param['offset'] = $offset;
        // Query data
        $data = $this->find_all_active($param);

        // Return result
        return $data;
    }

    public function get_fields( $specific_field = "" )
    {

        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(

              'tournaments_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'tournaments_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

              'tournaments_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'tournaments_name',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              

              'tournaments_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'tournaments_slug',
                  'label'   => 'Title',
                  'type'   => 'hidden',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug|strtolower'
              ),


            'tournaments_day' => array(
                   'table'   => $this->_table,
                   'name'   => 'tournaments_day',
                   'label'   => 'Day',
                   'type'   => 'dropdown',
                   'list_data'    => array("Monday"=>"Monday","Tuesday"=>"Tuesday","Wednesday"=>"Wednesday","Thursday"=>"Thursday","Friday"=>"Friday","Saturday"=>"Saturday","Sunday"=>"Sunday") ,
                   'attributes'   => array(),
                   'js_rules'   => 'required',
                   'rules'   => 'required',
                ),
            // 'tournaments_category_id' => array(
            //     'table'   => $this->_table,
            //     'name'   => 'tournaments_category_id',
            //     'label'   => 'Category',
            //     'type'   => 'dropdown',
            //     'type_dt'   => 'text',
            //     'attributes'   => array(),
            //     'dt_attributes'   => array("width"=>"5%"),
            //     'js_rules'   => '',
            //     'rules'   => 'trim'
            // ),

            'tournaments_date' => array(
                     'table'   => $this->_table,
                     'name'   => 'tournaments_date',
                     'label'   => 'Date',
                     'type'   => 'datetime',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
            'tournaments_image' => array(
                'table' => $this->_table,
                'name' => 'tournaments_image',
                'label' => 'Team 1 Image',
                'name_path' => 'tournaments_image_path',
                'upload_config' => 'site_upload_tournaments',
                'thumb'   => array(array('name'=>'tournaments_image_thumb','max_width'=>320, 'max_height'=>200),),
                'type' => 'fileupload',
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes' => array('allow_ext'=>'png|jpeg|jpg','image_size_recommended'=>'771 × 250 px',),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),
            'tournaments_image2' => array(
                'table' => $this->_table,
                'name' => 'tournaments_image2',
                'label' => 'Team 2 Image',
                'name_path' => 'tournaments_image_path',
                'upload_config' => 'site_upload_tournaments',
                'thumb'   => array(array('name'=>'tournaments_image_thumb','max_width'=>320, 'max_height'=>200),),
                'type' => 'fileupload',
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes' => array('allow_ext'=>'png|jpeg|jpg','image_size_recommended'=>'771 × 250 px',),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),

            'tournaments_description' => array(
                'table'   => $this->_table,
                'name'   => 'tournaments_description',
                'label'   => 'Description',
                'type'   => 'editor',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'required|trim'
            ),

            'tournaments_price' => array(
                     'table'   => $this->_table,
                     'name'   => 'tournaments_price',
                     'label'   => 'Price',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),
            
            'tournaments_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'tournaments_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt' => 'dropdown',
                     'list_data_key' => "tournaments_status" ,
                     'list_data' => array(),
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