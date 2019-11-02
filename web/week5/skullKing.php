<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Skull King</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="skullKing.css">

    <script defer>
        function goToScoreCard(){
            document.location.href = `skullKingDBPract.php?scorecard_id=${document.getElementById("scorecard_id").value}`;
        }
    </script>

</head>
<body>
    <div id="scoreCard">
        <h1>SKULLKING</h1>
        <h2>New Score Card</h2>
        <button type="button" id="button" onclick="location.href='newScore.php'">Create</button>

        <h3> OR </h3>
        <h2>
            Existing Score Card #
            <form>
                <input type="number" id="scorecard_id" name="scorecard_id">
                <input type="button" value="Go" onclick="goToScoreCard()">
            </form>
        </h2>
    </div>
</body>
</html>