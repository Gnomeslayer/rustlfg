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
<style>

    .result p:hover{
        background: green;
    }
</style>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

<script>
$(document).ready(function(){
    $('#registerclan_formelement input[id="serverlist"]').on("keyup input", function(){
        /* Get input value on change */
        var inputVal = $(this).val();
        var resultDropdown = $(this).siblings(".result");
        if(inputVal.length){
            $.get("livesearch.php", {term: inputVal}).done(function(data){
                // Display the returned data in browser
                resultDropdown.html(data);
            });
        } else{
            resultDropdown.empty();
        }
    });
    
    // Set search input value on click of result item
    $(document).on("click", ".result p", function(){
        $(this).parents("#registerclan_formelement").find('input[id="serverlist"]').val($(this).text());
        $(this).parent(".result").empty();
    });
});
</script>



</head>
<body id="registerclan">

<?php 
	include 'includes/navbar.php';
?>

<br />

<?php
if ($_SERVER["REQUEST_METHOD"] == "POST")
{
	$clanleader = $_SESSION['steam_personaname'];
	
	$clanname = $clanserver = $clanlanguage = $clantimezone = $reqhrs = $desc = $requirements = $recruiter = "";
	
	$clanname_err = $clanserver_err = $clanlanguage_err = $clantimezone_err = $desc_err = $requirements_err = $recruiter_err = "";
	
	
	if(isset($_POST['clanname']) && !empty ($_POST['clanname']))
	{
		$clanname = $_POST['clanname'];
	}else{
		$clanname_err = "You need to give your clan a name!";
	}
	
}




?>
<div id="registerclan_container">
<div id="registerform_clan">
	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
		<div id="registerclan_formelement"><h1>Clan owner: <?php echo $_SESSION['steam_personaname']; ?> </h1></div>
			<div id="registerclan_formelement">
					<label for="clanname">Clan Name:</label>
						<input type="text" id="clanname"></input>
			</div>
			<div id="registerclan_formelement">
			 <br><b>Clan details: </b></div><br><br>
			<div id="registerclan_formelement">
					<label for="language">Primary/Preferred language </label>
						<select name="language" id="language">
							  <option value="Language" SELECTED>Language</option>
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
			</div><br><br>
			
			<div id="registerclan_formelement" class="serverlist">
				<input type="text" autocomplete="off" placeholder="Search server..." id="serverlist"/>
				<div class="result"></div>
			</div><br><br>
			
			<div id="registerclan_formelement">
					<label for="region">Clan primary Region/Timezone</label>
						<select name="region" id="region">
						  <option value="Europe">Europe</option>
						  <option value="Asia">Asia</option>
						  <option value="Oceanic">Oceanic</option>
						  <option value="NA">North America</option>
						</select>
			</div><br><br>
			
			<div id="registerclan_formelement">
					<label for="hoursrust">Required hours in rust</label>
						<input type="text"></input>
			</div><br><br>
			<div id="registerclan_formelement">
					<label for="description">What is your clan about</label>
						<textarea id="description"></textarea>
			</div><br><br>
			
			<div id="registerclan_formelement">
					<label for="description">What do you want from recruits?</label>
						<textarea id="description"></textarea>
			</div><br><br>
			
			<div id="registerclan_formelement">
					<label for="discord">Recruiters discord tag(Example: Username#0000 [Case sensitive])</label>
						<input type="text" id="discord"></input>
			</div><br><br>
			
			<input type="submit" value="Register Clan">
		</form>




</div></div>
<br />
</body>
</html>
