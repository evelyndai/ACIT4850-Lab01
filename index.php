<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
        class Game {

        var $position;
        var $newposition;

        function __construct($squares) {
        $this->position = str_split($squares);
        }


        function winner($token){
        $won = false;
        if(($this->position[0] ==$token) && ($this->position[4] == $token) && ($this->position[8] == $token)){
          $won = true;
        }
        else if(($this->position[2] == $token) && ($this->position[4] == $token) && ($this->position[6] == $token)){
          $won = true;
        }
        else{
          for($row=0; $row<3; $row++){
            $result = true;
            for($col=0; $col<3; $col++){
              if($this->position[3*$row+$col] != $token){
                $result = false;
              }
            }
            if($result){
              $won = true;
            }
          }
          for($col=0; $col<3; $col++){
            if(($this->position[0+$col] == $token) && ($this->position[3+$col] == $token) && ($this->position[6+$col] == $token)){
              $won = true;
            }
          }
        }
        return $won;
      }
function show_cell($which){
        $token = $this->position[$which];
        if($token <> '-'){
          return '<td>'.$token.'</td>';
        }
        $this->newposition = $this->position;// copy the original
        $this->newposition[$which] = 'x';
        for($pos=0; $pos<9; $pos++){
          if($this->newposition[$pos] == '-'){
            $this->newposition[$pos] = 'o';
            break;
          }
        }
        $move = implode($this->newposition);
        //$link = '/acit4850-lab1/?board='.$move;
        $link = '/ACIT4850-Lab01/?board='.$move;
        return '<td><a href="'.$link.'">-</a></td>';
      }
      
      
function display(){
        echo '<table cols="3" style="font-size:large; font-weight:bold">';
        echo '<tr>';
        for($pos=0; $pos<9; $pos++){
          echo $this->show_cell($pos);
          if($pos %3 == 2){
            echo '</tr><tr>';
          }
        }
        echo '</tr>';
        echo '</table>';
      }
    }

//        if (winner('x', $squares)) echo 'You win.';
//        else if (winner('o', $squares)) echo 'I win.';
//        else echo 'No winner yet.';



        if(isset($_GET['board'])){
        $position = $_GET['board'];
        }
        else{
        $position = "---------";
        }

       $game = new Game($position);
    $game->display();
    if($game->winner('x')){
      echo 'You win. Lucky guesses!';
    }
    else if($game->winner('o')){
      echo 'I win. Muahahahahaaaa';
    }
    else{
      echo "No winner yet, but you are losing.";
    }
        ?>
    </body>
</html>