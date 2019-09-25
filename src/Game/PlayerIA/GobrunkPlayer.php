<?php

namespace Hackathon\PlayerIA;
use Hackathon\Game\Result;

/**
 * Class PaperPlayer
 * @package Hackathon\PlayerIA
 * @author Robin
 *
 */
class GobrunkPlayer extends Player
{
    protected $mySide;
    protected $opponentSide;
    protected $result;
    protected $opponentScissors;
    protected $opponentPaper;
    protected $opponentRock;

    public function getChoice()
    {
        $a = $this->result->getStatsFor($this->opponentSide);
        $nbRound = $this->result->getNbRound() == 0 ? 1 : $this->result->getNbRound();

        $scissors = $a["scissors"];
        $rock = $a["rock"];
        $paper = $a["paper"];

        if($nbRound / 50 == 1) {
            $this->opponentScissors = 1;
            $this->opponentRock = 1;
            $this->opponentPaper = 1;
        }
        else {
            if($this->result->getLastChoiceFor($this->opponentSide) == "rock") {
                $this->opponentRock++;
            }
            if($this->result->getLastChoiceFor($this->opponentSide) == "paper") {
                $this->opponentPaper++;
            }
            if($this->result->getLastChoiceFor($this->opponentSide) == "scissors") {
                $this->opponentScissors++;
            }
        }

        $scissorsValue = ($scissors / $nbRound) * ($this->opponentScissors / ($nbRound / 50));
        $rockValue = ($rock / $nbRound) * ($this->opponentRock/ ($nbRound / 50));
        $paperValue = ($paper / $nbRound) * ($this->opponentPaper/ ($nbRound / 50));

        print_r($this->result->getChoicesFor($this->mySide));


        if($paperValue > $rockValue && $paperValue > $scissorsValue) {
            return parent::scissorsChoice();
        }
        if($rockValue > $paperValue && $rockValue > $scissorsValue) {
            return parent::paperChoice();
        }
        if($scissorsValue > $rockValue && $scissorsValue > $paperValue) {
            return parent::rockChoice();
        }
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Choice           ?    $this->result->getLastChoiceFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Choice ?    $this->result->getLastChoiceFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide) -- if 0 (first round)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide) -- if 0 (first round)
        // -------------------------------------    -----------------------------------------------------
        // How to get all the Choices          ?    $this->result->getChoicesFor($this->mySide)
        // How to get the opponent Last Choice ?    $this->result->getChoicesFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
       // How to get my Last Score            ?    $this->result->getLastScoreFor($this->mySide)
        // How to get the opponent Last Score  ?    $this->result->getLastScoreFor($this->opponentSide)
        // -------------------------------------    -----------------------------------------------------
        // How to get the stats                ?    $this->result->getStats()
        // How to get the stats for me         ?    $this->result->getStatsFor($this->mySide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // How to get the stats for the oppo   ?    $this->result->getStatsFor($this->opponentSide)
        //          array('name' => value, 'score' => value, 'friend' => value, 'foe' => value
        // -------------------------------------    -----------------------------------------------------
        // How to get the number of round      ?    $this->result->getNbRound()
        // -------------------------------------    -----------------------------------------------------
        // How can i display the result of each round ? $this->prettyDisplay()
        // -------------------------------------    -----------------------------------------------------
        return parent::paperChoice();


  }
};
