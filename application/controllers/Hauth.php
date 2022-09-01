<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class HAuth extends CI_Controller {

	public function login($provider)
	{
		log_message('debug', "controllers.HAuth.login($provider) called");

		try
		{
			log_message('debug', 'controllers.HAuth.login: loading HybridAuthLib');
			//$this->load->library('HybridAuthLib');

			if ($this->hybridauthlib->providerEnabled($provider))
			{
				log_message('debug', "controllers.HAuth.login: service $provider enabled, trying to authenticate.");
				$service = $this->hybridauthlib->authenticate($provider);

				if ($service->isUserConnected())
				{
					log_message('debug', 'controller.HAuth.login: user authenticated.');

					$user_profile = $service->getUserProfile();

					log_message('info', 'controllers.HAuth.login: user profile:'.PHP_EOL.print_r($user_profile, TRUE));

					$data['user_profile'] = $user_profile;

					//$this->load->view('hauth/done',$data);

                    $this->social_login($user_profile);

                    //$service->logout();
				}
				else // Cannot authenticate user
				{
					show_error('Cannot authenticate user');
				}
			}
			else // This service is not enabled.
			{
				log_message('error', 'controllers.HAuth.login: This provider is not enabled ('.$provider.')');
				show_404($_SERVER['REQUEST_URI']);
			}
		}
		catch(Exception $e)
		{
			$error = 'Unexpected error';
			switch($e->getCode())
			{
				case 0 : $error = 'Unspecified error.'; break;
				case 1 : $error = 'Hybriauth configuration error.'; break;
				case 2 : $error = 'Provider not properly configured.'; break;
				case 3 : $error = 'Unknown or disabled provider.'; break;
				case 4 : $error = 'Missing provider application credentials.'; break;
				case 5 : log_message('debug', 'controllers.HAuth.login: Authentification failed. The user has canceled the authentication or the provider refused the connection.');
				         //redirect();
				         if (isset($service))
				         {
				         	log_message('debug', 'controllers.HAuth.login: logging out from service.');
				         	$service->logout();
				         }
				         show_error('User has cancelled the authentication or the provider refused the connection.');
				         break;
				case 6 : $error = 'User profile request failed. Most likely the user is not connected to the provider and he should to authenticate again.';
				         break;
				case 7 : $error = 'User not connected to the provider.';
				         break;
			}

			if (isset($service))
			{
				$service->logout();
			}

			log_message('error', 'controllers.HAuth.login: '.$error);
			show_error('Error authenticating user.');
		}
	}

	public function endpoint()
	{

		log_message('debug', 'controllers.HAuth.endpoint called.');
		log_message('info', 'controllers.HAuth.endpoint: $_REQUEST: '.print_r($_REQUEST, TRUE));

		if ($_SERVER['REQUEST_METHOD'] === 'GET')
		{
			log_message('debug', 'controllers.HAuth.endpoint: the request method is GET, copying REQUEST array into GET array.');
			$_GET = $_REQUEST;
		}

		log_message('debug', 'controllers.HAuth.endpoint: loading the original HybridAuth endpoint script.');
		require_once APPPATH.'/third_party/hybridauth/index.php';

	}

    public function fb_login()
    {
        if(isset($_POST) AND array_filled($_POST))
        {
            $explode = explode(' ', $_POST['name']);
            $x = (object) array(
                'email'=>$_POST['email'],
                'firstName'=>$explode[0],
                'lastName'=>$explode[1],
                'photoURL'=>'',
            );

            $result = $this->social_login($x, true);

            if($result['status']) {
                $this->json_param['status'] = true;
                $this->json_param['url'] = $result['url'];
            }
            else {
                $this->json_param['status'] = false;
                $this->json_param['url'] = $result['url'];
            }
            echo json_encode($this->json_param);
        }
    }

    // Social login start
    public function social_login($userinfo, $is_ajax = false)
    {
        // Extract req params
        $email = $userinfo->email;

        // Set condition and query
        $para['where']['signup_email'] = $email;
        $data = $this->model_signup->find_all_active($para);

        // Check user already register or not
        if($email == $data[0]['signup_email'] )
        {
            // Login use social
            $this->model_signup->auto_login($data[0]['signup_id']);
            //redirect(base_url(),'refresh');
            $url = l('');
            //redirect(l(''),'refresh');

            if($is_ajax)
            {
                $var['status'] = true;
                $var['url'] = $url;
                return $var;
            }
            else
            {
                redirect($url,'refresh');
            }

        }
        // Register User
        else{
            // Extract req params
            $fname   = $userinfo->firstName;
            $lname   = $userinfo->lastName;
            $profile = $userinfo->photoURL;

            // Set slug
            //$slug = $this->model_signup->make_slug($fname , $lname);

            // Compile data
            $signup_data['signup_firstname']         = $fname;
            $signup_data['signup_lastname']         = $lname;
            $signup_data['signup_email']         = $email;
            //$signup_data['signup_slug']          = $slug;
            $signup_data['signup_status']        = 1;
            //$signup_data['signup_profile_image'] = $profile;
            $signup_data['signup_social']        = 1;

            // Set attribute
            $this->model_signup->set_attributes($signup_data);

            // Insert record
            $inserted_id = $this->model_signup->save($signup_data);

            if($inserted_id > 0)
            {
                $this->model_signup->auto_login($inserted_id);
                //redirect(base_url(),'refresh');
                if($is_ajax)
                {
                    $var['status'] = true;
                    $var['url'] = g('base_url');
                    return $var;
                }
                else
                {
                    redirect(g('base_url'),'refresh');
                }
            }
            else
            {
                echo "Unable to login user. Please try later.";
            }


        }
    }
    // Social login end
}

/* End of file hauth.php */
/* Location: ./application/controllers/hauth.php */
