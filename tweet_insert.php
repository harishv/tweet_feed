<?php

define('DB_NAME', 'tweet_feed');    // The name of the database
define('DB_USER', 'root');     // Your MySQL username
define('DB_PASSWORD', ''); // …and password
define('DB_HOST', 'localhost');    // 99% chance you won’t need to change this value

//connect to the database
$mysqli = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
$username=$_POST['user_name'];
//retrieve a twitter feed
$jsonFeed = file_get_contents('https://api.twitter.com/1/statuses/user_timeline.json?include_entities=true&include_rts=true&screen_name='.$username.'&count=2&exclude_replies=false');
$json = json_decode($jsonFeed);

$latest_time=$mysqli->query("SELECT created_at FROM Tweets  order by created_at desc limit 1");

$latest_time_result=$latest_time->fetch_assoc();
if($latest_time_result){
$latest_tweet=strtotime($latest_time_result['created_at']);
}
else 
$latest_tweet=0;


//input each of the tweets into a database table
foreach($json as $js){

	if(strtotime($js->created_at) > $latest_tweet){
	$abc=$mysqli->query("INSERT IGNORE INTO Tweets (tweet_msg,user_id_twitted,user_name_twitted,user_profile_pic,favourites,retweeted,created_at) VALUES
 ('".$mysqli->real_escape_string($js->text)."','".$mysqli->real_escape_string($js->user->id)."', '".$mysqli->real_escape_string($js->user->screen_name)."',
'".$mysqli->real_escape_string($js->user->profile_image_url)."', '".$mysqli->real_escape_string($js->user->favourites_count)."','".$mysqli->real_escape_string($js->retweeted)."',
 '".$mysqli->real_escape_string(date('Y-m-d H:i:s',strtotime($js->created_at)))."')");

}
}

$latest_tweets=$mysqli->query("SELECT * FROM Tweets  order by created_at desc limit 10");
$tweet_str="";
while($latest_tweets_result=$latest_tweets->fetch_assoc())
{
	
	$tweet_str .="<li><img src='".$latest_tweets_result['user_profile_pic']."'>  ".$latest_tweets_result['tweet_msg']."  ".$latest_tweets_result['user_name_twitted']."  ".$latest_tweets_result['created_at']."</li>";
}
echo $tweet_str;
?>