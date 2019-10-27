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

$value = $_POST['value'];
$scorecard_id = $_POST['scorecard_id'];
$round_number = $_POST['round_number'];
$player_id = $_POST['player_id'];


try
{
    //INSERT INTO round(bet, score, round_number, player_id) VALUES(4, 10, 1, 2);
   $query = 'UPDATE round SET score = :score WHERE player_id = :player_id AND round_number = :round_number';
   //(course_id, title, content, date, time) VALUES(:course, :title, :content, :date, :time)';
   $statement = $db->prepare($query);
   $statement->bindValue(':score', $value);
   $statement->bindValue(':player_id', $player_id);
   $statement->bindValue(':round_number', $round_number);
   $statement->execute();

	// Now we bind the values to the placeholders. This does some nice things
	// including sanitizing the input with regard to sql commands.
}
header("Location: skullKindDBPract.php");
die();

//echo "Value: $value, card ID: $scorecard_id, Round Number: $round_number, player_id: $player_id";
?>