<?php

define('PCDB_MODULE_PATH', dirname(dirname(__FILE__)));

$path = '../../';
while(!file_exists($path .  'mainfile.php'))
   $path .= '../';

require_once $path . 'mainfile.php';

require_once XOOPS_ROOT_PATH."/include/cp_functions.php";
require_once XOOPS_ROOT_PATH."/include/functions.php";

global $xoopsUser, $xoopsUserIsAdmin;

if (!$xoopsUser || !$xoopsUserIsAdmin)
    return redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);

include_once PCDB_MODULE_PATH . '/log.php';