<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 16/10/2018
 * Time: 21:10
 */

include_once 'AbstractDB.php';

class DbMotDePasseOublier extends AbstractDB
{
    /**
     * @param $mail
     */
    public function envoyerMailRecuperation($mail)
    {
        $query = mysqli_query($this->getDbLink(), 'SELECT * FROM User WHERE EMAIL = "' . $mail . '"');
        if (mysqli_num_rows($query) > 0) {
            $query = 'SELECT * FROM User WHERE EMAIL = "' . $mail . '"';
            $result = mysqli_query($this->getDbLink(), $query);

            $row = mysqli_fetch_assoc($result);
            $id = $row['ID'];
            $email = $row['EMAIL'];
            $keymod = $row['KEYMOD'];

            $to = $mail;
            $subject = 'Modification du mot de passe de votre compte Cook & Burn';
            $message = 'Bonjour,' . "\n\n";
            $message .= 'Suite a votre demande,' . "\n";
            $message .= 'Voici un lien vous permettant de modifier votre mot de passe : ' . "\n";
            $message .= 'http://antantsylfa.alwaysdata.net/MotDePasseOublier/RedirectionModifMotDePasse/' . $id . '/'. $keymod . '/' . $email . "\n\n";
            $message .= 'Si cette demande n\'est pas de vous, merci de ne pas tenir compte de cet email.';

            $headers = 'From: cookandburn-no-reply@gmail.com' . "\r\n" .
                'Reply-To: ' . $mail . "\r\n" .
                'X-Mailer: PHP/' . phpversion();

            mail($to, $subject, $message, $headers);

            $_SESSION['etatmdp'] = '';
        } else {
            $_SESSION['etatmdp'] = 'Adresse mail non existante.';
        }
    }

    /**
     * @param $mdp
     * @param $id
     * @param $email
     */
    public function ModificationMotDePasse($mdp, $id, $keymod, $email)
    {
        $link = $this->getDbLink();
        $query = 'UPDATE User SET PASSWORD = ? WHERE ID = ? AND KEYMOD = ? AND EMAIL  = ?';
        if ($stmt = mysqli_prepare($link, $query)) {
            mysqli_stmt_bind_param($stmt, "siis", $mdp, $id, $keymod, $email);
            mysqli_stmt_execute($stmt);
            header('location: /Utilisateur');
            exit;
        }
    }
}