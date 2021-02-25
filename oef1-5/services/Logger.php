<?php


class Logger
{

    private $fp;
    private $logfile;

    public function __construct($logfile) {
        $this->logfile = $logfile;
        $this->fp = fopen($this->logfile);
    }

    public function Log($msg) {
        fwrite($this->fp, date("d/m/Y", time()). " " . date("H:i:s", time()) . " " .$msg . '\r\n');
    }

    public function ShowLog() {

    }
}