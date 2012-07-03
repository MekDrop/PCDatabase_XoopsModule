<?php

if (!isset($op)) {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}

if (!isset($infix)) $infix ='';

$pid = $_REQUEST['id'];

if (isset($_POST['action'])) {
	switch ($_POST['action']) {
		case 'add':
			$itemid = $_POST['item'][$_POST['groupid']];
			$table = $xoopsDB->prefix("pcdb_pc_items");
			$sql = "INSERT INTO $table(`Type`,`ItemID`, `PID`) VALUES('hardware','$itemid','$pid');";
			$rez = $xoopsDB->queryF($sql);
			$cmt = XOOPS_URL."/modules/pcdb/index.php?op=component&id=$itemid";
			$cmt2 = XOOPS_URL."/modules/pcdb/index.php?op=computer&opt=components&id=$pid";
			$name4 = GetField('component','serialnr',$itemid);
			$name1 = GetField('component','name',$itemid);
			$name2 = GetField('computer','name',$pid);
			$name3 = GetField('computer','serialnr',$pid);
			WriteLog(sprintf(_MI_PCDB_LOG_ASSIGNED, $cmt, "$name1 ($name4)", $cmt2, "$name2 ($name3)"));
			redirect_header(XOOPS_URL."/modules/pcdb/$infix/index.php?op=$op&id=".$_REQUEST['id']."&opt=".$_REQUEST['opt'], 3, _MI_PCDB_ADDED);
			return;
		break;
		case 'delete':
			$pid = GetField('pc_items','pid',$_POST['what']);
			$itemid = GetField('pc_items','itemid',$_POST['what']);
			$name4 = GetField('component','serialnr',$itemid);
			$name1 = GetField('component','name',$itemid);
			$name2 = GetField('computer','name',$pid);
			$name3 = GetField('computer','serialnr',$pid);
			$sql = sprintf("DELETE FROM %s WHERE id = '%d' LIMIT 1;", $xoopsDB->prefix("pcdb_pc_items"), $_POST['what']);
			$rez = $xoopsDB->queryF($sql);
			$cmt = XOOPS_URL."/modules/pcdb/index.php?op=component&opt=view&id=$itemid";
			$cmt2 = XOOPS_URL."/modules/pcdb/index.php?op=computer&opt=components&opt=view&id=$pid";
			WriteLog(sprintf(_MI_PCDB_LOG_UNASSIGNED, $cmt, "$name1 ($name4)", $cmt2, "$name2 ($name3)"));
			redirect_header(XOOPS_URL."/modules/pcdb/$infix/index.php?op=$op&id=".$_REQUEST['id']."&opt=".$_REQUEST['opt'], 3, _MI_PCDB_DELETED);
			return;
		break;
	}
}

$nocomments = true;
include '-view.php';

$table = $xoopsDB->prefix("pcdb_pc_items");
$table2 = $xoopsDB->prefix("pcdb_component");
$table3 = $xoopsDB->prefix("pcdb_group");
$sql = "SELECT a.id, b.id, b.name, c.name
FROM $table a, $table2 b, $table3 c
WHERE a.pid = '$pid'
AND a.itemid = b.id
AND b.groupid = c.id";
$rez = $xoopsDB->queryF($sql);
if ($xoopsDB->getRowsNum($rez)>0) {
?>
<table width="100%">
	<tr>
		<th colspan="4"><?=_MI_PCDB_COMPONENTS;?></th>
	</tr>
<?
while (list($kid, $id, $name, $group) = $xoopsDB->fetchRow($rez)) {
	echo "<tr>";
	echo "  <td class=\"even\" width=\"20%\">";
	echo "    $group";
	echo "  </td>";
	echo "  <td class=\"odd\" width=\"80%\">";
	echo "    $name";
	echo "  </td>";
	echo "  <td class=\"odd\" style=\"width: 16px; min-width: 16px; max-width: 16px;\" nowrap><form style=\"margin-bottom: 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px; padding-top: 0px;\" method=\"post\" action=\"".XOOPS_URL."/modules/pcdb/$infix/index.php?op=component&opt=view&id=$id\"><input type=\"hidden\" name=\"action\" value=\"view\"><input type=\"image\" src=\"".XOOPS_URL."/modules/pcdb/images/view.jpeg\"></form></td>";
	echo "  <td class=\"odd\" style=\"width: 16px; min-width: 16px; max-width: 16px;\" nowrap><form style=\"margin-bottom: 0px; margin-left: 0px; margin-right: 0px; margin-top: 0px; padding-bottom: 0px; padding-left: 0px; padding-right: 0px; padding-top: 0px;\" method=\"post\" action=\"".XOOPS_URL."/modules/pcdb/$infix/index.php?op=$op&id=".$_REQUEST['id']."&opt=".$_REQUEST['opt']."\"><input type=\"hidden\" name=\"action\" value=\"delete\"><input type=\"hidden\" name=\"what\" value=\"$kid\"><input type=\"image\" src=\"".XOOPS_URL."/modules/pcdb/images/delete.jpeg\"></form></td>";
	echo "</tr>";
}
?>
</table>
<?}

