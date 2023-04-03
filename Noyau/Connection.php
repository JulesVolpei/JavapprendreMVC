<?php

final class Connection
{

    public PDO $pdo;

    private static ?self $instance = null;
    public const ROLE_ADMIN = 'admin';
    public const ROLE_PROF = 'prof';
    public const ROLE_MEMBRE = 'membre';

    private string $userRole;
    private const db_server_name = "mysql-javapprendre.alwaysdata.net";
    private const db_username = "302330";
    private const db_password = "javapprendre";
    private const db_name = "javapprendre_db";

    private function __construct(string $userRole)
    {
        $this->userRole = $userRole;
        $this->pdo = new PDO(
            sprintf('mysql:dbname=%s;host=%s', self::db_name, self::db_server_name),
            self::db_username,
            self::db_password
        );
    }

    public static function getInstance(string $userRole = self::ROLE_MEMBRE): self
    {
        if (null === self::$instance) {
            self::$instance = new self($userRole);
        }
        return self::$instance;
    }
    public function getPdo()
    {
        return $this->pdo;
    }
    private function getCurrentUserId(): int
    {
        // Récupérez l'ID de l'utilisateur actuellement connecté à partir de votre système d'authentification
        // Par exemple, si vous stockez l'ID de l'utilisateur dans une session :
        return $_SESSION['mem_id'];
    }
    private function checkPermission(string $action, string $table, array $conditions = []): bool
    // on a pas eu le temps de bien l'implémenter
    {
        if ($this->userRole === self::ROLE_ADMIN ||$this->userRole === self::ROLE_PROF ) {
            return true;
        }

        if ($table === 'exos') {
            if ($this->userRole === self::ROLE_PROF && in_array($action, ['update',  'delete'])) {
                // Vérifier si l'exercice appartient au professeur
                $exercice = $this->select($table, $conditions);
                if (!empty($exercice) && $exercice[0]['created_by'] == $this->getCurrentUserId()) {
                    return true;
                }
            }
        }

        if ($action === 'select') {
            return true;
        }




        return false;
    }

    public function insert(string $table, array $parameters): bool
    {
        if (!$this->checkPermission('insert', $table, $parameters)) {
            throw new RuntimeException("Vous n'avez pas la permission d'effectuer cette action.");
        }
        $attributes = implode(', ', array_keys($parameters));
        $valueKeys = implode(', ', array_map(fn(string $value) => ':' . $value, array_keys($parameters)));
        $query = sprintf('INSERT INTO %s (%s) VALUES (%s)', $table, $attributes, $valueKeys);

        $stmt = $this->pdo->prepare($query);
        foreach ($parameters as $attribute => $value) {
            $stmt->bindValue(':' . $attribute, $value);
        }
        $result = $stmt->execute();

        if (false === $result) {
            throw new RuntimeException(sprintf(
                "Cannot insert value for table %s and value %s. SQL error code : %s. SQL error info : %s",
                $table,
                json_encode($parameters),
                $stmt->errorCode(),
                json_encode($stmt->errorInfo())
            ));
        }
        return $result;
    }

    public function delete(string $table, $where)
    {
        if (!$this->checkPermission('delete', $table, ['where' => $where])) {
            throw new RuntimeException("Vous n'avez pas la permission d'effectuer cette action.");
        }
        $query = "DELETE FROM $table WHERE $where";

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            die('Error : ' . $e->getMessage());
        }
    }

    public function update(string $table, $data, $where)
    {
        if (!$this->checkPermission('update', $table, ['data' => $data, 'where' => $where])) {
            throw new RuntimeException("Vous n'avez pas la permission d'effectuer cette action.");
        }
        $query = "UPDATE $table SET ";
        $parameters = array();
        foreach ($data as $key => $value) {
            $parameters[] = "$key = :$key";
        }
        $query .= implode(', ', $parameters);
        $query .= " WHERE $where";

        try {
            $stmt = $this->pdo->prepare($query);
            $stmt->execute($data);
            return true;
        } catch (PDOException $e) {
            die('Error : ' . $e->getMessage());
        }
    }
    public function select(string $table, array $conditions = [], string $selectFields = '*', string $customWhere = ''): array
    {
        if (!$this->checkPermission('select', $table, $conditions)) {
            throw new RuntimeException("Vous n'avez pas la permission d'effectuer cette action.");
        }
        $query = "SELECT $selectFields FROM $table";

        if (!empty($customWhere)) {
            $query .= ' WHERE ' . $customWhere;
        }

        try {
            $stmt = $this->pdo->prepare($query);
            foreach ($conditions as $key => $value) {
                $stmt->bindParam(":$key", $value);
            }
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            die('Error : ' . $e->getMessage());
        }
    }
}

