<?

class Model_banner extends MY_Model
{
    /**
     * TKD banner MODEL
     *
     * @package     banner Model
     * @version     1.0
     * @since       2017
     */

    protected $_table = 'banner';
    protected $_field_prefix = 'banner_';
    protected $_pk = 'banner_id';
    protected $_status_field = 'banner_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        //$this->pagination_params['fields'] = "banner_id,banner_page,banner_heading,CONCAT(banner_image_path,banner_image) AS banner_image,banner_status";
        $this->pagination_params['fields'] = "banner_id,,banner_heading,CONCAT(banner_image_path,banner_image) AS banner_image,banner_status";
        //$this->pagination_params['fields'] = "banner_id,banner_heading,banner_status";

        parent::__construct();
    }

    public function get_banners($id = 0)
    {
        // Set params
        $params['fields'] = "banner_heading,banner_image,banner_image_path";
        $params['where']['banner_status'] = 1;
        return $this->model_banner->find_by_pk($id,false,$params);

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
        // Show button link and url
        $segment = array(1);
        $segment_id = $this->uri->segment(4);

        // Use when add new image
        $is_required_image = (($this->uri->segment(4) != null) && intval($this->uri->segment(4))) ? '' : 'required';

        $fields['banner_id'] = array(
            'table' => $this->_table,
            'name' => 'banner_id',
            'label' => 'ID',
            'type' => 'hidden',
            'type_dt' => 'text',
            'attributes' => array(),
            'dt_attributes' => array("width" => "5%"),
            'js_rules' => 'required',
            'rules' => 'trim'
        );

//         $fields['banner_page'] = array(
//             'table' => $this->_table,
//             'name' => 'banner_page',
//             'label' => 'Page',
//             'type' => 'dropdown',
//             'list_data' => array(
//                 '1' => 'Home',
//                 '2' => 'About',
//                 '3' => 'Contact',
//                 '4'=>'Media Type',
//                 '5'=>'Login/Signup',
//                 '6'=>'Cart/Checkout',
//                 '7'=>'Forgot Password',
// //                '5' => 'Support / Help',
// //                '6' => 'Supported Supplier',
// //                '7' => 'Service Partner',
// //                '8' => 'My Account',
//             ),
//             'attributes' => array(),
//             'js_rules' => 'required',
//             'rules' => 'required|trim|htmlentities'
//         );


        $fields['banner_heading'] = array(
            'table' => $this->_table,
            'name' => 'banner_heading',
            'label' => 'Heading',
            'type' => 'text',
            'attributes' => array(),
            'js_rules' => 'required',
            'rules' => 'required|trim|htmlentities'
        );
        /*$fields['banner_sub_heading'] = array(
            'table' => $this->_table,
            'name' => 'banner_sub_heading',
            'label' => 'Sub Heading',
            'type' => 'text',
            'attributes' => array(),
            'rules' => 'trim|htmlentities'
        );*/
         $fields['banner_description'] = array(
             'table' => $this->_table,
             'name' => 'banner_description',
             'label' => 'Description',
             'type' => 'editor',
             //'type' => 'hidden',
             'attributes' => array(),
             'js_rules' => 'required',
             'rules' => 'trim|htmlentities'
         );
         // $fields['banner_content_placement'] = array(
         //     'table' => $this->_table,
         //     'name' => 'banner_content_placement',
         //     'label' => 'Content Placement',
         //     'type' => 'dropdown',
         //     'list_data'=>array(
         //         'left'=>'Left',
         //         'right'=>'Right',
         //     ),
         //     //'type' => 'hidden',
         //     'attributes' => array(),
         //     'js_rules' => 'required',
         //     'rules' => 'required|trim|htmlentities'
         // );

        // $fields['banner_button_1'] = array(
        //     'table' => $this->_table,
        //     'name' => 'banner_button_1',
        //     'label' => 'Button Label',
        //     'type' => 'text',
        //     'attributes' => array(),
        //     'js_rules' => '',
        //     'rules' => 'trim'
        // );
        // $fields['banner_button_1_link'] = array(
        //     'table' => $this->_table,
        //     'name' => 'banner_button_1_link',
        //     'label' => 'Button Link',
        //     'type' => 'text',
        //     'attributes' => array(),
        //     'rules' => 'trim'
        // );

        /*$fields['banner_button_2'] = array(
        'table' => $this->_table,
        'name' => 'banner_button_2',
        'label' => 'Button # 2',
        'type' => 'text',
        'attributes' => array(),

        'rules' => 'trim'
    );
        $fields['banner_button_2_link'] = array(
        'table' => $this->_table,
        'name' => 'banner_button_2_link',
        'label' => 'Button Link',
        'type' => 'text',
        'attributes' => array(),

        'rules' => 'trim'
    );*/



        /*if (in_array($segment_id, $segment)) {
            $fields['banner_button_1'] = array(
                'table' => $this->_table,
                'name' => 'banner_button_1',
                'label' => 'Button Label',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'trim|required'
            );
            $fields['banner_button_1_link'] = array(
                'table' => $this->_table,
                'name' => 'banner_button_1_link',
                'label' => 'Button Link',
                'type' => 'text',
                'attributes' => array(),
                'rules' => 'trim'
            );
        } elseif ($segment_id == 4) {
            $fields['banner_button_1'] = array(
                'table' => $this->_table,
                'name' => 'banner_button_1',
                'label' => 'Button Label',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'trim|required'
            );
        }*/

        /*'banner_button_2' => array(
            'table' => $this->_table,
            'name' => 'banner_button_2',
            'label' => 'Button # 2',
            'type' => 'text',
            'attributes' => array(),

            'rules' => 'trim'
        ),
        'banner_button_2_link' => array(
            'table' => $this->_table,
            'name' => 'banner_button_2_link',
            'label' => 'Button Link',
            'type' => 'text',
            'attributes' => array(),

            'rules' => 'trim'
        ),

        'banner_position' => array(
            'table'   => $this->_table,
            'name'   => 'banner_position',
            'label'   => 'Position',
            'type'   => 'dropdown',
            'list_data'    => array("1"=>"1","2"=>"2","3"=>"3","4"=>"4","5"=>"5") ,
            'attributes'   => array(),
            'js_rules'   => '',
            'rules'   => 'required',
        ),*/

        // $fields['banner_image'] = array(
        //     'table' => $this->_table,
        //     'name' => 'banner_image',
        //     'label' => 'Video',
        //     'name_path' => 'banner_image_path',
        //     'upload_config' => 'site_upload_banner',
        //     'type' => 'videoupload',
        //     //'type_dt' => 'image',
        //     'randomize' => true,
        //     'preview' => 'true',
        //     'attributes' => array(
        //         //'image_size_recommended' => '1344px × 381px',
        //         'allow_ext' => 'mp4',
        //     ),
        //     'dt_attributes' => array("width" => "10%"),
        //     'rules' => '',
        //     'js_rules' => $is_required_image
        // );

        $fields['banner_image'] = array(
            'table' => $this->_table,
            'name' => 'banner_image',
            'label' => 'Image',
            'name_path' => 'banner_image_path',
            'upload_config' => 'site_upload_banner',
            'type' => 'fileupload',
            'type_dt' => 'image',
            'randomize' => true,
            'preview' => 'true',
            'attributes' => array(
                'image_size_recommended' => '1803px × 1046px',
                'allow_ext' => 'png|jpeg|jpg',
            ),
            'thumb'   => array(array('name'=>'banner_image_thumb','max_width'=>320, 'max_height'=>200, "destination_path"=>''),),
            'dt_attributes' => array("width" => "10%"),
            'rules' => '',
            'js_rules' => $is_required_image
        );


        /*'banner_url' => array(
            'table'   => $this->_table,
            'name'   => 'banner_url',
            'label'   => 'Link',
            'type'   => 'text',
            'attributes'   => array(),
            'js_rules'   => 'required',
            'rules'   => 'required|trim|htmlentities'
        ),*/

        $fields['banner_status'] = array(
            'table' => $this->_table,
            'name' => 'banner_status',
            'label' => 'Status',
            'type' => 'switch',
            'type_dt' => 'switch',
            'type_filter_dt' => 'dropdown',
            'list_data_key' => "news_status" ,
            'list_data' => array(
                0 => "<span class='label label-danger'>Inactive</span>" ,
                1 =>  "<span class='label label-primary'>Active</span>"
            ) ,
            'default' => '1',
            'attributes' => array(),
            'dt_attributes' => array("width" => "7%"),
            'rules' => 'trim'
        );

        if ($specific_field)
            return $fields[$specific_field];
        else
            return $fields;

    }

}

?>