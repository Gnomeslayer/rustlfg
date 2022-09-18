<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<?php
include 'config.php';
include 'includes/steamsession.php';
include 'includes/functions.php';
?>
<link rel="stylesheet" href="css/style.css">
<script>
	
	function update()
	{
		var language = document.getElementById('language').value;
		var region = document.getElementById('region').value;
		var server = document.getElementById('server').value;
		location.replace("?region=" + region + "&server=" + server + "&language=" + language + "");
	}
	
	function update2(Searching)
	{
		var searching = Searching;
		var language = document.getElementById('language').value;
		var region = document.getElementById('region').value;
		var server = document.getElementById('server').value;
		location.replace("?region=" + region + "&server=" + server + "&language=" + language + "&query=" + searching + "");
	}
</script>
</head>
<body id="searchplayer">

<?php 
	include 'includes/navbar.php';
?>

<br />
<br />
<br />
<div id="container">
<div id="searchbar-container">
<div id="searchbar">
		<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
			<b>Use this search box to search for a specific clan/group. Or just browse our many options. </b><br>
			<input type="text" id="clansearch" name="clansearch" size="100"  value="<?php 
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				echo $_POST['clansearch'];
			}
			?>">
			
			<input type="submit" value="Search"><br>
			<!-- <input type="checkbox" id="exactmatch" name="exactmatch" value="exactmatch"></input>
			<label for="exactmatch"> Exact Match</label> -->
		</form>
		<br>
		<b>Filters</b><br>
		
		<label for="language">Language:</label>
		<select name="language" id="language">
		<?php 
		if(isset($_GET['language']))
		{
			if(!empty($_GET['language']))
			{
				echo "<option value=\"" . $_GET['language'] . "\">". $_GET['language'] ."</option>";
			}else{
				echo "<option value=\"Language\" SELECTED>Language</option>";
			}
		}else{
			echo "<option value=\"Language\" SELECTED>Language</option>";
		}
		?>
		  <option value="English">English</option>
		  <option value="Afrikaans">Afrikaans</option>
		  <option value="Albanian">Albanian</option>
		  <option value="Amharic">Amharic</option>
		  <option value="Arabic">Arabic</option>
		  <option value="Armenian">Armenian</option>
		  <option value="Azerbaijani">Azerbaijani</option>
		  <option value="Basque">Basque</option>
		  <option value="Belarusian">Belarusian</option>
		  <option value="Bengali">Bengali</option>
		  <option value="Bosnian">Bosnian</option>
		  <option value="Bulgarian">Basque</option>
		  <option value="Catalan">Bulgarian</option>
		  <option value="Cebuano">Cebuano</option>
		  <option value="Chichewa">Chichewa</option>
		  <option value="Chinese">Chinese</option>
		  <option value="Corsican">Corsican</option>
		  <option value="Croatian">Croatian</option>
		  <option value="Czech">Czech</option>
		  <option value="Danish">Danish</option>
		  <option value="Dutch">Dutch</option>
		  <option value="Esperanto">Esperanto</option>
		  <option value="Estonian">Estonian</option>
		  <option value="Filipino">Filipino</option>
		  <option value="Finnish">Finnish</option>
		  <option value="French">French</option>
		  <option value="Frisian">Frisian</option>
		  <option value="Galician">Galician</option>
		  <option value="Georgian">Georgian</option>
		  <option value="German">German</option>
		  <option value="Greek">Greek</option>
		  <option value="Gujarati">Gujarati</option>
		  <option value="Haitian creole">Haitian creole</option>
		  <option value="Hausa">Hausa</option>
		  <option value="Hawaiian">Hawaiian</option>
		  <option value="Hebrew">Hebrew</option>
		  <option value="Hindi">Hindi</option>
		  <option value="Hmong">Hmong</option>
		  <option value="Hungarian">Hungarian</option>
		  <option value="Icelandic">Icelandic</option>
		  <option value="Luxembourgish">Luxembourgish</option>
		  <option value="Macedonian">Macedonian</option>
		  <option value="Malagasy">Malagasy</option>
		  <option value="Malay">Malay</option>
		  <option value="Malayalam">Malayalam</option>
		  <option value="Maltese">Maltese</option>
		  <option value="Maori">Maori</option>
		  <option value="Marathi">Marathi</option>
		  <option value="Mongolian">Mongolian</option>
		  <option value="Myanmar(burmese)">Myanmar(burmese)</option>
		  <option value="Nepali">Nepali</option>
		  <option value="Norwegian">Norwegian</option>
		  <option value="Odia(oriya)">Odia(oriya)</option>
		  <option value="Pashto">Pashto</option>
		  <option value="Persian">Persian</option>
		  <option value="Polish">Polish</option>
		  <option value="Portuguese">Portuguese</option>
		  <option value="Punjabi">Punjabi</option>
		  <option value="Romanian">Romanian</option>
		  <option value="Russian">Russian</option>
		  <option value="Samoan">Samoan</option>
		  <option value="Scots gaelic">Scots gaelic</option>
		  <option value="Serbian">Serbian</option>
		  <option value="Sesotho">Sesotho</option>
		  <option value="Shona">Shona</option>
		  <option value="Sindhi">Sindhi</option>
		  <option value="Sinhala">Sinhala</option>
		  <option value="Slovak">Slovak</option>
		  <option value="Slovenian">Slovenian</option>
		  <option value="Somali">Somali</option>
		  <option value="Spanish">Spanish</option>
		  <option value="Sundanese">Sundanese</option>
		  <option value="Swahili">Swahili</option>
		  <option value="Swedish">Swedish</option>
		  <option value="Tajik">Tajik</option>
		  <option value="Tamil">Tamil</option>
		  <option value="Tatar">Tatar</option>
		  <option value="Telugu">Telugu</option>
		  <option value="Thai">Thai</option>
		  <option value="Turkish">Turkish</option>
		  <option value="Turkmen">Turkmen</option>
		  <option value="Ukrainian">Ukrainian</option>
		  <option value="Urdu">Urdu</option>
		  <option value="Uyghur">Uyghur</option>
		  <option value="Uzbek">Uzbek</option>
		  <option value="Vietnamese">Vietnamese</option>
		  <option value="Welsh">Welsh</option>
		  <option value="Xhosa">Xhosa</option>
		  <option value="Yiddish">Yiddish</option>
		  <option value="Yoruba">Yoruba</option>
		  <option value="Zulu">Zulu</option>
		</select>
		
		<label for="region">Region:</label>
		<select name="region" id="region">
		<?php 
		if(isset($_GET['region']))
		{
			if(!empty($_GET['region']))
			{
				echo "<option value=\"" . $_GET['region'] . "\">". $_GET['region'] ."</option>";
			}else{
				echo "<option value=\"region\" SELECTED>region</option>";
			}
		}else{
			echo "<option value=\"region\" SELECTED>region</option>";
		}
		?>
		  <option value="Europe">Europe</option>
		  <option value="Asia">Asia</option>
		  <option value="Oceanic">Oceanic</option>
		  <option value="NA">North America</option>
		  
		</select>
		
		<label for="server">Server:</label>
		<select name="server" id="server">
		<?php 
		if(isset($_GET['server']))
		{
			if(!empty($_GET['server']))
			{
				echo "<option value=\"" . $_GET['server'] . "\">". $_GET['server'] ."</option>";
			}else{
				echo "<option value=\"server\" SELECTED>server</option>";
			}
		}else{
			echo "<option value=\"server\" SELECTED>server</option>";
		}
		?>
		<?php
			$serverlist = get_all_servers();
			foreach($serverlist as $s)
			{
				echo "<option value=". $s .">" . $s ."</option>";
			}
		?>
		 
		</select>
		<?php
		if(isset($_POST['clansearch']))
			{
				echo "<button onclick=\"update2('".$clansearch."')\">Update search</button> <a href=\"searchclan.php\">Reset filters</a>";
			}else{
					echo "<button onclick=\"update()\">Update search</button> <a href=\"searchclan.php\">Reset filters</a>";
			}
			
		?>
		</div>
	</div> <br>
		<?php
		$searching = "No";
		
			if ($_SERVER["REQUEST_METHOD"] == "POST")
			{
				$clansearch = "";
				
				if(!empty($_POST['clansearch']))
					{
						$clansearch = testinput($_POST['clansearch']);
						$searching = "Yes";
					}
				
				
				
			}
			


	$server = $language = $region = "";
	
	if(isset($_GET['region']))
	{
		$region = $_GET['region'];
	}
	if(isset($_GET['language']))
	{
		$language = $_GET['language'];
	}
	if(isset($_GET['server']))
	{
		$server = $_GET['server'];
	}
	if($searching == "Yes")
	{
		if(isset($_GET['query']))
		{
			$clansearch = $_GET['query'];
			$clansearch = testinput($clansearch);
			$clans = get_specific_clans($clansearch);
		}else{
			$clans = get_specific_clans($clansearch);
		}
	}else{
		if(isset($_GET['query']))
		{
			$clansearch = $_GET['query'];
			$clansearch = testinput($clansearch);
			$clans = get_specific_clans($clansearch);
		}else{
			$players = get_all_players();
		}
		
	}
		foreach($players as $p)
		{
			if(isset($_GET['region']) OR isset($_GET['language']) OR isset($_GET['server']))
			{
				if($c['region'] == $_GET['region'] OR $c['server'] == $_GET['server'] OR $c['language'] == $_GET['language'])
				{
					echo "<div class=\"bubble\">";
					echo "<div id=\"textonbubble\">";
							echo "<h1>" . $c['name'] . "</h1>";
							echo "Members: 12 <br>";
							echo "Region: " . $c['region'] . "<br>Primary Server: ". $c['server'] . "<br>Primary Language: ". $c['language'];
							echo "<br><a href=\"viewclan.php?clanid=". $c['id'] . "\">View Clan profile</a>";
					echo "</div></div>";
				}
			}else{
				echo "<div class=\"bubble\">";
					echo "<div id=\"textonbubble\">";
							echo "<h1><a href=\"". $p['profileurl'] . "\" target=\"_BLANK\">" . $p['steamname'] . "</a></h1>";
							echo "Hours in rust: " . $p['hoursrust'] . "<br>";
							echo "Timezone: " . $p['preftimezone'] . "<br>Preferred Server: ". $p['prefserver'];
							echo "<br><a href=\"viewplayer.php?playerid=". $p['id'] . "\">View player profile</a>";
					echo "</div></div>";
			}
		}
	?>
</div>
</body>
</html>
