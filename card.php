<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/payment.css">
    <title>CARD</title>
</head>

<body>
    <h1>CARD PAYMENT</h1>
    <form action="card.php" method="POST">
        <label>Enter your Card No: </label>
        <input type="text" name="card-no"><br>
        <label>Enter your CVV No: </label>
        <input type="text" name="cvv-no"><br>
        <input type="submit" value="Enter" name="card">
    </form>
    <?php
    session_start();
    $conn = mysqli_connect('localhost', 'root', '', 'croma') or die("Connection Failed" . mysqli_connect_error());
    $payment_id = $_SESSION['pay'];

    if (isset($_POST['card'])) {
        $card_no = $_POST['card-no'];
        $cvv_no = $_POST['cvv-no'];
        $query = "INSERT INTO card VALUES ($cvv_no, $card_no, $payment_id)";
        mysqli_query($conn, $query);
        $date = date('Y-m-d');
        $query1 = "UPDATE payment SET paymentMode = 'card', paymentDate = '$date' WHERE paymentID = '$payment_id'";
        mysqli_query($conn, $query1);
        header("Location: product_review.php");
    }
    ?>
</body>

</html>