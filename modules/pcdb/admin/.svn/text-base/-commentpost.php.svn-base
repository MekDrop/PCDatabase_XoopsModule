<?php

include "../../../mainfile.php";
if (!$xoopsUser) {
    redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}

include XOOPS_ROOT_PATH."/include/cp_functions.php";
include_once '../log.php';

if (!isset($_POST['redirect'])) {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
	return;
}

$table = $xoopsDB->prefix("pcdb_comment");

$infix = $_POST['infix'];
$type = $_POST['redirect'];
$uid = $_POST['uid'];
$date = date("r");
$pid = $_POST['id'];
$operation = $_POST['operation'];
$comment = addslashes($_POST['comment']);
$sql = "INSERT INTO $table (`Type`, `UserID`, `Date`, `Comment`, `PID`) VALUES ('$type', $uid, '$date', '$comment', $pid);";
$rez = $xoopsDB->queryF($sql);

include XOOPS_ROOT_PATH."/modules/pcdb/language/".$xoopsConfig['language']."/modinfo.php";
if ($xoopsDB->getAffectedRows()>0) {
	$cmt = XOOPS_URL."/modules/pcdb/index.php?op=$type&opt=$operation&id=$pid";
	WriteLog(sprintf(_MI_PCDB_LOG_COMMENT, $cmt, $cmt));
	redirect_header(XOOPS_URL."/modules/pcdb/$infix/index.php?op=$type&opt=$operation&id=$pid", 3, _MI_PCDB_ADDED);
} else {
	redirect_header(XOOPS_URL."/modules/pcdb/$infix/index.php?op=$type&opt=$operation&id=$pid", 3, _MI_PCDB_CANTCOMPLETE);
}

?>