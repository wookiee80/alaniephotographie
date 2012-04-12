<?php
include 'autoload.php';

$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING); // On émet une alerte à chaque fois qu'une requête a échoué
$db->query('set names utf8');

$manageAlbum = new AlbumManager();

