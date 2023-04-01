<?php

final class ControleurChoixExercice
{
    public function defautAction() : void
    {
        $O_choixExercice =  new ChoixExercice();
        Vue::montrer('ChoixExercice/sliderExercices', array('exercices' => $O_choixExercice->getTousLesExercices()));
    }

}