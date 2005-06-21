<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"/>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php 
if(!defined('_SECURE_ACCESS')) {
	die('Zugriff verweigert.');	
}

$this->showHeader();

$collspan_offset = ( $this->countExtensions( 'right' ) + $this->countExtensions( 'user2' ) ) ? 2 : 1;
//script to determine which div setup for layout to use based on module configuration
$user1 = 0;
$user2 = 0;
$sandbox_area = 0;
// banner combos

//user1 combos
if ( $this->countExtensions( 'user1' ) + $this->countExtensions( 'user2' ) == 2) {
	$user1 = 2;
	$user2 = 2;
} elseif ( $this->countExtensions( 'user1' ) == 1 ) {
	$user1 = 1;
} elseif ( $this->countExtensions( 'user2' ) == 1 ) {
	$user2 = 1;
}

//right based combos
if ( $this->countExtensions( 'right' ) and ( empty( $_REQUEST['task'] ) || $_REQUEST['task'] != 'edit' ) ) {
	$sandbox_area = 2;
} else {
	$sandbox_area = 1;
	$user1 = $user1 == 1 ? 3 : 4;
	$user2 = $user2 == 1 ? 3 : 4;
}
 ?>
 <meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1"/>
<link href="<?php echo $this->site_path;?>/templates/default/css/template_css.css" rel="stylesheet" type="text/css"/>
 
</head>
<body>
<div align="center">
	<div id="main_outline">
		<div id="pathway_outline">
			<div id="pathway">
			
			</div>
		</div>
		<div id="header_area">
			<div id="header">
			<img src="<?php echo $this->site_path;?>/templates/default/images/title_back.png" width="500" height="100" alt="SolarFlare"/>
			</div>
			<div id="top_outline">
			<?php
			if ( $this->countExtensions( 'top' ) ) {
				$this->showExtensions ( 'top' );
			} else {
				?>
				<span class="error">Top Extension Empty</span>
				<?php
			}
			?>
			</div>
		</div>
		<div id="left_outline">
			<div id="left">
			<?php $this->showExtensions ( 'left' ); ?>
			</div>
		</div>
		<div id="content_area">
			<div id="content">
			<?php
			if ( $this->countExtensions ('banner') ) {
				?>
				<div id="banner_area">
					<div id="banner">
                <img src="<?php echo $this->site_path;?>/templates/default/images/advertisement.png" alt="advertisement.png, 0 kB" title="advertisement" border="0" height="8" width="468"/><br />
					<?php $this->showExtensions( 'banner' ); ?>
					</div>
					<div id="poweredby">
					<img src="<?php echo $this->site_path;?>/templates/default/images/powered_by.png" alt="powered_by.png, 1 kB" title="powered_by" border="0" height="68" width="165"/><br />
					</div>
				</div>
				<?php
			}
			if ( $this->countExtensions( 'right' ) and ( empty ($_REQUEST['task'] ) || $_REQUEST['task']!='edit' ) ) {
				?>
				<div id="right_outline">
					<div id="right">
					<?php $this->showExtensions ( 'right' ); ?>
					</div>
				</div>
				<?php
			}
			?>
			<div id="sandbox_area_<?php echo $sandbox_area ?>">
				<div class="sandbox_area">
					<?php
					if ( $this->countExtensions( 'user1' ) ) {
						?>
						<div id="user1_<?php echo $user1; ?>">
							<div class="user1_outline">
							<?php $this->showExtensions ( 'user1' ); ?>
							</div>
						</div>
						<?php
					}
					if ($this->countExtensions( 'user2' )) {
						?>
						<div id="user2_<?php echo $user2; ?>">
							<div class="user2_outline">
							<?php $this->showExtensions ( 'user2' ); ?>
							</div>
						</div>
						<?php
					}
					?>
					<div class="clr"></div>
					<div class="content_outline">
					<?php $this->showBody(); ?>
					</div>
					<div class="clr"></div>
				</div>
			</div>
		</div>
	</div>
	<div class="clr"></div>
	<div align="right">
	<a href="http://validator.w3.org/check?uri=referer"><img border="0" src="<?php echo $this->site_path;?>/templates/default/images/validcss.gif" alt="valid CSS"/></a> 
	<a href="http://validator.w3.org/check?uri=referer"><img border="0" src="<?php echo $this->site_path;?>/templates/default/images/validxhtml.gif" alt="valid XHTML"/></a></div>
	</div>
</div>
<div style="text-align: center; border: 1px solid #CCCCCC;"><b>Debug</b>: <br /><?php $this->showDebug(); ?>
</div>
</body>
</html>