<?php
session_start();

// Check user session and redirect to Login Page if not Logged in.
if(empty($_SESSION['username'])){
	header("Location: login.php");
}

include_once 'header.php';
?>
<link href="css/DT_bootstrap.css" type="text/css" rel="stylesheet">

<script type="text/javascript">
	$('document').ready(function() {
		set_nav_link('index');
		load_tweet();

		$('#refresh').on('click', function (ev) {
			load_tweet();
		});
	});

	function load_tweet() {
		var data = { "user_name": "<?php echo trim($_SESSION['username']);?>"};
		var url = 'tweet_insert.php';
		$.ajax({

			url: url,
			type: 'POST',
			data: data,
			success: function(result) {
				var tweet_obj = jQuery.parseJSON(result);

				if (Object.keys(tweet_obj).length > 0) {
					// Clear the existing records on the view.
					// For this, we need to destroy the dataTable first.
					$('#user_tweets').dataTable().fnDestroy();
					// Now clear the table body.
					$('#tweets').empty();

					var tweet_msg, count = 1;
					// Iterate through the JSON object to fill the records.
					$.each(tweet_obj, function(tweet_num, tweet) {
						tweet_msg = '<tr>';

						tweet_msg += '<td>' + count++ + '</td>';
						tweet_msg += '<td>' + tweet.user_name_twitted + '</td>';
						tweet_msg += '<td><div class="row-fluid"><div class="span2"><img src="' + tweet.user_profile_pic + '" width="100%" /></div><div class="span10">' + tweet.tweet_msg +'</div></div></td>';
						tweet_msg += '<td>' + tweet.favourites + '</td>';
						tweet_msg += '<td>' + tweet.retweeted + '</td>';
						tweet_msg += '<td>' + tweet.created_at + '</td>';

						tweet_msg += '</tr>';

						$('#tweets').append(tweet_msg);
					});

					// Initiate the dataTable using dataTable object.
					$('#user_tweets').dataTable({
						"sDom": "<'row-fluid'<'span6'l><'span4 offset2'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
						"sDefaultContent": "",
					 	"sPaginationType": "bootstrap",
					 	"aLengthMenu": [5, 10],
					 	"iDisplayLength": 5
					});

				} else {
					alert("No tweets found.");
				}

			}
		});
	}
</script>

<div class="row-fluid">
	<div class="span2 pull-right">
		<a href="javascript: void(0);" id="refresh" class="btn btn-info span12">Refresh <i class="icon-twitter"></i></a>
	</div>
</div>
<div class="row-fluid" style="margin-top: 20px;">
	<table id="user_tweets" class="table table-bordered table-hover table-striped">
		<thead>
			<tr>
				<th>#</th>
				<th>Tweeted By</th>
				<th>Tweet Message</th>
				<th>Favourited By</th>
				<th>Retweeted By</th>
				<th>Created At</th>
			</tr>
		</thead>
		<tbody id="tweets"></tbody>
	</table>
</div>

<script type="text/javascript" src="js/jquery.dataTables.js"></script>
<script type="text/javascript" src="js/dt-bootstrap.js"></script>

<?php include_once 'footer.php'; ?>