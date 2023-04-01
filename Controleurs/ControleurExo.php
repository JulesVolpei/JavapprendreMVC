<?php

final class ControleurExo
{
    public function defautAction()
    {
        $O_exoChoisi = new Exo();
        $id_exo= $_GET['id_exo'];
        $_SESSION['id_exo'] = $id_exo;
        Vue::montrer('Exo/voir', array('ExoChoisi' => $O_exoChoisi->donneExo($id_exo), 'Indice' => $O_exoChoisi->donneIndice($id_exo)));
    }

    public function compilerEtExecuterAction()
    {
        $idExo = $_SESSION['id_exo'] - 1;
        $index = $_POST['index'];
        $code = $_POST['code'];
        $O_exo = new Exo();
        $exoData = $O_exo->getExoEtTests($idExo);

        // Utilisez la classe Exo pour récupérer les informations sur l'exercice
        $resultats = $O_exo->donneExo($idExo);

        // Suivez les étapes de compilation et d'exécution du code (adaptées de compiler.php)
        $chemin_fichier_test = $resultats['fichier_test'];
        $files = explode("\n", $chemin_fichier_test);
        $nouveau_chemin_fichier_test = $files[$index] . ".java";
        $filePath = "javatests/" . $resultats['fichier'] . ".java";
        file_put_contents($filePath, $code);

        // Compilez et exécutez le code
        $output = null;
        exec('javac ' . $filePath . ' && java ' . $filePath, $compiled_file, $output);
        // Vérifiez le résultat
        $test_output = file_get_contents("javatests/" . $nouveau_chemin_fichier_test . ".txt");

        if (trim($test_output) == trim(implode("\n", $output))) {
            $response = ["output" => "Le test est bon\n"];
        } else {
            $response = ["output" => "Le test est mauvais\n"];
        }

// Répondez avec les résultats sous forme de JSON
        header('Content-Type: application/json');
        echo json_encode($response);
    }
}
