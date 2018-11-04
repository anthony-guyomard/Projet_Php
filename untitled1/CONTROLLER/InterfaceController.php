<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 11/10/2018
 * Time: 17:02
 */

interface InterfaceController
{
    /**
     * @param array $data
     * @return mixed
     */
    public function display($data = []);
}