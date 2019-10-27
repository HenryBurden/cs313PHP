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

$statement = $db->query('SELECT book, chapter, verse, content FROM scripture');
echo '<h1>Scripture Resources</h1>';
while ($row = $statement->fetch(PDO::FETCH_ASSOC))
{
  echo '<b>' . $row['book'] . ' ' . $row['chapter'] . ':' . $row['verse'] . '</b> - "' . $row['content'] .'"<br/>';
}

?>

<!DOCTYPE html>
<html lang="en">

<head></head>
<body>
<form action="bobTheQueryBuilder()" method="get"><br>
  Book:    <input type="text"  id="book"><br>
  Chapter: <input type="text"  id="chapter"><br>
  Verse:   <input type="text"  id="verse"><br>
  Content: <br><textarea rows="10" cols="50" id="content"></textarea><br>
  <input type="submit">
</form>

<script>
  function bobTheQueryBuilder() {
    var book = document.getElementById('book').value;
    var chapter = document.getElementById('chapter').value;
    var verse = document.getElementById('verse').value;
    var content = document.getElementById('content').value;

    var query=`write.php?book=${book}&chapter=${chapter}&verse=${verse}&content=${content}`;
    
    var xhr = new XMLHttpRequest();

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {}
    }
    xhr.open("POST", query, false);
    xhr.send();
  }
</script>

</body>
</html>