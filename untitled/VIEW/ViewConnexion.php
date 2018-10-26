<?php

class ViewConnexion extends HtmlPage {

    public function ConnexionPage($title) {
        $this->start_page($title);
        if ($_SESSION['Login'] === 'Admin' || $_SESSION['Login'] === 'Membre') {
            $this->connecter();
        }
        else {
            $this->nonConnecter();
        }
        $this->end_page();
    }
}