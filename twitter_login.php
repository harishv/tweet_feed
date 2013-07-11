<?php
session_start();

include_once 'config.php';
include_once 'twitteroauth.php';

$consumerkey=YOUR_CONSUMER_KEY;
$consumersecret=YOUR_CONSUMER_SECRET;

$callback_url_twitter=CALLBACK_URL_TWITTER;

// Create an object of TwitterOAuth class to initiate the authentication process.
$twitteroauth = new TwitterOAuth($consumerkey, $consumersecret);

$request_token = $twitteroauth->getRequestToken($callback_url_twitter);

$_SESSION['oauth_token']=$request_token['oauth_token'];
$_SESSION['oauth_token_secret']=$request_token['oauth_token_secret'];

if ($twitteroauth->http_code == 200) {
	$url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);

	$result_json=array('status'=>'new', 'url_is'=>$url);
	echo json_encode($result_json);
} else {
	echo json_encode($result_json);
}