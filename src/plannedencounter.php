<?php   
    if(in_array(18, $event)){
        if($input == 'yes' or $input =='y'){
            array_push($event, 'l');
            array_push($msg, '> You rush out from the illusion wall');
            array_push($msg, '> You land a critical strike in the monsters head');
            array_push($msg, '> The monster dies');
            array_push($event, 17);
            $_SESSION['monster'] = 0;
            $_SESSION['counter'] = 0;
            if(in_array('16', $event)){
                foreach($event as $key => $value){
                    if($value =='16'){
                        unset($event[$key]);
                    }
                    if($value =='18'){
                        unset($event[$key]);
                    }
                }
            }
            $_SESSION['x'] += 1;
        } else
        if($input == 'no'){
            array_push($event, 'l');
            array_push($msg, 'You do nothing');
            foreach($event as $key => $value){
                if($value =='18'){
                    unset($event[$key]);
                }
            }
        }
        if($input != 'yes' or $input != 'y'){
            foreach($event as $key => $value){
                if($value =='18'){
                    unset($event[$key]);
                }
            }
        }
    }

//lamp protector
        if(in_array(5, $event) and !in_array(6, $event)){
            if(in_array('8', $event)){
                if($input == 'yes' or $input =='y'){
                    array_push($event, 'l');
                    array_push($msg, '<b>With a final swing you finish off the creature</b>');
                    array_push($event, 6);
                    $_SESSION['monster'] = 0;
                    $_SESSION['counter'] = 0;
                    if(in_array('5', $event)){
                        foreach($event as $key => $value){
                            if($value =='5'){
                                unset($event[$key]);
                            }
                            if($value =='8'){
                                unset($event[$key]);
                            }
                        }
                    }
                } else
                if($input == 'no'){
                    array_push($event, 'l');
                    $dmg = rand(45, 160);
                    array_push($msg, 'You decide to spare the monster');
                    array_push($msg, 'The monster quickly claws the weapon out of your hand');
                    $_SESSION['health'] -= $dmg;
                    if(in_array('axe', $equipped) or in_array('crowbar', $equipped) or in_array('keys', $equipped) or in_array('vial', $equipped)){
                        foreach($equipped as $key => $value){
                            if($value == 'axe' or $value == 'crowbar' or $value == 'keys' or $value == 'vial'){
                                unset($equipped[$key]);
                            }
    
                        }
                        foreach($event as $key => $value){
                            if($value =='8'){
                                unset($event[$key]);
                            }
                        }
                    }
                    
                }
            } else
            if($input == 'attack' or $input == 'attack monster'){
                if(in_array('axe', $equipped)){
                    $rand = rand(1, 15);
                    array_push($msg, '> You swing with the axe');
                    if($rand <= 3){
                        array_push($msg, '> You land a direct hit with the axe!');
                        array_push($msg, 'The monster is taken by suprise and false backwards');
                        array_push($msg, '<b>Would you like to take the final swing yes or no?</b>');
                        array_push($event, 8);
                    } else 
                    if($rand <= 8){
                        //if you have shield check to block
                        if(in_array('shield', $equipped)){
                            $rand1 = rand(1, 6);
                        } else {
                            $rand1 = 6;
                        } 
                        array_push($msg, '> The monster charges at you!');
                        array_push($msg, '> You hit the monster');
                        array_push($msg, '> You are thrown back');
                        if($rand1 <= 2){
                            array_push($msg, "Your shield protects you from all damage");
                        } else {
                            if(in_array(11, $event)){
                            } else {
                                $dmg = rand(15, 50);
                                $_SESSION['health'] -= $dmg;
                            }
                        }
                        $_SESSION['monster'] += 1;
                    } else 
                    if($rand <= 10){
                        array_push($msg, '> The monster flinched');
                        array_push($msg, '> You land a good hit');
                        $_SESSION['monster'] += 1;
                    } else 
                    if($rand <= 12){
                        //if you have shield check to block
                        if(in_array('shield', $equipped)){
                            $rand1 = rand(1, 6);
                        } else {
                            $rand1 = 6;
                        } 
                        array_push($msg, '> The monster took the hit directly');
                        array_push($msg, '> You are struck with a counter attack before you could pull out the axe');
                        if($rand1 <= 2){
                            array_push($msg, "Your shield protects you from all damage");
                        } else {
                            if(in_array(11, $event)){
                            } else {
                                $dmg = rand(15, 70);
                                $_SESSION['health'] -= $dmg;  
                            }  
                        }
                        $_SESSION['monster'] += 1;
                    } else 
                    if($rand <= 14){
                        array_push($msg, '> Your overhead swing clips the monster');
                        array_push($msg, '> The monster puts some distance between you');
                        $_SESSION['monster'] += 1;
                    } else 
                    if($rand <= 15){
                        //if you have shield check to block
                        if(in_array('shield', $equipped)){
                            $rand1 = rand(1, 6);
                        } else {
                            $rand1 = 6;
                        } 
                        array_push($msg, '> The monster jumps back!');
                        array_push($msg, '> Your attack misses');
                        array_push($msg, '> The monster rushes in and gets a clean hit');
                        if($rand1 <= 2){
                            array_push($msg, "Your shield protects you from all damage");
                        } else {
                            if(in_array(11, $event)){
                            } else {
                                $dmg = rand(15, 78);
                                $_SESSION['health'] -= $dmg;  
                            }  
                        }
                    }  
                } else
                if(in_array('crowbar', $equipped)){
                    $rand = rand(1, 15);
                    array_push($msg, '> You swing with the crowbar');
                    if($rand <= 3){
                        array_push($msg, '> You land a direct hit!');
                        array_push($msg, 'The monster is taken by suprise and false backwards');
                        array_push($msg, '<b>Would you like to take the final swing yes or no?</b>');
                        array_push($event, 8);
                    } else 
                    if($rand <= 9){
                        //if you have shield check to block
                        if(in_array('shield', $equipped)){
                            $rand1 = rand(1, 6);
                        } else {
                            $rand1 = 6;
                        } 
                        array_push($msg, '> The monster charges');
                        array_push($msg, '> You hit the monster');
                        array_push($msg, '> You are thrown back');
                        if($rand1 <= 2){
                            array_push($msg, "Your shield protects you from all damage");
                        } else {
                            if(in_array(11, $event)){
                            } else {
                                $dmg = rand(15, 70);
                                $_SESSION['health'] -= $dmg;  
                            }  
                        }
                        $_SESSION['monster'] += 1;
                    } else 
                    if($rand <= 10){
                        array_push($msg, '> The monster flinched');
                        array_push($msg, '> You land a good hit');
                        $_SESSION['monster'] += 1;
                    } else 
                    if($rand <= 12){
                        //if you have shield check to block
                        if(in_array('shield', $equipped)){
                            $rand1 = rand(1, 6);
                        } else {
                            $rand1 = 6;
                        } 
                        array_push($msg, '> The monster took the hit directly');
                        array_push($msg, '> You are struck with a counter attack!');
                        if($rand1 <= 2){
                            array_push($msg, "Your shield protects you from all damage");
                        } else {
                            if(in_array(11, $event)){
                            } else {
                                $dmg = rand(15, 70);
                                $_SESSION['health'] -= $dmg;  
                            }  
                        }
                        $_SESSION['monster'] += 1;
                    } else 
                    if($rand <= 14){
                        array_push($msg, '> Your overhead swing clips the monster');
                        array_push($msg, '> The monster puts some distance between you');
                        $_SESSION['monster'] += 1;
                    } else 
                    if($rand <= 15){
                        //if you have shield check to block
                        if(in_array('shield', $equipped)){
                            $rand1 = rand(1, 6);
                        } else {
                            $rand1 = 6;
                        } 
                        array_push($msg, '> The monster jumps back!');
                        array_push($msg, '> Your attack misses');
                        array_push($msg, '> The monster rushes in and gets a clean hit');
                        if($rand1 <= 2){
                            array_push($msg, "Your shield protects you from all damage");
                        } else {
                            if(in_array(11, $event)){
                            } else {
                                $dmg = rand(15, 78);
                                $_SESSION['health'] -= $dmg;  
                            }  
                        }
                        
                    }  
                } else 
                if(in_array('keys', $equipped)){
                    $rand = rand(1, 15);
                    array_push($msg, '> You swing with the keys');
                    if($rand <= 5){
                        //if you have shield check to block
                        if(in_array('shield', $equipped)){
                            $rand1 = rand(1, 6);
                        } else {
                            $rand1 = 6;
                        } 
                        array_push($msg, '> The monster charges');
                        array_push($msg, '> You hit the monster');
                        array_push($msg, '> You are thrown back');
                        if($rand1 <= 2){
                            array_push($msg, "Your shield protects you from all damage");
                        } else {
                            if(in_array(11, $event)){
                            } else {
                                $dmg = rand(15, 50);
                                $_SESSION['health'] -= $dmg;  
                            }  
                        }
                        $_SESSION['monster'] += 0.5;
                    } else 
                    if($rand <= 6){
                        array_push($msg, '> The monster flinched');
                        array_push($msg, '> You land a good hit');
                        $_SESSION['monster'] += 1;
                    } else 
                    if($rand <= 12){
                        //if you have shield check to block
                        if(in_array('shield', $equipped)){
                            $rand1 = rand(1, 6);
                        } else {
                            $rand1 = 6;
                        } 
                        array_push($msg, '> The monster took the hit directly');
                        array_push($msg, '> You are struck with a counter attack!');
                        if($rand1 <= 2){
                            array_push($msg, "Your shield protects you from all damage");
                        } else {
                            if(in_array(11, $event)){
                            } else {
                                $dmg = rand(15, 70);
                                $_SESSION['health'] -= $dmg;  
                            }  
                        }
                        $_SESSION['monster'] += 0.5;
                    } else 
                    if($rand <= 15){
                        //if you have shield check to block
                        if(in_array('shield', $equipped)){
                            $rand1 = rand(1, 6);
                        } else {
                            $rand1 = 6;
                        } 
                        array_push($msg, '> The monster jumps back!');
                        array_push($msg, '> Your attack misses');
                        array_push($msg, '> The monster rushes in and gets a clean hit');
                        if($rand1 <= 2){
                            array_push($msg, "Your shield protects you from all damage");
                        } else {
                            if(in_array(11, $event)){
                            } else {
                                $dmg = rand(15, 78);
                                $_SESSION['health'] -= $dmg;  
                            }  
                        }
                        
                    }   
                } else 
                if(!in_array('axe', $equipped) and !in_array('crowbar', $equipped) and !in_array('keys', $equipped)){
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, 'Without a weapon you attack the monster');
                    array_push($msg, 'It stands there and barely flinches');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(40, 78);
                            $_SESSION['health'] -= $dmg;  
                        }  
                    }
                    
                }   
        } 
        if($_SESSION['monster'] >= 4){
            array_push($msg, '<b>With a final swing you finish off the creature</b>');
            array_push($event, 6);
            $_SESSION['monster'] = 0;
            $_SESSION['counter'] = 0;
            if(in_array('5', $event)){
                foreach($event as $key => $value){
                    if($value =='5'){
                        unset($event[$key]);
                    }
                    if($value =='8'){
                        unset($event[$key]);
                    }
                }
            }
    }
 } else






    //fighting the mimic
    if(in_array(13, $event) and !in_array(14, $event)){
        if(in_array('8', $event)){
            if($input == 'yes' or $input =='y'){
                array_push($event, 'l');
                array_push($msg, '<b>With a final swing you finish off the creature</b>');
                array_push($event, 14);
                $_SESSION['monster'] = 0;
                $_SESSION['money'] += 5;
                $_SESSION['counter'] = 0;
                if(in_array('13', $event)){
                    foreach($event as $key => $value){
                        if($value =='13'){
                            unset($event[$key]);
                        }
                        if($value =='8'){
                            unset($event[$key]);
                        }
                    }
                }
            } else
            if($input == 'no'){
                array_push($event, 'l');
                $dmg = rand(45, 160);
                array_push($msg, 'You decide to spare the monster');
                array_push($msg, 'The monster quickly claws the weapon out of your hand');
                $_SESSION['health'] -= $dmg;
                if(in_array('axe', $equipped) or in_array('crowbar', $equipped) or in_array('keys', $equipped) or in_array('vial', $equipped)){
                    foreach($equipped as $key => $value){
                        if($value == 'axe' or $value == 'crowbar' or $value == 'keys' or $value == 'vial'){
                            unset($equipped[$key]);
                        }

                    }
                    foreach($event as $key => $value){
                        if($value =='8'){
                            unset($event[$key]);
                        }
                    }
                }
                
            }
        } else
        if($input == 'attack' or $input == 'attack monster'){
            if(in_array('axe', $equipped)){
                $rand = rand(1, 15);
                array_push($msg, '> You swing with the axe');
                if($rand <= 3){
                    array_push($msg, '> You land a direct hit with the axe!');
                    array_push($msg, 'The monster is taken by suprise and false backwards');
                    array_push($msg, '<b>Would you like to take the final swing yes or no?</b>');
                    array_push($event, 8);
                } else 
                if($rand <= 8){
                    //if you have shield check to block
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, '> The monster charges at you!');
                    array_push($msg, '> You hit the monster');
                    array_push($msg, '> You are thrown back');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(25, 60);
                            $_SESSION['health'] -= $dmg;
                        }
                    }
                    $_SESSION['monster'] += 1;
                } else 
                if($rand <= 10){
                    array_push($msg, '> The monster flinched');
                    array_push($msg, '> You land a good hit');
                    $_SESSION['monster'] += 1;
                } else 
                if($rand <= 12){
                    //if you have shield check to block
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, '> The monster took the hit directly');
                    array_push($msg, '> You are struck with a counter attack before you could pull out the axe');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(25, 80);
                            $_SESSION['health'] -= $dmg;  
                        }  
                    }
                    $_SESSION['monster'] += 1;
                } else 
                if($rand <= 14){
                    array_push($msg, '> Your overhead swing clips the monster');
                    array_push($msg, '> The monster puts some distance between you');
                    $_SESSION['monster'] += 1;
                } else 
                if($rand <= 15){
                    //if you have shield check to block
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, '> The monster jumps back!');
                    array_push($msg, '> Your attack misses');
                    array_push($msg, '> The monster rushes in and gets a clean hit');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(25, 88);
                            $_SESSION['health'] -= $dmg;  
                        }  
                    }
                }  
            } else
            if(in_array('crowbar', $equipped)){
                $rand = rand(1, 15);
                array_push($msg, '> You swing with the crowbar');
                if($rand <= 2){
                    array_push($msg, '> You land a direct hit!');
                    array_push($msg, 'The monster is taken by suprise and false backwards');
                    array_push($msg, '<b>Would you like to take the final swing yes or no?</b>');
                    array_push($event, 8);
                } else 
                if($rand <= 9){
                    //if you have shield check to block
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, '> The monster charges');
                    array_push($msg, '> You hit the monster');
                    array_push($msg, '> You are thrown back');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(25, 80);
                            $_SESSION['health'] -= $dmg;  
                        }  
                    }
                    $_SESSION['monster'] += 1;
                } else 
                if($rand <= 10){
                    array_push($msg, '> The monster flinched');
                    array_push($msg, '> You land a good hit');
                    $_SESSION['monster'] += 1;
                } else 
                if($rand <= 12){
                    //if you have shield check to block
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, '> The monster took the hit directly');
                    array_push($msg, '> You are struck with a counter attack!');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(25, 80);
                            $_SESSION['health'] -= $dmg;  
                        }  
                    }
                    $_SESSION['monster'] += 1;
                } else 
                if($rand <= 14){
                    array_push($msg, '> Your overhead swing clips the monster');
                    array_push($msg, '> The monster puts some distance between you');
                    $_SESSION['monster'] += 1;
                } else 
                if($rand <= 15){
                    //if you have shield check to block
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, '> The monster jumps back!');
                    array_push($msg, '> Your attack misses');
                    array_push($msg, '> The monster rushes in and gets a clean hit');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(25, 88);
                            $_SESSION['health'] -= $dmg;  
                        }  
                    }
                    
                }  
            } else 
            if(in_array('keys', $equipped)){
                $rand = rand(1, 15);
                array_push($msg, '> You swing with the keys');
                if($rand <= 5){
                    //if you have shield check to block
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, '> The monster charges');
                    array_push($msg, '> You hit the monster');
                    array_push($msg, '> You are thrown back');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(25, 60);
                            $_SESSION['health'] -= $dmg;  
                        }  
                    }
                    $_SESSION['monster'] += 0.5;
                } else 
                if($rand <= 6){
                    array_push($msg, '> The monster flinched');
                    array_push($msg, '> You land a good hit');
                    $_SESSION['monster'] += 1;
                } else 
                if($rand <= 12){
                    //if you have shield check to block
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, '> The monster took the hit directly');
                    array_push($msg, '> You are struck with a counter attack!');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(25, 80);
                            $_SESSION['health'] -= $dmg;  
                        }  
                    }
                    $_SESSION['monster'] += 0.5;
                } else 
                if($rand <= 15){
                    //if you have shield check to block
                    if(in_array('shield', $equipped)){
                        $rand1 = rand(1, 6);
                    } else {
                        $rand1 = 6;
                    } 
                    array_push($msg, '> The monster jumps back!');
                    array_push($msg, '> Your attack misses');
                    array_push($msg, '> The monster rushes in and gets a clean hit');
                    if($rand1 <= 2){
                        array_push($msg, "Your shield protects you from all damage");
                    } else {
                        if(in_array(11, $event)){
                        } else {
                            $dmg = rand(15, 78);
                            $_SESSION['health'] -= $dmg;  
                        }  
                    }
                    
                }   
            } else 
            if(!in_array('axe', $equipped) and !in_array('crowbar', $equipped) and !in_array('keys', $equipped)){
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, 'Without a weapon you attack the monster');
                array_push($msg, 'It stands there and barely flinches');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(50, 88);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                
            }   
    } 
    if($_SESSION['monster'] >= 5){
        array_push($msg, '<b>With a final swing you finish off the creature</b>');
        array_push($event, 14);
        $_SESSION['monster'] = 0;
        $_SESSION['money'] += 5;
        $_SESSION['counter'] = 0;
        if(in_array('13', $event)){
            foreach($event as $key => $value){
                if($value =='13'){
                    unset($event[$key]);
                }
                if($value =='8'){
                    unset($event[$key]);
                }
            }
        }
    }  
} 






