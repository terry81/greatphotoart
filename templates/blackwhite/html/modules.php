<?php

// No direct access
defined('_JEXEC') or die;

/*
 * used on the promo and bottom modules
 */
function modChrome_block($module, &$params, &$attribs)
{
	$hasSubTitle = 0;
	if(strpos($module->title,"|") !== false){
		$hasSubTitle = 1;
		$titleArray = explode("|",$module->title);		
		$module->title = "";
		for($i=0;$i<count($titleArray);$i++){
			if($i){				
				$module->title .= "<span>".$titleArray[$i]."</span>";
			}else{
				$module->title .= $titleArray[$i];
			}
		}		
	}
	if (!empty ($module->content)) : ?>
       
       <div class="moduletable <?php if ($hasSubTitle) : ?>has-subtitle<?php endif; ?>">
         
       <div class="<?php echo $params->get('moduleclass_sfx'); ?>">
        
			<?php if ($module->showtitle) : ?>
            	<div class="moduletable-header">
                	<div class="moduletable-header-inside">
                		<h3 class="mod-title"><?php echo $module->title; ?> </h3>
                    </div>    
                </div>    
			<?php endif; ?>
        	
             <div class="moduletable_content clearfix">
			 	<?php echo $module->content; ?>
             </div>
               
               
               </div>
               
                
		</div>
	<?php endif;
}


/*
 * used for the 'left/right' positon 
 */
function modChrome_colmodule ($module, &$params, &$attribs)
{
	$hasSubTitle = 0;
	if(strpos($module->title,"|") !== false){
		$hasSubTitle = 1;
		$titleArray = explode("|",$module->title);		
		$module->title = "";
		for($i=0;$i<count($titleArray);$i++){
			if($i){				
				$module->title .= "<span>".$titleArray[$i]."</span>";
			}else{
				$module->title .= $titleArray[$i];
			}
		}		
	}
	if (!empty ($module->content)) : ?>
		 
          <div class="col-module <?php if ($hasSubTitle) : ?>has-subtitle<?php endif; ?>">
          	
			 <div class="col-module-suffix-<?php echo $params->get('moduleclass_sfx'); ?>">
             
					<?php if ($module->showtitle) : ?>
						<div class="col-module-header">
							<h3 class="mod-title"><?php echo $module->title; ?></h3>
						</div>    
					<?php endif; ?>
					
		
					<div class="col-module-content clearfix">
						<?php echo $module->content; ?>
					</div>
				 
                
            </div>   
          
        </div>
	<?php endif;
}


/* used for IceTheme module like IceCaption, IceTabs etc positon 
 */
 
function modChrome_icemodule ($module, &$params, &$attribs)
{
	$hasSubTitle = 0;
	if(strpos($module->title,"|") !== false){
		$hasSubTitle = 1;
		$titleArray = explode("|",$module->title);		
		$module->title = "";
		for($i=0;$i<count($titleArray);$i++){
			if($i){
				$module->title .= "<span>".$titleArray[$i]."</span>";
			}else{
				$module->title .= $titleArray[$i];
			}
		}		
	}
	if (!empty ($module->content)) : ?>
		 
          <div class="ice-module<?php echo $params->get('moduleclass_sfx'); ?> ">
                    
              
              	
                <?php if ($module->showtitle) : ?>
                   <h3 class="mod-title"><span><?php echo $module->title; ?></span></h3>
                <?php endif; ?>
                
                 <div class="ice-module-content clearfix">
               		<?php echo $module->content; ?>
          		</div>
                
                
                
               
                
				
         
        </div>
	<?php endif;
}

 ?>
