<?php

    class Eggs {
        private int $eggs = 5;
        private int $computerEggs = 5;
        private array $yourTypesOfEggs = ["A"];
        private array $computerTypesOfEggs = ["B"];
        private array $occurrences = ["A", "B"];
        public string $player = "A";
        public string $computer = "B";

        public function getEggs(): int {
            return $this->eggs;
        }

        public function getComputerEggs(): int {
            return $this->computerEggs;
        }

        public function setLosingEggs(){
            $this->eggs--;
        }

        public function setWinningEggs(){
            $this->eggs++;
        }

        public function setLosingComputerEggs(){
            $this->computerEggs--;
        }

        public function setWinningComputerEggs(){
            $this->computerEggs++;
        }

        public function getOccurrences(): array {
            return $this->occurrences;
        }

        public function gameOver(){
            if($this->eggs === 0 || $this->computerEggs === 0){
                die("Game over!");
            }
        }

    }

    class Game {
        private Eggs $eggs;
        public function __construct(Eggs $eggs){
            $this->eggs = $eggs;
        }

        public function findWinner(): string {
            return $this->eggs->getOccurrences()[array_rand($this->eggs->getOccurrences())];
        }

    }

    $eggs = new Eggs();
    $game = new Game($eggs);
    echo "Welcome to the game!\n";

    while(true){

        echo "You have {$eggs->getEggs()} eggs!\n";
        echo "Computer has {$eggs->getComputerEggs()} eggs!\n";

        $selection = readline("Do you want to play? (Y/N) ");
        switch(strtoupper($selection)){
            case "Y":
                break;
            case "N":
                die("Bye");
        }

        $winner = $game->findWinner();

        if($winner === $eggs->player){
            $eggs->setWinningEggs();
            $eggs->setLosingComputerEggs();
            echo "Congratulations! You won!\n";
        }

        if($winner === $eggs->computer){
            $eggs->setLosingEggs();
            $eggs->setWinningComputerEggs();
            echo "Computer won!\n";
        }
        $eggs->gameOver();
    }
