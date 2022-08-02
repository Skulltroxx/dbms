<?php
session_start();
$username = $_SESSION['user'];
$conn = mysqli_connect('localhost', 'root', '', 'croma') or die("Connection Failed" . mysqli_connect_error());
$query = mysqli_query($conn, "SELECT userID FROM customer WHERE userName = '$username'");
$user = mysqli_fetch_array($query);

$query1 = mysqli_query($conn, "SELECT productID, pName, cat_name, price FROM product NATURAL JOIN orderline NATURAL JOIN customerorder NATURAL JOIN customer WHERE userID = " . $user['userID']);
$finalcost = 0;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/cart.css">
    <title>CART ITEMS</title>
</head>

<body>
    <h1>Viewing Your Cart</h1>
    <?php
    $i = 1;
    while ($row = mysqli_fetch_assoc($query1)) {
        $var = "val" . (string)$i;
        $_SESSION[$var] = $row['productID'];
        echo "<pre>" . $row['pName'] . "\t" . $row['cat_name'] . "\t" . $row['price'] . "</pre>";
        $finalcost += (int)$row['price'];
        $i++;
    }
    $_SESSION['total'] = $i;
    ?>
    Final Cost = <?php echo $finalcost ?> <br>
    <h2>Choose payment option:</h2>
    <form method="POST">
        <input type="radio" name="payment_type" value="upi">UPI
        <input type="radio" name="payment_type" value="cod">COD
        <input type="radio" name="payment_type" value="card">CARD <br>
        <input type="submit" value="Submit" name="submit">
    </form>
    <?php
    if (isset($_POST['submit'])) {
        $radioval = $_POST['payment_type'];
        if ($radioval == 'upi') {
            header("Location: upi.php");
        } else if ($radioval == 'card') {
            header("Location: card.php");
        } else if ($radioval == 'cod') {
            header("Location: cod.php");
        }
    }
    ?>
</body>

</html>