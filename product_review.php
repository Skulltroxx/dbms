<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/review.css">
    <title>Product Reviews</title>
</head>

<body>
    <h1>PRODUCT REVIEWS</h1>
    <h2>Enter your product reviews: </h2>
    <form action="thankyou.php" method="POST">
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'croma') or die("Connection Failed" . mysqli_connect_error());
        session_start();
        for ($i = 1; $i < $_SESSION['total']; $i++) {
            $var = "val" . (string)$i;
            $pid = $_SESSION[$var];
            $query = mysqli_query($conn, "SELECT pName FROM product WHERE productID = $pid");
            $row = mysqli_fetch_row($query);
            echo "Product: " . $row[0];
            $name = "prod" . (string)$i;
            $review_box = "rev" . (string)$i;
            echo " - <input type='text' name=$name><br><br>";
        }
        ?>
        <input type="submit" value="Submit">
    </form>

</body>

</html>