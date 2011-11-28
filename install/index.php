<?php 
/*
=====================================================
 Cs-Cart 2.0.7 Nulled By KenDesign
-----------------------------------------------------
 www.freeshareall.com - www.freeshareall.net
-----------------------------------------------------
 KenDesign Team
=====================================================
*/


//
// $Id: index.php 7502 2009-05-19 14:54:59Z zeke $
//

DEFINE ('AREA', 'C');
DEFINE ('AREA_NAME' ,'customer');

include('./../prepare.php');
define('DIR_INSTALL_SKINS', is_dir('../var/skins_repository') ? '../var/skins_repository' : '../skins');
include('./core/install.php'); 

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html>
<head>
<title><?php echo tr('installation_wizard'); ?></title>
<script type="text/javascript" language="javascript 1.2">

function fn_check_agreement()
{
	if (document.getElementById('imagree') && document.getElementById('imagree').checked == false) {
		alert("<?php echo tr('text_accept_license') ?>");
		return false;
	} else if (document.getElementById('cert_text'))  {
		if (document.getElementById('cert_text').value == '' && document.getElementById('cert_file').value == '') {
			alert("<?php echo tr('text_install_certificate') ?>");
			return false;
		}
	}

	return true;
}
</script>

<link href="./<?php echo DIR_INSTALL_SKINS ?>/base/customer/styles.css" rel="stylesheet" type="text/css" />
<style type="text/css">
.textarea-copyright {
	font-family: lucida console, courier new, courier, sans-serif;
	font-size:12px;
	border: 1px solid #dfe6ed;
}
.install-button {
	font-size:12px;
	font-family: tahoma, arial, sans-serif;
}
.status-OK {
	font-weight: bold;
	color: #109618;
}
.status-FAIL {
	font-weight: bold;
	color: #c12929;
}
.description {
	font-size: 10px;
	margin-top: 2px;
}
</style>
</head>
<body>


<!--[error_msg]-->
<div class="cm-notification-container">
<?php if (!empty($error_msg)): ?>
	<div class="notification-content-e">
		<div class="notification-e">
			<img class="cm-notification-close hand" style="visibility: hidden;" src="<?php echo DIR_INSTALL_SKINS ?>/base/customer/images/icons/notification_close.gif" width="10" height="19" border="0" alt="" title="" />
			<div class="notification-body">
				<?php echo $error_msg ?>
			</div>
		</div>
		<h1 class="notification-header-e"><?php echo tr('error') ?></h1>
	</div>
<?php endif; ?>
<!--[/error_msg]-->

<!--[warning_msg]-->
<?php if (!empty($warning_msg)): ?>
	<div class="notification-content-w">
		<div class="notification-w">
			<img class="cm-notification-close hand" style="visibility: hidden;" src="<?php echo DIR_INSTALL_SKINS ?>/base/customer/images/icons/notification_close.gif" width="10" height="19" border="0" alt="" title="" />
			<div class="notification-body">
				<?php echo $warning_msg ?>
			</div>
		</div>
		<h1 class="notification-header-w"><?php echo tr('warning') ?></h1>
	</div>
<?php endif; ?>
</div>
<!--[/warning_msg]-->


<div class="container">
<div id="container">

<img src="./<?php echo DIR_INSTALL_SKINS ?>/base/customer/images/customer_area_logo.gif" width="176" height="69" border="0" alt="" />

<div class="top-tools-container">
	<span class="float-left"> </span>
	<span class="float-right"> </span>

	<p align="right" style="font-weight: bold; font-size: 11px; padding: 13px 5px 3px 0px;">
		<?php echo tr('version') . PRODUCT_VERSION . (PRODUCT_STATUS != '' ? (' (' . PRODUCT_STATUS . ')') : ''); ?>

		<?php if ($mode == 'license') { ?>
		<select name="sl" onchange="location.href = 'index.php?sl=' + this.value" style="margin-top: -4px;">
		<?php 
		foreach($installation_languages as $k => $v) {
		?>
		<option value="<?php echo $k ?>"<?php if ($_SESSION['sl'] == $k) { ?>selected="selected"<?php } ?>><?php echo $v ?></option>
		<?php }	?>
		</select>
		<?php } ?>
	</p>
