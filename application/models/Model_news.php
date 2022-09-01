<?

class Model_news extends MY_Model {

    /**

     * news MODEL

     *

     * @package     news Model

     * @version     1.0

     * @since       2017

     */



    protected $_table    = 'news';

    protected $_field_prefix    = 'news_';

    protected $_pk    = 'news_id';

    protected $_status_field    = 'news_status';

    public $relations = array();

    public $pagination_params = array();

    public $dt_params = array();

    public $_per_page    = 20;

    

    function __construct()

    {

        // Call the Model constructor

        $this->pagination_params['fields'] = "news_id,news_title,CONCAT(news_image_path,news_image) AS news_image ,news_status";

        

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



    // Get news post for home page (3 post)

    public function get_post($limit=1)

    {

        // Set params

        $params['fields'] = "news_id,news_name,news_slug,news_description,news_image,news_image_thumb,news_image_path,news_createdon";



        $params['order'] = 'news_id DESC';

        $params['limit'] = $limit;

        // Query

        $result = $this->model_news->find_all_active($params);



        // Return result

        return $result;

    }



    // Get recent post

    public function get_recent_post($limit=5)

    {

        // Set params

        $params['fields'] = "news_id,news_name,news_slug,news_createdon";



        $params['order'] = 'news_id DESC';

        $params['limit'] = $limit;

        // Query

        $result = $this->model_news->find_all_active($params);



        // Return result

        return $result;

    }



    // Get recommended post

   /* public function get_recommended_posts()

    {

        // Set params

        $params['fields'] = "comment_id,comment_post_id,SUM(`comment_rating`) as total_rating,news_id,news_name,news_slug,

        news_image,news_image_path,(SELECT COUNT(comment_post_id) FROM 480_comment WHERE comment_post_id = news_id and comment_status=1) AS total_comments";

        // Join

        $params['joins'][] = array(

            "table"=>"comment" ,

            "joint"=>"news.news_id = 480_comment.comment_post_id and 480_comment.comment_status=1",

        );

        $params['group'] = 'comment_post_id';

        $params['order'] = 'total_rating DESC';

        $params['limit'] = 3;



        return $this->model_news->find_all_active($params);

    }*/



    // Check slug exists or not (Not Join with Category)

    /*public function find_by_slug($slug)

    {

        $prefix = $this->db->dbprefix;



        // Set params

        $param['fields'] = "news_id,news_name,news_slug,news_description,news_image,news_image_thumb,news_image_path,news_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = news_id and comment_status=1) AS total_comments";



        $param['where']['news_slug'] = $slug;

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

        $param['fields'] = "news_id,news_name,news_slug,news_auhtor,news_description,news_image,news_image_thumb,news_image_path,news_date";

        // (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = news_id and comment_status=1) AS total_comments,news_category_name";



        // LEFT JOIN

        // $param['joins'][] = array(

        //     "table"=>"news_category" ,

        //     "joint"=>"news_category.news_category_id = news.news_category_id and news_category.news_category_status =1",

        //     "type"=>"left"

        // );



        $param['where']['news_slug'] = $slug;

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

                'column'=>'news_name',

                'value'=>$keyword,

                'type'=>'both',

            );

        }

        // Set params

        $params['order'] = 'news_id DESC';



        return $this->model_news->find_count_active($params);

    }



    // Get news comments

    public function get_comments($slug)

    {

        // Set params

        $params['fields'] = "news_id,news_name,comment_post_id,comment_name,comment_description,comment_created_on";

        $params['where']['news_slug'] = $slug;

        // Join

        $params['joins'][] = array(

            "table"=>"comment" ,

            "joint"=>"news.news_id = comment_post_id and comment_status=1",

        );

        $params['order'] = 'comment_id DESC';



        return $this->model_news->find_all_active($params);

    }



    // Get pagination data

    public function get_pagination_data($limit = '', $offset = '', $keyword = '')

    {

        $prefix = $this->db->dbprefix;

        // Set params

        $param['fields'] = "news_id,news_name,news_slug,news_image, news_image_thumb,,news_image_path,news_description,news_image,news_image_thumb,news_image_path,news_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = news_id and comment_status=1) AS total_comments, news_category_name";

        // LEFT JOIN

        // $param['joins'][] = array(

        //     "table"=>"news_category" ,

        //     "joint"=>"news_category.news_category_id = news.news_category_id and news_category.news_category_status =1",

        //     "type"=>"left"

        // );

        // For search

        if(!empty($keyword)){

            $param['where_like'][] = array(

                'column'=>'news_name',

                'value'=>$keyword,

                'type'=>'both',

            );

        }

        $param['order'] = 'news_id DESC';

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

              'news_id' => array(

                     'table'   => $this->_table,

                     'name'   => 'news_id',

                     'label'   => 'ID',

                     'type'   => 'hidden',

                     'type_dt'   => 'text',

                     'attributes'   => array(),

                     'dt_attributes'   => array("width"=>"5%"),

                     'js_rules'   => '',

                     'rules'   => 'trim'

                ),

              'news_title' => array(

                     'table'   => $this->_table,

                     'name'   => 'news_title',

                     'label'   => 'Title',

                     'type'   => 'text',

                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),

                     'js_rules'   => 'required',

                     'rules'   => 'required|trim|htmlentities'

                  ),

              'news_slug'  => array(

                  'table'   => $this->_table,

                  'name'   => 'news_slug',

                  'label'   => 'Title',

                  'type'   => 'hidden',

                  'attributes'   => array(),

                  'js_rules'   => array("is_slug" => array() ),

                  'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug|strtolower'

              ),

            // 'news_category_id' => array(

            //     'table'   => $this->_table,

            //     'name'   => 'news_category_id',

            //     'label'   => 'Category',

            //     'type'   => 'dropdown',

            //     'type_dt'   => 'text',

            //     'attributes'   => array(),

            //     'dt_attributes'   => array("width"=>"5%"),

            //     'js_rules'   => '',

            //     'rules'   => 'trim'

            // ),



            'news_auhtor' => array(

                     'table'   => $this->_table,

                     'name'   => 'news_auhtor',

                     'label'   => 'Author',

                     'type'   => 'text',

                     'attributes'   => array(),

                     'js_rules'   => '',

                     'rules'   => 'required|trim|htmlentities'

            ),


            'news_date' => array(

                     'table'   => $this->_table,

                     'name'   => 'news_date',

                     'label'   => 'Date',

                     'type'   => 'date',

                     'attributes'   => array(),

                     'js_rules'   => 'required',

                     'rules'   => 'required|trim|htmlentities'

                  ),

            'news_description' => array(

                'table'   => $this->_table,

                'name'   => 'news_description',

                'label'   => 'Description',

                'type'   => 'editor',

                'attributes'   => array(),

                'js_rules'   => '',

                'rules'   => 'required|trim'

            ),



            // 'news_facebook' => array(
            //   'table'   => $this->_table,
            //   'name'   => 'news_facebook',
            //   'label'   => 'Facebook Link',
            //   'type'   => 'text',
            //   'attributes'   => array(),
            //   'js_rules'   => '',
            //   'rules'   => 'trim|htmlentities'
            // ),

            // 'news_twitter' => array(
            //   'table'   => $this->_table,
            //   'name'   => 'news_twitter',
            //   'label'   => 'Twitter Link',
            //   'type'   => 'text',
            //   'attributes'   => array(),
            //   'js_rules'   => '',
            //   'rules'   => 'trim|htmlentities'
            // ),

            // 'news_instagram' => array(
            //   'table'   => $this->_table,
            //   'name'   => 'news_instagram',
            //   'label'   => 'Instagram Link',
            //   'type'   => 'text',
            //   'attributes'   => array(),
            //   'js_rules'   => '',
            //   'rules'   => 'trim|htmlentities'
            // ),

            // 'news_youtube' => array(
            //   'table'   => $this->_table,
            //   'name'   => 'news_youtube',
            //   'label'   => 'Youtube Link',
            //   'type'   => 'text',
            //   'attributes'   => array(),
            //   'js_rules'   => '',
            //   'rules'   => 'trim|htmlentities'
            // ),

            'news_image' => array(

                'table' => $this->_table,

                'name' => 'news_image',

                'label' => 'Image',

                'name_path' => 'news_image_path',

                'upload_config' => 'site_upload_news',

                'thumb'   => array(array('name'=>'news_image_thumb','max_width'=>320, 'max_height'=>200),),

                'type' => 'fileupload',

                'type_dt' => 'image',

                'randomize' => true,

                'preview' => 'true',

                'attributes' => array('allow_ext'=>'png|jpeg|jpg','image_size_recommended'=>'771 × 250 px',),

                'dt_attributes' => array("width" => "10%"),

                'rules' => 'trim|htmlentities',

                'js_rules'=>$is_required_image

            ),

            'news_status' => array(

                     'table'   => $this->_table,

                     'name'   => 'news_status',

                     'label'   => 'Status',

                     'type'   => 'switch',

                     'type_dt'   => 'dropdown',

                     'type_filter_dt' => 'dropdown',

                     'list_data_key' => "news_status" ,

                'list_data' => array(

                    0 => "<span class='label label-danger'>Inactive</span>" ,

                    1 =>  "<span class='label label-primary'>Active</span>"

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