<?php
final class Utilisateur {
    private $pdo;
    private $connection;
    public function __construct()
    {
        $this->pdo = Connection::getInstance(Connection::ROLE_ADMIN);

    }

    public function checkPasswordStrength(string $password): bool
    {
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);

        return $uppercase && $lowercase && $number && $specialChars && strlen($password) >= 8;
    }
    public function estValide($pseudo, $email, $mdp, $mdpConfirme)
    {
        return !empty($pseudo) && !empty($email) && !empty($mdp) &&  !empty($mdpConfirme)
            && $mdp === $mdpConfirme;
    }

    public function verificationEmail($email)
    {
        $customWhere = "mail = :mail";
        $result = $this->connection->select('membre', ['mail' => $email], 'mail', $customWhere);
        if (!empty($result)) {
            echo "L'e-mail est déjà associé à un compte, veuillez vous connecter avec le compte associé à ce mail, ou bien créez un nouveau compte.";
            die;
        }
    }

    public function inscription($email, $mdp, $pseudo)
    {
        // Hachage du mot de passe
        $mdphash = password_hash($mdp, PASSWORD_DEFAULT);
        // Insertion des données dans la base de données
        $this->connection->insert('membre', ['mail' => $email, 'pseudo' => $pseudo, 'motdepasse' => $mdphash]);
    }

    public function connexion($email, $mdp)
    {
        $customWhere = "mail = :mail";
        $result = $this->connection->select('membre', ['mail' => $email], '*', $customWhere);
        if (!empty($result)) {
            $utilisateur = $result[0];

            if (password_verify($mdp, $utilisateur['motdepasse'])) {
                $_SESSION['connecte'] = true;
                $_SESSION['membre'] = $utilisateur;
                $_SESSION['mail'] = $utilisateur['mail'];
                $_SESSION['mem_id'] = $utilisateur['mem_id'];
                return true;
            }
        }
        return false;
    }

    public function connexionAdmin($email)
    {
        $customWhere = "mail = :mail";
        $result = $this->connection->select('membre', ['mail' => $email], 'mem_id', $customWhere);
        $admin = $result[0];

        if ($admin['id_admin'] == 1) {
            $_SESSION['admin'] = true;
            return true;
        } else {
            return false;
        }
    }
}