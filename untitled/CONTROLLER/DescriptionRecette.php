<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 18/10/2018
 * Time: 22:48
 */

include_once 'CONTROLLER/Recette.php';
include_once 'MODEL/DbRecette.php';
include_once 'VIEW/ViewDescriptionRecette.php';

class DescriptionRecette implements InterfaceController
{
    public function display($data = [])
    {
        include_once 'MODEL/DbRecette.php';
        include_once 'VIEW/ViewDescriptionRecette.php';
        $id = $data[0];
        $recette = $this->afficherLaRecette($id);

        $myRecette = new ViewDescriptionRecette();
        $editable = new DbRecette();
        $var = $editable->VerifIfMyRecette($id);
        $myRecette->DecripRecettePage('Recette', $recette, $var);
        $this->alert($myRecette);
    }

    public function afficherLaRecette($id){
        $recette = new DbRecette();
        return $recette->getRecette($id);
    }

    public function gestionBurn($data = [])
    {
        $idrecette = $data[1];
        $action = $data[0];
        $bd = new DbRecette();
        $desre = new ViewDescriptionRecette();
        $verif = $bd->verifBurn($idrecette, $_SESSION['Ident']);

        if ($action === 'add') {
            if ($verif == false) {
                $add = new DbRecette();
                $add->addBurn($idrecette, $_SESSION['Ident']);
            }
            else {
                header('Location: /DescriptionRecette/display/' . $idrecette);
                $_SESSION['verifburn'] = 'Vous avez déja Burné ! ';
            }
        }
        elseif ($action === 'del') {
            $del = new DbRecette();
            $del->delBurn($idrecette, $_SESSION['Ident']);
            $_SESSION['verifburn'] = null;
        }
        header('Location: /DescriptionRecette/display/' . $idrecette);
    }

    public function EditerInfoRecette($data = []){
        include_once 'MODEL/DbRecette.php';
        $bd = new DbRecette();

        $verifMdp = filter_input(INPUT_POST, 'verifMdp');

        if($verifMdp === $_SESSION['Password']){
            $_SESSION['EditPasswordRecette'] = '';

            $nom = filter_input(INPUT_POST, 'name');
            $nbpers = filter_input(INPUT_POST, 'nbpers');
            $courdes = filter_input(INPUT_POST, 'courtdes');
            $longdes = filter_input(INPUT_POST, 'longdes');
            $ingre = filter_input(INPUT_POST, 'ingre');
            $etape = filter_input(INPUT_POST, 'stage');

            $bd->EditRecette($data[0], $nom, $nbpers, $courdes, $longdes, $ingre, $etape);
        }
        else{
            $_SESSION['EditPasswordRecette'] = 'unvalid';
        }
        header('location: /DescriptionRecette/display/'. $data[0]);
    }

    public function alert(ViewDescriptionRecette $descripres){
        if ($_SESSION['EditPasswordRecette'] === '') {
            null;
        }
        elseif ($_SESSION['EditPasswordRecette'] === 'unvalid'){
            $descripres->alert("Mot de passe incorrect.");
            $_SESSION['EditPasswordRecette'] = '';
        }
    }
}