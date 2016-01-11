<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title>A00925364 Yi Dai Tic-Tac-Toe</title>
    </head>
    <body>
        <?php

        class Game {
            
            var $position;
            var $newposition;

            //Constructor
            function __construct($squares) {
                $this->position = str_split($squares);
            }

            //Set up the winner condition
            function winner($token) {
                $won = false;
                //the diagonal win condition
                if (($this->position[0] == $token) && ($this->position[4] == $token) && ($this->position[8] == $token)) {
                    $won = true;
                } else if (($this->position[2] == $token) && ($this->position[4] == $token) && ($this->position[6] == $token)) {
                    $won = true;
                } else {
                    //horizontal and vertical win condition
                    for ($row = 0; $row < 3; $row++) {
                        $result = true;
                        for ($col = 0; $col < 3; $col++) {
                            if ($this->position[3 * $row + $col] != $token) {
                                $result = false;
                            }
                        }
                        if ($result) {
                            $won = true;
                        }
                    }
                    for ($col = 0; $col < 3; $col++) {
                        if (($this->position[0 + $col] == $token) && ($this->position[3 + $col] == $token) && ($this->position[6 + $col] == $token)) {
                            $won = true;
                        }
                    }
                }
                return $won;
            }

            function show_cell($which) {
                $token = $this->position[$which];
                if ($token <> '-') {
                    return '<td>' . $token . '</td>';
                }
                $this->newposition = $this->position; // copy the original
                $this->newposition[$which] = 'x'; // My move
                for ($pos = 0; $pos < 9; $pos++) {
                    //Check the square from first one to the last one, then place the AI's move
                    if ($this->newposition[$pos] == '-') {
                        $this->newposition[$pos] = 'o'; // AI's move
                        break;
                    }
                }
                $move = implode($this->newposition);
                //Change link presentation, Click method
                $link = '/ACIT4850-Lab01/?board=' . $move;
                return '<td><a href="' . $link . '">-</a></td>';
            }

            //Display the board with styles
            function display() {
                echo '<table cols="3" style="font-size:large; font-weight:bold">';
                echo '<tr>';
                for ($pos = 0; $pos < 9; $pos++) {
                    echo $this->show_cell($pos);
                    if ($pos % 3 == 2) {
                        echo '</tr><tr>';
                    }
                }
                echo '</tr>';
                echo '</table>';
            }

        }


        //Set the board
        if (isset($_GET['board'])) {
            $position = $_GET['board'];
        } else {
            $position = "---------";
        }

        //Initialate the game and display the board
        $game = new Game($position);
        $game->display();
        
        //Set the win/lose statement
        if ($game->winner('x')) {
            echo 'You win. Lucky guesses!';
        } else if ($game->winner('o')) {
            echo 'I win. Muahahahahaaaa';
        } else {
            echo "No winner yet, but you are losing.";
        }
        ?>
    </body>
</html>