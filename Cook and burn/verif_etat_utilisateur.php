<?php

session_start();

$Login = filter_input(INPUT_POST, 'Login');
$Password = filter_input(INPUT_POST, 'Password');
$action = filter_input(INPUT_POST, 'Action');

$dbLink = mysqli_connect('mysql-antantsylfa.alwaysdata.net', '167748', 'lesbg1234')
or die('Erreur de connexion au serveur : ' . mysqli_connect_error());
mysqli_select_db($dbLink , 'antantsylfa_cookandburn')
or die('Erreur dans la sélection de la base : ' . mysqli_error($dbLink));

if ($action == 'Connexion') {
    $query = 'SELECT EMAIL, PWD, STATUS FROM User WHERE EMAIL = \'' . $Login . '\' AND PWD = \'' . $Password . '\'';

    if(!($dbResult = mysqli_query($dbLink, $query)))
    {
        echo 'Erreur de requete <br>';
        echo 'Erreur : '. mysqli_error($dbLink) . '<br>';
        echo 'Requete : '. $query . '<br>';
    }

    $dbRow = mysqli_fetch_assoc($dbResult);

    $Type = $dbRow ['STATUS'];

    if ($Type == 'Admin') {
        $_SESSION['login'] = $Type;
        header('Location: index.php');
    }
    elseif ($Type == 'Membre') {
        $_SESSION['login'] = $Type;
        header('Location: index.php');
    }
    else {
        header('Location: connexion.php');
    }
}
elseif ($action == 'Deconnexion') {
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}