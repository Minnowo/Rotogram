<?php
error_reporting(0);
if(ISSET($_POST['button'])){
    if(!empty($_POST['username'])){
        if(!empty($_POST['password'])){
            if(!empty($_POST['email'])){
                $username = $_POST['username'];
                $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
                $email = $_POST['email'];
            //check database for usernames and email
                include('dbc.php');
                $query = "SELECT * FROM users WHERE username = '$username' or email = '$email'";
                $result = mysqli_query($dbc, $query) or DIE ('error querying');
                while ($row = mysqli_fetch_array($result)){
                    $username_db = $row['username'];
                    $email_db = $row['email'];
                } 
            //if there is no matching username or email create account 
                if($username != $username_db && $email != $email_db){
                    $query = "INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `x`, `y`, `health`, `maxhp`, `inventory`, `event`, `equipped`, `money`) VALUES (NULL, '$username', '$password', '$email', '6', '1', '100', '100', '0', '0', '0', '0');";
                    mysqli_query($dbc, $query) or DIE("bad query");
                    header('location: login.php');
                } else { $msg = 'the username or email is already in use';}
            } else { $msg = 'please put in an email';}
        } else { $msg = 'please put in a password';}
    } else { $msg = 'please put in a username';}
    
}   

if(isset($_POST['signup'])){
    header('location: login.php');
}
include('signupstyle.php');
?>