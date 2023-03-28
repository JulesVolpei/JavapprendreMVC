
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
}