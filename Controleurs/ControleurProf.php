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
        $mem_id = $_SESSION['mem_id'];
        $token = $_POST['token'];
        $O_prof->updateByToken($token, $mem_id);
        echo "Inscription confirmée. En attente de l'approbation de l'administrateur.";
        header('Location: index.php?url=ChoixExercice');
    }
}

