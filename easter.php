<?php

    class Eggs {

        private int $noOfEggs = 5;
        private int $computerEggs = 5;
        private array $yourTypesOfEggs = ["A", "C"];
        public array $eggs = [];
        public string $player;
        public int $playerBrokenSides = 0;
        public int $computerBrokenSides = 0;

        public function getEggs(): int {
            return $this->noOfEggs;
        }

        public function getComputerEggs(): int {
            return $this->computerEggs;
        }

        public function setLosingEggs(){
            $this->noOfEggs--;
        }

        public function setWinningEggs(){
            $this->noOfEggs++;
        }

        public function setLosingComputerEggs(){
            $this->computerEggs--;
        }

        public function setWinningComputerEggs(){
            $this->computerEggs++;
        }

        public function giveEggs() {

            for($i = 0; $i < $this->noOfEggs; $i++){
                $this->eggs[] = $this->yourTypesOfEggs[array_rand($this->yourTypesOfEggs)];
            }

        }

        public function addEgg(string $input) {
            $this->eggs[] = $input;
        }

        public function gameOver(){
            if($this->noOfEggs === 0 || $this->computerEggs === 0){
                die("Game over!");
            }
        }

    }

    class Game {

        private Eggs $eggs;
        Public int $chanceToWin = 50;

        public function __construct(Eggs $eggs){
            $this->eggs = $eggs;
        }

        public function getChanceToWin(): int {
            return $this->chanceToWin;
        }

        public function findWinner(): int {
            return rand(1, 100);
        }

        public function checkEggStrength() {
            if($this->eggs->player === "C") {
                $this->chanceToWin = 70;
            }
            if($this->eggs->player === "A") {
                $this->chanceToWin = 50;
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

        $selection = readline("Do you want to play? (Y/N) ");
        switch(strtoupper($selection)){
            case "Y":
                break;
            case "N":
                die("Bye");
        }

        $eggs->giveEggs();
        $game->checkEggStrength();

        $winner = $game->findWinner();

        if($eggs->playerBrokenSides === 1 && $eggs->computerBrokenSides === 1){
            $eggs->setLosingEggs();
            $eggs->setLosingComputerEggs();
            echo "You both lost your eggs!";
        }

        if($winner < $game->getChanceToWin()){
            $eggs->setWinningEggs();
            $eggs->setLosingComputerEggs();
            echo "Congratulations! You won!\n";
        }

        if($winner > $game->getChanceToWin()){
            $eggs->setLosingEggs();
            $eggs->setWinningComputerEggs();
            echo "Computer won!\n";
        }
        $eggs->gameOver();
    }
