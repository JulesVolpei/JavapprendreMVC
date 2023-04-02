<?php

final class ControleurAdmin
{
    public function creerAction()
    {
        Vue::montrer('Admin/creation');
    }

    function creerExerciceAction(array $urlParameters, array $A_postParams = null)
    {

        $nom = $A_postParams['nom'];
        $description = $A_postParams['description'];
        $contenuExo = $A_postParams['contenu'];
        $obj = $A_postParams['objectifs'];
        $test = $A_postParams['testsUnitaires'];


        $O_admin = new Admin();
        $O_admin->creerExercice($nom, $description, $contenuExo, $obj, $test);
        Vue::montrer("Utilisateur/connexion");
    }
}

