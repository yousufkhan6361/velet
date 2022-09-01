<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Games extends MY_Controller {

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
        $data['banner'] = $this->model_inner_banner->find_by_pk(2);

        $data['games_posters'] = $this->model_game_slider->find_all_active();

        $param['where']['popular_games_is_featured'] = 1;
        $data['featured_game'] = $this->model_popular_games->find_one($param);

        $data['about_content'] = $this->model_cms_page->get_page(6);


        $data['lastsec'] = $this->model_cms_page->get_page(7);




        // Load View
        $this->load_view("index", $data);
    }



}
