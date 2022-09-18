<?php
	session_start();
	session_unset();
	session_destroy();
	
?>
<h1>
Successfully logged out. <br>
<a href="index.php">Click here to return to homepage</a></h1>