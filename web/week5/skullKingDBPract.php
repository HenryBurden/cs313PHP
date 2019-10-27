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

/**
 * Get Data From DB
 */
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

/**
 * Create Scorecard
 */
echo '<div id="scoreCard"><h1>ScoreCard</h1><table><form id="form"><tr>';
for($i = 0; $i < 6; $i++)
{
  echo '<th colspan="2"><input type="text" class="name" id="name'.$i.'" value="'.$players[$i].'"></th>';
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
    echo '<td><input class="bet" id="bet'.$columns.'R'.$rows.'" type="number" value="'.$bets[$columns][$rows].'"></td>';
    echo '<td><input type="number" class="score" id="score'.$columns.'R'.$rows.'" value="'.$scores[$columns][$rows].'"></td>';
  }
  echo '</tr>';
}
echo "</form></table></div>";


/**
 * Update DB
 */

/*
$query = 'INSERT INTO note(course_id, title, content, date, time) VALUES(:course, :title, :content, :date, :time)';
$statement = $db->prepare($query);
$statement->bindValue(':course', $course);
$statement->bindValue(':title', $title);
$statement->bindValue(':content', $note);
$statement->bindValue(':date', '\'now()\'');
$statement->bindValue(':time', $time);
$statement->execute();*/
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Skull King Score Card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="skullKing.css">

    <script>
      function updateDB() {

      }
    </script>
</head>

<body>

</body>
</html>