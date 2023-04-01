<?php
final class TableauScore
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance()->pdo;
    }

    public function getScores(): array
    {
        // On véréfie que la variable de session "id" est initialisée
        if (!isset($_SESSION['id'])) {
            // on retourne un tableau vide si la variable n'est pas initialisée
            return array();
        }

        $idExo = $_SESSION['id'] + 1;
        $query = $this->pdo->prepare('select pseudo, temps from membre, score where membre.mem_id=score.mem_id and id_exo = :id_Exo ORDER BY temps ASC');
        $query->bindParam("id_Exo", $idExo);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExercice(): array
    {
        // On véréfie que la variable de session "id" est initialisée
        if (!isset($_SESSION['id'])) {
            // on retourne un tableau vide si la variable n'est pas initialisée
            return array();
        }

        $idExo = $_SESSION['id'] + 1;
        $query = $this->pdo->prepare('select * from exos where id_exo = :id_Exo');
        $query->bindParam("id_Exo", $idExo);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}