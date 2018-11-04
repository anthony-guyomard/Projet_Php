<?php
/**
 * Created by PhpStorm.
 * User: Sylvian Brunet
 * Date: 11/10/2018
 * Time: 16:36
 */

abstract class HtmlPage
{
    /**
     * @param $title
     */
    public function start_page($title){
        echo '<!doctype html>
             <html lang="fr"> 
             <head>
                <meta charset="utf-8">
                <title>' . $title . '</title>
                <link rel="stylesheet" href="/VIEW/CSS/StyleSheet.css">
                <meta property="og:title" content="Cook & Burn" /> 
                <meta property="og:image" content="https://www.google.com/search?q=image+de+barbecue&client=firefox-b-ab&source=lnms&tbm=isch&sa=X&ved=0ahUKEwiT8vSeo5_eAhWLIMAKHaUXC6IQ_AUIDigB&biw=1678&bih=898#imgrc=EQxRz3bP1rbhuM:" /> 
                <meta property="og:description" content="Bienvenue sur le site de Cook and Burn !" />
             </head>
             <body>
             <header>
             <form action="/SearchBar" method="post">
                <ul>
                   <li><a href="/Accueil" class="logo"><img src="/VIEW/Image/logo/lol2.png" height="53" width="50"></a></li>
                   <li><a href="/Recette">Recettes</a></li>
                   <li><a href="/Compte">Mon Compte</a></li>
                   <li><p class="site">Cook & Burn</p></li>';
        if ($_SESSION['Login'] == 'Admin' || $_SESSION['Login'] == 'Membre') {
            echo '<li style="float:right"><a href="/Utilisateur" class="connexion">Deconnexion</a></li>';

        }
        else {
            echo'<li style="float:right"><a href="/Utilisateur" class="connexion">Connexion</a></li>';
        }
        echo '
                   <li style="float:right"><button style="margin-right: 50px;margin-top: 14px;padding: 5px 7px 0 5px;border-radius: 0 5px 5px 0;" type="submit" name="action" value="Valider"><img src="/VIEW/Image/logo/search_icon.png"></button></li>
                   <li style="float:right"><input style="margin-top: 14px;width: 200px;border-radius: 5px 0 0 5px;padding: 5px 7px 4px 5px;" placeholder="Rechercher une recette" name="rechercher"/></li>
               </ul>
            </form>
        </header>';
    }

    public function messageUne() {
        echo '<p> Pas de recette à la Une</p>';
    }

    public function Entreprise() {
        echo '<section class="sec_princ" style="margin-bottom: 100px;">
                <h1>Bienvenue sur Cook & burn !</h1>
                <img src="VIEW/Image/logo/lol2.png" height="250px" width="240px">
                <h1>L\'entreprise</h1>
                <p>
                    Nous sommes une entreprise établie depuis 2010. <br>
                    "Cook & Burn" était spécialisé dans la vente de BBQ et a aujourd\'hui évolué dans la vente de BBQ connecté. <br>
                    Nous vous offrons une qualité supérieur d\'appareils, qu\'il soit à gaz ou à charbon de bois. <br>
                    Nous vous offrons également des services comme ce site où nos clients et visiteurs partage leurs recettes.</p>
                <p>
                    Qualité, Connectivité, Service, voilà ce que vous offre "Cook & Burn".
                </p>';
    }

    public function topRecette() {
        echo '<h1>Meilleure recette du moment !!</h1>';
    }

    public function nonConnecter() {
        $this->start_page('Connexion à votre compte');
        echo '<section class="sec_log">
            <div class="inter_div">
              <h1 class="titre_h1">Connexion</h1>
              <form method="post" action="/Utilisateur" class="formulaire"><br>
                 <label for="ID">Identifiant</label><br>
                 <input type="text" name="Login" placeholder="Adresse Email" class="zone_champ"/><br><br>
                 <label for="PWD">Mot de passe</label><br>
                 <input type="password" name="Password" placeholder="password" class="zone_champ"/><br><br>
                 <label for="PWD"><a href="/MotDePasseOublier" style="font-size:10px; float: right; margin-right: 25%;">mot de passe oublié ?</a></label><br><br>
                 <input type="submit" name="Action" value="Connexion"/><br><br>
              </form>  
              </div>        
          </section>';
        $this->end_page();
    }

