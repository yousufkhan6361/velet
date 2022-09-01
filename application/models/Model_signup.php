<?

class Model_signup extends MY_Model
{

    protected $_table = 'signup';
    protected $_field_prefix = 'signup_';
    protected $_pk = 'signup_id';
    protected $_status_field = 'signup_status';
    public $pagination_params = array();
    public $relations = array();
    public $dt_params = array();
    public $_per_page = 20;

    function __construct()
    {
        // Call the Model constructor
        $this->pagination_params['fields'] = "signup_id,signup_firstname,signup_lastname,signup_email,signup_status";

        // Call the Model constructor
        parent::__construct();
    }

     public function login($data)
    {
        // Get CodeIgnier Instance
        $CI = & get_instance();

        $params['where']['signup_email'] = $data['signup_email'];
        $params['where']['signup_password'] =$data['signup_password'];
        $signup = $this->find_one($params , true);

        // debug('$signup');
        // debug($data,1);

        if (!$signup) {
            $CI->form_validation->set_message('signup_check', 'Incorrect signupname or ID');
            return FALSE;
        } else {
            $this->set_signup_session($signup);
            return true;
        }

    }

    public function auto_login($user_id)
    {
        // Set params
        $params['where']['signup_id'] = $user_id;
        // Query
        $user = $this->model_signup->find_one_active($params);
        // Get CodeIgnier Instance

        $this->set_user_session($user);
    }

    // Set Session for login user
    public function set_user_session($signup)
    {
        // Set data
        $array = array(
            'signup_id' => $signup['signup_id'],
            //'signup_type' => $signup['signup_type'],
            'signup_firstname' => ucfirst($signup['signup_firstname']),
            'signup_lastname' => ucfirst($signup['signup_lastname']),
            'signup_company' => $signup['signup_company'],
            'signup_email' => $signup['signup_email'],
            'signup_username' => $signup['signup_username'],
            'signup_address' => $signup['signup_address'],
            'signup_zip' => $signup['signup_zip'],
            'signup_city' => $signup['signup_city'],
            'signup_state' => $signup['signup_state'],
            'signup_country' => $signup['signup_country'],
            'signup_contact' => $signup['signup_contact'],
            'signup_image' => $signup['signup_logo_image_path'] . $signup['signup_logo_image'],
            'signup_createdon'=>$signup['signup_createdon'],
            //'type'=>'1' // for teacher and parents
        );
        // Set session
        $this->session->set_userdata('userdata', $array);

    }

    // Update user session
    public function update_user_session($signup)
    {
        // Get user session
        $user_session = $this->session->userdata('userdata');
        // Loop each session
        foreach($signup as $key=>$value):
            $user_session[$key] = $value;
            $this->session->set_userdata('userdata',$user_session);
        endforeach;
    }

    // Get total members
    public function get_total_members()
    {
        // Set params
        $params['where_string'] = " signup_status!=2";
        $result = $this->find_count($params);
        return $result;
    }

