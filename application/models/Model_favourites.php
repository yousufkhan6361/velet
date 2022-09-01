<?
class Model_favourites extends MY_Model
{
    /**
     * TKD favourites MODEL
     *
     * @package     favourites Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'favourites';
    protected $_field_prefix = 'favourites_';
    protected $_pk = 'favourites_id';
    protected $_status_field = 'favourites_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "favourites_id,favourites_ads_title,CONCAT(favourites_image_path,favourites_image) AS favourites_image,favourites_status";

        parent::__construct();
    }
    public function get_total_count($params = array() , $keyword='')
    {

      // debug($keyword,1);

      // For search
      if(!empty($keyword)){
      $params['where_like'][] = array(
        'column'=>'favourites_title',
        'value'=>$keyword,
        'type'=>'both',
        );
      }

      $params['joins'][] = array(
            'table' => 'favourites_category',
            'joint' => 'favourites_category.favourites_category_id = favourites.favourites_category',
            'type' => 'right'
        );  


      // $params['where']['favourites_id'] = $id;
      // Set params
      $params['order'] = 'favourites_id DESC';


      return $this->find_count_active($params);
    }

    // Get pagination data
    public function get_pagination_data($limit = '', $offset = '', $param = array() ,$keyword = '')
    {
      $prefix = $this->db->dbprefix;

      $param['fields'] = "*,(select count(*) from yt_comment where comment_post_id=favourites_id and comment_status=1) as comments_count";

      // LEFT JOIN
     $param['joins'][] = array(
            'table' => 'favourites_category',
            'joint' => 'favourites_category.favourites_category_id = favourites.favourites_category',
            'type' => 'right'
        ); 
      // For search
      if(!empty($_GET['search'])  && $_GET['search'] != ''){
        $param['where_like'][] = array(
          'column'=>'favourites_title',
          'value'=>$keyword,
          'type'=>'both',
        );
      }
      $param['order'] = 'favourites_id DESC';
      $param['limit'] = $limit;
      $param['offset'] = $offset;

      // debug($param,1);
      
      // Query data
      $data = $this->find_all_active($param);
       // debug($data,1);

      return $data;
    }

    public function get_page_favourites($page='')
    {
        // Set params
        $params['fields'] = 'favourites_page,favourites_title,favourites_category,favourites_image_path,favourites_image,favourites_status';
        $params['where']['favourites_page'] = $page;
        return $this->model_favourites->find_one_active($params);

    }

    // Check slug exists or not
    public function find_by_slug($slug)
    {
        $prefix = $this->db->dbprefix;

        // Set params

        /*$param['fields'] = "favourites_id,favourites_name,favourites_slug,favourites_detail,favourites_image,favourites_image_thumb,favourites_image_path,favourites_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = favourites_id and comment_status=1) AS total_comments,favourites_category_name";*/

        $param['fields'] = "favourites_id,favourites_title,favourites_slug,favourites_detail,favourites_image,favourites_image_thumb,favourites_image_path,favourites_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = favourites_id and comment_status=1) AS total_comments";



        // LEFT JOIN

        /*$param['joins'][] = array(

            "table"=>"favourites_category" ,

            "joint"=>"favourites_category.favourites_category_id = favourites.favourites_category_id and favourites_category.favourites_category_status =1",

            "type"=>"left"

        );*/



        $param['where']['favourites_slug'] = $slug;

        // Query

        $result = $this->find_one_active($param);



        // Return result;

