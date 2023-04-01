<?php

final class ControleurAccueil
{
    public function defautAction()
    {
        $O_accueil =  new Accueil();
        Vue::montrer('Accueil/voir');

    }


}