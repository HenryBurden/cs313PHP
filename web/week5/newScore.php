<?php
/**
 * Connect to DB
 */
try
{
  $dbUrl = getenv('DATABASE_URL');

  $dbOpts = parse_url($dbUrl);

  $dbHost = $dbOpts["host"];
  $dbPort = $dbOpts["port"];
  $dbUser = $dbOpts["user"];
  $dbPassword = $dbOpts["pass"];
  $dbName = ltrim($dbOpts["path"],'/');

  $db = new PDO("pgsql:host=$dbHost;port=$dbPort;dbname=$dbName", $dbUser, $dbPassword);

  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch (PDOException $ex)
{
  echo 'Error!: ' . $ex->getMessage();
  die();
}


//INSERT INTO scorecard DEFAULT VALUES; ONCE

//INSERT INTO player DEFAULT VALUES; SIX TIMES
//INSERT INTO round(round_number, player_id) VALUES($round_number, $player_id); 10 TIMES FOR EACH PLAYER


try
{
   $query = "INSERT INTO scorecard DEFAULT VALUES RETURNING scorecard_id";
   $statement = $db->prepare($query);
   $id = $statement->execute();
   echo "id: $id['scorecard_id'] <br> query: $query";
}
catch (Exception $ex)
{
	echo "Error with DB. Details: $ex";
	die();
}




?>