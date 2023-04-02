
<?php

final class Exo
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance()->pdo;
    }

    public function donneExo($id_exo)
    {
        $result = $this->pdo->prepare("SELECT * FROM exos where id_exo= :id_exo");
        $result->execute(['id_exo' => $id_exo]);
        $exoChoisi = $result->fetch();
        return $exoChoisi;
    }
    public function donneIndice($id_exo)
    {
        $result = $this->pdo->prepare("SELECT * FROM exos_indices where id_exo= :id_exo");
        $result->execute(['id_exo' => $id_exo]);
        $indice= $result->fetch();
        return $indice;
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
    public function getExoEtTests($idExo) {
        $pdo = $this->getPdo();
        $sql = "SELECT * FROM exos WHERE id_exo = :id_exo";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['id_exo' => $idExo]);
        return $stmt->fetch();
    }

}