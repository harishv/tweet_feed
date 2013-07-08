<?php

class TweetsApi {

	// Default URL for gatehirng Twitter user data.
	public $api_url = 'https://api.twitter.com/1.1/statuses/user_timeline.json';


	// The screen name of the user for whom to return results for.
	// Helpful for disambiguating when a valid screen name is also a user ID.
	// Example Values: noradio
	public $screen_name;


	// Specifies the number of tweets to try and retrieve, up to a maximum of 200.
	// The value of count is best thought of as a limit to the number of tweets to return
	// because suspended or deleted content is removed after the count has been applied.
	// We include retweets in the count, even if include_rts is not supplied.
	// It is recommended you always send include_rts=1 when using this API method.
	public $count = 10;


	// When set to either true, t or 1,the timeline will contain native retweets
	// (if they exist) in addition to the standard stream of tweets.
	// The output format of retweeted tweets is identical to the representation you see in home_timeline.
	// Note: If you're using the trim_user parameter in conjunction with include_rts,
	// the retweets will no longer contain a full user object.
	// Example Values: true
	public $include_rts = 'true';


	// When set to either true, t or 1, each tweet will include a node called "entities,".
	// This node offers a variety of metadata about the tweet in a discreet structure,
	// including: user_mentions, urls, and hashtags.
	// While entities are opt-in on timelines at present, they will be made a default component of output in the future.
	// Example Values: true
	public $include_entities = 'true';


	// This parameter will prevent replies from appearing in the returned timeline.
	// Using exclude_replies with the count parameter will mean you will receive
	// up-to count tweets — this is because the count parameter retrieves that
	// many tweets before filtering out retweets and replies.
	// This parameter is only supported for JSON and XML responses.
	// Example Values: true
	public $exclude_replies = 'false';


	/**
	 * Function to fetch the user tweets.
	 *
	 * @returns a JSON string with the resultant tweets
	 */
	function get_tweets($user_name = 'twitter')
	{
		$this->screen_name = $user_name;

		// Generate Twitter api url to fetch the user specific tweets.
		$url = $this->api_url . '?';
		$url .= 'screen_name=' . $this->screen_name . '&';
		$url .= 'count=' . $this->count . '&';
		$url .= 'include_rts=' . $this->include_rts . '&';
		$url .= 'include_entities=' . $this->include_entities . '&';
		$url .= 'exclude_replies=' . $this->exclude_replies;

		return $this->execute_url($url);
	}


	/**
	 * Execute the authorize URL
	 *
	 * @returns a string which is the result of CURL request
	 */
	function execute_url($url)
	{
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		// Set so curl_exec returns the result instead of outputting it.
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		// Set so curl request fires the url without verifing the server for a valid ssl certificate.
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		// Get the response and close the channel.
		$response = curl_exec($ch);
		curl_close($ch);

		return $response;
	}

}