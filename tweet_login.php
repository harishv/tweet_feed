<?php
session_start();

include_once 'config.php';
include_once 'twitteroauth.php';

$consumerkey=YOUR_CONSUMER_KEY;
$consumersecret=YOUR_CONSUMER_SECRET;
$callback_url_twitter=CALLBACK_URL_TWITTER;

$oauth_token = $_SESSION['oauth_token'];
$oauth_token_secret = $_SESSION['oauth_token_secret'];

if (!empty($_GET['oauth_verifier']) && !empty($oauth_token) && !empty($oauth_token_secret)) {
	// We need to create a new object of TwitterOAuth class to complete the authentication process by completing the authorization process.
	$twitteroauth = new TwitterOAuth($consumerkey, $consumersecret, $oauth_token, $oauth_token_secret);

	$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);

	$_SESSION['access_token']=$access_token;

	// Now we need to fetch the permanent Authorized Credentials of the user.
	$user_info = $twitteroauth->get('account/verify_credentials');

	if (isset($user_info->error)) {
		header('Location: twitter_login.php');
	} else {
		$data = array('uid' => $user_info->id, 'username' => $user_info->name, 'image' => $user_info->profile_image_url, 'created_at' => $user_info->created_at, 'friends_count' => $user_info->friends_count, 'followers_count' => $user_info->followers_count, 'location' => $user_info->location,  'time_zone' => $user_info->time_zone, 'description' => $user_info->description);

		$_SESSION['uid'] = $user_info->id;
		$_SESSION['username'] = $user_info->screen_name;

		header("Location: " . BASE_URL);
	}
} else {
	header('Location: twitter_login.php');
}