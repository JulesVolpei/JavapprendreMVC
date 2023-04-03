<?php
final class TableauScore
{
    private $pdo;

    public function __construct()
    {
        // On récupère l'instance de la connexion à la base de données
        $this->pdo = Connection::getInstance()->pdo;
    }

    public function getScores(): array
    {
        // On vérifie que la variable GET "id_exo" est initialisée
        if (!isset($_GET['id_exo'])) {
            // Si la variable n'est pas initialisée, on retourne un tableau vide
            return array();
        }

        // On récupère la valeur de "id_exo" dans la variable $idExo
        $idExo = $_GET['id_exo'];

        // On prépare une requête SQL pour récupérer les scores et les pseudos correspondants à l'exercice sélectionné
        $query = $this->pdo->prepare('select pseudo, temps from membre, score where membre.mem_id=score.mem_id and id_exo = :id_Exo ORDER BY temps ASC');

        // On lie la variable $idExo au paramètre ":id_Exo" de la requête préparée
        $query->bindParam("id_Exo", $idExo);

        // On exécute la requête préparée
        $query->execute();

        // On retourne le résultat sous forme de tableau associatif
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getExercice(): array
    {
        // On vérifie que la variable GET "id_exo" est initialisée
        if (!isset($_GET['id_exo'])) {
            // Si la variable n'est pas initialisée, on retourne un tableau vide
            return array();
        }

        // On récupère la valeur de "id_exo" dans la variable $idExo
        $idExo = $_GET['id_exo'];

        // On prépare une requête SQL pour récupérer les informations de l'exercice sélectionné
        $query = $this->pdo->prepare('select * from exos where id_exo = :id_Exo');

        // On lie la variable $idExo au paramètre ":id_Exo" de la requête préparée
        $query->bindParam("id_Exo", $idExo);

        // On exécute la requête préparée
        $query->execute();

        // On retourne le résultat sous forme de tableau associatif
        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
