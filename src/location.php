<?php
// $event = explode(',', $_SESSION['event']);
// $inv = explode(',', $_SESSION['inventory']);
// $equipped = explode(',', $_SESSION['equipped']);
$x = $_SESSION['x'];
$y  = $_SESSION['y'];
// locations
     if($x == 6 and $y == 1){
        $_SESSION['location'] = 'empty cell';
        $location = $_SESSION['location'];
//direction that you can move
        $west = 0;
        $east = 0;
        $north = 1;
        $south = 0;

//talking with others
        $person = 1;
        $talk = "You shout out asking for anyone...";
        $talk1 =  "Welcome to The Rottogram... not to often I come across your kind...";
        $talk2  =  "You're now trapped in here forever. Get used to it. If you're looking too escape";
        $talk3   =  "that vent in the corner should get you out of your cell, make sure to <b> look around</b>";
//looking around   
        $viewn = '<b> North: </b> A small vent'; 
        $views = '<b> South: </b> Outside your cell is an axe against the wall';
        $vieww = '<b> West: </b> A blank wall';
        $viewe = "<b> East: </b> A small window that lets you see into the cell next to you, there is a strange guy sitting there";
//enter the room
        $room = 'The cell you started in';
        $roomnpc = 'A strange guy is in the cell next to you';
//item id

        $item = 'nothing';

    } else
    if($x == 6 and $y == 0){
        $_SESSION['location'] = 'hidden room';
        $location = $_SESSION['location'];
        $west = 1;
        $east = 0;
        $north = 0;
        $south = 1;
        if(in_array('applecloak', $inv) or in_array('applecloak', $equipped)){
            $person = 0;
        } else {
            $roomnpc = 'A small worm creature is resting in the corner';
            $person = 1;
            $talk = 'Hello '.$username.' I am a servant from the ascended planes';
            $talk1 = 'I have come to give you this applecloak';
            $talk2 = 'It will show your pledge of allegiance to Apple Worm';
            $talk3 = 'It will also give you some more protection should you be attacked, good luck'; 
        }
        
        $viewn = '<b> North:</b> A stone wall with lots of dead maggots all over it';
        $views = '<b> South:</b> Is the vent you just came through';
        $vieww = '<b> West:</b> An open vent at the end of the hall';
        $viewe = '<b> East:</b> A dead end';

        $room = 'A rather empty hallway full of maggots, there seem to be many vents';

        $item = 'applecloak';
    } else 
    if($x == 5 and $y == 0){
        $_SESSION['location'] = 'hidden room';
        $location = $_SESSION['location'];
        $west = 1;
        $east = 1;
        $north = 0;
        if(in_array('1', $event)){
            $south = 1;
        } else {
            $south = 0;
        }
        
        $person = 0;
        $viewn = '<b> North:</b> A blank wall';
        if(!in_array(1, $event)){
            $views = '<b> South:</b> Another vent, seems to be sealed shut';
        } else {
            $views = '<b> South:</b> Another vent';
        }
        $vieww = '<b> West:</b> The end of the hallway with an open vent';
        $viewe = '<b> East:</b> A hallway rather empty hallway';

        $room = 'The end of the hallway';

        $item = 'nothing';
    } else 
    if($x == 4 and $y == 0){
        $_SESSION['location'] = 'torture room';
        $location = $_SESSION['location'];
        $west = 1;
        $east = 1;
        $north = 0;
        $south = 0;

        $person = 0;
        if(!in_array('crowbar', $inv) and !in_array('crowbar', $equipped)){
            $viewn = '<b> North:</b> There is a pile of black sludge, and a crowbar';
        } else {
            $viewn = '<b> North:</b> There is a pile of black sludge';
        }
        $views = '<b> South:</b> There are many chains and hooks on the wall';
        $vieww = '<b> West:</b> A desk in the distance'; 
        $viewe = '<b> East:</b> The vent you came from';

        $room = 'A large room covered in a black oil, it seems to be some kind of torture room';

        $item = 'crowbar';
        

    } else 
    if($x == 3 and $y == 0){
        $_SESSION['location'] = 'torture room';
        $location = $_SESSION['location'];
        $west = 0;
        $east = 1;
        $north = 0;
        $south = 0;

        $person = 0; 
        $viewn = '<b> North:</b> Just a wall'; 
        $views = '<b> South:</b> Just a wall';
        if(in_array('keys', $inv) or in_array('keys', $equipped)){
            $vieww = '<b> West:</b> A desk. There used to be keys on it';
        } else {
            $vieww = '<b> West:</b> A desk with some keys on it'; 
        }
        
        $viewe = '<b> East:</b> Seems to be some kind of torture room';

        $room = 'There is a desk in front of you';

        $item = 'keys';
        
    } else 
    if($x == 5 and $y == 1){
        $_SESSION['location'] = 'grimy cell';
        $location = $_SESSION['location'];
        $west = 0;
        $east = 0;
        $north = 1;
        $south = 1;

        $person = 0;
        
        if(!in_array('vial', $inv) and !in_array('bloodvial', $inv)){
            $view = 'A grimy room, the cave walls are leaking with blood, there is an empty vial on the floor'; 
            $room = 'A bloodcovered cell with an empty vial on the floor';
        } else {
            $view = 'A grimy room, the cave walls are leaking with blood'; 
            $room = 'A bloodcovered cell';
        }
        $viewn = '<b> North:</b> A blank wall with a small vent'; 
        $views = '<b> South:</b> Through the cell door there is an long hallway'; 
        $vieww = '<b> West:</b> Just a blank wall'; 
        $viewe = '<b> East:</b> A blood soaked wall dripping with blood';

        
        if(!in_array('vial', $inv) and !in_array('bloodvial', $inv)){
            $item = 'vial';
        } else {
            $item = 'fill';
        }
        
        
    } else 
    if($x == 2 && $y == 2){
        $_SESSION['location'] = 'hall of hallucinations';
        $location = $_SESSION['location'];
        $west = 0;
        $east = 1;
        $north = 1;
        $south = 0;

        $person = 0;
        $randum = rand(1, 4);
        if($randum == 1){
            $random = 'You see a ghost figure in the distance';
        }
        if($randum == 2){
            $random = 'You see Jackson creeping with a knife in the distance';
        }
        if($randum == 3){
            $random = 'You see a mlp fan vibrating in the distance';
        }
        if($randum == 4){
            $random = 'You see a furry comming for your uwus in the distance';
        }
        if(in_array('lamp', $equipped)){
            $random = "The hallway is rather empty, there are cells on the north side";
        }

        $viewn = '<b> North:</b> A long hallway with a door'; 
        $views = '<b> South:</b> A railing stopping you from falling into a void';
        if(!in_array('lamp', $inv) and !in_array('lamp', $equipped)){
            $vieww = '<b> West:</b> A window, you can see a lamp just out of reach';
        } else {
            $vieww = '<b> West:</b> A window, you can see the desk that had the lamp on it';
        }
        $viewe = '<b> East:</b> The full length of the hallway, ' . $random;

        $room = 'A very long hallway, the lighting is dim, you think you might be seeing things';

        $item = 'nothing';
    } else 
    if($x == 3 && $y == 2){
        $_SESSION['location'] = 'hall of hallucinations';
        $location = $_SESSION['location']; 
        $west = 1;
        $east = 1;
        $north = 0;
        $south = 0;

        $randum = rand(1, 4);
        if($randum == 1){
            $random = 'You see a ghostly figure in the distance';
        }
        if($randum == 2){
            $random = 'You see a black sludge dripping from the ceiling in the distance';
        }
        if($randum == 3){
            $random = 'You cannot see anything';
        }
        if($randum == 4){
            $random = 'You see yourself, you make direct eye contact';
        }
        if(in_array('lamp', $equipped)){
            $random = "The hallway is rather empty, there are cells on the north side";
        }
        $person = 0;
        $viewn = '<b> North:</b> A cell, you can see nothing inside'; 
        $views = '<b> South:</b> A railing stopping you from falling into the void';
        $vieww = '<b> West:</b> Down the hall you can see a window';
        $viewe = '<b> East:</b> The full length of the hallway, ' . $random;

        $room = 'A long hallway with dim lighting, a monster growls at you from inside';

        $item = 'nothing';
    } else
    if($x == 4 && $y == 2){
        $_SESSION['location'] = 'hall of hallucinations';
        $location = $_SESSION['location'];
        $west = 1;
        $east = 1;
        $north = 0;
        $south = 0;

        $randum = rand(1, 4);
        if($randum == 1){
            $random = 'A swarm of hornets fly in your direction';
            $random1 = 'An 8 foot tall figure with a axe is approaching';
        }
        if($randum == 2){
            $random = 'Your head feels fuzzy';
            $random1 = 'You hear a voice telling you to jump over the railing';
        }
        if($randum == 3){
            $random = 'You see a pair of glowing eyes in the distance';
            $random1 = 'You see a hand grab the railing, something is climbing out of the void below';
        }
        if($randum == 4){
            $random = 'A small child with a toy bear is sitting against the wall';
            $random1 = 'Your eyes hurt, you see blood dripping from your face';
        }
        if(in_array('lamp', $equipped)){
            $random = "The hallway is rather empty, there are cells on the north side";
            $random1 = "The hallway is rather empty, there are cells on the north side";
        }

        
        if(in_array('shield', $inv) or in_array('shield', $equipped)){
            $there = 'Sold out ';
        } else {
            $there = 'shield   ';
        }
        if(in_array('gravitycloak', $inv) or in_array('gravitycloak', $equipped)){
            $there1 = ' Sold out';
        } else {
            $there1 = '   gravitycloak';
        }
        if(in_array('apple juice', $inv)){
            $there2 = 'Sold out ';
        } else {
            $there2 = 'apple juice   ';
        }
        if(in_array("shellys love", $inv)){
            $there3 = ' Sold out';
        } else {
            $there3 = "   shellys love";
        }
        $person = 1;
        $shop1 = 1;
        $roomnpc = "An old man";
        $talk = 'What do you want to buy?';
        $talk1 = '<b>'. $there. "|" .$there1;
        $talk2 = $there2."|".$there3.'</b>';
        $talk3 = "All of it costs 5 worms, if you don't have any get lost"; 

        $viewn = '<b> North:</b> A cell with a man'; 
        $views = '<b> South:</b> A railing, stops you from falling into the black abyss below';
        $vieww = '<b> West:</b> You can see down the hallway, '.$random1;
        $viewe = '<b> East:</b> You can see down the hallway, '.$random;

        $room = 'A long hallway, there is a cell with a strange man, seems to be some kind of shop';
        
        $item = 'nothing';
    } else
    if($x == 5 && $y == 2){
        $_SESSION['location'] = 'hall of hallucinations';
        $location = $_SESSION['location']; 
        $west = 1;
        $east = 1;
        $north = 1;
        $south = 0;

        $randum = rand(1, 4);
        if($randum == 1){
            $random = 'death is coming';
            $random1 = 'You hear joe whispering in your ear';
        }
        if($randum == 2){
            $random = 'Jackson is comming for you';
            $random1 = 'there is no escape';
        }
        if($randum == 3){
            $random = 'you see black smoke approaching';
            $random1 = 'you think your about to die';
        }
        if($randum == 4){
            $random = 'a chicken is chickening about';
            $random1 = 'you see a blinding light';
        }
        if(in_array('lamp', $equipped)){
            $random = "The hallway is rather empty, there are cells on the north side";
            $random1 = "The hallway is rather empty, there are cells on the north side";
        }

        $person = 0;
        $viewn = '<b> North:</b> A cell covered in blood'; 
        $views = '<b> South:</b> A railing, you have the urge to jump';
        $vieww = '<b> West:</b> You can see down the hallway, '. $random1;
        $viewe = '<b> East:</b> You can see down the hallway, '. $random;

        $room = 'A long hallway with dim lighting, you swear you saw something move';

        $item = 'nothing';
    } else
    if($x == 6 && $y == 2){
        $_SESSION['location'] = 'hall of hallucinations';
        $location = $_SESSION['location']; 
        $west = 1;
        $east = 1;
        $north = 0;
        $south = 0;

        $person = 0;
        $viewn = '<b> North:</b> Your cell'; 
        if(in_array('axe', $inv) or in_array('axe', $equipped)){
            $views = '<b> South:</b> A wall';
        } else {
            $views = '<b> South:</b> A wall with an axe against it';
        }
        $vieww = '<b> West:</b> A long dark hallway, its hard to see';
        $viewe = '<b> East:</b> A chest chest in the distance';

        if(in_array('axe', $inv) or in_array('axe', $equipped)){
            $room = 'A dim hallway';
        } else {
            $room = 'A dim hallway, there is an axe against the wall';
        }
        $item = 'axe';
    } else
    if($x == 7 && $y == 2){
        $_SESSION['location'] = 'hall of hallucinations';
        $location = $_SESSION['location']; 
        if(in_array(13, $event) and !in_array(14, $event)){
            $west = 0;
            $east = 0;
            $north = 0;
            $south = 0;
        } else {
            $west = 1;
            $east = 0;
            $north = 0;
            $south = 0;
        }
        

        $person = 0;
        $viewn = '<b> North:</b> The cell of your neighbour, it is empty'; 
        $views = '<b> South:</b> A wall';
        $vieww = '<b> West:</b> A long hallway, it is hard to see anything';
        if(in_array(14, $event)){
            $viewe = '<b> East:</b> A dead end';
            $room = 'The end of the hallway';
        } else {
            $viewe = '<b> East:</b> A dead end, there is a chest';
            $room = 'The end of the hallway, there is a chest';
        }
        

        $item = 'nothing';
    } else
    if($x == 2 and $y == 0){
        $_SESSION['location'] = 'hall of hallucinations';
        $location = $_SESSION['location'];
        $west = 1;
        $east = 0;
        $north = 0;
        $south = 1;

        $person = 0;
        $viewn = '<b> North:</b> A blank wall'; 
        $views = '<b> South:</b> A railing in the far distance';
        $vieww = '<b> West:</b> A set of stairs';
        $viewe = '<b> East:</b> A wall';

        $room = 'The end of the hall';

        $item = 'nothing';
    }else 
        if($x == 2 and $y == 1){
        $_SESSION['location'] = 'hall of hallucinations';
        $location = $_SESSION['location'];
        if(in_array('3', $event)){
            $west = 1;
        } else {
            $west = 0;
        }

        $east = 0;
        $north = 1;
        $south = 1;

        $person = 0;
        $viewn = '<b> North:</b> A door at the end of the hallway'; 
        $views = '<b> South:</b> In the distance there is a railing';
        $vieww = '<b> West:</b> A door';
        $viewe = '<b> East:</b> A blank wall';

        $room = 'A hallway, there is a door on the west';

        $item = 'nothing';
    } else 
    if($x == 1 && $y == 1){
        $_SESSION['location'] = 'Dark room';
        $location = $_SESSION['location']; 
        
        if(!in_array(5, $event) and !in_array(6, $event)){
            array_push($event, '5');
            array_push($msg, 'A monster sees you enter the room, the door locks shut, you must stand and fight');
        }
        
        if(in_array(5, $event) and !in_array(6, $event)){
            $west = 0;
            $east = 0;
            $north = 0;
            $south = 0;
        } else {
            $west = 1;
            $east = 1;
            $north = 0;
            $south = 1;
        }

        
        $person = 0;
        $view = 'A long hallway with dim lighting, you swear you saw something move';
        $viewn = '<b> North:</b> A blank wall with a small vent'; 
        if(in_array('lamp', $inv) or in_array('lamp', $equipped)){
            $views = '<b> South:</b> There is a table';
        } else {
            $views = '<b> South:</b> There is a table with a lamp on it';
        }
        $vieww = '<b> West:</b> Just a blank wall';
        $viewe = '<b> East:</b> A small window lets you see into the cell next to you, there is a strange guy sitting there';

        if(in_array(6, $event) and !in_array(5, $event)){
            $room = 'A relatively blank room, the monster is on the floor';
        } else {
            $room = 'A relatively blank room, a monster is standing in front of you';
        }
        if(in_array(6, $event) and !in_array(5, $event)){
            $item = 'fill';
        } else {
            $item = 'nothing';
        }
        
    }else
    if($x == 0 && $y == 1){
        $_SESSION['location'] = 'Dark room';
        $location = $_SESSION['location']; 
        $west = 0;
        $east = 1;
        $north = 0;
        $south = 1;

        $person = 0;
        $viewn = '<b> North:</b> A wall'; 
        $views = '<b> South:</b> The other corner of the room';
        $vieww = '<b> West:</b> A window';
        $viewe = '<b> East:</b> The body of the monster';

        $room = 'The corner of the room';

        $item = 'nothing';
    }else
    if($x == 1 && $y == 2){
        $_SESSION['location'] = 'Dark room';
        $location = $_SESSION['location']; 
        $west = 1;
        $east = 0;
        $north = 1;
        $south = 0;

        $person = 0; 
        $viewn = '<b> North:</b> The dead monster'; 
        $views = '<b> South:</b> A wall';
        $vieww = '<b> West:</b> The corner of the room';
        $viewe = '<b> East:</b> A window that lets you see down the hall of hallucinations ';
        if(!in_array('lamp', $inv) and !in_array('lamp', $equipped)){
            $room = 'There is a lamp sitting on a table, you can see the window from earlier';
        } else {
            $room = 'There is a table, you can see the window from earlier';
        }
        $item = 'lamp';
    }else
    if($x == 0 && $y == 2){
        $_SESSION['location'] = 'Dark room';
        $location = $_SESSION['location']; 
        $west = 0;
        $east = 1;
        $north = 1;
        $south = 0;

        $person = 0;
        $viewn = '<b> North:</b> The other corner of the room, there is a window'; 
        $views = '<b> South:</b> A wall';
        $vieww = '<b> West:</b> A wall, carved into the wall it says "what is the music of life?"';
        if(in_array('lamp', $inv) or in_array('lamp', $equipped)){
            $viewe = '<b> East:</b> A table';
        } else {
        $viewe = '<b> East:</b> A table with a lamp on it';
        }
        $room = 'The corner of the room, there is something carved into the wall';

        $item = 'nothing';
    }else
    if($x == 1 && $y == 0){
        $_SESSION['location'] = 'Stairs';
        $location = $_SESSION['location']; 
        $west = 0;
        $east = 1;
        $north = 0;
        $south = 0;

        $person = 0;
        $viewn = '<b> North:</b> A wall'; 
        $views = '<b> South:</b> A wall';
        $vieww = '<b> West:</b> Stairs down';
        $viewe = '<b> East:</b> The doorway you came through';

        $room = 'Stairs to basement';
        
        $item = 'nothing';
    }
    if($x == 0 && $y == 3){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        $west = 0;
        $east = 1;
        $north = 0;
        $south = 1;

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'Its pitch black, you cannot see anything';
        } else {
            $viewn = '<b> North:</b> The stairs'; 
            $views = '<b> South:</b> The corner of the room';
            $vieww = '<b> West:</b> Just a blank wall';
            $viewe = '<b> East:</b> A hallway, there is a painting at the end';
            $room = 'Bottom of the stairs';
        }
        $item = 'nothing';
    }
    if($x == 1 && $y == 3){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        $west = 1;
        if(in_array(2, $event)){
            $east = 1;
        } else{
            $east = 0;
        }
        $north = 0;
        $south = 1;

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'it is pitch black, you might want to use the lamp';
        } else {
            $viewn = '<b> North:</b> A dirty wall'; 
            $views = '<b> South:</b> A door';
            $vieww = '<b> West:</b> The stairs';
            if(in_array(2, $event)){
                $viewe = '<b> East:</b> A ruined painting, the hole in it is big enough to go through';
            } else {
                $viewe = '<b> East:</b> A fancy looking painting of Cathedral Lapp, the legendary dark spirit';
            }
            $room = 'There is a painting';
        }
        $item = 'nothing';
    }
    if($x == 2 && $y == 3){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        $west = 1;
        $east = 1;
        $north = 0;
        $south = 0;

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'it is pitch black, get the lamp';
        } else {
            $view = 'A long hallway with dim lighting, you swear you saw something move';
            $viewn = '<b> North:</b> A wall'; 
            $views = '<b> South:</b> A wall';
            $vieww = '<b> West:</b> The painting, its ripped open';
            $viewe = '<b> East:</b> Down the hall, there is an illusion wall';
            $room = 'A secret room';
        }
        $item = 'nothing';
    }
    if($x == 3 && $y == 3){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        $west = 1;
        $east = 1;
        $north = 0;
        $south = 0;

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'Get the lamp you fool';
        } else {
            $view = 'A long hallway with dim lighting, you swear you saw something move';
            $viewn = '<b> North:</b> A blank wall'; 
            $views = '<b> South:</b> A blank wall';
            $vieww = '<b> West:</b> The entrance to the secret room';
            $viewe = '<b> East:</b> A monster, it cannot see you behind the illusion wall';
            if(!in_array(17, $event)){
                array_push($event, 18);
                $room = 'There is an illusion wall, you can see a monster, it cannot see you, would you like to sneak attack?';
            } else {
                $room = 'There is an illusion wall';
            }
        }
        $item = 'nothing';
    }
    if($x == 4 && $y == 3){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        if(!in_array(16, $event) and !in_array(17, $event)){
            array_push($event, '16');
            array_push($msg, 'A monster sees you enter the room, it charges at you, you must stand and fight');
        }
        if(in_array(16, $event) and !in_array(17, $event)){
            $west = 0;
            $east = 0;
            $north = 0;
            $south = 0;
        } else {
            $west = 1;
            $east = 1;
            $north = 0;
            $south = 1;
        }
        

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'It is to dark to see my guy';
        } else {
            $viewn = '<b> North:</b> A blank wall'; 
            $views = '<b> South:</b> Long hallway';
            $vieww = '<b> West:</b> A blank wall';
            $viewe = '<b> East:</b> A strange portal';
            $room = 'The corner of the room, there is a monster';
        }
        $item = 'nothing';
    }
    if($x == 5 && $y == 3){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        $west = 1;
        $east = 0;
        $north = 0;
        $south = 1;

        $person = 0;

        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'It is dark you cannot see';
        } else {
            $viewn = '<b> North:</b> A blank wall'; 
            $views = '<b> South:</b> The end of the hallway';
            $vieww = '<b> West:</b> A hallway';
            $viewe = '<b> East:</b> A strange portal';
            $room = 'There is a portal, it has imsense gravity power seeping from within';
        }
        $item = 'nothing';
    }
    if($x == 0 && $y == 4){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        $west = 0;
        $east = 1;
        $north = 1;
        $south = 0;

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'It is very dark no eyes work';
        } else {
            $viewn = '<b> North:</b> The stairs'; 
            $views = '<b> South:</b> A blank wall';
            $vieww = '<b> West:</b> Just a blank wall';
            $viewe = '<b> East:</b> Closer to the door in the distance';
            $room = 'The corner of the room';
        }
        $item = 'nothing';
    }
    if($x == 1 && $y == 4){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        if(in_array('15', $event)){
            $east = 1;
        } else {
            $east = 0;
        } 
        $west = 1;
        $north = 1;
        $south = 0;

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'it is dark your eye have left the chat';
        } else {
            $viewn = '<b> North:</b> A painting'; 
            $views = '<b> South:</b> A blank wall';
            $vieww = '<b> West:</b> The corner of the room';
            $viewe = '<b> East:</b> A door';
            $room = 'You are in front of a door';
        }
        $item = 'nothing';
    }
    if($x == 2 && $y == 4){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location'];
        if(in_array('15', $event)){
            $west = 1;
        } else {
            $west = 0;
        } 
        $east = 1;
        $north = 1;
        $south = 0;

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'You cannot see';
        } else {
            $view = 'A long hallway with dim lighting, you swear you saw something move';
            $viewn = '<b> North:</b> A blank wall'; 
            $views = '<b> South:</b> A blank wall';
            $vieww = '<b> West:</b> The door';
            $viewe = '<b> East:</b> A strange portal in the far distance';
            $room = 'A hallway';
        }
        $item = 'nothing';
    }
    if($x == 3 && $y == 4){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        $west = 1;
        $east = 1;
        $north = 1;
        $south = 0;

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'Blackness';
        } else {
            $viewn = '<b> North:</b> A blank wall'; 
            $views = '<b> South:</b> A blank wall';
            $vieww = '<b> West:</b> A hallway with a door at the end';
            $viewe = '<b> East:</b> There is a portal in the far distance';
            $room = 'You are closer to the portal';
        }
        $item = 'nothing';
    }
    if($x == 4 && $y == 4){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        if(!in_array(16, $event) and !in_array(17, $event)){
            array_push($event, '16');
            array_push($msg, 'A monster sees you enter the room, it charges at you, you must stand and fight');
        }
        if(in_array(16, $event) and !in_array(17, $event)){
            $west = 0;
            $east = 0;
            $north = 0;
            $south = 0;
        } else {
            $west = 1;
            $east = 1;
            $north = 1;
            $south = 0;
        }
        

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'Stairs to basement';
        } else {
            $viewn = '<b> North:</b> The corner of the room'; 
            $views = '<b> South:</b> A blank wall';
            $vieww = '<b> West:</b> A hallway with a door in it';
            $viewe = '<b> East:</b> There is a portal in the distance';
            $room = 'There is a portal in the distance';
        }
        $item = 'nothing';
    }
    if($x == 5 && $y == 4){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        $west = 1;
        $east = 0;
        $north = 1;
        $south = 0;

        $person = 0;
        if(!in_array('lamp', $equipped)){
            $viewn = 'It is pitch black'; 
            $views = 'You see nothing';
            $vieww = 'Your eyes require light';
            $viewe = 'You cannot see without a lamp';
            $room = 'It is very dark you cannot see';
        } else {
            $view = 'A long hallway with dim lighting, you swear you saw something move';
            $viewn = '<b> North:</b> There is another portal, it has a stronge gravitational pull'; 
            $views = '<b> South:</b> A blank wall';
            $vieww = '<b> West:</b> A hallway';
            $viewe = '<b> East:</b> A portal, it smells like apples';
            $room = 'There is a portal';
        }
        $item = 'nothing';
    }    
    if($x == "Ư̵̛͚͔̙̫̲̺̝̣̪̪̪̦̖̠̹̝̟̬̦̰̮̮͔̞̹͈͍̮̱̘̞̯̟̼̙̤̬͈̗̟͎͍̖͖͓̩̮̣͍͇̳̺̳̲̊̈́̂͋̎̏̈́̌̈́̃̋͑̎̂̄̇̐̈́̊̿̿̀̃̇̀̌͒͛̃̈́͆̃̐́͋͐́̉͑̊́̎̽͒͛̈́̉̋̀͌͑́̐̄́͑̋̇̈̋̾͊̒̐̑̊͐̎̃̆̾̉̄͛̇̌̀̍̊͗͗̈́͌̐̐͋̈́̓̈̅̃̏͑̒̍̓͗̔̃͊̕̚̕̕͜͝͝͝͠͠͝͝͝͝͠͝͠͝ͅN̴̢̧̢̨̛̺͈̝̼̯̝̱̬̖̬͚͓̜̤̰̯͉̭̰̜̣̻̥͎̘̞͙̬̙͖̫͙̙̘̞̯̱̰͓̰͎̻̰͍̩͉͙͎̩̱͈͍̤͔͚̖̟̮̰̙̹̝̳̞̤͖̪̞̜̱̖͍̈́̒̓͊͂͂̔̀̇͊͌̎̏́͌̀́͒̉̽͌̏̊̏̈́̀̈̀̄́̑̄̿̍͌̔͘̚͘͘̕͜͝͝͝͝K̵̨̢̨̡̡̡̢̢̡̡̧̢̡̛̛̛̛̙̞̤̦̞̬̮̯̰̟̼̫̗̠͉̠̠̩̞̺̘̱̩̥̥̜̠͙̠͓̰̖̳̲̬̼̰͙̖̭̦̪̪̣̭̠͔̣̺̣̩̪̱̺͚̣͖̪̺̥͕̲̜̮͔͇̪̹̱̲̝̗͒̽́͐̎̈́́̽̋̽͆͌̄͛́̐́͛̀̎̒͌̈̾͑̄̓͒̓̊̏̈́̐̈́͆̀̋̂̓̄͊̑͆̀̀̃̃̉̓͂̀̓͋̓̈̄͑̒̌͒͛͛͌͌̀͌̊̂̒̊̾͘͘̚͘͘͝͝͝͠ͅǪ̴̢̡̧̨̢̨̡͎̘̬̰̫̳̲̟̖̞̠̤͉͍̘͉̳̤̜̣̫̝̣̯̙͓̯͖̹͚̰̬̤̬͉̩̬̤̮̦̩͍̮͎͙̠͍̞͉̺͇͍̱̮̱̭̺͙̱̗͔͕͕̼̥̫̘̞̜͚̖͚͈͈̤͚̖͉̘̠̦͔͚͇͇̟̜̝̙͕̯͖͈̣͍̙̩̼͑̇̉̇̄̍͂̇͌̀͐̽̿̑̉̀̈́̆͋̆̒́͆́̎͗͆̅̃͒̌́͗̾̈́͌̉͆̓̓̿̓̍̔̎̒́̈̀̎͂̏̈́̈́͐͊̊̕̚͘͜͜͜͜͝W̸̡̧̛̛̖̰̩̱̗̙̰̩̟̻̙͖̩̜̖͕̯̣̗̦̰͇̹̻̥̪̙̖̥͉̗̝͉̺̙̹̜̮̞͕̱̝̫̦̝̒̆̍̓͋͊̇̈́͆͑͐̓̓͊͗͋́̈̈́́͑̄̽̽̑͗̅͌̀̊̒͗̄͛͋̌̀̈́̀͋̀̏̃͑͋̏͌͒̀̐͗͒̂͆́̔̐̓̐͂̉́͛̃͒̍̓̔̍̃̀̌́̉͐̐̑̅̇̾͌̇̋̔͌̀̏̃͊̈́̈́́͂̌̆̌̍̀̀̂͑̈̾̔͒̅͗͆̌̒͗̌̏̐̇̈́̀͌͆͒̿̒̎̔͑͂͛͗́͗̀̚͘͘͘͘̚̚̕̕͘͝͝͝͠͝͠͠͝͠͝͝͝ͅͅͅN̸̨̡̨̧̛̛̖̠̺͉͚̱͕͈̩̯̝̙̼͕͇̱̹͍͙̭̘̪̞͎̙̗̫̳̤̪̦͓͇̠̖͖̪̱̣̯̝͈͖͓̗͎̦̥̱͉̻̪̤̹͈͕̗̞̼̻̺̯̺̣̜̜̳̖͓͖̩͖̞͎̪͎̭̱͖̩̭̼͎̮̫̝̞̬̣̣͔͔͎͛͌͂̔̊͛̇̏̿̈́̃͛̈͂̇̎̈͌̏͒͆̄̈͛͐͂̉̀̇̀̀̓̾̏̍̾͗̋̽́͂̋͛̾̊̿̽͑̄͊̽͐͊̂̽̈́͊̈̿̍͒̀̆̊͊͊̉̇̐̅̉̏̃̃͊͗͛̌͂̿̋̈̅̀͒͆̊̀̀́̚̚̚͜͜͜͜͜͝͝͠͝͝͝͠ͅͅͅͅ" and $y =='0̶̢̡̢̢̢̧̢̨̡̢̡̡̧̢̛̛̱͚̣̮̪̗̜̥̣͙̥̦̞͉̙͓̤̫̥̖̣̼̩̝̮̯͚͓͔̖̜̮̱̥͙̤̫̻̬̹̺̗̗͇̻̮̩̠͙̝̹͚̞̬̼̻̦̻̭̤̪̯͙̦̰̮̘͉͇̱̦̹͕̤̩̫̩̟̪̹͈̦͓̫̤͚͔͙̮͉̜͖̮͕̩̥̣̰̝͎̩̯̠̠̳͔͎̠̤̘̖͕͕̺͙̤̗̹̠̣͇̪̻͓͙̩̥͙͈͖́́̃͗̈́̓͌͆̂͆̃̄̊̌͋̉̉̏̔͊̈͒͂̀̊̉̌̑́̅͂͊̌͊̌̉́̓͊̆̈̅̅͑̇̀͛̽͊̊̓̑̐̏̈́̓̌͊̾̐͛̇̏͑̆͛̍̆̈́͒͋̽̏̃̒̏̑̆̆̐̈́̍̽͌̎̂̈̉̑̇́͌̾͊͋͌̔̄̔̓̄̎̌͑́̈́́̓̽̕͘̕̕̕̕͘͜͜͜͝͠͝͝͝͠ͅͅͅ1̸̢̧̡̧̧̡̨̧̛̛̫̣͔̺̘͍̤̪̙͍͈͙̝̜̹͙̪̤̖̤̟̝̮̭̻̭͚̖͕̪̟̝̪̻̖̯͎͇̥̳̼̳̳̰͈̪̮͍̜̻̟͕͖̱̪̯͓̙̬̯̞̣̖̞̩̻͔̝̠̰̟͖̲̲͚̱͈̩͕̼̯̭̘̹͎̲̭̳͇̣͇͍̘͖͍̬̍̐̀̌̅̊̌̀̎̈́̏̌͋̊͒̽́́̿̌̉͊̈́͌͂̽̉͆̒̔̌̈́̊̍́͑͒̉̈́͗͘̕͜͜͝͠͠ͅͅ0̴̢̨̢̢̢̧̨̢̢̡̨̢̧̢̨̡̢̨̢̛̛̛̦̬̣͕͖̯̹̥͕͎̬̲̥̲͚̻͔̲̙͈͍̞̦̻̼̗̣̺͖͚̲͔̣̮̣͚̠̥̠͈̦̬̺̲̟͈̟̖͈̺̳̠̞͕̙̣̺͚͙͉͍̜͈̻̣̞̥̪̲̳̹̪͖̱̺̼̻̝͈̻̙̮͙̪̹̖̭̥̪̘̼̱̯̣͔̦͇̫̯͈͓̥̬̭̣̖̲̹̬̭̬̻̹͕̮͕̍̀̒̄̌̏͂͊́̀̋̒̔̌̎̉͂̏̑̾͛̈́̈́͂̓̾̈̉̈́̒̈́̉̒̀̄̅̽̑͑̈́̊̅͋͌͌̿̂̇̍̽́̓̂̌́̈́͒͊̈́͛̇͐̒̆̀͗̇̃̒̏͋̐̎̐̌̉̉̂́̄̃̄͗̏͌̒̈́͐͌̀̽͋̽̌̔̎̋́̉͊͋̌̈̏̄̈́͋̎̀̆̄̉̒͐͂͆̓͋̄͌̆̃̌̓͊͗͗̐̓̂̐̚̕̚͘̚͜͜͜͝͠͠͠͠͠͠͝͠͠͠ͅͅͅ0̶̢̢̧̢̡̢̡̡̢̧̡̢͓̮̥͖̻̩̻̝̥̺̱͇̦̱̱͙̞͔͕͈̘̟͕̝̬̠̣̼͉͔͖̻͕̦͓͕͇͍̙̪͔͙̞̘̙͚̙͙̭̣̪̰͔͍̣̜̰͖̗̙̯̠͚̼̲͖͓̦͉͖͎͖̫͙͍̣̥̠̦͓̱͎͉̗̘̙̠̙̳͇̱̦̪̱̰͍̘͂͜͜1̶̨̡̢̛̛̭͚̪̳̟̞̭̙͔̤̳͓̘̣̖̜͍̫͓̣̬̙̟̫̳̲̫̜̙̖̈̀̇̾̾̒͆̐͌̋̄̐̀͋͋͂̒͋̓́̽̎̑̑̈͒̒̉̽́̓̀̒̉͂͆̈́͂̈́̒̎̆̎̄͑͒̿̽͋̓̀͐̍̔̌̐͛̉͊̓͊̽́̍̀̀͆̿̒͗͋̐̂̅̌̅͆̋̀́̽̉̅̏͌̃́͂͆̾͑̋́̅͗̐̅̐̋́͂̍̑̔̽̋͋̈́̈̅͑̍́̀̿̿̓̽̆̚͘̚̚͝͝͝͝͠͝͝1̶̡̨̢̡̛̛͚̬͈͉͓̦͎̣̬̫̪̝̣̟͍͖̘̭̝͔͚̺̦̗͖͓̟̮̤͉̯̬̗̞̐͒̃͂́͋̓́̊̈́͐̈́̍̏́̾̓́̀͐́̀̓̈͗̀̒͗̽̑̊̆̔̓̅̀̈̾͂̈́̎̏̑͛̈̽̃̄̽͗͌͗̌͆̀͂̊͂̆̄̕͘̚͝͝ͅͅ1̵̢̧̧̧̧̢̡̢̢̧̛̳̬̼͍̫̖̤̯̝̱͔̙̹͚͎͈̺̦͖̱͚̹̤͍̠̜̱̱̣̼̞͙̫̦̱̰̱̬̩̫͇̜͇̳̰̪̙̪̤̘̘̙̱̺̭̝̮͍͔͈̘̗̺̫̼̱̥̬̫͔̗̟̞̜̗̭͕̗͕̗̞̗͎̫̤̱̘͓́̑̋̏̑̌̅͑̒̿͑̽̒͒͋̊̍̑̆͋̒̀̐̄͂̽͐̎̓̎̊̃͗̾̊͂̿̈́̍͒͆̌́̓̓̊̇́̀̊̌̅̈͌̅͋̋͂͒̌̀͗̕͘͘͜͜͜͝͠͝͝1̴̨̨̨̢̢̨̨̻̘̦̼͈͕̞̻̹̬͙̲̺͉̩̟̼̫̫̖̭̰̱͉̱͎̝̼̝̳̺̠̱̝͎̼̱̻̺̥̹̲̭̻̂̓͗͌̒̓̒̄̐̏͌̔͜͜0̵̢̨̡̡̠̦͍̳̘͇͔̻͇̳̙̙͙̫̭̰̼̳̖͔̙̝͍͔̦̱̲̟͙̻̰̯͔̖̝̰͚͉̼͔̼̺̜̥͉̀̃͆̅͑̒̀̐̎̑̓̇͑̍͛̔̇̌̉̏͐̊̓̆̒̿͒̈́̅̑̈́̅̃͛̓̉̀̽̓́͐̂́̓͐͋̂̒͗̋͗̐͆̇̀̀̽̾̏̀̓̋͊́̒̏͂̾̒̃̽̍̊͗͒̔͌̋̈́̔̽̀̽̈́͌̏̐̏̽́̍̾̈͑̍̀̔̐̈́̀͊̽̇̆̀̒͗͒̈́̋̀̈́͌̿̌́̊́̆̎̈͛̇́̉̾̄͑͘͘̚̚̕̚̕̚͘̕͘̚͜͝͠͝͝͝͝͝͝͠͝'){

        $_SESSION['location'] = 'UNKNOWN';
        $location = $_SESSION['location'];
    }
     if($x == "∞" and $y =='∞'){

        $_SESSION['location'] = 'Ascended plains';
        $location = $_SESSION['location'];
    }
    if($x == 7 and $y == 3){
        $_SESSION['location'] = 'Basement';
        $location = $_SESSION['location']; 
        $west = 0;
        $east = 1;
        $north = 0;
        $south = 0;

        $person = 0;
            $viewn = '<b> North:</b> A wall'; 
            $views = '<b> South:</b> A wall';
            $vieww = '<b> West:</b> A wall';
            $viewe = '<b> East:</b> Glowing light';
            $room = 'Glowing light stands before you';
        
        $item = 'nothing';
    }
    if($x == 8 and $y == 3){
        $_SESSION['location'] = 'Ascended plains';
        $location = $_SESSION['location']; 
        $west = 0;
        $east = 0;
        $north = 0;
        $south = 0;

        $person = 0;
            $viewn = '<b> North:</b> Made by Minnowo'; 
            $views = '<b> South:</b>  Written by Minnowo';
            $vieww = '<b> West:</b> Tested by Bee, Shelly, Father, Mother';
            $viewe = '<b> East:</b> The end';
            $room = 'Congrats!!!, you have finished Rottogram, thank you for playing';
        
        $item = 'nothing';
    }
?>