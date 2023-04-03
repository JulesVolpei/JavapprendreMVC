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

    public function donneIndice($id_exo): array
    {
        return $this->pdo->select('exos_indices', ['id_exo' => $id_exo], 'indice', 'id_exo = :id_exo');
    }
    public function donneTests($id_exo): array
    {
        return  $this->pdo->select('tests', ['id_exo' => $id_exo], 'fichier', 'id_exo = :id_exo');
    }

    public function getTousLesTests(): array
    {
        return $this->pdo->select('tests');
    }
    public function getTousLesExercices(): array
    {
        return $this->pdo->select('exos');
    }



}