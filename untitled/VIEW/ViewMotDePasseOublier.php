<?php
/**
 * Created by PhpStorm.
 * User: sylvi
 * Date: 16/10/2018
 * Time: 21:12
 */

class ViewMotDePasseOublier extends HtmlPage
{

    public function MdpLostPage($title)
    {
        $this->start_page($title);
        $this->motDePasseOublier();
        $this->end_page();
    }
}