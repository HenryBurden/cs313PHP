<?php

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

$statement = $db->query('SELECT player_name FROM player WHERE scorecard_id = 1');
echo '<h1>ScoreCard</h1>';
$playerCount = 2;
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo $row['player_name'];
  $statement2 = $db->query('SELECT bet, score FROM round WHERE player_id = $playerCount');
    while ($row = $statement2->fetch(PDO::FETCH_ASSOC))
    {
        echo "<br>" . $row['bet'] . "  " . $row[score];
    }
}



?>