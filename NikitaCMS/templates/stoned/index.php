<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
if(!defined('_SECURE_ACCESS')) {
	die('Zugriff verweigert.');	
}


$this->showHeader();
?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
<link href="<?php echo $this->site_path;?>/templates/stoned/css/template_css.css" rel="stylesheet" type="text/css"/>
 
</head>
<body>
<div class="wrapper">
	<div class="header">
		<img src="<?php echo $this->site_path;?>/templates/stoned/images/top.gif" alt="Logo">
	</div>
		<div class="left">
			<?php $this->showExtensions ( 'left' ); ?>
		</div>
		<div class="content">
			<?php $this->showBody(); ?>
		</div>
		<br style="clear: both;" />
</div>

<div class="debug"><b>Debug</b>: <br /><?php $this->showDebug(); ?>
</body>
</html>