</div>
<p>&nbsp;</p>



<form name="installform" action="index.php" method="post" onsubmit="return fn_check_agreement();" <?php if($mode == 'certificate'): ?>enctype="multipart/form-data"<?php endif; ?> >
<input type="hidden" name="mode" value="<?php echo $next_mode; ?>" />

<table cellpadding="0" cellspacing="0" width="100%"	border="0">
<tr>
	<!--[menu]-->
	<td width="182" valign="top">


	<div class="sidebox-wrapper">
		<h3 class="sidebox-title">
			<span><?php echo tr('installation_steps') ?></span>
		</h3>
		<div class="sidebox-body">
				<?php 
				$steps = array(
					'license' => tr('license_agreement'),
					'requirements' => tr('checking_requirements'),
					'settings' => tr('host_db_settings'),
					'database' => tr('installing_database'),
					'outlook' => tr('outlook_settings'),
					'skins' => tr('installing_skins'),
					'certificate' => tr('certificate'),
					'summary' => tr('summary')
				);
				foreach($steps as $k => $v) {
					if ($k == 'certificate' && !defined('LICENSE_USED')) {
						continue;
					}
					echo '<div style="line-height:15px">'.(($mode == $k)?'<b>':'') . $v . (($mode == $k)?'</b>':'').'</div>';
				}
				?>

		</div>
		<div class="sidebox-bottom"><span>&nbsp;</span></div>
	</div>

	<img src="./<?php echo DIR_INSTALL_SKINS ?>/base/customer/images/spacer.gif" width="180" height="1" border="0" alt="" />

	</td>

	<!--[/menu]-->

	<!--[body]-->
	<td valign="top" style="padding-left: 20px; padding-right: 14px;">
		<div class="mainbox-wrapper">
			<div class="mainbox-body" align="center">

			<!--[License agreement]-->
			<?php if ($mode == 'license'): ?>
				<textarea cols="74" rows="24" readonly="readonly" class="textarea-copyright"><?php readfile('../copyright.txt') ?></textarea>
				<div><br /></div>
				<table cellpadding="0" cellspacing="3" border="0" align="center">
				<tr>
					<td><input type="checkbox" id="imagree" name="agree" value="Y" /></td>
					<td><label for="imagree" style="font-weight: bold;"><?php echo tr('text_agree_with_terms') ?></label></td>
				</tr>
				</table>
				<?php if (AUTH_CODE != ''): ?>
				<br />
				<table cellpadding="0" cellspacing="3" border="0" align="center">
				<tr>
					<td><?php echo tr('text_enter_auth_code') ?>:</td>
					<td><input type="text" class="input-text" size="10" name="auth_code"></td>
				</tr>
				</table>
				<div style="font-size: 9px;"><?php echo tr('text_auth_code_notice') ?></div>
				<br />
				<table cellpadding="0" cellspacing="0" border="0" align="center">
				<tr>
					<td style="height:25px;width:20px"><input type="radio" name="mode" value="requirements" checked="checked" /></td>
					<td align="left"><?php echo tr('new_installation') ?></td>
				</tr>
				<tr>
					<td><input type="radio" name="mode" value="outlook" /></td>
					<td align="left"><?php echo tr('reinstall_skins') ?></td>
				</tr>
				</table>
				<?php endif; ?>
				<br />

			<!--[Requirements]-->
			<?php elseif ($mode == 'requirements'): ?>
				
				<table border="0" cellpadding="2" cellspacing="0">
				<tr>
					<td>
				<table border="0" cellpadding="4" cellspacing="1">
				<tr>
					<td align="left"><?php echo tr('php_information') ?><div class="description"><?php echo tr('text_php_information_notice') ?></div></td>
					<td colspan="2" align="center"><a href="index.php?mode=phpinfo" target="_blank"><?php echo tr('display') ?></a></td>
				</tr>
				<tr>
					<td align="left" class="cart-table-dark-bg"><?php echo tr('php_version') ?><div class="description"><?php echo tr('text_php_version_notice', REQUIRED_PHP_VERSION) ?></div></td>
					<td align="center" class="cart-table-dark-bg"><?php echo $php_value ?></td>
					<td align="center" class="cart-table-dark-bg"><b><?php echo "<div class=\"status-$php_status\">&nbsp;$php_status&nbsp;</div>"; ?></b></td>
				</tr>
				<tr>
					<td align="left"><?php echo tr('mysql_support') ?><div class="description"><?php echo tr('text_mysql_support_notice') ?></div></td>
					<td align="center"><?php echo $mysql_value ?></td>
					<td align="center"><b><?php echo "<div class=\"status-$mysql_status\">$mysql_status</div>"; ?></b></td>
				</tr>
				<tr>
					<td align="left" class="cart-table-dark-bg"><?php echo tr('safe_mode') ?><div class="description"><?php echo tr('text_safe_mode_notice') ?></div></td>
					<td align="center" class="cart-table-dark-bg"><?php echo $safemode_value ?></td>
					<td align="center" class="cart-table-dark-bg"><b><?php echo "<div class=\"status-$safemode_status\">$safemode_status</div>"; ?></b></td>
				</tr>
				<tr>
					<td align="left"><?php echo tr('file_uploads') ?><div class="description"><?php echo tr('text_file_uploads_notice') ?></div></td>
					<td align="center"><?php echo $fileuploads_value ?></td>
					<td align="center"><b><?php echo "<div class=\"status-$fileuploads_status\">$fileuploads_status</div>"; ?></b></td>
				</tr>
				<tr>
					<td align="left" class="cart-table-dark-bg"><?php echo tr('curl_support') ?><div class="description"><?php echo tr('text_curl_support_notice') ?></div></td>
					<td align="center" class="cart-table-dark-bg"><?php echo $curl_value ?></td>
					<td align="center" class="cart-table-dark-bg"><b><?php echo "<div class=\"status-$curl_status\">$curl_status</div>"; ?></b></td>
				</tr>
				</table>
				</td>
				</tr>
				<tr>
				<td>
				<div class="box" style="margin-top: 20px;" align="left">
				<?php echo tr('text_permissions') ?>
				</div>
				</td>
				</tr>
				</table>

			<!--[Settings]-->
			<?php elseif ($mode == 'settings'): ?>
				<?php 
				fn_check_db_support();
				if (IS_MYSQL == true) {?>
				<input type="hidden" name="new_db_type" value="mysql" />
				<?php } elseif (IS_MYSQLI == true) {?>
				<input type="hidden" name="new_db_type" value="mysqli" />
				<?php }?>

				<table border="0" cellpadding="3" cellspacing="0">
				<tr>
					<td align="left" class="cart-table-dark-bg">&nbsp;<?php echo tr('server_host_name') ?></td>
					<td align="right" class="cart-table-dark-bg">&nbsp;http://</td>
					<td class="cart-table-dark-bg"><input type="text" class="input-text" size="35" name="new_http_host" value="<?php echo @$config['http_host'] ?>"></b></td>
				</tr>
				<tr>
					<td align="left">&nbsp;<?php echo tr('server_host_directory') ?></td>
					<td>&nbsp;</td>
					<td><input type="text" class="input-text" size="35" name="new_http_dir" value="<?php echo @$config['http_path'] ?>"></td>
				</tr>
				<tr>
					<td align="left" class="cart-table-dark-bg">&nbsp;<?php echo tr('secure_server_host_name') ?></td>
					<td align="right" class="cart-table-dark-bg">&nbsp;https://</td>
					<td class="cart-table-dark-bg"><input type="text" class="input-text" size="35" name="new_https_host" value="<?php echo @$config['https_host'] ?>"></td>
				</tr>		
				<tr>
					<td align="left">&nbsp;<?php echo tr('secure_server_host_directory') ?></td>
					<td>&nbsp;</td>
					<td><input type="text" class="input-text" size="35" name="new_https_dir" value="<?php echo @$config['https_path'] ?>"></td>
				</tr>
				<tr>
					<td colspan="3"><hr width="100%"></td>
				</tr>
				<tr>
					<td align="left" class="cart-table-dark-bg">&nbsp;<?php echo tr('db_server') ?></td>
					<td class="cart-table-dark-bg">&nbsp;</td>
					<td class="cart-table-dark-bg"><input type="text" class="input-text" size="35" name="new_db_host" value="<?php echo @$config['db_host'] ?>"></td>
				</tr>
				<tr>
					<td align="left">&nbsp;<?php echo tr('db_name') ?></td>
					<td>&nbsp;</td>
					<td><input type="text" class="input-text" size="35" name="new_db_name" value="<?php echo @$config['db_name'] ?>"></td>
				</tr>
				<tr>
					<td align="left" class="cart-table-dark-bg">&nbsp;<?php echo tr('db_user') ?></td>
					<td class="cart-table-dark-bg">&nbsp;</td>
					<td class="cart-table-dark-bg"><input type="text" class="input-text" size="35" name="new_db_user" value="<?php echo @$config['db_user'] ?>"></td>
				</tr>
				<tr>
					<td align="left">&nbsp;<?php echo tr('db_password') ?></td>
					<td>&nbsp;</td>
					<td><input type="text" size="35" class="input-text" name="new_db_password" value="<?php echo @$config['db_password'] ?>"></td>
				</tr>
				<tr>
					<td colspan="3"><hr width="100%" /></td>
				</tr>
				<tr>
					<td align="left" class="cart-table-dark-bg">&nbsp;<?php echo tr('secret_key') ?><br />&nbsp;<span class="description"><?php echo tr('text_secret_key_notice') ?></span></td>
					<td class="cart-table-dark-bg">&nbsp;</td>
					<td class="cart-table-dark-bg"><input type="text" class="input-text" size="35" name="new_crypt_key" value="<?php echo @$config['crypt_key'] ?>"></td>
				</tr>
				<tr>
					<td align="left">&nbsp;<?php echo tr('admin_email') ?><br />&nbsp;<span class="description"><?php echo tr('text_admin_email_notice') ?></span></td>
					<td>&nbsp;</td>
					<td><input type="text" class="input-text" size="35" name="new_admin_email" value="<?php echo @$admin_email ?>"></td>
				</tr>
				<tr>
					<td align="left">&nbsp;<?php echo tr('license_number') ?><br />&nbsp;<span class="description"><?php echo tr('text_license_number') ?></span></td>
					<td>&nbsp;</td>
					<td><input type="hidden" class="input-text" size="35" name="new_license_number" value="<?php echo @$license_number ?>"></td>
				</tr>

				<tr>
					<td colspan="3"><hr /></td>
				</tr>
				<tr>
					<td align="left" class="cart-table-dark-bg">&nbsp;<?php echo tr('additional_languages') ?></td>
					<td class="cart-table-dark-bg">&nbsp;</td>
					<td align="left" class="cart-table-dark-bg">
						<div style="font-size: 3px; line-height: 3px; height: 3px;">&nbsp;</div>
						<?php 
						$i = 0;
						foreach ($languages as $k => $v):
							$i++;
						?>
						<label style="width: 35px; padding: 0px;" for="id_<?php echo $k; ?>"><input type="checkbox" name="additional_languages[]" id="id_<?php echo $k; ?>" value="<?php echo $k; ?>"><?php echo $v; ?></label>&nbsp;&nbsp;&nbsp;
						<?php 
							if ($i % 3 == 0):
								?><div style="font-size: 3px; line-height: 3px; height: 3px;">&nbsp;</div><?php
							endif;
						endforeach; ?>
					</td>
				</tr>
				<tr>
					<td align="left">&nbsp;<?php echo tr('install_demo_data') ?><br />&nbsp;<span class="description"><?php echo tr('text_install_demo_data_notice') ?></td>
					<td>&nbsp;</td>
					<td align="left">
						<input type="checkbox" name="demo_catalog" value="Y" checked="checked" />
					</td>
				</tr>
				</table>

			<!--[Database]-->
			<?php elseif ($mode == 'database'): ?>
				<?php if ($can_continue == true): ?>
				<iframe src='index.php?mode=install_db<?php echo $adds?>' frameborder="0" width="100%" height="350"></iframe>
				<?php endif; ?>

			<!--[Outlook]-->
			<?php elseif ($mode == 'outlook'): ?>
				<?php echo tr('select_skin_to_install') ?><br />
				<select name="new_skin_name" onchange="document.getElementById('screenshot').src='<?php echo DIR_INSTALL_SKINS ?>/'+this.value+'/customer_screenshot.png'" style="margin-top: 6px;">
				<?php foreach($skinset as $skindir => $skinname): ?>
					<option value="<?php echo $skindir ?>" <?php if ($skindir == BASE_SKIN):?>selected="selected"<?php endif;?>><?php echo $skinname['description'] ?></option>
				<?php endforeach; ?>
				</select>
				<br /><br /><?php echo tr('skin_screenshot') ?>
				<div style="border: 1px solid #dadada; margin-top: 7px; width:500px"><img width="500" height="366" id="screenshot" src="<?php echo DIR_INSTALL_SKINS ?>/<?php echo BASE_SKIN?>/customer_screenshot.png"/></div>
			
			<!--[Skins]-->
			<?php elseif ($mode == 'skins'): ?>
				<?php if ($can_continue == true): ?>
				<iframe src="index.php?mode=install_skin&new_skin_name=<?php echo $new_skin_name; ?>" frameborder="0" width="100%" height="350"></iframe>
				<?php endif; ?>

			<!--[Certificate]-->
			<?php elseif ($mode == 'certificate'): ?>
				<div style="width:420px;" align="left">
				<?php echo tr('text_certificate_notice') ?>
				<p align="left">
				<p align="left"><?php echo tr('text_select_certificate') ?> <input id="cert_file" type="file" name="certificate_file" /></p>
				<p align="left"><?php echo tr('text_paste_content') ?></p>
				<p align="left"><textarea class="input-text" cols="80" rows="10" id="cert_text" name="certificate_text"></textarea></p>
				</div>

			<!--[Summary]-->
			<?php elseif ($mode == 'summary'): ?>
				<div style="width:420px;" align="left">
				
				<?php echo tr('text_summary_notice', $acode, "http://$config[http_host]$config[current_path]/$config[customer_index]", "http://$config[http_host]$config[current_path]/$config[customer_index]", "http://$config[http_host]$config[current_path]/$config[admin_index]", "http://$config[http_host]$config[current_path]/$config[admin_index]") ?>

				</div><br />

			<?php endif; ?>
			<!--[cpanel]-->
			<br />
			<table border="0" align="center">
			<tr>
				<td><input type="button" value="<?php echo tr('previous') ?>" onclick="history.go(-1);" class="install-button" <?php if ($mode == 'license'): ?>disabled="disabled"<?php endif; ?> /></td>
				<td>&nbsp;&nbsp;&nbsp;</td>
				<?php if ($mode != 'summary'): ?>
				<td><input id="nextbut" type="submit" value="<?php echo tr('next') ?>" <?php if (!$can_continue): ?>disabled="disabled"<?php endif; ?>  class="install-button" /></td>
				<?php endif; ?>
			</tr>
			</table>
			<!--[/cpanel]-->

			</div>
		</div>

	</td>
</tr>
</table>
</form>


<!--[/body]-->


<div class="bottom-search">
	<div class="bottom-copyright" style="padding-top: 3px;" align="center">&nbsp;<?php echo tr('text_copyright', date('Y', TIME)) ?>&nbsp;</div>
</div>

</div>
</div>
</body>
</html>
