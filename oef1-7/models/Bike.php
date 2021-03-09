<?php


class Bike extends Transport
{

    public function way(): string
    {
        return "Rent a $this->name to discover the city";
    }
}