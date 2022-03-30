<?php
session_start();
error_reporting(0);
if(ISSET($_POST['button'])){
    if(!empty($_POST['username'])){
        if(!empty($_POST['email'])){
            if(!empty($_POST['password'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
            //find the input username and find the password
                include('dbc.php');    
                $query = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($dbc, $query) or DIE ('error querying');
                while ($row = mysqli_fetch_array($result)){
                    $user_id = $row['user_id'];
                    $username_db = $row['username'];
                    $password_db = $row['password'];
                    $email_db = $row['email'];
                    $x = $row['x'];
                    $y  = $row['y'];
                    $health  = $row['health'];
                    $maxhp = $row['maxhp'];
                    $inventory= $row['inventory'];
                    $event= $row['event'];
                    $equipped= $row['equipped'];
                    $money= $row['money'];
                }
                    if($email == $email_db){
                        if(password_verify($password, $password_db)){
                            $_SESSION['user_id'] = $row['user_id'];
                            $_SESSION['rottogram_user'] = $username;
                            $_SESSION['x'] = $x;
                            $_SESSION['y'] = $y;
                            $_SESSION['health'] = $health;
                            $_SESSION['inventory'] = $inventory;
                            $_SESSION['event'] = $event;
                            $_SESSION['equipped'] = $equipped; 
                            $_SESSION['money'] = $money;
                            $_SESSION['maxhp'] = $maxhp;
                            $_SESSION['counter'] = 0;
                            $_SESSION['depression'] = 0;
                            $msg = explode('^$^', $_SESSION['msg']);   
                        //if you have never logged in before, display a starting msg
                            $event = explode(',', $_SESSION['event']);
                            if($username == 'shelly'){
                                array_push($inv, 'shellys love');
                            }
                            if(!in_array('old', $event)){  
                                array_push($msg, 'You can see a person through the window in your cell');
                            } else {
                                array_push($msg, 'Welcome back '. $username);
                            }
                            $_SESSION['event'] = implode(',', $event);
                            $_SESSION['msg'] = implode("^$^", $msg);
                            header('location: index.php');
                        }else {
                            $msg = 'Incorrect login details <br>';
                        }
                    } else {
                        $msg = 'Incorrect login details <br>';
                    }
                
                
            } else{ $msg = 'Please enter a password <br>';}
        } else{ $msg = 'Please enter an email <br>';}
    } else { $msg = 'Please enter a username <br>';}
}
if(isset($_POST['signup'])){
    header('location: signup.php');
}
require('loginstyle.php');
    ?>