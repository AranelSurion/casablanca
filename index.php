<?php

$GLOBALS['REQUEST_MICROTIME'] = microtime( TRUE );
function load_time( $buffer ){
return str_replace('{microtime}', round( microtime( TRUE ) - $GLOBALS['REQUEST_MICROTIME'], 4 ), $buffer);}
ob_start( 'load_time' ); 

require "functions.php";
$i = check_login();

if ($i == TRUE){
	echo "<meta HTTP-EQUIV='REFRESH' content='0; dashboard.php'>";
}else{
if (!empty($_POST['login-password'])){
	if (md5($_POST['login-password']) == "yourmd5stringhere"){
		$_SESSION['user'] = "supervisor";
		echo "<meta HTTP-EQUIV='REFRESH' content='0; dashboard.php'>";
		die;

	}else{
		$feedback = "<div class=\"error-box round\">Authentication failed.</div>";
	}

}

$uname = shell_exec("uname -a");
?>



<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="utf-8">
	<title>pi@casablanca | Authentication required</title>
	
	<!-- Stylesheets -->
	<link href='http://fonts.googleapis.com/css?family=Droid+Sans:400,700' rel='stylesheet'>
	<link rel="stylesheet" href="css/style.css">
	<link rel="shortcut icon" href="favicon.ico" />

	<!-- Optimize for mobile devices -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>  
</head>
<body>

	
	<!-- HEADER -->
	<div id="header">
		
		<div class="page-full-width cf">
	


	</div> <!-- end header -->
	
	
	
	<!-- MAIN CONTENT -->
	<div align="center"><img src="raspberry.gif"></div>
	<div align="center"><br><h1>pi@casablanca</h1></div>
	<div id="content">


		<form action="" method="POST" name="login-form" id="login-form">
		
			<fieldset>
				<?php echo $feedback; ?>
				<p>
					<label for="login-password">password</label>
					<input type="password" id="login-password" name="login-password" class="round full-width-input" />
				</p>
				<input type="submit" value="Log in" name="logmein" style="border-bottom: 1px dotted;" class="button round red image-right ic-right-arrow">
				</div>


			</fieldset>

		</form>
		
	</div> <!-- end content -->
	
	
<?php include "footer.php" ?>


</body>
</html>
<?php } ?>
