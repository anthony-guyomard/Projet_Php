<?php

include_once 'usefullfunctions.php';

start_page('Page de connexion');

echo '<section class="sec_log">
        <div class="inter_div">
          <h1 class="titre_h1">Connexion</h1>
          <form method="post" action="" class="formulaire">
             <label for="ID">Identifiant</label><br>
             <input type="text" name="ID" placeholder="Email, Identifiant" class="zone_champ"/><br><br>
             <label for="PWD">Mot de passe</label><br>
             <input type="password" name="PWD" placeholder="password" class="zone_champ"/><br><br>
             <label for="PWD"><a href="" style="font-size:10px; float: right; margin-right: 25%;">mot de passe oublié ?</a></label><br><br>
             <div class="g-recaptcha" data-sitekey="6LcEqHMUAAAAAMYaLovgwlJij3pXPhs8nTB2YRCi"></div><br>
             <input type="submit" value="Se connecter"/><br><br>
          </form>  
          </div>        
      </section>';

end_page();