    public function connecter() {
        $this->start_page('Votre compte');
        echo '<section class="sec_log">
            <div class="inter_div">
              <h1 class="titre_h1">Voulez-vous vraiment vous deconnecter ?</h1>
              <p>Redirection vers  : <a href="/Compte" class="like-unlike">Mon compte</a></p>
              <form action="/Utilisateur" method="post">                                               
                 <input type="submit" name="Action" value="Deconnexion">                                    
              </form>
            </div>
          </section>';
        $this->end_page();
    }

    public function monCompte() {
        echo '<section class="sec_princ">
              <h1>Mon Compte</h1>
              <div class="parent">
                <div class="enfant3"><br>
                    <label>Nom Utilisateur : </label><input form="editerInfoCompte" type="text" disabled="true" name="name" class="editable" value="'; echo $_SESSION['Name']; echo '"><br>
                    <label>Adresse e-mail : </label><input form="editerInfoCompte" type="text" disabled="true" name="email" class="editable" value="'; echo $_SESSION['Email']; echo '"><br>
                    <label>Mot de passe : </label><input form="editerInfoCompte" type="password" disabled="true" name="password" class="editable" value="'; echo $_SESSION['Password']; echo '"><br>
                    <label>Statut : </label><input type="text" disabled="true" id="nonEditable" value="'; echo $_SESSION['Login']; echo '"><br><br>';
    }

    public function editerInfoCompte(){
        echo '
        <form action="/Compte/EditerInfoCompte" method="post" id="editerInfoCompte">
         <button id="editeInformationCompte" type="button" onclick="test()"> Editer </button><br>
         <p style="display: none;" id="phraseInfoCompte">Si vous modifier votre mot de passe, renseigner votre ancien mot de passe ! </p>
         <input type="password" id="mdpInformationCompte" style="display: none;" name="verifMdp" placeholder="mot de passe"/>
         <button id="changeInformationCompte" style="display:none" type="submit"> Valider </button> <br>
        </form>
         <script>
               function test() {
                   var elements = document.getElementsByClassName("editable");
                   for(var i=0; i<elements.length; i++) {
                       elements[i].disabled = false;
                   }
                   document.getElementById("mdpInformationCompte").style.display = "inline";
                   document.getElementById("changeInformationCompte").style.display = "inline";
                   document.getElementById("editeInformationCompte").style.display = "none";
                   document.getElementById("phraseInfoCompte").style.display = "contents";
                }
        </script>
        ';
    }

    /**
     * @param $id
     */
    public function editerInfoRecette($id){
        echo '
        <form action="/DescriptionRecette/EditerInfoRecette/'. $id .'" method="post" id="editerInfoRecette">
         <button id="editInfoRecette" type="button" onclick="test()"> Editer </button><br>
         <input type="password" id="mdpInfoRecette" style="display: none;" name="verifMdp" placeholder="mot de passe"/>
         <button id="changeInfoRecette" style="display:none" type="submit"> Valider </button> <br>
        </form>
         <script>
               function test() {
                   var elements = document.getElementsByClassName("editable");
                   for(var i=0; i<elements.length; i++) {
                       elements[i].disabled = false;
                   }
                   document.getElementById("mdpInfoRecette").style.display = "inline";
                   document.getElementById("changeInfoRecette").style.display = "inline"; 
                   document.getElementById("editInfoRecette").style.display = "none";
                }
        </script>
        ';
    }

    public function inscription() {
        echo '<section class="sec_princ">
                <div class="inter_div">
                    <h1 class="titre_h1">Ajouter un Compte</h1>
                    <form action="/Compte/inscription" method="POST">
                        <input type="text" name="NAME" placeholder="Nom"/>
                        <input type="password" name="PASSWORD" placeholder="mot de passe"/><br>
                        <input type="text" name="EMAIL" placeholder="Mail"/>
                        <select name="STATUT">
                            <option>--</option>
                            <option>Membre</option>
                            <option>Admin</option>
                        </select><br>
                        <button type="submit" name="Action" value="Inscription">Ajouter le Compte</button>
                    </form>
                </div>
            </section>';
    }

