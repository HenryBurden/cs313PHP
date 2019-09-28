<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Introduction</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="intro.css">
</head>

<body>
    <header>
        <h1 class="head">
            <div class="firstLetter">H</div>
            <div class="otherLetters">enry</div>
            <div class="firstLetter">B</div>
            <div class="otherLetters">urden</div>
        </h1>
        <ul>
            <li><a href="introduction.php">Introduction</a></li>
            <li><a href="assignments.php">Assignments</a></li>
        </ul>
    </header>

    <h2 class="title">About Me: </h2>
    <div>
        <p class="content">
            Hello, my name is Henry, I am currently a Senior at BYU-I 
            in Software Engineering. I have been married for three years.
            My favorite pokemon is Psyduck, the platypus like pokemon.
        </p>
        <img src="psyduck.jpg" alt="Psyduck">
        <p class="content">
            Psyduck is well known for causing confusion as well as being
            confused itself. 
        </p>
    </div>

    <footer>
        <?php echo "@HenryBurden    Server time: " . date("h:i")?>
    </footer>
    

</body>

</html>