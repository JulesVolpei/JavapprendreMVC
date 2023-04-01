<?php

final class ControleurTableauScore
{
    public function defautAction() : void
    {
        $O_tableauScore = new TableauScore();
        $tableau_scores = $O_tableauScore->getScores();
        $exercice = $O_tableauScore->getExercice();
        Vue::montrer('TableauScore/tableau_score', array('tableau_scores' => $tableau_scores, 'exercice' => $exercice));
    }


}
