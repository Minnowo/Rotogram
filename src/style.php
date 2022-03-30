<html>
<head>
<link rel="shortcut icon" type="image/png" href="././images/title.png">
<link href='https://fonts.googleapis.com/css?family=Suwannaphum' rel='stylesheet'>
<title>Rottogram - game</title>
</head>
    <?php
    error_reporting(0);
    session_start();
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['user'];
    $x = $_SESSION['x'];
    $y  = $_SESSION['y'];
    $health  = $_SESSION['health'];
    $event= $_SESSION['event'];
    $equipped= $_SESSION['equipped'];
    $money = $_SESSION['money'];
    $maxhp = $_SESSION['maxhp'];
    $counter = $_SESSION['counter'];
    $depression = $_SESSION['depression'];
    $msg = explode('^$^', $_SESSION['msg']);
    $inv = explode(',', $_SESSION['inventory']);
    $event = explode(',', $_SESSION['event']);
    $equipped = explode(',', $_SESSION['equipped']);
    ?>

<style>
    body {    
        opacity: 5; 
        font-family: 'Suwannaphum';
        font-size: 29px;
        color: white;
        font-size: 22px;   
        }
    #button {
        width: 100px;
        position: absolute;
        
        }
    .inputtype {
        margin: auto;
        width:900px;
        top: 0px;
        position: relative;
    }
    #command {
        width:800px;
    }
    #text {
        font-size: 50px;
        background-color: black;
        color: black;
        position: relative;
        z-index: = 20;
    }
    #flowbox {
        margin: auto;
        opacity: 0.9; 
        top: 145px;
        position: relative;
        width:900px; 
        height:625px; 
        background-color: rgb(0, 0, 0);
        }
    .hp {
        margin: auto;
        background:url(././images/healthbar.png);
        height: 25px;
        width:<?php  $helth = $health * 2;  $helth = $helth / $maxhp; $helth = $helth * 200; echo $helth.'px;'; ?>;
        position: relative;
        top: -605px;
        z-index: = 10;
    }
    .maxhp {
        margin: auto;
        background:url(././images/maxhp.png);
        height: 25px;
        width:400px;
        position: static;
        -ms-transform: translate(-50%, -50%);
        transform: translate(0%, -2323%);
        top: 60px;
        z-index: = 14;
    }
    .hpvalue {
        margin: auto;
        height: 20px;
        width:200px;
        position: static;
        -ms-transform: translate(-50%, -50%);
        transform: translate(0%, -3520%);
        z-index: = 15;
    }
    .text {
        background: white;
        color: black;
        height: 500px;
        width:500px;
        left: 1%;
        top: 50%;
        position: absolute;
        font-size: 50;
        z-index: = 12;
    }
    .text1 {
        background: white;
        color: black;
        height: 325px;
        width:500px;
        left: 1%;
        top: 50%;
        position: absolute;
        font-size: 50;
        z-index: = 12;
    }
    .appleworm {
        background-image: url(././images/appleworm.png);
        color: white;
        height: 500px;
        width:510px;
        left: 70%;
        top: 10%;
        position: absolute;
        font-size: 50;
        z-index: = 12;
    }
    .appleworm1 {
        background-image: url(././images/applewormblush.png);
        color: white;
        height: 500px;
        width:500px;
        left: 72.43%;
        top: 10%;
        position: absolute;
        font-size: 50;
        z-index: = 12;
    }
    .gravityworm {
        background-image: url(././images/gravityworm.png);
        color: white;
        height: 300px;
        width: 510px;
        left: 70%;
        top: 10%;
        position: absolute;
        font-size: 50;
        z-index: = 12;
    }
    .portal {
        background-image: url(././images/portal.png);
        color: white;
        height: 500px;
        width:510px;
        left: 70%;
        top: 10%;
        position: absolute;
        font-size: 50;
        z-index: = 12;
    }
    .hud{
        margin: auto;
        font-size: 30px;
        background: grey;
        height: 75px;
        width:900px;
        position: relative;
        top: 25px;
        -ms-transform: translate(-50%, -50%);
        transform: translate(0%, -840%);
        z-index: = 9;
    }
    <?php 
        if($location == 'hidden room'){
            $_SESSION['backgroundroom'] = "././images/hiddenroom.png";
        }
        if($location == 'torture room'){
            $_SESSION['backgroundroom'] = "././images/tortureroom.png";
        }
        if($location == 'grimy cell'){
            $_SESSION['backgroundroom'] = "././images/grimycell.png";
        }
        if($location == 'hall of hallucinations'){
            $_SESSION['backgroundroom'] = "././images/hallway.png";
        }
        if($location == 'empty cell'){
            $_SESSION['backgroundroom'] = '././images/emptycell.png';
        } 
        if($location == 'Stairs'){
            $_SESSION['backgroundroom'] = '././images/stairs.png';
        }
        if($location == 'Basement' ){
            if(in_array('lamp', $equipped)){
                $_SESSION['backgroundroom'] = '././images/basement.png';
            } else {
            $_SESSION['backgroundroom'] = '././images/darkbasement.png';
            }
        }
        if($location == 'Dark room'){
            $_SESSION['backgroundroom'] = '././images/darkcell.png';
        }
        if($location == 'UNKNOWN'){
            $_SESSION['backgroundroom'] = '././images/unknown.png';
        }
        if($location == 'Ascended plains'){
            $_SESSION['backgroundroom'] = '././images/heaven.png';
        }
        ?>
    html {
    background:url(<?php echo $_SESSION['backgroundroom']; ?>);
    background-size: cover;
    }
    </style>
    <div class ="maxhp"></div>
    <div class ="hp"></div>
    <div class ="hud"> <table><tr><td width = '200px'><font size="5"><u>x and y</u></font></td><td width = '350px'><font size="5"><u>equipped items</u></font></td><td width = '250px'><font size="5"><u>location</u></font></td><td><font size="5"><u>worms</u></font></td></tr><tr><td><?php echo '<font size="5">'.$_SESSION['x'].', '.$_SESSION['y'].'</font>'?></td><td><?php echo '<font size="5">'.$_SESSION['equipped'] = implode(',', $equipped); $equipped.'</font>' ?></td><td><?php echo '<font size="5">'.$_SESSION['location'].'</font>' ?></td><td> <?php echo '<font size="5">'.$money.'</font>' ?></td></tr></table></div>
    <div class ="hpvalue">Health =<?php echo ' '.$health.'/'.$maxhp ?></div>
    <form method='POST' action = 'index.php'>
    <table class ='inputtype'><tr><td >
    <form method='POST' action ='<?php echo $_SERVER['PHP_SELF']; ?> '>
    <input type ='text' name = 'command' placeholder='action' id = 'command' autocomplete ='off' autofocus >
    <input type ='submit' name ='button' placeholder ='next' id ='button'>
    </form></td></tr></table>