// monster ^^^^
if(in_array(16, $event) and !in_array(17, $event)){
    if(in_array('8', $event)){
        if($input == 'yes' or $input =='y'){
            array_push($event, 'l');
            array_push($msg, '<b>With a final swing you finish off the creature</b>');
            array_push($event, 17);
            $_SESSION['monster'] = 0;
            $_SESSION['money'] += 5;
            $_SESSION['counter'] = 0;
            if(in_array('16', $event)){
                foreach($event as $key => $value){
                    if($value =='16'){
                        unset($event[$key]);
                    }
                    if($value =='8'){
                        unset($event[$key]);
                    }
                }
            }
        } else
        if($input == 'no'){
            array_push($event, 'l');
            $dmg = rand(45, 160);
            array_push($msg, 'You decide to spare the monster');
            array_push($msg, 'The monster quickly claws the weapon out of your hand');
            $_SESSION['health'] -= $dmg;
            if(in_array('axe', $equipped) or in_array('crowbar', $equipped) or in_array('keys', $equipped) or in_array('vial', $equipped)){
                foreach($equipped as $key => $value){
                    if($value == 'axe' or $value == 'crowbar' or $value == 'keys' or $value == 'vial'){
                        unset($equipped[$key]);
                    }
                }
                foreach($event as $key => $value){
                    if($value =='8'){
                        unset($event[$key]);
                    }
                }
            }
            
        }
    } else
    if($input == 'attack' or $input == 'attack monster'){
        if(in_array('axe', $equipped)){
            $rand = rand(1, 15);
            array_push($msg, '> You swing with the axe');
            if($rand <= 3){
                array_push($msg, '> You land a direct hit with the axe!');
                array_push($msg, 'The monster is taken by suprise and false backwards');
                array_push($msg, '<b>Would you like to take the final swing yes or no?</b>');
                array_push($event, 8);
            } else 
            if($rand <= 8){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster charges at you!');
                array_push($msg, '> You hit the monster');
                array_push($msg, '> You are thrown back');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(25, 60);
                        $_SESSION['health'] -= $dmg;
                    }
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 10){
                array_push($msg, '> The monster flinched');
                array_push($msg, '> You land a good hit');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 12){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster took the hit directly');
                array_push($msg, '> You are struck with a counter attack before you could pull out the axe');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(25, 80);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 14){
                array_push($msg, '> Your overhead swing clips the monster');
                array_push($msg, '> The monster puts some distance between you');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 15){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster jumps back!');
                array_push($msg, '> Your attack misses');
                array_push($msg, '> The monster rushes in and gets a clean hit');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(25, 88);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
            }  
        } else
        if(in_array('crowbar', $equipped)){
            $rand = rand(1, 15);
            array_push($msg, '> You swing with the crowbar');
            if($rand <= 2){
                array_push($msg, '> You land a direct hit!');
                array_push($msg, 'The monster is taken by suprise and false backwards');
                array_push($msg, '<b>Would you like to take the final swing yes or no?</b>');
                array_push($event, 8);
            } else 
            if($rand <= 9){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster charges');
                array_push($msg, '> You hit the monster');
                array_push($msg, '> You are thrown back');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(25, 80);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 10){
                array_push($msg, '> The monster flinched');
                array_push($msg, '> You land a good hit');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 12){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster took the hit directly');
                array_push($msg, '> You are struck with a counter attack!');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(25, 80);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 14){
                array_push($msg, '> Your overhead swing clips the monster');
                array_push($msg, '> The monster puts some distance between you');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 15){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster jumps back!');
                array_push($msg, '> Your attack misses');
                array_push($msg, '> The monster rushes in and gets a clean hit');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(25, 88);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                
            }  
        } else 
        if(in_array('keys', $equipped)){
            $rand = rand(1, 15);
            array_push($msg, '> You swing with the keys');
            if($rand <= 5){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster charges');
                array_push($msg, '> You hit the monster');
                array_push($msg, '> You are thrown back');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(25, 60);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 0.5;
            } else 
            if($rand <= 6){
                array_push($msg, '> The monster flinched');
                array_push($msg, '> You land a good hit');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 12){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster took the hit directly');
                array_push($msg, '> You are struck with a counter attack!');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(25, 80);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 0.5;
            } else 
            if($rand <= 15){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster jumps back!');
                array_push($msg, '> Your attack misses');
                array_push($msg, '> The monster rushes in and gets a clean hit');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(15, 78);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                
            }   
        } else 
        if(!in_array('axe', $equipped) and !in_array('crowbar', $equipped) and !in_array('keys', $equipped)){
            if(in_array('shield', $equipped)){
                $rand1 = rand(1, 6);
            } else {
                $rand1 = 6;
            } 
            array_push($msg, 'Without a weapon you attack the monster');
            array_push($msg, 'It stands there and barely flinches');
            if($rand1 <= 2){
                array_push($msg, "Your shield protects you from all damage");
            } else {
                if(in_array(11, $event)){
                } else {
                    $dmg = rand(50, 88);
                    $_SESSION['health'] -= $dmg;  
                }  
            }
            
        }   
} 
if($_SESSION['monster'] >= 6){
    array_push($msg, '<b>With a final swing you finish off the creature</b>');
    array_push($event, 17);
    $_SESSION['monster'] = 0;
    $_SESSION['money'] += 5;
    $_SESSION['counter'] = 0;
    if(in_array('17', $event)){
        foreach($event as $key => $value){
            if($value =='16'){
                unset($event[$key]);
            }
            if($value =='8'){
                unset($event[$key]);
            }
        }
    }
}  
}









