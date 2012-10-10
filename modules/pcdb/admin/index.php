<?php

include '../include/admin_common.php';

global $xoopsTpl;

$op = $_REQUEST['op'];

if (file_exists($op.'.php')) {    
	$infix = 'admin/';
    xoops_cp_header();
	include $op.'.php';
    xoops_cp_footer();
} else {
	header('Location: index.php?op=software');
}