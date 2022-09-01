<?

class Model_affiliate extends MY_Model {

    /**

     * affiliate MODEL

     *

     * @package     affiliate Model

     * @version     1.0

     * @since       2017

     */



    protected $_table    = 'affiliate';

    protected $_field_prefix    = 'affiliate_';

    protected $_pk    = 'affiliate_id';

    protected $_status_field    = 'affiliate_status';

    public $relations = array();

    public $pagination_params = array();

    public $dt_params = array();

    public $_per_page    = 20;

    

    function __construct()

    {

        // Call the Model constructor

        $this->pagination_params['fields'] = "affiliate_id,affiliate_username,affiliate_useremail,affiliate_link,affiliate_status";

        

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



    // Get affiliate post for home page (3 post)

    public function get_post($limit=1)

    {

        // Set params

        $params['fields'] = "affiliate_id,affiliate_name,affiliate_slug,affiliate_description,affiliate_image,affiliate_image_thumb,affiliate_image_path,affiliate_createdon";

        $params['order'] = 'affiliate_id DESC';
        $params['limit'] = $limit;
        // Query
        $result = $this->model_affiliate->find_all_active($params);
        // Return result

        return $result;

    }



    // Get recent post

    public function get_recent_post($limit=5)

    {

        // Set params

        $params['fields'] = "affiliate_id,affiliate_name,affiliate_slug,affiliate_createdon";



        $params['order'] = 'affiliate_id DESC';

        $params['limit'] = $limit;

        // Query

        $result = $this->model_affiliate->find_all_active($params);



        // Return result

        return $result;

    }



    // Get recommended post

   /* public function get_recommended_posts()

    {

        // Set params

        $params['fields'] = "comment_id,comment_post_id,SUM(`comment_rating`) as total_rating,affiliate_id,affiliate_name,affiliate_slug,

        affiliate_image,affiliate_image_path,(SELECT COUNT(comment_post_id) FROM 480_comment WHERE comment_post_id = affiliate_id and comment_status=1) AS total_comments";

        // Join

        $params['joins'][] = array(

            "table"=>"comment" ,

            "joint"=>"affiliate.affiliate_id = 480_comment.comment_post_id and 480_comment.comment_status=1",

        );

        $params['group'] = 'comment_post_id';

        $params['order'] = 'total_rating DESC';

        $params['limit'] = 3;



        return $this->model_affiliate->find_all_active($params);

    }*/



    // Check slug exists or not (Not Join with Category)

    /*public function find_by_slug($slug)

    {

        $prefix = $this->db->dbprefix;



        // Set params

        $param['fields'] = "affiliate_id,affiliate_name,affiliate_slug,affiliate_description,affiliate_image,affiliate_image_thumb,affiliate_image_path,affiliate_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = affiliate_id and comment_status=1) AS total_comments";



        $param['where']['affiliate_slug'] = $slug;

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

        $param['fields'] = "affiliate_id,affiliate_name,affiliate_slug,affiliate_auhtor,affiliate_description,affiliate_image,affiliate_image_thumb,affiliate_image_path,affiliate_date";

        // (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = affiliate_id and comment_status=1) AS total_comments,affiliate_category_name";



        // LEFT JOIN

        // $param['joins'][] = array(

        //     "table"=>"affiliate_category" ,

        //     "joint"=>"affiliate_category.affiliate_category_id = affiliate.affiliate_category_id and affiliate_category.affiliate_category_status =1",

        //     "type"=>"left"

        // );



        $param['where']['affiliate_slug'] = $slug;

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

                'column'=>'affiliate_name',

                'value'=>$keyword,

                'type'=>'both',

            );

        }

        // Set params

        $params['order'] = 'affiliate_id DESC';



        return $this->model_affiliate->find_count_active($params);

    }



    // Get affiliate comments

    public function get_comments($slug)

    {

        // Set params

        $params['fields'] = "affiliate_id,affiliate_name,comment_post_id,comment_name,comment_description,comment_created_on";

        $params['where']['affiliate_slug'] = $slug;

        // Join

        $params['joins'][] = array(

            "table"=>"comment" ,

            "joint"=>"affiliate.affiliate_id = comment_post_id and comment_status=1",

        );

        $params['order'] = 'comment_id DESC';



        return $this->model_affiliate->find_all_active($params);

    }



    // Get pagination data

    public function get_pagination_data($limit = '', $offset = '', $keyword = '')

    {

        $prefix = $this->db->dbprefix;

        // Set params

        $param['fields'] = "affiliate_id,affiliate_name,affiliate_slug,affiliate_image, affiliate_image_thumb,,affiliate_image_path,affiliate_description,affiliate_image,affiliate_image_thumb,affiliate_image_path,affiliate_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = affiliate_id and comment_status=1) AS total_comments, affiliate_category_name";

        // LEFT JOIN

        // $param['joins'][] = array(

        //     "table"=>"affiliate_category" ,

        //     "joint"=>"affiliate_category.affiliate_category_id = affiliate.affiliate_category_id and affiliate_category.affiliate_category_status =1",

        //     "type"=>"left"

        // );

        // For search

        if(!empty($keyword)){

            $param['where_like'][] = array(

                'column'=>'affiliate_name',

                'value'=>$keyword,

                'type'=>'both',

            );

        }

        $param['order'] = 'affiliate_id DESC';

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

              'affiliate_id' => array(

                     'table'   => $this->_table,

                     'name'   => 'affiliate_id',

                     'label'   => 'ID',

                     'type'   => 'hidden',

                     'type_dt'   => 'text',

                     'attributes'   => array(),

                     'dt_attributes'   => array("width"=>"5%"),

                     'js_rules'   => '',

                     'rules'   => 'trim'

                ),

              'affiliate_userid' => array(
                     'table'   => $this->_table,
                     'name'   => 'affiliate_userid',
                     'label'   => 'id #',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),

             'affiliate_username' => array(
                 'table'   => $this->_table,
                 'name'   => 'affiliate_username',
                 'label'   => 'Name',
                 'type'   => 'text',
                 'attributes'   => array(),
                 'js_rules'   => '',
                 'rules'   => 'trim|htmlentities'
              ),

             'affiliate_useremail' => array(
                 'table'   => $this->_table,
                 'name'   => 'affiliate_useremail',
                 'label'   => 'Email',
                 'type'   => 'text',
                 'attributes'   => array(),
                 'js_rules'   => '',
                 'rules'   => 'trim|htmlentities'
              ),


              'affiliate_link' => array(
                'table'   => $this->_table,
                'name'   => 'affiliate_link',
                'label'   => 'Referral Link',
                'type'   => 'text',
                'attributes'   => array(),
                'js_rules'   => '',
                'rules'   => 'strtolower|trim|htmlentities|min_length[2]|max_length[25]'
            ),



            // 'affiliate_category_id' => array(

            //     'table'   => $this->_table,

            //     'name'   => 'affiliate_category_id',

            //     'label'   => 'Category',

            //     'type'   => 'dropdown',

            //     'type_dt'   => 'text',

            //     'attributes'   => array(),

            //     'dt_attributes'   => array("width"=>"5%"),

            //     'js_rules'   => '',

            //     'rules'   => 'trim'

            // ),



           
           
            'affiliate_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'affiliate_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt'   => 'dropdown',
                     'list_data' => array( 
                                        0 => "<span class=\"label label-danger\">Inactive</span>" ,
                                        1 =>  "<span class=\"label label-primary\">Active</span>"  
                                    ) ,
                     'default'   => '1',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"7%"),
                     'rules'   => 'trim'
                  ),


            'affiliate_created_on' => array(
                'table'   => $this->_table,
                'name'   => 'affiliate_created_on',
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