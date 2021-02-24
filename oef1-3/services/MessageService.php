<?php


class MessageService
{
    private $errors;
    private $input_errors;
    private $infos;

    /**
     * @return mixed
     */
    public function getErrors()
    {
        return $this->errors;
    }

    /**
     * @param mixed $errors
     */
    public function setErrors($errors): void
    {
        $this->errors = $errors;
    }

    /**
     * @return mixed
     */
    public function getInputErrors()
    {
        return $this->input_errors;
    }

    /**
     * @param mixed $input_errors
     */
    public function setInputErrors($input_errors): void
    {
        $this->input_errors = $input_errors;
    }

    /**
     * @return mixed
     */
    public function getInfos()
    {
        return $this->infos;
    }

    /**
     * @param mixed $infos
     */
    public function setInfos($infos): void
    {
        $this->infos = $infos;
    }
}