<?php
$pluginInfo = osc_plugin_get_info('meta_edit/index.php');

   $keywordsEnabled            = '';
   $dao_preference = new Preference();
   if(Params::getParam('keywordsEnabled') != '') {
        $keywordsEnabled = Params::getParam('keywordsEnabled');
   } else {
        $keywordsEnabled = (osc_get_preference('metaEdit_keywords_enabled', 'plugin-meta_edit') != '') ? osc_get_preference('metaEdit_keywords_enabled', 'plugin-meta_edit') : '' ;
   }
   $keywords            = '';
   $dao_preference = new Preference();
   if(Params::getParam('keywords') != '') {
        $keywords = Params::getParam('keywords');
   } else {
        $keywords = (osc_get_preference('metaEdit_keywords', 'plugin-meta_edit') != '') ? osc_get_preference('metaEdit_keywords', 'plugin-meta_edit') : '' ;
   } 
   $showCity            = '';
   $dao_preference = new Preference();
   if(Params::getParam('showCity') != '') {
        $showCity = Params::getParam('showCity');
   } else {
        $showCity = (osc_get_preference('metaEdit_show_city', 'plugin-meta_edit') != '') ? osc_get_preference('metaEdit_show_city', 'plugin-meta_edit') : '' ;
   }
   $showTitleF            = '';
   $dao_preference = new Preference();
   if(Params::getParam('showTitleF') != '') {
        $showTitleF = Params::getParam('showTitleF');
   } else {
        $showTitleF = (osc_get_preference('metaEdit_title_first', 'plugin-meta_edit') != '') ? osc_get_preference('metaEdit_title_first', 'plugin-meta_edit') : '' ;
   }	
	if(Params::getParam('plugin_action')=='done') {
      	$dao_preference->update(array("s_value" => $keywordsEnabled), array("s_section" => "plugin-meta_edit", "s_name" => "metaEdit_keywords_enabled")) ;
        $dao_preference->update(array("s_value" => $keywords), array("s_section" => "plugin-meta_edit", "s_name" => "metaEdit_keywords")) ;         
        $dao_preference->update(array("s_value" => $showCity), array("s_section" => "plugin-meta_edit", "s_name" => "metaEdit_show_city")) ;         
        $dao_preference->update(array("s_value" => $showTitleF), array("s_section" => "plugin-meta_edit", "s_name" => "metaEdit_title_first")) ;         
        osc_reset_preferences();
    
	      osc_add_flash_ok_message(__('Settings Saved','meta_edit'), 'admin') ;
    }
    unset($dao_preference) ;
?>

<div id="settings_form" style="border: 1px solid #ccc; background: #eee;  ">
    <div style="padding: 10px;">
        <h2> <?php echo _e('Meta Options', 'meta_edit'); ?> </h2> 
       		<div style="width: 100%;">
                                    
                <form name="promo_form" id="promo_form" action="<?php echo osc_admin_base_url(true); ?>" method="POST" enctype="multipart/form-data" >
                    <input type="hidden" name="page" value="plugins" />
                    <input type="hidden" name="action" value="renderplugin" />
                    <input type="hidden" name="file" value="<?php echo osc_plugin_folder(__FILE__); ?>config.php" />
                    <input type="hidden" name="plugin_action" value="done" />
                       <br />
                       <fieldset style=" border: 1px solid #BBBBBB; border-radius: 5px 5px 5px 5px; margin: 10px; margin: 10px; padding: 5px;">
						   <legend><?php _e('Meta Keyword Settings','meta_edit'); ?></legend>
	                       <label for="keywordsEnabled" style="font-weight: bold;"><?php _e("Use the custom keywords defined below?", 'meta_edit'); ?></label>:<br />
						        <select name="keywordsEnabled" id="keywordsEnabled"> 
						        	<option <?php if($keywordsEnabled == 1){echo 'selected="selected"';}?>value='1'><?php _e('Yes','meta_edit'); ?></option>
						        	<option <?php if($keywordsEnabled == 0){echo 'selected="selected"';}?>value='0'><?php _e('No','meta_edit'); ?></option>
						        </select>
	                       <br /> 
	                       <br />
	                       <label for="keywords" style="font-weight: bold;"><?php _e('Keywords: (Seperate keywords with a comma)', 'meta_edit'); ?></label><br />
						   <input type="text" style="width:800px;" id="keywords" name="keywords" value="<?php echo $keywords; ?>" />
					   </fieldset>				       
					   <br />
					   <br />  
					   <label for="showCity" style="font-weight: bold;"><?php _e("Show the city in the title of items?", 'meta_edit'); ?></label>:<br />
						        <select name="showCity" id="showCity"> 
						        	<option <?php if($showCity == 1){echo 'selected="selected"';}?>value='1'><?php _e('Yes','meta_edit'); ?></option>
						        	<option <?php if($showCity == 0){echo 'selected="selected"';}?>value='0'><?php _e('No','meta_edit'); ?></option>
						        </select>
                       <br /> 
                       <br />   
                       <label for="showTitleF" style="font-weight: bold;"><?php _e("Show the sites name first in the title?", 'meta_edit'); ?></label>:<br />
						        <select name="showTitleF" id="showTitleF"> 
						        	<option <?php if($showTitleF == 1){echo 'selected="selected"';}?>value='1'><?php _e('Yes','meta_edit'); ?></option>
						        	<option <?php if($showTitleF == 0){echo 'selected="selected"';}?>value='0'><?php _e('No','meta_edit'); ?></option>
						        </select>
                       <br /> 
                       <br />                                
                     
                    <button name="theButton" id="theButton" type="submit" style="float: left;"><?php _e('Update', 'meta_edit');?></button>
                </form>
                <br />
                <br />
       		<?php echo $pluginInfo['plugin_name'] . ' | ' . __('Version','meta_edit') . ' ' . $pluginInfo['version'] . ' | ' . __('Author','meta_edit') . ' ' . $pluginInfo['author']; ?>             
        </div>
    </div>
</div>
