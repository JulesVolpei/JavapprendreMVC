<?php

final class ControleurAccueil
{
    public function defautAction()
    {
        $O_accueil =  new Accueil();
        Vue::montrer('Accueil/voir', array('accueil' => $O_accueil));
    }


    public function testformAction(Array $A_parametres = null, Array $A_postParams = null)
    {
        Vue::montrer('Accueil/testform', array('formData' =>  $A_postParams));
    }

    public function aProposAction(Array $A_parametres = null, Array $A_postParams = null)
    {
        Vue::montrer('Accueil/a_propos', array('formData' =>  $A_postParams));
    }



}
