<?php
if(in_array(5, $event) and !in_array(6, $event)){
    //if you have shield check to block
    if(in_array('shield', $equipped)){
        $rand1 = rand(1, 6);
    } else {
        $rand1 = 6;
    }
    if($rand1 <= 3){
        array_push($msg, "Your shield protects you from all damage");
    } else {
        array_push($msg, "The monster attacks");
        $dmg = rand(15, 78);
        $_SESSION['health'] -= $dmg;
    }
}
if(in_array(13, $event) and !in_array(14, $event)){
    //if you have shield check to block
    if(in_array('shield', $equipped)){
        $rand1 = rand(1, 6);
    } else {
        $rand1 = 6;
    }
    if($rand1 <= 3){
        array_push($msg, "Your shield protects you from all damage");
    } else {
        array_push($msg, "The monster attacks");
        $dmg = rand(25, 88);
        $_SESSION['health'] -= $dmg;
    }
}
?>