    public function get_fields($specific_field = "")
    {
        // Use when add new image
        $is_required_image = (($this->uri->segment(4)!=null) && intval($this->uri->segment(4)))?'':'required';

        $data =  array(

            'signup_id' => array(
                'table' => $this->_table,
                'name' => 'signup_id',
                'label' => 'ID',
                'primary' => 'primary',
                'type' => 'hidden',
                'attributes' => array(),
                'js_rules' => '',
                'rules' => 'trim'
            ),

            'signup_company' => array(
                'table' => $this->_table,
                'name' => 'signup_company',
                'label' => ' Company',
                'type' => 'text',
                'attributes' => array(),
                // 'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),


            

            // 'signup_firstname' => array(
            //     'table' => $this->_table,
            //     'name' => 'signup_firstname',
            //     'label' => 'First Name',
            //     'type' => 'text',
            //     'attributes' => array(),
            //     'js_rules' => '',
            //     'rules' => 'strtolower|trim|htmlentities|min_length[3]'
            // ),

            // 'signup_lastname' => array(
            //     'table' => $this->_table,
            //     'name' => 'signup_lastname',
            //     'label' => 'Last Name',
            //     'type' => 'text',
            //     'attributes' => array(),
            //     'js_rules' => '',
            //     'rules' => 'strtolower|trim|htmlentities|min_length[3]'
            // ),

        'signup_phone' => array(
                'table' => $this->_table,
                'name' => 'signup_phone',
                'label' => ' Contact ',
                'type' => 'text',
                'attributes' => array(),
                'rules' => 'required|trim|htmlentities'
            ),


        'signup_service_for' => array(
                'table' => $this->_table,
                'name' => 'signup_service_for',
                'label' => ' Service For',
                'type' => 'text',
                'attributes' => array(),
                // 'js_rules' => 'required',
                'rules' => 'required|trim|htmlentities'
            ),


            // 'signup_username' => array(
            //     'table' => $this->_table,
            //     'name' => 'signup_username',
            //     'label' => 'Username',
            //     'type' => (!empty($is_required_image)?'text':'readonly'),
            //     'attributes'   => array('class'=>'readonlytxt'),
            //     'js_rules' => 'required',
            //     'rules' => 'required|strtolower|trim|htmlentities|is_unique[' . $this->_table . '.' . $this->_field_prefix . 'username]'
            // ),
            'signup_email' => array(
                'table' => $this->_table,
                'name' => 'signup_email',
                'label' => 'Email',
                'type' => (!empty($is_required_image)?'text':'readonly'),
                'attributes'   => array('class'=>'readonlytxt'),
                'js_rules' => 'required',
                'rules' => 'required|valid_email|strtolower|trim|htmlentities|is_unique[' . $this->_table . '.' . $this->_field_prefix . 'email]'
            ),

            'signup_password' => array(
                'table' => $this->_table,
                'name' => 'signup_password',
                'label' => 'Password',
                'type' => (!empty($is_required_image)?'password':'hidden'),
                'default' => '',
                'attributes' => array(),
                'rules' => 'required|trim|min_length[6]|md5'
            ),

          

            // 'signup_address' => array(
            //     'table' => $this->_table,
            //     'name' => 'signup_address',
            //     'label' => 'Address',
            //     'type' => 'text',
            //     'attributes' => array(),
            //     'js_rules' => '',
            //     'rules' => 'strtolower|trim|htmlentities|min_length[3]'
            // ),

            // 'signup_state' => array(
            //     'table' => $this->_table,
            //     'name' => 'signup_state',
            //     'label' => 'State',
            //     'type' => 'text',
            //     'attributes' => array(),
            //     'js_rules' => '',
            //     'rules' => 'strtolower|trim|htmlentities'
            // ),

            // 'signup_country' => array(
            //     'table' => $this->_table,
            //     'name' => 'signup_country',
            //     'label' => 'Country',
            //     'type' => 'text',
            //     'attributes' => array(),
            //     // 'js_rules' => 'required',
            //     'rules' => 'strtolower|trim|htmlentities'
            // ),


        // 'signup_city' => array(
        //         'table' => $this->_table,
        //         'name' => 'signup_city',
        //         'label' => ' City',
        //         'type' => 'text',
        //         'attributes' => array(),
        //         // 'js_rules' => 'required',
        //         'rules' => 'trim|htmlentities'
        //     ),

          /*'signup_industry' => array(
                'table' => $this->_table,
                'name' => 'signup_industry',
                'label' => ' Industry',
                'type' => 'text',
                'attributes' => array(),
                // 'js_rules' => 'required',
                'rules' => 'strtolower|trim|htmlentities'
            ),

             'signup_business_name' => array(
                'table' => $this->_table,
                'name' => 'signup_business_name',
                'label' => ' Business Name',
                'type' => 'text',
                'attributes' => array(),
                // 'js_rules' => 'required',
                'rules' => 'strtolower|trim|htmlentities'
            ),

             'signup_address2' => array(
                'table' => $this->_table,
                'name' => 'signup_address2',
                'label' => 'Business Address',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'strtolower|trim|htmlentities|min_length[3]'
            ),*/

           /* 'signup_type' => array(
                'table' => $this->_table,
                'name' => 'signup_type',
                'label' => 'Signup Type',
                'type' => 'dropdown',
                'list_data'=>array(
                    '1'=>'User',
                    '2'=>'Parent',
                    '3'=>'Teacher',
                ),
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|strtolower|trim|htmlentities'
            ),

            'signup_category' => array(
                'table' => $this->_table,
                'name' => 'signup_category',
                'label' => 'Category',
                'type' => 'dropdown',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|strtolower|trim|htmlentities'
            ),

            'signup_level' => array(
                'table' => $this->_table,
                'name' => 'signup_level',
                'label' => 'Level',
                'type' => 'dropdown',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|strtolower|trim|htmlentities'
            ),

            'signup_language' => array(
                'table' => $this->_table,
                'name' => 'signup_language',
                'label' => 'Language',
                'type' => 'text',
                'attributes' => array(),
                'js_rules' => 'required',
                'rules' => 'required|strtolower|trim|htmlentities'
            ),*/

           /* 'signup_item_type' => array(
                'table' => $this->_table,
                'name' => 'signup_item_type',
                'label' => 'Item Type',
                'type' => 'dropdown',
                'attributes' => array(),
                'list_data' => array(
                    '1' => 'Regular E-Book',
                    '2' => 'Special E-book1',
                    '3' => 'Special E-book2',
                    '4' => 'Audio Book',
                    '5' => 'Interactive Activities',
                    '6' => 'Pluralsight',
                ),
                'js_rules' => 'required',
                'rules' => 'required|strtolower|trim|htmlentities'
            ),*/

            // 'signup_token' => array(
            //     'table'   => $this->_table,
            //     'name'   => 'signup_token',
            //     'label'   => 'Signup Token',
            //     'type'   => 'hidden',
            //     'list_data' => array(
            //     ) ,
            //     'attributes'   => array(),
            //     'dt_attributes'   => array("width"=>"7%"),
            //     'rules'   => 'trim'
            // ),

            // 'signup_logo_image' => array(
            //     'table' => $this->_table,
            //     'name' => 'signup_logo_image',
            //     'label' => 'Image',
            //     'name_path' => 'signup_logo_image_path',
            //     'upload_config' => 'site_upload_signup',
            //     'type' => 'fileupload',
            //     'type_dt' => 'image',
            //     'randomize' => true,
            //     'preview' => 'true',
            //     'attributes'   => array(
            //         'image_size_recommended'=>'1024px × 640px',
            //         'allow_ext'=>'png|jpeg|jpg',
            //     ),
            //     'thumb'   => array(array('name'=>'signup_logo_image_thumb','max_width'=>150, 'max_height'=>150),),
            //     'dt_attributes' => array("width" => "10%"),
            //     'rules' => 'trim|htmlentities',
            //     'js_rules'=>''
            // ),

           /* 'signup_status' => array(
                'table' => $this->_table,
                'name' => 'signup_status',
                'label' => 'Status?as',
                'type' => 'switch',
                'default' => '1',
                'attributes' => array(),
                'list_data' => array(),
                'rules' => 'trim'
            ),*/

           'signup_status'=> array(
                'table' => $this->_table,
                'name' => 'signup_status',
                'label' => 'Status',
                'type' => 'switch',
                'type_dt' => 'switch',
                'type_filter_dt' => 'dropdown',
                   'list_data' => array(
                       0 => "<span class='label label-danger'>Inactive</span>" ,
                       1 =>  "<span class='label label-primary'>Active</span>"
                   ) ,
                'default' => '1',
                'attributes' => array(),
                'dt_attributes' => array("width" => "7%"),
                'rules' => 'trim'
            ),

            /*'signup_social' => array(
                'table' => $this->_table,
                'name' => 'signup_social',
                'label' => 'Social Login',
                'type' => 'hidden',
                'default' => '0',
                'attributes' => array(),
                'rules' => 'trim'
            ),*/


            /*'signup_createdon' => array(
                'table' => $this->_table,
                'name' => 'signup_createdon',
                'label' => 'Createdon',
                'type' => 'created',
                'default'=>date("Y-m-d H:i:s"),
                'attributes' => array(),
                'rules' => 'trim'
            ),*/


        );

        if($this->uri->segment(4)!=null){
            unset($data['signup_password']);
        }

        if ($specific_field)
            return $data[$specific_field];
        else
            return $data;
    }
}

?>