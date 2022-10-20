<?php
session_start();

if(!isset($_SESSION['registration_ok']))
{
    header("Location: index.php");
    exit();
}
else
{
    unset($_SESSION['registration_ok']);
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sneaker-shop</title>
</head>
<body>
    <header><p>Thank you for registration. You can now log in into your account</p></header>
    <a href='index.php'>Click here to log in</a>
</body>
</html>