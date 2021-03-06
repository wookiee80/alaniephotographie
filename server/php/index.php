<?php
/*
 * jQuery File Upload Plugin PHP Example 5.7
 * https://github.com/blueimp/jQuery-File-Upload
 *
 * Copyright 2010, Sebastian Tschan
 * https://blueimp.net
 *
 * Licensed under the MIT license:
 * http://www.opensource.org/licenses/MIT
 */
ini_set('display_errors', 1);
error_reporting(E_ALL); 
//error_reporting(E_ALL | E_STRICT);

require('upload.class.php');



header('Pragma: no-cache');
header('Cache-Control: no-store, no-cache, must-revalidate');
header('Content-Disposition: inline; filename="files.json"');
header('X-Content-Type-Options: nosniff');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: OPTIONS, HEAD, GET, POST, PUT, DELETE');
header('Access-Control-Allow-Headers: X-File-Name, X-File-Type, X-File-Size');

switch ($_SERVER['REQUEST_METHOD']) {
    case 'OPTIONS':
        break;
    case 'HEAD':
    case 'GET':
        $mydir = htmlentities($_GET['dir']);
        $upload_handler = new UploadHandler(NULL,$mydir);
        $upload_handler->get();
        break;
    case 'POST':
        if (isset($_REQUEST['_method']) && $_REQUEST['_method'] === 'DELETE') {
	    $mydir = $_REQUEST['dir'];
            $upload_handler = new UploadHandler(NULL,$mydir);
            $upload_handler->delete();
        } else {
            $mydir = htmlentities($_GET['dir']);
            $upload_handler = new UploadHandler(NULL,$mydir);
            $upload_handler->post();
        }
        break;
    case 'DELETE':
        $mydir = $_REQUEST['dir'];
        $upload_handler = new UploadHandler(NULL,$mydir);
        $upload_handler->delete();
        break;
    default:
        header('HTTP/1.1 405 Method Not Allowed');
}
