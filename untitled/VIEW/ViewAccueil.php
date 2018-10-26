<?php
/**
 * Created by PhpStorm.
 * User: b17014741
 * Date: 11/10/2018
 * Time: 16:06
 */

class ViewAccueil extends HtmlPage
{

    public function accueilPage() {
        $this->start_page('Bienvenue sur Cook & Burn');
        $this->Entreprise();
    }

    public function endAccueilPage() {
        echo '</section><br>';
        $this->end_page();
    }
}