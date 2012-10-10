<?php
if (!isset($op)) {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}

$table = $xoopsDB->prefix("pcdb_$op");

if (isset($_REQUEST['id'])) {
	echo "<table width=\"100%\">";
	$sql = "SHOW COLUMNS FROM `$table`;";
	$rez = $xoopsDB->queryF($sql);
	if (isset($fields)&&is_array($fields)) {
		$fields2 = $fields;
	} else {
		$fields2 = array();
	}
	$fields = array();
	while ($arx = $xoopsDB->fetchArray($rez)) {
		$fields[$arx['Field']] = array('type'=>$arx['Type'], 'null'=>$arx['Null']);
	}
	$sql = "SELECT * FROM `$table` WHERE ID = '".$_REQUEST['id']."' LIMIT 1;";
	$rez = $xoopsDB->queryF($sql);
	echo "<tr>";
	echo "<th colspan=\"2\">";
	echo _MI_PCDB_VIEW;
	echo "</th>";
	echo "</tr>";
	while ($arx = $xoopsDB->fetchArray($rez)) {
		foreach ($fields as $key => $value) {
			echo "<tr>";
			echo "<td class=\"even\" width=\"20%\">";
			echo constant("_MI_PCDB_FIELD_".strtoupper($key));
			echo "</td>";
			echo "<td class=\"odd\" width=\"80%\">";
			if (($arx[$key] == 'NULL') && ($value['null']=='YES')) {
				echo '-';
			} else {
				if (in_array(strtolower($key), array_keys($fields2))) {
					$tbl = $xoopsDB->prefix("pcdb_".$fields2[strtolower($key)]);
					$sql = "SELECT `name` FROM `$tbl` WHERE ID = '".$arx[$key]."' LIMIT 1;";
					$rez2 = $xoopsDB->queryF($sql);
					list($name) = $xoopsDB->fetchRow($rez2);
					echo $name;
				} else {
					echo $arx[$key];
				}
			}
			echo "</td>";
			echo "</tr>";
		}
	}
	echo "</table>";
	if (!isset($nocomments)) {
		include '-commentlist.php';
		include '-commentform.php';
	}
} else {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}