<?
class Model_blog extends MY_Model
{
    /**
     * TKD blog MODEL
     *
     * @package     blog Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'blog';
    protected $_field_prefix = 'blog_';
    protected $_pk = 'blog_id';
    protected $_status_field = 'blog_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "blog_id,blog_title,CONCAT(blog_image_path,blog_image) AS blog_image,blog_status";

        parent::__construct();
    }
    public function get_total_count($params = array() , $keyword='')
    {

      // debug($keyword,1);

      // For search
      if(!empty($keyword)){
      $params['where_like'][] = array(
        'column'=>'blog_title',
        'value'=>$keyword,
        'type'=>'both',
        );
      }

      $params['joins'][] = array(
            'table' => 'blog_category',
            'joint' => 'blog_category.blog_category_id = blog.blog_category',
            'type' => 'right'
        );  


      // $params['where']['blog_id'] = $id;
      // Set params
      $params['order'] = 'blog_id DESC';


      return $this->find_count_active($params);
    }

    // Get pagination data
    public function get_pagination_data($limit = '', $offset = '', $param = array() ,$keyword = '')
    {
      $prefix = $this->db->dbprefix;

      $param['fields'] = "*,(select count(*) from yt_comment where comment_post_id=blog_id and comment_status=1) as comments_count";

      // LEFT JOIN
     $param['joins'][] = array(
            'table' => 'blog_category',
            'joint' => 'blog_category.blog_category_id = blog.blog_category',
            'type' => 'right'
        ); 
      // For search
      if(!empty($_GET['search'])  && $_GET['search'] != ''){
        $param['where_like'][] = array(
          'column'=>'blog_title',
          'value'=>$keyword,
          'type'=>'both',
        );
      }
      $param['order'] = 'blog_id DESC';
      $param['limit'] = $limit;
      $param['offset'] = $offset;

      // debug($param,1);
      
      // Query data
      $data = $this->find_all_active($param);
       // debug($data,1);

      return $data;
    }

    public function get_page_blog($page='')
    {
        // Set params
        $params['fields'] = 'blog_page,blog_title,blog_category,blog_image_path,blog_image,blog_status';
        $params['where']['blog_page'] = $page;
        return $this->model_blog->find_one_active($params);

    }

    // Check slug exists or not
    public function find_by_slug($slug)
    {
        $prefix = $this->db->dbprefix;

        // Set params

        /*$param['fields'] = "blog_id,blog_name,blog_slug,blog_detail,blog_image,blog_image_thumb,blog_image_path,blog_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = blog_id and comment_status=1) AS total_comments,blog_category_name";*/

        $param['fields'] = "blog_id,blog_title,blog_slug,blog_detail,blog_image,blog_image_thumb,blog_image_path,blog_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = blog_id and comment_status=1) AS total_comments";



        // LEFT JOIN

        /*$param['joins'][] = array(

            "table"=>"blog_category" ,

            "joint"=>"blog_category.blog_category_id = blog.blog_category_id and blog_category.blog_category_status =1",

            "type"=>"left"

        );*/



        $param['where']['blog_slug'] = $slug;

        // Query

        $result = $this->find_one_active($param);



        // Return result;

