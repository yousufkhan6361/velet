<?

class Model_cms_page extends MY_Model
{


    protected $_table = 'cms_page';
    protected $_field_prefix = 'cms_page_';
    protected $_pk = 'cms_page_id';
    protected $_status_field = 'cms_page_status';
    public $relations = array();
    public $pagination_params = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // $this->type = (intval($this->uri->segment(4)) == 2 ? 'editor' : 'hidden');
        // $this->file = (intval($this->uri->segment(4)) == 2 ? 'fileupload' : 'hidden');

        // Call the Model constructor
        $this->pagination_params['fields'] = "cms_page_id,cms_page_page,cms_page_name,cms_page_status";


        parent::__construct();
    }

public function get_page($id = 0)
    {
        $param['where']['cms_page_status'] = '1';

        if (intval($id) > 0)
            $param['where']['cms_page_id'] = intval($id);

        $param['fields'] = "cms_page_id,cms_page_page,cms_page_name,cms_page_title,cms_page_content,cms_page_other_content,cms_page_other_content_3,cms_page_other_content_4,cms_page_image,cms_page_image_2,cms_page_image_3,cms_page_image_4,cms_page_image_5,cms_page_image_path,cms_page_button_label,cms_page_button_url,cms_page_status";

        $param['order'] = 'cms_page_id DESC';

        return $this->model_cms_page->find_one_active($param);
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
    public function get_fields($specific_field = "")
    {
        // Allow images
        $allow_images = array();
        $not_allow_content = array();
        $allow_images_4 = array();
        $allow_images_5 = array();
        $allow_images_one = array(6,2,5);
        $allow_content_1 = array(1,2,3,4,5);
        $allow_content_2 = array();
        $allow_content_3 = array();
        $allow_content_4 = array();
        $segment_id = $this->uri->segment(4);

        // Use only in SUBSCRIBE PAGE
        //$image_status = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)==18))?'hidden':'fileupload';

        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';
        
  
        $fields['cms_page_id'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_id',
                'label' => 'ID',
                'type' => 'hidden',
                'type_dt' => 'text',
                'attributes' => array(),
                'dt_attributes' => array("width" => "5%"),
                'js_rules' => '',
                'rules' => 'trim'
            );

             $fields['cms_page_page'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_page',
                'label' => 'Page',
                'type_dt' => 'text',
                'type' => 'hidden',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            );
               

            $fields['cms_page_name'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_name',
                'label' => 'Name',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            );

        if ($this->uri->segment(4) == 10 || $this->uri->segment(4) == 55 || $this->uri->segment(4) == 19 || $this->uri->segment(4) == 18) {

            $fields['cms_page_title'] = array(
                 'table' => $this->_table,
                'name' => 'cms_page_title',
                'label' => 'Title',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim|htmlentities'
            );
        }
        if(!in_array($segment_id,$not_allow_content)){
            $fields['cms_page_content'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_content',
                'label' => 'Content',
                'type' => 'editor',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim|htmlentities'
            );
        }

        if(in_array($segment_id,$allow_content_2)){
            $fields['cms_page_other_content'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_other_content',
                'label' => 'Content 2',
                'type' => 'editor',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim|htmlentities'
            );
        }


        if(in_array($segment_id,$allow_content_3)){
            $fields['cms_page_other_content_3'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_other_content_3',
                'label' => 'Content 3',
                'type' => 'editor',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim|htmlentities'
            );
        }

        if(in_array($segment_id,$allow_content_4)){
            $fields['cms_page_other_content_4'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_other_content_4',
                'label' => 'Content 4',
                'type' => 'editor',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim|htmlentities'
            );
        }

         // if ($this->uri->segment(4) == 7 || $this->uri->segment(4) == 8) {

         //  $fields['cms_page_other_content'] = array(
         //        'table' => $this->_table,
         //        'name' => 'cms_page_other_content',
         //        'label' => 'Detail',
         //        'type' => 'editor',
         //        'attributes' => array(),
         //        'js_rules' => '',
         //        'rules' => 'trim|htmlentities'
         //    );
         // }

         // segment is the piece of url
         // uri == url path , segment(4) == base_url/!st segment /2nd segment , like wise 4th segment
        // if ($this->uri->segment(4) == 7 || $this->uri->segment(4) == 8) {

        //    $fields['cms_page_other_content2'] = array(
        //         'table' => $this->_table,
        //         'name' => 'cms_page_other_content2',
        //         'label' => 'Detail 2',
        //         'type' => 'editor',
        //         'attributes' => array(),
        //         'js_rules' => '',
        //         'rules' => 'trim|htmlentities'
        //     );
        // }

//if (($this->uri->segment(4) == 1)  || ($this->uri->segment(4) ==21) || ($this->uri->segment(4) ==23) || ($this->uri->segment(4) ==19) || ($this->uri->segment(4) ==22)) {

            /*$fields['cms_page_image'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_image',
                'label' => 'Image',
                'name_path' => 'cms_page_image_path',
                'upload_config' => 'site_upload_cms_image',
                //'type' => $image_status,
                'type' => 'fileupload',
                //'type' => (!empty($is_required_image)?'password':'hidden'),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes'   => array(
                    'allow_ext'=>'png|jpeg|jpg',
                    'Recommended size' => '490px X 520px'
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
                'js_rules'=>''
            );*/
    //    }

        /*$fields['cms_page_video_url'] = array(
            'table' => $this->_table,
            'name' => 'cms_page_video_url',
            'label' => 'Youtube URL',
            'type' => 'text',
            'attributes'   => array(),
            'js_rules' => '',
            'rules' => 'trim|htmlentities|regex_match[/^(https\:\/\/)?(www\.youtube\.com\/embed)\/.+$/]'
        );*/

        if(in_array($segment_id,$allow_images_one)){
            $fields['cms_page_image'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_image',
                'label' => 'Image',
                'name_path' => 'cms_page_image_path',
                'upload_config' => 'site_upload_cms_image',
                //'type' => $image_status,
                'type' => 'fileupload',
                //'type' => (!empty($is_required_image)?'password':'hidden'),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes'   => array(
                    'allow_ext'=>'png|jpeg|jpg',
                    'image_size_recommended'=>'635px × 800px',
                    //'Recommended size' => '490px X 520px'
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
            );
        }
        if(in_array($segment_id,$allow_images)){
            $fields['cms_page_image_2'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_image_2',
                'label' => 'Image',
                'name_path' => 'cms_page_image_path',
                'upload_config' => 'site_upload_cms_image',
                //'type' => $image_status,
                'type' => 'fileupload',
                //'type' => (!empty($is_required_image)?'password':'hidden'),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes'   => array(
                    'allow_ext'=>'png|jpeg|jpg',
                    'image_size_recommended'=>'635px × 800px',
                    //'Recommended size' => '490px X 520px'
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
            );
        }

        if(in_array($segment_id,$allow_images)){
            $fields['cms_page_image_3'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_image_3',
                'label' => 'Image',
                'name_path' => 'cms_page_image_path',
                'upload_config' => 'site_upload_cms_image',
                //'type' => $image_status,
                'type' => 'fileupload',
                //'type' => (!empty($is_required_image)?'password':'hidden'),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes'   => array(
                    'allow_ext'=>'png|jpeg|jpg',
                    'image_size_recommended'=>'635px × 800px',
                    //'Recommended size' => '490px X 520px'
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
            );
        }

        if(in_array($segment_id,$allow_images_4)){
            $fields['cms_page_image_4'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_image_4',
                'label' => 'Image',
                'name_path' => 'cms_page_image_path',
                'upload_config' => 'site_upload_cms_image',
                //'type' => $image_status,
                'type' => 'fileupload',
                //'type' => (!empty($is_required_image)?'password':'hidden'),
                'type_dt' => 'image',
                'randomize' => true,
                'preview' => 'true',
                'attributes'   => array(
                    'allow_ext'=>'png|jpeg|jpg',
                    'image_size_recommended'=>'635px × 800px',
                    //'Recommended size' => '490px X 520px'
                ),
                'dt_attributes' => array("width" => "10%"),
                'rules' => 'trim|htmlentities',
            );
        }

        if(in_array($segment_id,$allow_images_5)){
            $fields['cms_page_image_5'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_image_5',
                'label' => 'Video',
                'name_path' => 'cms_page_image_path',
                'upload_config' => 'site_upload_cms_image',
                //'type' => $image_status,
                'type' => 'videoupload',
                //'type' => (!empty($is_required_image)?'password':'hidden'),
                'type_dt' => 'videoupload',
                'randomize' => true,
                'preview' => 'true',
                'attributes'   => array(
                    'allow_ext'=>'mp4',
                ),
                'dt_attributes' => array(),
                'rules' => 'trim|htmlentities',
            );
        }




             $fields['cms_page_status'] = array(
                'table' => $this->_table,
                'name' => 'cms_page_status',
                'label' => 'Status',
                'type' => 'hidden',
                'type_dt' => 'dropdown',
                'type_filter_dt' => 'dropdown',
                'list_data_key' => "cms_page_status",
                'list_data' => array(),
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