<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 11/10/2018
 * Time: 16:13
 */

class Utilisateur implements InterfaceController
{
    /**
     * @param array $data
     * @return mixed|void
     */
    public function display($data = []) {
        $this->VerifConnex();
        include_once 'VIEW/ViewConnexion.php';
        $connex = new ViewConnexion();
        $connex->ConnexionPage('Votre Compte');
    }

    public function VerifConnex() {
        include_once 'MODEL/DbUser.php';

        $action = filter_input(INPUT_POST, 'Action');
        $Db = new DbUser();

        if ($action == 'Connexion') {
            $Login = filter_input(INPUT_POST, 'Login');
            $Password = filter_input(INPUT_POST, 'Password');

            $Db->VerifDb($Login, $Password);

            header('Location: /Compte');
        }
        elseif ($action == 'Deconnexion'){
            $Db->Deconnexion();
        }


    }

}