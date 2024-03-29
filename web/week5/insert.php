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

//Get the POST values
$value = $_POST['value'];
$bet = $_POST['bet'];
$player_name = $_POST['player_name'];

$scorecard_id = $_POST['scorecard_id'];
$round_number = $_POST['round_number'];
$player_id = $_POST['player_id'];

//Check which query to run
$query = '';
if(isset($_POST['value']))//update a score
{
  try
  {
    $query = "UPDATE round SET score = :score WHERE player_id = :player_id AND round_number = :round_number";
    $statement = $db->prepare($query);
    $statement->bindValue(':score', $value);
    $statement->bindValue(':player_id', $player_id);
    $statement->bindValue(':round_number', $round_number);
    $statement->execute();
  }
  catch (Exception $ex)
  {
    echo "Error with DB. Details: $ex";
    die();
  }
}

if(isset($_POST['bet']))//update a bet
{
  try
  {
    $query = "UPDATE round SET bet = :bet WHERE player_id = :player_id AND round_number = :round_number";
    $statement = $db->prepare($query);
    $statement->bindValue(':bet', $bet);
    $statement->bindValue(':player_id', $player_id);
    $statement->bindValue(':round_number', $round_number);
    $statement->execute();
  }
  catch (Exception $ex)
  {
    echo "Error with DB. Details: $ex";
    die();
  }
}

if(isset($_POST['player_name']))//update a name
{
  try
  {
    $query = "UPDATE player SET player_name = :player_name WHERE player_id = :player_id";
    $statement = $db->prepare($query);
    $statement->bindValue(':player_id', $player_id);
    $statement->bindValue(':player_name', $player_name);
    $statement->execute();
  }
  catch (Exception $ex)
  {
    echo "Error with DB. Details: $ex";
    die();
  }
}
echo $query;
die();

?>