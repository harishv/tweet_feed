<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
		<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

		<script type="text/javascript"src="js/jquery.min.js"></script>

		<script type="text/javascript">
			$('document').ready(function() {
				load_tweet();

				$('#refresh').click(function() {
					load_tweet();
				});
			});

			function load_tweet() {
				data = {
					"user_name": 'HarishVarada'
				};
				url = "tweet_insert.php"
				$.ajax({

					url: url,
					type: "POST",
					data: data,
					success: function(result) {
						var tweet_obj = jQuery.parseJSON(result);
						console.log(tweet_obj);
						alert(Object.keys(tweet_obj).length);
						$.each(tweet_obj, function(tweet_num, tweet) {
							$("#tweets").append("#" + tweet_num + " : ");
							$.each(tweet, function(key, val) {
								$("#tweets").append(key + ": " + val + "<br>");
							});
							$("#tweets").append("<br><br><br>");
						});
						// $('#tweets').html(result);
					}
				});
			}
		</script>
	</head>
	<body>
		<input type="button" id="refresh" name="refresh" value="refresh"/>
		<ul id="tweets"></ul>
	</body>
</html>