if(in_array(25, $event) and !in_array(26, $event)){
    if($input == 'attack' or $input == 'attack monster'){
        if(in_array('axe', $equipped)){
            $rand = rand(1, 15);
            array_push($msg, '> You swing with the axe');
            if($rand <= 6){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster teleports point blank');
                array_push($msg, '> You hit the monster');
                array_push($msg, '> The monster bites you');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(40, 90);
                        $_SESSION['health'] -= $dmg;
                    }
                }
                $_SESSION['monster'] += 1.5;
            } else 
            if($rand <= 7){
                array_push($msg, '> The monster flinched');
                array_push($msg, '> You land a good hit');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 11){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster charges a laser');
                array_push($msg, '> You hit the monster');
                array_push($msg, '> The monster lands a direct hit');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(45, 90);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 13){
                array_push($msg, '> Your overhead swing clips the monster');
                array_push($msg, '> The monster flys backwards');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 15){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster dodges');
                array_push($msg, '> Your attack misses');
                array_push($msg, '> The monster rushes in and gets a clean hit');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(40, 90);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
            }  
        } else
        if(in_array('crowbar', $equipped)){
            $rand = rand(1, 15);
            array_push($msg, '> You swing with the crowbar');
            if($rand <= 6){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster teleports point blank');
                array_push($msg, '> You hit the monster');
                array_push($msg, '> The monster bites you');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(40, 90);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 7){
                array_push($msg, '> The monster flinched');
                array_push($msg, '> You land a good hit');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 10){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster charges a laser');
                array_push($msg, '> You hit the monster');
                array_push($msg, '> The monster lands a direct hit');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(45, 90);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 13){
                array_push($msg, '> Your overhead swing clips the monster');
                array_push($msg, '> The monster flys backwards');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 15){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster dodges!');
                array_push($msg, '> Your attack misses');
                array_push($msg, '> The monster rushes in and gets a clean hit');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(40, 90);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                
            }  
        } else 
        if(in_array('keys', $equipped)){
            $rand = rand(1, 15);
            array_push($msg, '> You swing with the keys');
            if($rand <= 6){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster teleports point blank');
                array_push($msg, '> You hit the monster');
                array_push($msg, '> The monster bites you');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(40, 90);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 0.5;
            } else 
            if($rand <= 7){
                array_push($msg, '> The monster flinched');
                array_push($msg, '> You land a good hit');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 10){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster charges a laser');
                array_push($msg, '> You hit the monster');
                array_push($msg, '> The monster lands a direct hit');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(45, 95);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 0.5;
            } else 
            if($rand <= 15){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> The monster dodges!');
                array_push($msg, '> Your attack misses');
                array_push($msg, '> The monster rushes in and gets a clean hit');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(40, 90);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                
            }   
        } else 
        if(!in_array('axe', $equipped) and !in_array('crowbar', $equipped) and !in_array('keys', $equipped)){
            if(in_array('shield', $equipped)){
                $rand1 = rand(1, 6);
            } else {
                $rand1 = 6;
            } 
            array_push($msg, 'Without a weapon you attack the monster');
            array_push($msg, 'It stands there and barely flinches');
            if($rand1 <= 2){
                array_push($msg, "Your shield protects you from all damage");
            } else {
                if(in_array(11, $event)){
                } else {
                    $dmg = rand(50, 88);
                    $_SESSION['health'] -= $dmg;  
                }  
            }
            
        }   
} 
if($_SESSION['monster'] >= 7){
    array_push($msg, '<b>With a final swing you finish off the creature</b>');
    array_push($event, 26);
    $_SESSION['monster'] = 0;
    $_SESSION['money'] += 5;
    $_SESSION['counter'] = 0;
    $_SESSION['x'] = 7;
    $_SESSION['y'] = 3;
} 
} 











