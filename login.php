<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/login.css">
    <title>Register/Login</title>
</head>
<h1>CROMA Electronic Store</h1>

<body bgcolor="seashell">
    <div class="register">
        <h2>LOGIN</h2>
        <form action="login.php" method="POST">
            <label for="user">Username:</label><br>
            <input type="text" name="username" placeholder="Enter username"><br><br>
            <?php
            session_start();
            $conn = mysqli_connect('localhost', 'root', '', 'croma') or die("Connection Failed" . mysqli_connect_error());
            if (isset($_POST['username'])) {
                $uname = $_POST['username'];
                if (empty($uname)) {

                    header("Location: index.php?error=User Name is required");

                    exit();
                } else {

                    $sql = "SELECT * FROM customer WHERE userName='$uname'";

                    $result = mysqli_query($conn, $sql);
                    if (mysqli_num_rows($result) > 0) {

                        $row = mysqli_fetch_assoc($result);

                        if ($row['userName'] === $uname) {

                            echo "<label for='user'>Enter OTP:</label><br>
                            <input type='text' name='otp' id='otp'><br><br>";
                            $_SESSION['user'] = $row['userName'];
                            $_SESSION['uID'] = $row['userID'];
                            $userN = $row['userID'];

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

                            echo "Logged in!";
                            header("Location: homepage.php");


                            exit();
                        } else {

                            header("Location: index.php?error=Incorect User name");

                            exit();
                        }
                    } else {
                        header("Location: index.php?error=Incorrect username");
                        exit();
                    }
                }
            }
            ?>
        </form>
    </div>
</body>

</html>