<?php
if(in_array(20, $event)){
    echo "<div class ='text'> a̷r̸e̴ ̴<br>y̸o̶u̵<br>s̶̡̭̙̮̟̥̙͖̳̺̺͙̗̱̪̥̪̐̓̃̀̈̄̋̆̄̿͌̽͛̾̀̈́̐̚͠͝͝t̸̨̖͎̰̠̹͈̞͚̤̟͎̹̠͖̱̮̤̹̩̼͎̞̞́̇̽͆̊͑͂̚̚͝ī̵̱̱̙̥̏̇̏̆͛́̅́̏͘̚͝ļ̶̹͈͎̮̰̙̥͚͙̯̩͈̳͉̼̣̖̥͉̭͖̝͋̎́̑͜ͅl̶̻̘̻̮͕̟͙̤̘̥̩̙̳̩̪͖̳̟̹̬̠̪̈̋̈́̈̅̽̋̋́̏̌͊̄̐̿̿͐̄̕<br> ̴t̸h̶e̸r̴e̴ ̷?̵?̷    </div>";
}
if(in_array(21, $event) and !in_array(22, $event)){
    echo "<div class ='text'> Ÿ̶͖̹͖͚o̸͍̊ù̸͉̣̻͠ ̴<br> ̵̢̻̬͖̭̲̞̀̍c̶̢̭͛̍͋͒ã̶̠̗͍̱̜͇N̵͓̐͝n̴̡̧͛͂́ô̵̖̣̪͆̍́͊̆͜͝t̴̖̹̥͓̜́̓͊͊͆͜͝ ̴<br> ̷̢̡̛̫̣̩̝̱͐͘s̷̝͌͑͑T̶̘̪̲́o̸̮̠͍͐̑͗̆p̸̢̢̲͔͖͖̂͆̾ ̴<br> ̸͚̙͕̩̥̙̏́̎͜m̶̤̂͒e̷̘͇͎͂̊  (next)</div>";
}
if(in_array(22, $event) and !in_array(23, $event)){
    echo "<div class ='text'> Ÿ̶͖̹͖͚o̸͍̊ù̸͉̣̻͠ ̴<br> ̵̢̻̬͖̭̲̞̀̍c̶̢̭͛̍͋͒ã̶̠̗͍̱̜͇N̵͓̐͝n̴̡̧͛͂́ô̵̖̣̪͆̍́͊̆͜͝t̴̖̹̥͓̜́̓͊͊͆͜͝ ̴<br> ̷̢̡̛̫̣̩̝̱͐͘s̷̝͌͑͑T̶̘̪̲́o̸̮̠͍͐̑͗̆p̸̢̢̲͔͖͖̂͆̾ ̴<br> ̸͚̙͕̩̥̙̏́̎͜m̶̤̂͒e̷̘͇͎͂̊  (next)</div>";
    echo "<div class ='appleworm'> Maybe he can't, but i can </div>";
}
if(in_array(23, $event) and !in_array(24, $event)){
    echo "<div class ='text'>f̴̛̳͒̅͒̃͊͠ͅo̵̖̳̿ó̴̧̽̎̒͆̀͘l̶̗͍̻̳̿̆̒͝ ̴̪̲͙̍͑̉͋̀̚̕t̸̨̘͖̰̤̘̙́̍̍͐h̸̻͉͎́̉i̵̡̡̳̗̙͓̲͋̉͗s̶͇̟̺͐̊̈ ̸̧̧̨̤̻̱̗̉̚į̷̯͕͓͑̚͘ͅś̶̢̞̝̻̥̙͍͐̑͑̀̚̚ ̴͕͈̭͔̭̭̗̉̋m̵̛̬̖͈̘͉̩̗̃̃̚͘y̶̥̦͊͒͆ ̵̞̰͌͂̑͌̄̚͝ř̵̛͚̠̖̍̎́e̴̬̟̮͇͖̖͚͑̋̀̒͠ḁ̶̘̭̣̟̻̎̋l̸̢͕̪͕̞̖̹̅͝m̸̡̲̮̭̈́̂͜͜͝ ̴͔̦͕̤͋͑̋͌́̚b̵̜̫͗̾͂̇̓̈e̶̗̤̺̘͌̇̃̂͗͠ ̵͇̹̤̘̈ͅg̷̙͈̖̭͓̹͋o̶͇̞͍͌̅͑̊̚̕͠ͅǹ̴͉̠̹͈̯̬ẹ̴̛̻͓͌͆͊ (next)</div>";
    echo "<div class ='portal'> noooooooo</div>";
}
if(in_array(24, $event) and !in_array(25, $event)){
    echo "<div class ='text'>n̴̪̍͘o̸̺͆̀w̴̙̰̉̕ ̸͇̫͋̉t̷̛̳̤̽h̵͇͎̒̔ḁ̷̒t̶̝̏͝ ̸̪͙̓͝h̴̩̥́̀e̴̜͉͐͠ ̸̯̗͒i̸̞̋s̶̱̆͂ ̵̨̼̂̈g̴̯͐̾ó̵̜ṉ̴̅͆è̵̠͔͝ ̴̭̈́l̷͎̮̓e̶̩̅ţ̶̡̋́ ̶̬̈̚ó̷̱͎́ủ̶͈r̴̘̣̆ ̴̱̅b̸̜̈́̌a̸̛̞̍t̵̯̉t̶̯̜̃̐l̴̜̦̊ȩ̶̢̈́͘ ̵̛̬̃b̴̟̉̉e̴͔̕g̷͕̦̍̕í̵̩̳̉n̷͉͋̈́!̴̥̀̕!̴̼̌̒(next)</div>";
}
if(in_array(25, $event) and !in_array(26, $event)){
    echo "<div class ='gravityworm'>H̴P̴ ̶≠ ̴U̴N̷K̴O̷W̸N̸ </div>";
}

