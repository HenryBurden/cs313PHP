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

$statement = $db->query('SELECT player_name, player_id FROM player WHERE scorecard_id = 1');
echo '<h1>ScoreCard</h1>';
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo $row['player_name'];
  $playerID = $row['player_id'];
  $statement2 = $db->query("SELECT bet, score FROM round WHERE player_id = $playerID");
    while ($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
    {
        echo "<br>" . $row2['bet'] . "  " . $row2['score'];
    }
    echo '<br>';
}




?>