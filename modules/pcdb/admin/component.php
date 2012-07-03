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
			$fields = array("name", "gotdate", "removedate", "description", "serialnr", "groupid", "ownerid", "subownerid");
			include "-save.php";	
			redirect_header(XOOPS_URL."/modules/pcdb/admin/?op=component", 3, _MI_PCDB_ADDED);
		}
		$title = _MI_PCDB_ADDCOMPONENT;
		$fields = array("name"=>"text", "gotdate"=>"date", "removedate"=>"date", "description"=>"textarea", "serialnr"=>"text", "groupid"=>"@group","ownerid"=>"@owner","subownerid"=>"@subowner");
		$req = array("name"=>true);
		include "-edit.php";
	break;
	case 'view':
		$fields = array('groupid'=>'group', 'ownerid'=>'owner','subownerid'=>'subowner'); 
		include "-view.php";
	break;
	case 'delete':
		include "-delete.php";
	break;
	case 'edit':
		if (isset($_POST['name'])) {
			$action = 'update';
			$fields = array("name", "gotdate", "removedate", "description", "serialnr", "groupid", "ownerid", "subownerid");
			include "-save.php";	
			redirect_header(XOOPS_URL."/modules/pcdb/admin/?op=component", 3, _MI_PCDB_SAVED);
		}
		$title = _MI_PCDB_EDITCOMPONENT;
		$fields = array("name"=>"text", "gotdate"=>"date", "removedate"=>"date", "description"=>"textarea", 'id'=>'hidden', "serialnr"=>"text", "groupid"=>"@group","ownerid"=>"@owner","subownerid"=>"@subowner");
		$req = array("name"=>true);
		$gotvalues = true;
		include "-edit.php";
	break;
	default:
		$fields = array("id", "serialnr", "name", '@removed', '@view', '@edit', '@delete');
		include "-show.php";
	break;
}

