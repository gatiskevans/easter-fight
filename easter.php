<?php

    class Eggs {

        private int $noOfEggs = 5;
        private int $noOfComputerEggs = 5;
        private array $typesOfEggs = ["A", "C"];
        public array $eggs = [];
        public array $computerEggs = [];
        public int $playerBrokenSides = 0;
        public int $computerBrokenSides = 0;

        public function getEggs(): int {
            return count($this->eggs);
        }

        public function getComputerEggs(): int {
            return count($this->computerEggs);
        }
        
        public function giveEggs() {

            for($i = 0; $i < $this->noOfEggs; $i++){
                $this->eggs[] = $this->typesOfEggs[array_rand($this->typesOfEggs)];
            }

            for($i = 0; $i < $this->noOfComputerEggs; $i++){
                $this->computerEggs[] = $this->typesOfEggs[array_rand($this->typesOfEggs)];
            }

        }

        public function addEgg(string $input) {
            $this->eggs[] = $input;
        }

        public function gameOver(){
            if($this->noOfEggs === 0 || $this->noOfComputerEggs === 0){
                die("Game over!");
            }
        }

    }

    class Game {

        private Eggs $eggs;
        Public int $chanceToWin = 50;
        Public int $chanceComputerWin = 50;

        public function __construct(Eggs $eggs){
            $this->eggs = $eggs;
        }

        public function getChanceToWin(): int {
            return $this->chanceToWin;
        }

        public function findWinner(): int {
            return rand(1, $this->chanceToWin+$this->chanceComputerWin);
        }

        public function checkEggStrength(string $yourEgg, string $computersEgg) {
            if($yourEgg === "C") {
                $this->chanceToWin = 70;
            }
            if($yourEgg === "A") {
                $this->chanceToWin = 50;
            }

            if($computersEgg === "C") {
                $this->chanceComputerWin = 70;
            }
            if($computersEgg === "A") {
                $this->chanceComputerWin = 50;
            }

        }

    }

    $eggs = new Eggs();
    $game = new Game($eggs);
    $eggs->giveEggs();
    echo "Welcome to the game!\n";

    while(true){

        echo "You have {$eggs->getEggs()} eggs!\n";
        echo "Computer has {$eggs->getComputerEggs()} eggs!\n";
        var_dump($eggs->eggs);
        var_dump($eggs->computerEggs);
        $yourEgg = array_shift($eggs->eggs);
        $computersEgg = array_shift($eggs->computerEggs);

        var_dump($yourEgg);
        var_dump($computersEgg);

        $selection = readline("Do you want to play? (Y/N) ");
        switch(strtoupper($selection)){
            case "Y":
                break;
            case "N":
                die("Bye");
        }

        $game->checkEggStrength($yourEgg, $computersEgg);

        $valueForWinner = $game->findWinner();

        if($eggs->playerBrokenSides === 1 && $eggs->computerBrokenSides === 1){
            echo "You both lost your eggs!";
        }

        if($valueForWinner <= $game->getChanceToWin()){
            $eggs->eggs[] = $yourEgg;
            echo "Congratulations! You won!\n";
        }

        if($valueForWinner > $game->getChanceToWin()){
            $eggs->computerEggs[] = $computersEgg;
            echo "Computer won!\n";
        }
        $eggs->gameOver();
    }
