<?php 
session_start();
define('YOUR_CONSUMER_KEY',"Ay5M5JRFOyiu6A0D3qcQ");
define('YOUR_CONSUMER_SECRET', "XtgVhbHOOOJ2ximHBQTCnIL9kgzzC0XySspCJHmYpM");
define('CALLBACK_URL_TWITTER', "http://tweet.harishvarada.com/tweet_login.php");

function twitter_login() {

		

		include('twitteroauth');
		$consumerkey=YOUR_CONSUMER_KEY;
		$consumersecret=YOUR_CONSUMER_SECRET;

		$callback_url_twitter=base_url().CALLBACK_URL_TWITTER;

		$twitteroauth = new TwitterOAuth($consumerkey, $consumersecret);

		$request_token = $twitteroauth->getRequestToken($callback_url_twitter);
			
		$newdata = array('oauth_token'  => $request_token['oauth_token'],'oauth_token_secret'  => $request_token['oauth_token_secret']	);
		$_SESSION['userdata']=$newdata;
			
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
	 
		include('twitteroauth');
		$consumerkey=YOUR_CONSUMER_KEY;
		$consumersecret=YOUR_CONSUMER_SECRET;
		$callback_url_twitter=base_url().CALLBACK_URL_TWITTER;

		$oauth_token = $_SESSION['userdata']['oauth_token'];
		$oauth_token_secret = $_SESSION['userdata']['oauth_token_secret'];
			
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
			 twitter_login();
			}
			else
			{

				$data = array('uid'  => $user_info->id,'username' => $user_info->name ,'image' =>  $user_info->profile_image_url,'created_at' => $user_info->created_at,'friends_count' => $user_info->friends_count ,'followers_count' => $user_info->followers_count ,'location' => $user_info->location, 'time_zone' => $user_info->time_zone ,'description' =>$user_info->description );
				$_SESSION['username']=$data['username'];
				
				header('Location: http://tweet.harishvarada.com/');
				/*$userdata = $this->Login_model->checkTwitterUser($uid,$username);

				if(!empty($userdata))
				{
					$data1 = array('name'  => 'userlogin','user' =>  $userdata,'login_from'=>'twitter');
					$this->session->set_userdata($data1);
					
				}*/
			}
		}
		else
		{
			twitter_login();

		}
	
