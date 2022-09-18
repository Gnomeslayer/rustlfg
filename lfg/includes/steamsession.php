<?php
				//Steam session
				require 'includes/SteamAuthentication-master/steamauth/steamauth.php';

				if(isset($_SESSION['steamid']))
				{
					require 'includes/SteamAuthentication-master/steamauth/userInfo.php';
				}
				
?>