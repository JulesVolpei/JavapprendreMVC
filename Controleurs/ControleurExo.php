<?php



final class ControleurExo
{

    public function defautAction()
    {
        $O_exoChoisi = new Exo();
        $id_exo= $_GET['id_exo'];
        $_SESSION['id_exo'] = $id_exo;
        Vue::montrer('Exo/voir', array('ExoChoisi' => $O_exoChoisi->donneRecette($id_exo)));
    }
}