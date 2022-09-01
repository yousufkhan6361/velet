<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Technical_document extends MY_Controller {

	/**
	 * Technical_document Controller
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
        //$data['banner'] = $this->model_inner_banner->find_by_pk(1);

        $keyword = $this->input->get('keyword');
        $part = $this->input->get('part');

        // Both are not empty
        if( (!empty($keyword)) && (!empty($part)) ){
            $params['where_like'][] = array(
                'column'=>'technical_document_title',
                'value'=>$keyword,
                'type'=>'both',
            );
            $params['where_like'][] = array(
                'column'=>'technical_document_part_number',
                'value'=>$part,
                'type'=>'both',
            );
        }
        // Keyword is not empty and Part is empty
        elseif( (!empty($keyword)) && (empty($part)) ){
            $params['where_like'][] = array(
                'column'=>'technical_document_title',
                'value'=>$keyword,
                'type'=>'both',
            );
        }
        // Part is not empty and Keyword is empty
        elseif( (empty($keyword)) && (!empty($part)) ){
            $params['where_like'][] = array(
                'column'=>'technical_document_title',
                'value'=>$keyword,
                'type'=>'both',
            );
        }

        $data['content'] = $this->model_technical_document->find_all_active($params);


        // Load View
        $this->load_view("index", $data);
    }



}
