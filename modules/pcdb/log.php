<?

if (!isset($xoopsUser)) {
	header('location: http://www.google.lt/?q=jasas;');
}

function WriteLog($message) {
	global $xoopsDB, $xoopsUser;
	$table = $xoopsDB->prefix("pcdb_log");
	$uid = $xoopsUser->getVar('uid');
	$message = addslashes($message);
	$date = date("r");
	$sql = "INSERT INTO $table(`UID`,`Text`,`Date`) VALUES($uid, '$message', '$date');";
	$xoopsDB->queryF($sql);
}

function GetField($table, $field, $id) {
	global $xoopsDB;
	$table = $xoopsDB->prefix("pcdb_$table");
	$sql = "SELECT a.$field FROM $table a WHERE a.id = '$id';";
	$rez = $xoopsDB->queryF($sql);
	list($name) = $xoopsDB->fetchRow($rez);
	return $name;
}

?>