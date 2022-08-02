<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/payment.css">
    <title>End Page</title>
</head>

<body>
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'croma') or die("Connection Failed" . mysqli_connect_error());
    session_start();
    for ($i = 1; $i < $_SESSION['total']; $i++) {
        $var = "val" . (string)$i;
        $pid = $_SESSION[$var];
        $name = "prod" . (string)$i;
        $prod = $_POST[$name];
        mysqli_query($conn, "INSERT INTO product_reviews VALUES ($pid, '$prod')");
    }
    ?>
    <a href="index.php">LOGOUT</a>
    <h1 style="text-align: center;">THANK YOU</h1>
    <p>
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ut voluptatum maiores deserunt eos enim delectus, hic tenetur facere cum amet molestias esse iure est quas nesciunt quasi odio natus eum quaerat temporibus minus a. Ad quisquam fuga labore facilis, doloribus minus commodi eveniet optio qui eaque! Totam quas ad ducimus rerum commodi nesciunt ipsam nihil vero quos repellat! Harum illo rerum eum. Reprehenderit veritatis iste ea iure, necessitatibus asperiores corporis et sunt debitis aut voluptatum dolore magni ut numquam fugiat ipsa vero totam earum! Necessitatibus dolore vero ut reprehenderit facilis obcaecati eaque excepturi dignissimos deserunt! Soluta aperiam quisquam nobis voluptates quibusdam id suscipit sapiente ipsum. Hic eveniet fugit accusamus, facilis explicabo, esse possimus porro maiores ratione temporibus excepturi nobis placeat repudiandae asperiores dolor. Nulla nobis quis sapiente quod veniam repellat eligendi, distinctio eum id labore maxime, nihil esse dolore corrupti ut recusandae laudantium tempore non doloribus nostrum aspernatur quos aliquam adipisci sit? Magnam id dolorem voluptates ipsam exercitationem! Perferendis id adipisci quidem assumenda, magnam soluta qui doloremque vitae dolorum quisquam. Voluptatibus magni commodi reprehenderit sit nulla dolor alias in nam provident facilis eum velit eos, voluptatem minus. Totam blanditiis ab beatae expedita, sint accusamus. Sit est quasi magnam quibusdam nulla!
    </p>
</body>

</html>