<?if( $sg == 'banner' ):?>
	<?php $menu = &JSite::getMenu();
	if ($menu->getActive() == $menu->getDefault()) :?>
	<!-- SIDE BEGIN --><div style="margin:50px 0 0 30px;background: url(<?php echo $this->baseurl ?>/templates/<?php echo $this->template ?>/images/1hbackground.png) top left no-repeat; height:33px; width:146px;padding-left:40px; )"><p style="font-size:8pt;;margin:0;padding:2px 0 0 0;text-align:justify; color: #767676; line-height: 13px;">Uptime guaranteed by<br/> 1H <a style="color:#767676;text-decoration:none;" title="Server Monitoring" href="http://www.1h.com/products/guardian/" target="_blank">server monitoring</a></p></div><!-- SIDE END -->
	<?php endif?>
<?else:?>
 	<?php echo $app->getCfg('sitename'); ?>, Powered by <a href="http://joomla.org/" class="sgfooter" target="_blank">Joomla!</a>
	
	<?php $menu = &JSite::getMenu();
	if ($menu->getActive() == $menu->getDefault()) :?>
		<!-- FOOTER BEGIN --><a href="http://www.siteground.com/joomla-hosting.htm" target="_blank">Joomla hosting by SiteGround</a><!-- FOOTER END -->
	<?php endif ?>
	
<?endif;?>
