<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends MY_Controller {

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

        if($this->userid <= 0){
            // redirect(g('base_url').'user/index');
            redirect(g('base_url').'user/signup');
        }
        // debug(phpinfo(),1);
        global $config;

        if($this->userid){

         $query = $this->db->query("SELECT * FROM fb_ads ad
                                    INNEr JOIN fb_order od
                                    ON ad.ads_user_id = od.order_user_id
                                    WHERE od.order_payment_status = 1 AND od.order_package_name = 'Premium' AND ad.ads_status = 1 ");

         $orderAdds = $query->result_array();

         $query2 = $this->db->query("SELECT * FROM fb_ads ad
                                     INNER JOIN fb_subscription sp
                                     ON ad.ads_user_id = sp.subscription_user_id
                                     WHERE sp.subscription_payment_status = 1 AND sp.subscription_membership_id = 3 AND ad.ads_status = 1");

         $subscriptionAdds = $query2->result_array();
        }


         //showing ads for visitor
        $par44['where']['ads_status'] = 1;
        $par44['where']['ads_featured'] = 1;

        $allAds = $this->model_ads->find_all_active($par44);


        if($orderAdds){

           $data['ads'] = $orderAdds; 

        }else if($userSubscriptionAutoRenewal){
            

            $data['ads'] = $subscriptionAdds; 

        
        }else{

            $data['ads'] = $allAds; 
        }

        $data['ads'] = $allAds; 



        //debug($data['ads'],1);

         $par['where']['favourites_user_id'] = $this->userid;
         $data['favourites'] = $this->model_favourites->find_all_active($par);

        $par3['where']['ads_id'] = 1;
        $data['businessAds'] = $this->model_ads->find_one($par3);
       /// debug($data['businessAds']);
         //debug($data['favourites']);
        // debug($data['banner'],1);
        
        // Load View
        $this->load_view("index", $data);
    }

    public function getSearchData(){

        $inputValues = $_POST['input'];

        // echo $inputValues;

        $que13 = $this->db->query("SELECT ad.ads_id,ad.ads_title,ad.ads_slug,cat.category_id,cat.category_name,cat.category_slug
            FROM fb_ads ad
            INNER JOIN fb_category cat
            ON cat.category_id = ad.ads_category_id
            WHERE cat.category_name LIKE '%$inputValues%' 
            OR ad.ads_title LIKE '%$inputValues%'");

        // $que13 = $this->db->query("SELECT * FROM customers 
        //                             WHERE `name` LIKE '%$inputValues%' 
        //                             OR country LIKE '%$inputValues%'");

        $searchedAds = $que13->result_array();

        //debug($searchedAds,1);

        g('base_url').'ad/'.$ad['ads_slug'];

        $output = "";


        if($inputValues != ""){

        if($searchedAds > 0) {

            $output .= '<table class="myTable">';
            $output .= '<tr class="header">';
            $output .= '<th style="width:30%;">Search Result</th>';
            // $output .= '<th style="width:30%;">Country</th>';
            $output .= '</tr>';

            foreach ($searchedAds as $key => $value) {

              //while ($row = mysqli_fetch_array($result)) {

                $output .= '<tr>';
                $output .= '<td><a href="'.g('base_url').'ad/'.$value['ads_slug'].'">' . $value['ads_title'] . '</a></td>';
                // $output .= '<td>' . $row['country'] . '</td>';
                $output .= '</tr>';

              }
                $output .= '</table>';

            } else {
              $output = "";
              $output .= 'No data matched.';
            }

        }

            echo $output;
            //exit;
            //echo json_encode ($output);

        //debug($searchedAds);
    }

    public function addToFavourites(){

       // debug($_POST['ads_id']);

        //debug($this->userid,1);

        $ads_id = $_POST['ads_id'];
        $user_id = $_POST['user_id'];
        $ads_title = $_POST['ads_title'];
        $ads_slug = $_POST['ads_slug'];
        $ads_image_path = $_POST['ads_image_path'];
        $ads_image = $_POST['ads_image'];


            $data = array(
                    'favourites_ads_id' => $ads_id,
                    'favourites_user_id' => $user_id,
                    'favourites_ads_title' => $ads_title,
                    'favourites_ads_slug' => $ads_slug,
                    'favourites_ads_image_path' => $ads_image_path,
                    'favourites_ads_image' => $ads_image,
                    'favourites_status' => 1,
                    
            );

            // debug($data,1);

            $par['where']['favourites_ads_id'] = $ads_id;
            $par['where']['favourites_user_id'] = $user_id;
            $favExist = $this->model_favourites->find_one($par);

            //debug($favExist,1);

            if($this->userid > 0){

            }else{
                $this->json_param['status'] = 0;
                $this->json_param['txt'] = "Please Login";
                echo json_encode($this->json_param);
                exit;
            }

            if(isset($favExist)){

                $this->json_param['status'] = 0;
                $this->json_param['txt'] = "Already added to favourite list";

            }else{

            $insert = $this->db->insert('fb_favourites', $data);

                if($insert){

                    $this->json_param['status'] = 1;
                    $this->json_param['txt'] = "Added to favourite list";
                }

            }

            echo json_encode($this->json_param);



    }
}
