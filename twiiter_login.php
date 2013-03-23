function twitter_login() {

		$this->set_redirect();

		$this->load->library('twitteroauth');
		$consumerkey=$this->config->item('YOUR_CONSUMER_KEY');
		$consumersecret=$this->config->item('YOUR_CONSUMER_SECRET');

		$callback_url_twitter=base_url().$this->config->item('CALLBACK_URL_TWITTER');

		$twitteroauth = new TwitterOAuth($consumerkey, $consumersecret);

		$request_token = $twitteroauth->getRequestToken($callback_url_twitter);
			
		$newdata = array('oauth_token'  => $request_token['oauth_token'],'oauth_token_secret'  => $request_token['oauth_token_secret']	);
		$this->session->set_userdata($newdata);
			
		if ($twitteroauth->http_code == 200)
		{
			$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
			//header('Location: ' . $url);
			$result_json=array('status'=>'new','url_is'=>$url);
			echo json_encode($result_json);
		} else {
			//$result_json=array('status'=>'error','msg'=>"Something wrong happened.");
			echo json_encode($result_json);

			//die('Something wrong happened.');
		}
	}
	public function getTwitterData()
	{
		$this->load->library('twitteroauth');
		$consumerkey=$this->config->item('YOUR_CONSUMER_KEY');
		$consumersecret=$this->config->item('YOUR_CONSUMER_SECRET');
		$callback_url_twitter=base_url().$this->config->item('CALLBACK_URL_TWITTER');

		$oauth_token = $this->session->userdata('oauth_token');
		$oauth_token_secret = $this->session->userdata('oauth_token_secret');
			
		if (!empty($_GET['oauth_verifier']) && !empty($oauth_token) && !empty($oauth_token_secret))
		{
			$twitteroauth = new TwitterOAuth($consumerkey,$consumersecret, $oauth_token ,$oauth_token_secret);
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			$access_token = $this->session->userdata('access_token');
			$data = array('access_token'  => $access_token);
			$this->session->set_userdata($data);

			$user_info = $twitteroauth->get('account/verify_credentials');
			if (isset($user_info->error))
			{
				//header('Location: login-twitter.php');
			 $this->twitter_login();
			}
			else
			{

				$data = array('uid'  => $user_info->id,'username' => $user_info->name ,'image' =>  $user_info->profile_image_url,'created_at' => $user_info->created_at,'friends_count' => $user_info->friends_count ,'followers_count' => $user_info->followers_count ,'location' => $user_info->location, 'time_zone' => $user_info->time_zone ,'description' =>$user_info->description );
				$this->session->set_userdata($data);
				$uid = $this->session->userdata('uid');
				$username = $this->session->userdata('username');
				$userdata = $this->Login_model->checkTwitterUser($uid,$username);

				if(!empty($userdata))
				{
					$data1 = array('name'  => 'userlogin','user' =>  $userdata,'login_from'=>'twitter');
					$this->session->set_userdata($data1);
					$this->get_redirect();
				}
			}
		}
		else
		{
			$this->twitter_login();

		}
	}
