<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 13/10/2018
 * Time: 11:54
 */

class Compte implements InterfaceController
{
    /**
     * @param array $data
     */
    public function display($data = [])
    {
        include_once 'MODEL/DbRecette.php';
        include_once 'VIEW/ViewCompte.php';
        $compte = new ViewCompte();
        $recette = new DbRecette();
        $user = new ViewCompte();
        $compte->comptePage('Votre compte');
        if ($_SESSION['Login'] == 'Admin') {
            $compte->compteAdmin1();
            $listCompte = $this->afficherUser();
            $user->text();
            for ($i = 0;$i < sizeof($listCompte); $i = $i+3){
                $user->ShowAllUser($listCompte[$i+1], $listCompte[$i+2], $listCompte[$i]);
            }
            $compte->compteAdmin2();
        }
        elseif ($_SESSION['Login'] == 'Membre') {
            $compte->compteUser();
        }
        else {
            header('Location: /Utilisateur');
        }
        $top = $recette->getMyRecette();
        for ($i = 0; $i < sizeof($top); $i = $i + 3) {
            $compte->ShowRecette($top[$i], $top[$i + 1], $top[$i + 2]);
        }
        $this->alert($compte);
        $compte->addRecette();
        $compte->endComptePage();
    }

    public function inscription() {
        $action = filter_input(INPUT_POST, 'Action');

        if ($action == 'Inscription') {
            include_once 'MODEL/DbUser.php';
            $statut = filter_input(INPUT_POST, 'STATUT');
            if ($statut == 'Membre' or $statut == 'Admin') {
                $name = filter_input(INPUT_POST, 'NAME');
                $email = filter_input(INPUT_POST, 'EMAIL');
                $password = filter_input(INPUT_POST, 'PASSWORD');
                $keymod = rand(1,50000);

                $Db = new DbUser();
                $Db->Inscription($name, $email, $password, $statut, $keymod);
            }
            else {
                header('Location: /Compte');
                exit;
            }
        }
    }

    public function editerInfoCompte(){
        include_once 'MODEL/DbUser.php';
        $bd = new DbUser();

        $verifMdp = filter_input(INPUT_POST, 'verifMdp');

        if($verifMdp === $_SESSION['Password']){
            $_SESSION['EditPasswordCompte'] = '';

            $mail = filter_input(INPUT_POST, 'email');
            $mdp = filter_input(INPUT_POST, 'password');
            $pseudo = filter_input(INPUT_POST, 'name');
            $bd->EditerCompte($mail,$mdp,$pseudo);
        }
        else{
            $_SESSION['EditPasswordCompte'] = 'unvalid';
        }
        header('location: /Compte');
        exit;
    }

    /**
     * @param ViewCompte $compte
     */
    public function alert(ViewCompte $compte){
        if ($_SESSION['EditPasswordCompte'] === '') {
            if ($_SESSION['EditCompte'] === 'valid') {
                $_SESSION['EditCompte'] = '';
            } elseif ($_SESSION['EditMailCompte'] === 'unvalid') {
                $compte->alert("Adresse e-mail déja existante.");
                $_SESSION['EditMailCompte'] = '';
            } elseif ($_SESSION['EditNameCompte'] === 'unvalid') {
                $compte->alert("Nom d'utilisateur déja existant.");
                $_SESSION['EditNameCompte'] = '';
            }
        } elseif ($_SESSION['EditPasswordCompte'] === 'unvalid'){
            $compte->alert("Mot de passe incorrect.");
            $_SESSION['EditPasswordCompte'] = '';
        }
    }

    public function afficherUser(){
        include_once 'MODEL/DbUser.php';
        $dbR = new DbUser();
        return $dbR->GetAllUser();
    }

    public function DeleteUser() {
        include_once 'MODEL/DbUser.php';
        $db = new DbUser();
        $db->DeleteAccount();
    }
}