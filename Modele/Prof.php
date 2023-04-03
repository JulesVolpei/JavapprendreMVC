<?php

class Prof
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance(Connection::ROLE_PROF)->pdo;
    }

    public function create($email, $token, $mem_id )
    {
        // Insertion des données dans la base de données
        $insert = $this->pdo->prepare('INSERT INTO prof(mail, token, confirme, approuve, mem_id) VALUES(?, ?, 0, 0, ?)');
        $insert->execute(array($email, $token, $mem_id));
    }
    public function findByEmail(string $email)
    {
        $result = $this->pdo->prepare("SELECT * FROM prof where mail= ?");
        $result->execute($email);
        $prof= $result->fetch();
        return $prof;
    }

    public function updateByToken(string $token, $mem_id)
    {
        $result = $this->pdo->prepare( 'UPDATE prof set token = ?, confirme = 1 where mem_id = ?'); //On insert dans la table exos le nom de l'exo, la description et le contenu
        $result->execute(array($token, $mem_id));
    }

    public function incrementAttempt($idExo)
    {
        $result = $this->pdo->prepare("SELECT * FROM prof where mem_id= ?");
        $result->execute($idExo);
        $essais= $result->fetch();
        $update = $this->pdo->prepare('upd')
    }
}