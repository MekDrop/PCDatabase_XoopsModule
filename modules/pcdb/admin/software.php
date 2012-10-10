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
			$fields = array("name", "licenses", "gotdate", "untildate", "description");
			include "-save.php";	
			redirect_header(XOOPS_URL."/modules/pcdb/admin/?op=software", 3, _MI_PCDB_ADDED);
		}
		$title = _MI_PCDB_ADDSOFTWARE;
		$fields = array("name"=>"text", "licenses"=>"number", "gotdate"=>"date", "untildate"=>"date", "description"=>"textarea");
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
			$fields = array("name", "licenses", "gotdate", "untildate", "description");
			include "-save.php";	
			redirect_header(XOOPS_URL."/modules/pcdb/admin/?op=software", 3, _MI_PCDB_SAVED);
		}
		$title = _MI_PCDB_EDITSOFTWARE;
		$fields = array("name"=>"text", "licenses"=>"number", "gotdate"=>"date", "untildate"=>"date", "description"=>"textarea", 'id'=>'hidden');
		$req = array("name"=>true);
		$gotvalues = true;
		include "-edit.php";
	break;
	default:
		$fields = array("id", "name", "licenses", "gotdate", "untildate", '@view', '@edit', '@delete');
		include "-show.php";
	break;
}