<?php

if (!defined('BASEPATH'))

    exit('No direct script access allowed');



class Color extends MY_Controller {



    /** color

     * CSL Achievements page

     *

     * @package     color

     *

     * @version     1.0 --

     * @since       Version 1.0 2017

     */



    public $_list_data = array();



    public function __construct() {



        global $config;

        

        parent::__construct();

        $this->dt_params['dt_headings'] = "color_id,color_name,color_code,color_status";

        $this->dt_params['searchable'] = array("color_id","color_name","color_status");

        $this->dt_params['action'] = array(

                                        "hide" => false ,

                                        "show_delete" => true ,

                                        "show_edit" => true ,

                                        "order_field" => false ,

                                        "show_view" => false ,

                                        "extra" => array() ,

                                      );

        // Following are common so, defined in MY_Controller_Admin

        // $this->dt_params['paginate']['class'] = $config['js_config']['ci_class'];

        // $this->dt_params['paginate']['uri'] = "paginate";

        // $this->dt_params['paginate']['update_status_uri'] = "update_status";



        // For use IN JS Files



        $config['js_config']['paginate'] = $this->dt_params['paginate'];



        $_POST = $this->input->post(NULL, true);

    }



    public function add($id = 0, $data = array())

    {

        parent::add($id);

    }



}



/* End of file welcome.php */

/* Location: ./application/controllers/welcome.php */

