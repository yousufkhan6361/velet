<?
class Model_gallery extends MY_Model {
  
    /**
     * Model_gallery
     *
     * @package     model_gallery Model
     * 
     * @version     1.0
     * @since       2018 / Amazingly corrupt models Corporation Inc.
     */

    protected $_table    = 'gallery';
    protected $_field_prefix    = 'gallery_';
    protected $_pk    = 'gallery_id';
    protected $_status_field    = 'gallery_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page    = 20;
    
    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "gallery_id,gallery_name,CONCAT(gallery_image_path,gallery_image) AS gallery_image,gallery_status";
        /*$this->pagination_params['joins'][] = array(
                                                    "table"=>"category" , 
                                                    "joint"=>"category.category_id = gallery.gallery_category_id"
                                                    );*/
        parent::__construct();
    }

    // Get gallery image
    public function gallery($limit = 8)
    {
        // Set params
        //$params['fields'] = "gallery_id,gallery_name,CONCAT(gallery_image_path, '', gallery_image) as gallery_image,
        // CONCAT(gallery_image_path,gallery_image_thumb) AS gallery_image_thumb";
        //$params['order'] = "gallery_id DESC";
        $params['limit'] = $limit;
        // Query
        $result = $this->model_gallery->find_all_active($params);
        // return result
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

        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $fields = array(
        
              'gallery_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'gallery_id',
                     'label'   => 'ID',
                     'type'   => 'hidden',
                     'type_dt'   => 'text',
                     'attributes'   => array(),
                     'dt_attributes'   => array("width"=>"5%"),
                     'js_rules'   => '',
                     'rules'   => 'trim'
                ),
              /*'gallery_category_id' => array(
                     'table'   => $this->_table,
                     'name'   => 'gallery_category_id',
                     'label'   => 'Category',
                     'type'   => 'dropdown',
                     'type_dt'   => 'text',
                     'type_filter_dt'   => 'dropdown',
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim'
                ),*/

              'gallery_name' => array(
                     'table'   => $this->_table,
                     'name'   => 'gallery_name',
                     'label'   => 'Name',
                     'type'   => 'text',
                     'attributes'   => array(),
                     'default'   => '',
                     'rules'   => 'trim|htmlentities|required',
                     'js_rules'   => 'required'
                  ),
              /*'gallery_description' => array(
                     'table'   => $this->_table,
                     'name'   => 'gallery_description',
                     'label'   => 'Description',
                     'type'   => 'textarea',
                     'attributes'   => array(),
                     'default'   => '',
                     'rules'   => 'trim|htmlentities|required',
                     'js_rules'   => 'required'
                  ),*/

            'gallery_description' => array(
                'table'   => $this->_table,
                'name'   => 'gallery_description',
                'label'   => 'Description',
                'type'   => 'editor',
                'attributes'   => array(),
                'default'   => '',
                'rules'   => 'trim|htmlentities|required',
                'js_rules'   => 'required'
            ),

            'gallery_image' => array(
                'table' => $this->_table,
                'name' => 'gallery_image',
                'label' => 'Image',
                'name_path' => 'gallery_image_path',
                'upload_config' => 'site_upload_gallery',
                'type' => 'fileupload',
                'thumb'   => array(array('name'=>'gallery_image_thumb','max_width'=>260, 'max_height'=>250),),
                'attributes'   => array(
                    'image_size_recommended'=>'260px × 250px',
                    'allow_ext'=>'png|jpeg|jpg',
                ),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'   => $is_required_image,
            ),
              /*
              'gallery_code' => array(
                     'table'   => $this->_table,
                     'name'   => 'gallery_code',
                     'label'   => 'gallery Code',
                     'type'   => 'gallerypicker',
                     'attributes'   => array(),
                     'js_rules'   => 'required',
                     'rules'   => 'required|trim'
                  ),
                
              'gallery_slug' => array(
                     'table'   => $this->_table,
                     'name'   => 'gallery_slug',
                     'label'   => 'gallery Slug',
                     'type'   => 'gallerypicker',
                     'attributes'   => array(),
                     'js_rules'   => array("is_slug" => array() ),
                     'rules'   => 'required|htmlentities|is_unique['.$this->_table.'.'.$this->_field_prefix.'slug]|callback_is_slug'
                  ),

    */
            

              'gallery_status' => array(
                     'table'   => $this->_table,
                     'name'   => 'gallery_status',
                     'label'   => 'Status',
                     'type'   => 'switch',
                     'type_dt'   => 'dropdown',
                     'type_filter_dt'   => 'dropdown',
                     'list_data' => array( 
                                   
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