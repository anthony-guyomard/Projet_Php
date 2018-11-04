<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 13/10/2018
 * Time: 13:39
 */

class Inscription implements InterfaceController
{
    /**
     * @param array $data
     */
    public function display($data = []) {
        include_once 'VIEW/ViewCompte.php';
        $compte = new ViewCompte();
        $compte->comptePage('Votre Compte');
    }
}