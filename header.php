<!DOCTYPE html>
<html>
	<head>
		<title><?php echo (!empty($_SESSION['username'])) ? $_SESSION['username'] . ' - ' : ''; ?>Tweet Feeds</title>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1.0" />

		<!-- <link rel="shortcut icon" type="image/x-icon" href="favicon.ico" /> -->

		<link href="css/bootstrap.css" type="text/css" rel="stylesheet">
		<link href="css/bootstrap-responsive.css" type="text/css" rel="stylesheet">
		<link href="css/font-awesome.css" type="text/css" rel="stylesheet">
		<link href="css/docs.css" type="text/css" rel="stylesheet">

		<script type="text/javascript" src="js/jquery.min.js"></script>
	</head>

	<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container">
			<?php //We add the companies brand name here?>
				<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</a>

				<a class="brand" href="index.php">Tweet Feeds</a>

				<div class="nav-collapse">
				<?php //We add the Top Navigation links here?>
					<ul class="nav main_nav">
						<li id="index_nav"><a href="index.php">Home</a></li>
						<li id="contactus_nav"><a href="http://www.harishvarada.com/" target="_blank">Contact Us</a></li>
					</ul>

					<?php // Added this ul for floating the Logout nav?>
					<ul class="nav main_nav pull-right">
						<?php
						// Check user session here
						if(empty($_SESSION['username'])){ ?>
							<li id="login_nav"><a href="login.php"><i class="icon-lock"></i> Sign In</a></li>
						<?php } else {
							$user_name = $_SESSION['username'];
							$logout_string = '<i class="icon-off"></i> Logout'; ?>
							<li class="dropdown">
								<a class="dropdown-toggle" href="" data-toggle="dropdown"><?php echo $user_name." <b class='caret'></b>"; ?></a>
								<ul class="dropdown-menu">
									<li><a href="logout.php"><?php echo $logout_string; ?></a></li>
								</ul>
							</li>
						<?php } ?>
					</ul>
				</div>

				<script type="text/javascript">
					function set_nav_link (nav_id) {
						var current_path, url = window.location.pathname;

						if (nav_id == 'index'){
							current_path = 'index';
						} else if (nav_id == 'contactus'){
							current_path = 'contactus';
						} else if (nav_id == 'login'){
							current_path = 'login';
						} else {
							current_path = 'index';
						}

						$('.main_nav').find('li').each(function () {
							$(this).removeClass('active');
						});

						$('#' + current_path + "_nav").addClass('active');
					}
				</script>
			</div>

		</div>
	</div>

	<!-- Start of Main-Container -->
	<div class="container">
		<div class="main-data">