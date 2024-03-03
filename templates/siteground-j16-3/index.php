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

$social_media = htmlspecialchars($tplparams->get('social_media'));
$social_media_title = htmlspecialchars($tplparams->get('social_media_title'));
$facebook = htmlspecialchars($tplparams->get('facebook'));
$twitter = htmlspecialchars($tplparams->get('twitter'));
$myspace = htmlspecialchars($tplparams->get('myspace'));
$linkedin = htmlspecialchars($tplparams->get('linkedin'));
$youtube = htmlspecialchars($tplparams->get('youtube'));
$vimeo = htmlspecialchars($tplparams->get('vimeo'));
$flickr = htmlspecialchars($tplparams->get('flickr'));
$digg = htmlspecialchars($tplparams->get('digg'));
$skype = htmlspecialchars($tplparams->get('skype'));
$amazon = htmlspecialchars($tplparams->get('amazon'));
$appstore = htmlspecialchars($tplparams->get('app-store'));
$delicious = htmlspecialchars($tplparams->get('delicious'));
$deviantart = htmlspecialchars($tplparams->get('deviant-art'));
$ebay = htmlspecialchars($tplparams->get('ebay'));
$icq = htmlspecialchars($tplparams->get('icq'));


$phone = htmlspecialchars($tplparams->get('phone'));
$email = htmlspecialchars($tplparams->get('email'));
$address = htmlspecialchars($tplparams->get('address'));

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->language; ?>" lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
<head>
	<!-- The following JDOC Head tag loads all the header and meta information from your site config and content. -->
	<jdoc:include type="head" />

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/favicon.ico" />
	<!-- The following line loads the template CSS file located in the template folder. -->
	<link rel="stylesheet" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/template.css" type="text/css" />
	
	<!-- The following line loads the template JavaScript file located in the template folder. It's blank by default. -->
	<script type="text/javascript" src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/js/CreateHTML5Elements.js"></script>
</head>
<body class="page_bg">

<div class="page">
	<div class="wrapper">
		<div class="logo">
			<h1><a href="<?php echo $this->baseurl ?>"><?php echo $app->getCfg('sitename'); ?></a></h1>
			
			<div class="custom-banner">
				<a href="#" title="banner"><img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/banner.gif" alt="banner"/></a>
			</div>
			
		</div>
		<div class="top">
			<jdoc:include type="modules" name="position-1" />
		</div>
		
	
		<div class="main">

			<?php if( $this->countModules('left') and ($this->countModules('right') || $social_media) ) : ?>
			<div class="maincol">			 	
			<?php elseif( !$this->countModules('left') and ($this->countModules('right') || $social_media) ) : ?>
			<div class="maincol_w_left">
			<?php elseif( $this->countModules('left') and (!$this->countModules('right') || !$social_media) ) : ?>
			<div class="maincol_w_right">
			<?php else: ?>
			<div class="maincol_full">
			<?php endif; ?>
				<div class="slide-images">
					<div class="b">
						<img src="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/slide-image-1.png" alt="" />
						
						<?php if ( $phone || $email || $address ) : ?>
							<div class="contact-widget">
								<?php if ( $phone ) : ?>
									<div class="icons icon1"><?php echo $phone; ?></div>
								<?php endif; ?>
								<?php if ( $email ) : ?>
								<div class="icons icon2"><?php echo $email; ?></div>
								<?php endif; ?>
								<?php if ( $address ) : ?>
								<div class="icons icon3"><?php echo $address; ?></div>
								<?php endif; ?>
							</div>
						<?php endif; ?>
					</div>
				</div>
				
				<?php if( $this->countModules('left') ) : ?>
				<div class="leftcol">
					<jdoc:include type="modules" name="left" style="rounded"/>

<div class="clear">&nbsp;</div>
<?php $sg = 'banner'; include "templates.php"; ?>
<div class="clear">&nbsp;</div>
				</div>

				<?php endif; ?>
				
					<div class="cont">
						<jdoc:include type="component" />
					</div>
				</div>

			<?php if( $this->countModules('right') || $social_media ) : ?>
			<div class="rightcol">
				<jdoc:include type="modules" name="right" style="rounded"/>
				
				<?php
				if ( $social_media ) : ?>
					<div class="module">
						<div>
							<div>
								<div>
									<?php if ( isset( $social_media_title ) && strlen( $social_media_title ) > 0 ) : ?>
										<h3 style="padding-bottom:0;"><?php echo $social_media_title; ?></h3>
									<?php endif; ?>
									
									<div class="social_media">
										<?php if ( isset( $facebook ) && strlen( $facebook ) > 0 ) : ?>
											<a href="http://www.facebook.com/<?php echo $facebook; ?>" class="facebook" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $twitter ) && strlen( $twitter ) > 0 ) : ?>
											<a href="http://www.twitter.com/<?php echo $twitter; ?>" class="twitter" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $myspace ) && strlen( $myspace ) > 0 ) : ?>
											<a href="http://www.myspace.com/<?php echo $myspace; ?>" class="myspace" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $linkedin ) && strlen( $linkedin ) > 0 ) : ?>
											<a href="http://www.linkedin.com/in/<?php echo $linkedin; ?>" class="linkedin" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $youtube ) && strlen( $youtube ) > 0 ) : ?>
											<a href="http://www.youtube.com/user/<?php echo $youtube; ?>" class="youtube" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $vimeo ) && strlen( $vimeo ) > 0 ) : ?>
											<a href="http://vimeo.com/<?php echo $vimeo; ?>" class="vimeo" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $flickr ) && strlen( $flickr ) > 0 ) : ?>
											<a href="http://www.flickr.com/photos/<?php echo $flickr; ?>" class="flickr" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $digg ) && strlen( $digg ) > 0 ) : ?>
											<a href="http://digg.com/<?php echo $digg; ?>" class="digg" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $skype ) && strlen( $skype ) > 0 ) : ?>
											<a href="skype:<?php echo $skype; ?>?chat" class="skype"></a>
										<?php endif; ?>
										<?php if ( isset( $deviantart ) && strlen( $deviantart ) > 0 ) : ?>
											<a href="http://<?php echo $deviantart; ?>.deviantart.com/" class="deviantart" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $ebay ) && strlen( $ebay ) > 0 ) : ?>											
											<a href="<?php echo $ebay; ?>" class="ebay" target="_blank"></a>
										<?php endif; ?>
										<?php if ( isset( $icq ) && strlen( $icq ) > 0 ) : ?>
											<a href="http://www.icq.com/people/<?php echo $icq; ?>/" class="icq" target="_blank"></a>
										<?php endif; ?>
									</div>
									
								</div>
							</div>
						</div>
					</div>
				<?php endif; ?>
				
			</div>
			<?php endif; ?>
		
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