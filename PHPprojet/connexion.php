<?php

include 'usefullfunctions.php';

start_page('Page de connexion');


echo '<section class="form_login">
      <h1>Connexion</h1>
          <form method="post" action="">
             <label for="ID">Identifiant</label><br>
             <input type="text" name="ID" placehorder="Email, Identifiant" class="zone_champ"/><br>
             <label for="PWD">Mot de passe : </label><br>
             <input type="password" name="PWD" placehorder="password" class="zone_champ"/><br>
             <label for="PWD"><a href="" style="font-size:10px;">mot de passe oublié ?</a></label><br><br>
             <div class="g-recaptcha" data-sitekey="6LcEqHMUAAAAAMYaLovgwlJij3pXPhs8nTB2YRCi"></div>
             <input type="submit" value="Se connecter"/><br><br>
          </form>           
      </section>';

end_page();
