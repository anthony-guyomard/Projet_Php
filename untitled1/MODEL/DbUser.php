<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 12/10/2018
 * Time: 12:33
 */

include_once 'AbstractDB.php';

class DbUser extends AbstractDB
{

    public function DeleteAccount() {
        $link = $this->getDbLink();
        $id = filter_input(INPUT_POST, 'id');
        $query = 'DELETE FROM User WHERE ID = ?';
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, 'i',$id);
            mysqli_stmt_execute($stmt);
        }
        header('Location: /Compte');
        exit;
    }

    /**
     * @param $Login
     * @param $Password
     */
    public function VerifDb($Login, $Password)
    {
        $query = 'SELECT * FROM User WHERE EMAIL = ? AND PASSWORD = ?';
        $link = $this->getDbLink();
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "ss", $Login, $Password);
            mysqli_stmt_execute($stmt);
            $dbResult = mysqli_stmt_get_result($stmt);
            $dbRow = mysqli_fetch_assoc($dbResult);
            $Type = $dbRow ['STATUT'];
            $Email = $dbRow ['EMAIL'];
            $Id = $dbRow ['ID'];
            $Name = $dbRow ['NAME'];
            $Pass = $dbRow['PASSWORD'];

            if ($Type == 'Admin' || $Type == 'Membre') {
                $_SESSION['Login'] = $Type;
                $_SESSION['Email'] = $Email;
                $_SESSION['Ident'] = $Id;
                $_SESSION['Name'] = $Name;
                $_SESSION['Password'] = $Pass;
            }
        }
    }

    public function Deconnexion(){
        $_SESSION = array();
        session_destroy();
    }

    /**
     * @param $name
     * @param $email
     * @param $password
     * @param $statut
     */
    public function Inscription($name, $email, $password, $statut, $keymod) {

        $query = 'INSERT INTO User (`NAME`, `EMAIL`, `PASSWORD`, `STATUT`, `KEYMOD`) VALUES ("'.$name.'","'.$email.'","'.$password.'","'.$statut.'","'.$keymod.'" )';

        mysqli_query($this->getDbLink(), $query);

        header('Location: /Compte');
        exit;
    }

    /**
     * @param $mail
     * @param $mdp
     * @param $pseudo
     */
    public function EditerCompte($mail,$mdp,$pseudo)
    {
        $link = $this->getDbLink();
        $query1 = 'SELECT * FROM User WHERE EMAIL = ? and ID <> ? ';
        $query2 = 'SELECT * FROM User WHERE NAME = ? and ID <> ?';
        $query3 = 'UPDATE User SET `EMAIL`= ? ,`PASSWORD` = ?,`NAME` = ? WHERE ID = ?';

        if ($stmt = mysqli_prepare($link, $query1)) {
            mysqli_stmt_bind_param($stmt, 'si', $mail, $_SESSION['Ident']);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            if (mysqli_stmt_num_rows($stmt) > 0) {
                $_SESSION['EditMailCompte'] = 'unvalid';
            }
            else {
                if ($stmt = mysqli_prepare($link, $query2)) {
                    mysqli_stmt_bind_param($stmt, 'si', $pseudo, $_SESSION['Ident']);
                    mysqli_stmt_execute($stmt);
                    mysqli_stmt_store_result($stmt);
                    if (mysqli_stmt_num_rows($stmt) > 0) {
                        $_SESSION['EditNameCompte'] = 'unvalid';
                    }
                    else {
                        if ($stmt = mysqli_prepare($link, $query3)) {
                            mysqli_stmt_bind_param($stmt, 'sssi', $mail, $mdp, $pseudo, $_SESSION['Ident']);
                            mysqli_stmt_execute($stmt);

                            $_SESSION['EditCompte'] = 'valid';
                            $_SESSION['Email'] = $mail;
                            $_SESSION['Name'] = $pseudo;
                            $_SESSION['Password'] = $mdp;

                            $_SESSION['EditNameCompte'] = '';
                            $_SESSION['EditMailCompte'] = '';
                        }
                    }
                }
            }
        }
    }

    /**
     * @return array
     */
    public function GetAllUser()
    {
        $query = 'SELECT * FROM User';
        $dbResult = mysqli_query($this->getDbLink(), $query);
        $list = array();

        while($dbRow = mysqli_fetch_assoc($dbResult)) {

            $idU = $dbRow['ID'];
            $nameU = $dbRow['NAME'];
            $emailU = $dbRow['EMAIL'];

            $list[] = $idU;
            $list[] = $nameU;
            $list[] = $emailU;
        }
        return $list;
    }
}