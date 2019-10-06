<?php
session_start();
if (!isset($_SESSION['numItems'])) {
    $_SESSION['numItems'] = 0;
}

$possibleTowers = array (
    'seoul',
    'lakhta',
    'burj',
    'taipei'
);

$numItems = $_SESSION['numItems'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Shopping Cart</title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="stylesheet" type="text/css" href="shoppingCart.css">
    <script src="https://kit.fontawesome.com/b765e10124.js" crossorigin="anonymous"></script>
</head>

<body>
    <header>
        <h1 class="head">
            <div class="firstLetter">S</div>
            <div class="otherLetters">ky</div>
            <div class="firstLetter">S</div>
            <div class="otherLetters">crapers</div>
            <div class="firstLetter">I</div>
            <div class="otherLetters">nc.</div>
        </h1>
        <ul>
            <li><a href="browseItems.php">Browse Skyscrapers</a></li>
            <li><a href="checkout.php">Checkout</a></li>
            <li class="cart">
                <a href="viewCart.php">
                    <i class="fas fa-shopping-cart"></i>
                    <?php echo $numItems;?>
                </a>
            </li>
        </ul>
    </header>

    <div class="cartContainer">
            <?php 
                foreach($possibleTowers as $tower) {
                    if(isset($_SESSION[$tower])) {
                        echo '<div class="cartItem">' . $tower . $_SESSION[$tower] . '</div>';
                        echo '<img title="' . $tower . '" src="' . $tower . '.jpg">';
                        echo '                    
                            <form method="post">
                                <input class="removeCartButton" type="submit" name="' . $tower . '" value="cancel"><br>
                            </form>
                        ';
                    }
                }    
            ?>
    </div>

</body>

</html>