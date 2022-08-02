<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/payment.css">
    <title>COD</title>
</head>

<body>
    <h1>CASH ON DELIVERY</h1>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'croma') or die("Connection Failed" . mysqli_connect_error());
    session_start();
    $userID = $_SESSION['uID'];
    $payment_id = $_SESSION['pay'];
    $query = "INSERT INTO cod VALUES ($payment_id)";
    mysqli_query($conn, $query);

    $query1 = mysqli_query($conn, "SELECT * FROM customer WHERE userID =  $userID");
    $user = mysqli_fetch_array($query1);
    $user_flat = $user['flatName'];
    $user_local = $user['locality'];
    ?>

    <form action="cod.php" method="POST">
        Order confirmed!
        Payment will be collected from: <?php echo  $user_flat . ", " . $user_local ?> <br>
        <input type="submit" name='cod' value="Press to Continue.">
    </form>
    <?php

    if (isset($_POST['cod'])) {
        $date = date('Y-m-d');
        $query2 = "UPDATE payment SET paymentMode = 'cod', paymentDate = '$date' WHERE paymentID = $payment_id";
        mysqli_query($conn, $query2);
        header("Location: product_review.php");
    }
    ?>
</body>

</html>