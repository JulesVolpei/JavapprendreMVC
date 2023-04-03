<?php

final class ControleurExo
{
    public function defautAction()
    {
        // Création d'une nouvelle instance de la classe Exo
        $O_exoChoisi = new Exo();
        // Récupération de l'identifiant de l'exercice à afficher depuis la variable GET
        $id_exo = $_GET['id_exo'];
        // Enregistrement de l'identifiant de l'exercice dans la variable de session id_exo
        $_SESSION['id_exo'] = $id_exo;
        // Affichage de la vue Exo/voir avec les données de l'exercice et de l'indice correspondant à l'identifiant récupéré
        Vue::montrer('Exo/voir', array('ExoChoisi' => $O_exoChoisi->donneExo($id_exo), 'Indice' => $O_exoChoisi->donneIndice($id_exo)));
    }
}

