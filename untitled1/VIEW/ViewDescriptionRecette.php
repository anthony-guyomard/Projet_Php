<?php
/**
 * Created by PhpStorm.
 * User: sylvi
 * Date: 18/10/2018
 * Time: 22:49
 */

class ViewDescriptionRecette extends HtmlPage
{
    /**
     * @param $title
     * @param $recette
     * @param $var
     */
    public function DecripRecettePage($title, $recette, $var) {

        if ($_SESSION['Login'] == 'Admin' or $_SESSION['Login'] == 'Membre') {

            $this->start_page($title);
            echo '<section class="sec_princ">
            <div class="inter_div">';
            $this->LikeBurn($recette['IDR']);
            echo '<br>';
            echo $_SESSION['verifburn'] . '<br>';
            $this->TheRecette($recette);
            if ($var === true) {
                $this->editerInfoRecette($recette['IDR']);
            }
            echo '<br></div></section>';
            $this->end_page();
        }
        else {
            $this->start_page($title);
            echo '<section class="sec_princ">
            <div class="inter_div">';
            $this->TheRecetteVisitor($recette);
            echo '<br>
                    <p>Pour Consulter la totalité d\'une recette, vous devez posseder un compte.</p>
                    <p><a class="like-unlike" href="/Utilisateur">Connexion</a></p>
                    </div>
                    </section>';
            $this->end_page();
        }
    }

    /**
     * @param $recette
     */
    public function TheRecette($recette) {
        $this->ShowTheRecette($recette);
    }

    /**
     * @param $recette
     */
    public function TheRecetteVisitor($recette) {
        $this->ShowTheRecetteVisitor($recette);
    }
}