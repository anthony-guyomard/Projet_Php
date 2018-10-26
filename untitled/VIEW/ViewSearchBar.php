<?php
/**
 * Created by PhpStorm.
 * User: z17007611
 * Date: 25/10/18
 * Time: 14:17
 */

class ViewSearchBar extends HtmlPage
{
    public function SearchPage() {
        $this->start_page('Résultats recherche');
        echo '<section class="sec_princ">
                <h2>Résultat de votre recherche : </h2>';

    }
    public function ShowSearch($var, $titre, $image) {
        $this->ShowRecette($var, $titre, $image);

    }

    public function EndSearchPage() {
        echo '</section>';
        $this->end_page();
    }
}