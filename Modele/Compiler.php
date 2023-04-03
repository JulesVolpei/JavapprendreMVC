<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/Modele/Exo.php';
include $_SERVER['DOCUMENT_ROOT'] . '/Noyau/Connection.php';

$code = $_POST['code'];
$idExo = $_SESSION['id_exo'] ;
$index = $_POST['index'];
$exoInstance = new Exo();
$test = $exoInstance->donneTests($idExo);
$exercices = $exoInstance->getTousLesExercices();

$cheminFichierTest = $test[$index]['fichier'];
$nouveauCheminFichierTest = '../javatests/'.$cheminFichierTest.".java";
$cheminFichier = "../javatests/" . $exercices[$idExo - 1]['fichier'] . ".java";
$programFile = fopen($cheminFichier, "w") or die(" ! Unable to open file!");

fwrite($programFile, $code);
fclose($programFile);
$output = null;
exec('javac ' . $cheminFichier . ' && java ' . $cheminFichier, $output, $returnValue);
$output = shell_exec("java TestExecution " . $exercices[$idExo - 1]['fichier']);
if ($output != 0) {
    echo "Il y a un problème dans votre programme :\n" . $output;
} elseif($returnValue != 0) {
    $output = shell_exec("javac ". $cheminFichier . " 2>&1");
}  else {
        shell_exec("javac " . $nouveauCheminFichierTest);
        $output = shell_exec("java " . $nouveauCheminFichierTest . " 2>&1");

}
echo $output;
