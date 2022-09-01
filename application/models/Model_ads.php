<?
class Model_ads extends MY_Model
{
    /**
     * TKD ads MODEL
     *
     * @package     ads Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'ads';
    protected $_field_prefix = 'ads_';
    protected $_pk = 'ads_id';
    protected $_status_field = 'ads_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "ads_id,ads_category_id,ads_title,CONCAT(ads_image_path,ads_image) AS ads_image,ads_featured,ads_status";

        // $status = $_GET['status'];
       // $this->pagination_params['where']['ads_status'] = 1;

        parent::__construct();
    }


      public function get_data($params)
    {
        $params['joins'][] = array(
            "table"=>"ads_gallery" , 
            "joint"=>"ads_id = ads_gallery_ads_id", 
        );
        return $this->find_all($params);
    }


    
    public function get_total_count($params = array() , $keyword='')
    {

      // debug($keyword,1);

      // For search
      if(!empty($keyword)){
      $params['where_like'][] = array(
        'column'=>'ads_title',
        'value'=>$keyword,
        'type'=>'both',
        );
      }

      // $params['joins'][] = array(
      //       'table' => 'ads_category',
      //       'joint' => 'ads_category.ads_category_id = ads.ads_category',
      //       'type' => 'right'
      //   );  


      // $params['where']['ads_id'] = $id;
      // Set params
      $params['order'] = 'ads_id DESC';


      return $this->find_count_active($params);
    }

    // Get pagination data
    public function get_pagination_data($limit = '', $offset = '', $param = array() ,$keyword = '')
    {
      $prefix = $this->db->dbprefix;

      $param['fields'] = "*,(select count(*) from yt_comment where comment_post_id=ads_id and comment_status=1) as comments_count";

      // LEFT JOIN
     $param['joins'][] = array(
            'table' => 'ads_category',
            'joint' => 'ads_category.ads_category_id = ads.ads_category',
            'type' => 'right'
        ); 
      // For search
      if(!empty($_GET['search'])  && $_GET['search'] != ''){
        $param['where_like'][] = array(
          'column'=>'ads_title',
          'value'=>$keyword,
          'type'=>'both',
        );
      }
      $param['order'] = 'ads_id DESC';
      $param['limit'] = $limit;
      $param['offset'] = $offset;

      // debug($param,1);
      
      // Query data
      $data = $this->find_all_active($param);
       // debug($data,1);

      return $data;
    }

    public function get_page_ads($page='')
    {
        // Set params
        $params['fields'] = 'ads_page,ads_title,ads_category,ads_image_path,ads_image,ads_status';
        $params['where']['ads_page'] = $page;
        return $this->model_ads->find_one_active($params);

    }

    // Check slug exists or not
    public function find_by_slug($slug)
    {
        $prefix = $this->db->dbprefix;

        // Set params

        /*$param['fields'] = "ads_id,ads_name,ads_slug,ads_detail,ads_image,ads_image_thumb,ads_image_path,ads_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = ads_id and comment_status=1) AS total_comments,ads_category_name";*/

        $param['fields'] = "ads_id,ads_title,ads_slug,ads_detail,ads_image,ads_image_thumb,ads_image_path,ads_createdon,

        (SELECT COUNT(comment_post_id) FROM ".$prefix."comment WHERE comment_post_id = ads_id and comment_status=1) AS total_comments";



        // LEFT JOIN

        /*$param['joins'][] = array(

            "table"=>"ads_category" ,

            "joint"=>"ads_category.ads_category_id = ads.ads_category_id and ads_category.ads_category_status =1",

            "type"=>"left"

        );*/



        $param['where']['ads_slug'] = $slug;

        // Query

        $result = $this->find_one_active($param);



        // Return result;

