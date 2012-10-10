<?php

if (!isset($fields)) {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}

if (isset($_POST['start'])) {
	$_SESSION['pcdb']['start'] = intval($_POST['start']);
}

if (!isset($_SESSION['pcdb']['start'])) {
	$_SESSION['pcdb']['start'] = 0;
}
$start = $_SESSION['pcdb']['start'];

if (!isset($infix)) $infix ='';
if (!isset($orderby)) $orderby ='';

if (isset($where)) {
	$where = " WHERE $where";
} else {
	$where = "";
}

$table = $xoopsDB->prefix("pcdb_$op");

$sql = "SELECT count(*) FROM $table$where";
$rez = $xoopsDB->queryF($sql);
list($count) = $xoopsDB->fetchRow($rez);

if ($count>20) {
	echo "<table width=\"100%\"><tr><td align=\"left\">";
	echo "<form method=\"post\">";
	echo _MI_PCDB_SHOWFROM;
	echo "<input type=\"text\" name=\"start\" value=\"$start\">";
	echo "<input type=\"submit\" value=\""._SUBMIT."\">";
	echo "</form>";
	echo "</td><td align=\"left\">";
	echo sprintf(_MI_PCDB_COUNT, $count);
	echo "</td><td align=\"left\">";
} else {
	$start = 0;
}
if (!isset($nonew)) {
	echo "<table width=\"100%\"><tr><td align=\"right\">";
	echo "<form method=\"post\">";
	echo "<input type=\"button\" value=\""._MI_PCDB_ADDNEW."\" onclick=\"document.location='?op=$op&opt=add';\">";
	echo "</form>";
	echo "<td><tr><table>";
}
if ($count>20) {
	echo "<td><tr><table>";
}

$fields2 = $fields;
$fields = array();
foreach ($fields2 as $key => $value)  {
	if (substr($value,0,1)!='@') {
		$fields[$key] = $value;
	}
}

echo "<table>";
echo "<tr>";
foreach ($fields2 as $name) {
	if (substr($name,0,1)!='@') {
		echo "<th>".constant("_MI_PCDB_FIELD_".strtoupper($name))."</th>";
	} else {
		echo "<th width=\"15\"></th>";
	}
}
echo "</tr>";
if (in_array('@user', $fields2)) {
	$fields[] = 'uid';
}
if ($count < 1) {
	echo "<tr>";
	echo "<td colspan=\"".count($fields)."\" align=\"center\">";
	echo _MI_PCDB_NORESULTS;
	echo "</td>";
	echo "</tr>";
} else {
	if (in_array('@removed', $fields2)) {
		$sql = "SELECT ".implode(",", $fields).", RemoveDate FROM $table$where $orderby LIMIT $start, 20";
	} else {
		$sql = "SELECT ".implode(",", $fields)." FROM $table$where $orderby LIMIT $start, 20";
	}
	$rez = $xoopsDB->queryF($sql);
	$even = true;
	$exist = file_exists(XOOPS_ROOT_PATH.'/modules/profile/userinfo.php');
	while ($arx = $xoopsDB->fetchArray($rez)) {
		echo "<tr class=\"".(($even=(!$even))?'even':'odd')."\">";
		foreach ($fields2 as $value) {
			if (substr($value,0,1)!='@') {
				echo "<td>".$arx[$value]."</td>";
			} else {
				echo "<td>";
				switch ($value) {
					case '@removed':
						$time = strtotime($arx['RemoveDate']);
						if (($time<time())&&(strlen("$time")>4)){
							echo "-";
						} else {
							echo "+";
						}
					break;
					case '@user':
						if ($exist) {
							echo "<b><a href=\"".XOOPS_URL."/modules/profile/userinfo.php?uid=".$arx['uid']."\">".$xoopsUser->getUnameFromId($arx['uid'])."</a></b>";
						} else {
							echo "<b>".$xoopsUser->getUnameFromId($arx['uid'])."</b>";
						}
					break;
					default:
						echo "<a href=\"".XOOPS_URL."/modules/pcdb/$infix?op=$op&id=$arx[id]&opt=".substr($value,1)."\" title=\"".constant("_MI_PCDB_ICON_".strtoupper(substr($value,1)))."\"><img src=\"".XOOPS_URL."/modules/pcdb/images/".substr($value,1).".jpeg\" width=\"15\" height=\"15\" border=\"0\" />";
				}
				echo "</td>";
			}
		}
		echo "</tr>";
	}
}
echo "</table>";