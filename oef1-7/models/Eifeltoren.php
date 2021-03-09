<?php


class Eifeltoren implements Monuments
{
    public function momumentsName() {
        echo "Eifeltoren";
    }

    public function monumentsInfo() {
        echo "De ".$this->momumentsName()." is 300m hoog.";
    }
}