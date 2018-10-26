<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 11/10/2018
 * Time: 16:30
 */

include_once 'VIEW/ViewAccueil.php';
include_once 'MODEL/DbRecette.php';

class Accueil implements InterfaceController
{
    public function display($data = []) {
        include_once 'VIEW/ViewAccueil.php';
        $accueil = new ViewAccueil();
        $recette = new DbRecette();

        $accueil->accueilPage();
        $accueil->topRecette();

        $top = $recette->topRecette();
        if ($top != false) {
            $accueil->ShowRecette($top['IDR'], $top['NAME'], $top['IMAGE']);
        }
        else {
            $accueil->messageUne();
        }

        $accueil->endAccueilPage();
    }
}