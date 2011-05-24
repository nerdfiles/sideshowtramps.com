<?php
/**
 * Header Template
 *
 * The header template is generally used on every page of your site. Nearly all other
 * templates call it somewhere near the top of the file. It is used mostly as an opening
 * wrapper, which is closed with the footer.php file. It also executes key functions needed
 * by the theme, child themes, and plugins. 
 *
 * @package Hybrid
 * @subpackage Template
 */

//hybrid_doctype(); ?>
<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8" />
<title><?php hybrid_document_title(); ?></title>

<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/reset.css" media="screen" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/style.css" media="screen" />
<link rel="stylesheet" href="<?php echo get_stylesheet_directory_uri(); ?>/layer-behavior/sb/shadowbox.css" />

<?php hybrid_head(); // Hybrid head hook ?>
<?php wp_head(); // WP head hook ?>

</head>

<body class="<?php hybrid_body_class(); body_class_page_name(true); ?>">

<?php 
//$stylesheet_dir = get_stylesheet_directory_uri();
//if (is_page('landing-page')) : ?>
<!--div id="page-bg-frame"><img id="bg-image" src="<?php //echo $stylesheet_dir; ?>/images/landing-page-bg.jpg" alt="" /></div-->
<?php //endif; ?>

<!--div id="page-content-frame"-->

<?php hybrid_before_html(); // Before HTML hook ?>

<div id="body-container"><div id="body-container-inner">

	<?php hybrid_before_header(); // Before header hook ?>
	
	<div id="header-container" class="clear-hack">

		<div id="header">
			
			<?php hybrid_header(); // Header hook ?>
			
			<div class="fanbridge-object">
				<table cellspacing="0" cellpadding="0" border="0" style="border-collapse: collapse;">
					<tbody>
						<tr>
							<td style="vertical-align: middle; background: #000;">
								<img width="164" src="http://img01.fanbridge.com/images/widget/small/jointhemailingist_black.png">
							</td>
							<td style="font: 1em Arial, sans-serif; background: #000;">
								<div style="width: 220px; padding: 6px; letter-spacing: 1px; background: #000;"><span style="color: #c30000;">Free downloads</span> &amp; updates!</div>
							</td>
							<td style="vertical-align: middle;">
								<object height="32" width="200" align="middle" id="WidgetMailBlack" codebase="http://fpdownload.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=9,0,0,0" classid="clsid:d27cdb6e-ae6d-11cf-96b8-444553540000">
								<param value="sameDomain" name="allowScriptAccess">
								<param value="http://widget.fanbridge.com/widget_small_black.swf" name="movie">
								<param value="high" name="quality">
								<param value="#333333" name="bgcolor">
								<param value="wid=small-4b315169b1cc9-sb&amp;list_id=128532" name="flashvars"><embed height="32" width="200" align="middle" pluginspage="http://www.macromedia.com/go/getflashplayer" type="application/x-shockwave-flash" allowscriptaccess="sameDomain" swliveconnect="true" name="WidgetMailBlack" bgcolor="#333333" quality="high" flashvars="wid=small-4b315169b1cc9-sb&amp;list_id=128532" src="http://widget.fanbridge.com/widget_small_black.swf"><a href="http://widget.fanbridge.com/widget_small_black.swf" class="vzbtnvfppcxpuegnsrtl tzcqylewfdxirjemjgxp" title="Click here to block this object with Adblock Plus" style="left: 1083.03px ! important; top: 37px ! important;"></a><a href="http://widget.fanbridge.com/widget_small_black.swf" class="vzbtnvfppcxpuegnsrtl"></a>
								</object>
							</td>
							<!--td style="vertical-align: middle;">
								<a target="_blank" href="http://www.fanbridge.com/b.php?id=128532&amp;loc=learn/"><img height="15" width="200" border="0" src="http://img01.fanbridge.com/images/widget/small/poweredbyFB_black.png"></a>
							</td-->
						</tr>
					</tbody>
				</table>
			</div>
			
			<?php custom_page_nav(); ?>

		</div><!-- #header -->

	</div><!-- #header-container -->

	<?php hybrid_after_header(); // After header hook ?>

	<div id="container" class="<?php if (is_front_page()) { echo ""; } ?>">

		<?php hybrid_before_container(); // Before container hook ?>

		
