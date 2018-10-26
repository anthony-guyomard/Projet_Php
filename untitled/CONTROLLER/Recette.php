<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 12/10/2018
 * Time: 12:45
 */

include_once 'VIEW/ViewRecette.php';
include_once 'MODEL/DbRecette.php';

class Recette implements InterfaceController {

    public function display($data = []) {
        $recette = new ViewRecette();
        $recette->RecettePage();
        $listRecette = $this->afficherRecette();
        $recette->text();
        for ($i = 0;$i < sizeof($listRecette); $i = $i+3){
            $recette->ShowAllRecette($listRecette[$i], $listRecette[$i+1], $listRecette[$i+2]);
        }
        $recette->EndRecettePage();
    }

    public function afficherRecette(){
        $dbR = new DbRecette();
        return $dbR->GetAllRecette();
    }

    public function newRecette() {
        include_once 'MODEL/DbRecette.php';

        $action = filter_input(INPUT_POST, 'Add');

        if ($action == 'AjouterRecette') {
            $nom = filter_input(INPUT_POST, 'NAME');
            $nbpers = filter_input(INPUT_POST, 'NMBRGUESTS');
            $courdes = filter_input(INPUT_POST, 'SHORTDESCRIP');
            $longdes = filter_input(INPUT_POST, 'LONGDESCRIP');
            $ingre = filter_input(INPUT_POST, 'INGREDIENTS');
            $etape = filter_input(INPUT_POST, 'STAGE');
            $nomfichier = basename($_FILES['IMAGE']['name']);
            $this->addImages();

            $Db = new DbRecette();
            $Db->AjoutRecette($_SESSION['Ident'], $nom, $nbpers, $courdes, $longdes, $ingre, $etape, $nomfichier);
        }
    }

    public function addImages(){
        $dossier = 'VIEW/Image/';

        $fichier = basename($_FILES['IMAGE']['name']);
        $taille_maxi = 10000000;
        $taille = filesize($_FILES['IMAGE']['tmp_name']);
        $extensions = array('.png', '.gif', '.jpg', '.jpeg');
        $extension = strrchr($_FILES['IMAGE']['name'], '.');

        if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
        {
            echo 'Vous devez uploader un fichier de type png, gif, jpg, jpeg';
        }
        if($taille>$taille_maxi)
        {
            echo 'Le fichier est trop gros...';
        }
        if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
        {
            move_uploaded_file($_FILES['IMAGE']['tmp_name'], $dossier . $fichier);//Si la fonction renvoie TRUE, c'est que ça a fonctionné..
        }
    }
}