        return $result;

    }

    // Get news comments
    public function get_comments($slug)
    {
        // Set params
        $params['fields'] = "blog_id,blog_title,comment_post_id,comment_name,comment_description,comment_created_on";
        $params['where']['blog_slug'] = $slug;
        // Join
        $params['joins'][] = array(
            "table"=>"comment" ,
            "joint"=>"blog.blog_id = comment_post_id and comment_status=1",
        );
        $params['order'] = 'comment_id DESC';

        return $this->model_blog->find_all_active($params);
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

            'blog_id' => array(
                'table' => $this->_table,
                'name' => 'blog_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

           // 'blog_category' => array(
           //       'table'   => $this->_table,
           //       'name'   => 'blog_category',
           //       'label'   => 'Category',
           //       'type'   => 'dropdown',
           //       'list_data' => array(),
           //       'attributes'   => array(),
           //       'js_rules'   => 'required',
           //       'rules'   => 'required|trim'
           //   ),
        
// 'blog_heading' => array(
//                      'table'   => $this->_table,
//                      'name'   => 'blog_heading',
//                      'label'   => 'heading',
//                      'type'   => 'text',
//                      'attributes'   => array(),
//                      'js_rules'   => 'required',
//                      'rules'   => 'required|trim|htmlentities'
//             ),

              'blog_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'blog_title',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'blog_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'blog_slug',
                  'label'   => 'Slug',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|strtolower|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug'
              ),

            //    'blog_auhtor' => array(
            //          'table'   => $this->_table,
            //          'name'   => 'blog_auhtor',
            //          'label'   => 'Author',
            //          'type'   => 'text',
            //          'attributes'   => array(),
            //          'js_rules'   => 'required',
            //          'rules'   => 'required|trim|htmlentities'
            // ),

               

            // 'blog_date' => array(
            //     'table' => $this->_table,
            //     'name' => 'blog_date',
            //     'label' => 'Date',
            //     'type' => 'date',
            //     'attributes' => array(),
            //     'js_rules' => 'required',
            //     'rules' => 'required|trim|htmlentities'
            // ),


            'blog_short_detail' => array(
                'table' => $this->_table,
                'name' => 'blog_short_detail',
                'label' => 'Short Description',
                'type' => 'textarea',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),
          
          'blog_detail' => array(
                'table' => $this->_table,
                'name' => 'blog_detail',
                'label' => 'Long Description',
                'type' => 'editor',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),

            'blog_image' => array(
                'table' => $this->_table,
                'name' => 'blog_image',
                'label' => 'Image',
                'name_path' => 'blog_image_path',
                'upload_config' => 'site_upload_blog',
                'type' => 'fileupload',
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'thumb'   => array(array('name'=>'blog_image_thumb','max_width'=>470, 'max_height'=>316),),
                'attributes'   => array(
                    'image_size_recommended'=>'370px × 225px',
                    'allow_ext'=>'png|jpeg|jpg',
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),
            'blog_image_detail1' => array(
                'table' => $this->_table,
                'name' => 'blog_image_detail1',
                'label' => 'Image 1 Detail Page',
                'name_path' => 'blog_image_path',
                'upload_config' => 'site_upload_blog',
                'type' => 'fileupload',
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                
                'attributes'   => array(
                    'image_size_recommended'=>'540px × 370px',
                    'allow_ext'=>'png|jpeg|jpg',
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
               // 'js_rules'=>$is_required_image
            ),
            // 'blog_image_detail2' => array(
            //     'table' => $this->_table,
            //     'name' => 'blog_image_detail2',
            //     'label' => 'Image 2 Detail Page',
            //     'name_path' => 'blog_image_path',
            //     'upload_config' => 'site_upload_blog',
            //     'type' => 'fileupload',
            //     'type_dt' => 'image',
            //     'randomize' => true,
            //     'preview' => 'true',
                
            //     'attributes'   => array(
            //         'image_size_recommended'=>'540px × 370px',
            //         'allow_ext'=>'png|jpeg|jpg',
            //     ),
            //     'dt_attributes' => array("width" => "10%"),
            //     'rules' => 'trim|htmlentities',
            //    // 'js_rules'=>$is_required_image
            // ),
            // 'blog_image_detail12' => array(
            //     'table' => $this->_table,
            //     'name' => 'blog_image_detail12',
            //     'label' => 'Image 3 Detail Page',
            //     'name_path' => 'blog_image_path',
            //     'upload_config' => 'site_upload_blog',
            //     'type' => 'fileupload',
            //     'type_dt' => 'image',
            //     'randomize' => true,
            //     'preview' => 'true',
                
            //     'attributes'   => array(
            //         'image_size_recommended'=>'540px × 370px',
            //         'allow_ext'=>'png|jpeg|jpg',
            //     ),
            //     'dt_attributes' => array("width" => "10%"),
            //     'rules' => 'trim|htmlentities',
            //    // 'js_rules'=>$is_required_image
            // ),

         /*'blog_by' => array(
                'table' => $this->_table,
                'name' => 'blog_by',
                'label' => 'By',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),*/

     // 'blog_latest_featured' => array(
     //            'table' => $this->_table,
     //            'name' => 'blog_latest_featured',
     //            'label' => 'Is Featured?',
     //            'type' => 'switch',
     //            'type_dt' => 'dropdown',
     //            'type_filter_dt' => 'dropdown',
     //            'list_data_key' => "blog_latest_featured" ,
     //            'list_data' => array(),
     //            'default' => '0',
     //            'attributes' => array(),
     //            'dt_attributes' => array("width" => "7%"),
     //            'rules' => 'trim'
     //        ),
            'blog_status' => array(
                'table' => $this->_table,
                'name' => 'blog_status',
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