<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 15/10/2018
 * Time: 20:05
 */

include_once 'AbstractDB.php';

class DbRecette extends AbstractDB
{
    /**
     * @return array
     */
    public function GetAllRecette()
    {
        $query = 'SELECT * FROM Recette';
        $dbResult = mysqli_query($this->getDbLink(), $query);

        $list = array();

        while($dbRow = mysqli_fetch_assoc($dbResult)) {

            $idRe = $dbRow['IDR'];
            $nameRe = $dbRow['NAME'];
            $imageRe = $dbRow['IMAGE'];

            $list[] = $idRe;
            $list[] = $nameRe;
            $list[] = $imageRe;
        }
        return $list;
    }

    public function VisitorRecette() {
        $list = array();

        $query2 = 'SELECT IDR FROM Recette';
        $dbResult2 = $this->executeQuery($query2);
        $dbRow2 = mysqli_fetch_assoc($dbResult2);
        $idrecette = $dbRow2['IDR'];

        $list[] = $idrecette;

        var_dump($dbRow2['IDR']);
        die;
        $query = 'SELECT COUNT(IDR) as NMBRIDR FROM Recette';
        $dbResult = $this->executeQuery($query);
        $dbRow = mysqli_fetch_assoc($dbResult);
        for ($i = 0; $i < $dbRow['NMBRIDR']; $i = $i + 1) {
            $this->getRecette($dbRow2['IDR']);
        }
    }

    /**
     * @return array
     */
    public function getMyRecette() {
        $link = $this->getDbLink();
        $list = array();
        $query3 = 'SELECT * FROM Recette WHERE IDU = ?';
        if ($stmt = mysqli_prepare($link, $query3)) {
            mysqli_stmt_bind_param($stmt, "i", $_SESSION['Ident']);
            mysqli_stmt_execute($stmt);
            $dbResult3 = mysqli_stmt_get_result($stmt);
            while ($dbRow = mysqli_fetch_assoc($dbResult3)) {
                $idRe = $dbRow['IDR'];
                $nameRe = $dbRow['NAME'];
                $imageRe = $dbRow['IMAGE'];

                $list[] = $idRe;
                $list[] = $nameRe;
                $list[] = $imageRe;
            }
        }
        return $list;
    }

    /**
     * @param $idR
     * @return array|null
     */
    public function getRecette($idR){

        $link = $this->getDbLink();

        $query = 'SELECT * FROM Recette WHERE IDR = ?';
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "i", $idR);
            mysqli_stmt_execute($stmt);
            $dbResult = mysqli_stmt_get_result($stmt);
            $dbRow = mysqli_fetch_assoc($dbResult);

            $dbRow['IDR'];
            $dbRow['NAME'];
            $dbRow['NMBRGUESTS'];
            $dbRow['SHORTDESCRIP'];
            $dbRow['LONGDESCRIP'];
            $dbRow['INGREDIENTS'];
            $dbRow['STAGE'];
            $dbRow['IMAGE'];

