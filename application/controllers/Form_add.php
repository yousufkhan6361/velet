<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Form_add extends MY_Controller {

	/**
	 * Default Controller
	 */
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Home Page
	public function index()
    {
        // debug(phpinfo(),1);
        global $config;

        if($this->userid <= 0){
            redirect(g('base_url')."packages");
        }

        $userId = $this->userid;

        $data['categories'] = $this->model_category->find_all_active();
        
        // $checkPaymentStatus = $this->db->query("SELECT * FROM fb_order od
        //                                         INNER JOIN fb_signup sp
        //                                         ON od.order_user_id = sp.signup_id
        //                                         WHERE od.order_payment_status = 1
        //                                         AND sp.signup_id ='$userId' ");

        // $resultStatus = $checkPaymentStatus->result_array();


        // $checkAutoRenewalPaymentStatus = $this->db->query("SELECT * FROM fb_subscription sc
        //                                         INNER JOIN fb_signup sp
        //                                         ON sc.subscription_user_id = sp.signup_id
        //                                         WHERE sc.subscription_payment_status = 1
        //                                         AND sp.signup_id ='$userId' ");

        // $resultStatus2 = $checkAutoRenewalPaymentStatus->result_array();

        $param2['where']['order_user_id'] = $userId;
        $param2['where']['order_payment_status'] = 1;
        $userSubscription = $this->model_order->find_one($param2);


        $param3['where']['subscription_user_id'] = $userId;
        $param3['where']['subscription_payment_status'] = 1;
        
        $userSubscriptionAutoRenewal = $this->model_subscription->find_one($param3);

        if($userSubscription){

            $data['userPackageId'] = $userSubscription['order_package_id'];
            //debug($data['userPackageId'],1);

            $this->load_view("index", $data);

        }else if($userSubscriptionAutoRenewal){
            
            $data['userPackageId'] = $userSubscriptionAutoRenewal['subscription_membership_id'];

           $this->load_view("index", $data);

        }else{

            redirect(g('base_url')."packages");

        }

        //  if(empty($resultStatus) && empty($resultStatus2)){

        //     redirect(g('base_url')."packages");

        //  }else if($resultStatus && empty($resultStatus2)){
        //     redirect(g('base_url')."packages");
        //  }else if($resultStatus2 && empty($resultStatus)){
        //     redirect(g('base_url')."packages");
        //  }else{
        
        // // Load View
        // $this->load_view("index", $data);
        
    }

    public function showAds(){

        $cat = $this->uri->segment(2);
        
        //debug($cat,1);

        $param0['where']['blog_category_slug'] = $cat;
        $category = $this->model_blog_category->find_one_active($param0);
        $catId = $category['blog_category_id'];
        
        $param1['where']['category_slug'] = $cat;
        $category2 = $this->model_category->find_one($param1);
        
        $catid2 = $category2['category_id'];
        
        //debug($category2);
        
        
        if($category == ""){
            
            $param['where']['ads_category_id'] = $catid2;
            $data['ads'] = $this->model_ads->find_all_active($param);
            
             $catName = $category2['category_name'];
             $data['catName'] = $catName;
             $data['imgPath'] = g('base_url').$category2['category_image_path'].$category2['category_image'];
             
             //debug($category2,1);
             
        }else{
            
            $param['where']['ads_location_id'] = $catId;
            $data['ads'] = $this->model_ads->find_all_active($param);
            
            $catName = $category['blog_category_name'];
            $data['catName'] = $catName;
            //debug(); 
            
            $ccid = $data['ads'][0]['ads_category_id'];
            
            $param4['where']['category_id'] = $ccid;
            $category22 = $this->model_category->find_one($param4);
            
            $data['imgPath'] = g('base_url').$category22['category_image_path'].$category22['category_image'];
            //debug($data['imgPath'],1);
             
            // $param3['where']['ads_category_id'] = $catId;
            // $data['ads'] = $this->model_ads->find_all_active($param3);
        }

        $this->load_view("show_adds", $data);
    }

    public function adDetail(){

        $ad = $this->uri->segment(2);

        $param1['where']['ads_slug'] = $ad;
        $data['ad'] = $this->model_ads->find_one($param1);

        $param3['where']['category_id'] = $data['ad']['ads_category_id'];
        $data['category'] = $this->model_category->find_one($param3);

        //debug($data['ad']);

        $adId = $data['ad']['ads_id'];

        $param2['where']['ads_gallery_ads_id'] = $adId;
        $data['adGallery'] = $this->model_ads_gallery->find_all($param2);


        $param4['where']['ads_video_ads_id'] = $adId;
        $data['adVideos'] = $this->model_ads_video->find_all($param4);

        $param5['where']['ads_videolinks_ads_id'] = $adId;
        $data['adVideosLinks'] = $this->model_ads_videolinks->find_all($param5);

        $param6['where']['ads_docs_ads_id'] = $adId;
        $data['adDocs'] = $this->model_ads_docs->find_all($param6);


        $param7['where']['ads_socialmedialinks_ads_id'] = $adId;
        $data['adSocialLinks'] = $this->model_ads_socialmedialinks->find_all($param7);



        //debug($data['adSocialLinks']);


        $this->load_view("ad_detail", $data);
    }

    public function reportadd(){

    //   if($this->userid <= 0){
    //   // redirect(g('base_url').'user/index');
    //         redirect(g('base_url').'user/signup');
    // }

      $this->load_view("report_add", $data);
    }

    public function report_save(){

      
      $reportSlug = $_POST['report_adid'];

      $par['where']['ads_slug'] = $reportSlug;
      $ads = $this->model_ads->find_one($par);

      $adsId = $ads['ads_id'];
      

      // Get post data
      // $this->model_email->send_welcome_email($signup['signup_email']);
      //exit;

        $reportAdsData = array(

        'reportads_userid' => $_POST['report_userid'],
        'reportads_adid' => $adsId,
        'reportads_email' => $_POST['report_email'],
        'reportads_name' => $_POST['report_name'],
        'reportads_subject' => $_POST['report_subject'],
        'reportads_msg' => $_POST['report_desc'],
        'reportads_status' => 1

        );

         $useremail = $_POST['report_email']; 

         // $this->model_email->send_report_email($useremail,$reportAdsData);
         // exit;
        $inserted_id = $this->db->insert('fb_reportads', $reportAdsData);
        
         if($inserted_id > 0)
          {
              //if(ENVIRONMENT!='development'){
                  //debug(1);
                  // Send confirmation email
                  //$this->model_email->_verification_email($signup,$inserted_id);
                  //sleep(2);
                  // Welcome email
                  //$this->model_email->send_report_email($useremail,$reportAdsData);
                 // parent::send_report_email($useremail,$reportAdsData);
                    $this->model_email->send_report_email($useremail,$reportAdsData);
                  //$this->model_email->send_report_email($useremail,$reportAdsData);
                  
              //}

             

              $this->json_param['status'] = true;
              //$this->json_param['txt'] = 'Thanks for registration. Please check your inbox for account verification.';
              $this->json_param['txt'] = 'Report sent successfully';
          }
          // Record not insert
          else
          {
              $this->json_param['status'] = false;
              $this->json_param['txt'] = 'Something went wrong.Please try later.';
          }

        echo json_encode($this->json_param);

    }


    // Record insert successfully
    // if($inserted_id > 0)
    // {
    //     if(ENVIRONMENT!='development'){
    //         // Send confirmation email
    //         //$this->model_email->_verification_email($signup,$inserted_id);
    //         //sleep(2);
    //         // Welcome email
    //         $this->model_email->send_welcome_email($signup['signup_email']);
    //     }

    //     //$this->model_signup->auto_login($inserted_id);

    //     $this->json_param['status'] = true;
    //     //$this->json_param['txt'] = 'Thanks for registration. Please check your inbox for account verification.';
    //     $this->json_param['txt'] = 'Thank you for registration.';
    // }
    // // Record not insert
    // else
    // {
    //     $this->json_param['status'] = false;
    //     $this->json_param['txt'] = 'Something went wrong.Please try later.';
    // }



    

    public function uploadMutipleImages(){
        
    }

    public function addForm(){

        // Get post data
        $post = $this->input->post();

        //debug($post,1);
        

        if (count($post) > 0) {
            // Get data
            $contact_us_data = $post['ads'];

            $paidPackageId = $_POST['paidPackageId'];
            $userId = $post['ads']['ads_user_id'];

            $par1333['where']['signup_id'] = $userId;
            $userdd = $this->model_signup->find_one($par1333);

            $useremail55 = $userdd['signup_email'];

            //debug($userId,1);

            $countPictures = count($_FILES['multiImages']['name']);
            $countVideos = count($_FILES['multiVideos']['name']);
            $countDocs = count($_FILES['multiDocs']['name']);
            $videoStatus = '';

            //debug($_FILES['multiVideos']);
            //debug($countVideos,1);
            //$filename = $_FILES['multiVideos']['name'];
            //$ext = pathinfo($filename, PATHINFO_EXTENSION);
            //debug($countVideos,1);
            //if($countVideos > 0){
            //if (isset($_FILES['multiVideos']) AND array_filled($_FILES['multiVideos'])) {
            if($_FILES['multiVideos']['name'][0] != ""){
              $filename = $_FILES['multiVideos']['name'];
                foreach ($filename as $key => $value) {
                  $ext = pathinfo($value, PATHINFO_EXTENSION);
                  if ($ext != 'mp4' && $ext != 'mov' && $ext != 'flv'  ) {
                    $videoStatus = 0;
                    break;
                  }else{
                    $videoStatus = 1;
                  }
                }

                if($videoStatus == 0){
                  $result['status'] = 0;
                  $result['txt'] = 'Video file format is invalid'; 
                  echo json_encode($result);
                  exit;
                }
            }
            //}

            //if($countDocs > 0){
            //if (isset($_FILES['multiDocs']) AND array_filled($_FILES['multiDocs'])) {
            if($_FILES['multiDocs']['name'][0] != ""){
              $filename = $_FILES['multiDocs']['name'];
                foreach ($filename as $key => $value) {
                  $ext = pathinfo($value, PATHINFO_EXTENSION);
                  if ($ext != 'doc' && $ext != 'docx' ) {
                    $videoStatus = 0;
                    break;
                  }else{
                    $videoStatus = 1;
                  }
                }

                if($videoStatus == 0){
                  $result['status'] = 0;
                  $result['txt'] = 'Document file format is invalid'; 
                  echo json_encode($result);
                  exit;
                }
            }

            // debug("video status = ".$videoStatus);
            // debug($ext,1);
            // debug("pic :".$countPictures);
            // debug("docs : ".$countDocs);
            // debug("videos :".$countVideos,1);

            

            if($paidPackageId == 1){

              $que13 = $this->db->query("SELECT count(DISTINCT(ad.ads_category_id)) AS total 
                                          FROM fb_ads ad
                                          WHERE ad.ads_user_id = '".$userId."' ");

              $totalAdsCategory = $que13->result_array();
              $total = $totalAdsCategory[0]['total'];

              if($total > 1){

                  $result['status'] = 0;
                  $result['txt'] = 'You can add Ads only in 1 category'; 
                  echo json_encode($result);
                  exit;
                }
             

                if($countPictures > 3){

                  $result['status'] = 0;
                  $result['txt'] = 'You can upload only 3 pictures in this package <br> Get premium package for more pictures'; 
                  echo json_encode($result);
                  exit;
                }
            }

            if($paidPackageId == 2){

              $que13 = $this->db->query("SELECT count(DISTINCT(ad.ads_category_id)) AS total 
                                          FROM fb_ads ad
                                          WHERE ad.ads_user_id = '".$userId."' ");

              $totalAdsCategory = $que13->result_array();
              $total = $totalAdsCategory[0]['total'];

              //debug($total,1);

              if($total > 1){

                  $result['status'] = 0;
                  $result['txt'] = 'You can add Ads only in 1 category'; 
                  echo json_encode($result);
                  exit;
                }


                if($countPictures > 6){
                
                //debug($countPictures,1);
                    // $this->session->set_flashdata('message_name', 'You can upload only 6 pictures in this package <br> Get premium package for more pictures');
                    // redirect("form_add");

                  $result['status'] = 0;
                  $result['txt'] = 'You can upload only 6 pictures in this package <br> Get premium package for more pictures'; 
                  echo json_encode($result);
                  exit;
                }

                if($countVideos > 2){
                
                    // $this->session->set_flashdata('message_name', 'You can upload only 2 videos in this package <br> Get premium package for more videos');
                    // redirect("form_add");

                  $result['status'] = 0;
                  $result['txt'] = 'You can upload only 2 videos in this package <br> Get premium package for more videos'; 
                  echo json_encode($result);
                  exit;
                }

                if($countDocs > 1){
                
                    // $this->session->set_flashdata('message_name', 'You can upload only 1 document in this package <br> Get premium package for more document');
                    // redirect("form_add");

                  $result['status'] = 0;
                  $result['txt'] = 'You can upload only 1 document in this package <br> Get premium package for more document'; 
                  echo json_encode($result);
                  exit;
                }
            }

            if($paidPackageId == 3){

              $que13 = $this->db->query("SELECT count(DISTINCT(ad.ads_category_id)) AS total 
                                          FROM fb_ads ad
                                          WHERE ad.ads_user_id = '".$userId."' ");

              $totalAdsCategory = $que13->result_array();

              $total = $totalAdsCategory[0]['total'];

              //debug($total,1);

              if($total > 3){

                  $result['status'] = 0;
                  $result['txt'] = 'You can add Ads only in 3 categories'; 
                  echo json_encode($result);
                  exit;
                }

                if($countPictures > 15){
                
                    // $this->session->set_flashdata('message_name', 'You can upload only 15 pictures in this package <br> Get premium package for more pictures');
                    // redirect("form_add");

                  $result['status'] = 0;
                  $result['txt'] = 'You can upload only 15 pictures in this package <br> Get premium package for more pictures'; 
                  echo json_encode($result);
                  exit;
                }

                if($countVideos > 5){
                
                    // $this->session->set_flashdata('message_name', 'You can upload only 5 videos in this package <br> Get premium package for more videos');
                    // redirect("form_add");

                  $result['status'] = 0;
                  $result['txt'] = 'You can upload only 5 videos in this package <br> Get premium package for more videos'; 
                  echo json_encode($result);
                  exit;
                }

                if($countDocs > 5){
                
                    // $this->session->set_flashdata('message_name', 'You can upload only 5 document in this package <br> Get premium package for more document');
                    // redirect("form_add");

                  $result['status'] = 0;
                  $result['txt'] = 'You can upload only 5 document in this package <br> Get premium package for more document'; 
                  echo json_encode($result);
                  exit;
                }
            }


            //debug($contact_us_data,1);

            $title = $contact_us_data['ads_title'];
            $slug = $this->slugify($title);
            $contact_us_data['ads_slug'] = $slug;
            $cat = $contact_us_data['ads_category'];
            $otherCat = $contact_us_data['ads_other_category'];
    
            if($cat == "Other" && $otherCat != ""){
                $contact_us_data['ads_category'] = $contact_us_data['ads_other_category'];
            }else{
                $contact_us_data['ads_category'] = $cat;
            }

            $tinyMcDescription = $contact_us_data['ads_tiny_html'];

            $contact_us_data['ads_featured'] = 0;
            $contact_us_data['ads_status'] = 0;
            $contact_us_data['ads_description'] = $tinyMcDescription;
            
            //debug($contact_us_data,1);

            $this->model_ads->set_attributes($contact_us_data);
            $inserted_id = $this->model_ads->save();


            if ($inserted_id > 0){

              if(ENVIRONMENT!='development'){
                  // Send confirmation email
                  //$this->model_email->_verification_email($signup,$inserted_id);
                  //sleep(2);
                  // Welcome email
                  $this->model_email->send_ad_submit_email($inserted_id,$contact_us_data,$useremail55);
                
              }

                if (isset($_FILES['multiImages']) AND array_filled($_FILES['multiImages'])) {
                 // Count total files
                 $countfiles = count($_FILES['multiImages']['name']);
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){
                  $filename = $_FILES['multiImages']['name'][$i];
                  // Upload file
                  $upload_path2 = "assets/uploads/ads/gallery/";
                    $inserted_param['ads_gallery_ads_id'] = $inserted_id;
                    $inserted_param['ads_gallery_image_path'] = $upload_path2;
                    $inserted_param['ads_gallery_image'] = $filename;
                  move_uploaded_file($_FILES['multiImages']['tmp_name'][$i], 'assets/uploads/ads/gallery/'.$filename);
                  $inserted_id2 = $this->model_ads_gallery->insert_record($inserted_param);
                 }
            }

            if($_FILES['multiVideos']['name'][0] != ""){
            //if (isset($_FILES['multiVideos']) AND array_filled($_FILES['multiVideos'])) {
                 // Count total files
                 $countfiles = count($_FILES['multiVideos']['name']);
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){
                  $filename = $_FILES['multiVideos']['name'][$i];
                  // Upload file
                  $upload_path3 = "assets/uploads/ads/video";
                    $inserted_param2['ads_video_ads_id'] = $inserted_id;
                    $inserted_param2['ads_video_image_path'] = $upload_path3;
                    $inserted_param2['ads_video_image'] = $filename;
                  move_uploaded_file($_FILES['multiVideos']['tmp_name'][$i], 'assets/uploads/ads/video/'.$filename);
                 //debug($inserted_param,1);
                  $inserted_id2 = $this->model_ads_video->insert_record($inserted_param2);
                 }
            }


            if($_FILES['multiDocs']['name'][0] != ""){
            //if (isset($_FILES['multiDocs']) AND array_filled($_FILES['multiDocs'])) {
                 // Count total files
                 $countfiles = count($_FILES['multiDocs']['name']);
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){
                  $filename = $_FILES['multiDocs']['name'][$i];
                  // Upload file
                  $upload_path4 = "assets/uploads/ads/docs";
                    $inserted_param3['ads_docs_ads_id'] = $inserted_id;
                    $inserted_param3['ads_docs_image_path'] = $upload_path4;
                    $inserted_param3['ads_docs_image'] = $filename;
                  move_uploaded_file($_FILES['multiDocs']['tmp_name'][$i], 'assets/uploads/ads/docs/'.$filename);
                  $inserted_id2 = $this->model_ads_docs->insert_record($inserted_param3);
                 }
            }

            if (isset($_POST['socialMediaLins']) AND array_filled($_POST['socialMediaLins'])) {
                 // Count total files
                 $countfiles = count($_POST['socialMediaLins']);
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){
                  $filename = $_POST['socialMediaLins'][$i];
                  // Upload file
                    $inserted_param4['ads_socialmedialinks_ads_id'] = $inserted_id;
                    $inserted_param4['ads_socialmedialinks'] = $filename;
                  $inserted_id2 = $this->model_ads_socialmedialinks->insert_record($inserted_param4);
                 }
            }

            //debug($_POST['videoLinks'],1);

            if (isset($_POST['videoLinks']) AND array_filled($_POST['videoLinks']) AND $_POST['videoLinks'][0] != "") {
                 // Count total files
                 $countfiles = count($_POST['videoLinks']);
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){
                  $filename = $_POST['videoLinks'][$i];
                  // Upload file
                    $inserted_param5['ads_videolinks_ads_id'] = $inserted_id;
                    $inserted_param5['ads_videolinks'] = $filename;
                  $inserted_id2 = $this->model_ads_videolinks->insert_record($inserted_param5);
                 }
            }


                // $this->session->set_flashdata('message_name', 'Thank you for your AD');
                // redirect("form_add");

            $result['status'] = 1;
            $result['txt'] = 'Thank you for your Ad'; 
            echo json_encode($result);
           // exit;

            } else {

            $result['status'] = 0;
            $result['txt'] = 'Something went wrong.Please try later.'; 
            echo json_encode($result);
            exit;

               // $this->session->set_flashdata('message_name', 'Something went wrong.Please try later.');
                // $this->json_param['status'] = 0;
                // $this->json_param['txt'] = 'Something went wrong.Please try later.';
            }

            } else {

                $this->session->set_flashdata('message_name', 'Something went wrong.Please try later.');

                $result['status'] = 0;
                $result['txt'] = 'Something went wrong.Please try later.'; 
                echo json_encode($result);
                exit;
                // $this->json_param['status'] = 0;
                // $this->json_param['txt'] = 'No parameters found';
            }

        //echo json_encode($this->json_param);
    }


    public static function slugify($text)
    {
      // replace non letter or digits by -
      $text = preg_replace('~[^\pL\d]+~u', '-', $text);

      // transliterate
      $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);

      // remove unwanted characters
      $text = preg_replace('~[^-\w]+~', '', $text);

      // trim
      $text = trim($text, '-');

      // remove duplicate -
      $text = preg_replace('~-+~', '-', $text);

      // lowercase
      $text = strtolower($text);

      if (empty($text)) {
        return 'n-a';
      }

      return $text;
    }

     public function product_image_upload()
    {
        
        if (isset($_FILES['file_data']) AND array_filled($_FILES['file_data'])) {
            
                $tmp = $_FILES['file_data']['tmp_name'];
                // Generate file name
                $name = mt_rand().$_FILES['file_data']['name'];
                // Get upload path
                $upload_path = "assets/uploads/product/";

                // Set data
                $inserted_param['pi_image'] = $name;
                $inserted_param['pi_image_path'] = $upload_path;
                $inserted_param['pi_image_thumb'] = $name;
                $inserted_param['pi_product_id'] = $_GET['product_id'];
                $inserted_param['pi_is_featured'] = 1;
                
                // $inserted_param['photo_status'] = 1;
                move_uploaded_file( $tmp,$upload_path.$name);

                $inserted_id = $this->model_product_image->insert_record($inserted_param);

                if ($inserted_id) {
                    echo json_encode(1);
                }
                else{
                    echo json_encode(0);
                }
                // Not remove default profile image
                /*if(basename($this->session->userdata('userdata')['signup_image'])!=$this->config->item('default_profile_image')){
                    unlink($this->config->item('site_upload_user_photo') . basename($this->session->userdata('userdata')['signup_image']));
                }*/

                // Upload new file
        }
    }
}
