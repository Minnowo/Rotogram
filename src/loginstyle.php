<html>
<head>
    <link href='https://fonts.googleapis.com/css?family=Suwannaphum' rel='stylesheet'>
    <link rel="icon" href="././images/title.png">
    <title>Rottogram - login</title>
</head>
<style>
.font {
    font-size: 16;
    color: black;
    font-family: 'Suwannaphum';
    color: white;
}
.error {
    position: absolute;
    height: 25px;
    width: 210px;
    font-size: 20;
    font-family: 'Suwannaphum';
    color: white;
    -ms-transform: translate(-50%, -50%);
    transform: translate(55%, 0%);
    z-index:50;
}
.inputs {
    position: absolute;
    height: 30px;
    width: 420px;
    font-family: 'Suwannaphum';
    font-size: 24;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, 0%);
}
.submit {
    position: absolute;
    height: 50px;
    width: 210px;
    font-size: 35;
    font-family: 'Suwannaphum';
    -ms-transform: translate(-50%, -50%);
    transform: translate(-100%, -490%);
}
.signup {
    position: absolute;
    height: 50px;
    width: 210px;
    font-size: 35;
    font-family: 'Suwannaphum';
    -ms-transform: translate(-50%, -50%);
    transform: translate(-113%, -490%);
}
.username {
    position: relative;
    -ms-transform: translate(-50%, -50%);
    transform: translate(0%, 100%);
}
.email {
    position: relative;
    -ms-transform: translate(-50%, -50%);
    transform: translate(0%, 100%);
}
.password {
    position: relative;
    -ms-transform: translate(-50%, -50%);
    transform: translate(0%, 100%);
}
.box{
    position: absolute;
    width: 475px;
    height: 340px;
    top: 25%;
    left: 50%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, 10%);
   
}
.box1{
    position: absolute;
    width: 475px;
    height: 240px;
    top: 25%;
    left: 50%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, -74%);
   
}
.box2{
    position: absolute;
    width: 475px;
    height: 240px;
    top: 25%;
    left: 50%;
    -ms-transform: translate(-50%, -50%);
    transform: translate(-50%, 0%);
   z-index: 5;
}
.head{
    position: absolute;
    height: 30px;
    width: 400px;
    font-family: 'Suwannaphum';
    color: white;
    font-size: 50;
    -ms-transform: translate(-50%, -50%);
    transform: translate(8%, -550%);
    z-index: 5;
    font-weight: 1000;
}
.description{
    margin: auto;
    position: relative;
    height: 30px;
    width: 400px;
    font-family: 'Suwannaphum';
    color: white;
    font-size: 20;
    -ms-transform: translate(-50%, -50%);
    transform: translate(0%, -350%);
    z-index: 5;
    font-weight: 500;
}
.title {
    position: absolute;
    height: 25px;
    width: 400px;
    font-family: 'Suwannaphum';
    color: white;
    font-size: 50;
    -ms-transform: translate(-50%, -50%);
    transform: translate(8%, -150%);
    z-index: 5;
    font-weight: 1000;
    
}
html{
    background: url(././images/hallway.png);
    background-size: cover;
}
</style>
<form method="POST" action="login.php">
<img src="././images/loginbox.png" class="box"> 
<img src="././images/loginbox.png" class="box1"> 
<table class =box2>
<tr><td><div  class="head"><center>Rottogram</div> </td></tr>
<tr><td><div  class="description">A text based adventure game about fighting worms with the end goal of defeating the gravity lord Gravity worm, or the apple lord Apple worm</div> </td></tr>
<tr ><td><div  class="title"><center>Login</div></td></tr>
<?php
if(isset($msg)){
    echo "<tr><td><div class='error'><center>$msg</div></td></tr>";
}
?>
<tr height='28'><td><div class="username"><center><input class ="inputs"  type="inputs" name="username"   autocomplete='off' autofocus placeholder="username" minlength="2" maxlength="11"></div> </td></tr>
<tr height='28'><td><div class="email"><center><input class ="inputs"  type="email" name="email"  autocomplete='off' placeholder="email@email.com" ></div> </td></tr>
<tr height='28'><td><div class="password"><center><input class ="inputs"  type="password" name="password"   autocomplete='off' placeholder="password"  ></div> </td></tr>
<tr><td><div class="center"><center><input class ="submit" style="top: 475px;" type="submit" name="button"   value="Login"></div> </td><td>
<div class="center"><center><input class ="signup" style="top: 475px;" type="submit" name="signup"  value="Register"></div> </td></tr>
</form>
</table>
</html>
