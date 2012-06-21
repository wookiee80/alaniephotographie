<?php
include_once 'controleurs/controleur_menu.php';
?><!DOCTYPE html>
<html>
    <head>
        <title>Alanie photographie</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" type="text/css" href="css/style_menu.css"/>
	<link rel="stylesheet" type="text/css" href="css/global_style.css"/>
        <!--[if lt IE 9]>
            <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->
    </head>
    <body>
        <div id="bloc_page">
        <header>
            <div id="banniere"></div>
            <nav>
        <ul id="menu">
            <li><a href="#">Accueil</a></li>
            <li><a href="#">Tarifs</a></li>
            <li><a href="#">Albums</a>
                <ul class="menuderoulant">
                    <li><a href="#">Maternité</a></li>
                    <?php echo $menuMaternite ?>
                    <li><a href="#">Nouveaux nés</a></li>
                    <?php echo $menuNNe ?>
                    <li><a href="#">Bébés</a></li>
                    <?php echo $menuBebe ?>
                    <li><a href="#">Enfants</a></li>
                    <?php echo $menuEnfant ?>
                    <li><a href="#">Mariages</a></li>
                    <?php echo $menuMariage ?>
                    <li><a href="#">Portraits</a></li>
                    <?php echo $menuportrait ?>
                    <li><a href="#">Animaux</a></li>
                    <?php echo $menuAnimeaux ?>
                </ul>
            </li>
            <li><a href="#">Contact</a></li>
        </ul>
            </nav>
        </header>
        </div>
    </body>
</html>
