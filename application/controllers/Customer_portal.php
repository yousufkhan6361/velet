<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Customer_portal extends MY_Controller
{

    /**
     * Contact US Controller
     */

    public function __construct()
    {
        // Call the Model constructor latest_product
        parent::__construct();

        if($this->userid<1){
            redirect(g('base_url'). "?msgtype=error&msg=" . rawurlencode("Portal access required login"));
        }

        $this->add_script(array('portal-script.js'),'js');
    }

    // Default Page (select Program)
    public function index()
    {
        global $config;
        // Get banner
        $data['banner'] = $this->model_inner_banner->find_by_pk(15);
        // Get cms work
        //$data['cms_content_1'] = $this->model_cms_page->get_page(2);
        // Get all user Programs which has purchase
        $data['programs'] = $this->model_order_item->get_user_program($this->userid);
        // debug($data['programs'],1);
        // Load View
        $this->load_view("index", $data);
    }

    // Select exam
    public function selection()
    {
        $data = $this->input->post();
        if(array_filled($data)){
            global $config;
            // Get order item info
            $data['info'] = $this->model_order_item->get_order_info($data['oi_id'],$this->userid);
            // Found data
            if(array_filled($data['info'])){
                // Get banner
                $data['banner'] = $this->model_inner_banner->find_by_pk(15);
                // Get exam list
                $data['exam_list'] = $this->model_exam_list->get_product_exam($data['info']['product_id']);
                //debug($data,1);
                // Get cms work
                //$data['cms_content_1'] = $this->model_cms_page->get_page(2);
                // Load View
                $this->load_view("selection", $data);
            }
            else{
                redirect(g('base_url_portal'). "?msgtype=error&msg=" . rawurlencode("No record found"));
            }
        }
        else{
            redirect(g('base_url'));
        }
    }

    // Access program
    // Default Page (select Program)
    public function access()
    {
        $data = $this->input->post();
        if(array_filled($data)){
            global $config;
            // Get order item info
            $data['info'] = $this->model_order_item->get_order_info($data['oi_id'],$this->userid);
            // Found data
            if(array_filled($data['info'])){
                // Get banner
                $data['banner'] = $this->model_inner_banner->find_by_pk(15);
                // Get cms work
                //$data['cms_content_1'] = $this->model_cms_page->get_page(2);
                // Load View
                $this->load_view("access", $data);
            }
            else{
                redirect(g('base_url_portal'). "?msgtype=error&msg=" . rawurlencode("No record found"));
            }
        }
        else{
            redirect(g('base_url'));
        }
    }

    // Verify access code
    public function verification()
    {
        // Get post data
        $oid = string_decrypt($this->input->post('oid'));
        $p_id = string_decrypt($this->input->post('p_id'));
        $code = $this->input->post('code');
        $exam_e_list_id = $this->input->post('exam_e_list_id');
        // Success
        if ((intval($oid) > 0) && (!empty($code)) && (!empty($p_id))) {
            // Check code is valid or not
            $result = $this->model_order->verify_code($oid,$code);
            // Validation success
            if (array_filled($result)) {

                // Get exam count
                $exam_total = $this->model_exam->exam_count($p_id,$exam_e_list_id);
                // Get Order ITem ID
                $o_item_id = $this->model_order_item->get_order_info_for_exam($oid,$this->userid,$p_id);
                // Get user exam count
                $user_exam_count = $this->model_user_exam->user_exam_count($o_item_id,$this->userid,$exam_total);

                if($user_exam_count==$exam_total){
                    $this->json_param['status'] = 1;
                    $this->json_param['is_redirect'] = 1;
                    $this->json_param['txt'] = 'Code verified.';
                }
                else{
                    $this->json_param['status'] = 1;
                    $this->json_param['is_redirect'] = 0;
                    $this->json_param['txt'] = 'Code verified.';
                }
            }
            else {
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = 'Invalid Access Code.';
            }
        } else {
            $this->json_param['status'] = 0;
            $this->json_param['txt'] = 'No parameters found';
        }

        echo json_encode($this->json_param);
    }

    // Start exam
    public function confirm()
    {
        // Get post data
        $oi_id = $this->input->post('oi_id');
        $exam_e_list_id = $this->input->post('exam_e_list_id');
        if(!empty($oi_id)){
            $data['oi_id'] = $oi_id;
            $data['exam_e_list_id'] = $exam_e_list_id;
            $this->load_view("confirm", $data);
        }
        else{
            redirect(g('base_url_portal'));
        }
    }

    // Start exam
    public function exam()
    {
        // Get post data
        $oi_id = $this->input->post('oi_id');
        $exam_id = $this->input->post('exam_id');   // for save record
        $position = $this->input->post('position');   // for save record
        $answer = $this->input->post('answer');   // for save record
        $exam_e_list_id = $this->input->post('exam_e_list_id');   // for save record
        if(!empty($oi_id)){
            // Check ID belongs to user or not
            $data['result'] = $this->model_order_item->get_order_info($oi_id,$this->userid);
            if(array_filled($data['result'])){
                global $config;
                $data['position'] = $this->input->post('position');
                $data['position'] = ($data['position'])? $data['position'] = $data['position'] + 1 : 1;
                $data['exam_id'] = $this->input->post('exam_id');
                $product_id = $data['result']['product_id'];

                // Get banner
                $data['banner'] = $this->model_inner_banner->find_by_pk(15);
                // Get cms work
                //$data['cms_content_1'] = $this->model_cms_page->get_page(2);

                // Get exam Programs (2nd and 3rd arguments are optional)
                $data['programs'] = $this->model_exam->get_exam_info($product_id,$data['exam_id'],$exam_e_list_id);
                // GET EXAM COUNT
                $data['total_count'] = $this->model_exam->exam_count($product_id, $exam_e_list_id);
                $data['exam_e_list_id'] = $exam_e_list_id;
                //debug($data);
                // Save record if found data
                if(!empty($exam_id)){
                    // Check record exist or not
                    $data['where']['ue_order_item_id'] = $oi_id;
                    $data['where']['ue_exam_id'] = $exam_id;
                    $data['where']['ue_position'] = $position;
                    $data['where']['ue_user_id'] = $this->userid;
                    $data['where']['ue_exam_list_id'] = $exam_e_list_id;
                    //$data['where']['ue_exam_answer'] = $answer;
                    //$data['where']['ue_status'] = STATUS_ACTIVE;

                    $is_exist = $this->model_user_exam->find_one($data);
                    if(!array_filled($is_exist)){
                        $data['ue_order_item_id'] = $oi_id;
                        $data['ue_exam_id'] = $exam_id;
                        $data['ue_position'] = $position;
                        $data['ue_user_id'] = $this->userid;
                        $data['ue_exam_list_id'] = $exam_e_list_id;
                        $data['ue_exam_answer'] = $answer;
                        $data['ue_status'] = STATUS_ACTIVE;
                        $this->model_user_exam->set_attributes($data);
                        $result = $this->model_user_exam->save();
                    }


                }
                // Load View
                $this->load_view("exam", $data);
            }
            else{
                redirect(g('base_url_portal'));
            }
        }
        else{
            redirect(g('base_url_portal'));
        }
    }

    // Start Summary
    public function summary()
    {
        // Get post data
        $oi_id = $this->input->post('oi_id');
        $exam_id = $this->input->post('exam_id');   // for save record
        $position = $this->input->post('position');   // for save record
        $answer = $this->input->post('answer');   // for save record
        $exam_e_list_id = $this->input->post('exam_e_list_id');   // for save record
        if(!empty($oi_id)){
            // Check ID belongs to user or not
            $data['result'] = $this->model_order_item->get_order_info($oi_id,$this->userid);
            if(array_filled($data['result'])){
                global $config;
                $data['position'] = $position;
                $data['exam_id'] = $this->input->post('exam_id');
                $product_id = $data['result']['product_id'];

                // Get banner
                $data['banner'] = $this->model_inner_banner->find_by_pk(15);

                // GET EXAM COUNT
                $data['total_count'] = $this->model_exam->exam_count($product_id, $exam_e_list_id);
                //debug($data);

                // Save record if found data
                if(!empty($exam_id)){
                    // Check record exist or not
                    $data['where']['ue_order_item_id'] = $oi_id;
                    $data['where']['ue_exam_id'] = $exam_id;
                    $data['where']['ue_position'] = $position;
                    $data['where']['ue_user_id'] = $this->userid;
                    $data['where']['ue_exam_list_id'] = $exam_e_list_id;
                    //$data['where']['ue_exam_answer'] = $answer;
                    //$data['where']['ue_status'] = STATUS_ACTIVE;

                    $is_exist = $this->model_user_exam->find_one($data);
                    if(!array_filled($is_exist)){
                        $data['ue_order_item_id'] = $oi_id;
                        $data['ue_exam_id'] = $exam_id;
                        $data['ue_position'] = $position;
                        $data['ue_user_id'] = $this->userid;
                        $data['ue_exam_list_id'] = $exam_e_list_id;
                        $data['ue_exam_answer'] = $answer;
                        $data['ue_status'] = STATUS_ACTIVE;
                        $this->model_user_exam->set_attributes($data);
                        $result = $this->model_user_exam->save();
                    }


                }


                $exam_slide_answers = $this->model_exam->get_exam_slide_answers($product_id, $exam_e_list_id);
                // debug($exam_slide_answers );
                $data['exam_answers'] = array_column($exam_slide_answers , 'exam_answer');
                // debug($data['module_exam_answers']);
                // Get user exam
                $data['user_slide_exam'] = $this->model_user_exam->get_user_slide_exam_report($oi_id, $exam_id,$this->userid, $exam_e_list_id);
                //debug($data['module_user_slide_exam']);
                // Get user exam answers
                $data['user_exam_answers'] = array_column($data['user_slide_exam'], 'ue_exam_answer');
                $diff = $this->model_user_exam->get_diff($data['exam_answers'], $data['user_exam_answers']);
                $data['wrong_answer'] = (array_filled($diff)) ? count($diff) : 0;
                // Total correct answers
                $data['total_correct_answer'] = count($data['exam_answers']) - $data['wrong_answer'];

                // Load View
                $this->load_view("summary", $data);
            }
            else{
                redirect(g('base_url_portal'));
            }
        }
        else{
            redirect(g('base_url_portal'));
        }
    }

}
