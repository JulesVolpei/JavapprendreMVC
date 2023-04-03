<?php
final class TableauScore
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance();
    }

    public function getScores(): array
    {
        // On vérifie que la variable de session "id" est initialisée
        if (!isset($_SESSION['id_exo'])) {
            // on retourne un tableau vide si la variable n'est pas initialisée
            return array();
        }

        $idExo = $_SESSION['id_exo'] + 1;
        $customWhere = "membre.mem_id=score.mem_id AND id_exo = :id_exo";
        $result = $this->pdo->select('membre, score', ['id_exo' => $idExo], 'pseudo, temps', $customWhere);
        return $result;
    }

    public function getExercice(): array
    {
        // On vérifie que la variable de session "id" est initialisée
        if (!isset($_SESSION['id_exo'])) {
            // on retourne un tableau vide si la variable n'est pas initialisée
            return array();
        }

        $idExo = $_SESSION['id_exo'] + 1;
        $result = $this->pdo->select('exos', ['id_exo' => $idExo]);
        return $result[0] ?? array();
    }
}