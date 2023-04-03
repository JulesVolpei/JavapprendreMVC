<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/Modele/Exo.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Noyau/Connection.php';

$code = $_POST['code'];
$idExo = $_SESSION['id_exo'] -1 ;
$index = $_POST['index'];
$exoInstance = new Exo();
$exercices = $exoInstance->getTousLesExercices();

$cheminFichierTest = $exercices[$idExo]['fichier_test'];
$fichiers = explode("\n", $cheminFichierTest);

$nouveauCheminFichierTest = '../javatests/'.trim($fichiers[$index]).".java";
$cheminFichier = "../javatests/" . $exercices[$idExo]['fichier'] . ".java";
$programFile = fopen($cheminFichier, "w") or die(" ! Unable to open file!");

fwrite($programFile, $code);
fclose($programFile);
$output = null;
exec('javac ' . $cheminFichier . ' && java ' . $cheminFichier, $output, $returnValue);
$output = shell_exec("java TestExecution " . $exercices[$idExo]['fichier']);
if ($output != 0) {

}
if ($returnValue != 0) {
    $output = shell_exec("javac ". $cheminFichier . " 2>&1");
    echo "Il y a un problème dans votre programme :\n" . $output;
} else {
    $userProgramOutput = implode("", $output);
    if ($userProgramOutput == "1") {
        echo "Votre programme a rencontré une erreur lors de l'exécution.";
    } else {
        shell_exec("javac " . $nouveauCheminFichierTest);
        $output = shell_exec("java " . $nouveauCheminFichierTest . " 2>&1");
        echo $output;
    }
}