            $query2 = 'SELECT COUNT(*) AS NBBURN FROM Burn WHERE IDR = ?';
            if ($stmt = mysqli_prepare($link, $query2)) {
                mysqli_stmt_bind_param($stmt, "i", $idR);
                mysqli_stmt_execute($stmt);
                $dbResult2 = mysqli_stmt_get_result($stmt);
                $dbRow2 = mysqli_fetch_assoc($dbResult2);

                $dbRow['NBBURN'] = $dbRow2['NBBURN'];
            }
        }
        return $dbRow;
    }

    /**
     * @param $idRecette
     * @param $idUser
     * @return bool
     */
    public function verifBurn($idRecette, $idUser) {
        $link = $this->getDbLink();
        $query = 'SELECT IDR,IDU FROM Burn WHERE IDR = ? AND IDU = ?';
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "ii", $idRecette, $idUser);
            mysqli_stmt_execute($stmt);
            $dbResult = mysqli_stmt_get_result($stmt);
            $dbRow = mysqli_fetch_assoc($dbResult);
            if ($dbRow == null) {
                return false;
            } elseif ($dbRow != null) {
                return true;
            } else {
                header('Location: /DescriptionRecette/display/' . $idRecette);
                exit;
            }
        }
    }

    /**
     * @param $idRecette
     * @param $idUser
     */
    public function addBurn($idRecette, $idUser) {
        $link = $this->getDbLink();
        $query = 'INSERT INTO Burn(IDR, IDU) VALUES (?,?)';
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "ii", $idRecette, $idUser);
            mysqli_stmt_execute($stmt);
        }
    }

    /*public function delBurn($idRecette, $idUser) {
        $link = $this->getDbLink();
        $query = 'DELETE FROM Burn WHERE IDR = ? AND IDU = ?';
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "ii", $idRecette, $idUser);
            mysqli_stmt_execute($stmt);
        }
    }*/

    /**
     * @return array|bool|null
     */
    public function topRecette() {
        $link = $this->getDbLink();
        $query = 'SELECT IDR FROM Burn ORDER BY IDB DESC';
        $dbResult = mysqli_query($link, $query);
        while ($dbRow = mysqli_fetch_assoc($dbResult)) {
            $query2 = 'SELECT IDR FROM Burn WHERE IDR = ? HAVING COUNT(?) > 14';
            if ($stmt = mysqli_prepare($link, $query2)) {
                mysqli_stmt_bind_param($stmt, "ii", $dbRow['IDR'], $dbRow['IDR']);
                mysqli_stmt_execute($stmt);
                $dbResult2 = mysqli_stmt_get_result($stmt);
                if (mysqli_num_rows($dbResult2)) {
                    $list = $this->getRecette($dbRow['IDR']);
                    return $list;
                    break;
                }
            }
        }
        return false;
    }

    /**
     * @param $id
     * @param $nom
     * @param $nbpers
     * @param $courdes
     * @param $longdes
     * @param $ingre
     * @param $etape
     * @param $nomfichier
     */
    public function AjoutRecette($id, $nom, $nbpers, $courdes, $longdes, $ingre, $etape, $nomfichier) {

        $link = $this->getDbLink();
        $fichier = "/VIEW/Image/$nomfichier";
        $query = 'INSERT INTO Recette (`IDU`, `NAME`, `NMBRGUESTS`, `SHORTDESCRIP`, `LONGDESCRIP`, `INGREDIENTS`, `STAGE`, `IMAGE`) VALUES (?,?,?,?,?,?,?,?)';
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "isisssss", $id, $nom, $nbpers, $courdes, $longdes, $ingre, $etape, $fichier);
            mysqli_stmt_execute($stmt);
        }

        header('Location: /Compte');
    }

    /**
     * @param $id
     * @param $nom
     * @param $nbpers
     * @param $courdes
     * @param $longdes
     * @param $ingre
     * @param $etape
     */
    public function EditRecette($id, $nom, $nbpers, $courdes, $longdes, $ingre, $etape) {
        $link = $this->getDbLink();
        $query = 'UPDATE Recette SET IDU = ?, NAME = ?, NMBRGUESTS = ?, SHORTDESCRIP = ?, LONGDESCRIP = ?, INGREDIENTS = ?, STAGE = ? WHERE IDR = ?';
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "isissssi", $_SESSION['Ident'], $nom, $nbpers, $courdes, $longdes, $ingre, $etape, $id);
            mysqli_stmt_execute($stmt);
        }
    }

    /**
     * @param $id
     * @return bool
     */
    public function VerifIfMyRecette($id) {
        if ($_SESSION['Login'] == 'Admin') {
            return true;
        }
        else {
            $link = $this->getDbLink();
            $query = 'SELECT * FROM Recette WHERE IDU = ? AND IDR = ?';
            if ($stmt = mysqli_prepare($link, $query)) {
                mysqli_stmt_bind_param($stmt, "ii", $_SESSION['Ident'], $id);
                mysqli_stmt_execute($stmt);
                mysqli_stmt_store_result($stmt);
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    return true;
                }
                else {
                    return false;
                }
            }
        }
    }
}