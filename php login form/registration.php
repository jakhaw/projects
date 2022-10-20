<?php

session_start();

if(isset($_SESSION['logged'])&&($_SESSION['logged']==true))
{
    header('Location: account.php');
    exit();
}

if(isset($_POST['new_email']))
{
    $ok = true;

    $name = $_POST['new_name'];
    if(ctype_alpha($name)==false)
    {
        $ok = false;
        $_SESSION['e_name'] = 'Name is incorrect';
    }

    $second_name = $_POST['new_second_name'];
    if(ctype_alpha($second_name) == false)
    {
        $ok = false;
        $_SESSION['e_second_name'] = 'Second name is incorrect';
    }

    $email = filter_input(INPUT_POST, 'new_email', FILTER_VALIDATE_EMAIL);
    if(empty($email))
    {
        $ok = false;
        $_SESSION['e_email'] = 'Email is incorrect';
    }

    $password1 = $_POST['new_password'];
    $password2 = $_POST['repeat_password'];
    if($password1 != $password2)
    {
        $ok = false;
        $_SESSION['e_password'] = 'Passwords do not match';
    }
    $passwordhash = password_hash($password1, PASSWORD_DEFAULT);

    require_once 'connect.php';
    try
    {
        $db = new mysqli($host, $db_user, $db_password, $db_name);
        if($db -> connect_errno!=0)
        {
            throw new Exception(mysqli_connect_errno());
        }
        else
        {
            $check = $db -> query("select id from user where email='$email'");
            if(!$check) throw new Exception($db -> error);
            $exist = $check -> num_rows;
            if($exist>0)
            {
                $ok = false;
                $_SESSION['e_email'] = "Account with this email already exist";
            }

            if($ok == true)
            {
                if($db->query("insert into user values (null, '$name', '$second_name', '$email', '$passwordhash')"))
                {
                    $_SESSION['registration_ok'] = true;
                    header("Location: welcome.php");
                }
                else
                {
                    throw new Exception($db->error);
                }
            }
            

            $db -> close();
        }
    }
    catch(Exception $e)
    {
        echo 'Server error, sorry';
    }

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
    <header><p>Create account to buy new and fresh shoes for every occasion!</p></header>
    <form method='post'>
        Name: <br/><input type='text' name='new_name'><br/><br/>
        <?php
        if(isset($_SESSION['e_name']))
        {
            echo '<span style="color:red;">'.$_SESSION['e_name'].'</span><br/><br/>';
            unset($_SESSION['e_name']);
        }
        ?>
        Second Name: <br/><input type='text' name='new_second_name'><br/><br/>
        <?php
        if(isset($_SESSION['e_second_name']))
        {
            echo '<span style="color:red;">'.$_SESSION['e_second_name'].'</span><br/><br/>';
            unset($_SESSION['e_second_name']);
        }
        ?>
        Email: <br/><input type='text' name='new_email'><br/><br/>
        <?php
        if(isset($_SESSION['e_email']))
        {
            echo '<span style="color:red;">'.$_SESSION['e_email'].'</span><br/><br/>';
            unset($_SESSION['e_email']);
        }
        ?>
        Password: <br/><input type='password' name='new_password'><br/><br/>
        <?php
        if(isset($_SESSION['e_password']))
        {
            echo '<span style="color:red;">'.$_SESSION['e_password'].'</span><br/><br/>';
            unset($_SESSION['e_password']);
        }
        ?>
        Repeat Password: <br/><input type='password' name='repeat_password'><br/><br/>
        <input type='submit' value='REGISTER'/>
    </form>
</body>
</html>