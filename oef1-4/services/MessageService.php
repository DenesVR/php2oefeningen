<?php


class MessageService
{
    private $errors;
    private $input_errors;
    private $infos;

    public function __construct() {
        $this->errors = $_SESSION['errors'];
        $_SESSION['errors'] = [];

        $this->infos = $_SESSION['msgs'];
        $_SESSION['msgs'] = [];

        $this->input_errors = $_SESSION['input_errors'];
        $_SESSION['input_errors'] = [];
    }

    public function CountErrors() {
        return count($this->errors);
    }

    public function CountInputErrors() {
        return count($this->input_errors);
    }

    public function CountInfos() {
        return count($this->infos);
    }

    public function CountNewErrors() {
        return count($_SESSION['errors']);
    }

    public function CountNewInputErrors() {
        return count($_SESSION['input_errors']);
    }

    public function CountNewInfos() {
        return count($_SESSION['infos']);
    }

    public function GetInputErrors() {
        if($this->CountInputErrors() > 0) {
            return $this->input_errors;
        } else {
            return null;
        }
    }

    public function AddMessage($type, $msg, $key = null) {

    }

    public function ShowErrors() {
        return print "<p style='color:red'>$this->errors</p>";
    }

    public function ShowInfos() {
        return print "<div class='msgs'>$this->infos</div>";
    }
}