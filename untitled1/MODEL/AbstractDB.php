<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 11/10/2018
 * Time: 14:56
 */

abstract class AbstractDB
{
    protected function getDbLink() {
        $dbLink = mysqli_connect('mysql-antantsylfa.alwaysdata.net', '167748', 'lesbg1234')
        or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
        mysqli_select_db($dbLink , 'antantsylfa_cookandburn')
        or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

        return $dbLink;
    }

    /**
     * @param $query
     * @return bool|mysqli_result
     */
    protected function executeQuery($query) {
        $link = $this->getDbLink();
        $return = mysqli_query($link, $query);
        if (false === $return) {
            echo 'Erreur dans la requête "' . $query . '"';
            echo mysqli_error($link);
        }
        return $return;
    }
}