<?php
final class ChoixExercice {
    private $connection;

    public function __construct()
    {
        $this->connection= Connection::getInstance();
    }

    public function getTousLesExercices() : array {
        $listeExercices = $this->connection->select('exos');
        return $listeExercices;
    }


}