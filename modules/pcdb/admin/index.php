<?php

include "../../../mainfile.php";
if (!$xoopsUser) {
    redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}

include XOOPS_ROOT_PATH."/include/cp_functions.php";

xoops_cp_header();

include '../log.php';

$op = $_REQUEST['op'];

if (file_exists($op.'.php')) {
	$infix = 'admin/';
	include $op.'.php';
} else {
	print 'Document can\'t be found.';
}

xoops_cp_footer();

?>