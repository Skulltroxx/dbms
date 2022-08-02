<?php
session_start();
echo "User: " . $_SESSION['user'];
$username =  $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/product.css">
    <title>Products - CROMA</title>
</head>

<body>
    <h1>PRODUCT PAGE</h1>
    <div class="product">
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'croma') or die("Connection Failed" . mysqli_connect_error());
        $query = mysqli_query($conn, "SELECT * FROM product");


        $query1 = mysqli_query($conn, "SELECT userID FROM customer WHERE userName =  '$username'");
        $user = mysqli_fetch_array($query1);
        $orderID = $_SESSION['orderID'];
        echo "<pre>PRODUCT\tCATEGORY\tPRICE\t</pre>";
        $pay = 1;
        ?>
        <form class="form" method="POST">
            <?php
            $i = 1;
            while ($row = mysqli_fetch_assoc($query)) {
                echo "<pre>" . $row['pName'] . "\t" . $row['cat_name'] . "\t" . $row['price'] . "\t" . '<input type="submit" value="Add to cart" name="' . $i . '">'  . "</pre>";
                if (isset($_POST[$i])) {
                    $userN = $user['userID'];
                    $order_query = "INSERT INTO `orderline` VALUES ( " . $orderID . "," . $row['productID'] . "," . $row['price'] . ")";
                    $query3 = mysqli_query($conn, $order_query);
                    echo "(Added to cart!)";
                }
                $i += 1;
            }
            ?>
        </form>
        <a href="viewcart.php"><button style="background-color: greenyellow; border-radius: 10px;">View Cart</button></a>
    </div>
</body>

</html>