<?

include_once "../../mainfile.php";

include XOOPS_ROOT_PATH."/header.php";

include 'log.php';

if (isset($_REQUEST['op'])) {
	$op = $_REQUEST['op'];
} else {
	$op = 'computer';
}

if (file_exists('admin/'.$op.'.php')) {
	include 'admin/'.$op.'.php';
} else {
	print 'Document can\'t be found.';
}

include XOOPS_ROOT_PATH."/footer.php";
?>