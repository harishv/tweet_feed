<?php include_once 'header.php'; ?>
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
		var data = {
			"user_name": 'HarishVarada'
		};
		var url = 'tweet_insert.php';
		$.ajax({

			url: url,
			type: "POST",
			data: data,
			success: function(result) {
				var tweet_obj = jQuery.parseJSON(result);
				// console.log(tweet_obj);
				if (Object.keys(tweet_obj).length > 0) {
					$('#tweets').html('');
					$.each(tweet_obj, function(tweet_num, tweet) {
						$('#tweets').append('<tr>');

						$('#tweets').append('<td>' + tweet.id + '</td>');
						$('#tweets').append('<td>' + tweet.user_name_twitted + '</td>');
						$('#tweets').append('<td><div class="row-fluid"><div class="span1"><img src="' + tweet.user_profile_pic + '" width="100%" /></div><div class="span11">' + tweet.tweet_msg +'</div></div></td>');
						$('#tweets').append('<td>' + tweet.favourites + '</td>');
						$('#tweets').append('<td>' + tweet.retweeted + '</td>');
						$('#tweets').append('<td>' + tweet.created_at + '</td>');

						$('#tweets').append('</tr>');
					});

					// $('#user_tweets').dataTable().fnDestroy();

					// $('#user_tweets').dataTable({
					// 	"sDom": "<'row-fluid'<'span6'l><'span4 offset2'f>r>t<'row-fluid'<'span6'i><'span6'p>>",
					// 	"sPaginationType": "bootstrap",
					// 	"aLengthMenu": [5, 10],
					// 	"iDisplayLength": 5
					// });
				} else {
					alert("No tweets found.");
				}

			}
		});
	}
</script>

<div class="row-fluid">
	<div class="span2 pull-right">
		<a href="javascript:void(0)" id="refresh" class="btn btn-info span12">Refresh <i class="icon-twitter"></i></a>
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