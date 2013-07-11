<?php
session_start();

include_once 'config.php';
include_once 'tweets.php';
include_once 'twitteroauth.php';

// Connect to the database
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);

// Get the user name from post parameters
$username=$_POST['user_name'];

// Collect the Access Token which helps setting the permanent connection for the access
$access_token = $_SESSION['access_token'];

// Create a TwitterOauth object with consumer/user tokens.
$connection = new TwitterOAuth(YOUR_CONSUMER_KEY, YOUR_CONSUMER_SECRET, $access_token['oauth_token'], $access_token['oauth_token_secret']);

// If method is set change API call made. Test is called by default.
// We retrive the twitter feed of user using the following method.
// Reffer the following url for complete set of options and detailed description:
// https://dev.twitter.com/docs/api/1.1/get/statuses/user_timeline
$jsonFeed = $connection->get('statuses/user_timeline', array('screen_name' => $username, 'count' => 10));

$latest_time = $mysqli->query("SELECT created_at FROM tweets where user_id_twitted = " . $_SESSION['uid'] . " order by created_at desc limit 1");

if($latest_time){
	$latest_time_result = $latest_time->fetch_assoc();
	$latest_tweet = strtotime($latest_time_result['created_at']);
} else {
	$latest_tweet=0;
}

// Insert each of the tweets into the database table
foreach($jsonFeed as $tweet_feed){
	if(strtotime($tweet_feed->created_at) > $latest_tweet){
		$abc=$mysqli->query("INSERT IGNORE INTO tweets (tweet_str_id, tweet_msg, user_id_twitted, user_name_twitted, user_profile_pic, favourites, retweeted, created_at) VALUES ('".$mysqli->real_escape_string($tweet_feed->id_str)."', '".$mysqli->real_escape_string($tweet_feed->text)."', '".$mysqli->real_escape_string($tweet_feed->user->id)."', '".$mysqli->real_escape_string($tweet_feed->user->screen_name)."', '".$mysqli->real_escape_string($tweet_feed->user->profile_image_url)."', '".$mysqli->real_escape_string($tweet_feed->favorite_count)."', '".$mysqli->real_escape_string($tweet_feed->retweet_count)."', '".$mysqli->real_escape_string(date('Y-m-d H:i:s',strtotime($tweet_feed->created_at)))."')");
	}
}

$latest_tweets = $mysqli->query("SELECT * FROM tweets WHERE user_id_twitted = " . $_SESSION['uid'] . " ORDER BY created_at DESC LIMIT 10");

$tweets = array();

while($latest_tweets_result = $latest_tweets->fetch_assoc()) {
	array_push($tweets, $latest_tweets_result);
}

echo json_encode($tweets, JSON_FORCE_OBJECT);
?>