        return $result;

    }

    // Get news comments
    public function get_comments($slug)
    {
        // Set params
        $params['fields'] = "ads_id,ads_title,comment_post_id,comment_name,comment_description,comment_created_on";
        $params['where']['ads_slug'] = $slug;
        // Join
        $params['joins'][] = array(
            "table"=>"comment" ,
            "joint"=>"ads.ads_id = comment_post_id and comment_status=1",
        );
        $params['order'] = 'comment_id DESC';

        return $this->model_ads->find_all_active($params);
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

            'ads_id' => array(
                'table' => $this->_table,
                'name' => 'ads_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

            'ads_category_id' => array(
                 'table'   => $this->_table,
                 'name'   => 'ads_category_id',
                 'label'   => 'Category',
                 'type'   => 'dropdown',
                 'type_dt'   => 'dropdown',
                 'list_data' => array(),
                 'attributes'   => array(),
                 'js_rules'   => 'required',
                 'rules'   => 'trim'
             ),

            'ads_location_id' => array(
                 'table'   => $this->_table,
                 'name'   => 'ads_location_id',
                 'label'   => 'Category',
                 'type'   => 'dropdown',
                 'type_dt'   => 'dropdown',
                 'list_data' => array(),
                 'attributes'   => array(),
                 'js_rules'   => 'required',
                 'rules'   => 'trim'
             ),

            

            'ads_user_id' => array(
                'table' => $this->_table,
                'name' => 'ads_user_id',
                'label' => 'id #',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            ),

            

              'ads_title' => array(
                     'table'   => $this->_table,
                     'name'   => 'ads_title',
                     'label'   => 'Title',
                     'type'   => 'text',
                     'attributes'   => array("additional"=>'slugify="#'.$this->_table.'-'.$this->_field_prefix.'slug"'),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim|htmlentities'
                  ),

              'ads_slug'  => array(
                  'table'   => $this->_table,
                  'name'   => 'ads_slug',
                  'label'   => 'Slug',
                  'type'   => 'hidden',
                  'attributes'   => array(),
                  'js_rules'   => array("is_slug" => array() ),
                  'rules'   => 'required|htmlentities|strtolower|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug'
              ),

             //   'ads_name' => array(
             //     'table'   => $this->_table,
             //     'name'   => 'ads_name',
             //     'label'   => 'Name',
             //     'type'   => 'text',
             //     'list_data' => array(),
             //     'attributes'   => array(),
             //     'js_rules'   => 'required',
             //     'rules'   => 'required|trim'
             // ),

               'ads_email' => array(
                 'table'   => $this->_table,
                 'name'   => 'ads_email',
                 'label'   => 'Email',
                 'type'   => 'text',
                 'list_data' => array(),
                 'attributes'   => array(),
                 'js_rules'   => 'required',
                 'rules'   => 'required|trim'
             ),


               'ads_address' => array(
                 'table'   => $this->_table,
                 'name'   => 'ads_address',
                 'label'   => 'Address',
                 'type'   => 'text',
                 'list_data' => array(),
                 'attributes'   => array(),
                 'js_rules'   => 'required',
                 'rules'   => 'required|trim'
             ),

               'ads_phone' => array(
                 'table'   => $this->_table,
                 'name'   => 'ads_phone',
                 'label'   => 'Phone',
                 'type'   => 'text',
                 'list_data' => array(),
                 'attributes'   => array(),
                 'js_rules'   => 'required',
                 'rules'   => 'required|trim'
             ),


             //   'ads_category' => array(
             //     'table'   => $this->_table,
             //     'name'   => 'ads_category',
             //     'label'   => 'Category',
             //     'type'   => 'text',
             //     'type_dt'   => 'text',
             //     'list_data' => array(),
             //     'attributes'   => array(),
             //     'js_rules'   => 'required',
             //     'rules'   => 'required|trim'
             // ),

               

               

               'ads_other_category' => array(
                 'table'   => $this->_table,
                 'name'   => 'ads_other_category',
                 'label'   => 'Other Category',
                 'type'   => 'text',
                 'list_data' => array(),
                 'attributes'   => array(),
                 'js_rules'   => '',
                 'rules'   => 'trim'
             ),
    
            'ads_description2' => array(
                 'table' => $this->_table,
                 'name' => 'ads_description2',
                 'label' => 'Front Description',
                 'type' => 'editor',
                 'attributes' => array(),
                 'js_rules' => 'required',
                 'rules' => 'trim|htmlentities'
             ),
             

            'ads_description' => array(
                'table' => $this->_table,
                'name' => 'ads_description',
                'label' => 'Description',
                'type' => 'editor',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'trim|htmlentities'
            ),

            'ads_websitelink' => array(
                'table' => $this->_table,
                'name' => 'ads_websitelink',
                'label' => 'Website Link',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim|htmlentities'
            ),

            'ads_social_media_link' => array(
                'table' => $this->_table,
                'name' => 'ads_social_media_link',
                'label' => 'Social Link',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'trim|htmlentities'
            ),


            
            
          
           

            'ads_image' => array(
                'table' => $this->_table,
                'name' => 'ads_image',
                'label' => 'Image',
                'name_path' => 'ads_image_path',
                'upload_config' => 'site_upload_ads',
                'type' => 'fileupload',
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'thumb'   => array(array('name'=>'ads_image_thumb','max_width'=>470, 'max_height'=>316),),
                'attributes'   => array(
                    'image_size_recommended'=>'370px × 225px',
                    'allow_ext'=>'png|jpeg|jpg',
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'=>$is_required_image
            ),


            'ads_featured' => array(
                'table' => $this->_table,
                'name' => 'ads_featured',
                'label' => 'Featured?',
                'type' => 'switch',
                'type_dt' => 'switch',
                'type_filter_dt' => 'dropdown',
                'list_data' => array(),
                'default' => '0',
                'attributes' => array(),
                'dt_attributes' => array("width" => "7%"),
                'rules' => 'trim'
            ),

          
            'ads_status' => array(
                'table' => $this->_table,
                'name' => 'ads_status',
                'label' => 'Status?',
                'type' => 'switch',
                'type_dt' => 'switch',
                'type_filter_dt' => 'dropdown',
                'list_data' => array(),
                'default' => '0',
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