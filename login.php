<?php include_once 'header.php'; ?>

<div style="float: none; margin: 0 auto;" class="span8">
	<form name="user_login" id="user_login" class="form-horizontal" method="post" action="check_user_login.php">
		<fieldset>
			<legend>Tweet Feeds Login Form</legend>

			<div class="control-group" style="text-align: center;">
				<a class="btn btn-large btn-info" href="javascript:void(0);" id="twitter_login" >Login with twitter</a>
			</div>

			<!-- <div class="control-group">
				<label for="user_id" class="control-label">Login/ User ID :</label>
				<div class="controls">
					<input type="text" placeholder="Login/ User ID" name="user_id" id="user_id" class="input-xlarge required email" />
					<p class="help-block">e.g. user@gmail.com</p>
				</div>
			</div>

			<div class="control-group">
				<label for="user_password" class="control-label">Password :</label>
				<div class="controls">
					<input type="password" placeholder="Password" name="user_password" id="user_password" class="input-xlarge required" />
				</div>
			</div>

			<div class="form-actions">
				<button type="submit" class="btn btn-primary">Login</button>
				<button type="reset" class="btn cancel-btn">Cancel</button>
			</div> -->

		</fieldset>
	</form>
</div>

<script type="text/javascript">
	$(document).ready(function () {
		set_nav_link('login');
		$('#user_login').validate({
			// Tell the validator to only ignore inputs of type 'hidden'
			ignore: 'input[type=hidden]',
			errorClass: 'error',
			// control-group error
			validClass: 'success',
			// control-group success
			errorElement: 'span',
			// class='help-inline
			highlight: function(element, errorClass, validClass) {
				if (element.type === 'radio') {
					this.findByName(element.name).closest('div.control-group').removeClass(validClass).addClass(
					errorClass);
				} else {
					if ($(element).parent('div').parent('div').hasClass('control-group')) {
						$(element).parent('div').parent('div').removeClass(validClass).addClass(
						errorClass);
					} else {
						$(element).parent('div').parent('div').parent('div').removeClass(validClass).addClass(errorClass);
					}
				}
			},
			unhighlight: function(element, errorClass, validClass) {
				if (element.type === 'radio') {
					this.findByName(element.name).closest('div.control-group').removeClass(errorClass).addClass(
					validClass);
				} else {
					if ($(element).parent('div').parent('div').hasClass('control-group')) {
						$(element).parent('div').parent('div').removeClass(errorClass).addClass(
						validClass);
					} else {
						//	alert('in else');
						$(element).parent('div').parent('div').parent('div').removeClass(errorClass).addClass(validClass);
					}
					$(element).next('span.help-inline').text('');
				}
			},
			errorPlacement: function(error, element) {
				var isInputAppend = ($(element).parent('div.input-append').length > 0);
				var isRadio = ($(element).attr('type') === 'radio');
				if (isRadio) {
					afterElement = $(element).closest('div.controls').children('label').filter(':last');
					error.insertAfter(afterElement);
				} else if (isInputAppend) {
					appendElement = $(element).next('span.add-on');
					error.insertAfter(appendElement);
				} else {
					error.insertAfter(element);
				}
			}
		});

		$.validator.addMethod('this_is_optional', function(value, element) {
			return true;
		}, '');

	});
</script>

<script type="text/javascript" src="js/jquery.validate.js"></script>

<?php include_once 'footer.php'; ?>