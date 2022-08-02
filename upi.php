<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/payment.css">
    <title>UPI</title>
</head>

<body>
    <h1>UPI PAYMENT</h1>
    <form action="upi.php" method="POST">
        <label>Enter your UPI ID: </label>
        <input type="text" name="upi-id">
        <input type="submit" value="Enter" name="upi">
    </form>
    <?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'croma') or die("Connection Failed" . mysqli_connect_error());
    $payment_id = $_SESSION['pay'];

    if (isset($_POST['upi'])) {
        $upi_id = $_POST['upi-id'];
        $query = "INSERT INTO upi VALUES ('$upi_id', '$payment_id')";
        mysqli_query($conn, $query);
        $date = date('Y-m-d');
        $query1 = "UPDATE payment SET paymentMode = 'upi', paymentDate = '$date' WHERE paymentID = '$payment_id'";
        mysqli_query($conn, $query1);
        header("Location: product_review.php");
    }
    ?>
</body>

</html>