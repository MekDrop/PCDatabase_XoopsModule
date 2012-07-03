<?php
   if (!isset($_REQUEST['id'])) return;
   if (!isset($op)) return;
   if (!isset($infix)) $infix ='';
?>
<form method="POST" action="<?=XOOPS_URL."/modules/pcdb/admin/";?>-commentpost.php">
<table width="100%">
	<tr>
		<th>
			<?=_CM_POSTCOMMENT;?>
		</th>
	</tr>
	<tr>
		<td width="70%">			
		  <input type="hidden" name="redirect" value="<?=$op;?>" />
		  <input type="hidden" name="operation" value="<?=$opt;?>" />
		  <input type="hidden" name="infix" value="<?=$infix;?>" />
		  <input type="hidden" name="id" value="<?=$_REQUEST['id'];?>" />
		  <input type="hidden" name="uid" value="<?=$xoopsUser->getVar('uid');?>" />
		  <textarea name="comment" style="width: 100%; height: 100px;"></textarea>
		</td>
	</tr>
	<tr>
		<td align="center">
			<input type="submit" value="<?=_SUBMIT;?>">
		</td>
	</tr>
</table>
</form>