<?php
/**
 * Created by PhpStorm.
 * User: z17007611
 * Date: 22/10/18
 * Time: 08:58
 */

include_once 'AbstractDB.php';

class DbSearchBar extends AbstractDB
{
    public function rechercherRecette($chaine)
    {
          $cpt = 0;
          $lenstring = strlen($chaine);
          $unMot ='';
    for ($i = 0; $i < $lenstring ; $i++) {
        if($chaine[$i] == ' ') {
            $unMot = '';
            $cpt++;
        }
        else {
            $unMot .= $chaine[$i];
            $mots_cles[$cpt] = $unMot;
        }
    }
        $query = 'SELECT * FROM Recette WHERE';
        foreach ($mots_cles as $mots_cle) {
            $query .= ' NAME LIKE "%' . $mots_cle . '%" OR SHORTDESCRIP LIKE "%' . $mots_cle . '%" OR INGREDIENTS LIKE "%' . $mots_cle . '%" OR';
        }
        $query .= ' 1 = 0';
        $dbResult = mysqli_query($this->getDbLink(), $query);

        return $dbResult;
    }
}