echo "<form method=\"post\" action=\"".XOOPS_URL."/modules/pcdb/$infix/index.php?op=$op&id=".$_REQUEST['id']."&opt=".$_REQUEST['opt']."\">";
echo "<input name=\"action\" value=\"add\" type=\"hidden\">";
echo "<table width=\"100%\">";
echo "<tr>";
echo "<th colspan=\"3\">";
echo _MI_PCDB_ADDCOMPONENT;
echo "</th>";
echo "</tr>";
echo "<tr>";
echo "<td style=\"width: 150px;\">";
$table = $xoopsDB->prefix("pcdb_group");
$sql = "SELECT a.id, a.name FROM $table a ORDER BY a.name;";
$table = $xoopsDB->prefix("pcdb_component");
$table2 = $xoopsDB->prefix("pcdb_pc_items");
$rez = $xoopsDB->queryF($sql);
echo "<select onchange=\"changeComponents(this);\"  style=\"display: table; width: 150px;\" name=\"groupid\">\r\n";
$arx = array();
while (list($id, $name) = $xoopsDB->fetchRow($rez)) {
	if (!isset($firstid)) {
		$firstid = $id;
		echo "<option value=\"$id\" selected>";
	} else {
		echo "<option value=\"$id\">";
	}
	$sql = "SELECT a.id, a.name FROM $table a WHERE a.groupid = '$id' AND NOT a.id IN (SELECT itemid FROM $table2) ORDER BY a.name";
	$rez2 = $xoopsDB->queryF($sql);
	while (list($id2, $name2) = $xoopsDB->fetchRow($rez2)) {
		$arx[$id][$id2] = $name2;
	}
	echo "$name</option>\r\n";
}
echo "</select>";
echo "<td align=\"left\" style=\"width: 150px;\">";
$code = "";
foreach ($arx as $id => $data) {
	$code .= "<select id=\"item-$id\" name=\"item[$id]\" style=\"display: none; width: 150px;\"> \r\n";
	foreach ($data as $key=> $value) {
		$code .= "  <option value=\"$key\">$value</option>\r\n";
	}
	$code .= "</select>\r\n";
}
echo $code;
echo "<span id=\"nocmp\" style=\"display: block; border-style: solid; border-width: 1px; height: 10px; margin-top: 0px; margin-left: 0px; margin-right: 0px; margin-bottom: 0px; padding-top: 1px; padding-bottom: -2px;\" class=\"odd\">"._MI_PCDB_NORESULTS."</span>";
echo "</td>"
?>
<td>
  <input id="addbtn" type="submit" value="<?=_ADD;?>">
</td>
</tr>
</table>
<script type="text/javascript">
var prvID = null;
function changeComponents(obx) {	
	var obj = null;
	var okx = document.getElementById('nocmp');
	var okt = document.getElementById('addbtn');
	if (prvID)	{
		if (obj = document.getElementById('item-'+prvID))	{
			obj.style.display = 'none';	
		}
	}
	if (obj = document.getElementById('item-'+obx.value))	{
		obj.style.display = 'block';
		okx.style.display = 'none';
		okt.disabled = false;
	} else {
		okx.style.display = 'block';
		okt.disabled = true;
	}
	prvID = obx.value;
}
changeComponents(<?=$firstid;?>);
</script>
</form>