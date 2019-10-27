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
$scorecard_id = 1;
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
 * Create Scorecard with current DB values
 */
echo '<div id="scoreCard"><h1>ScoreCard</h1><form id="form"><table><tr>';
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

    //score inputs
    echo '<td><input type="number" class="score" id="score'.$columns.'R'.$rows.'"value="'.$scores[$columns][$rows].'"';
    echo 'onchange="updateDBScore(this.value, '.$scorecard_id.', '.$players[$columns].', '.$rows.')" ></td>';
  }
  echo '</tr>';
}
echo "</table></form></div>";


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

    <script defer>
      function updateDBScore(value, scorecard_id, player_name, round_number) {
        console.log("value: " + value);
        console.log("scorecard ID: " + scorecard_id);
        console.log("player name: " + player_name);
        console.log("round_number: " + round_number);
        //console.log($('#form'));
        //$.post("insert.php", $('#form').serialize());
      }

      function updateDBBet(scorecard_id, round_number, player_id, bet) {
        $.post("insert.php")
      }

      function updateDBName(scorecard_id, player_id, name) {
        $.post("insert.php")
      }
    </script>
</head>

<body>

</body>
</html>