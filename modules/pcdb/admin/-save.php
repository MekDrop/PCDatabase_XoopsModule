<?

if (!isset($fields)) {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}

$table = $xoopsDB->prefix("pcdb_$op");

$rez = array();
$f2 = array();
foreach ($fields as $name) {
	if ($_POST[$name] == "") {
//		$rez[$name] = "NULL";
	} else {
		$rez[$name] = "'".addslashes($_POST[$name])."'";
		$f2[] = $name;
	}
}

$cpr = constant('_MI_PCDB_LOG_WHAT_'.strtoupper($op));
if ($action == 'insert') {
	$sql = "INSERT INTO $table(`".implode('`,`',$f2).'`) VALUES('.implode(',',$rez).");";
//	die($sql);
//	$pid = $rez['id'];
	$urx = XOOPS_URL."/modules/pcdb/index.php?op=$op";
	$name3 = isset($rez['serialnr'])?$rez['serialnr']:'';
	$name2 = isset($rez['name'])?$rez['name']:'';
	$rez = $xoopsDB->queryF($sql);	
	WriteLog(sprintf(_MI_PCDB_LOG_ADDED, $cpr, $urx, "$name2 ($name3)"));
} else {
	$sql = "";
	$id = intval($_POST['id']);
	foreach ($f2 as $name) {
		$sql = "UPDATE $table SET $name = ".$rez[$name]." WHERE id = '$id'";
		$xoopsDB->queryF($sql);
	}
	$urx = XOOPS_URL."/modules/pcdb/index.php?op=$op&opt=view&id=$id";
	$name2 = GetField($op,'name',$id);
	$name3 = GetField($op,'serialnr',$id);
	WriteLog(sprintf(_MI_PCDB_LOG_UPDATED, $cpr, $urx, "$name2 ($name3)"));
//	print nl2br($sql);
//	die();
}

?>
