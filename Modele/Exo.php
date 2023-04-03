<?php

final class Exo //Définition de la classe Exo
{
    private $pdo; //Déclaration d'une variable $pdo en privé

    public function __construct() //Définition d'une fonction constructeur pour initialiser l'objet
    {
        $this->pdo = Connection::getInstance(); //Initialisation de la variable $pdo avec une instance de la classe Connection
    }

    public function donneExo($id_exo) //Définition d'une fonction donneExo qui prend en paramètre un identifiant d'exercice
    {
        $result = $this->pdo->select('exos', ['id_exo' => $id_exo], '*', 'id_exo = :id_exo'); //Exécution d'une requête SELECT sur la table "exos" pour récupérer les données de l'exercice correspondant à l'identifiant donné
        return $result[0]; //Retourne le premier élément du tableau $result, qui contient les données de l'exercice
    }

    public function donneIndice($id_exo): array //Définition d'une fonction donneIndice qui prend en paramètre un identifiant d'exercice et retourne un tableau
    {
        return $this->pdo->select('exos_indices', ['id_exo' => $id_exo], 'indice', 'id_exo = :id_exo'); //Exécution d'une requête SELECT sur la table "exos_indices" pour récupérer les indices de l'exercice correspondant à l'identifiant donné
    }
    public function donneTests($id_exo): array //Définition d'une fonction donneTests qui prend en paramètre un identifiant d'exercice et retourne un tableau
    {
        return  $this->pdo->select('tests', ['id_exo' => $id_exo], 'fichier', 'id_exo = :id_exo'); //Exécution d'une requête SELECT sur la table "tests" pour récupérer les fichiers de tests de l'exercice correspondant à l'identifiant donné
    }

    public function getTousLesTests(): array //Définition d'une fonction getTousLesTests qui retourne un tableau
    {
        return $this->pdo->select('tests'); //Exécution d'une requête SELECT sur la table "tests" pour récupérer tous les fichiers de tests
    }
    public function getTousLesExercices(): array //Définition d'une fonction getTousLesExercices qui retourne un tableau
    {
        return $this->pdo->select('exos'); //Exécution d'une requête SELECT sur la table "exos" pour récupérer tous les exercices
    }
}
