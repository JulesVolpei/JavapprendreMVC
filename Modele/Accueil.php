<?php

final class Accueil
{
    private $_S_message = "";

    public function donneMessage($message)
    {
        $this->_S_message = $message;
    }

    public function getMessage()
    {
        return $this->_S_message;
    }
}
