<?php

session_start();

if(!isset($_POST['login_email'])||!isset($_POST['login_password']))
{
    header('Location: index.php');
    exit();
}

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
        $login_password = $_POST['login_password'];
        $login_email = filter_input(INPUT_POST, 'login_email', FILTER_VALIDATE_EMAIL);

        if(empty($login_email))
        {
            $_SESSION['given_login_email'] = $_POST['login_email'];
            header('Location: index.php');
        }
        else
        {
            $existingemail = $db -> query("select * from user where email='$login_email'");
            if(!$existingemail) throw new Exception($db->error);
            $how_many_users = $existingemail->num_rows;
            if($how_many_users>0)
            {
                $row = $existingemail -> fetch_assoc();
                if(password_verify($login_password, $row['password']))
                {
                    $_SESSION['name']=$row['name'];
                    $_SESSION['second_name']=$row['second_name'];
                    unset($_SESSION['wrongpass']);
                    unset($_SESSION['notexist']);
                    $_SESSION['logged'] = true;

                    $existingemail->close();

                    header('Location: account.php');
                }
                else
                {
                    $_SESSION['wrongpass'] = 'Password is incorrect.';
                    header('Location: index.php');
                }
            }
            else
            {
                $_SESSION['notexist'] = 'Account with this email does not exist.';
                header('Location: index.php');
            }
        }

        $db -> close();
    }
}
catch(Exception $e)
{
    echo 'Server error, sorry for impediments, try again later.';
    echo '<br/>For developer: '.$e;
}