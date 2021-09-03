<?php

    class Eggs {

        private int $noOfEggs = 5;
        private int $noOfComputerEggs = 5;
        private array $typesOfEggs = ["A", "B", "C", "D"];
        public array $eggs = [];
        public array $computerEggs = [];
        private int $playerBrokenSides = 0;
        private int $computerBrokenSides = 0;

        public function getEggs(): int {
            return $this->noOfEggs = count($this->eggs);
        }

        public function getComputerEggs(): int {
            return $this->noOfComputerEggs = count($this->computerEggs);
        }

        public function getPlayerBrokenSides(): int {
            return $this->playerBrokenSides;
        }

        public function getComputerBrokenSides(): int {
            return $this->computerBrokenSides;
        }

        public function removeEgg(): void {
            array_shift($this->eggs);
        }

        public function removeComputerEgg(): void {
            array_shift($this->computerEggs);
        }

        public function setPlayerBrokenSides(int $input): void {
            $this->playerBrokenSides += $input;
        }

        public function setComputerBrokenSides(int $input): void {
            $this->computerBrokenSides += $input;
        }

        public function giveEggs(): void {

            for($i = 0; $i < $this->noOfEggs; $i++){
                $this->eggs[] = $this->typesOfEggs[array_rand($this->typesOfEggs)];
            }

            for($i = 0; $i < $this->noOfComputerEggs; $i++){
                $this->computerEggs[] = $this->typesOfEggs[array_rand($this->typesOfEggs)];
            }

        }

        public function addEgg(string $input): void {
            $this->eggs[] = $input;
        }

        public function addComputersEgg(string $input): void {
            $this->computerEggs[] = $input;
        }

        public function gameOver(): void {
            if($this->noOfEggs === 0 && $this->noOfComputerEggs === 0){
                die("\e33mGame over! You both lost!\e[0m");
            }

            if($this->noOfEggs === 0){
                die("\e[31mGame over! Computer won!\e[0m");
            }

            if($this->noOfComputerEggs === 0){
                die("\e[32mGame over! You won!\e[0m");
            }

        }

    }

    class Game {

        Public int $chanceToWin = 50;
        Public int $chanceComputerWin = 50;

        public function getChanceToWin(): int {
            return $this->chanceToWin;
        }

        public function findWinner(): int {
            return rand(1, $this->chanceToWin+$this->chanceComputerWin);
        }

        public function checkEggStrength(string $yourEgg, string $computersEgg): void {
            if($yourEgg === "A") $this->chanceToWin = 50;
            if($yourEgg === "B") $this->chanceToWin = 65;
            if($yourEgg === "C") $this->chanceToWin = 70;
            if($yourEgg === "D") $this->chanceToWin = 85;
            if($computersEgg === "A") $this->chanceComputerWin = 50;
            if($computersEgg === "B") $this->chanceComputerWin = 65;
            if($computersEgg === "C") $this->chanceComputerWin = 70;
            if($computersEgg === "D") $this->chanceToWin = 85;
        }

    }

    $eggs = new Eggs();
    $game = new Game();
    $eggs->giveEggs();
    echo "Welcome to the game!\n";

    while(true){

        echo "You have {$eggs->getEggs()} eggs!\n";
        echo "Computer has {$eggs->getComputerEggs()} eggs!\n\n";
        $eggs->gameOver();

        $yourEgg = $eggs->eggs[0];
        $computersEgg = $eggs->computerEggs[0];

        $selection = readline("Press ENTER to play, type N to exit program! ");
        switch(strtoupper($selection)){
            case "":
                break;
            case "N":
                die("Bye. You left with {$eggs->getEggs()} eggs!");
        }

        $game->checkEggStrength($yourEgg, $computersEgg);

        $valueForWinner = $game->findWinner();

        echo "You have type '$yourEgg' egg!\n";
        echo "Computer has type '$yourEgg' egg!\n\n";
        echo "$yourEgg ({$eggs->getPlayerBrokenSides()}) egg VS $computersEgg ({$eggs->getComputerBrokenSides()}) egg\n";
        echo "\e[31mFIGHTING\e[0m\n";
        usleep(2000000);

        if($valueForWinner <= $game->getChanceToWin()){
            $eggs->setComputerBrokenSides(1);
            echo "\n\e[32mYou hit computers egg!\e[0m\n";
            echo "$yourEgg ({$eggs->getPlayerBrokenSides()}) egg VS $computersEgg ({$eggs->getComputerBrokenSides()}) egg\n";
            if($eggs->getComputerBrokenSides() === 2){
                $eggs->setComputerBrokenSides(-2);
                $eggs->addEgg($computersEgg);
                $eggs->removeComputerEgg();
                echo "\e[32mCongratulations! You won!\e[0m\n";
            }
        }

        if($valueForWinner > $game->getChanceToWin()){
            $eggs->setPlayerBrokenSides(1);
            echo "\n\e[31mComputer hit your egg!\e[0m\n";
            echo "$yourEgg ({$eggs->getPlayerBrokenSides()}) egg VS $computersEgg ({$eggs->getComputerBrokenSides()}) egg\n";
            if($eggs->getPlayerBrokenSides() === 2){
                $eggs->setPlayerBrokenSides(-2);
                $eggs->addComputersEgg($yourEgg);
                $eggs->removeEgg();
                echo "\e[31mComputer won!\e[0m\n";
            }
        }

        if($eggs->getPlayerBrokenSides() === 1 && $eggs->getComputerBrokenSides() === 1){
            $eggs->setComputerBrokenSides(-1);
            $eggs->setPlayerBrokenSides(-1);
            $eggs->removeEgg();
            $eggs->removeComputerEgg();
            echo "\e[33mYou both have 1 broken side on the egg. It's a tie!\e[0m\n";
            echo "\e[33mYou both lost your eggs!\e[0m\n";
        }
    }