        return $result;

    }

    // Get news comments
    public function get_comments($slug)
    {
        // Set params
        $params['fields'] = "favourites_id,favourites_title,comment_post_id,comment_name,comment_description,comment_created_on";
        $params['where']['favourites_slug'] = $slug;
        // Join
        $params['joins'][] = array(
            "table"=>"comment" ,
            "joint"=>"favourites.favourites_id = comment_post_id and comment_status=1",
        );
        $params['order'] = 'comment_id DESC';

        return $this->model_favourites->find_all_active($params);
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

            'favourites_id' => array(
                'table' => $this->_table,
                'name' => 'favourites_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

             'favourites_ads_id' => array(
                'table' => $this->_table,
                'name' => 'favourites_ads_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

              'favourites_user_id' => array(
                'table' => $this->_table,
                'name' => 'favourites_user_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

           // 'favourites_category' => array(
           //       'table'   => $this->_table,
           //       'name'   => 'favourites_category',
           //       'label'   => 'Category',
           //       'type'   => 'dropdown',
           //       'list_data' => array(),
           //       'attributes'   => array(),
           //       'js_rules'   => 'required',
           //       'rules'   => 'required|trim'
           //   ),
        
// 'favourites_heading' => array(
//                      'table'   => $this->_table,
//                      'name'   => 'favourites_heading',
//                      'label'   => 'heading',
//                      'type'   => 'text',
//                      'attributes'   => array(),
//                      'js_rules'   => 'required',
//                      'rules'   => 'required|trim|htmlentities'
//             ),

              'favourites_ads_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'favourites_ads_title',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'favourites_ads_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'favourites_ads_slug',
                  'label'   => 'Slug',
                  'type'   => 'text',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|strtolower|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug'
              ),

            //    'favourites_auhtor' => array(
            //          'table'   => $this->_table,
            //          'name'   => 'favourites_auhtor',
            //          'label'   => 'Author',
            //          'type'   => 'text',
            //          'attributes'   => array(),
            //          'js_rules'   => 'required',
            //          'rules'   => 'required|trim|htmlentities'
            // ),

               

            // 'favourites_date' => array(
            //     'table' => $this->_table,
            //     'name' => 'favourites_date',
            //     'label' => 'Date',
            //     'type' => 'date',
            //     'attributes' => array(),
            //     'js_rules' => 'required',
            //     'rules' => 'required|trim|htmlentities'
            // ),


          //   'favourites_short_detail' => array(
          //       'table' => $this->_table,
          //       'name' => 'favourites_short_detail',
          //       'label' => 'Short Description',
          //       'type' => 'textarea',
          //       'attributes' => array(),
          //       'js_rules' => 'required',
          //       'rules' => 'required|trim|htmlentities'
          //   ),
          
          // 'favourites_detail' => array(
          //       'table' => $this->_table,
          //       'name' => 'favourites_detail',
          //       'label' => 'Long Description',
          //       'type' => 'editor',
          //       'attributes' => array(),
          //       'js_rules' => 'required',
          //       'rules' => 'required|trim|htmlentities'
          //   ),

            'favourites_image' => array(
                'table' => $this->_table,
                'name' => 'favourites_image',
                'label' => 'Image',
                'name_path' => 'favourites_image_path',
                'upload_config' => 'site_upload_ads',
                'type' => 'fileupload',
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'thumb'   => array(array('max_width'=>470, 'max_height'=>316),),
                'attributes'   => array(
                    'image_size_recommended'=>'370px × 225px',
                    'allow_ext'=>'png|jpeg|jpg',
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),
            'favourites_image_detail1' => array(
                'table' => $this->_table,
                'name' => 'favourites_image_detail1',
                'label' => 'Image 1 Detail Page',
                'name_path' => 'favourites_image_path',
                'upload_config' => 'site_upload_favourites',
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
            // 'favourites_image_detail2' => array(
            //     'table' => $this->_table,
            //     'name' => 'favourites_image_detail2',
            //     'label' => 'Image 2 Detail Page',
            //     'name_path' => 'favourites_image_path',
            //     'upload_config' => 'site_upload_favourites',
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
            // 'favourites_image_detail12' => array(
            //     'table' => $this->_table,
            //     'name' => 'favourites_image_detail12',
            //     'label' => 'Image 3 Detail Page',
            //     'name_path' => 'favourites_image_path',
            //     'upload_config' => 'site_upload_favourites',
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

         /*'favourites_by' => array(
                'table' => $this->_table,
                'name' => 'favourites_by',
                'label' => 'By',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),*/

     // 'favourites_latest_featured' => array(
     //            'table' => $this->_table,
     //            'name' => 'favourites_latest_featured',
     //            'label' => 'Is Featured?',
     //            'type' => 'switch',
     //            'type_dt' => 'dropdown',
     //            'type_filter_dt' => 'dropdown',
     //            'list_data_key' => "favourites_latest_featured" ,
     //            'list_data' => array(),
     //            'default' => '0',
     //            'attributes' => array(),
     //            'dt_attributes' => array("width" => "7%"),
     //            'rules' => 'trim'
     //        ),
            'favourites_status' => array(
                'table' => $this->_table,
                'name' => 'favourites_status',
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