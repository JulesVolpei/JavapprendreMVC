<?php

final class ControleurAdmin
{

    public function checkAdminAction()
    {
            $pseudo = $_SESSION['membre']['pseudo'];
        $adminModel = new Admin();
        $isAdmin = $adminModel->checkAdmin($pseudo);

            if ($isAdmin == 1) {
                $_SESSION['userAdmin'] = true;
                $O_choixExercice =  new ChoixExercice();
                Vue::montrer('ChoixExercice/sliderExercices', array('exercices' => $O_choixExercice->getTousLesExercices()));
            } else {
                $_SESSION['userAdmin'] = false;


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
         

                Vue::montrer("Utilisateur/inscription");
            
            
           
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
        $id_exo =  $_SESSION['id_exo'];
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

    }




    }

