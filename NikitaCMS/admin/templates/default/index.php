<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
<link href="<?php echo $this->site_path;?>/admin/templates/default/css/template_css.css" rel="stylesheet" type="text/css"/>
</head>
<body>
<div id="menu">
<?php
$this->showAdminMenu();
?>
</div>
<div id="content">
<?php
$this->showContent();
?>
</div>
<div style="clear: both;text-align: center; border: 1px solid #CCCCCC;"><b>Debug</b>: <br /><?php $this->showDebug(); ?>
</body>
</html>