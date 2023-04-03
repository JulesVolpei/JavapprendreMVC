<?php

final class ControleurExo
{
    public function defautAction()
    {
        // Crée une nouvelle instance de la classe Exo
        $O_exoChoisi = new Exo();
        // Récupère l'ID de l'exercice à partir de la requête GET
        $id_exo = $_GET['id_exo'];
        // Stocke l'ID de l'exercice dans la variable de session
        $_SESSION['id_exo'] = $id_exo;
        // Affiche la vue Exo/voir en passant les données d'exercice, de tests et d'indices
        Vue::montrer('Exo/voir', array('ExoChoisi' => $O_exoChoisi->donneExo($id_exo), 'Tests' => $O_exoChoisi->donneTests($id_exo), 'Indice' => $O_exoChoisi->donneIndice($id_exo)));
    }

    public function tableauScoreAction() : void
    {
        // Vérifie si l'ID de l'exercice est défini dans la requête GET
        if (!isset($_GET['id_exo'])) {
            // Si l'ID de l'exercice n'est pas défini, redirige l'utilisateur vers la page d'accueil
            header('Location: index.php?url=Accueil');
            return;
        }

        // Récupère l'ID de l'exercice à partir de la requête GET
        $id_exo = (int)$_GET['id_exo'];

        // Crée une nouvelle instance de la classe TableauScore pour récupérer les scores
        $O_tableauScore = new TableauScore();
        // Récupère les scores pour l'exercice avec l'ID correspondant
        $tableau_scores = $O_tableauScore->getScoresByIdExo($id_exo);
        // Récupère l'exercice avec l'ID correspondant pour afficher son nom sur la vue
        $exercice = $O_tableauScore->getExerciceByIdExo($id_exo);

        // Affiche les scores à l'aide de la vue "tableau_score.php"
        Vue::montrer('TableauScore/tableau_score', array('tableau_scores' => $tableau_scores, 'exercice' => $exercice));
    }

}
