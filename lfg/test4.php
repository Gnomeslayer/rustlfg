<?php


function connect_to_db()
{
	//include 'config.php';
	$servername = "localhost";
	$dbname = "lfg";
	$charset = "utf8mb4";
	$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";
		$options = [
			PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_EMULATE_PREPARES   => false,
		];
		try {
			 $pdo = new PDO($dsn, "username", "password" , $options);
		} catch (\PDOException $e) {
			 throw new \PDOException($e->getMessage(), (int)$e->getCode());
		}
		
	return $pdo;
		
}




function get_all_players($low, $high)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare('SELECT * FROM combat WHERE id BETWEEN :low AND :high');
	$stmt->execute(['low' => $low, 'high' => $high]);
	
	$players = array();
	while ($row = $stmt->fetch()) 
	{
		$players[] = array(
		'id' => $row['id'], 
		'killer_name' => $row['killer_name'],
		'killer_id' => $row['killer_id'],
		'victim_id' => $row['victim_id'],
		'victim_name' => $row['victim_name']);
	}
	
	return $players;	
}

function update_kills($steamid, $killer_name)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare('SELECT * FROM kills WHERE steamid = :steamid');
	$stmt->execute(['steamid' => $steamid]);
	while($row = $stmt->fetch())
	{
		$kills = $row['kill_counter'];
	}
	
	if(empty($kills))
	{
		$stmt2 = $pdo->prepare('INSERT INTO kills(steamid, killer_name, kill_counter) VALUES (:steamid, :killer_name, :kill_counter)');
		$stmt2->execute(['steamid' => $steamid, 'killer_name' => $killer_name, 'kill_counter' => 1]);
	}else{
		$kills++;
		$stmt2 = $pdo->prepare('UPDATE kills SET kill_counter = :kill WHERE steamid = :steamid');
			$stmt2->execute(['kill' => $kills, 'steamid' => $steamid]);
	}
}

function update_deaths($steamid, $victim_name)
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare('SELECT * FROM deaths WHERE steamid = :steamid');
	$stmt->execute(['steamid' => $steamid]);
	while($row = $stmt->fetch())
	{
		$deaths = $row['death_counter'];
	}
	
	if(empty($deaths))
	{
		$stmt2 = $pdo->prepare('INSERT INTO deaths(steamid, victim_name, death_counter) VALUES (:steamid, :victim_name, :deaths_counter)');
		$stmt2->execute(['steamid' => $steamid, 'victim_name' => $victim_name, 'deaths_counter' => 1]);
	}else{
		$deaths++;
		$stmt2 = $pdo->prepare('UPDATE deaths SET death_counter = :deaths WHERE steamid = :steamid');
			$stmt2->execute(['deaths' => $deaths, 'steamid' => $steamid]);
	}
}
/*
$low = 8001;
$high = 9356;
$players = get_all_players($low, $high);

foreach($players as $p)
{
	update_kills($p['killer_id'], $p['killer_name']);
	update_deaths($p['victim_id'], $p['victim_name']);
}*/

function ratios()
{
	$pdo = connect_to_db();
	$stmt = $pdo->prepare('select * FROM kills');
	$stmt->execute();
	
	$players = array();
	
	while($row = $stmt->fetch())
	{
		$stmt2 = $pdo->prepare('select * from deaths WHERE steamid = :steamid');
		$stmt2->execute(['steamid' => $row['steamid']]);
		
		while($row2 = $stmt2->fetch())
		{
			$players[] = array('name' => $row['killer_name'], 'steamid' => $row['steamid'], 'kill_counter' => $row['kill_counter'], 'death_counter' => $row2['death_counter']);
		}
	}
	return $players;
}

$myplayers = ratios();

foreach($myplayers as $m)
{
	$ratio = $m['kill_counter'] / $m['death_counter'];
	$kill_counter = $m['kill_counter'];
	$death_counter = $m['death_counter'];
	$name = $m['name'];
	
	$ratios = round($ratio, 2);
	echo "<p>$name has gotten $kill_counter kills and $death_counter deaths! that's a ratio of: $ratios/1</p>";
}
