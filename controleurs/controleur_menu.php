<?php
include 'autoload.php';// Ce qui nous sert pour charger automatiquement nos classes

$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué
$db->query('set names utf8');    
$manager = new AlbumsManager($db);

$listeAlbums = $manager->getListAlbum();// on récupère la liste des tous les albums

// on créé un tableau pour ranger ensuite pour chaque album, la catégorie auquel il appartient
$categories = array("maternite" => array(),
                    "nouveauxnes" => array(),
                    "bebes" => array(),
                    "enfants" => array(),
                    "mariages" => array(),
                    "portraits" => array(),
                    "animaux" => array(),
                    );

foreach ($listeAlbums as $unAlbum)// on boucle la totalité des albums
    {
    /*
     * Pour Cahque album on va vérifier à quel categorie il appartient.
     * Puis on va créer un lien dynamique en rapport avec l'album + sa categorie.
     * Ces liens sont alors trier dans notre tableau.
     */
    switch ($unAlbum->categorie()) 
        {
            case 'Maternité':
                $categories['maternite'][] = '<a href="../vueAlbum.php?titre='.$unAlbum->titre().'&categorie=Maternité">'.$unAlbum->titre().'</a>';
                continue 2;
            case 'Nouveaux nés':
                $categories['nouveauxnes'][] = '<a href="../vueAlbum.php?titre='.$unAlbum->titre().'&categorie=Nouveaux nés">'.$unAlbum->titre().'</a>';
                continue 2;
            case 'Bébés':
                $categories['bebes'][] = '<a href="../vueAlbum.php?titre='.$unAlbum->titre().'&categorie=Bébés">'.$unAlbum->titre().'</a>';
                continue 2;
            case 'Enfants':
                $categories['enfants'][] = '<a href="../vueAlbum.php?titre='.$unAlbum->titre().'&categorie=Enfants">'.$unAlbum->titre().'</a>';
                continue 2;
            case 'Mariages':
                $categories['mariages'][] = '<a href="../vueAlbum.php?titre='.$unAlbum->titre().'&categorie=Mariages">'.$unAlbum->titre().'</a>';
                continue 2;
            case 'Portraits':
                $categories['portraits'][] = '<a href="../vueAlbum.php?titre='.$unAlbum->titre().'&categorie=Portraits">'.$unAlbum->titre().'</a>';
                continue 2;
            case 'Animaux':
                $categories['animaux'][] = '<a href="../vueAlbum.php?titre='.$unAlbum->titre().'&categorie=Animaux">'.$unAlbum->titre().'</a>';
                continue 2;

            default:
                continue 2;
        }
    }
          $menuMaternite ='';  
    
    if(count($categories['maternite'])!= NULL)
    {
        $menuMaternite = '<ul class="menucategorie">';
        foreach($categories['maternite'] as $value)
        {
            $menuMaternite.= '<li>'.$value.'</li>';
        }
        $menuMaternite.= '</ul>';
    }
    
    if(count($categories['nouveauxnes'])!=NULL)
    {
        $menuNNe = '<ul class="menucategorie">';
        foreach($categories['nouveauxnes'] as $value)
        {
            $menuNNe.= '<li>'.$value.'</li>';
        }
        $menuNNe.= '</ul>';
    }
    else
        $menuNNe ='';
    
    if(count($categories['bebes'])!=NULL)
    {
        $menuBebe = '<ul class="menucategorie">';
        foreach($categories['bebes'] as $value)
        {
            $menuBebe.= '<li>'.$value.'</li>';
        }
        $menuBebe.= '</ul>';
    }
    else
        $menuBebe='';
    
    if(count($categories['enfants'])!=NULL)
    {

        $menuEnfant = '<ul class="menucategorie">';
        foreach($categories['enfants'] as $value)
        {
            $menuEnfant.= '<li>'.$value.'</li>';
        }
        $menuEnfant.= '</ul>';
    }
    else
        $menuEnfant='';
    
    if(count($categories['mariages'])!=NULL)
    {
        $menuMariage = '<ul class="menucategorie">';
        foreach($categories['mariages'] as $value)
        {
            $menuMariage.= '<li>'.$value.'</li>';
        }
        $menuMariage.= '</ul>';
    }
    else
        $menuMariage='';
    
    if(count($categories['portraits'])!=NULL)
    {
        $menuportrait = '<ul class="menucategorie">';
        foreach($categories['portraits'] as $value)
        {
            $menuportrait.= '<li>'.$value.'</li>';
        }
        $menuportrait.= '</ul>';
    }
    else
        $menuportrait='';
    
    if(count($categories['animaux'])!=NULL)
    {
        $menuAnimeaux = '<ul class="menucategorie">';
        foreach($categories['animaux'] as $value)
        {
            $menuAnimeaux.= '<li>'.$value.'</li>';
        }
        $menuAnimeaux.= '</ul>';
    }
    else
        $menuAnimeaux='';