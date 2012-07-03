<?php

$modversion['name'] = _MI_PCDB_NAME;
$modversion['version'] = 1.00;
$modversion['description'] = _MI_PCDB_DESC;
$modversion['author'] = "";
$modversion['credits'] = "MekDrop";
$modversion['help'] = "";
$modversion['license'] = "GPL see LICENSE";
$modversion['official'] = 0;
$modversion['image'] = "images/logo.png";
$modversion['dirname'] = "pcdb";

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = "admin/admin.php";
$modversion['adminmenu'] = "admin/menu.php";

// Menu
$modversion['hasMain'] = 1;
$modversion['sub'][] = array('name' => _MI_PCDB_COMPUTERS, 'url' => "index.php?op=computer");
$modversion['sub'][] = array('name' => _MI_PCDB_COMPONENTS, 'url' => "index.php?op=component");
$modversion['sub'][] = array('name' => _MI_PCDB_SOFTWARE, 'url' => "index.php?op=software");

$modversion['pages']=$modversion['sub'];

// Database
$modversion['sqlfile']['mysql'] = "sql/mysql.sql";

?>