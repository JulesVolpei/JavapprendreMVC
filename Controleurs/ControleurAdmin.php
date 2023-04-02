<?php

final class ControleurAdmin
{

    public function checkAdminAction()
    {
        $mail = $_SESSION['membre']['mail'];
        $adminModel = new Admin();
        $isAdmin = $adminModel->checkAdmin($mail);
        if ($isAdmin == 1) {
            $_SESSION['userAdmin'] = true;
            $O_choixExercice =  new ChoixExercice();
            header('Location: index.php?url=ChoixExercice');

        } else {
            $_SESSION['userAdmin'] = false;
            Vue::montrer('Admin/erreur', array('erreur' => "Vous n'êtes pas un admin. Vous allez être redirigé dans 3 secondes."));
        }
    }

    public function creerAction() {
        Vue::montrer('Admin/creation');
    }
    function creerExerciceAction(array $urlParameters, array $A_postParams = null)
    {
        $nom = $A_postParams['nom'];
        $description = $A_postParams['description'];
        $contenuExo = $A_postParams['contenu'];
        $obj = $A_postParams['objectifs'];
        $test = $A_postParams['testsUnitaires'];
        $O_admin =  new Admin();
        $O_admin-> creerExercice($nom, $description, $contenuExo, $obj, $test);
        var_dump($nom);


        header('Location: index.php?url=ChoixExercice');



    }
    public function supprimerAction(){
        Vue::montrer('Admin/supprimer');
    }

    function supprimerExerciceAction()
    {
        $idExo= $_GET['id_exo'];
        $O_admin =  new Admin();
        $O_admin-> supprimerExercice($idExo);
    }

    public function modifierAction(){
        $O_modifier = new Admin();
        $id_exo =  $_GET['id_exo'];
        Vue::montrer('Admin/modifier', array('exercice' => $O_modifier->getExercice($id_exo)));
    }

    function modifierExerciceAction(array $urlParameters, array $A_postParams = null)
    {
        $idExo= $_GET['id_exo'];
        $nom = $A_postParams['nom'];
        $description = $A_postParams['description'];
        $contenuExo = $A_postParams['contenu'];
        $obj = $A_postParams['objectifs'];
        $test = $A_postParams['testsUnitaires'];
        $O_admin =  new Admin();
        $O_admin-> modifierExercice($nom, $description, $contenuExo, $obj, $test, $idExo);
        header('Location: index.php?url=ChoixExercice');
    }




}

