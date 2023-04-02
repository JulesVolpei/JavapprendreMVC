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

$nouveauCheminFichierTest =  __DIR__  . '/../javatests/'.$fichiers[$index].".java";
$nouveauCheminFichdierTest = __DIR__ . '/../javatests/TestSoustraction.java';

$cheminFichier = "../javatests/" . $exercices[$idExo]['fichier'] . ".java";

$programFile = fopen($cheminFichier, "w") or die(" ! Unable to open file!");

fwrite($programFile, $code);
fclose($programFile);
$output = null;
exec('javac ' . $cheminFichier . ' && java ' . $cheminFichier, $output, $returnValue);
echo $returnValue;
if ($returnValue != 0) {
    $output = shell_exec("java " . $cheminFichier . "2>&1");

} else {
    shell_exec("javac " . $nouveauCheminFichdierTest);
    $output = shell_exec("java " . $nouveauCheminFichdierTest . "2>&1");
}
echo $output;
