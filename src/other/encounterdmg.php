<?php
if(in_array(9, $event)){
            $rand = rand(1, 5);
            if($rand < 5){
                array_push($msg, 'The creature bites you');
                $dmg = rand(5, 20);
                $_SESSION['health'] -= $dmg;
            } else {
                array_push($msg, 'The creature fails to bite you');
            } 
        }
?>