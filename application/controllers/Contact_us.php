<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Contact_us extends MY_Controller
{

    /**
     * Contact US Controller
     */

    public function __construct()
    {
        // Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Page
    public function index()
    {
        global $config;
        // Get banner
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(5);
        // Get cms work
        $data['sec7'] = $this->model_cms_page->get_page(7);
        // Load View
        $this->load_view("index", $data);
    }

    /**
     * Store a newly created resource in storage. //
     */
    public function send()
    {

        if (count($_POST) > 0) {
            if ($this->validate("model_inquiry")) {
                $form_name = 'inquiry';
                $contact_us_data = $_POST['inquiry'];
                //$contact_us_data['inquiry_type'] = 'contactus';
                $contact_us_data['inquiry_status'] = 1;

                $inserted_id = $this->model_inquiry->insert_record($contact_us_data);
                // $this->model_inquiry->set_attributes($contact_us_data);
                // $inserted_id = $this->model_inquiry->save();

                if ($inserted_id > 0) {


                    $param['status'] = 1;
                    // $param['redirect'] = 1;
                    // $param['redirect_url'] = '';

                    $param['txt'] = 'Input Succesfully save';
                    echo json_encode($param);
                    // $subject = 'Contact Us Alert';
                    parent::email_structure_contact($form_name, $subject);
                } else {
                    $param['status'] = 0;
                    $param['txt'] = 'Due to some error, Input not send';
                    echo json_encode($param);
                }
            } else {

                // debug(,1);
                //debug($param,1);

                //$param['field_name'] = validation_errors_name();
                $param['status'] = 0;
                $param['txt'] = validation_errors();
                echo json_encode($param);
            }
        }
    }


    public function newsletter()

    {
        global $config;
        // debug($_POST,1);
        if (count($_POST) > 0) {

            if ($this->validate("model_newsletter")) {
                $form_name = 'newsletter';
                $data = $_POST['newsletter'];
                $data['newsletter_status'] = 1;
                $inserted_id = $this->model_newsletter->insert_record($data);
                // debug($inserted_id,1);

                if ($inserted_id > 0) {

                    $title = g('site_name') . '- Newsletter Subscription Notification';

                    $template = $this->load->view("_layout/email_template/newsletter", $data, true);

                    $to = $data['newsletter_email'];

                    $admin_to = g("db.admin.email");

                    $admin_template = $this->load->view("_layout/email_template/subscribe", $data, true);


                    if (ENVIRONMENT != "development") {

                        parent::client_email($to, $template, $title, $admin_to);
                        parent::client_email($admin_to, $admin_template, $title, $to);

                    }

                    $param['status'] = 1;
                    $param['txt'] = 'Thank you for registering for our Newsletter.';
                    echo json_encode($param);

                } else {
                    $param['status'] = 0;
                    $param['txt'] = 'Due to some error, email not send';
                    echo json_encode($param);
                }
            } else {
                $param['status'] = 0;
                $param['txt'] = validation_errors();
                echo json_encode($param);

            }

        }

    }


    public function store()
    {
        // debug($_POST,1);

        // Get post data
        $post = $this->input->post();
        // Success
        if (count($post) > 0) {
            // Get Captcha
            // $captcha_answer = $this->input->post('g-recaptcha-response');

            // // Define Custom rules for captcha
            // $custom_rule = array(
            //     'g-recaptcha-response' => array(
            //         'field' => 'g-recaptcha-response',
            //         'label' => 'Captcha',
            //         'rules' => 'required'
            //     )
            // );

            // Validation success
            if ($this->validate("model_inquiry")) {
                // Verify user's answer
                //$response = $this->recaptcha->verifyResponse($captcha_answer);

                // Processing ...
                //if ($response['success']) {
                    // Get data
                    $contact_us_data = $post['inquiry'];
                    // Set status 1
                    $contact_us_data['inquiry_status'] = 1;
                    // Set attributes
                    $this->model_inquiry->set_attributes($contact_us_data);
                    // Save record
                    $inserted_id = $this->model_inquiry->save();

                    // Insert successfully
                    if ($inserted_id > 0) {
                        // Send Inquiry email to admin
                        $this->sendInquieryToAdmin($contact_us_data);

                        $this->json_param['status'] = 1;
                        $this->json_param['txt'] = 'Thank you for your inquiry.';
                    } else {
                        $this->json_param['status'] = 0;
                        $this->json_param['txt'] = 'Something went wrong.Please try later.';
                    }
                // } else {
                //     // Something goes wrong
                //     $this->json_param['status'] = 0;
                //     $this->json_param['txt'] = 'Captcha not verified';
                // }
            } // Validation error
            else {
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = validation_errors();
            }
        } else {
            $this->json_param['status'] = 0;
            $this->json_param['txt'] = 'No parameters found';
        }

        echo json_encode($this->json_param);
    }


    public function sendInquieryToAdmin($contact_us_data){

        $name = $contact_us_data['inquiry_fullname'];
        $email = $contact_us_data['inquiry_email'];
        $subject = $contact_us_data['inquiry_subject'];
        $comments = $contact_us_data['inquiry_comments'];

        $body_att = 'colspan="2" align="left" style="background-color:#000;color:#E84704;text-align: center;"';
        $body_att1 = 'colspan="2" align="left" style="background-color:#57585B;color:#fff;"';

        //$to = "info@thewebprovider.com";
        $to = g('db.admin.email');
        $subject = "Inquiry - Form";

        $inputs = '';
            $inputs .= 
                    "<tr>
                        <td width='14%' align='left'> Name</td>
                        <td width='14%' align='left'>" . $name . "</td>
                    </tr>

                    <tr>
                        <td width='14%' align='left'> Email</td>
                        <td width='14%' align='left'>" . $email . "</td>
                    </tr>

                    <tr>
                        <td width='14%' align='left'> Subject</td>
                        <td width='14%' align='left'>" . $subject . "</td>
                    </tr>

                    <tr>
                        <td width='14%' align='left'> Message</td>
                        <td width='14%' align='left'>" . $comments . "</td>
                    </tr>

                    "
                    ;
        //}

        $message = "
        <html>
        <head>
        <title>Inquiry - Form</title>
        </head>
        <body>

        <div style='margin-top:-10px'>
                <table width='70%' border='1' cellpadding='6' cellspacing='5' style='font-family:Verdana;font-size:12px; border-collapse:collapse'>
                    <tr>
                        <td border='0' colspan='2' " . $body_att . ">
                            <img src='https://thenorthernirelandconnection.com/assets/uploads/logo/logo161841820742.png' width='190' />
                        </td>
                    </tr>

                ".$inputs."
                </table>
            </div>";

          
            
        $message.= "</body></html>";

        //echo $message;
        //exit;

        // Always set content-type when sending HTML email
        $headers = "MIME-Version: 1.0" . "\r\n";
        $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

        // More headers
        //$headers .= 'From: The User <ericwalter.developer@gmail.com>' . "\r\n";
        $headers .= 'From: '.$email."\r\n".
        //$headers .= 'Bcc: ericwalter.developer@gmail.com' . "\r\n";
        //$headers .= 'Cc: myboss@example.com' . "\r\n";
        // debug($to);
        // debug($subject);
        // debug($message);
        // debug($headers);


         mail($to,$subject,$message,$headers);
        // if($mail){
        //     echo 1;
        // }else{
        //     echo 2;
        // }

      
}

    public function affiliate()
    {
        // debug($_POST,1);

        // Get post data
        $post = $this->input->post();
        // Success
        if (count($post) > 0) {
           
            // Validation success
            if ($this->validate("model_affiliate")) {
                // Verify user's answer
                //$response = $this->recaptcha->verifyResponse($captcha_answer);

                // Processing ...
                //if ($response['success']) {
                    // Get data
                    $contact_us_data = $post['affiliate'];
                    $userId = $contact_us_data['affiliate_userid'];
                    $userName = $contact_us_data['affiliate_username'];
                    $userEmail = $contact_us_data['affiliate_useremail'];
                    // Set status 1
                    $link = g('base_url')."user/signup?userid=".$userId;
                    
                    $contact_us_data['affiliate_status'] = 1;
                    $contact_us_data['affiliate_userid'] = $userId;
                    $contact_us_data['affiliate_username'] = $userName;
                    $contact_us_data['affiliate_useremail'] = $userEmail;
                    $contact_us_data['affiliate_link'] = $link;

                    //debug($contact_us_data,1);

                    $affiliateData = $this->model_affiliate->find_by_pk($this->userid);

                    $par['where']['affiliate_userid'] = $userId;
                    $affiliateData = $this->model_affiliate->find_one($par);

                    if(empty($affiliateData)){

                        // break;
                    }else{

                         $this->json_param['status'] = 0;
                         $this->json_param['txt'] = 'Link already been generated.';
                         echo json_encode($this->json_param);
                         exit;
                    }

                   

                    //debug($link,1);
                    // Set attributes
                    $this->model_affiliate->set_attributes($contact_us_data);
                    // Save record
                    $inserted_id = $this->model_affiliate->save();

                    // Insert successfully
                    if ($inserted_id > 0) {
                        // Send affiliate email to admin
                        $this->json_param['status'] = 1;
                        $this->json_param['txt'] = 'Thank you! Your affiliate link has been generated  .';
                    } else {
                        $this->json_param['status'] = 0;
                        $this->json_param['txt'] = 'Something went wrong.Please try later.';
                    }
                // } else {
                //     // Something goes wrong
                //     $this->json_param['status'] = 0;
                //     $this->json_param['txt'] = 'Captcha not verified';
                // }
            } // Validation error
            else {
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = validation_errors();
            }
        } else {
            $this->json_param['status'] = 0;
            $this->json_param['txt'] = 'No parameters found';
        }

        echo json_encode($this->json_param);
    }





}
