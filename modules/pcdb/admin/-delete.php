<?php
if (!isset($op)) {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}

$table = $xoopsDB->prefix("pcdb_$op");

if (isset($_REQUEST['id'])) {
	$id = intval($_REQUEST['id']);
	$name2 = GetField($op,'name',$id);
	$name3 = GetField($op,'serialnr',$id);
	$sql = "DELETE FROM $table WHERE id = '$id' LIMIT 1;";
	$rez = $xoopsDB->queryF($sql);
	$cpr = constant('_MI_PCDB_LOG_WHAT_'.strtoupper($op));
	WriteLog(sprintf(_MI_PCDB_LOG_DELETED, $cpr, "$name2 ($name3)"));
	redirect_header(XOOPS_URL."/modules/pcdb/admin/?op=$op", 3, _MI_PCDB_DELETED);
} else {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}