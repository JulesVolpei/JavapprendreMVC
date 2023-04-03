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
        // On vérifie que la variable de session "id_exo" est initialisée
        if (!isset($_SESSION['id_exo'])) {
            // On retourne un tableau vide si la variable n'est pas initialisée
            return array();
        }

        $id_exo = $_SESSION['id_exo'];
        $query = $this->pdo->prepare('SELECT pseudo, temps FROM membre, score WHERE membre.mem_id=score.mem_id AND id_exo = :id_exo ORDER BY temps ASC');
        $query->bindParam(':id_exo', $id_exo, PDO::PARAM_INT);
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

    public function afficherTableauScore(int $id_exo): void
    {
        $tableau_scores = $this->getScoresByIdExo($id_exo);
        $exercice = $this->getExerciceByIdExo($id_exo);
        Vue::montrer('TableauScore/tableau_score', array('tableau_scores' => $tableau_scores, 'exercice' => $exercice));
    }

    public function getScoresByIdExo(int $id_exo): array
    {
        $query = $this->pdo->prepare('SELECT pseudo, temps FROM membre, score WHERE membre.mem_id=score.mem_id AND id_exo = :id_exo ORDER BY temps ASC');
        $query->bindParam(':id_exo', $id_exo, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExerciceByIdExo(int $id_exo): array
    {
        $query = $this->pdo->prepare('SELECT * FROM exos WHERE id_exo = :id_exo');
        $query->bindParam(':id_exo', $id_exo, PDO::PARAM_INT);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

}