<?php
//  @copyright	Copyright (C) 2008 - 2011 IceTheme. All Rights Reserved
//  @license	Copyrighted Commercial Software 
//  @author     IceTheme (icetheme.com)

// No direct access.
defined('_JEXEC') or die;

// Add CSS
$doc =&JFactory::getDocument();
$doc->addStyleSheet($this->baseurl. '/templates/system/css/system.css');
$doc->addStyleSheet($this->baseurl. '/templates/system/css/general.css');
$doc->addStyleSheet($this->baseurl. '/templates/' .$this->template. '/css/reset.css');
$doc->addStyleSheet($this->baseurl. '/templates/' .$this->template. '/css/typography.css');
$doc->addStyleSheet($this->baseurl. '/templates/' .$this->template. '/css/forms.css');
$doc->addStyleSheet($this->baseurl. '/templates/' .$this->template. '/css/modules.css');
$doc->addStyleSheet($this->baseurl. '/templates/' .$this->template. '/css/joomla.css');
$doc->addStyleSheet($this->baseurl. '/templates/' .$this->template. '/css/layout.css');
?>


<style type="text/css" media="screen">


<?php if ($this->countModules('left')) { ?>
/* Left Columns Parameters */
#outer-column-container { border-left-width:<?php echo $layout_leftcol_width ?>px; 	}
#left-column { margin-left: -<?php echo $layout_leftcol_width ?>px; width: <?php echo $layout_leftcol_width ?>px;}
#middle-column .inside { padding-left:15px; }
#inner-column-container { border-left-color:#e3eff1 } 		
<?php } ?>	


<?php if ($this->countModules('right')) { ?>
/* Right Column Parameters */
#outer-column-container { border-right-width:<?php echo $layout_rightcol_width ?>px;	}
#right-column { margin-right: -<?php echo $layout_rightcol_width ?>px; width: <?php echo $layout_rightcol_width ?>px;}
#middle-column .inside { padding-right:15px; } 
#inner-column-container { border-right-color:#e3eff1 } 
<?php } ?>	


<?php if (!$this->countModules('footer1 + footer2 + footer3 + footer4')) { ?>
div#copyright {
	border:none;}
<?php } ?>

</style>	


<!-- Google Fonts -->
<link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />


<!--[if lte IE 8]>
<link rel="stylesheet" type="text/css" href="<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/css/ie.css" />
<![endif]-->

<!--[if lte IE 9]>
<style type="text/css" media="screen">
#left-column  .col-module h3.mod-title span:after {
	border-width: 0.82em;
</style>	
<![endif]-->
