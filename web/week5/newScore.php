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

echo 'Loading...';

/**
 * Create new scorecard in DB
 */
try
{
   $query = "INSERT INTO scorecard DEFAULT VALUES RETURNING scorecard_id";//ins. SC & return new id
   $statement = $db->prepare($query);
   $statement->execute();//create new scorecard
   $row = $statement->fetch(PDO::FETCH_ASSOC);//get the returning new id row
   $scorecard_id = $row['scorecard_id'];//parse the row to get the id

   for($i = 1; $i <= 6; $i++)//create all 6 players for the scorecard
   {
        $query = "INSERT INTO player(scorecard_id) VALUES($scorecard_id) RETURNING player_id";//INS P & return new id
        $statement = $db->prepare($query);
        $statement->execute();//create new player
        $row = $statement->fetch(PDO::FETCH_ASSOC);//get the returning new id row
        $player_id = $row['player_id'];//parse the row to get the id

        for($j = 1; $j <= 10; $j++)//create 10 rounds for each player
        {
            $query = "INSERT INTO round(round_number, player_id) VALUES($j, $player_id)";
            $statement = $db->prepare($query);
            $statement->execute();//create new round
        }
   }

   header("Location: skullKingDBPract.php?scorecard_id=$scorecard_id");//go to the new score card

}
catch (Exception $ex)
{
	echo "Error with DB. Details: $ex";
	die();
}
?>