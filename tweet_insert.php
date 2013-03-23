<?php
define('DB_NAME', 'tweet_feed');    // The name of the database
define('DB_USER', 'root');     // Your MySQL username
define('DB_PASSWORD', ''); // and password
define('DB_HOST', 'localhost');    // 99% chance you won’t need to change this value

include_once 'tweets.php';

//connect to the database
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$username=$_POST['user_name'];

//retrieve a twitter feed from tweetapi
$twit_obj = new TweetsApi();
$jsonFeed = $twit_obj->get_tweets($username);

$json = json_decode($jsonFeed);

$latest_time=$mysqli->query("SELECT created_at FROM Tweets  order by created_at desc limit 1");

$latest_time_result=$latest_time->fetch_assoc();
if($latest_time_result){
	$latest_tweet=strtotime($latest_time_result['created_at']);
}
else
	$latest_tweet=0;

// We use https://api.twitter.com/1/related_results/show/<tweet_str_id>.json?include_entities=1
// to get the replies of a specific tweet

// Even this may help https://dev.twitter.com/docs/api/1/post/statuses/update

// Insert each of the tweets into a database table
foreach($json as $js){
	if(strtotime($js->created_at) > $latest_tweet){
		$abc=$mysqli->query("INSERT IGNORE INTO Tweets (tweet_str_id,tweet_msg,user_id_twitted,user_name_twitted,user_profile_pic,favourites,retweeted,created_at) VALUES ('".$mysqli->real_escape_string($js->id_str)."', '".$mysqli->real_escape_string($js->text)."', '".$mysqli->real_escape_string($js->user->id)."', '".$mysqli->real_escape_string($js->user->screen_name)."', '".$mysqli->real_escape_string($js->user->profile_image_url)."', '".$mysqli->real_escape_string($js->favorite_count)."', '".$mysqli->real_escape_string($js->retweet_count)."', '".$mysqli->real_escape_string(date('Y-m-d H:i:s',strtotime($js->created_at)))."')");
	}
}

$latest_tweets = $mysqli->query("SELECT * FROM Tweets  order by created_at desc limit 10");

$tweets = array();

while($latest_tweets_result = $latest_tweets->fetch_assoc())
{
	array_push($tweets, $latest_tweets_result);
}

echo json_encode($tweets, JSON_FORCE_OBJECT);
?>