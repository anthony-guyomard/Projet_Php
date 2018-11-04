<?php
/**
 * Created by PhpStorm.
 * User: sylvi
 * Date: 16/10/2018
 * Time: 21:12
 */

class ViewMotDePasseOublier extends HtmlPage
{
    /**
     * @param $title
     */
    public function MdpLostPage($title)
    {
        $this->start_page($title);
        $this->motDePasseOublier();
        $this->end_page();
    }

    /**
     * @param $title
     * @param $id
     * @param $keymod
     * @param $email
     */
    public function formNewPassword($title, $id, $keymod, $email) {
        $this->start_page($title);
    echo '  <section class="sec_princ">
                <div class="inter_div">
                    <h1>Choisissez un nouveau mot de passe</h1>
                    <form action="/MotDePasseOublier/ModifierMotDePasse/' . $id . '/' . $keymod . '/' . $email . '" method="post">
                        <input style="text-align: center;" type="password" name="NewMdp" placeholder="password" required><br>
                        <input style="text-align: center;" type="password" name="VerifNewMdp" placeholder="réécrire votre password" required><br><br>
                        <button type="submit" name="action" value="passwordChange">Modifier Mot de passe</button>
                    </form>
                </div>
            </section>';
        $this->end_page();
    }
}