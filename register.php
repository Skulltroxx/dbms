<?php
session_start();
$username;
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['submit'])) {
    $conn = mysqli_connect('localhost', 'root', '', 'croma') or die("Connection Failed" . mysqli_connect_error());
    if (isset($_POST['username']) && isset($_POST['locality']) && isset($_POST['flatname']) && isset($_POST['phone'])) {
        $username = $_POST['username'];
        $locality = $_POST['locality'];
        $flatname = $_POST['flatname'];
        $phone = $_POST['phone'];
    }

    if (empty($username)) {

        header("Location: index.php?error=User Name is required");

        exit();
    } else {

        $sql = "SELECT * FROM customer WHERE userName='$username'";

        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);

            if ($row['userName'] === $username) {

                header("Location: index.php?error=username unavailable!");

                exit();
            }
        } else {
            $customer = "INSERT INTO customer (userName, locality, flatName) VALUES ('$username', '$locality', '$flatname')";
            $userphone = "INSERT INTO `user_phoneno` (`phoneNo`) VALUES ('$phone')";
            mysqli_query($conn, $customer);
            mysqli_query($conn, $userphone);

            $_SESSION['user'] = $username;
            $quer = "SELECT userID FROM customer WHERE userName =  '$username'";
            $query1 = mysqli_query($conn, $quer);
            $user = mysqli_fetch_assoc($query1);
            $userN = $user['userID'];
            $_SESSION['uID'] = $userN;
            $date = date('Y-m-d');
            $payment = "INSERT INTO payment(paymentDate) VALUES (NULL)";
            mysqli_query($conn, $payment);

            $query3 = mysqli_query($conn, "SELECT paymentID FROM payment WHERE paymentID = (SELECT MAX(paymentID) FROM payment)");
            $pay = mysqli_fetch_assoc($query3);
            $payID = $pay['paymentID'];
            $_SESSION['pay'] = $payID;

            $customerorder = "INSERT INTO customerorder(order_date, userID, paymentID) VALUES ('$date' , '$userN', '$payID' )";
            mysqli_query($conn, $customerorder);

            $query2 = mysqli_query($conn, "SELECT orderID FROM customerorder WHERE userID = $userN and paymentID = $payID");
            $oID = mysqli_fetch_array($query2);
            $_SESSION['orderID'] = $oID['orderID'];

            header("Location: homepage.php");
        }
    }
}
