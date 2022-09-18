<?php

	include 'config.php';
	
	function connect_to_db()
	{
		//include 'config.php';
		$servername = servername;
		$dbname = dbname;
		$charset = charset;
		$dsn = "mysql:host=$servername;dbname=$dbname;charset=$charset";
			$options = [
				PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_EMULATE_PREPARES   => false,
			];
			try {
				 $pdo = new PDO($dsn, username, password, $options);
			} catch (\PDOException $e) {
				 throw new \PDOException($e->getMessage(), (int)$e->getCode());
			}
			
		return $pdo;
			
	}


	function insert_into_serverlist($servername, $ip, $bmid)
	{
		$pdo = connect_to_db();
		
		$stmt = $pdo->prepare('INSERT INTO serverlist (servername, ip, bmid)
		VALUES (:servername, :ip, :bmid)');
		
		$stmt->execute(['servername' => $servername, 'ip' => $ip, 'bmid' => $bmid,]);
		
		return "Done";
	}

	function get_all_from_serverlist()
	{
		$pdo = connect_to_db();
		$stmt = $pdo->prepare('SELECT * FROM serverlist ORDER BY id DESC');
		$stmt->execute();
		$serverlist = array();
		
		while ($row = $stmt->fetch()) 
		{
			$serverlist[] = array(
			'id' => $row['id'], 
			'servername' => $row['servername'], 
			'ip' => $row['ip'], 
			'bmid' => $row['bmid']
			);
		}
		
		return $serverlist;	
	}
		
		
	function serverlist()
	{
		///include 'includes/config.php';
		
		
		$curl = curl_init();

		curl_setopt_array($curl, array(
		  CURLOPT_RETURNTRANSFER => 1,
		  CURLOPT_URL => "https://api.battlemetrics.com/servers?filter[game]=rust&page[size]=100",
		  ),
		);

		$resp = curl_exec($curl);
		curl_close($curl);
	
		$nothing = "";
		
		$response = json_decode($resp,true);
		
		return $response;
	}
	
	function serverlist2($theurl)
	{
		///include 'includes/config.php';
		
		
		$curl = curl_init();
		
		curl_setopt_array($curl, array(
		  CURLOPT_RETURNTRANSFER => 1,
		  CURLOPT_URL => $theurl,
		  ),
		);

		$resp = curl_exec($curl);
		curl_close($curl);
	
		$nothing = "";
		
		$response = json_decode($resp,true);
		
		return $response;
	}
	
	$myurl = "";
	if(isset($_GET['url']))
	{
		$key = $_GET['page']['key'];
		$myurl = "https://api.battlemetrics.com/servers?filter[game]=rust&page[key]=".$key . "&page[rel]=next&page[size]=100";
		$response = serverlist2($myurl);
	}else{
		$response = serverlist();
	}
	$next = "<a href=\"test.php?url=" . $response['links']['next'] . "\">Next page!</a>";
	
	echo "<h1>" . $next . "</h1>";
	
	$serverlist = array();
	
	foreach($response['data'] as $r)
	{
		array_push($serverlist, $r['attributes']['name']);
		
		$serverip = $r['attributes']['ip'] . ":" . $r['attributes']['port'];
		$bmid = $r['attributes']['id'];
		insert_into_serverlist($r['attributes']['name'], $serverip, $bmid);
	}
	$myservers = get_all_from_serverlist();
	
	foreach($myservers as $m)
	{
		echo "[ID][".$m['id']."]<b>Server name: </b>" . $m['servername'] . " <br> <b>(IP: " . $m['ip'] . ")</b> <a href=\"https://www.battlemetrics.com/servers/rust/" . $m['bmid'] . "\" target=\"_BLANK\">Profile</a>";
		echo "<br><br>";
	}
?>