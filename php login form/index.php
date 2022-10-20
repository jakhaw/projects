<?php
session_start();

if(isset($_SESSION['logged'])&&($_SESSION['logged']==true))
{
    header('Location: account.php');
    exit();
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
    <header><p>New, fresh, with good prices, all u need in one place, HERE!<p></header>
    <p><a href='registration.php'>Don't have account? REGISTER HERE!</a></p>
    <main>
        <form method='post' action='login.php'>
            Email: <br/><input type='text' name='login_email' <?= isset($_SESSION['given_login_email'])?'value="'.$_SESSION['given_login_email'].'"':''?>><br/><br/>
            <?php
            if(isset($_SESSION['given_login_email']))
            {
                echo 'This is not valid email, check and correct.<br/><br/>';
                unset($_SESSION['given_login_email']);
            }
            ?>
            

            Password: <br/><input type='password' name='login_password'><br/><br/>
            <?php
            if(isset($_SESSION['wrongpass']))
            {
                echo $_SESSION['wrongpass'].'</br><br/>';
                unset($_SESSION['wrongpass']);
            }
            ?>

            <input type='submit' value="LOG IN">

            <?php
            if(isset($_SESSION['notexist']))
            {
                echo '<br/><br/>'.$_SESSION['notexist'];
                unset($_SESSION['notexist']);
            }
            ?>
        </form>
    </main>
</body>
</html>