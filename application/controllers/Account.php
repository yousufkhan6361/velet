<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Account extends MY_Controller {

	/**
	 * Account Controller
	 *
	 */
	
	public function __construct()
    {
    	// Call the Model constructor latest_product
        parent::__construct();
    }

    // Default Profile page
	public function index()
	{ 
		if($this->userid <= 0){
			// redirect(g('base_url').'user/index');
            redirect(g('base_url').'user/signup');
		}


        //$this->getinvoice();
		global $config;
        // Set banner heading
        //$data['banner_heading'] = "My Account";

        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(14);
        // Get and set cms data
        $data['content'] = $this->model_cms_page->get_page(12);
        // Get banner
        // $data['inner_banner'] = $this->model_banner->get_banners(8);

        //$data['inner_banner'] = $this->model_inner_banner->find_by_pk(2);
		$this->load_view("index" , $data);
	}

    // Account info page
	public function info(){
		if($this->userid <= 0){
			redirect(g('base_url').'user/signup');
		}
		global $config;
        //$model = $this->cuser_model;
		//$this->add_script(array('innerstyle.css','font-awesome.min.css'));
		$data['userEmail'] = $this->session->userdata['logged_in']['email'];
		$data['userdata'] = $this->model_signup->find_by_pk($this->userid);

        // Get Countries
        $data['countries'] = $this->model_country->find_all_active();

        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(14);

		//$data['title'] = 'My Account Info';
        // Set banner heading
        $data['banner_heading'] = "Account Info";

        // 1:parent/teacher , 2:kid
        //$view = ($this->user_type==1)?'info':'kid/info';

		$this->load_view("info" , $data);
	}

  public function ForgotPasswordEmail(){

  $email = $_POST['signup']['signup_email'];
  //debug($email,1);

  $signupData = $this->model_signup->find_one(
                array('where'=>array('signup_email' => $email,'signup_status'=>1)));

  //debug($signupData,1);

  if(count($signupData) > 0){

    $title = "Forgot Password";
    $signupData['id'] = "yrt15".$signupData['signup_id']."xyurt8576412";

    //debug($signupdata['id'],1);
    $template = $this->load->view("_layout/email_template/forgotpassword",$signupData,true);
    $to = $signupData['signup_email'];

     // debug($to);
     // debug($template,1);

    //debug($template,1);
    parent::fp_email($to,$template,$title);
    // echo json_encode(array('status'=>1));
    $param['status'] = 1;
          $param['txt'] = 'Check your email';
          echo json_encode($param);
    //debug($to,1);
  }else{

    // echo json_encode(array('status'=>0));

    $param['status'] = 0;
          $param['txt'] = 'Email not exist Enter your email';
          echo json_encode($param);
  }

}

public function resetpassword()
{

  // $data['banners'] = $this->model_banner->find_one(
  //           array('where'=>array('banner_id'=>17,'banner_status'=>1)));


  $data['user_id'] = $_GET['id'];
  $this->load_view("user_set_password",$data);
}

// public function resetpasswordclient(){

//   $id = $_POST['user_id'];
//   $id = str_replace("yrt15","", $id);
//   $id = str_replace("xyurt8576412", "", $id);

// //debug($_POST['newPassword'],1);
//   if(isset($_POST['newPassword']) && empty($_POST['newPassword'])){
//     echo json_encode(array('status'=>0,'txt'=>'Please provide The Password'));

//   }else{
//     $password = md5($_POST['newPassword']);
//     $status = $this->model_signup->update_by_pk($id,array('signup_password'=>$password));
//     if($status){
//       echo json_encode(array('status'=>1,'txt'=>'Your password has been changed'));

//     }else{
//       echo json_encode(array('status'=>0,'txt'=>'Please try again or use different password'));
//     }
//   }
// }

    public function affiliate(){
        if($this->userid <= 0){
            redirect(g('base_url').'user/signup');
        }
        global $config;
        //$model = $this->cuser_model;
        //$this->add_script(array('innerstyle.css','font-awesome.min.css'));
        $data['userEmail'] = $this->session->userdata['logged_in']['email'];
        $data['userdata'] = $this->model_signup->find_by_pk($this->userid);

        $data['userId'] = $data['userdata']['signup_id'];
        $data['userName'] = $data['userdata']['signup_firstname'];
        $data['userEmail'] = $data['userdata']['signup_email'];

        $par['where']['affiliate_userid'] = $data['userId'];
        $affiliateData = $this->model_affiliate->find_one($par);

        $data['affiliateLink'] = $affiliateData['affiliate_link'];

        $data['banner_heading'] = "Affiliate Link";

        // 1:parent/teacher , 2:kid
        //$view = ($this->user_type==1)?'info':'kid/info';

        $this->load_view("affiliate" , $data);
    }

    public function deleteImages(){

        $galleryId = $this->uri->segment(3);

        $par['where']['ads_gallery_id'] = $galleryId;
        $gData = $this->model_ads_gallery->find_all($par);

       // debug($gData,1);

        $this->db->where('ads_gallery_id', $galleryId);
        $delete = $this->db->delete('ads_gallery');

        if($delete){
         // unlink($gData[0]['ads_gallery_image_path'] . $gData[0]['ads_gallery_image']);
          redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function deleteVideos(){

        $VideoId = $this->uri->segment(3);

        $par['where']['ads_video_id'] = $VideoId;
        $vData = $this->model_ads_video->find_all($par);

       // debug($vData,1);

        $this->db->where('ads_video_id', $VideoId);
        $delete = $this->db->delete('ads_video');

        if($delete){
         // unlink($vData[0]['ads_video_image_path'] .'/'. $vData[0]['ads_video_image']);
          redirect($_SERVER['HTTP_REFERER']);
        }

    }

    public function deleteDocs(){

        $DocId = $this->uri->segment(3);

        $par['where']['ads_docs_id'] = $DocId;
        $dData = $this->model_ads_docs->find_all($par);

        //debug($dData,1);

        $this->db->where('ads_docs_id', $DocId);
        $delete = $this->db->delete('ads_docs');

        if($delete){
         // unlink($dData[0]['ads_docs_image_path'] .'/'. $dData[0]['ads_docs_image']);
          redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function editads(){

        $userId = $this->userid;
        $par['where']['ads_user_id'] = $userId;
        $data['adsData'] = $this->model_ads->find_all_active($par);

        //debug($adsData);

        $this->load_view("editadsView" , $data);
    }

    public function editForm(){

        $userId = $this->userid;
        $adSlug = $this->uri->segment(3);

        // get categories data 
        $data['categories'] = $this->model_category->find_all_active();

        // getting ads record 
        $par1['where']['ads_slug'] = $adSlug;
        $data['adsData'] = $this->model_ads->find_all_active($par1);

        $adsId = $data['adsData'][0]['ads_id'];

        // getting social media links against this ad
        $par4['where']['ads_socialmedialinks_ads_id'] = $adsId;
        $data['soicialMediaLinks'] = $this->model_ads_socialmedialinks->find_all($par4);

        // getting gallery images against this ad 
        $par5['where']['ads_gallery_ads_id'] = $adsId;
        $data['adsGallery'] = $this->model_ads_gallery->find_all($par5);

        // getting videoLinks against this ad if available
        $par6['where']['ads_videolinks_ads_id'] = $adsId;
        $adsVideoLinks = $this->model_ads_videolinks->find_all($par6);

        // getting videos against this ad if available
        $par7['where']['ads_video_ads_id'] = $adsId;
        $adsVideos = $this->model_ads_video->find_all($par7);

        $par8['where']['ads_docs_ads_id'] = $adsId;
        $data['adsDocs'] = $this->model_ads_docs->find_all($par8);

        $data['adsId'] = $adsId;

        //debug($data['adsData']);

        if(empty($adsVideoLinks)){

            $data['adsVideos'] = $adsVideos;

        }else{

            $data['adsVideoLinks'] = $adsVideoLinks;

        }

        //debug($data,1);
        //debug($data['adsGallery'],1);

        

        // getting manual and autorenewal orders for getting package Id start
        $param2['where']['order_user_id'] = $userId;
        $param2['where']['order_payment_status'] = 1;
        $userSubscription = $this->model_order->find_one($param2);

        $param3['where']['subscription_user_id'] = $userId;
        $param3['where']['subscription_payment_status'] = 1;
        $userSubscriptionAutoRenewal = $this->model_subscription->find_one($param3);


        if($userSubscription){

            $data['userPackageId'] = $userSubscription['order_package_id'];

        }else if($userSubscriptionAutoRenewal){
            
            $data['userPackageId'] = $userSubscriptionAutoRenewal['subscription_membership_id'];

        }else{

            $data['userPackageId'] = 0;

        }

        // getting manual and autorenewal orders for getting package Id end

       // debug($data['adsData']);


        //debug($data,1);

        $this->load_view("editadsForm" , $data);
    }


    public function updateAdForm(){

        // Get post data
        $post = $this->input->post();
        //debug($post,1);

        if (count($post) > 0) {
            // Get data
            $contact_us_data = $post['ads'];


            $paidPackageId = $_POST['paidPackageId'];
            $userId = $post['ads']['ads_user_id'];
            $adId = $post['adId'];

            $tiny_html = $post['tiny_html'];

            $countPictures = count($_FILES['multiImages']['name']);
            $countVideos = count($_FILES['multiVideos']['name']);
            $countDocs = count($_FILES['multiDocs']['name']);
            $videoStatus = '';

            //debug($post,1);

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

                if($countPictures > 3){

                // $this->session->set_flashdata('message_name', 'You can upload only 3 pictures in this package <br> Get premium package for more pictures');
                    
                //     redirect("form_add");

                  $result['status'] = 0;
                  $result['txt'] = 'You can upload only 3 pictures in this package <br> Get premium package for more pictures'; 
                  echo json_encode($result);
                  exit;
                }
            }

            if($paidPackageId == 2){


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

           // $otherCat = $contact_us_data['ads_other_category'];
    
            // if($cat == "Other" && $otherCat != ""){
            //     $contact_us_data['ads_category'] = $contact_us_data['ads_other_category'];
            // }else{
            //     $contact_us_data['ads_category'] = $cat;
            // }

            $tinyMcDescription = $tiny_html;

            //debug($tinyMcDescription,1);


            //$contact_us_data['ads_featured'] = 1;
            //$contact_us_data['ads_status'] = ;
            $contact_us_data['ads_description'] = $tinyMcDescription;

            

            $this->model_ads->set_attributes($contact_us_data);

            $inserted_id = $this->model_ads->update_by_pk($adId,$contact_us_data);

            //$inserted_id = $this->model_ads->save();
            // if($inserted_id){
            //   echo "data updated";
            // }else{
            //   echo "data not updated";
            // }

            // exit;

            if ($inserted_id > 0) {

                if (isset($_FILES['multiImages']) AND $_FILES['multiImages']['name'][0] != "" AND array_filled($_FILES['multiImages'])) {
                 // Count total files
                 $countfiles = count($_FILES['multiImages']['name']);
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){
                  $filename = $_FILES['multiImages']['name'][$i];
                  // Upload file
                  $upload_path2 = "assets/uploads/ads/gallery/";
                    $inserted_param['ads_gallery_ads_id'] = $adId;
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
                    $inserted_param2['ads_video_ads_id'] = $adId;
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
                    $inserted_param3['ads_docs_ads_id'] = $adId;
                    $inserted_param3['ads_docs_image_path'] = $upload_path4;
                    $inserted_param3['ads_docs_image'] = $filename;
                  move_uploaded_file($_FILES['multiDocs']['tmp_name'][$i], 'assets/uploads/ads/docs/'.$filename);
                  $inserted_id2 = $this->model_ads_docs->insert_record($inserted_param3);
                 }
            }

            if (isset($_POST['socialMediaLins']) AND array_filled($_POST['socialMediaLins'])) {
                 // Count total files
                  $countfiles = count($_POST['socialMediaLins']);
                  $data = array();

                 // Looping all files
                  for($i=0;$i<$countfiles;$i++){

                    $filename = $_POST['socialMediaLins'][$i];
                     $id = $_POST['ids'][$i];

                    $data[] = array(
                                    "ads_socialmedialinks_id" => $id,
                                    "ads_socialmedialinks" => $filename
                    );
                  
                  }

                  //debug($data,1);
                  $this->db->update_batch('fb_ads_socialmedialinks', $data, 'ads_socialmedialinks_id');

                 //exit;
            }

            //debug($_POST['videoLinks'],1);

            if (isset($_POST['videoLinks']) AND array_filled($_POST['videoLinks']) AND $_POST['videoLinks'][0] != "") {
                 // Count total files

              //debug($_POST['vids'],1);
                 $countfiles = count($_POST['videoLinks']);
                 $data2 = array();
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){

                  $filename = $_POST['videoLinks'][$i];
                  $Vid = $_POST['vids'][$i];

                    $data2[] = array(
                                    "ads_videolinks_id" => $Vid,
                                    "ads_videolinks" => $filename
                    );

                   // $filename = $_POST['videoLinks'][$i];
                    // Upload file
                   //$inserted_param5['ads_videolinks_ads_id'] = $adId;
                   // $inserted_param5['ads_videolinks'] = $filename;
                    //$inserted_id2 = $this->model_ads_videolinks->insert_record($inserted_param5);

                    //$inserted_id2 = $this->model_ads_videolinks->update_by_pk($adId,$inserted_param5);
                 }

                 $this->db->update_batch('fb_ads_videolinks', $data2, 'ads_videolinks_id');
            }


                // $this->session->set_flashdata('message_name', 'Thank you for your AD');
                // redirect("form_add");

            $result['status'] = 1;
            $result['txt'] = 'Ad updated successfully'; 
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

    public function update_info()
    {
        $signup_data = $this->input->post('signup');

        if((count($_POST) > 0) && (array_filled($signup_data)))
        {
            if($this->validate("model_signup"))
            {
                //debug($signup_data,1);
                $status = $this->model_signup->update_by_pk($this->userid,$signup_data);

                if($status > 0)
                {
                    //debug($status,1);
                    // Update session
                    $this->model_signup->update_user_session($signup_data);

                    $param['status'] = 1;
                    $param['txt'] = 'Updated successfully.';
                    echo json_encode($param);
                }
                else
                {
                    $param['status'] = 0;
                    $param['txt'] = 'Fail to update record';
                    echo json_encode($param);
                }
            }
            else
            {
                $param['status'] = 0;
                $param['txt'] = validation_errors();
                echo json_encode($param);
            }
        }
        else{
            $param['status'] = 0;
            $param['txt'] = "Please enter required field";
            echo json_encode($param);
        }
    }


    public function orderhistory(){

		if($this->userid <= 0){
			redirect(g('base_url').'user/signup');
		}

		global $config;

		$data['userEmail'] = $this->session->userdata['logged_in']['email'];
		
        $userId = $this->userid;
        // start code for order Users manual paypal
        $query = $this->db->query("SELECT * FROM fb_order od
                                    INNER JOIN fb_signup sp
                                    ON od.order_user_id = sp.signup_id
                                    WHERE od.order_payment_status = 1 AND sp.signup_id = '".$userId."' ");

        $manualOrder = $query->result_array();

        
        

        // end code for order Users manual paypal

        // Start code for subscription orders recuuring paypal
        $query2 = $this->db->query("SELECT * FROM fb_subscription sc
                                    INNER JOIN fb_signup sp
                                    ON sc.subscription_user_id = sp.signup_id
                                    WHERE sc.subscription_payment_status = 1 AND sp.signup_id = '".$userId."' ");

        $autorenewalSubscriber = $query2->result_array();
        // End code for subscription orders recurring paypal
        


        if($manualOrder){

            $packageId = $manualOrder[0]['order_package_id'];

            $packages = $this->getPackages($packageId);

            $data['ordersData'] = $manualOrder;
            $data['packageDetail'] = $packages;
            $data['orderStatus'] = 'manual';

        }else if($autorenewalSubscriber){
            

            $packageId2 = $autorenewalSubscriber[0]['subscription_membership_id'];

            $packages = $this->getPackages($packageId2);

            $data['ordersData'] = $autorenewalSubscriber;
            $data['packageDetail'] = $packages;
            $data['orderStatus'] = 'autorenewal';

        
        }else{

            $data['ordersData'] = '';
        }   

        //debug($userId);

        //debug($data,1);

		$data['title'] = 'Order History';

		$this->load_view("orderhistory" , $data);
	}

    public function getPackages($pkgid){

        $param1['where']['packages_id'] = $pkgid;
        $packagesData = $this->model_packages->find_one($param1);
        //debug($packagesData,1);

        $pDetail = array(
                    "packages_name"=>$packagesData['packages_name'],
                    "packages_price"=>$packagesData['packages_price'],
                    "packages_days"=>$packagesData['packages_days'],
        );

        return $pDetail;
    }
	
	public function trackorder(){

		if($this->userid <= 0){

			redirect(g('base_url').'user/signup');

		}
		global $config;

        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(14);
        
        if(!empty($_GET['tracking_number']))
        {
            $param = array();

			$param['joins'][] = array(
				'table' => 'order_item',
				'joint' => 'order_item_order_id = order_id',
				);

			$param['joins'][] = array(
				'table' => 'product',
				'joint' => 'order_item_product_id = product_id',
				);

			 $param['where']['order_tracking_number'] = $_GET['tracking_number'];
			// $param['where']['order_status'] = 1;
			$data['order'] = $this->model_order->find_one($param);
        }
		//$data['country'] = $this->model_country->find_all();
            // debug($data['order'],1);
		$this->load_view("trackorder" , $data);
	}



    public function getinvoice(){

        $order_id = intval($_POST['order_id']);
        
        $data['order_detail'] = $this->model_order->find_by_pk($order_id);

        $data['order_items'] = $this->model_order_item->find_all(
            array('where'=>array('order_item_order_id'=>$order_id))
        );
        //debug($data['order_detail']);
        //debug($data['order_items']);

        //$message = $this->load->view("account/invoiceTemplate",$data,true);
        //echo $message;
        $this->load_view("invoiceTemplate" , $data);
    }

    public function getinvoice2(){

        $paymentTypeStatus = $_GET['status'];
        $order_id = intval($_GET['order_id']);
        $data['status'] = $paymentTypeStatus;
        
        if($paymentTypeStatus == "manual"){

            $query = $this->db->query("SELECT * FROM fb_order od
                                        INNER JOIN fb_signup sp
                                        ON od.order_user_id = sp.signup_id
                                        WHERE od.order_id = '".$order_id."' ");

            $manualOrderData = $query->result_array();
            $data['orderData'] = $manualOrderData;
            //debug($data['orderData'],1);

            $packageId = $data['orderData'][0]['order_package_id'];

            $packages = $this->getPackages($packageId);
            $data['packageData'] = $packages;

        }else{

            $query = $this->db->query("SELECT * FROM fb_subscription sc
                                        INNER JOIN fb_signup sp
                                        ON sc.subscription_user_id = sp.signup_id
                                        WHERE sc.subscription_id = '".$order_id."' ");

            $subscriptionData = $query->result_array();
            $data['orderData'] = $subscriptionData;
            $packageId = $data['orderData'][0]['subscription_membership_id'];

            $packages = $this->getPackages($packageId);
            $data['packageData'] = $packages;

            //debug($packages,1);

        }

       // debug($data,1);
        //$data['order_detail'] = $this->model_order->find_by_pk($order_id);
        //debug($data['order_detail']);
        //debug($data['order_items']);
        //$message = $this->load->view("account/newInvoiceTemplate",$data,true);
        //echo $message;
        $this->load_view("newInvoiceTemplate" , $data);
    }

	public function mywishlist(){
		if($this->userid <= 0){
			redirect(g('base_url').'user/signup');
		}
		global $config;
		$data['userEmail'] = $this->session->userdata['logged_in']['email'];
		$data['wishlist'] = $this->model_wishlist->find_all(
			array('where'=>array('wishlist_user_id'=>$this->userid)));
		
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(16);
		//$data['country'] = $this->model_country->find_all();

		$data['title'] = 'My Wishlist';

		$this->load_view("wishlist" , $data);
	}

    public function my_favorites(){

        if($this->userid <= 0){

            redirect(g('base_url').'');

        }

        global $config;
        //$data['userEmail'] = $this->session->userdata['logged_in']['email'];

        /*$params['joins'][] = array(
            "table"=>"order_item" ,
            "joint"=>"order_item.order_item_order_id = order.order_id"
            );*/

        $data['banner_heading'] = "Account Info";

        $data['result'] = $this->model_favorite->get_my_fav($this->userid);
        //$data['country'] = $this->model_country->find_all();

        //$data['title'] = 'Order History';

        $this->load_view("my_favorites" , $data);
    }

	public function addwishlist(){

		if($this->userid <= 0){

			echo json_encode(array('status'=>0,'message'=>'You are not logged in'));

		}else{

			$data['wishlist_user_id'] = $this->userid;
			$data['wishlist_product_id'] = intval($_POST['product_id']);
			$status = $this->model_wishlist->insert_record($data);

			if($status > 0){

				echo json_encode(array('status'=>1,'message'=>'Your item has been added into your wishlist.'));

			}else{

				echo json_encode(array('status'=>0,'message'=>'Please try again'));

			}
		}
	}

    // Change password view
	public function change_password(){

        //debug(1,1);

		if($this->userid <= 0){
			redirect(g('base_url').'user/signup');
		}
		global $config;
        $data['inner_banner'] = $this->model_inner_banner->find_by_pk(14);
        // Get and set cms data
        $data['content'] = $this->model_cms_page->get_page(12);
		//$this->add_script(array('innerstyle.css','font-awesome.min.css'));
		$data['userEmail'] = $this->session->userdata['userdata']['email'];
		$data['userdata'] = $this->model_signup->find_by_pk($this->userid);

        // Set banner heading
        $data['banner_heading'] = "Change Password";

		$this->load_view("changepassword" , $data);
	}

    // update_password
	public function update_password(){
        //debug(1,1);
		if($this->userid <= 0){
			$param['status'] = 0;
			$param['txt'] = "you are not registered";
			echo json_encode($param);
		}
		else{
            $password = $this->input->post('signup');
            //debug($password['signup_password']);
			if((count($_POST) > 0) && (isset($password['signup_password'])) && (!empty($password['signup_password']))) {
				$param['signup_password'] = md5($password['signup_password']);
                //debug($param['signup_password']);
				$status = $this->model_signup->update_by_pk($this->userid,$param);
                //debug($status);
				if($status){
					$this->json_param['status'] = 1;
					$this->json_param['txt'] = 'Password has been changed.';
                    echo json_encode($this->json_param);
				}
			}
            else{
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = 'Record Not Found.';
                echo json_encode($this->json_param);
            }
		}
	}


	public function resetpasswordclient(){
		$id = $_POST['user_id'];
		
  		//$encodedID = "yrt15".$result['id']."xyurt8576412";
  		$id = str_replace("yrt15", "", $id);
  		$id = str_replace("xyurt8576412", "", $id);
  		
  		//debug($id,1);

  		if(isset($_POST['password']) && empty($_POST['password'])){
  			echo json_encode(array('status'=>0,'txt'=>'Please provide the password'));
  		}
  		else{
  			$password = md5($_POST['password']);
  			$status = $this->model_signup->update_by_pk($id,array('signup_password'=>$password));
  			if($status){
  				echo json_encode(array('status'=>1,'txt'=>'Your password has been changed.'));		
  			}
  			else{
  				echo json_encode(array('status'=>0,'txt'=>'Please try again or use different password'));		
  			}
  		}
	}

    // Update profile image
    public function update_profile_image()
    {
        // Get User id
        $user_id = $this->userid;

        // Success
        if((count($_FILES)>0) && ($user_id!=null)){
            // Get temp file
            $tmp = $_FILES['file']['tmp_name'];
            // Generate file name
            $name = mt_rand().$_FILES['file']['name'];

            // Get upload path
            $upload_path = $this->config->item('site_upload_signup');

            // Set data
            $data = array(
                'signup_logo_image' => $name,
                'signup_logo_image_path' => $upload_path,
            );

            // Remove old file
            /*if(!empty($this->session->userdata('userdata')['signup_image'])){
                unlink($this->config->item('site_upload_user_photo') . basename($this->session->userdata('userdata')['signup_image']));
            }*/

            // Not remove default profile image
            /*if(basename($this->session->userdata('userdata')['signup_image'])!=$this->config->item('default_profile_image')){
                unlink($this->config->item('site_upload_user_photo') . basename($this->session->userdata('userdata')['signup_image']));
            }*/

            // Upload new file
            move_uploaded_file( $tmp,$upload_path.$name);

            $inserted_id = $this->model_signup->update_by_pk($user_id, $data);

            if($inserted_id > 0)
            {
                $profile_image_url = array(
                    'signup_image'=>$upload_path . $name
                );
                // Update session profile
                $this->model_signup->update_user_session($profile_image_url);
                // save log ends

                $this->json_param['status'] = true;
                $this->json_param['txt'] = 'Updated successfully.';
            }
            else{
                $this->json_param['status'] = false;
                $this->json_param['txt'] = 'Something went wrong.Please try later.';
            }
        }
        // Error
        else{
            $this->json_param['status'] = false;
            $this->json_param['txt'] = lang('something_wrong');
        }

        echo json_encode($this->json_param);

    }


}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */