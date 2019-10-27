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
echo '<tr>';
for($i = 0; $i < count($players); $i++) 
{
  //echo "<br>$players[$i]";
  echo '<th colspan="2">'.$players[$i].'</th>';
}
echo '</tr>';
echo '<tr><td>Bet</td><td>Score</td></tr>';
for($i = 0; $i < count($players); $i++) 
{
  echo '<tr>';
  for($j = 0; $j < count($bets[$i]); $j++)
  {
    //echo $bets[$i][$j].'<br>';
    echo '<td><input type="text" id="bet" value="'.$bets[$i][$j].'"></td>';
  }

  for($j = 0; $j < count($scores[$i]); $j++)
  {
    //echo $scores[$i][$j].'<br>';
    echo '<td><input type="text" id="score" value="'.$scores[$i][$j].'"></td>';
  }
  echo '</tr>';
}
echo '</table>';


echo '<table><tr>';
for($i = 0; $i < 6; $i++)
{
  echo '<th colspan="2"><input type="text" value="Name"></th>';
}
echo '</tr><tr>';
for($i = 0; $i < 6; $i++)
{
  echo '<td>Bet</td><td>Score</td>';
}
echo '</tr><tr>';
for($rows = 0; $rows < 10; $rows++)
{
  echo '<tr>';
  for($columns = 0; $columns < 6; $columns++)
  {
    echo '<td><input id="bet" type="number" value="0"></td><td><input type="number" id="score" value="0"></td>';
  }
  echo '</tr>';
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Skull King Score Card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="skullKing.css">
</head>

<body>

</body>
</html>