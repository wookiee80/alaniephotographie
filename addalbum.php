<?php
include 'autoload.php';

$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué
$db->query('set names utf8');  
$manager = new AlbumsManager($db);

if(isset($_POST['creer']) && !empty($_POST['titre']) && !empty($_POST['intro']))
{
    $album = new Album(array('titre'=> $_POST['titre'],
                             'intro'=> $_POST['intro'],
                             'dir'=>$_POST['titre'].date("dmYHis"),
                             'date'=>Date("d-m-Y"),
                             'categorie'=>$_POST['categorie']
                        ));
    
    
    if($manager->existAlbum($album->titre()))
    {
        echo 'Un album porte déjà ce nom';
        unset($album);
    }
    else
        $manager->addAlbum ($album);
}
else
{
    echo 'tous les champs ne sont pas renseignés.';
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Créer un album</title>
    </head>
    <body>
        <fieldset>
        <legend>Créer un album</legend>
        <form method="post" action ="">
            Titre : <input type="text" name="titre"/><br/>
            Infos sur l'album: <textarea name="intro"></textarea><br/>
            Catégorie : <select name="categorie">
                            <option>Maternité</option>
                            <option>Nouveaux nés</option>
                            <option>Bébés</option>
                            <option>Enfants</option>
                            <option>Mariages</option>
                            <option>Portraits</option>
                            <option>Animaux</option>
                        </select>
            <input type="submit" name ="creer" value="Créer"/>
        </form>
        </fieldset>
        <p>
            Liste des albums:
            <br/>
            <?php
            $albums = $manager->getListAlbum();
            
            if(empty($albums))
            {
                echo 'Aucun album déjà créé.';
            }
            else 
            {
                foreach ($albums as $unAlbum) 
                {
                    echo '<a href="updateAlbum.php?album='.$unAlbum->titre().'">'.$unAlbum->titre().'</a><br/>';
                }
            }
            ?>
        </p>
    </body>
</html>