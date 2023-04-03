<?php

class Prof
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance(Connection::ROLE_PROF)->pdo;
    }

    public function create($email, $nom, $profession, $token, $mem_id )
    {
        // Insertion des données dans la base de données
        $insert = $this->pdo->prepare('INSERT INTO prof(mail, nom, profession, token, confirme, approuve, mem_id) VALUES(?, ?, ?, ?, 0, 0, ?)');
        $insert->execute(array($email, $nom, $profession, $token, $mem_id));
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

    public function incrementAttempt($mem_id)
    {
        $result = $this->pdo->prepare("SELECT * FROM prof where mem_id= ?");
        $result->execute($mem_id);
        $result->fetch();
        $essais = $result['attempts'] + 1;
        $update = $this->pdo->prepare('update prof set attempts = ? where mem_id = ?');
        return ($update->execute($essais,$mem_id));
    }
    public function deleteProfessor($prof_id)
    {
        $query = 'DELETE FROM prof WHERE prof_id = :prof_id';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':idExo', $prof_id, PDO::PARAM_INT);
        $statement->execute();
    }
}