<?php
include_once 'usefullfunctions.php';

start_page(Recette1);

echo '
<section id="sec_flex" class="sec_recipe">
<h2> Nom Recette </h2>

<div class="div_align">
Le Lorem Ipsum est simplement du faux texte employé dans la composition
et la mise en page avant impression. Le Lorem Ipsum est le faux texte 
standard de l\'imprimerie depuis les années 1500, quand un imprimeur 
anonyme assembla ensemble des morceaux de texte pour réaliser un livre 
spécimen de polices de texte. Il n\'a pas fait que survivre cinq siècles,
mais s\'est aussi adapté à la bureautique informatique, sans que son 
contenu n\'en soit modifié. Il a été popularisé dans les années 1960 
grâce à la vente de feuilles Letraset contenant des passages du Lorem Ipsum, 
et, plus récemment, par son inclusion dans des applications de mise en page 
de texte, comme Aldus PageMaker.

</div>
<div class="div_align">
<img src="https://cdn.pixabay.com/photo/2017/08/26/22/58/meat-2684630_960_720.jpg" height="50" width="50"/>
</div>

</section>';

end_page();

