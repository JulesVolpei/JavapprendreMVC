<?php
final class ChoixExercice {
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance()->pdo;
    }

    public function getTousLesExercices() : array {
        $result = $this->pdo->prepare('SELECT * FROM exos');
        $result->execute();
        $listeExercices = array();
        foreach($result as $exercice) {
            array_push($listeExercices, $exercice);
        }
        return $listeExercices;
    }
    public function getProgression($mem_id) : array {
        $result = $this->pdo->prepare('SELECT exo FROM membre where mem_id = ?');
        $result->execute(array($mem_id));
        $progression = $result->fetchAll();
        return $progression;
    }

}