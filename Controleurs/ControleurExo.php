<?php

final class ControleurExo
{
    public function defautAction()
    {
        $O_exoChoisi = new Exo();
        $id_exo = $_GET['id_exo'];
        $_SESSION['id_exo'] = $id_exo;
        Vue::montrer('Exo/voir', array('ExoChoisi' => $O_exoChoisi->donneExo($id_exo), 'Indice' => $O_exoChoisi->donneIndice($id_exo)));
    }

    public function tableauScoreAction() : void
    {
        // Vérifiez si l'id de l'exercice est défini dans la requête GET
        if (!isset($_GET['id_exo'])) {
            // Si l'id de l'exercice n'est pas défini, redirigez l'utilisateur vers la page d'accueil
            header('Location: index.php?url=Accueil');
            return;
        }

        // Récupérez l'id de l'exercice à partir de la requête GET
        $id_exo = (int)$_GET['id_exo'];

        // Récupérez les scores pour l'exercice à partir du modèle "TableauScore"
        $O_tableauScore = new TableauScore();
        $tableau_scores = $O_tableauScore->getScoresByIdExo($id_exo);
        $exercice = $O_tableauScore->getExerciceByIdExo($id_exo);

        // Affichez les scores à l'aide de la vue "tableau_score.php"
        Vue::montrer('TableauScore/tableau_score', array('tableau_scores' => $tableau_scores, 'exercice' => $exercice));
    }

}
