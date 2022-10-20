<?php
session_start();

if(!isset($_SESSION['logged']))
{
    header('Location: index.php');
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <p><a href='logout.php'>LOG OUT</a></p>
    <?php
    echo 'Welcome '.$_SESSION['name'].' '.$_SESSION['second_name'].' to Your account<br/>';
    echo 'Start shopping now!';
    ?>
</body>
</html>