<?

if (isset($_REQUEST['opt'])) {
	$opt = $_REQUEST['opt'];
} else {
	$opt = "";
}

$fields = array("id", "date", 'text', "@user");
$nonew = true;
$orderby = "ORDER BY ID DESC";
include "-show.php";


?>