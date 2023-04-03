<?php
// Déclaration de la classe
final class ChoixExercice {
    private $connection;

    // Initialisation de la connexion à la base de données dans le constructeur
    public function __construct()
    {
        $this->connection= Connection::getInstance();
    }

    // Fonction qui permet de récupérer tous les exercices
    public function getTousLesExercices() : array {
        // On récupère la liste de tous les exercices depuis la base de données
        $listeExercices = $this->connection->select('exos');
        // On retourne la liste des exercices récupérés
        return $listeExercices;
    }
}
