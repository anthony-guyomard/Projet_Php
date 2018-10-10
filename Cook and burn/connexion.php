<?php
session_start();

include_once 'usefullfunctions.php';
include_once 'verif_etat_utilisateur.php';

start_page('Page de connexion');

if (!($_SESSION['login'])) {
    echo '<section class="sec_log">
            <div class="inter_div">
              <h1 class="titre_h1">Connexion</h1>
              <form method="post" action="verif_etat_utilisateur.php" class="formulaire">' .
                 $error . '<br>
                 <label for="ID">Identifiant</label><br>
                 <input type="text" name="Login" placeholder="Adresse Email" class="zone_champ"/><br><br>
                 <label for="PWD">Mot de passe</label><br>
                 <input type="password" name="Password" placeholder="password" class="zone_champ"/><br><br>
                 <label for="PWD"><a href="" style="font-size:10px; float: right; margin-right: 25%;">mot de passe oublié ?</a></label><br><br>
                 <div class="g-recaptcha" data-sitekey="6LcEqHMUAAAAAMYaLovgwlJij3pXPhs8nTB2YRCi"></div><br>
                 <input type="submit" name="Action" value="Connexion"/><br><br>
              </form>  
              </div>        
          </section>';
}
elseif ($_SESSION['login'] == 'Admin' || $_SESSION['login'] == 'Membre') {
    echo '<section class="sec_log">
            <div class="inter_div">
              <h1 class="titre_h1">Vous êtes déjà connecté</h1>
              <a href="compteutilisateur.php">Mon compte</a>
            </div>
          </section>';
}
end_page();
