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
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  $players[$playerCount] = $row['player_name'];
  $playerID = $row['player_id'];
  $statement2 = $db->query("SELECT bet, score FROM round WHERE player_id = $playerID");
  $roundCount = 0;
    while ($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
    {
      $bets[$playerCount][$roundCount] = $row2['bet'];
      $scores[$playerCount][$roundCount] = $row2['score'];
      $roundCount++;
    }
  $playerCount++;
}


echo '<table><h1>ScoreCard</h1>';
for($i = 0; $i < count($players); $i++) 
{
  //echo "<br>$players[$i]";
  echo '<tr><th colspan="2">'.$players[$i].'</th>';
  echo '<tr><td>Bet</td><td>Score</td></tr>';
}

for($i = 0; $i < count($players); $i++) 
{
  for($j = 0; $j < count($bets[$i]); $j++)
  {
    //echo $bets[$i][$j].'<br>';
    echo '<tr><td><input type="text" id="bet" value="'.$bets[$i][$j].'"></td>';
  }

  for($j = 0; $j < count($scores[$i]); $j++)
  {
    //echo $scores[$i][$j].'<br>';
    echo '<td><input type="text" id="score" value="'.$scores[$i][$j].'"></td></tr>';
  }
}
echo '</table>';
?>