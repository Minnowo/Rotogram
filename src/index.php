<?php
session_start();
error_reporting(0);
if(isset($_SESSION['rottogram_user'])){
    include('dbc.php');
    //setting sessions
    $user_id = $_SESSION['user_id'];
    $username = $_SESSION['rottogram_user'];
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
    $shop = array("shellys love", "apple juice", "shield", "gravitycloak");
    $event[0] = 'old';
    include('location.php');
    if(empty($inv[0])){
        $inv = array();
    }
    if(empty($equipped[0])){
        $equipped = array();
    }
    // checking the text from the user input // calculations
    if(isset($_POST['button'])){
        $input = trim(strtolower($_POST['command']));
        $word = strtok($input, " ");
        $word2 = strtok(" ");
        $word3 = strtok(" ");
        $word4 = strtok(" ");
        $word5 = strtok(" ");
        $words = $word2. " ". $word3. " ". $word4. " ". $word5;
        $words = trim($words);        
            
        
        //save and log the user out if requested 
        if($input == 'logout' or $input == 'signout' or $input == 'session stop' or $input == 'save and quit'){
            if(!in_array(20, $event) and !in_array(21, $event)){
            $_SESSION['inventory'] = implode(',', $inv);
            $_SESSION['event'] = implode(',', $event);
            $_SESSION['equipped'] = implode(',', $equipped);
            $equippedstuff = $_SESSION['equipped'];
            $inventory = $_SESSION['inventory'];
            $events = $_SESSION['event'];
            $query = "UPDATE `users` SET `x` = '$x', `y` = '$y', `health` = '$health', `maxhp` = '$maxhp', `inventory` = '$inventory', `event` = '$events', `equipped` = '$equippedstuff', `money` = '$money'  WHERE `users`.`username` = '$username';";
            mysqli_query($dbc, $query) or DIE('kill things good');
            header('location: login.php');
            session_destroy();
            } else {
                array_push($msg, 'You cannot logout here');
            }
        }     else 
        //save all into database
        if($input == 'save' or $input == 'save game'){
            if(!in_array(20, $event) and !in_array(21, $event)){
                array_push($event, 'l');
                $_SESSION['inventory'] = implode(',', $inv);
                $_SESSION['equipped'] = implode(',', $equipped);
                $_SESSION['event'] = implode(',', $event);
                $inventory = $_SESSION['inventory'];
                $events = $_SESSION['event'];
                $equippedstuff = $_SESSION['equipped'];
                $query = "UPDATE `users` SET `x` = '$x', `y` = '$y', `health` = '$health', `maxhp` = '$maxhp', `inventory` = '$inventory', `event` = '$events', `equipped` = '$equippedstuff', `money` = '$money'  WHERE `users`.`username` = '$username';";
                mysqli_query($dbc, $query) or DIE('could not save');
                array_push($msg, "Game saved");
                array_push($msg, '&nbsp;');
            } else {
            array_push($msg, 'You cannot save here');
            }
        } else
        if($input == 'load save' or $input == 'load game'){
            $query = "SELECT * FROM users WHERE username = '$username'";
            $result = mysqli_query($dbc, $query) or DIE ('error querying');   
            while ($row = mysqli_fetch_array($result)){
                $x = $row['x'];
                $y  = $row['y'];
                $health  = $row['health'];
                $maxhp = $row['maxhp'];
                $inventory= $row['inventory'];
                $event= $row['event'];
                $equipped= $row['equipped'];
                $money= $row['money'];
            }
            $_SESSION['encounter'] = 0;
            $_SESSION['money'] = $money;
            $_SESSION['rottogram_user'] = $username;
            $_SESSION['x'] = $x;
            $_SESSION['y'] = $y;
            $_SESSION['health'] = $health;
            $_SESSION['maxhp'] = $maxhp;
            $_SESSION['inventory'] = $inventory;
            $_SESSION['event'] = $event;
            $_SESSION['equipped'] = $equipped;
            $equipped = explode(',', $_SESSION['equipped']);
            $msg = explode('^$^', $_SESSION['msg']);
            $inv = explode(',', $_SESSION['inventory']);
            $event = explode(',', $_SESSION['event']);
            include('location.php');
            array_push($msg, 'Game loaded from previous save');
            array_push($msg, '&nbsp;');
    } else
        if($input == 'restart'){
            $_SESSION['depression'] = 0;
            $_SESSION['counter'] = 0;
            $_SESSION['encounter'] = 0;
            $_SESSION['money'] = 0;
            $_SESSION['x'] = 6;
            $_SESSION['y'] = 1;
            $_SESSION['health'] = 100;
            $_SESSION['maxhp'] = 100;
            $x = $_SESSION['x'];
            $y  = $_SESSION['y'];
            $username = $_SESSION['rottogram_user'];
            $health  = $_SESSION['health'];
            $money = $_SESSION['money'];
            $maxhp = $_SESSION['maxhp'];
            $inv = array();
            $msg = array();
            $event = array();
            $equipped = array();
            $_SESSION['equipped'] = implode(',', $equipped);
            $_SESSION['inventory'] = implode(',', $inv);
            $_SESSION['event'] = implode(',', $event);
            $inventory = $_SESSION['inventory'];
            $equippedstuff = $_SESSION['equipped'];
            $events = $_SESSION['event'];
            $query = "UPDATE `users` SET `x` = '$x', `y` = '$y', `health` = '$health', `maxhp` = '$maxhp', `inventory` = '$inventory', `event` = '$events', `equipped` = '$equippedstuff', `money` = '$money'  WHERE `users`.`username` = '$username';";
            mysqli_query($dbc, $query) or DIE('trouble saving');
            array_push($msg, 'Game restarted');
            array_push($msg, 'Game saved');
            array_push($msg, 'You can see a person through the window in your cell');
            array_push($msg, '&nbsp;');
            
        }else
        if(in_array(20, $event)){
            if($input == 'yes' or $input == 'y'){
                array_push($event, 21);
                $_SESSION['location'] = 'UNKNOWN';
                foreach($event as $key => $value){
                    if($value == 20){
                        unset($event[$key]);
                    }
                }
            }
        }else  
        if(in_array(27, $event)){
            if($input == 'yes' or $input == 'y'){
                array_push($event, 28);
                $_SESSION['location'] = 'Ascended plains';
                foreach($event as $key => $value){
                    if($value == 27){
                        unset($event[$key]);
                    }
                }
            }
        }else  
        if($input == 'next' and in_array(98, $event)){
            if(in_array(21, $event) and !in_array(22, $event)){
                array_push($event, 22);
            } else 
            if(in_array(22, $event) and !in_array(23, $event)){
                array_push($event, 23);
            } else
            if(in_array(23, $event) and !in_array(24, $event)){
                array_push($event, 24);
            } else 
            if(in_array(24, $event) and !in_array(25, $event)){
                array_push($event, 25);
            }  
        } else
        if($input == 'next' and in_array(99, $event)){  
            if(in_array(28, $event) and !in_array(29, $event)){
                array_push($event, 29);
            } else 
            if(in_array(29, $event) and !in_array(30, $event)){
                array_push($event, 30);
            } else
            if(in_array(30, $event) and !in_array(31, $event)){
                array_push($event, 31);
            } else 
            if(in_array(31, $event) and !in_array(32, $event)){
                array_push($event, 32);
            }         
        } else
         if($word == 'purchase' and in_array($words, $shop)){
            if($shop1 == 1){
                if(!in_array($word2, $inv) and !in_array($word2, $equipped)){
                    if($money >= 5){
                        foreach($shop as $key => $value){
                            if($value == $word2){
                                unset($shop[$key]);
                            }
                        }
                        $_SESSION['money'] -= 5;
                        array_push($inv, $words);
                        array_push($msg, "You have purchased $words ");
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, "You do not have enough money ");
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
                } else {
                    array_push($msg, "This item has been purchased ");
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                }
            } else {
            array_push($msg, "There is no shop here ");
            array_push($msg, '&nbsp;');
            array_push($event, 'l');
        }
    } else
        // if walk east update x pos 
        if($input == 'walk east' or $input == 'move east' or $input == 'go east' or $input == 'east' or $input == 'e'){
            if($x == 1 && $y == 4){
                if(!in_array(15, $event)){
                    array_push($msg, 'There is a door that is locked ');
                    array_push($msg, '&nbsp;');
                }
            }
            if($east == 1){
            $_SESSION['x'] += 1;
            include('location.php');
            array_push($msg, "You have moved east ");
            array_push($msg, $room);
            array_push($msg, '&nbsp;');
            if(in_array('gravitycloak', $equipped)){
                $_SESSION['encounter'] = rand(6, 14); 
            } else {
                $_SESSION['encounter'] = rand(1, 5);
            }
            foreach($event as $key => $value){
                if($value == 10){
                    unset($event[$key]);
                }
                if($value == 9){
                    unset($event[$key]);
                }
                if($value == 12){
                    unset($event[$key]);
                }
            }
            if($person == 1){
                array_push($msg, $roomnpc);
                array_push($msg, '&nbsp;');
            }
            } else {
                 array_push($msg, "You cannot move east ");
                 array_push($msg, '&nbsp;');
                 include('dmg.php');
                 
                }
        } else
        // if walk north update y pos 
        if($input == 'walk north' or $input == 'move north' or $input == 'go north' or $input == 'north' or $input == 'n'){
            if($north == 1){
            $_SESSION['y'] -= 1;
            include('location.php');
            array_push($msg, "You have moved north ");
            array_push($msg, $room);
            array_push($msg, '&nbsp;');
            if(in_array('gravitycloak', $equipped)){
                $_SESSION['encounter'] = rand(6, 14); 
            } else {
                $_SESSION['encounter'] = rand(1, 5);
            }
            foreach($event as $key => $value){
                if($value == 10){
                    unset($event[$key]);
                }
                if($value == 9){
                    unset($event[$key]);
                }
                if($value == 12){
                    unset($event[$key]);
                }
            }
            if($person == 1){
                array_push($msg, $roomnpc);
                array_push($msg, '&nbsp;');
            }
            } else {
                 array_push($msg, "You cannot move north ");
                 array_push($msg, '&nbsp;');
                 include('dmg.php');
                 
                }
        } else
        // if walk west update x pos 
        if($input == 'walk west' or$input == 'move west' or $input == 'go west' or $input == 'west' or $input == 'w'){
            if($x == 2 && $y == 1){
                if(!in_array(3, $event)){
                    array_push($msg, 'There is a locked door ');
                    array_push($msg, '&nbsp;');
                }
            }
            if($west == 1){
            $_SESSION['x'] -= 1;
            include('location.php');
            array_push($msg, "You have moved west ");
            array_push($msg, $room);
            array_push($msg, '&nbsp;');
            if(in_array('gravitycloak', $equipped)){
                $_SESSION['encounter'] = rand(6, 14); 
            } else {
                $_SESSION['encounter'] = rand(1, 5);
            }
            foreach($event as $key => $value){
                if($value == 10){
                    unset($event[$key]);
                }
                if($value == 9){
                    unset($event[$key]);
                }
                if($value == 12){
                    unset($event[$key]);
                }
            }
            if($person == 1){
                array_push($msg, $roomnpc);
                array_push($msg, '&nbsp;');
            }
            } else { 
                array_push($msg, "You cannot move west ");
                array_push($msg, '&nbsp;');
                include('dmg.php');
                
            }
        } else
        // if walk south update y pos 
        if($input == 'walk south' or $input == 'move south' or $input == 'go south' or $input == 'south' or $input == 's'){
            if($x == 5 && $y == 0){
                if(!in_array(1, $event)){
                    array_push($msg, 'There is a vent that is jammed shut ');
                    array_push($msg, '&nbsp;');
                }
            }
           if($south == 1){
            $_SESSION['y'] += 1;
            include('location.php');
            array_push($msg, "You have moved south ");
            array_push($msg, $room);
            array_push($msg, '&nbsp;');
            if(in_array('gravitycloak', $equipped)){
                $_SESSION['encounter'] = rand(6, 14); 
            } else {
                $_SESSION['encounter'] = rand(-4, 5);
            }
            foreach($event as $key => $value){
                if($value == 10){
                    unset($event[$key]);
                }
                if($value == 9){
                    unset($event[$key]);
                }
                if($value == 12){
                    unset($event[$key]);
                }
            }
            if($person == 1){
                array_push($msg, $roomnpc);
                array_push($msg, '&nbsp;');
            }
           } else { 
               array_push($msg, "You cannot move south ");
               array_push($msg, '&nbsp;');
               include('dmg.php');
            }
        } else

        //help command
        if($input =='help' or $input =='h' or $input =='commands'){
            array_push($msg, '<b>Commands are</b>');
            array_push($msg, 'walk east');
            array_push($msg, 'walk north');
            array_push($msg, 'walk west');
            array_push($msg, 'walk south');
            array_push($msg, 'save');
            array_push($msg, 'logout');
            array_push($msg, 'clear');
            array_push($msg, 'view');
            array_push($msg, 'pickup "item name"');
            array_push($msg, 'equip "item name"');
            array_push($msg, 'use "item name"');
            array_push($msg,'talk');
            array_push($msg, 'go down');
            array_push($msg, 'go up');
            array_push($msg, 'restart');
            array_push($msg, 'load save');
            array_push($msg, 'attack');
            array_push($msg, 'heal');
            array_push($msg, 'help2 ');
            array_push($msg, '&nbsp;');
            array_push($event, 'l');
        } else
        if($input == 'help2' or $input == 'help 2' or $input == 'commands 2'){
            array_push($msg, '<b>Commands are</b>');
            array_push($msg, 'fill vial');
            array_push($msg, 'drink blood');
            array_push($msg, 'purchase "item"');
            array_push($msg, 'wait');
            array_push($msg, 'run');
            array_push($msg, 'cry ');
            array_push($msg, '&nbsp;');
            array_push($event, 'l');
        } else
        //open inventory
        if($input == 'inv' or $input =='inventory' or $input == 'open inventory' or $input == 'open inv'){
            array_push($msg, '>Inventory: ');
            foreach($inv as $gei){
                array_push($msg, '<b>'.$gei.'</b>');
            }
            array_push($msg, '&nbsp;');
            include('dmg.php'); 
        } else
        //equip items 
        if($input == 'equip applecloak' or $input =='equip apple cloak' or $input =='equip cloak'){
            if(in_array('applecloak', $equipped)){
                array_push($msg, 'You already have that equipped ');
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }else
            if(in_array('applecloak', $inv)){
                foreach($inv as $key => $value){
                    if($value =='applecloak'){
                        unset($inv[$key]);
                    }
                }
                if(in_array('gracitycloak', $equipped)){
                    foreach($equipped as $key => $value){
                        if($value =='gravitycloak'){
                            unset($equipped[$key]);
                            array_push($inv, $value);
                        }
                    }
                }
                array_push($equipped, 'applecloak');
                include('dmg.php');
                
                //checking for equipped items
                if(in_array('applecloak', $equipped)){
                    $_SESSION['maxhp'] = 200;
                    $_SESSION['health'] += 50;
                }
            } else {
                array_push($msg, "You don't have that in your inventory ");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }
            
        } else
        if($input == 'equip gravitycloak' or $input =='equip gravity cloak '){
            if(in_array('gravitycloak', $equipped)){
                array_push($msg, 'You already have that equipped ');
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }else
            if(in_array('gravitycloak', $inv)){
                foreach($inv as $key => $value){
                    if($value =='gravitycloak'){
                        unset($inv[$key]);
                    }
                }
                if(in_array('applecloak', $equipped)){
                    foreach($equipped as $key => $value){
                        if($value =='applecloak'){
                            unset($equipped[$key]);
                            array_push($inv, $value);
                        }
                    }
                }
                array_push($equipped, 'gravitycloak');
                include('dmg.php');
                
                //checking for equipped items
                if(in_array('gravitycloak', $equipped)){
                    $_SESSION['maxhp'] = 200;
                    $_SESSION['health'] += 50;
                }
            } else {
                array_push($msg, "You don't have that in your inventory ");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }
            
        } else
        if($input == 'equip crowbar'){
            if(in_array('crowbar', $equipped)){
                array_push($msg, 'You already have that equipped ');
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
                include('dmg.php');
                
            }
            if(in_array('crowbar', $inv)){
                foreach($inv as $key => $value){
                    if($value =='crowbar'){
                        unset($inv[$key]);
                    }
                }
                if(in_array('axe', $equipped) or in_array('keys', $equipped)){
                    foreach($equipped as $key => $value){
                        if($value =='keys' or $value == 'axe'){
                            unset($equipped[$key]);
                            array_push($inv, $value);
                        }
                    }
                }
                array_push($equipped, 'crowbar');
                include('dmg.php');
                
            } else {
                array_push($msg, "You don't have that in your inventory ");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }   
        } else
        if($input == 'equip shield'){
            if(in_array('shield', $equipped)){
                array_push($msg, 'You already have that equipped ');
                array_push($msg, '&nbsp;');
                include('dmg.php');
                
            }
            if(in_array('shield', $inv)){
                foreach($inv as $key => $value){
                    if($value =='shield'){
                        unset($inv[$key]);
                    }
                }
                array_push($equipped, 'shield');
                include('dmg.php');
                
            } else {
                array_push($msg, "You don't have that in your inventory ");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }   
        } else
        if($input == 'equip axe'){
            if(in_array('axe', $equipped)){
                array_push($msg, 'You already have that equipped ');
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
                include('dmg.php');
                
            }
            if(in_array('axe', $inv)){
                foreach($inv as $key => $value){
                    if($value =='axe'){
                        unset($inv[$key]);
                    }
                }
                if(in_array('crowbar', $equipped) or in_array('keys', $equipped)){
                    foreach($equipped as $key => $value){
                        if($value =='crowbar' or $value == 'keys'){
                            unset($equipped[$key]);
                            array_push($inv, $value);
                        }
                    }
                }
                array_push($equipped, 'axe');
                include('dmg.php');
                
            } else {
                array_push($msg, "You don't have that in your inventory ");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }   
        } else
        if($input == 'equip keys'){
            if(in_array('keys', $equipped)){
                array_push($msg, 'You already have that equipped ');
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
                include('dmg.php');
                
            }
            if(in_array('keys', $inv)){
                foreach($inv as $key => $value){
                    if($value =='keys'){
                        unset($inv[$key]);
                    }
                }
                if(in_array('crowbar', $equipped) or in_array('axe', $equipped)){
                    foreach($equipped as $key => $value){
                        if($value =='crowbar' or $value == 'axe'){
                            unset($equipped[$key]);
                            array_push($inv, $value);
                        }
                    }
                }
                array_push($equipped, 'keys');
                include('dmg.php');
                
            } else {
                array_push($msg, "You don't have that in your inventory ");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }   
        } else
        if($input == 'equip lamp'){
            if(in_array('lamp', $equipped)){
                array_push($msg, 'You already have that equipped ');
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
                include('dmg.php');
                
            }
            if(in_array('lamp', $inv)){
                foreach($inv as $key => $value){
                    if($value =='lamp'){
                        unset($inv[$key]);
                    }
                }
                array_push($equipped, 'lamp');
                array_push($msg, 'The lamp lights up your path, any dark areas disapear ');
                array_push($msg, '&nbsp;');
                include('dmg.php');
                
            } else {
                array_push($msg, "You don't have that in your inventory ");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }   
        } else
        //view the room / area you are in
        if($input == 'view' or $input == 'look' or $input == 'scan' or $input == 'look around'){
            array_push($msg, $viewn);
            array_push($msg, $views);
            array_push($msg, $vieww);
            array_push($msg, $viewe);
            array_push($msg, '&nbsp;');
        } else 
        //items to take
        if($input == 'pickup crowbar' or $input == 'take crowbar' or $input == 'grab crowbar'){
            if($item == 'crowbar'){
                if(!in_array('crowbar', $inv)){
                    if(!in_array('crowbar', $equipped)){
                        array_push($inv, 'crowbar');
                        array_push($msg, 'You have picked up the crowbar ');
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, 'There is no crowbar to take');
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
                } else {
                    array_push($msg, 'There is no crowbar to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                }
            } else {
                    array_push($msg, 'There is no crowbar to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                    include('dmg.php');
                    
                }
        }   else 
        if($input == 'pickup keys' or $input == 'take keys' or $input == 'grab keys'){
            if($item == 'keys'){
                if(!in_array('keys', $inv)){
                    if(!in_array('keys', $equipped)){
                        array_push($inv, 'keys');
                        array_push($msg, 'You have picked up the keys ');
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, 'There is no keys to take');
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }  
                } else {
                    array_push($msg, 'There is no keys to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                }
            } else {
                    array_push($msg, 'There are no keys to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                    include('dmg.php');
                    
                }
        }   else 
        if($input == 'pickup vial' or $input == 'take vial' or $input == 'grab vial'){
            if($item == 'vial'){
                if(!in_array('vial', $inv)){
                    if(!in_array('vial', $equipped)){
                        array_push($inv, 'vial');
                        array_push($msg, 'You have picked up the vial ');
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, 'There is no vial to take');
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
                } else {
                    array_push($msg, 'There is no vial to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                }
            } else {
                    array_push($msg, 'There is no vial to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                    include('dmg.php');
                    
                }
        }   else 
        if($input == 'pickup axe' or $input == 'take axe' or $input == 'grab axe'){
            if($item == 'axe'){
                if(!in_array('axe', $inv)){
                    if(!in_array('axe', $equipped)){
                        array_push($inv, 'axe');
                        array_push($msg, 'You have picked up the axe ');
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, 'There is no axe to take');
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
                } else {
                    array_push($msg, 'There is no axe to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                }
            } else {
                    array_push($msg, 'There is no axe to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                    include('dmg.php');
                    
                }
        }   else 
        if($input == 'pickup lamp' or $input == 'take lamp' or $input == 'grab lamp'){
            if($item == 'lamp'){
                if(!in_array('lamp', $equipped)){
                    if(!in_array('lamp', $inv)){
                        array_push($inv, 'lamp');
                        array_push($msg, 'You have picked up the lamp ');
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, 'There is no lamp to take');
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
                } else {
                    array_push($msg, 'There is no lamp to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                }
            } else {
                    array_push($msg, 'There is no lamp to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                    include('dmg.php');
                    
                }
        }   else 
        if($input == 'pickup applecloak' or $input == 'take applecloak' or $input == 'take cloak'or $input == 'grab applecloak' or $input == 'pickup apple cloak' or $input == 'take apple cloak' or $input == 'grab apple cloak'){
            if($item == 'applecloak'){
                if(!in_array('applecloak', $equipped)){
                    if(!in_array('applecloak', $inv)){
                        array_push($inv, 'applecloak');
                        array_push($msg, 'You have picked up the applecloak ');
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, 'There is no applecloak to take');
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
                } else {
                    array_push($msg, 'There is no applecloak to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                }
            } else {
                    array_push($msg, 'There is no applecloak to take');
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                    include('dmg.php');
                    
                }
        }   else 
        //actions
        if($input == 'enter' or $input == 'enter portal'){
            if($x == 5 and $y == 3 and in_array('applecloak', $equipped)){
                $_SESSION['x'] =                                                                                     "Ư̵̛͚͔̙̫̲̺̝̣̪̪̪̦̖̠̹̝̟̬̦̰̮̮͔̞̹͈͍̮̱̘̞̯̟̼̙̤̬͈̗̟͎͍̖͖͓̩̮̣͍͇̳̺̳̲̊̈́̂͋̎̏̈́̌̈́̃̋͑̎̂̄̇̐̈́̊̿̿̀̃̇̀̌͒͛̃̈́͆̃̐́͋͐́̉͑̊́̎̽͒͛̈́̉̋̀͌͑́̐̄́͑̋̇̈̋̾͊̒̐̑̊͐̎̃̆̾̉̄͛̇̌̀̍̊͗͗̈́͌̐̐͋̈́̓̈̅̃̏͑̒̍̓͗̔̃͊̕̚̕̕͜͝͝͝͠͠͝͝͝͝͠͝͠͝ͅN̴̢̧̢̨̛̺͈̝̼̯̝̱̬̖̬͚͓̜̤̰̯͉̭̰̜̣̻̥͎̘̞͙̬̙͖̫͙̙̘̞̯̱̰͓̰͎̻̰͍̩͉͙͎̩̱͈͍̤͔͚̖̟̮̰̙̹̝̳̞̤͖̪̞̜̱̖͍̈́̒̓͊͂͂̔̀̇͊͌̎̏́͌̀́͒̉̽͌̏̊̏̈́̀̈̀̄́̑̄̿̍͌̔͘̚͘͘̕͜͝͝͝͝K̵̨̢̨̡̡̡̢̢̡̡̧̢̡̛̛̛̛̙̞̤̦̞̬̮̯̰̟̼̫̗̠͉̠̠̩̞̺̘̱̩̥̥̜̠͙̠͓̰̖̳̲̬̼̰͙̖̭̦̪̪̣̭̠͔̣̺̣̩̪̱̺͚̣͖̪̺̥͕̲̜̮͔͇̪̹̱̲̝̗͒̽́͐̎̈́́̽̋̽͆͌̄͛́̐́͛̀̎̒͌̈̾͑̄̓͒̓̊̏̈́̐̈́͆̀̋̂̓̄͊̑͆̀̀̃̃̉̓͂̀̓͋̓̈̄͑̒̌͒͛͛͌͌̀͌̊̂̒̊̾͘͘̚͘͘͝͝͝͠ͅǪ̴̢̡̧̨̢̨̡͎̘̬̰̫̳̲̟̖̞̠̤͉͍̘͉̳̤̜̣̫̝̣̯̙͓̯͖̹͚̰̬̤̬͉̩̬̤̮̦̩͍̮͎͙̠͍̞͉̺͇͍̱̮̱̭̺͙̱̗͔͕͕̼̥̫̘̞̜͚̖͚͈͈̤͚̖͉̘̠̦͔͚͇͇̟̜̝̙͕̯͖͈̣͍̙̩̼͑̇̉̇̄̍͂̇͌̀͐̽̿̑̉̀̈́̆͋̆̒́͆́̎͗͆̅̃͒̌́͗̾̈́͌̉͆̓̓̿̓̍̔̎̒́̈̀̎͂̏̈́̈́͐͊̊̕̚͘͜͜͜͜͝W̸̡̧̛̛̖̰̩̱̗̙̰̩̟̻̙͖̩̜̖͕̯̣̗̦̰͇̹̻̥̪̙̖̥͉̗̝͉̺̙̹̜̮̞͕̱̝̫̦̝̒̆̍̓͋͊̇̈́͆͑͐̓̓͊͗͋́̈̈́́͑̄̽̽̑͗̅͌̀̊̒͗̄͛͋̌̀̈́̀͋̀̏̃͑͋̏͌͒̀̐͗͒̂͆́̔̐̓̐͂̉́͛̃͒̍̓̔̍̃̀̌́̉͐̐̑̅̇̾͌̇̋̔͌̀̏̃͊̈́̈́́͂̌̆̌̍̀̀̂͑̈̾̔͒̅͗͆̌̒͗̌̏̐̇̈́̀͌͆͒̿̒̎̔͑͂͛͗́͗̀̚͘͘͘͘̚̚̕̕͘͝͝͝͠͝͠͠͝͠͝͝͝ͅͅͅN̸̨̡̨̧̛̛̖̠̺͉͚̱͕͈̩̯̝̙̼͕͇̱̹͍͙̭̘̪̞͎̙̗̫̳̤̪̦͓͇̠̖͖̪̱̣̯̝͈͖͓̗͎̦̥̱͉̻̪̤̹͈͕̗̞̼̻̺̯̺̣̜̜̳̖͓͖̩͖̞͎̪͎̭̱͖̩̭̼͎̮̫̝̞̬̣̣͔͔͎͛͌͂̔̊͛̇̏̿̈́̃͛̈͂̇̎̈͌̏͒͆̄̈͛͐͂̉̀̇̀̀̓̾̏̍̾͗̋̽́͂̋͛̾̊̿̽͑̄͊̽͐͊̂̽̈́͊̈̿̍͒̀̆̊͊͊̉̇̐̅̉̏̃̃͊͗͛̌͂̿̋̈̅̀͒͆̊̀̀́̚̚̚͜͜͜͜͜͝͝͠͝͝͝͠ͅͅͅͅ";
                $_SESSION['y'] =                                                                                '0̶̢̡̢̢̢̧̢̨̡̢̡̡̧̢̛̛̱͚̣̮̪̗̜̥̣͙̥̦̞͉̙͓̤̫̥̖̣̼̩̝̮̯͚͓͔̖̜̮̱̥͙̤̫̻̬̹̺̗̗͇̻̮̩̠͙̝̹͚̞̬̼̻̦̻̭̤̪̯͙̦̰̮̘͉͇̱̦̹͕̤̩̫̩̟̪̹͈̦͓̫̤͚͔͙̮͉̜͖̮͕̩̥̣̰̝͎̩̯̠̠̳͔͎̠̤̘̖͕͕̺͙̤̗̹̠̣͇̪̻͓͙̩̥͙͈͖́́̃͗̈́̓͌͆̂͆̃̄̊̌͋̉̉̏̔͊̈͒͂̀̊̉̌̑́̅͂͊̌͊̌̉́̓͊̆̈̅̅͑̇̀͛̽͊̊̓̑̐̏̈́̓̌͊̾̐͛̇̏͑̆͛̍̆̈́͒͋̽̏̃̒̏̑̆̆̐̈́̍̽͌̎̂̈̉̑̇́͌̾͊͋͌̔̄̔̓̄̎̌͑́̈́́̓̽̕͘̕̕̕̕͘͜͜͜͝͠͝͝͝͠ͅͅͅ1̸̢̧̡̧̧̡̨̧̛̛̫̣͔̺̘͍̤̪̙͍͈͙̝̜̹͙̪̤̖̤̟̝̮̭̻̭͚̖͕̪̟̝̪̻̖̯͎͇̥̳̼̳̳̰͈̪̮͍̜̻̟͕͖̱̪̯͓̙̬̯̞̣̖̞̩̻͔̝̠̰̟͖̲̲͚̱͈̩͕̼̯̭̘̹͎̲̭̳͇̣͇͍̘͖͍̬̍̐̀̌̅̊̌̀̎̈́̏̌͋̊͒̽́́̿̌̉͊̈́͌͂̽̉͆̒̔̌̈́̊̍́͑͒̉̈́͗͘̕͜͜͝͠͠ͅͅ0̴̢̨̢̢̢̧̨̢̢̡̨̢̧̢̨̡̢̨̢̛̛̛̦̬̣͕͖̯̹̥͕͎̬̲̥̲͚̻͔̲̙͈͍̞̦̻̼̗̣̺͖͚̲͔̣̮̣͚̠̥̠͈̦̬̺̲̟͈̟̖͈̺̳̠̞͕̙̣̺͚͙͉͍̜͈̻̣̞̥̪̲̳̹̪͖̱̺̼̻̝͈̻̙̮͙̪̹̖̭̥̪̘̼̱̯̣͔̦͇̫̯͈͓̥̬̭̣̖̲̹̬̭̬̻̹͕̮͕̍̀̒̄̌̏͂͊́̀̋̒̔̌̎̉͂̏̑̾͛̈́̈́͂̓̾̈̉̈́̒̈́̉̒̀̄̅̽̑͑̈́̊̅͋͌͌̿̂̇̍̽́̓̂̌́̈́͒͊̈́͛̇͐̒̆̀͗̇̃̒̏͋̐̎̐̌̉̉̂́̄̃̄͗̏͌̒̈́͐͌̀̽͋̽̌̔̎̋́̉͊͋̌̈̏̄̈́͋̎̀̆̄̉̒͐͂͆̓͋̄͌̆̃̌̓͊͗͗̐̓̂̐̚̕̚͘̚͜͜͜͝͠͠͠͠͠͠͝͠͠͠ͅͅͅ0̶̢̢̧̢̡̢̡̡̢̧̡̢͓̮̥͖̻̩̻̝̥̺̱͇̦̱̱͙̞͔͕͈̘̟͕̝̬̠̣̼͉͔͖̻͕̦͓͕͇͍̙̪͔͙̞̘̙͚̙͙̭̣̪̰͔͍̣̜̰͖̗̙̯̠͚̼̲͖͓̦͉͖͎͖̫͙͍̣̥̠̦͓̱͎͉̗̘̙̠̙̳͇̱̦̪̱̰͍̘͂͜͜1̶̨̡̢̛̛̭͚̪̳̟̞̭̙͔̤̳͓̘̣̖̜͍̫͓̣̬̙̟̫̳̲̫̜̙̖̈̀̇̾̾̒͆̐͌̋̄̐̀͋͋͂̒͋̓́̽̎̑̑̈͒̒̉̽́̓̀̒̉͂͆̈́͂̈́̒̎̆̎̄͑͒̿̽͋̓̀͐̍̔̌̐͛̉͊̓͊̽́̍̀̀͆̿̒͗͋̐̂̅̌̅͆̋̀́̽̉̅̏͌̃́͂͆̾͑̋́̅͗̐̅̐̋́͂̍̑̔̽̋͋̈́̈̅͑̍́̀̿̿̓̽̆̚͘̚̚͝͝͝͝͠͝͝1̶̡̨̢̡̛̛͚̬͈͉͓̦͎̣̬̫̪̝̣̟͍͖̘̭̝͔͚̺̦̗͖͓̟̮̤͉̯̬̗̞̐͒̃͂́͋̓́̊̈́͐̈́̍̏́̾̓́̀͐́̀̓̈͗̀̒͗̽̑̊̆̔̓̅̀̈̾͂̈́̎̏̑͛̈̽̃̄̽͗͌͗̌͆̀͂̊͂̆̄̕͘̚͝͝ͅͅ1̵̢̧̧̧̧̢̡̢̢̧̛̳̬̼͍̫̖̤̯̝̱͔̙̹͚͎͈̺̦͖̱͚̹̤͍̠̜̱̱̣̼̞͙̫̦̱̰̱̬̩̫͇̜͇̳̰̪̙̪̤̘̘̙̱̺̭̝̮͍͔͈̘̗̺̫̼̱̥̬̫͔̗̟̞̜̗̭͕̗͕̗̞̗͎̫̤̱̘͓́̑̋̏̑̌̅͑̒̿͑̽̒͒͋̊̍̑̆͋̒̀̐̄͂̽͐̎̓̎̊̃͗̾̊͂̿̈́̍͒͆̌́̓̓̊̇́̀̊̌̅̈͌̅͋̋͂͒̌̀͗̕͘͘͜͜͜͝͠͝͝1̴̨̨̨̢̢̨̨̻̘̦̼͈͕̞̻̹̬͙̲̺͉̩̟̼̫̫̖̭̰̱͉̱͎̝̼̝̳̺̠̱̝͎̼̱̻̺̥̹̲̭̻̂̓͗͌̒̓̒̄̐̏͌̔͜͜0̵̢̨̡̡̠̦͍̳̘͇͔̻͇̳̙̙͙̫̭̰̼̳̖͔̙̝͍͔̦̱̲̟͙̻̰̯͔̖̝̰͚͉̼͔̼̺̜̥͉̀̃͆̅͑̒̀̐̎̑̓̇͑̍͛̔̇̌̉̏͐̊̓̆̒̿͒̈́̅̑̈́̅̃͛̓̉̀̽̓́͐̂́̓͐͋̂̒͗̋͗̐͆̇̀̀̽̾̏̀̓̋͊́̒̏͂̾̒̃̽̍̊͗͒̔͌̋̈́̔̽̀̽̈́͌̏̐̏̽́̍̾̈͑̍̀̔̐̈́̀͊̽̇̆̀̒͗͒̈́̋̀̈́͌̿̌́̊́̆̎̈͛̇́̉̾̄͑͘͘̚̚̕̚̕̚͘̕͘̚͜͝͠͝͝͝͝͝͝͠͝';
                $_SESSION['location'] = 'UNKNOWN';
                $location = $_SESSION['location'];
                $_SESSION['money'] =                                                                            '9̵̢̧̨̧̨̢̨̨̡̧̨̢̧̡̧̨̨̧̛̛̛̼͖̳̙̦̟͓̤̤̬̪͓̳̠̦̯͓̮̰͕̩̙̻̺͇͎̙̘̬͓͍̟͓̟̗͉̖̭̜̟͈͔̤̩̺͚̦̘̰̻̙̲̞̼̜̫̗͕̥̙̮̭̖̲̗̙̻̤̹̲̼̩̘̳̦̣̜̣̺̞͎͖̰̤̩̟̗̯̭͕͔͓͍̼̥̩͇̦͓͍̪͚̙̝̭̥̫̞̲̙̟̞̺̯͕̱̲̜͉͉̺͎̱̬̲̼̤̗̹̗̲̤̩̯̞̺̠̘̣̰̖̗̳̦̰̤̗͓̘̺̹͈̗̻͕̜͚̼̭͓̰̹̺̬̤̦̪̣̪͚͚̭̀̿̈́̀́̆͛͋̊̒͆̋̋̾̂́̑̿̽̄͒̀̔̒͊͂͊̏͌̓̽͂̓̏̋̌̌̂̆̈́̈̀̃̌̊̿̅̐̒̍͐̓̇̆͐̋̀̉̌̏̔̂̉͗͌͋̔͂̑͛̉͊̈́̃̆̅̂̑̾́͆̄̅͌̔̍̈́̎̿͒̌͆̿͋̂͌̈́͆̉̔̇̿̉̍̋̎͆̋̄̃̎́́̉͂̇̒͋̉́̎́̍̋̊̑́̒͆̆̍̀̈́̔́͌͆̿͗͐͂͆͊̈̉̌͌͛̉́̈́́̿̄̈́̎̽̓͑͊̉͂̽͐͌͂̎̽́̄̆́͆̌̿̿̌̇̒̑̕̚̕̕̕͘̚͘̕̕̕͜͜͜͜͜͜͜͜͜͜͝͠͠͠͝͝͝͝͠͠ͅͅͅͅ9̷̢̛̹͎̭̩̰̭̮͙̮̖̥̞͙̤͉̝͍̗̝̘̯̬̱̗̲̝͍̠͓̥̞̝̯͈̖̩̲̲̭̰͖̲͚̩͔͇̘̭̗͍̳̬̻̑͒͂͗̉̿̃̔̂́͊̊͌̄͋̃̀̌͊͒̇́͛̉̒̋̑̋̅̅͋̀̎̈̈̈̋̈̅̃͊͐̏̐̍͊̃͛͒̊̍̽̀̃̓̉̑̈́̊̑̉͑͌͒̌̂̽̈́̊̾͆̄̀͊̀̽̏̏̂̏̀̾́̅̃̇̌͊̂̂̿̓̾͆̈́̇̌̾͆̕̚̕̚͘̚̚̕̚̕͘͝͝͝͝͠͝͝͝͝ͅ9̶̨̨̧̨̧̧̡̡̢̧̢̢̧̧̛̛͓̱̱̪̟̤̪͕͉̯̭̲̝͇͉͙͕̮͔̖̠͕̦͚̭̥͚̦̰͖̳̼̻͖̭͍̬̖̦̬̭̞̲̰̹͇̠͖̝͎̹̤͍̼̼͓͕͚̯͔̘͎̦̬͓̹̖̝͇̲̬̯͍̥̜̘̬̗̤͙͖̮͓̭̯̹̤̗̝͚͙̪̩͓̮͍̥̭̤̖̥̫̤̱̙̥̟͍̖̩̠̼̹̯̤͎̮͖̩̪̺͖̱̼̲̬̥͙̖̯̪̘͙͈̜̤̜̖̫̥͍̣̖̰̳̖͇̺͓̳̫̗͎̺̰͉͓͉̣̼̩̭͕̣͕̙͒̆͛̌̀́́̽̈́̿̎̽͑̓͊̉͊̌̌͒̈́̎͋̋̍̃̏̒̓͆̅̇͊̇̌̓̀̽͊͂͒̈́͋̎̓͌͛͌̈̊̐̋͂̇̒̑̎̈́͒̌̿̈͛̿̀̿̈́͊́̄̌̍͌̓̅͊͑͋̏̿͗̃̈̐̓̒̈̄̌̏̿͘͘̕͘̕͜͜͜͜͜͠͝͝͝͠͝͠͠͝͠͝͠͠ͅͅͅͅ9̴̧̨̧̧̢̢̨̨̨̧̡̡̧̛̩͖͖͓̮̫̱̹̻̞̗̠̹̪͚̬͇̱̮͉͎̫̬̖̝̭̠̝̱̙͈̻̳̟̟̗̞̗̹̙̙̺͓̬͓̮̘̱̬͔̰̙̠͎͔͖͓͚̤͕͖͍͍̜̫̩̤̪̜̘̤̘̗̣̯̝̼̩̮͖̭͓̦͉̤̰̬͓̰̜̭̼̪̣̠̌̓̂͑̓̔̽̀́̐̂̈̇̇̈͌̂͌͊̒̓́̃̏͆̃̅̉̆̇̈̔͋̾͑̏̽̔͑̍̇͐̓͑͂̈̀̚͘̚̚̕̕̚͜͜͜͜ͅͅͅͅͅͅ9̷̨̧̨̡̢̛̛̛̛̫͔̬̠̹̟̩̥̟̯̘͚̭͍̭͎̥̥̪̰̫͈̖̻̠̙̙͖̟̟̗̫̟̠̭͍͉͚̼̦͚͖͈̭̬̥̝͇̞̻͓̘̩͓͉̺͇͔̫̝̤͚͓̙̫̻̺͇͙̉̈́̍̌̀͑͋̔̌̎̄̀̋̿̈́̇̾͛̅̑̋̽̿̇͗͗̾̈́͑̄̆̐̽͌̉͛͒͌̇́̓͗͊̌͒̽̓̈́͛̒̃̓̈̈́̇̓̆̀̏̔̅̋̃̒̎́̄̌̈́́͛̐́̓̿̀́͂̾̐̇̉̍̂̇̾͊́̀̐͊͋̀̋͑̎͒͌̇͋́̍̿̂̊̎̂̀̔̂͛̈̐̒̎̒̇́̓̋͐̇̌̏͂̅͗̄̾̌̃̋̏̊̅͌͆̇͛͌̍̎͂̍̌͌͛̉̋̔́̉͆̽͛̽͆̒͑̿̈́͂̇̋̉̈͋͘̕̕̚͘̚͘̕͘̕̕̚̕͘̕͘͜͜͝͠͝͝͝͝͝͠͠ͅ9̸̢̢̨̡̧̡̢̢̢̢̧̛̛͍̤̥̲͙͉̱̦̩̖̗̺̣͉͓̰͚͉̝͍̰̤̮̹̪̺̺̺͔͖̝͔͖̠̲͈͕̻͍̙͖͖̞̝̣̤̠̫͖̻͇̗̳̥͎̯͔͚̱͕̯̖͓̙̰̯̳͓̭̦̗̣̪̥̪̜̲̥̠͚̠̯̤̬̥͈̟͈͍̳̰̟͍̱͍̹̩̟̪͙̼̬͇̞̭͇̘͖͚̫͚̯̬̜̗͍̮̰͖̫̪̆̑͑̎̃͗̓͗̐̽̔̈͌̂̍̒̊́̀̾̑̑͒͑̑̀̏̅͛́̊̎͛̊̽̈́̈́̃̀̈́̈́͗͋̒͑̔̓̑̓́̌̓̊́̇̋̒͂̏̎̾͛̇̐̔̌͆͌̈́̈̇̊̓͆͑̋̉̀̾͋͗̔́͛̊̈̎̏͒̃̽͐̈́̌́̈́͛̂̍̃̾̅̆̉̆͐̈̒͊̈́̽̌͐͂̏̇̒͒͑̀̉͑̾͛͗̄̇̽̔͘̚̚͘̕̕̕͘̚͘͜͜͠͝͠͝͠͝͝͠͝͝͝͝͝͠ͅͅ9̷̢̨̢̧̧̨̨̨̧̡̧̨̨̡̢̢̢̧̨̢̡̧̡̢̡̢̡͈̗͉͖̙͕̠̞̹͈̺̱̪̹̙̭͓̠͔̳̙̳̝̺̮̺̥̖̤͍̪̪̹̲̩̗̼̬̫̪͖̠̪̬͈̝͉̥͕̞͖̳͍̳͓̩̥͇̝̞̝̜͇̲̖͇͎̥̻̦̣̱̖̙͇̞̰̗̺̻͈̭͎͎̼͔̪̤̩̙̖͇͙͇̞̞̙̲̙̯̣̱͙͍͉͍̠̣͕͙̲̝̣̖̜̯̞̮̹̻͚̲̙̮̥͙̭̞͉̪͕̖͓̱̺͇̼̲̬̩̮̗̞̲͕̜̪̺͚̹̩̥̖̙͔̱̲̹̞̹̪̥̹̗̞̰͔̹͔̻̱͙̪͕̪̞̯̟̭͈͔͙̞̮̖͍̺͚̲̺̲̟̖̝̜͇͙͎͕̲̦̰̟̰͔̥̣̗͎̪͓̖̮̞̪̥̦̤̻̥̮̹͓̘̘̹͔͉̜̖̖͔̬̳͙̝͍̦̤̲̋͐̅̾͊͋̈̃̉̍͐͛̈́͑̄̌̑̽̊̆͆͑̀̊̐̀̌̊̓̅͂̐̚̕͜͜͜͜ͅͅͅ9̷̧̢̧̢̡̢̧̡̧̡̢̨̡̢̛̛̛̛̛̛̦̜͚̮͚̤̺͔̭͇͓̫̜̜͈̼͓̲͈̬͖͉̠͙̣͖͔͚̮͖̝̬͇̤̫͔̗̮͍̦̙̘̳̞̥͓̯̻̣̺̥̬͈̖̩̩̮̠̙̬̺͔͎̦̻̼̰͈̻̪̖̥̗͎̥̜̝̞̩̠̺̜̤͎̟̞̜͓̣͖͚̻̞̞̳͕̤̜͙͙̲̖̝̠̮͕̰̥͈̫̥͙̻͙̘̲͇̥̜͖̯͈̫̜̤̫̟͔̯͚̜̱͚͉͚̥͚̜̥͖͓̺̥̝̫̦̫͔̙̹̳͉̘̪̼̼̣̙̞͎͈̺̯̭̱̻͕̪͈̪͓̭͉͙͎̞̹̤̘͕̫͓̪̟͍͓̻̮̪̼̪͕̻͉̖̣͙̱̖̳͖̜̠̺̹̗̭̃͋̄̽͐̇̾̀̀̏̍̈́͋̍͐̽̾̇̓͌͑̀̃͐̋̍́̊̊̈́́͂́̋̐̄̊̒̌͑̌͐̆̉̈̂̎͊̇̐͋͂̓̀̈̇̂̀̑̏̀͑̌͆̇̿̈́̊͂̒̊̋͒͆͑̃̾͊̀̀͐̒̎̊̿̆͑͆̃̏̿̒̂̈́̋̈́̍͂̇́͛̉̋̌͂̐̎̎̽̇̒̈́͌̄͌͒̇͛̈́̅̿̃̎̆̿́̈̀͐̄̊͆́̉̆̓̈́̈́̄̃̊̐́̒̍͑͆́̄̈́̈́̓́̒́̊̈́͆̂͗̑̇̑̈̃̂̀͑̀̌͒̿̂̽̐̈́͗̓̆́̌̓̒͆̀͌̅͛͑̃̈́̊́͑̓̃̍́̈́̍̂͑̓̍̒͑̌͒̎́̓̈́͊͗͛̎̄́̍̎̍̍̊̾̄͋̾͋̑͒̇̓͋̌̈́̽͆̕̕̚͘̚͘͘͘̚͘̚͘͘͘̕͘͘̕̕͘͘̕̕̚͘͘͜͜͝͠͝͝͠͠͠͠͝͠͝͝͝͝͠͝ͅͅͅͅ';
                array_push($event, 20);
                array_push($event, 98);
            } else 
            if($x == 5 and $y == 4 and in_array('gravitycloak', $equipped)){
                $_SESSION['x'] =  '∞';
                $_SESSION['y'] =    '∞';               
                $_SESSION['location'] = 'Ascended plains';
                $location = $_SESSION['location'];
                $_SESSION['money'] =  '∞';           
                array_push($event, 27);
                array_push($event, 99);
            }
            if($x == 5 and $y == 3 and !in_array('applecloak', $equipped)){
                array_push($msg, 'You must be wearing the applecloak to fight gravity worm');
            }
        } else 
        if($input == 'look window' and $x == 0 and $y == 1){
            array_push($msg, "You look through the window");
            array_push($msg, "You can see Cathedral Lapp standing there, he is covered in blood and surrounded by bodies");
            array_push($msg, "You never thought you'd see someone as legendary as him, you feel honored");
            array_push($msg, '&nbsp;');
        } else
        if($input == 'silence my brother' and !in_array('Achievement', $inv) and $x == 0 and $y == 2){
            array_push($inv, 'Achievement');
            array_push($msg, "Achievement unlocked");
            array_push($msg, '&nbsp;');
        } else
        if($input == 'open chest'){
            if($x = 7 and $y = 1){
            array_push($msg, "The chest flings open revealing a large set of teeth and a tongue");
            array_push($msg, "The chest grabs you and shoves you into its mouth");
            array_push($msg, "You have been eaten by the mimic");
            array_push($msg, '&nbsp;');
            $_SESSION['health'] = 0;
            } else {
                array_push($msg, 'There is not chest');
                array_push($msg, '&nbsp;');
            }
        } else 
        if($input == 'attack chest'){
            if($x = 7 and $y = 1){
                if(!in_array(13, $event) and !in_array(14, $event)){
                    array_push($event, '13');
                    array_push($msg, 'The mimic stands up, it looks down on you, there is no escaping you must stand and fight');
                    array_push($msg, '&nbsp;');
                }
            }
        } else
        if($input == 'flee' or $input == 'run'){
            $rand = rand(1, 10);
            if($rand < 10){
                array_push($msg, 'You flee the battle');
                array_push($msg, '&nbsp;');
                $_SESSION['encounter'] = 0;
                include('dmg.php');
            } else {
                array_push($msg, 'You failed to flee the battle');
                array_push($msg, '&nbsp;');
                include('dmg.php');
            }
        } else 
        if($word == 'rape'){
            if($words != ''){
                array_push($msg, "I don't know why you would want to rape $words");
                array_push($msg, '&nbsp;');
                include('dmg.php');
            } 
        } else 
        if($input == 'cry'){
            $_SESSION['depression'] += 1;
            array_push($msg, 'You start crying');
            array_push($msg, '&nbsp;');
            if(in_array(5, $event) or in_array(9, $event) or in_array(10, $event)){
                array_push($msg, 'The monster feels bad for you, you gained 1 worm');
                array_push($event, 11);
                $_SESSION['money'] += 1;
            }
        } else
        if($input == 'wait'){
            array_push($msg, "You wait in search of monsters");
            array_push($msg, '&nbsp;');
            if(in_array('gravitycloak', $equipped)){
                $_SESSION['encounter'] = rand(6, 8); 
                include('dmg.php');
            } else {
                $_SESSION['encounter'] = rand(4, 5);
                include('dmg.php');
            }
        } else
        if($input == "jump off railing" or $input == 'jump into void' or $input == 'jump over railing' or $input == 'jump railing'){
            if($_SESSION['location'] == 'hall of hallucinations'){
                array_push($msg, 'You jump into the void and never see anything again');
                array_push($msg, '&nbsp;');
                $_SESSION['health'] = 0;
                array_push($event, 'l'); 
            } else {
                array_push($msg, 'There is no place to jump');
                array_push($msg, '&nbsp;');
            }
        } else
        if($input == 'kill self'){
            $_SESSION['depression'] += 5;
            if($_SESSION['depression'] < 5){
            array_push($msg, 'You have the will to live');
            array_push($msg, '&nbsp;');
            } else
            if($_SESSION['depression'] < 10){
                array_push($msg, 'You are depressed');
                array_push($msg, '&nbsp;');
                } else
            
            array_push($event, 'l');
        } else 
        if($input == 'open vent' or $input =='use crowbar'){
            if(in_array('crowbar', $inv) or in_array('crowbar', $equipped)){
                if($x =='5' and $y =='0' ){
                    if(!in_array(1, $event)){
                        array_push($event, '1');
                        include('location.php');
                        array_push($msg, "The vent gives way allowing you to crawl through it");
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, "You have already opened the vent"); 
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
                } else {
                    array_push($msg, "I don't know what you want me to do");
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                    include('dmg.php');
                    
                }
            } else {
                array_push($msg, "> I don't have the right tools for this");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }
        } else
            if($input == 'hit painting' or $input =='use axe' or $input == 'use crowbar' or $input =='touch painting'){
                if(in_array('crowbar', $inv) or in_array('crowbar', $equipped) or in_array('axe', $equipped) or in_array('axe', $inv)){
                    if($x =='1' and $y =='3' ){
                        if(!in_array(2, $event)){
                            array_push($event, '2');
                            include('location.php');
                            array_push($msg, "The painting collapses in on itself revealing a hidden doorway");
                            array_push($msg, '&nbsp;');
                        } else {
                            array_push($msg, "The painting has already been destroyed ");
                            array_push($msg, '&nbsp;');
                            array_push($event, 'l');
                        }
                    } else {
                        array_push($msg, "I don't know what you want me to do");
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
            } else {
                    array_push($msg, "> I don't have the right tools for this ");
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                    include('dmg.php');
                    
                }
        } else
        if($input == 'open door' or $input =='use keys' or $input =='unlock door'){
            if($x =='2' and $y =='1' ){
                if(in_array('keys', $inv) or in_array('keys', $equipped)){
                    if(!in_array(3, $event)){
                        array_push($event, '3');
                        include('location.php');
                        array_push($msg, "> The door unlocks allowing you to progress");
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, "The door is already unlocked ");
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
                } else {
                    array_push($msg, "> I don't have the keys ");
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                }
        } else 
            if($x =='1' and $y =='4' ){
                if(in_array('keys', $inv) or in_array('keys', $equipped)){
                    if(!in_array(15, $event)){
                        array_push($event, '15');
                        include('location.php');
                        array_push($msg, "> The door unlocks allowing you to progress");
                        array_push($msg, '&nbsp;');
                    } else {
                        array_push($msg, "The door is already unlocked ");
                        array_push($msg, '&nbsp;');
                        array_push($event, 'l');
                    }
                } else {
                    array_push($msg, "> I don't have the keys ");
                    array_push($msg, '&nbsp;');
                    array_push($event, 'l');
                }
            } else
            if($x =='2' and $y =='4' ){
                array_push($msg, 'You cannot unlock the door from this side');
            }
            if(($x != 1 and $y != 4) and ($x != 2 and $y != 1)){
                array_push($msg, "There is no door to unlock");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
                include('dmg.php');
            }
    } else
    if($input == 'use bloodvial' or $input == 'drink blood'){
        if(in_array('bloodvial', $inv)){
            foreach($inv as $key => $value){
                if($value == 'bloodvial'){
                    $inv[$key] = 'vial';
                }
            }
            $_SESSION['counter'] += 1;
            $counter = $_SESSION['counter'];
            array_push($msg, 'You drink the blood, it give you 50 hp!');
            array_push($msg, '&nbsp;');
            $_SESSION['health'] += 50;
        } else {
            array_push($msg, 'You do not have blood');
            array_push($msg, '&nbsp;');
        }
    } else
    if($input == 'heal' or $input == 'use apple juice' or $input == 'drink apple juice'){
        if(in_array('apple juice', $inv)){
            foreach($inv as $key => $value){
                if($value == 'apple juice'){
                    unset($inv[$key]);
                }
            }
            array_push($msg, 'You drink the juice, it give you 75 hp!');
            array_push($msg, '&nbsp;');
            $_SESSION['health'] += 75;
        } else {
            array_push($msg, 'You do not have apple juice');
            array_push($msg, '&nbsp;');
        }
    } else
    if($input == 'fill vial' or $input == 'collect blood' or $input == 'take blood'){
        if(in_array('vial', $inv) and $item == 'fill'){
            foreach($inv as $key => $value){
                if($value == 'vial'){
                    $inv[$key] = 'bloodvial';
                }
            }
            array_push($msg, 'You fill the vial with blood');
            array_push($msg, '&nbsp;');
        }
    } else
        //up and down stairs
        if($input == 'go down' or $input =='descend' or $input == 'descend stairs'){
            if($x == '1' and $y == '0'){
                $_SESSION['x'] = 0;
                $_SESSION['y'] = 3;
                include('location.php');
                array_push($msg, "You have descended ");
                array_push($msg, $room);
                array_push($msg, '&nbsp;');
                include('dmg.php');
                
            } else {
                array_push($msg, 'There is nowhere to descend');
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }
        } else
        if($input == 'go up' or$input == 'ascend' or $input == 'ascend stairs' or $input =='climb stiars'){
            if($x == '0' and $y == '3'){
                $_SESSION['x'] = 1;
                $_SESSION['y'] = 0;
                include('location.php');
                array_push($msg, "You have ascended ");
                array_push($msg, $room);
                array_push($msg, '&nbsp;');
                include('dmg.php');
                
            }  else {
                array_push($msg, 'There is nowhere to ascend');
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }
        } else
        //talk
        if($input == 'talk' or $input =='speak' or $input =='talk to person' or $input =='talk person' or $input =='shout' or $input =='speak person'){
            if($person == 1){
                array_push($msg, $talk);
                array_push($msg, $talk1);
                array_push($msg, $talk2);
                array_push($msg, $talk3);
                array_push($msg, '&nbsp;');
            } else {
                array_push($msg, 'You shout out asking for anyone... there is no answer ');
                array_push($msg, '&nbsp;');
            }
        } else
//clear the text area
        if($input =='clear'){
            $msg = array();
            array_push($msg, " History has been cleared ");
            array_push($msg, '&nbsp;');
            array_push($event, 'l');
        } else
        if($input ==''){
            array_push($msg, "Please input a command ");
            array_push($msg, '&nbsp;');
        } else  {
            if($input != 'attack' and $input != 'attack creature' and $input != 'attack worm' and $input != 'yes' and $input != 'no' and $input != 'save' and $input != 'save game'){
                array_push($msg, "Unkown command<b> $input</b>");
                array_push($msg, '&nbsp;');
                array_push($event, 'l');
            }
        } 
        include("plannedencounter.php"); 
        
    }    
$x = $_SESSION['x'];
$y  = $_SESSION['y'];
if($x == 1 and $y == 1){
    $_SESSION['encounter'] = 8;
}
if($x == 4 and $y == 4){
    $_SESSION['encounter'] = 8;
}
if($x == 4 and $y == 3){
    $_SESSION['encounter'] = 8;
}
    if($_SESSION['encounter'] == 5){
        if($input == 'attack' or $input =='attack creature' or $input == 'attack worm'){
            $rand = rand(1, 5);
            if(in_array('crowbar', $equipped)){
                if($rand < 3){
                    array_push($msg, 'You swing the crowbar crushing the worm ');
                    array_push($msg, '&nbsp;');
                    $_SESSION['encounter'] = 0;
                    $_SESSION['encounterhp'] = 0;
                } else
                if($rand <= 4){
                    array_push($msg, 'You swing the crowbar and hit the creature ');
                    array_push($msg, 'It is surprisingly strong');
                    array_push($msg, '&nbsp;');
                    $_SESSION['encounterhp'] -= 1;
                } else 
                if($rand == 5){
                    array_push($msg, 'You swing the crowbar ');
                    array_push($msg, 'You missed');
                    array_push($msg, '&nbsp;');
                }
            } else
            if(in_array('axe', $equipped)){
                if($rand < 3){
                    array_push($msg, 'You swing the axe chopping the worm in 2 ');
                    array_push($msg, '&nbsp;');
                    $_SESSION['encounter'] = 0;
                    $_SESSION['encounterhp'] = 0;
                } else
                if($rand <= 4){
                    array_push($msg, 'You swing the axe and hit the creature ');
                    array_push($msg, 'It is surprisingly strong');
                    array_push($msg, '&nbsp;');
                    $_SESSION['encounterhp'] -= 2;
                } else 
                if($rand == 5){
                    array_push($msg, 'You swing the axe ');
                    array_push($msg, 'You missed');
                    array_push($msg, '&nbsp;');
                }
            } else
            if(in_array('keys', $equipped)){
                if($rand < 2){
                    array_push($msg, 'You stab with the keys impaling the worm ');
                    array_push($msg, '&nbsp;');
                    $_SESSION['encounter'] = 0;
                    $_SESSION['encounterhp'] = 0;
                } else
                if($rand <= 3){
                    array_push($msg, 'You stab with the keys and injure the creature ');
                    array_push($msg, 'It is surprisingly strong');
                    array_push($msg, '&nbsp;');
                    $_SESSION['encounterhp'] -= 1;
                } else 
                if($rand <= 5){
                    array_push($msg, 'You stab with the keys ');
                    array_push($msg, 'You missed');
                    array_push($msg, '&nbsp;');
                }
            } else {
                if($rand == 1){
                    array_push($msg, 'You stomp on the worm crushing it ');
                    array_push($msg, '&nbsp;');
                    $_SESSION['encounterhp'] = 0;
                    $_SESSION['encounter'] = 0;
                } else
                if($rand <= 3){
                    array_push($msg, 'You kick the worm');
                    array_push($msg, 'It is surprisingly tough ');
                    array_push($msg, '&nbsp;');
                    $_SESSION['encounterhp'] -= 1;
                } else 
                if($rand <= 5){
                    array_push($msg, 'You swing your fist at the worm ');
                    array_push($msg, 'You missed');
                    array_push($msg, '&nbsp;');
                }
            }
            
        }
        if(!in_array(9, $event) and $_SESSION['encounter'] == 5){
            $_SESSION['encounterhp'] = rand(2, 4);
        }
        if($_SESSION['encounterhp'] <= 0){
            array_push($msg, '<b> The worm creature dies </b>');
            array_push($msg, '&nbsp;');
            $_SESSION['money'] += 1;
            $_SESSION['encounter'] = 0;
            foreach($event as $key => $value){
                if($value == 9){
                    unset($event[$key]);
                }
            }
        }
        if(in_array(9, $event)){
            $rand = rand(1, 6);
            if($rand < 6){
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                if(in_array(11, $event)){
                } else {
                    array_push($msg, 'The creature bites you'); 
                    array_push($msg, '&nbsp;');
                }  
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                    array_push($msg, '&nbsp;');
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(5, 20);
                        $_SESSION['health'] -= $dmg;  
                        array_push($msg, 'You take '.$dmg.' damage');
                        array_push($msg, '&nbsp;');
                    }  
                }
            } else {
                array_push($msg, 'The creature fails to bite you');
                array_push($msg, '&nbsp;');
            } 
        }
    if(!in_array(9, $event) and $_SESSION['encounter'] == 5){
        $_SESSION['encounterhp'] = rand(2, 4);
        array_push($msg, '<b>A strange worm creature with fangs attacks you!</b>');
        array_push($msg, '&nbsp;');
        array_push($event, 9);

    }
} else 
if($_SESSION['encounter'] == 6){
    if($input == 'attack' or $input =='attack creature' or $input == 'attack worm'){
        $rand = rand(1, 5);
        if(in_array('crowbar', $equipped)){
            if($rand < 3){
                array_push($msg, 'You swing the crowbar crushing the worm ');
                array_push($msg, '&nbsp;');
                $_SESSION['encounter'] = 0;
                $_SESSION['encounterhp'] = 0;
            } else
            if($rand <= 4){
                array_push($msg, 'You swing the crowbar and hit the creature ');
                array_push($msg, 'It is surprisingly strong');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] -= 1;
            } else 
            if($rand == 5){
                array_push($msg, 'You swing the crowbar ');
                array_push($msg, 'You missed');
                array_push($msg, '&nbsp;');
            }
        } else
        if(in_array('axe', $equipped)){
            if($rand < 3){
                array_push($msg, 'You swing the axe chopping the worm in 2 ');
                array_push($msg, '&nbsp;');
                $_SESSION['encounter'] = 0;
                $_SESSION['encounterhp'] = 0;
            } else
            if($rand <= 4){
                array_push($msg, 'You swing the axe and hit the creature ');
                array_push($msg, 'It is surprisingly strong');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] -= 2;
            } else 
            if($rand == 5){
                array_push($msg, 'You swing the axe ');
                array_push($msg, 'You missed');
                array_push($msg, '&nbsp;');
            }
        } else
        if(in_array('keys', $equipped)){
            if($rand < 2){
                array_push($msg, 'You stab with the keys impaling the worm ');
                array_push($msg, '&nbsp;');
                $_SESSION['encounter'] = 0;
                $_SESSION['encounterhp'] = 0;
            } else
            if($rand <= 3){
                array_push($msg, 'You stab with the keys and injure the creature ');
                array_push($msg, 'It is surprisingly strong');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] -= 1;
            } else 
            if($rand <= 5){
                array_push($msg, 'You stab with the keys ');
                array_push($msg, 'You missed');
                array_push($msg, '&nbsp;');
            }
        } else {
            if($rand == 1){
                array_push($msg, 'You stomp on the worm crushing it ');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] = 0;
                $_SESSION['encounter'] = 0;
            } else
            if($rand <= 3){
                array_push($msg, 'You kick the worm ');
                array_push($msg, 'It is surprisingly tough ');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] -= 1;
            } else 
            if($rand <= 5){
                array_push($msg, 'You swing your fist at the worm ');
                array_push($msg, 'You missed ');
                array_push($msg, '&nbsp;');
            }
        }
        
    }
    if(!in_array(10, $event) and $_SESSION['encounter'] == 6){
        $_SESSION['encounterhp'] = rand(2, 4);
    }
    if($_SESSION['encounterhp'] <= 0){
        array_push($msg, '<b> The worm creature dies </b>');
        array_push($msg, '&nbsp;');
        $_SESSION['money'] += 1;
        $_SESSION['encounter'] = 0;
        foreach($event as $key => $value){
            if($value == 10){
                unset($event[$key]);
            }
        }
    }
    if(in_array(10, $event)){
        $rand = rand(1, 6);
        if($rand < 6){
            if(in_array('shield', $equipped)){
                $rand1 = rand(1, 6);
            } else {
                $rand1 = 6;
            } 
            if(in_array(11, $event)){
            } else {
                array_push($msg, 'The creature bites you');
                array_push($msg, '&nbsp;'); 
            }  
            if($rand1 <= 2){
                array_push($msg, "Your shield protects you from all damage");
                array_push($msg, '&nbsp;');
            } else {
                if(in_array(11, $event)){
                } else {
                    $dmg = rand(20, 50);
                    $_SESSION['health'] -= $dmg;  
                    array_push($msg, 'You take '.$dmg.' damage');
                    array_push($msg, '&nbsp;');
                }  
            }
        } else {
            array_push($msg, 'The creature fails to bite you');
            array_push($msg, '&nbsp;');
        } 
    }
if(!in_array(10, $event) and $_SESSION['encounter'] == 6){
    $_SESSION['encounterhp'] = rand(4, 7);
    array_push($msg, '<b>An  Apple Worm henchman attacks you!</b>');
    array_push($msg, '&nbsp;');
    array_push($event, 10);

}
} else 
//
if($_SESSION['encounter'] == 7){
    if($input == 'attack' or $input =='attack creature' or $input == 'attack worm'){
        $rand = rand(1, 5);
        if(in_array('crowbar', $equipped)){
            if($rand < 3){
                array_push($msg, 'You swing the crowbar crushing the Annelid');
                array_push($msg, '&nbsp;');
                $_SESSION['encounter'] = 0;
                $_SESSION['encounterhp'] = 0;
            } else
            if($rand <= 4){
                array_push($msg, 'You swing the crowbar and hit the creature');
                array_push($msg, 'It is surprisingly strong');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] -= 1;
            } else 
            if($rand == 5){
                array_push($msg, 'You swing the crowbar');
                array_push($msg, 'You missed');
                array_push($msg, '&nbsp;');
            }
        } else
        if(in_array('axe', $equipped)){
            if($rand < 3){
                array_push($msg, 'You swing the axe chopping the Annelid in 2');
                array_push($msg, '&nbsp;');
                $_SESSION['encounter'] = 0;
                $_SESSION['encounterhp'] = 0;
            } else
            if($rand <= 4){
                array_push($msg, 'You swing the axe and hit the creature');
                array_push($msg, 'It is surprisingly strong');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] -= 2;
            } else 
            if($rand == 5){
                array_push($msg, 'You swing the axe');
                array_push($msg, 'You missed');
                array_push($msg, '&nbsp;');
            }
        } else
        if(in_array('keys', $equipped)){
            if($rand < 2){
                array_push($msg, 'You stab with the keys impaling the Annelid');
                array_push($msg, '&nbsp;');
                $_SESSION['encounter'] = 0;
                $_SESSION['encounterhp'] = 0;
            } else
            if($rand <= 3){
                array_push($msg, 'You stab with the keys and injure the creature');
                array_push($msg, 'It is surprisingly strong');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] -= 1;
            } else 
            if($rand <= 5){
                array_push($msg, 'You stab with the keys');
                array_push($msg, 'You missed');
                array_push($msg, '&nbsp;');
            }
        } else {
            if($rand == 1){
                array_push($msg, 'You stomp on the Annelid crushing it');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] = 0;
                $_SESSION['encounter'] = 0;
            } else
            if($rand <= 3){
                array_push($msg, 'You kick the worm');
                array_push($msg, 'It is surprisingly tough');
                array_push($msg, '&nbsp;');
                $_SESSION['encounterhp'] -= 1;
            } else 
            if($rand <= 5){
                array_push($msg, 'You swing your fist at the worm');
                array_push($msg, 'You missed');
                array_push($msg, '&nbsp;');
            }
        }
        
    }
    if(!in_array(12, $event) and $_SESSION['encounter'] == 7){
        $_SESSION['encounterhp'] = rand(2, 4);
    }
    if($_SESSION['encounterhp'] <= 0){
        array_push($msg, '<b> The Annelid dies </b> ');
        array_push($msg, '&nbsp;');
        $_SESSION['money'] += 1;
        $_SESSION['encounter'] = 0;
        foreach($event as $key => $value){
            if($value == 12){
                unset($event[$key]);
            }
        }
    }
    if(in_array(12, $event)){
        $rand = rand(1, 6);
        if($rand < 6){
            if(in_array('shield', $equipped)){
                $rand1 = rand(1, 6);
            } else {
                $rand1 = 6;
            } 
            if(in_array(11, $event)){
            } else {
                array_push($msg, 'The creature bites you '); 
                array_push($msg, '&nbsp;');
            }  
            if($rand1 <= 2){
                array_push($msg, "Your shield protects you from all damage ");
                array_push($msg, '&nbsp;');
            } else {
                if(in_array(11, $event)){
                } else {
                    $dmg = rand(30, 65);
                    $_SESSION['health'] -= $dmg;  
                    array_push($msg, 'You take '.$dmg.' damage');
                    array_push($msg, '&nbsp;');
                }  
            }
        } else {
            array_push($msg, 'The creature fails to bite you ');
            array_push($msg, '&nbsp;');
        } 
    }
if(!in_array(12, $event) and $_SESSION['encounter'] == 7){
    $_SESSION['encounterhp'] = rand(3, 5);
    array_push($msg, '<b>An Annelid attacks you!</b> ');
    array_push($msg, '&nbsp;');
    array_push($event, 12);

}
} else 
//
if($_SESSION['encounter'] != 5){
    foreach($event as $key => $value){
        if($value == 9){
            unset($event[$key]);
        }
    }
}
if($_SESSION['encounter'] != 6){
    foreach($event as $key => $value){
        if($value == 10){
            unset($event[$key]);
        }
    }
}
if(in_array(11, $event)){
    foreach($event as $key => $value){
        if($value == 11){
            unset($event[$key]);
        }
    }
}
if($_SESSION['encounter'] != 7){
    foreach($event as $key => $value){
        if($value == 12){
            unset($event[$key]);
        }
    }
}
if($_SESSION['depression'] >= 10){
    $_SESSION['depression'] = 0;
    $_SESSION['counter'] = 0;
    $_SESSION['encounter'] = 0;
    $_SESSION['money'] = 0;
    $_SESSION['x'] = 6;
    $_SESSION['y'] = 1;
    $_SESSION['health'] = 100;
    $_SESSION['maxhp'] = 100;
    $x = $_SESSION['x'];
    $y  = $_SESSION['y'];
    $username = $_SESSION['rottogram_user'];
    $health  = $_SESSION['health'];
    $money = $_SESSION['money'];
    $maxhp = $_SESSION['maxhp'];
    $inv = array();
    $msg = array();
    $event = array();
    $equipped = array();
    $_SESSION['equipped'] = implode(',', $equipped);
    $_SESSION['inventory'] = implode(',', $inv);
    $_SESSION['event'] = implode(',', $event);
    $inventory = $_SESSION['inventory'];
    $equippedstuff = $_SESSION['equipped'];
    $events = $_SESSION['event'];
    $query = "UPDATE `users` SET `x` = '$x', `y` = '$y', `health` = '$health', `maxhp` = '$maxhp', `inventory` = '$inventory', `event` = '$events', `equipped` = '$equippedstuff', `money` = '$money'  WHERE `users`.`username` = '$username';";
    mysqli_query($dbc, $query) or DIE('trouble saving');
    array_push($msg, 'You gained massive depression');
    array_push($msg, 'You lose the will to live');
    array_push($msg, 'YOU DIED');
    array_push($msg, 'Game restarted');
    array_push($msg, '&nbsp;');
}
        if($_SESSION['location'] == 'Basement' and !in_array('lamp', $equipped)){
        $dmg = rand(25, 50);
        $rand = rand(1, 5);
        $_SESSION['health'] -= $dmg;
        if($rand == 1){
            array_push($msg, 'Nuzzles and wuzzles your chest ');
            array_push($msg, '&nbsp;');
        }
        if($rand == 2){
            array_push($msg, 'You hear a whisper in your ear ');
            array_push($msg, '&nbsp;');
        }
        if($rand == 3){
            array_push($msg, 'You feel someone breathing down your neck ');
            array_push($msg, '&nbsp;');
        }
        if($rand == 4){
            array_push($msg, '~murr~ hehe ');
            array_push($msg, '&nbsp;');
        }
        if($rand == 6){
            array_push($msg, 'x3 Something pounces on you ');
            array_push($msg, '&nbsp;');
        }
    }
    if(in_array("shellys love", $inv) and $_SESSION['health'] < $_SESSION['maxhp'] and $input != '' and !in_array('l', $event)){
        $randm = rand(1, 5);
        $_SESSION['health'] += $randm;
        array_push($msg, "shellys love keeps you warm, it heals you $randm hp ");
        array_push($msg, '&nbsp;');
    }
    if($counter > 3){
        array_push($msg, 'You cannot drink anymore blood, you start to throw up');
        array_push($msg, '&nbsp;');
        $dmg = rand(50,100);
        $_SESSION['health'] -= $dmg;
        $_SESSION['counter'] = 3;
    }
    $maxhp = $_SESSION['maxhp'];
    if($_SESSION['health'] > $maxhp){
        $_SESSION['health'] = $maxhp;
        array_push($msg, 'You cannot have more than '.$maxhp. 'hp');
    }
    foreach($event as $key => $value){
        if($value == 'l'){
            unset($event[$key]);
        }
    }
    if($_SESSION['health'] <= 0){
        $query = "SELECT * FROM users WHERE username = '$username'";
                $result = mysqli_query($dbc, $query) or DIE ('error querying');   
                while ($row = mysqli_fetch_array($result)){
                    $x = $row['x'];
                    $y  = $row['y'];
                    $health  = $row['health'];
                    $maxhp = $row['maxhp'];
                    $inventory= $row['inventory'];
                    $event= $row['event'];
                    $equipped= $row['equipped'];
                    $money = $row['money'];
                }
                $_SESSION['monster'] = 0;
                $_SESSION['depression'] = 0;
                $_SESSION['money'] = $money;
                $_SESSION['encounter'] = 0;
                $_SESSION['rottogram_user'] = $username;
                $_SESSION['x'] = $x;
                $_SESSION['y'] = $y;
                $_SESSION['health'] = $health;
                $_SESSION['maxhp'] = $maxhp;
                $_SESSION['inventory'] = $inventory;
                $_SESSION['event'] = $event;
                $_SESSION['equipped'] = $equipped;
                $equipped = explode(',', $_SESSION['equipped']);
                $inv = explode(',', $_SESSION['inventory']);
                $event = explode(',', $_SESSION['event']);
                array_push($msg, 'YOU DIED');
                array_push($msg, 'Game loaded from previous save');
                array_push($msg, '&nbsp;');
    }
   
    include('location.php');
    $_SESSION['equipped'] = implode(',', $equipped);
    $_SESSION['inventory'] = implode(',', $inv);
    $_SESSION['event'] = implode(',', $event);

    echo  $_SESSION['event'];
    $inventory = $_SESSION['inventory'];
    $x = $_SESSION['x'];
    $y  = $_SESSION['y'];
    $health  = $_SESSION['health'];
    $event= $_SESSION['event'];
    $equipped= $_SESSION['equipped'];
    $money = $_SESSION['money'];

    echo "<div id='flowbox'; style ='overflow-y:scroll; overflow-x:scroll;'>";
    if(!empty($msg)){
        if(count($msg) > 22){
            $count = count($msg);
            for($x = $count; $x > 22; $x--){
            array_shift($msg);
            }
        }
        foreach($msg as $key){
            echo $key . "<br>";
        } 

    }
    
    } else {
        header("location: login.php");
}
echo '</div>';
$_SESSION['msg'] = implode("^$^", $msg);
require("style.php");


?>
<script>
var objDiv = document.getElementById("flowbox");
objDiv.scrollTop = objDiv.scrollHeight;
</script>