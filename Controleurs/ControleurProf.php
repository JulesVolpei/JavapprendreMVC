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
        $email = $_POST['email'];
        $profession = $_POST['profession'];
        $nom = $_POST['nom'];
        $mem_id = $_SESSION['mem_id'];
        $token = bin2hex(random_bytes(16));
        $O_prof->createProf($email, $nom, $profession, $token, $mem_id);
        Vue::montrer('Prof/confirme', array('token' => $token));
    }

    public function confirmAction()
    {
        $O_prof = new Prof();

        $token = $_POST['token'];
        $this->$O_prof->updateByToken($token, ['is_confirmed' => 1]);

        echo "Inscription confirmée. En attente de l'approbation de l'administrateur.";
    }
}

