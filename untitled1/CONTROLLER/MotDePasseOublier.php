<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 16/10/2018
 * Time: 21:09
 */

class MotDePasseOublier implements InterfaceController
{
    /**
     * @param array $data
     * @return mixed|void
     */
    public function display($data = []) {
        $this->envoyerMail();

        include_once 'VIEW/ViewMotDePasseOublier.php';
        $motDePassOublier = new ViewMotDePasseOublier();

        $motDePassOublier->MdpLostPage('Mot de passe oublier');
    }

    public function envoyerMail(){
        include_once 'MODEL/DbMotDePasseOublier.php';
        $bd = new DbMotDePasseOublier();

        $mail = filter_input(INPUT_POST, 'adrrMail');
        $action = filter_input(INPUT_POST, 'action');

        if ($action === 'sendMail'){
            $bd->envoyerMailRecuperation($mail);
        }
    }

    /**
     * @param array $data
     */
    public function RedirectionModifMotDePasse($data = []) {
        $id = $data[0];
        $keymod = $data[1];
        $email = $data[2];

        include_once 'VIEW/ViewMotDePasseOublier.php';
        $view = new ViewMotDePasseOublier();
        $view->formNewPassword('Modification du mot de passe', $id, $keymod, $email);
    }

    /**
     * @param array $data
     */
    public function ModifierMotDePasse($data = []) {
        $mdp1 = filter_input(INPUT_POST, 'NewMdp');
        $mdp2 = filter_input(INPUT_POST, 'VerifNewMdp');
        if ($mdp1 === $mdp2) {
            include_once 'MODEL/DbMotDePasseOublier.php';
            $id = $data[0];
            $keymod = $data[1];
            $email = $data[2];
            $db = new DbMotDePasseOublier();
            $db->ModificationMotDePasse($mdp1, $id, $keymod, $email);
        }
    }
}