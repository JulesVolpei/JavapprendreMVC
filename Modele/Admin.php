<?php
// fichier exerciceModel.php
final class Admin
{
    private $pdo;


    public function __construct()
    {
        $this->pdo = Connection::getInstance(Connection::ROLE_ADMIN);
    }


    public function checkAdmin($mail) {
        $conditions = [
            "admin.mem_id = membre.mem_id",
            "membre.mail = :mail"
        ];
        $customWhere = implode(' AND ', $conditions);
        $results = $this->pdo->select('admin, membre', ['mail' => $mail], 'COUNT(*) as compte', $customWhere);
        return $results[0]['compte'];
    }


    function creerExercice($nom, $description, $contenuExo, $obj, $test)
    {
        $nom_test = "Test" . $nom;
        $filePath = "./javatests/" . $nom . ".java";
        $filesPath = "./javatests/" . "Test" . $nom . ".java";
        $programFile = fopen($filePath, "w") or die("Unable to open file!");
        $programFiles = fopen($filesPath, "w") or die("Unable to open file!");
        fwrite($programFile, $contenuExo);
        fwrite($programFiles, $test);
        fclose($programFile);
        fclose($programFiles);
        $result = $this->pdo->insert('exos', [
            'nom_exo' => $nom,
            'description_exo' => $description,
            'objectif_exo' => $obj,
            'text_de_base' => $contenuExo,
            'numFichiersTests' => 1,
            'fichier' => $nom
        ]);
        $customWhere = "nom_exo = :nom_exo";
        $exercice = $this->pdo->select('exos', ['nom_exo' => $nom], '*', $customWhere);
        $idExo = $exercice[0]['id_exo'];
        $stmt = $this->pdo->insert('tests', [
            'id_exo' => $idExo,
            'fichier' => $test,
        ]);

    }

    function supprimerExercice($idExo) {

        $this->pdo->delete('tests', 'id_exo ='. $idExo .' ' );
        $this->pdo->delete('exos', 'id_exo ='. $idExo .' ' );

    }

    function modifierExercice($nom, $description, $contenuExo, $obj, $test, $idExo)
    {

        $nom_test = "Test" . $nom;
        $filePath = "./javatests/" . $nom . ".java";
        $filesPath = "./javatests/" . "Test" . $nom . ".java";
        $programFile = fopen($filePath, "w") or die("Unable to open file!");
        $programFiles = fopen($filesPath, "w") or die("Unable to open file!");
        fwrite($programFile, $contenuExo);
        fwrite($programFiles, $test);
        fclose($programFile);
        fclose($programFiles);

        $result = $this->pdo->update('exos', [
            'nom_exo' => $nom,
            'description_exo' => $description,
            'objectif_exo' => $obj,
            'text_de_base' => $contenuExo,
        ], 'id_exo ='. $idExo .' ');
        $stmt =$this->pdo->update('exos', [
            'fichier' => $test,
        ], 'id_exo ='. $idExo .' ');


    }

    public function getExercice($idExo) {
        $customWhere = "id_exo = :id_exo";
        $result = $this->pdo->select('exos', ['id_exo' => $idExo], '*', $customWhere);
        return $result[0];
    }
    public function getTests($idExo) {
        $customWhere = "id_exo = :id_exo";
        $result = $this->pdo->select('tests', ['id_exo' => $idExo], '*', $customWhere);
        return $result[0];
    }

}
