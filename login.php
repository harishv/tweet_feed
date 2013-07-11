<?php
include_once 'config.php';
include_once 'header.php';
?>

<div style="float: none; margin: 0 auto;" class="span8">
	<form name="user_login" id="user_login" class="form-horizontal" method="post" action="check_user_login.php">
		<fieldset>
			<legend>Tweet Feeds Login Form</legend>

			<div class="control-group" style="text-align: center;">
				<a class="btn btn-large btn-info" href="javascript: void(0);" id="twitter_login">Login with <i class="icon-twitter icon-2x" style="vertical-align: middle;"></i></a>
			</div>

		</fieldset>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function() {
		set_nav_link('login');

		$('document').ready(function() {
			$('#twitter_login').click(function() {
				login_twitter();
			});
		});
	});

	function login_twitter() {
		data = {
			"user_name": 'HarishVarada'
		};
		url = "twitter_login.php";

		$.ajax({
			url: url,
			type: "POST",
			data: data,
			dataType: 'json',
			success: function(response) {
				if (response.status == "new") {
					window.location.href = response.url_is;
				} else if (response.status == "success") {
					window.location.href = "<?php echo BASE_URL; ?>";
				} else {
					window.location.href = "<?php echo BASE_URL; ?>/login.php";
				}
			}
		});
	}
</script>

<?php include_once 'footer.php'; ?>