    public function AjouterRecette() {
        echo '
            <script type=\'text/javascript\'>
                function preview_image(event) 
                {
                 var reader = new FileReader();
                 reader.onload = function()
                 {
                  var output = document.getElementById(\'output_image\');
                  output.src = reader.result;
                 }
                 reader.readAsDataURL(event.target.files[0]);
                }
            </script>
            <style>
                #output_image
                {
                 max-width:300px;
                }
             </style>
             <section class="sec_princ">
                <div class="inter_div">
                    <h1 class="titre_h1">Nouvelle Recette</h1>
                    <form action="/Recette/newRecette" method="POST" enctype="multipart/form-data">
                        <img id="output_image"/><br>
                        <label>Selectionner une image pour votre recette</label><br>
                        <input type="file" name="IMAGE"  onchange="preview_image(event)"><br><br>
                        <label>Nom de la recette : </label>
                        <input type="text" name="NAME" placeholder="Nom de la recette"><br>
                        <label>Nombre de convives : </label>
                        <select name="NMBRGUESTS">
                            <option>--</option>
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                            <option>6</option>
                            <option>7</option>
                            <option>8</option>
                            <option>9</option>
                            <option>10</option>
                        </select><br>
                        <textarea style="height: 100px; width: 350px;" type="text" name="SHORTDESCRIP" placeholder="Courte Description"></textarea><br>
                        <textarea style="height: 100px; width: 350px;" type="text" name="LONGDESCRIP" placeholder="Longue Description"></textarea><br>
                        <textarea style="height: 100px; width: 350px;" type="text" name="INGREDIENTS" placeholder="Ingrédients"></textarea><br>
                        <textarea style="height: 100px; width: 350px;" type="text" name="STAGE" placeholder="Etapes de préparation"></textarea><br>
                        <button type="submit" name="Add" value="AjouterRecette">Ajouter</button>
                    </form>
                    </div>
                    <div class="inter_div>';
    }

    /**
     * @param $id
     * @param $titre
     * @param $image
     */
    public function ShowRecette($id, $titre, $image){
        echo '
		<form action="/DescriptionRecette/display/'.$id.'" method="post">
        <button type="submit" name="action" value="'.$id.'"><img style="height: 200px; width: 250px;" src="' .  $image . '"><br>' . $titre .'</button>
		</form><br>';
    }

    /**
     * @param $name
     * @param $email
     * @param $id
     */
    public function ShowUser($name, $email, $id) {
        echo '<label>Nom Utilisateur : </label>'.$name.' | <label>Email : </label>'.$email;
        echo '<form action="/Compte/DeleteUser" method="POST" style="display: inline;">
                    <button type="submit" name="id" value="'.$id.'">Delete</button>
              </form><br>';

    }

    public function connexion() {
        echo '
            <form action="/Utilisateur" method="post">
                <button type="submit" name="action">Se connecter</button>
            </form><br>';
    }

    /**
     * @param $recette
     */
    public function ShowTheRecette($recette){
        echo'
                    <img style="height: 200px; width: 250px;" src="' .  $recette['IMAGE'] . '"><br>
                    <label> Nombre de Burns :  </label> <input name="nbburn" form="editerInfoRecette" style="width: 25px; text-align: center;" type="text" name="titre" disabled="true" class="editable" form="editerRecette" value="'.$recette['NBBURN'].'"/><br>
                    <label> Titre de la recette : </label> <input name="name" form="editerInfoRecette" style="width: 300px;" type="text" name="titre" disabled="true" class="editable" form="editerRecette" value="'.$recette['NAME'].'"/> <br>
                    <label> Nombre de personnes :  </label> <input name="nbpers" form="editerInfoRecette" style="width: 25px; text-align: center;" type="text" name="titre" disabled="true" class="editable" form="editerRecette" value="'.$recette['NMBRGUESTS'].'"/> <br>
                    <label> Courte Description :  </label> <br> <textarea name="courtdes" form="editerInfoRecette" style="min-width: 350px;max-width: 400px; min-height: 150px; max-height: 350px;" name="descri" disabled="true" class="editable"  form="editerRecette" >'.$recette['SHORTDESCRIP'].'</textarea> <br>
                    <label> Longue Description :  </label> <br> <textarea name="longdes" form="editerInfoRecette" style="min-width: 350px;max-width: 400px; min-height: 150px; max-height: 350px;" name="descri" disabled="true" class="editable"  form="editerRecette" >'.$recette['LONGDESCRIP'].'</textarea> <br>
                    <label> Ingrédients :  </label> <br> <textarea name="ingre" form="editerInfoRecette" style="min-width: 350px;max-width: 400px; min-height: 150px; max-height: 350px;" name="descri" disabled="true" class="editable"  form="editerRecette" >'.$recette['INGREDIENTS'].'</textarea> <br>
                    <label> Préparation :  </label> <br> <textarea name="stage" form="editerInfoRecette" style="min-width: 350px;max-width: 400px; min-height: 150px; max-height: 350px;" name="ingre" disabled="true" class="editable" form="editerRecette" >'.$recette['STAGE'].'</textarea> <br>
                    <div class="partage">
                        <a target= "blank" href="https://www.facebook.com/sharer/sharer.php?u=http%3A//antantsylfa.alwaysdata.net/DescriptionRecette/display/'.$recette['IDR'].'" class="sharebox1">
                            <span class="fb-icon"></span>partager</a>
                        <a target= "blank" href="https://twitter.com/home?status=http%3A//antantsylfa.alwaysdata.net/DescriptionRecette/display/'.$recette['IDR'].'" class="sharebox2">
                            <span class="twitter-icon"></span>partager</a>
                    </div>';
    }

    /**
     * @param $recette
     */
    public function ShowTheRecetteVisitor($recette){
        echo'
                    <img style="height: 200px; width: 250px;" src="' .  $recette['IMAGE'] . '"><br>
                    <label> Nombre de Burns :  </label> <input style="width: 25px; text-align: center;" type="text" name="titre" disabled="true" class="editable" form="editerRecette" value="'.$recette['NBBURN'].'"/><br>
                    <label> Titre de la recette : </label> <input style="width: 300px;" type="text" name="titre" disabled="true" class="editable" form="editerRecette" value="'.$recette['NAME'].'"/> <br>
                    <label> Nombre de personnes :  </label> <input style="width: 25px; text-align: center;" type="text" name="titre" disabled="true" class="editable" form="editerRecette" value="'.$recette['NMBRGUESTS'].'"/> <br>
                    <label> Courte Description :  </label> <br> <textarea style="min-width: 350px;max-width: 400px; min-height: 150px; max-height: 350px;" name="descri" disabled="true" class="editable"  form="editerRecette" >'.$recette['SHORTDESCRIP'].'</textarea> <br>
                    ';
    }

    /**
     * @param $idR
     */
    public function LikeBurn($idR) {
        echo '<a class="like-unlike" href="/DescriptionRecette/gestionBurn/add/'. $idR . '">Burn la recette !</a>';
    }

    public function motDePasseOublier(){
        echo '
                <section class="sec_princ">
                    <div class="inter_div">
                        <p>Renseigner votre Adresse mail pour recevoir votre mot de passe.</p>
                        ' . $_SESSION['etatmdp'] . '
                        <form action="/MotDePasseOublier" method="post">
                            <input type="text" name="adrrMail" placeholder="adresse mail..." required>
                            <button type="submit" name="action" value="sendMail">Envoyer</button>
                        </form>
                    </div>
                </section>
        ';
    }

    /**
     * @param $msg
     */
    public function alert($msg) {
        echo '<script type=\'text/javascript\'>alert("' . $msg . '");</script>';
    }

    public function end_page() {
        echo '</body>
          </html>';
    }
}