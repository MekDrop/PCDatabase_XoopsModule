<?php
if (!isset($op)) {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}

	require_once XOOPS_ROOT_PATH.'/language/'.$xoopsConfig['language'].'/comment.php';
	$sql = sprintf("SELECT a.ID, a.UserID, a.Date, a.Comment, b.uname, b.user_avatar
				   FROM `%s` a, `%s` b WHERE (a.PID = '%d' AND a.type = '%s') AND (b.uid = a.UserID)", 
				   $xoopsDB->prefix('pcdb_comment'), $xoopsDB->prefix('users'), $_REQUEST['id'], $op);
	$rez = $xoopsDB->queryF($sql);
	$exist = file_exists(XOOPS_ROOT_PATH.'/modules/profile/userinfo.php');
	if ($xoopsDB->getRowsNum($rez)>0) {
		echo "<table width=\"100%\">";
		echo "<tr>";
		echo "<th colspan=\"2\">";
		echo _MI_PCDB_COMMENTS;
		echo "</th>";
		echo "</tr>";
		while (list($id, $uid, $date, $comment, $uname, $avatar) = $xoopsDB->fetchRow($rez)) {
			echo "<tr>";
			echo "<td class=\"even\">";
			echo _MI_PCDB_COMMENT_WRITED;
			echo ":&nbsp;";
			if ($exist) {
				echo "<b><a href=\"".XOOPS_URL."/modules/profile/userinfo.php?uid=$uid\">$uname</a></b>";
			} else {
				echo "<b>$uname</b>";
			}
			echo "</td><td class=\"even\">";
			echo _DATE;
			echo ":&nbsp;";
			echo $date;
			echo "</td>";
			echo "</tr>";
			echo "<tr>";
			echo "<td class=\"odd\" colspan=\"2\">";
			echo $comment;
			echo "</td>";
			echo "</tr>";
		}
		echo "</table>";
	}