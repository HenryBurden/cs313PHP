<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Skull King</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="skullKing.css">

    <script>
        function goToScoreCard(){
            console.log(document.getElementByID("scorecard_id").value);
            //document.location.href = `skullKingDBPract.php?scorecard_id=${document.getElementByID("scorecard_id").value}`;
        }
    </script>
</head>
<body>
    <div id="scoreCard">
        <h1>SKULLKING</h1>
        <h3>New Score Card</h3>
        <button type="button" id="button" onclick="location.href='newScore.php'">Create</button>

        <h3> OR </h3>
        <h3>
            Existing Score Card #
            <form onSubmit="return goToScoreCard()">
                <input type="number" id="scorecard_id" name="scorecard_id">
                <input type="submit" value="Go">
            </form>
        </h3>
    </div>
</body>
</html>