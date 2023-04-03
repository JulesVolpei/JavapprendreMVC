<?php
// controllers/ProfessorController.php

class ControleurProf
{

    public function defautAction() {
        Vue::montrer('Prof/voir');
    }
    public function registerAction()
    {
        $O_prof = new Prof();
        $nom = $_POST['nom'];
        $profession = $_POST['profession'];
        $mail = $_POST['email'];
        $token = bin2hex(random_bytes(16));

        Vue::montrer('Prof/confirme', array('token' => $token));
    }

    public function confirmAction()
    {
        $O_prof = new Prof();

        $token = $_POST['token'];
        $this->professorModel->updateByToken($token, ['is_confirmed' => 1]);

        echo "Inscription confirmée. En attente de l'approbation de l'administrateur.";
    }
}

