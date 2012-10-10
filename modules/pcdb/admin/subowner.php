<?

if (isset($_REQUEST['opt'])) {
	$opt = $_REQUEST['opt'];
} else {
	$opt = "";
}

switch ($opt) {
	case 'add':
		if (isset($_POST['name'])) {
			$action = 'insert';
			$fields = array("name", "description");
			include "-save.php";	
			redirect_header(XOOPS_URL."/modules/pcdb/admin/?op=subowner", 3, _MI_PCDB_ADDED);
		}
		$title = _MI_PCDB_ADDSUBOWNER;
		$fields = array("name"=>"text", "description"=>"textarea");
		$req = array("name"=>true);
		include "-edit.php";
	break;
	case 'view':
		include "-view.php";
	break;
	case 'delete':
		include "-delete.php";
	break;
	case 'edit':
		if (isset($_POST['name'])) {
			$action = 'update';
			$fields = array("name", "description");
			include "-save.php";	
			redirect_header(XOOPS_URL."/modules/pcdb/admin/?op=subowner", 3, _MI_PCDB_SAVED);
		}
		$title = _MI_PCDB_EDITSUBOWNER;
		$fields = array("name"=>"text", "description"=>"textarea", 'id'=>'hidden');
		$req = array("name"=>true);
		$gotvalues = true;
		include "-edit.php";
	break;
	default:
		$fields = array("id", "name", "description", '@edit', '@delete');
		include "-show.php";
	break;
}