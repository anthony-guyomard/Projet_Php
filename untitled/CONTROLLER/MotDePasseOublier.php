<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 16/10/2018
 * Time: 21:09
 */

class MotDePasseOublier implements InterfaceController
{
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
            $bd->envoyerInformationMdp($mail);
        }
    }
}