<?php

if (isset($_REQUEST['opt'])) {
	$opt = $_REQUEST['opt'];
} else {
	$opt = "";
}

switch ($opt) {
	case 'add':
		if (isset($_POST['name'])) {
			$action = 'insert';
			$fields = array("name", "gotdate", "removedate", "description", "description", "ownerid", "subownerid", "ownerinfo", "serialnr");
			include "-save.php";	
			redirect_header(XOOPS_URL."/modules/pcdb/admin/?op=computer", 3, _MI_PCDB_ADDED);
		}
		$title = _MI_PCDB_ADDCOMPUTER;
		$fields = array("serialnr"=>"text", "name"=>"text", "gotdate"=>"date", "removedate"=>"date", "description"=>"textarea", "ownerid"=>"@owner", "subownerid"=>"@subowner", "ownerinfo"=>"text");
		$req = array("serialnr"=>true);
		include "-edit.php";
	break;
	case 'view':
		$fields = array('ownerid'=>'owner','subownerid'=>'subowner'); 
		include "-view.php";
	break;
	case 'delete':
		include "-delete.php";
	break;
	case 'edit':
		if (isset($_POST['name'])) {
			$action = 'update';
			$fields = array("name", "gotdate", "removedate", "description", "description", "ownerid", "subownerid", "ownerinfo", "serialnr");
			include "-save.php";	
			redirect_header(XOOPS_URL."/modules/pcdb/admin/?op=computer", 3, _MI_PCDB_SAVED);
		}
		$title = _MI_PCDB_EDITCOMPUTER;
		$fields = array("serialnr"=>"text", "name"=>"text", "gotdate"=>"date", "removedate"=>"date", "description"=>"textarea", "ownerid"=>"@owner", "subownerid"=>"@subowner", "ownerinfo"=>"text", 'id'=>'hidden');
		$req = array("serialnr"=>true);
		$gotvalues = true;
		include "-edit.php";
	break;
	case 'components':
		include "-components.php";
	break;
	default:
		$fields = array("id", "serialnr", "name", "@removed", '@view', '@components', '@edit',  '@delete');
		include "-show.php";
	break;
}