if(in_array(32, $event) and !in_array(33, $event)){
    if($input == 'attack' or $input == 'attack monster'){
        if(in_array('axe', $equipped)){
            $rand = rand(1, 15);
            array_push($msg, '> You swing with the axe');
            if($rand <= 6){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> Apple Worm teleports behind you, landing a hit');
                array_push($msg, '> You spin around and hit him');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(50, 99);
                        $_SESSION['health'] -= $dmg;
                    }
                }
                $_SESSION['monster'] += 1.5;
            } else 
            if($rand <= 7){
                array_push($msg, '> Apple Worm is scared of your mighty swing, he flinched');
                array_push($msg, '> You land a good hit');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 11){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> Apple Worm gives you a kiss');
                array_push($msg, '> You hit him with the axe');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(55, 105);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 13){
                array_push($msg, '> You throw the axe');
                array_push($msg, '> Apple Worm fetches, he takes damage for missing the axe');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 15){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> Apple Worm vanishes');
                array_push($msg, '> Your attack misses');
                array_push($msg, '> Apple Worm bites you');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(50, 99);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
            }  
        } else
        if(in_array('crowbar', $equipped)){
            $rand = rand(1, 15);
            array_push($msg, '> You swing with the crowbar');
            if($rand <= 6){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> Apple Worm teleports behind you, landing a hit');
                array_push($msg, '> You spin around and hit him');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(50, 99);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 7){
                array_push($msg, '> Apple Worm is scared of your mighty swing, he flinched');
                array_push($msg, '> You land a good hit');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 10){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> Apple Worm gives you a kiss');
                array_push($msg, '> You hit him with the axe');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(55, 105);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 13){
                array_push($msg, '> You throw the axe');
                array_push($msg, '> Apple Worm fetches, he takes damage for missing the axe');
                $_SESSION['monster'] += 1;
            } else 
            if($rand <= 15){
                //if you have shield check to block
                if(in_array('shield', $equipped)){
                    $rand1 = rand(1, 6);
                } else {
                    $rand1 = 6;
                } 
                array_push($msg, '> Apple Worm vanishes');
                array_push($msg, '> Your attack misses');
                array_push($msg, '> Apple Worm bites you');
                if($rand1 <= 2){
                    array_push($msg, "Your shield protects you from all damage");
                } else {
                    if(in_array(11, $event)){
                    } else {
                        $dmg = rand(50, 99);
                        $_SESSION['health'] -= $dmg;  
                    }  
                }
                
            }  
        } else 
        if(!in_array('axe', $equipped) and !in_array('crowbar', $equipped)){
            if(in_array('shield', $equipped)){
                $rand1 = rand(1, 6);
            } else {
                $rand1 = 6;
            } 
            array_push($msg, 'Without a weapon you attack the monster');
            array_push($msg, 'It stands there and barely flinches');
            if($rand1 <= 2){
                array_push($msg, "Your shield protects you from all damage");
            } else {
                if(in_array(11, $event)){
                } else {
                    $dmg = rand(50, 88);
                    $_SESSION['health'] -= $dmg;  
                }  
            }
            
        }   
} 
if($_SESSION['monster'] >= 10){
    array_push($msg, '<b>With a final swing you finish Apple Worm</b>');
    array_push($msg, 'You are a monster....');
    array_push($event, 33);
    $_SESSION['monster'] = 0;
    $_SESSION['money'] += 9000;
    $_SESSION['counter'] = 0;
    $_SESSION['x'] = 7;
    $_SESSION['y'] = 3;
} 
} 
?>