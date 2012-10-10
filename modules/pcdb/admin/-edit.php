<?php

include XOOPS_ROOT_PATH.'/class/xoopsformloader.php';

if (!isset($fields)) {
	redirect_header(XOOPS_URL."/user.php", 3, _AD_NORIGHT);
}

if (isset($gotvalues)) {
	$table = $xoopsDB->prefix("pcdb_$op");
	$sql = "SELECT ".implode(",", array_keys($fields))." FROM $table WHERE id = '".intval($_REQUEST['id'])."' LIMIT 1;";
	$rez = $xoopsDB->queryF($sql);
	$values = $xoopsDB->fetchArray($rez);
}

$form = new XoopsThemeForm($title, 'form', '');
foreach ($fields as $name => $type) {
	$caption = constant("_MI_PCDB_FIELD_".strtoupper($name));
	$value = (isset($values[$name]))?$values[$name]:'';
	$required = (isset($req[$name]))?true:false;
	switch ($type) {
		case 'textarea':
			$form->addElement(new XoopsFormTextArea($caption, $name, $value),$required);
		break;
		case 'date':
			if ($value!='') {
				$value = strtotime($value);
			}
			$form->addElement(new XoopsFormTextDateSelect($caption, $name, $value),$required);
		break;
		case 'hidden':
			$form->addElement(new XoopsFormHidden($name, $_REQUEST[$name]));
		break;
		default:
			if (substr($type,0,1)=='@') {
				$groups = new XoopsFormSelect($caption, $name, $value, $size=1, $multiple=false);
				$tbl = substr($type,1);
				$tbl = $xoopsDB->prefix("pcdb_$tbl");
				$sql = "SELECT a.id, a.name FROM $tbl a ORDER BY a.name;";
				$rez = $xoopsDB->queryF($sql);
				if ($xoopsDB->getRowsNum($rez)<1) {
					redirect_header(XOOPS_URL."/modules/pcdb/admin/index.php?op=$op", 3, constant('_MI_PCDB_ADD'.strtoupper(substr($type,1)).'FIRST'));
					return;
				}
				while (list($id, $name) = $xoopsDB->fetchRow($rez)) {
					$groups->addOption($id, $name);
				}
				$form->addElement($groups, $required);
			} else {
				$form->addElement(new XoopsFormText($caption, $name, 25, 255, $value),$required);
			}
		break;
	}
}	
$form->addElement(new XoopsFormButton('', 'submit', _SUBMIT, 'submit'));
$form->display();

