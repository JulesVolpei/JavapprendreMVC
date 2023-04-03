<?php

// Définition de la classe ControleurChoixExercice
final class ControleurChoixExercice
{
    // Définition de la méthode publique defautAction qui ne renvoie rien (void)
    public function defautAction() : void
    {
        // Création d'une instance de la classe ChoixExercice
        $O_choixExercice =  new ChoixExercice();

        // Affichage d'une vue avec un slider contenant tous les exercices
        Vue::montrer('ChoixExercice/sliderExercices', array('exercices' => $O_choixExercice->getTousLesExercices()));
    }
}
