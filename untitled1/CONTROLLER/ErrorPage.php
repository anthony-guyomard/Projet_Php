<?php
/**
 * Created by PhpStorm.
 * User: sylvi
 * Date: 30/10/2018
 * Time: 12:41
 */

class ErrorPage implements InterfaceController
{
    public function display($data = [])
    {
        if ($data[0] == 'UnknowPage') {
            include_once 'VIEW/ViewErrorPage.php';
            $view = new ViewErrorPage();
            $view->error01("Page non Existante");
            echo '<section class="sec_princ">
                      <h1>ERROR 01</h1>
                      <p>Page non existante sur ce site !</p>
                  </section>';
        }
        elseif ($data[0] == 'NoResultForSearch') {
            include_once 'VIEW/ViewErrorPage.php';
            $view = new ViewErrorPage();
            $view->error01("Résultat de recherche NULL");
            echo '<section class="sec_princ">
                      <h1>ERROR 02</h1>
                      <p>Pas de résultat pour votre recherche !</p>
                  </section>';
        }
    }
}