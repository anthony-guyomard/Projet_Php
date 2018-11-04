<?php

class ViewCompte extends HtmlPage {

    /**
     * @param $title
     */
    public function comptePage($title) {
        $this->start_page($title);
    }

    public function compteAdmin1()
    {
        $this->inscription();
    }

    public function compteAdmin2() {
        echo '</div>
              </section>';
        $this->monCompte();
        $this->editerInfoCompte();
        echo '<form action="/Utilisateur" method="post">                                               
                        <input type="submit" name="Action" value="Deconnexion">                                    
                    </form><br>
                </div>
              </div>';
        echo '</div></div>';
        echo '<div class="parent">
                <div class="enfant3">
                    <h3>Vos recettes : </h3>';
    }

    public function compteUser() {
        $this->monCompte();
        $this->editerInfoCompte();
        echo '<form action="/Utilisateur" method="post">                                               
                        <input type="submit" name="Action" value="Deconnexion">                                    
                    </form><br>
                </div>
              </div>';
        echo '</div></div>';
        echo '<div class="parent">
                <div class="enfant3">
                    <h3>Vos recettes : </h3>';
    }

    public function addRecette() {
        if ($_SESSION['Login'] == 'Admin' || $_SESSION['Login'] == 'Membre') {
            echo '</section>';
            $this->AjouterRecette();
        }
        else {
            null;
        }
    }

    /**
     * @param $name
     * @param $email
     * @param $id
     */
    public function ShowAllUser($name, $email, $id) {
        $this->ShowUser($name, $email, $id);
    }

    public function text() {
        echo '<section class="sec_princ">
                <div class="inter_div">
                    <h1 class="titre_h1">Liste des Utilisateurs</h1>';
    }

    public function endComptePage() {
        $this->end_page();
    }
}