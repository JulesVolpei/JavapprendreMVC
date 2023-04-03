<?php

final class ControleurTableauScore
{
    public function defautAction() : void
    {
        $O_tableauScore = new TableauScore();

        // Récupérer les scores et les stocker dans $tableau_scores
        $tableau_scores = $O_tableauScore->getScores();

        $exercice = $O_tableauScore->getExercice();

        // Afficher la vue
        Vue::montrer('TableauScore/tableau_score', array('tableau_scores' => $tableau_scores, 'exercice' => $exercice));
    }


}