<?php
require_once("server/session.php");
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" href="style/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<title>Login Form Using HTML And CSS Only</title>
</head>
<body>
	<div class="container" id="container">
		<div class="form-container log-in-container">
			<form action="account.php" method="POST" name="login">
				<h1>Login</h1>
				<span style="color:red"><?php echo $lerr; ?></span>
				<input type="hidden" name="type" value="login" />
				<input type="text" placeholder="Username" name="username" value="<?php echo $ruser; ?>" />
				<input type="password" placeholder="Password" name="password" />
                <select id="title" name="title" name="title">
					<option value="0" selected>Login Type</option>
					<option value="1">Customer</option>
					<option value="2">Admin</option>
				</select>
				<a href="#">Forgot your password?</a>
				<button>Login</button>
			</form>
		</div>
		<div class="overlay-container">			
        <form action="account.php" method="POST" name="register">
				<h1>Register</h1>
				<span style="color:red"><?php echo $rerr; ?></span>
				<span style="color:green"><?php echo $rsucc; ?></span>
				<input type="hidden" name="type" value="register" />
                <input type="text" placeholder="Enter Fullname" name ="fullname" value="<?php echo $fullname; ?>" />
                <input type="text" placeholder="Enter Phone" name="phone" value="<?php echo $phone; ?>" />                
                <span>Login Credential</span>
                <input type="text" placeholder="Username" name ="username" value="<?php echo $usermame; ?>" />
				<input type="password" placeholder="Password" name="password" />
				<input type="password" placeholder="Password again" name="password2" />
				<button>Register</button>
			</form>
		</div>
	</div>
</body>
</html>