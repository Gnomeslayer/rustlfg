<?php

$token = "..";
function testfunct($day, $month)
    {
        $token = "..";
        $serverid = "11051676";
         
        $curl = curl_init();
		$time_start = "2021-04-19T14%3A00%3A00.000Z%3A2021-04-20T14%3A00%3A00.000Z";
		
		if($day < 10)
		{
			$day = "0$day";
		}else{
			$day = "$day";
		}
		if($month < 10)
		{
			$month = "0$month";
		}else{
			$month = "$month";
		}
		
		$time_start2 = "2021-".$month."-".$day."T00:00:00.000Z:2021-".$month."-".$day."T23:59:59.000Z";
		
		
		
		
        curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => "https://api.battlemetrics.com/activity?filter[servers]=$serverid&filter[timestamp]=$time_start2&page[size]=1000",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
          )),
        );

        $resp = curl_exec($curl);
        curl_close($curl);
    
        $nothing = "";
        
        $response = json_decode($resp,true);
       return $response;
    }
	
function testfunct2($key, $day, $month)
    {
        $token = "..";
        $serverid = "11051676";
         
        $curl = curl_init();
		$time_start = "2021-04-19T14%3A00%3A00.000Z%3A2021-04-20T14%3A00%3A00.000Z";
		
		
		if($day < 10)
		{
			$day = "0$day";
		}
		if($month < 10)
		{
			$month = "0" . $month;
		}
		$time_start2 = "2021-".$month."-".$day."T00:00:00.000Z:2021-".$month."-".$day."T23:59:59.000Z";
		
		
		
		
        curl_setopt_array($curl, array(
          CURLOPT_RETURNTRANSFER => 1,
          CURLOPT_URL => "https://api.battlemetrics.com/activity?filter[servers]=$serverid&filter[timestamp]=$time_start2&page[size]=1000&page[key]=$key&page[rel]=next",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
          )),
        );

        $resp = curl_exec($curl);
        curl_close($curl);
    
        $nothing = "";
        
        $response = json_decode($resp,true);
       return $response;
    }

/*
echo "<pre>";
print_r(testfunct());
echo "</pre>";*/


if(isset($_GET['page']))
{
	$day = $_GET['day'];
	$month = $_GET['month'];
	$nextlink2 = $_GET['page']['key'];
	$mydatastuff = testfunct2($nextlink2, $day, $month);
}else{
	$day = $_GET['day'];
	$month = $_GET['month'];
	$mydatastuff = testfunct($day, $month);
}

if(empty($mydatastuff['links']['next']))
{
	$continue = false;
	echo "<h1>Jobs done!</h1>";
	$day = $_GET['day'];
	$month = $_GET['month'];
	
	if($month == 1)
	{
		if($day == 31)
		{
			$month++;
			$day = 1;
		}else{
			$day++;
		}
	}else if($month == 2)
	{
		if($day == 28)
		{
			$month++;
			$day = 1;
		}else{
			$day++;
		}
	}else if($month == 3)
	{
		if($day == 31)
		{
			$day = 1;
			$month++;
		}else{
			$day++;
		}
	}else if($month == 4)
	{
		if($day == 30)
		{
			$continue = false;
		}else{
			$day++;
		}
	}
	
	if($continue)
	{
		//redirect
	}

	
}else{
$nextlink = $mydatastuff['links']['next'];
$month = $_GET['month'];
$day = $_GET['day'];
echo $nextlink . " || " . $day . " || " . $month;
echo "<h1><a href=\"?day=$day&month=$month&url=$nextlink\">Next page!</a></h1>";
}


foreach($mydatastuff['data'] as $m)
{
	if($m['attributes']['messageType'] == "rustLog:playerDeath:PVP")
	{
		$date = $m['attributes']['timestamp'];
		$killer_name = $m['attributes']['data']['killerName'];
		$killer_id = $m['attributes']['data']['killerSteamID'];
		$victim_name = $m['attributes']['data']['playerName'];
		$victim_id = $m['attributes']['data']['steamID'];
		$server = "West";
		
		insert_into_combat($server, $killer_name, $killer_id, $victim_name, $victim_id, $date);
	}
}

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

function insert_into_combat($server, $killer_name, $killer_id, $victim_name, $victim_id, $date)
{
	$pdo = connect_to_db();
	
	$stmt = $pdo->prepare('INSERT INTO combat (server, killer_name, killer_id, victim_name, victim_id, date)
    VALUES (:server, :killer_name, :killer_id, :victim_name, :victim_id, :date)');
	
	$stmt->execute(['server' => $server, 'killer_name' => $killer_name, 'killer_id' => $killer_id, 'victim_name' => $victim_name, 'victim_id' => $victim_id, 'date' => $date]);
}
