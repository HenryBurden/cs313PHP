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

$players[] = "";
$bets = array();
$scores = array();
$playerCount = 0;

$statement = $db->query('SELECT player_name, player_id FROM player WHERE scorecard_id = 1');
echo '<table><h1>ScoreCard</h1>';
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  $players[$playerCount] = $row['player_name'];
  echo '<tr><th colspan="2">'.$row['player_name'].'</th>';
  echo '<tr><td>Bet</td><td>Score</td></tr>';
  $playerID = $row['player_id'];
  $statement2 = $db->query("SELECT bet, score FROM round WHERE player_id = $playerID");
  $roundCount = 0;
    while ($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
    {
      $bets[$playerCount][$roundCount] = $rwo2['bet'];
      $scores[$playerCount][$roundCount] = $rwo2['score'];
      $roundCount++;
        echo '<tr><td><input type="text" id="bet" value="'.$row2['bet'].'"></td><td><input type="text" id="score" value="'.$row2['score'].'"></td></tr>';
    }
  $playerCount++;
}
echo '</table>';

for($i = 0; $i < count($players); $i++) 
{
  echo "<br>$players[$i]";
  echo count($bets[$i]);
  for($j = 0; $j < count($bets[$i]); $j++)
  {
    echo $j;
    echo "$bets[$i][$j]";
  }
  for($j = 0; $j < count($scores[$i]); $j++)
  {
    echo $j;
    echo "$scores[$i][$j]";
  }
}

?>