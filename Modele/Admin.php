<?php
// fichier exerciceModel.php
final class Admin
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::getInstance()->pdo;
    }
    function creerExercice($nom, $description, $contenuExo, $obj, $test)
    {
        var_dump($description);
        $nom_test = "Test" . $nom;
        $filePath = "../javatests/" . $nom . ".java";
        $filesPath = "../javatests/" . "Test" . $nom . ".java";
        $programFile = fopen($filePath, "w") or die("Unable to open file!");
        $programFiles = fopen($filesPath, "w") or die("Unable to open file!");
        fwrite($programFile, $contenuExo);
        fwrite($programFiles, $test);
        fclose($programFile);
        fclose($programFiles);

        
        
        $result = $this->pdo->prepare( "INSERT INTO exos ( nom_exo,description_exo,objectif_exo,text_de_base,fichier_test, numFichiersTests, fichier) VALUES ( ?, ?, ? ,?, ?, 1, ?)"); //On insert dans la table exos le nom de l'exo, la description et le contenu
        $result->execute(array($nom, $description, $obj,$contenuExo,$nom_test));
    
    }
}
