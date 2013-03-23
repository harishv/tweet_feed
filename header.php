<!DOCTYPE html>
<html>
	<head>
		<title>Tweet Feeds</title>
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
						<li id="contactus_nav"><a href="http://www.google.com/" target="_blank">Contact Us</a></li>
					</ul>

					<?php // Added this ul for floating the Logout nav?>
					<ul class="nav main_nav pull-right">
					<?php
					// Check user session here
					/*
					if ( $this->user_status->is_signed_in() ) {
						$user_info = $this->session->userdata('user');
						$user_name = $user_info['first_name'].".".$user_info['last_name'];

						// $profile_string = '<div class="user_profile_nav"><b><i class="icon-user"></i> '.$user_info['email'].'</b><br />'.$this->lang->line("nav_txt_view_my_profile").'</div>';
						// $change_pass_string = '<i class="icon-lock"></i> '.$this->lang->line("nav_txt_change_pass");
						$logout_string = '<i class="icon-off"></i> '.$this->lang->line("nav_signout");
						?>
						<li class="dropdown"><?php echo anchor("", $user_name." <b class='caret'></b>", array ("class" => "dropdown-toggle", "data-toggle" => "dropdown"));?>
							<ul class="dropdown-menu">
								<!-- <li><?php echo anchor("", $profile_string); ?></li>
								<li class="divider"></li>
								<li><?php echo anchor("", $change_pass_string); ?>
								</li>
								<li class="divider"></li> -->
								<li><?php echo anchor("logout", $logout_string); ?>
								</li>
							</ul></li>
							<?php
					} else { */?>
						<li id="login_nav"><a href="login.php"><i class="icon-lock"></i> Sign In</a></li>
					<?php // } ?>
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