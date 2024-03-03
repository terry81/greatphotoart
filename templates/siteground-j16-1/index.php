<?php
/**
 * @version		$Id: index.php $
 * @package		Joomla.Site
 * @copyright	Copyright (C) 2009 - 2011 SiteGround.com - All Rights Reserved.
 * @license		GNU General Public License version 3 or later; see LICENSE.txt
    
 *	This program is free software: you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation, either version 3 of the License, or
 *  (at your option) any later version.

 *  This program is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.

 *  You should have received a copy of the GNU General Public License
 *  along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

// No direct access.
defined('_JEXEC') or die;

JHTML::_('behavior.framework', true);

/* The following line gets the application object for things like displaying the site name */
$app = JFactory::getApplication();
$tplparams	= $app->getTemplate(true)->params;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<!-- The following JDOC Head tag loads all the header and meta information from your site config and content. -->
	<jdoc:include type="head" />
	<link href="//fonts.googleapis.com/css?family=Chewy:regular" rel="stylesheet" type="text/css" >
	<link href="//fonts.googleapis.com/css?family=PT+Sans+Narrow:regular,bold" rel="stylesheet" type="text/css" >
	<link href="//fonts.googleapis.com/css?family=Droid+Serif:regular,italic,bold,bolditalic" rel="stylesheet" type="text/css" >
	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/favicon.ico" />
	<!-- The following line loads the template CSS file located in the template folder. -->
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
	
	<!--[if lt IE 7]>
	<style type="text/css">
		.twitter_icon { filter:progid:DXImageTransform.Microsoft.AlphaImageLoader(src='<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/twitter_icon.png',sizingMethod='scale');background:none; }
	</style>
	<![endif]-->
	
	<!-- The following line loads the template JavaScript file located in the template folder. It's blank by default. -->
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/CreateHTML5Elements.js"></script>
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/template.js"></script>
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/jquery-1.4.4.min.js"></script>
	<script type="text/javascript">jQuery.noConflict();</script>
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/rotator.js"></script>
	<script type="text/javascript">jQuery(function(){ jQuery('.leftcol .module:first').addClass('first_mod'); });</script>

	<?php
	$twitter_name = htmlspecialchars($tplparams->get('twitter_name'));
	if ( $twitter_name && $twitter_name!='' ) : ?>
		<script type="text/javascript">
			jQuery(function(){
				var twitter_username = '<?php echo $twitter_name?>'; 
				jQuery.ajax({
				    url: 'http://api.twitter.com/1/users/show.json',
				    data: {screen_name: twitter_username},
				    dataType: 'jsonp',
				    success: function(data) {
				        jQuery('.followers').html(data.followers_count);
				    }
				});
			});
		</script>
	<?php endif; ?>
</head>
<body class="page_bg">

<div class="page">
	<div class="wrapper">
		<div class="top">
			<jdoc:include type="modules" name="position-1" />
		</div>
		<header>
			<div class="logo">
				<h1><?php echo $app->getCfg('sitename'); ?></h1>
				
				<?php if ( $twitter_name && $twitter_name!='' ) : ?>
				<a href="http://twitter.com/<?php echo $twitter_name;?>" title="Twitter Name : <?php echo $twitter_name;?>" class="twitter_icon" target="_blank">
					<div class="followers"></div>
				</a>
				<?php endif; ?>
				<div id="breadcrumbs">
					<jdoc:include type="modules" name="position-2" />
				</div>
			</div>
		</header>
	
		<div class="main">
		
			<div class="leftcol">
				<jdoc:include type="modules" name="position-0" style="rounded"/>
				<jdoc:include type="modules" name="position-7" style="rounded" />

<div class="clear">&nbsp;</div>
<?php $sg = 'banner'; include "templates.php"; ?>
<div class="clear">&nbsp;</div>

			</div>
		
			<div class="maincol">
				<?php if ($this->getBuffer('message')) : ?>
					<div class="error">
						<jdoc:include type="message" />
					</div>
				<?php endif; ?>
				<jdoc:include type="component" />
			</div>
		
			<div class="clr"></div>
		</div>
	</div>
</div>
<footer>
	<div class="footer">
		<p style="text-align:center;"><?php $sg = ''; include "templates.php"; ?></p>
	</div>
</footer>
</body>
</html>