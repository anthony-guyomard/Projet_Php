<?php
function start_page($title) {
    echo '<!doctype html>
             <html lang="fr"> 
             <head>
                <meta charset="utf-8">
                <title>' . $title . '</title>
                <script src=\'https://www.google.com/recaptcha/api.js\'></script>
                <link rel="stylesheet" href="StyleSheet.css">
             </head>
             <body>
             <header>
                <ul>
                   <li><a href="index.php" class="logo"><img src="https://zupimages.net/up/18/41/6j51.png" height="46" width="35"></a></li>
                   <div class="liens">
                       <li><a href="recette.php">Recettes</a></li>
                       <li><a href="compteutilisateur.php">Mon Compte</a></li>
                   </div>
                       <li><p class="site">Cook & Burn</p></li>
                       <li>
                           <input class="input_menu" type="text" type="search" placeholder="Rechercher une recette"/>
                           <input class="input_menu2" type="submit" name="search" value="Search"/>
                           <li><img src="https://zupimages.net/up/18/41/auzb.png" class="loupe" height="50" width="50"></a></li>
                       </li>
                       <li style="float:right"><a href="connexion.php" class="connexion">Connexion</a></li>
               </ul>
             </header>';
}

function end_page() {
    echo '</body>
          </html>';
}

