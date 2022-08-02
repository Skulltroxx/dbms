<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CROMA</title>
</head>

<body style="background-color: seashell;">
    <?php if (isset($_GET['error'])) { ?>

        <p class="error"><?php echo $_GET['error']; ?></p>

    <?php } ?>
    <h1 style="background-color: antiquewhite; text-align: center;">CROMA INDEX PAGE</h1>
    <a href="registration.html">REGISTER</a><br>
    <a href="login.php">LOGIN</a>
    <h2 style="text-align: center; color: black; font-size:xx-large">CROMA - One Stop Electronic Store</h2>
</body>

</html>