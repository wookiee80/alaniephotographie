<?php
include 'autoload.php';

$db = new PDO('mysql:host=localhost;dbname=test', 'root', '');
$db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_WARNING);
$db->query('set names utf8');

$manager = new AlbumsManager($db);

$albums = $manager->getListAlbum();

if(!empty($albums))
{

    (int) $i = 0;
    (int) $j = 0;
    echo '<table><tr>';
    foreach ($albums as $unAlbum)
    {
        if(is_dir('server/php/'.$unAlbum->dir()))
	{
	    opendir('server/php/'.$unAlbum->dir().'/thumbnails/');
	    $listePhotos = array_diff(scandir('server/php/'.$unAlbum->dir().'/thumbnails/'),array('..', '.'));

	    echo '
		<td>'.$unAlbum->titre().'</td>
		</tr>
		<tr>';


	    $j = count($listePhotos) + 1;
	    while($j >= 2)
	    {

		    echo '
		    <td><img src="server/php/'.$unAlbum->dir().'/thumbnails/'.$listePhotos[$j].'"/></td>'; 
		$j--;

		$i++;
		if($i%4 == 0)
		{
		    echo'</tr><tr>';
		}
	    }
	    echo '</table><br/>
		    <table>';

	
	echo '</tr>
	    </table>';
	}
    }
    
}
else
    header ('location:index.php');

