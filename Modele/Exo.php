<?php

final class Exo
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance();
    }

    public function donneExo($id_exo)
    {
        $result = $this->pdo->select('exos', ['id_exo' => $id_exo], '*', 'id_exo = :id_exo');
        return $result[0];
    }

    public function donneIndice($id_exo)
    {

        $result = $this->pdo->select('exos_indices', ['id_exo' => $id_exo], '*', 'id_exo = :id_exo');
        if (!empty($result)) {
            return $result[0];
        }
        else {
            return;
        }
    }

    public function getTousLesExercices(): array
    {
        return $this->pdo->select('exos');
    }

    public function getExoEtTests($idExo)
    {
        return $this->pdo->select('exos', ['id_exo' => $idExo])[0];
    }

}