<?php
/**
 * Created by PhpStorm.
 * User: z17007611
 * Date: 22/10/18
 * Time: 10:42
 */

include_once "MODEL/DbSearchBar.php";
include_once "VIEW/ViewSearchBar.php";

class SearchBar implements InterfaceController
{
    public function display ($data = [])
    {
        $recetteSearch = new ViewSearchBar();
        $recetteSearch->SearchPage();
        $mots_cles = filter_input(INPUT_POST, 'rechercher');
        $action = filter_input(INPUT_POST, 'action');
        $search = new DbSearchBar();

        if($action === 'Valider')
        {
            $dbResult = $search->rechercherRecette($mots_cles);
            $numrow = mysqli_num_rows($dbResult);
            while ($row = $dbResult->fetch_array()) {
                $rows[] = $row;
            }

            if($numrow == 0) {
                header("Location: Accueil");
            }
            else {
                foreach ($rows as $row)
                {
                    $recetteSearch->ShowSearch($row['idR'],$row['NAME'], $row['IMAGE']);
                }
            }
        }
        $recetteSearch->EndSearchPage();
    }
}
