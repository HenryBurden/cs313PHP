<?php
session_start();

$_SESSION['numItems'] = 0;
$numItems = $_SESSION['numItems'];

$possibleTowers = array (
    'seoul' => 'Seoul Lotte World Tower',
    'lakhta' => 'Lakhta Center',
    'burj' => 'Burj Khalifa',
    'taipei' => 'Taipei101'
);

$address = $_POST['address'];
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

    <h2> Purchase successful </h2><br>
    <div class="cartContainer">
            <?php 
                foreach($possibleTowers as $key => $tower) {
                    if(isset($_SESSION[$key])) {
                        echo '<div class="cartItem"></div>';
                        echo '<img class="cartItem" title="' . $tower . '" src="' . $key . '.jpg">';
                        echo '<div class="cartItem">' . $tower . '</div>';
                        echo '<div class="cartItem price">' . $_SESSION[$key] . '</div>';
                        echo '<div class="cartItem"></div>';
                        echo '<div class="cartItem"></div>';
                    }
                }    
            ?>
    </div>
    <?php echo "<h2>Your Skyscraper(s) will be delivered via USPS within 3 business days. Address: " . $address; ?>
    <?php session_destroy();?>

</body>
</html>