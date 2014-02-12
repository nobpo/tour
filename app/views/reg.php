<html>
<head>
	<title>Registartion</title>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>

	<form action="" method="POST" class="control-group">
		<label>registaration</label>
		<?php $messages = $errors->all('<p class="alert alert-error span4" style="clear:both">:message</p>') ?>
		<?php foreach ($messages as $msg) {
			echo $msg;
		} ?>
        <br>
        <div style="clear:both"></div>
		<label>ชื่อ</label>
		<input type="text" name="name_first" id="name_first" value="<?php echo Input::old('name_first') ?>">
		<br>
		<label>นามสกุล</label>
		<input type="text" name="name_last" id="name_last" value="<?php echo Input::old('name_last') ?>">
		<br>
		<label>email</label>
		<input type="text" name="email" id="email" value="<?php echo Input::old('email') ?>">
		<br>
		<label>username</label>
		<input type="text" name="username" id="username" value="<?php echo Input::old('username') ?>">
		<br>
		<label>password</label>
		<input type="password" name="password" id="password">
		<br>
		<label>password confirm</label>
		<input type="password" name="password_confirm" id="password_confirm">
		<br>
		<input type="submit" class="btn btn-primary">

	</form>
</body>
</html>