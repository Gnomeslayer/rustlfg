<?php

define("_SEVERNAME", "localhost");
		define("_DBNAME", "lfg");
		define("_USERNAME", "lfg");
		define("_PASSWORD", "password");
//Breaks the Steam URL down to the part we want.
function BreakURL($myURL)
{
	$explodedURL = explode('/', $myURL);
	$myURL = $explodedURL[4];
	return $myURL;
}

//Connects to the database.
function connect_to_db()
{
	$charset = "utf8mb4";
	$servername = _SEVERNAME;
	$dbname = _DBNAME;
	
	$dsn = "mysql:host="._SEVERNAME.";dbname="._DBNAME.";charset=$charset";
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		try {
			 $pdo = new PDO($dsn, _USERNAME, _PASSWORD , $options);
		} catch (\PDOException $e) {
			 throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
		
	return $pdo;
		
}


//Sanitizes the data to prevent any code injection
	function sanitize_input($data) 
	{
	  $data = trim($data);
	  $data = stripslashes($data);
	  $data = htmlspecialchars($data);
	  return $data;
	}

/* 
These functions detail the various methods involved to get specific information from the permissions table.

	--Section 1 [GET] Functions--
		These functions are the functions that grab information from the database.
	--Section 2 [UPDATE] Functions--
		These functions are the functions that set information into the database.
	--Section 3 [DELETE] Functions--
		These functions are the functions that delete information from the database.
*/

function get_all_players()
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare('SELECT * FROM players ORDER BY id ASC');
	$stmt->execute([]);
	
	$players = array();
	while ($row = $stmt->fetch()) 
	{
		$players[] = array(
		'id' => $row['id'], 
		'steam_id' => $row['steam_id'], 
		'steam_url' => $row['steam_url'], 
		'steam_pic' => $row['steam_pic'], 
		'kills' => $row['kills'], 
		'deaths' => $row['deaths'], 
		'pref_server' => $row['pref_server'], 
		'language' => $row['language'], 
		'bans_perm' => $row['bans_perm'],
		'bans_temp' => $row['bans_temp'],
		'rating' => $row['rating'],
		'total_hours' => $row['total_hours'],
		'average_hours' => $row['average_hours'],
		'description' => $row['description'],
		'skills' => $row['skills'],
		'discord' => $row['discord'],
		'curr_clan' => $row['curr_clan'],
		'likes' => $row['likes'],
		'dislikes' => $row['dislikes']);
	}
	return $players;	
}

function insert_into_players($steamname, $steamid, $profileurl, $prefserver, $preftimezone, $hoursrust, $description, $searchable, $discord)
{
	$pdo = connect_to_db();
	
	$stmt = $pdo->prepare('INSERT INTO players (steamname, steamid, profileurl, prefserver, preftimezone, hoursrust, description, searchable, discord)
    VALUES (:steamname, :steamid, :profileurl, :prefserver, :preftimezone, :hoursrust, :description, :searchable, :discord)');
	
	$stmt->execute(['steamname' => $steamname, 'steamid' => $steamid, 'profileurl' => $profileurl, 'prefserver' => $prefserver, 'preftimezone' => $preftimezone, 'hoursrust' => $hoursrust, 'description' => $description, 'searchable' => $searchable, 'discord' => $discord]);
	
	return "Done";
}

function notifications($id)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare('SELECT * FROM notifications WHERE notification_receiver = :id AND notification_read = :status');
	$stmt->execute(['id' => $id, 'status' => "unread"]);
	
	$unread_count = 0;
	while ($row = $stmt->fetch()) 
	{
		$unread_count++;
	}
	
	return $unread_count;	
}


function latestplayers()
{
	//SELECT * FROM table_name ORDER BY unique_column DESC LIMIT 1
	$pdo = connect_to_db();
	
	$stmt = $pdo->prepare('SELECT * FROM players ORDER BY id DESC LIMIT 5');
	$stmt->execute([]);
	
	$players = array();
	while ($row = $stmt->fetch()) 
	{
		$players[] = array(
		'id' => $row['id'],
		'name' => $row['name'],
		'steam_id' => $row['steam_id'], 
		'steam_url' => $row['steam_url'], 
		'steam_pic' => $row['steam_pic'], 
		'kills' => $row['kills'], 
		'deaths' => $row['deaths'], 
		'pref_server' => $row['pref_server'], 
		'language' => $row['language'], 
		'bans_perm' => $row['bans_perm'],
		'bans_temp' => $row['bans_temp'],
		'rating' => $row['rating'],
		'total_hours' => $row['total_hours'],
		'average_hours' => $row['average_hours'],
		'description' => $row['description'],
		'skills' => $row['skills'],
		'discord' => $row['discord'],
		'curr_clan' => $row['curr_clan'],
		'likes' => $row['likes'],
		'dislikes' => $row['dislikes']);
	}
	return $players;
}

function latestclans()
{
	$returnedarray[] = array(
		'id' => "1", 
		'name' => "Gnomeslayer", 
		'rating' => "1", 
		'kills' => "1", 
		'deaths' => "1");
	return $returnedarray;
}
?>