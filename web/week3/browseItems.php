<?php
session_start();

if (!isset($_SESSION['numItems'])) {
    $_SESSION['numItems'] = 0;
}

if (array_key_exists('seoul', $_POST)) {
    if (!isset($_SESSION['seoul'])) {
        $_SESSION['seoul'] = "$385,000,000";
        $_SESSION['numItems'] += 1;
    }
}
elseif (array_key_exists('lakhta', $_POST)) {
    if (!isset($_SESSION['lakhta'])) {
        $_SESSION['lakhta'] = "$425,000,000";
        $_SESSION['numItems'] += 1;
    }
}
elseif (array_key_exists('burj', $_POST)) {
    if (!isset($_SESSION['burj'])) {
        $_SESSION['burj'] = "$1,000,000,000";
        $_SESSION['numItems'] += 1;
    }
}
elseif (array_key_exists('taipei', $_POST)) {
    if (!isset($_SESSION['taipei'])) {
        $_SESSION['taipei'] = "$2,000,000,000";
        $_SESSION['numItems'] += 1;
    }
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

    <section>
        <div class=”media”>
            <div class="item">
                <img title="Seoul Lotte World Tower" src="seoul.jpg" alt="Seoul Lotte World Tower">
                <div class="description">
                    <p> Seoul Lotte World Tower <br> $385,000,000 </p>
                    <form method="post">
                        <input class="addCartButton" type="submit" name="seoul" value="Add to Cart"><br>
                    </form>
                </div>
            </div>

            <div class="item">
                <img title="Lakhta Center" src="lakhta.jpg" alt="Lakhta Center">
                <div class="description">
                    <p> Lakhta Center <br> $425,000,000 </p>
                    <form method="post">
                        <input class="addCartButton" type="submit" name="lakhta" value="Add to Cart"><br>
                    </form>
                </div>
            </div>

            <div class="item">
                <img title="Burj Khalifa" src="burj.jpg" alt="Burj Khalifa">
                <div class="description">
                    <p> Burj Khalifa <br> $1,000,000,000 </p>
                    <form method="post">
                        <input class="addCartButton" type="submit" name="burj" value="Add to Cart"><br>
                    </form>
                </div>
            </div>

            <div class="item">
                <img title="Taipei 101" src="taipei.jpg" alt="Taipei101">
                <div class="description">
                    <p> Taipei 101 <br> $2,000,000,000 </p>
                    <form method="post">
                        <input class="addCartButton" type="submit" name="taipei" value="Add to Cart"><br>
                    </form>
                </div>
            </div>
        </div>
    </section>

</body>

</html>