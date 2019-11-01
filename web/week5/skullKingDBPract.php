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
$scorecard_id = $_GET['scorecard_id'];
$players[] = "";
$playerIDs[] = "";
$bets = array();
$scores = array();
$playerTotal = array();
$playerCount = 0;

$statement = $db->query("SELECT player_name, player_id FROM player WHERE scorecard_id = $scorecard_id ORDER BY player_id");
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  $players[$playerCount] = $row['player_name'];
  $playerIDs[$playerCount] = $row['player_id'];
  $playerID = $row['player_id'];
  $statement2 = $db->query("SELECT bet, score FROM round WHERE player_id = $playerID ORDER BY round_number");
  $roundCount = 0;
    while ($row2 = $statement2->fetch(PDO::FETCH_ASSOC))
    {
      $bets[$playerCount][$roundCount] = $row2['bet'];
      $scores[$playerCount][$roundCount] = $row2['score'];
      $playerTotal[$playerCount] += $row2['score'];
      $roundCount++;
    }
  $playerCount++;
}

/**
 * Create Scorecard with current DB values
 */
echo '<div id="scoreCard"><h1>Skull King ScoreCard</h1><form id="form"><table><tr><th></th>';
for($i = 0; $i < 6; $i++)
{
  //name inputs
  echo '<th colspan="2"><input type="text" class="name" id="name'.$i.'" value="'.$players[$i].'"';
  echo 'onchange="updateDBName(this.value, '.$playerIDs[$i].')" ></th>';
}
echo '</tr><tr><td></td>';
for($i = 0; $i < 6; $i++)
{
  echo '<td>Bet</td><td>Score</td>';
}
echo '</tr><tr>';
for($rows = 0; $rows < 10; $rows++)
{
  $rowNum = $rows + 1;
  echo '<tr><td>'.$rowNum.'</td>';
  for($columns = 0; $columns < 6; $columns++)
  {
    //bet inputs
    echo '<td><input class="bet" id="bet'.$columns.'R'.$rows.'" type="number" value="'.$bets[$columns][$rows].'"';
    echo 'onchange="updateDBBet(this.value, '.$playerIDs[$columns].', '.$rows.')" ></td>';

    //score inputs
    echo '<td><input type="number" class="score" id="score'.$columns.'R'.$rows.'"value="'.$scores[$columns][$rows].'"';
    echo 'onchange="updateDBScore(this.value, '.$scorecard_id.', '.$playerIDs[$columns].', '.$rows.')" ></td>';
  }
  echo '</tr>';
}

echo "<tr><td>Totals:</td>";//add the totals
for($columns = 1; $columns <= 6; $columns++)
{
  //echo "<td colspan="2">$playerTotal[$columns]</td> ";
}
echo "</tr>";
echo "</table></form><div id='id'>Score Card #$scorecard_id</div></div>";
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Skull King Score Card</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="skullKing.css">

    <script src="//code.jquery.com/jquery-1.12.0.min.js" defer></script>
    <script defer>
      function updateDBScore(value, scorecard_id, player_id, round_number) {
        round_number++;
        $.ajax({
        type: 'POST',
        url: 'insert.php',
        data: { value: value, scorecard_id: scorecard_id, player_id: player_id, round_number: round_number },
        success: function(response) {
            $('#result').html(response);
            console.log(response);
            window.location.reload();
          }
        });
      }

      function updateDBBet(bet, player_id, round_number) {
        round_number++;
        $.ajax({
        type: 'POST',
        url: 'insert.php',
        data: { player_id: player_id, round_number: round_number, bet: bet },
        success: function(response) {
            $('#result').html(response);
            console.log(response);
            window.location.reload();
          }
        });
      }

      function updateDBName(name, player_id) {
        $.ajax({
        type: 'POST',
        url: 'insert.php',
        data: { player_id: player_id, player_name: name },
        success: function(response) {
            $('#result').html(response);
            console.log(response);
            window.location.reload();
          }
        });
      }
    </script>
</head>

<body>

</body>
</html>