<?php
session_start();
if (!isset($_SESSION['numItems'])) {
    $_SESSION['numItems'] = 0;
}

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

    <form method='post' action='confirmation.php'>
        <br>
        <h2>Enter Address:</h2><br>
        <div class="checkoutForm">
        <textarea rows='20' cols='100' name='address'></textarea>
        <br>
        <button class="removeCartButton">Return to Cart </button>
        <input class="checkoutButton" type='submit' name='submit' value='Confirm Purchase'>
</div>
    </form>
</body>
</html>