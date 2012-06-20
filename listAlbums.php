<?php
include 'autoload.php';
include 'AlbumsManager.class.php';

$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
$db->query('set names utf8');

$manager = new AlbumsManager($db);

$albums = $manager->getListAlbum();

if(!empty($albums))
{
    (int) $i = 0;
    echo '<table><tr>';
    foreach ($albums as $unAlbum)
    {
        opendir('server/php/'.$unAlbum->dir().'/thumbnails/');
        $listePhotos = scandir('server/php/'.$unAlbum->dir().'/thumbnails/');
        $random = rand(0,count($listePhotos)-1);
        echo '<td>'.$unAlbum->titre().'<br/><img href="server/php/'.$unAlbum->dir().'/thumbnails/'.$listePhotos[$random].'"/></td>';
        $i++;
        if($i%4 == 0)
        {
            echo'</tr><tr>';
        }
        
        
        
    }
}

