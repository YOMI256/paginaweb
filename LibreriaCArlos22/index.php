<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>

	<?php
		error_reporting(0);
		session_start();

		$correo = $_SESSION['correo'];

		if(isset($_SESSION['correo'])){

		
	?>
</head>
<body>

</body>
</html>

<?php
	}else {
		header("location: login.php");
	}	
?>