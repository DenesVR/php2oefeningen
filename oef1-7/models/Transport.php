<?php


abstract class Transport
{
    public $name;
    public function __construct($name) {
        $this->name = $name;
    }

    abstract public function way() : string;

}