if(in_array(27, $event)){
    echo "<div class ='text1'> Are you still alive young one?   </div>";
}
if(in_array(28, $event) and !in_array(29, $event)){
    echo "<div class ='text1'> I see, you have a gravity cloak on you, you are loyal to Gravity Worm, I will be the one to stop you(next)</div>";
}
if(in_array(29, $event) and !in_array(30, $event)){
    echo "<div class ='text1'> You will be unable to stop me, shall we begin?(next)</div>";
    echo "<div class ='gravityworm'> M̴͔̭̮̀ą̷̣͍̩̄y̵̗͝͠b̴̨͍̬̭̅e̸̖̐̈́̋̅͘ ̴̻̤͉̭̊̂͜ḧ̵̜͎̫̞͊ę̵̛̼̝̺̍ ̸̠̖͔͖͑̍̀c̶̢̤̹̯̗̄͑a̷̠͛͗͋̾n̴̯͙̅̈́̋͘'̸̯̎͐͝t̵̡͋,̷̜̟͇̬̽͋̈́̔͊ ̴̤̳͛b̷̟̠̿́u̷̱͆͊̋͂̾t̷͇͖̀̅ ̷̬͆͒̚͝i̶̼̲͒ ̵̘̄̽͊c̸̪͎̀͗̓̚ā̵̝̰̗̙̒͐̈́ñ̴̹͕̙͈̍̑́ </div>";
}
if(in_array(30, $event) and !in_array(31, $event)){
    echo "<div class ='text1'> This realm belongs to me, You have no power here Gravity Worm, be gone(next)</div>";
    echo "<div class ='portal'> n̸̡̤̲̒̽̽̚ö̵̩̞̠͓́̔̚ŏ̴̞ô̷̧̞̖̺̭̇͠o̶͍̅͆̒͝ȏ̴̬̩͎͚̒͘̚͝o̷̹̗̣͛̇͜o̵͉͍̾̍̆̔͋o̵͚̭̓͆͝</div>";
}
if(in_array(31, $event) and !in_array(32, $event)){
    echo "<div class ='text1'>Now, let our battle begin(next)</div>";
}
if(in_array(32, $event) and !in_array(33, $event)){
    echo "<div class ='appleworm1'> HP = ∞ </div>";
}
include('location.php');
$_SESSION['equipped'] = implode(',', $equipped);
$_SESSION['inventory'] = implode(',', $inv);
$_SESSION['event'] = implode(',', $event);
$inventory = $_SESSION['inventory'];
$x = $_SESSION['x'];
$y  = $_SESSION['y'];
$health  = $_SESSION['health'];
$event= $_SESSION['event'];
$equipped= $_SESSION['equipped'];
$money = $_SESSION['money'];
?>
