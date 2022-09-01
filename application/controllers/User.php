<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class User extends MY_Controller
{

    /**
     * User Controller
     *
     * @package        User Controller
     * @version        1.0
     * @since        11-Apr-2018
     */

    private $json_param = array();


    public function __construct()
    {
        // Call the Model constructor latest_product
        parent::__construct();
    }

    // Login/Signup View
    public function index()
    {
        // Temporary redirect
        redirect(l('user/login'));
        global $config;

        // Redirect user if session set
        if($this->userid){
            redirect(l(''));
        }
        // Get banner
        $data['banner'] = $this->model_inner_banner->find_by_pk(2);
        // Sign up / Login main page
        //$this->load_view('login', $data);
        $this->load_view('index', $data);
    }

    // Login Viewlogin-process
    public function login()
    {
        global $config;

        // Redirect user if session set
        if($this->userid){
            redirect(l(''));
        }
        // Get banner
        $data['banner'] = $this->model_inner_banner->find_by_pk(8);
        // Sign up / Login main page
        $this->load_view('login', $data);
    }

    // Sign up View
    public function register()
    {
        global $config;

        // Redirect user if session set
        if($this->userid){
            redirect(l(''));
        }
        // Get banner
        $data['banner'] = $this->model_banner->get_banners(7);
        // Get Countries
        //$data['countries'] = $this->model_country->find_all_active();
        // Sign up / Login main page
        $this->load_view('register', $data);
    }

    // Sign up View
    public function signup()
    {
        global $config;

        // Redirect user if session set
        if($this->userid){
            redirect(l(''));
        }
        // Get banner
        // $data['banner'] = $this->model_inner_banner->find_by_pk(7);
        $data['countries'] = $this->model_country->find_all_active();
        // Get Countries
        //$data['countries'] = $this->model_country->find_all_active();
        // Sign up / Login main page
        $this->load_view('signup', $data);
    }

    // Insert Record
    public function save()
    {
        global $config;

        // Get post data
        $signup = $this->input->post('signup');
        // debug($signup,1);
        if (array_filled($signup) > 0) {

            //debug($signup,1);
            // $custom_rule = array(
            //     'signup_password_confirm'=>array(
            //         'field'=>'signup_password_confirm',
            //         'label'=>'Confirm Password',
            //         'rules'=>'required|md5|trim|matches[signup[signup_password]]'
            //     )
            // );

            /*$custom_rule = array(
                'checkbox'=>array(
                    'field'=>'checkbox',
                    'label'=>'Terms & Conditions',
                    'rules'=>'required'
                )
            );*/

            // Validation success
            if ($this->validate("model_signup")) {
            //if ($this->validate("model_signup")) {
                // Add token for email validation
                //$signup['signup_token'] = md5(time());

                $affiliate = $signup['signup_affiliate'];

                $signup['signup_token'] = "";
                $signup['signup_status'] = STATUS_ACTIVE;
                $signup['signup_password'] = md5($signup['signup_password']);
                //debug($signup,1);
                // Set profile image data

                $this->model_email->send_welcome_email($signup['signup_email']);
                //exit;

                $this->model_signup->set_attributes($signup);
                $inserted_id = $this->model_signup->save($signup);

                $lastInsertedIed = $this->db->insert_id();
                
                if($affiliate > 0){

                    $affiliateData = array(

                    'referral_userid' => $signup['signup_affiliate'],
                    'referral_receiver_userid' => $lastInsertedIed,
                    'referral_name' => $signup['signup_firstname'],
                    'referral_email' => $signup['signup_email'],
                    'referral_status' => 1

                    );

                    $this->db->insert('fb_referral', $affiliateData);

                }


                // Record insert successfully
                if($inserted_id > 0)
                {
                    if(ENVIRONMENT!='development'){
                        // Send confirmation email
                        //$this->model_email->_verification_email($signup,$inserted_id);
                        //sleep(2);
                        // Welcome email
                        $this->model_email->send_welcome_email($signup['signup_email']);
                    }

                    $this->model_signup->auto_login($inserted_id);

                    $this->json_param['status'] = true;
                    //$this->json_param['txt'] = 'Thanks for registration. Please check your inbox for account verification.';
                    $this->json_param['txt'] = 'Thank you for registration.';
                }
                // Record not insert
                else
                {
                    $this->json_param['status'] = false;
                    $this->json_param['txt'] = 'Something went wrong.Please try later.';
                }

            }
            // Validation failed
            else {
                $this->json_param['status'] = false;
                $this->json_param['txt'] = validation_errors();
            }
        }
        echo json_encode($this->json_param);
    }

    // Email Verification
    public function confirmation()
    {
        // Get data
        $email = $this->input->get('email');
        $token = $this->input->get('token');

        if((!empty($email)) && (!empty($token))){
            // Where condition
            $params['where']['signup_email'] = $email;
            $params['where']['signup_token'] = $token;

            // Run query
            $query = $this->model_signup->find_one($params);

            //Check record found or not
            if(count($query)>0){
                // Change user status active
                $upd_data = array(
                    'signup_token'=>'',
                    'signup_status'=>1
                );

                $upd_query = $this->model_signup->update_by_pk($query['signup_id'],$upd_data);
                $msg = 'Thank you! Your Email has been verified successfully.';
                redirect(l('?msgtype=success&msg=' . urlencode($msg)));
            }
            else{
                $msg = 'Something went wrong.Please try later.';
                redirect(l('404'));
            }
        }
        else{
            $msg = 'Invalid credentials.';
            redirect(l('?msgtype=error&msg=' . urlencode($msg)));
        }
    }

    // Login action
    public function login_process()
    {
        // Get post data
        $login = $this->input->post('signup');
        //$refer_url = $this->input->post('refer');

        if(array_filled(array_filter($login)) > 0)
        {
            // debug($login,1);
            // Set params
            $params['where']['signup_email'] = $login['signup_email'];
            // Query
            $params['where']['signup_status !='] = STATUS_DELETE;
            $data = $this->model_signup->find_one($params);
            // debug($data,1);
            // Login success
            if($login['signup_email'] == $data['signup_email'] && (md5($login['signup_password'])) ==
                $data['signup_password']  && ($data['signup_status']=='1'))
            {
                // Set user session (session will be set on layout data
                $this->model_signup->set_user_session($data);
                $this->json_param['status'] = true;
                $this->json_param['txt'] = 'Login successfully.';
                //$this->json_param['refer'] = (isset($refer_url))?$refer_url:g('base_url');
            }
            // Deleted Account
            elseif($data['signup_status']=='2'){
                $this->json_param['status'] = false;
                $this->json_param['txt'] = 'Account is Deleted.';
            }
            // Inactive and unverified
            elseif($data['signup_status']=='0' && (!empty($data['signup_token']))){
                $this->json_param['status'] = false;
                $this->json_param['txt'] = 'Account verification is required.Kindly Check your inbox.';
            }
            // In active
            elseif($data['signup_status']=='0'){
                $this->json_param['status'] = false;
                $this->json_param['txt'] = 'Account suspended.';
            }
            // Login fail
            else
            {
                $this->json_param['status'] = false;
                $this->json_param['txt'] = 'Invalid email / password';
                //$this->json_param['refer'] = g('base_url');
            }

        }
        else{
            $this->json_param['status'] = false;
            $this->json_param['txt'] = 'Fields required';
            //$this->json_param['refer'] = g('base_url');
        }
        echo json_encode($this->json_param);

    }

    // Load edit user view
    public function edit()
    {
        // Redirect user if session not set
        if($this->session->userdata('userdata')==null){
            redirect(l('login'));
        }

        // Define layout
        $this->layout = 's8_main';

        // Set body class
        $this->layout_data['body_class'] = "responsive timelineBody";

       // Define page
        $this->load_view('edit_profile');
    }

    // Check user password
    public function password_check($str)
    {
        $user_id = $this->session->userdata('userdata')['signup_id'];
        $params['where']['signup_id'] = $user_id;
        $params['where']['signup_password'] = md5($str);
        if($this->model_signup->find_one($params, true)){
            return TRUE;
        }
        else{
            $this->form_validation->set_message('password_check', lang('invalid_pass'));
            return FALSE;
        }
    }

    // Delete Record
    public function delete()
    {

    }

    // Forgot Password
    public function forgot()
    {
        // Get Post Data
        $email = $this->input->post('signup');
       // debug($email,1);
        // Get Captcha
        $captcha_answer = $this->input->post('g-recaptcha-response');
        // $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');

        // check Input data empty or not
        $this->form_validation->set_rules('signup[signup_email]', 'Email', 'required|valid_email');
        // Set validation rules for google captcha
        // $this->form_validation->set_rules('g-recaptcha-response', 'Captcha', 'required');
        $this->form_validation->set_error_delimiters("<span style=\"color:white;\" for=\"%s\" class=\"has-error help-block\">", '</span>');

        if ($this->form_validation->run() == FALSE)
        {
            $this->json_param['status'] = false;
            $this->json_param['txt'] = validation_errors();
        }
        else
        {
            // Verify user's answer
            // $response = $this->recaptcha->verifyResponse($captcha_answer);
            // debug($response,1);
            // Processing ...
           // if (2==2) {
                // Send email
                // Query to check email exists or not
                $params['where']['signup_email'] = $email['signup_email'];
                $query = $this->model_signup->find_one_active($params);

              //  debug($query,1);

                if(count($query) > 0 ){
                    // Remove old token if exist
                    // $where_params['where']['token_user_id'] = $query['signup_id'];
                    // $data = array(
                    //     'token_status'=>STATUS_INACTIVE
                    // );
                    // $this->model_token->update_model($where_params,$data);
                    // // Generate token
                    // $token = md5(time());
                    // $data = array(
                    //     'token_user'=>$token,
                    //     'token_user_id'=>$query['signup_id'],
                    //     'token_status'=>1
                    // );
                    // // Save token
                    // $this->model_token->set_attributes($data);
                    // $this->model_token->save();

                    // debug($query,1);
                    // Send email
                    // CHANGE THIS FOR OTHER PROJECT
                    //$this->model_email->_notification_forgot_password($query,$token);
                    $this->model_email->_notification_forgot_password_smtp($query,$token);
                    $this->json_param['status'] = true;
                    $this->json_param['txt'] = 'If your email address exists in our database, you will receive a password recovery link at your email address in a few minutes.';
                }
                else{
                    $this->json_param['status'] = false;
                    $this->json_param['txt'] = 'Your email not exist';
                }
            // }
            // else{
            //     // Something goes wrong
            //     $this->json_param['status'] = 0;
            //     $this->json_param['txt'] = 'Captcha not verified';
            // }
        }
        echo json_encode($this->json_param);

    }

    // Forgot Password View
    public function forgot_password()
    {
        // Get data
        $user_id = $this->input->get('id');
        $token   = $this->input->get('token');

        if((!empty($user_id)) && (!empty($token)) && (!$this->session->userdata('userdata')['signup_id'])){
            // Where condition for token expire
            $params['where']['token_user_id'] = $user_id;
            $params['where']['token_user']    = $token;

            // Token found
            if($this->model_token->find_one_active($params)){
                // Run query
                $params_user['where']['signup_id'] = $user_id;
                $query = $this->model_signup->find_one($params_user);

                // Set banner heading
                $data['banner_heading'] = "Reset Password";

                //Check record found
                if(count($query)>0){
                    $data['token_user'] = $token;
                    $data['user_id'] = $user_id;

                    // Get banner
                    $data['inner_banner'] = $this->model_inner_banner->find_by_pk(9);

                    $this->load_view('forgot_password',$data);
                }
                // User ID not found
                else{
                    redirect(l('404'));
                }
            }
            // Token not found
            else{
                redirect(l('404'));
            }
        }
        // Invalid credentials
        else{
            redirect(l('404'));
        }
    }

    public function reset_password()
    {
        // Get Post data
        $user_id  = $this->input->post('user_id');
        $token    = $this->input->post('token');
        $password = $this->input->post('password');

        // check Input data empty or not
        $this->form_validation->set_rules('user_id', 'User ID', 'required|trim');
        $this->form_validation->set_rules('token', 'Token', 'required|trim');
        $this->form_validation->set_rules('password', 'Password', 'required|trim');
        $this->form_validation->set_error_delimiters("<span style=\"color:white;\" for=\"%s\" class=\"has-error help-block\">", '</span>');

        // Validation error
        if ($this->form_validation->run() == FALSE)
        {
            $this->json_param['status'] = false;
            $this->json_param['txt'] = validation_errors();
        }
        // No validation
        else{
            // Where condition for token expire
            $params['where']['token_user_id'] = $user_id;
            $params['where']['token_user']    = $token;

            // Token found
            if($this->model_token->find_one_active($params)){
                // Set token status to 0
                $this->model_token->update_model($params,array('token_status'=>STATUS_INACTIVE));

                // Change password
                $this->model_signup->update_by_pk($user_id,array('signup_password'=>md5($password)));

                $this->json_param['status'] = true;
                $this->json_param['txt'] = 'Reset password successfully.';

            }
            // Token not found
            else{
                $this->json_param['status'] = false;
                $this->json_param['txt'] = 'Authentication fail.';
            }
        }

        echo json_encode($this->json_param);
    }

    // Logout
    public function logout()
    {
        $user_id = $this->session->userdata('userdata')['signup_id'];

        $this->cart->destroy();

        // Clear user session
        $this->session->unset_userdata('userdata');
        redirect(l(''));
    }
}