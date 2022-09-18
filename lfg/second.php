<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
include 'config.php';
include 'includes/steamsession.php';
?>
<link rel="stylesheet" href="css/style.css">
<body>


<?php
echo login_link();
echo logout_link();
	echo "<pre>";
	print_r($_SESSION);
	echo "</pre>";
	
	if(isset($_SESSION['steamid']))
	{
		echo "<h1>LOGGED IN!</h1>";
	}
?>

</body>
</html>
