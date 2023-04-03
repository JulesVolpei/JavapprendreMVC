<?php
// fichier exerciceModel.php
final class Admin
{
    private $pdo;


    public function __construct()
    {
        $this->pdo = Connection::getInstance(Connection::ROLE_ADMIN)->pdo;
    }


    public function checkAdmin($mail) {
        $compte = $this->pdo->prepare("SELECT COUNT(*) as compte  FROM admin, membre WHERE admin.mem_id = membre.mem_id and membre.mail = ?");
        $compte->execute(array($mail));
        $row = $compte->fetch();
        $admin = $row['compte'];
        return $admin;
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
        $result = $this->pdo->prepare( "INSERT INTO exos ( nom_exo,description_exo,objectif_exo,text_de_base,fichier_test, numFichiersTests, fichier) VALUES ( ?, ?, ? ,?, ?, 1, ?)"); //On insert dans la table exos le nom de l'exo, la description et le contenu
        $result->execute(array($nom, $description, $obj,$contenuExo,$test, $nom));
    
    }

    function supprimerExercice($idExo) {
        $query = 'DELETE FROM exos WHERE id_exo = :idExo';
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(':idExo', $idExo, PDO::PARAM_INT);
        $statement->execute();
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

        $result = $this->pdo->prepare( 'UPDATE exos set nom_exo = ?, description_exo = ?, objectif_exo = ?, text_de_base = ?, fichier_test = ? where id_exo = ?'); //On insert dans la table exos le nom de l'exo, la description et le contenu
        $result->execute(array($nom, $description, $obj,$contenuExo,$test, $idExo));
    }

    public function getExercice($idExo) {
        $sql = "SELECT * FROM exos WHERE id_exo = :id_exo";
        $pdo = $this->pdo->prepare($sql);
        $pdo->execute(['id_exo' => $idExo]);
        return $pdo->fetch();
    }
}
