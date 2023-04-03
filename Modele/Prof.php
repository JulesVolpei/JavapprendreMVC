<?php

class Prof
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance(Connection::ROLE_PROF);
    }

    public function createProf($email, $nom, $profession, $token, $mem_id)
    {
        $data = [
            'mail' => $email,
            'nom' => $nom,
            'profession' => $profession,
            'token' => $token,
            'confirme' => 0,
            'approuve' => 0,
            'mem_id' => $mem_id
        ];
        $this->pdo->insert('prof', $data);
    }

    public function findByEmail(string $email)
    {
        $customWhere = "mail = :mail";
        $result = $this->pdo->select('prof', ['mail' => $email], '*', $customWhere);
        return $result[0] ?? null;
    }

    public function updateByToken(string $token, $mem_id)
    {
        $data = [
            'token' => $token,
            'confirme' => 1
        ];
        $conditions = ['mem_id' => $mem_id];
        $this->pdo->update('prof', $data, $conditions);
    }

    public function incrementAttempt($mem_id)
    {
        $prof = $this->pdo->select('prof', ['mem_id' => $mem_id])[0];
        $essais = $prof['attempts'] + 1;
        $data = ['attempts' => $essais];
        $conditions = ['mem_id' => $mem_id];
        $this->pdo->update('prof', $data, $conditions);
    }

    public function deleteProfessor($prof_id)
    {
        $this->pdo->delete('prof', ['prof_id' => $prof_id]);
    }
}