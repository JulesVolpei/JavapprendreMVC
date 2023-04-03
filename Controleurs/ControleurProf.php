<?php
// controllers/ProfessorController.php

class ControleurProf
{

    public function defautAction() {
        Vue::montrer('Prof/voir');
    }
    public function registerAction()
    {
        $email = $_POST['email'];
        $token = bin2hex(random_bytes(16));
        Vue::montrer('Prof/confirme', array('token' => $token));
    }

    public function confirmAction()
    {
        $token = $_POST['token'];
        $this->professorModel->updateByToken($token, ['is_confirmed' => 1]);

        echo "Inscription confirmée. En attente de l'approbation de l'administrateur.";
    }
}

