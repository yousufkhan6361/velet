<?php
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Ads extends MY_Controller {

	/**
	 * CSL Achievements page
	 *
	 * @package		ads
	 *
     * @version		1.0 --
     * @since		Version 1.0 2017
	 */

    public $_list_data = array();

	public function __construct() {

		global $config;
		
		parent::__construct();
        $this->dt_params['dt_headings'] = "ads_id,ads_category_id,ads_title,ads_image,ads_featured,ads_status";
        $this->dt_params['searchable'] = array("ads_id","ads_category_id","ads_title","ads_featured","");
        
        $this->dt_params['action'] = array(
        								"hide_add_button" => false ,
                                        "hide" => false ,
                                        "show_delete" => true ,
                                        "show_edit" => true ,
                                        "order_field" => false ,
                                        "show_view" => false ,
                                        "extra" => array() ,
                                      );

        $this->_list_data['ads_status'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">Inactive</span>" ,
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Active</span>"
                                    );


        $this->_list_data['ads_featured'] = array( 
                                        STATUS_INACTIVE => "<span class=\"label label-default\">No</span>" ,  
                                        STATUS_ACTIVE =>  "<span class=\"label label-primary\">Yes</span>"  
                                    );
        // Following are common so, defined in MY_Controller_Admin
		// $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];
		// $this->dt_params['paginate']['uri'] = "paginate";
		// $this->dt_params['paginate']['update_status_uri'] = "update_status";

		// For use IN JS Files

		$config['js_config']['paginate'] = $this->dt_params['paginate'];


        /*$this->_list_data['ads_page'] = array(
            'home'=>'Home',
            'wireless'=>'Wireless',
            'accessories'=>'Accessories',
            'about_us'=>'About Us',
            'ads_info'=>'ads & Info',
            'contact_us'=>'Contact Us',
        );*/
         $this->_list_data['ads_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");
         $this->_list_data['ads_location_id'] = $this->model_blog_category->find_all_list_active(array(),"blog_category_name");


		//$this->_list_data['ads_category_id'] = $this->model_category->find_all_list_active(array(),"category_name");
		//$this->_list_data['ads_product_id'] = $this->model_product->find_all_list_active(array(),"product_name");

		$_POST = $this->input->post(NULL, false);
	}

	public function add($id='', $data=array())
	{

        $this->add_script(array( "jquery.validate.js" , "form-validation-script.js") , "js" );
        $this->register_plugins("jquery-file-upload");

        
        // if($id)
        // {
            
        //     $params = array();
        //     $params['where']['ads_gallery_ads_id'] = $id;
        //     $this->_list_data['adsImages'] = $this->model_ads->get_data($params);
            
        // }

		parent::add($id, $data);
	}

    public function deleteAdsImage(){


        $imageid = $this->uri->segment(4);
        $adId = $_GET['adid'];
        //debug($adId,1);
        $url = la('ads/add/'.$adId);

        //debug($url,1);

        $this->db->where('ads_gallery_id', $imageid);
        $delete = $this->db->delete('fb_ads_gallery');
        if($delete){
            redirect($url);
        }
    }

    public function uploadImages(){

        //$countPictures = count($_FILES['multiImages']['name']);
        $adId = $_POST['adId'];
        $url = la('ads/add/'.$adId);

        if (isset($_FILES['multiImages']) AND array_filled($_FILES['multiImages'])) {
                 // Count total files
                 $countfiles = count($_FILES['multiImages']['name']);
                 // Looping all files
                 for($i=0;$i<$countfiles;$i++){

                  $filename = $_FILES['multiImages']['name'][$i];
                 // debug($filename,1);
                  // Upload file
                  $upload_path2 = "assets/uploads/ads/gallery/";
                    $inserted_param['ads_gallery_ads_id'] = $adId;
                    $inserted_param['ads_gallery_image_path'] = $upload_path2;
                    $inserted_param['ads_gallery_image'] = $filename;
                  move_uploaded_file($_FILES['multiImages']['tmp_name'][$i], 'assets/uploads/ads/gallery/'.$filename);
                  $inserted_id2 = $this->model_ads_gallery->insert_record($inserted_param);
                 
                 }

                 redirect($url);
            }
        //debug($_FILES);
    }

     public function deleteAdsVideo(){

        $videoid = $this->uri->segment(4);
        $adId = $_GET['adid'];
        $url = la('ads/add/'.$adId);

        $this->db->where('ads_video_id', $videoid);
        $delete = $this->db->delete('fb_ads_video');
        if($delete){
            redirect($url);
        }
    }


    public function deleteAdsDocs(){

        $adsid = $this->uri->segment(4);
        $adId = $_GET['adid'];
        $url = la('ads/add/'.$adId);

        $this->db->where('ads_docs_id', $adsid);
        $delete = $this->db->delete('fb_ads_docs');
        if($delete){
            redirect($url);
        }
    }


    public function deleteAdsVideolink(){

        $videoid = $this->uri->segment(4);
        $adId = $_GET['adid'];
        $url = la('ads/add/'.$adId);

        $this->db->where('ads_videolinks_id', $videoid);
        $delete = $this->db->delete('fb_ads_videolinks');
        if($delete){
            redirect($url);
        }

    }

    public function uploadVideos(){

        //$countPictures = count($_FILES['multiImages']['name']);
        $adId = $_POST['adId'];
        $url = la('ads/add/'.$adId);

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

                     redirect($url);
                }
            //debug($_FILES);
        }


        public function uploadDocs(){

        //$countPictures = count($_FILES['multiImages']['name']);
        $adId = $_POST['adId'];
        $url = la('ads/add/'.$adId);

           if($_FILES['multiDocs']['name'][0] != ""){
                //if (isset($_FILES['multiDocs']) AND array_filled($_FILES['multiDocs'])) {
                     // Count total files
                     $countfiles = count($_FILES['multiDocs']['name']);
                     // Looping all files
                     for($i=0;$i<$countfiles;$i++){
                      $filename = $_FILES['multiDocs']['name'][$i];
                      // Upload file
                      $upload_path3 = "assets/uploads/ads/docs";
                        $inserted_param2['ads_docs_ads_id'] = $adId;
                        $inserted_param2['ads_docs_image_path'] = $upload_path3;
                        $inserted_param2['ads_docs_image'] = $filename;
                      move_uploaded_file($_FILES['multiDocs']['tmp_name'][$i], 'assets/uploads/ads/docs/'.$filename);
                     //debug($inserted_param,1);
                      $inserted_id2 = $this->model_ads_docs->insert_record($inserted_param2);
                     }

                     redirect($url);
                }
            //debug($_FILES);
        }

        public function addlinks(){

            $link = $_POST['links'];
            $adId = $_POST['adId'];

            $url = la('ads/add/'.$adId);
            
            $data = array(
                        'ads_videolinks_ads_id' => $adId,
                        'ads_videolinks' => $link,
                        'ads_videolinks_status' => 1
                );

            $insert = $this->db->insert('fb_ads_videolinks', $data);
            if($insert){
                redirect($url);
            }

            // debug($adId,1);
        }

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
