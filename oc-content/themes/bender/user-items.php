<?php
    /*
     *      Osclass – software for creating and publishing online classified
     *                           advertising platforms
     *
     *                        Copyright (C) 2013 OSCLASS
     *
     *       This program is free software: you can redistribute it and/or
     *     modify it under the terms of the GNU Affero General Public License
     *     as published by the Free Software Foundation, either version 3 of
     *            the License, or (at your option) any later version.
     *
     *     This program is distributed in the hope that it will be useful, but
     *         WITHOUT ANY WARRANTY; without even the implied warranty of
     *        MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
     *             GNU Affero General Public License for more details.
     *
     *      You should have received a copy of the GNU Affero General Public
     * License along with this program.  If not, see <http://www.gnu.org/licenses/>.
     */

    // meta tag robots
    osc_add_hook('header','bender_nofollow_construct');

    bender_add_body_class('user user-items');
    osc_add_hook('before-main','sidebar');
    function sidebar(){
        osc_current_web_theme_path('user-sidebar.php');
    }
    osc_current_web_theme_path('header.php') ;

    osc_add_filter('meta_title_filter','custom_meta_title');
    function custom_meta_title($data){
        return __('Alerts', 'bender');;
    }
	$osc_user = osc_user();
	
	
?>
<script type="text/javascript" >
$(document).ready(function(){
$( ".account_box ul li a" ).click(function() {
  $( ".wishlist" ).slideUp( "slow" );
  $( this ).siblings( "div.wishlist" ).slideToggle( "slow", function() {
    // Animation complete.
  });
});
});
</script>
    <?php osc_run_hook('search_ads_listing_top'); ?>
<section class="wrapper result_outer account_outer">
    
<section class="account_box">
    	<h1 class="result"><?php _e('My Account', 'bender') ; ?></h1>
        <ul>
        	<li>
                <a href="#"><img class="icon" alt="" src="<?php echo osc_current_web_theme_url('images/listing_icon.png')?>">
			    <h2>Listings<span>Your Selected Listings</span></h2> 
				<img class="plus" alt="" src="<?php echo osc_current_web_theme_url('images/plus_dropdown.png')?>"></a>
                <div class="wishlist" style="display: none;">
                	<h1><?php _e('My Listings', 'bender') ; ?></h1>
					 <?php if(osc_count_items() == 0) { ?>
                    <p>No listings have been added yet</p>
					<?php } else {
					while(osc_has_items()) {
					 $search_number = bender_search_number();
					 
				echo '<p>';
                printf(__('%1$d to %2$d of <span> %3$d </span> listings', 'bender'), $search_number['from'], $search_number['to'], $search_number['of']);
				echo '</p>';
					?>
					
                    <article class="list_result">
            	<figure>
                		    <?php if( osc_images_enabled_at_items() ) { ?>
        <?php if(osc_count_item_resources()) { ?>
		 <a  href="<?php echo osc_item_url() ; ?>" title="<?php echo osc_item_title() ; ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_item_title() ; ?>" width="108" height="97"></a>
        <?php } else { ?>
           <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_item_title() ; ?>" width="108" height="97">
        <?php } ?>
    <?php } ?>
                      <?php bender_draw_dropdown(); ?>
                        
                </figure>
                <div class="list_textbox">
                		<h1><?php echo osc_item_title() ; ?>(<?php echo osc_item_category() ; ?>)</h1>
                        <h3><?php echo osc_item_city(); //osc_item()['s_city'];?> - (<?php echo osc_item_region(); ?>) - <?php echo osc_format_date(osc_item_pub_date()); ?>.</h3>
                        <p><?php echo osc_highlight( strip_tags( osc_item_description()) ,250) ; ?></p>
                </div>
                <div class="clear"></div>
        
					<div class="clear"></div>
					<?php if($admin){ ?>
                    <span class="admin-options">
                        <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', 'bender'); ?></a>
                        <span>|</span>
                        <a class="delete" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', 'bender')); ?>')" href="<?php echo osc_item_delete_url();?>" ><?php _e('Delete', 'bender'); ?></a>
                        <?php if(osc_item_is_inactive()) {?>
                        <span>|</span>
                        <a href="<?php echo osc_item_activate_url();?>" ><?php _e('Activate', 'bender'); ?></a>
                        <?php } ?>
                    </span>
                <?php } ?>

    </article>
      		<?php }
			}?>
                </div>
            </li>
			
            <li>
            	<a href="#"><img class="icon" alt="" src="<?php echo osc_current_web_theme_url('images/alert.png')?>">
				<h2>Alert<span>Your Important Alerts</span></h2> 
				<img class="plus" alt="" src="<?php echo osc_current_web_theme_url('images/plus_dropdown.png')?>"></a>
                 <div class="wishlist" style="display: none;">
                	<h1><?php _e('Alerts', 'bender') ; ?></h1>
					<?php if(osc_count_alerts() <= 0) { ?>
                    <p>You do not have any alerts yet.</p>
					<?php } else { ?>
					    <?php
    $i = 1;
    while(osc_has_alerts()) { ?>
        <div class="userItem" >
            <div class="title-has-actions">
                <h3><?php _e('Alert', 'bender'); ?> <?php echo $i; ?></h3> <a onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can\'t be undone. Are you sure you want to continue?', 'benderw')); ?>');" href="<?php echo osc_user_unsubscribe_alert_url(); ?>"><?php _e('Delete this alert', 'bender'); ?></a><div class="clear"></div></div>
            <div>
            <?php while(osc_has_items()) {
                bender_draw_item();
            } ?>
            <?php if(osc_count_items() == 0) { ?>
                    <br />
                    0 <?php _e('Listings', 'bender'); ?>
            <?php } ?>
            </div>
        </div>
        <br />
    <?php
    $i++;
    }
    ?>
					<?php }?>
                </div>
            </li>
            <li>
			<?php 
			 $recipPMs = ModelPM::newInstance()->getRecipientMessages(osc_logged_user_id(), 1, 0, 'pm_id', 'DESC');
             $recipCount = count($recipPMs);
			?>
            	<a href="#"><img class="icon" alt="" src="<?php echo osc_current_web_theme_url('images/inbox.png')?>">
				<h2>Inbox (<?php echo $recipCount;?>)<span>Your Incoming Messages</span></h2> 
				<img class="plus" alt="" src="<?php echo osc_current_web_theme_url('images/plus_dropdown.png')?>"></a>
                <div class="wishlist inbox" style="display: none;">
                	<table cellspacing="0" cellpadding="0">
                    	<tbody><tr>
                        	<th><input type="checkbox"></th>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>From</th>
                        </tr>
						 <?php if($recipCount == 0) { ?>
                  <tr class="odd">
                     <td></td>
                     <td></td>
                     <td><?php _e('You have no messages', 'osclass_pm'); ?></td>
                     <td></td>
                  </tr>
                  <?php }else{ 
				  foreach($recipPMs as $recipPM){ ?>
                        <tr>
                        	<td><input type="checkbox"></td>
                            <td><?php echo osc_format_date($recipPM['message_date']) . ', ' . osclass_pm_format_time($recipPM['message_date']); ?></td>
                            <td><a class="mesLink" href="<?php echo osc_render_file_url(osc_plugin_folder(__FILE__) . 'user-messages.php?message=' . $recipPM['pm_id'] . '&box=inbox'); ?>"><?php echo $recipPM['pm_subject']; ?></a></td>
                            <td><?php echo $user['s_name']; ?></td>
                        </tr>
					<?php }
					} ?>
                    </tbody></table>
                    <input type="button" onclick="if (!confirm('<?php _e('Are you sure you want to delete all selected personal messages?','osclass_pm'); ?>')) return false;" class="delete apply pmDeleteButton" value="Delete Selected">
					<button class="admin subscribe"> <a href="<?php echo osc_base_url(true) . '?page=custom&file=osclass_pm/user-send.php&userId=0&mType=new';?>"><?php echo __('Send PM to the admin','osclass_pm') . ' ' . pmAdmin(); ?></a></button>
                </div>
            </li>
            <li>
            	<a href="#"><img class="icon" alt="" src="<?php echo osc_current_web_theme_url('images/outbox.png')?>"><h2>Outbox<span>Your Outgoing Messages</span></h2> <img class="plus" alt="" src="<?php echo osc_current_web_theme_url('images/plus_dropdown.png')?>"></a>
                <div class="wishlist inbox" style="display: none;">
                	<table cellspacing="0" cellpadding="0">
                    	<tbody><tr>
                        	<th><input type="checkbox"></th>
                            <th>Date</th>
                            <th>Subject</th>
                            <th>Sent To</th>
                        </tr>
						<?php $recipPMs = ModelPM::newInstance()->getSenderMessages(osc_logged_user_id(), 1, 'pm_id', 'DESC');
                        $recipCount = count($recipPMs);
                        if($recipCount == 0) {?>
						<tr class="odd">
                     <td></td>
                     <td></td>
                     <td><?php _e('You have no messages', 'osclass_pm'); ?></td>
                     <td></td>
                  </tr>
				  <?php }else{ ?>
                        <tr>
                        	<td><input type="checkbox"></td>
                            <td><?php echo osc_format_date($recipPM['message_date']) . ', ' . osclass_pm_format_time($recipPM['message_date']); ?></td>
                            <td><a class="mesLink" href="<?php echo osc_render_file_url(osc_plugin_folder(__FILE__) . 'user-messages.php?message=' . $recipPM['pm_id'] . '&box=outbox'); ?>"><?php echo $recipPM['pm_subject']; ?></a></td>
                            <td><?php echo $user['s_name']; ?></td>
                        </tr>
						<?php } ?>
                    </tbody></table>
                    <input type="button" onclick="if (!confirm('<?php _e('Are you sure you want to delete all selected personal messages?','osclass_pm'); ?>')) return false;" class="delete apply" value="Delete Selected">
                
                </div>
            </li>
            <li>
			<?php 
$i_userId = osc_logged_user_id();
	if(Params::getParam('delete') != '' && osc_is_web_user_logged_in()){
		delete_item(Params::getParam('delete'), $i_userId);
	}

    $itemsPerPage = (Params::getParam('itemsPerPage') != '') ? Params::getParam('itemsPerPage') : 5;
    $iPage        = (Params::getParam('iPage') != '') ? Params::getParam('iPage') : 0;

    Search::newInstance()->addConditions(sprintf("%st_item_watchlist.fk_i_user_id = %d", DB_TABLE_PREFIX, $i_userId));
    Search::newInstance()->addConditions(sprintf("%st_item_watchlist.fk_i_item_id = %st_item.pk_i_id", DB_TABLE_PREFIX, DB_TABLE_PREFIX));
    Search::newInstance()->addTable(sprintf("%st_item_watchlist", DB_TABLE_PREFIX));
    Search::newInstance()->page($iPage, $itemsPerPage);

    $aItems      = Search::newInstance()->doSearch();
    $iTotalItems = Search::newInstance()->count();
    $iNumPages   = ceil($iTotalItems / $itemsPerPage) ;

    View::newInstance()->_exportVariableToView('items', $aItems);
    View::newInstance()->_exportVariableToView('search_total_pages', $iNumPages);
    View::newInstance()->_exportVariableToView('search_page', $iPage) ;

	// delete item from watchlist
	function delete_item($item, $uid){
		$conn = getConnection();
		$conn->osc_dbExec("DELETE FROM %st_item_watchlist WHERE fk_i_item_id = %d AND fk_i_user_id = %d LIMIT 1", DB_TABLE_PREFIX , $item, $uid);
	}
        
?>
            	<a href="#"><img class="icon" alt="" src="<?php echo osc_current_web_theme_url('images/wishlist.png')?>">
				<h2>Watchlist<span>Your Selected Watchlist</span></h2> 
				<img class="plus" alt="" src="<?php echo osc_current_web_theme_url('images/plus_dropdown.png')?>"></a>
                
                <div class="wishlist" style="display: none;">
				<?php if (osc_count_items() == 0) { ?>
        <h3><?php _e('You don\'t have any items yet', 'watchlist'); ?></h3>
        <?php } else { ?>
		<h3><?php printf(_n('You are watching %d item', 'You are watching %d items', $iTotalItems, 'watchlist'), $iTotalItems) ; ?></h3>
		<?php while ( osc_has_items() ) { ?>
                	<article class="list_result">
            	<figure>
				      <?php if (osc_images_enabled_at_items()) { ?>
					   <?php if (osc_count_item_resources()) { ?>
                                <a href="<?php echo osc_item_url(); ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" width="75px" height="56px" title="" alt="" /></a>
                            <?php } else { ?>
                                <img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="" />
                            <?php } ?>
						<?php }?>
                        <a class="rate" href="#"><?php if (osc_price_enabled_at_items()) { echo osc_item_formated_price(); ?> - <?php }?></a>
                       <!-- <a class="other" href="#">Other currencies
                            	<ul>
                                	<li>378 EUR</li>
                                	<li>320 GBP</li>
                                	<li>4231 UAH</li>
                                	<li>516 USD</li>
                                </ul>
                       </a>-->
                        
                </figure>
                <div class="list_textbox">
                		<h1> <a href="<?php echo osc_item_url(); ?>"><?php echo osc_item_title(); ?></a></h1>
                        <h3><?php echo osc_item_city();?> - (<?php echo osc_item_region(); ?>) - <?php echo osc_format_date(osc_item_pub_date()); ?>.</h3>
                        <p><?php echo osc_highlight(strip_tags(osc_item_description())); ?></p>
                </div>
                <div class="clear"></div>
            </article>
			<?php } 
			}?>
                	
                </div>
            </li>
            <li>
            	<a href="#"><img class="icon" alt="" src="<?php echo osc_current_web_theme_url('images/account.png')?>">
				<h2>Account<span>View Full Account</span></h2>
				<img class="plus" alt="" src="<?php echo osc_current_web_theme_url('images/plus_dropdown.png')?>"></a>
                <div class="wishlist account" style="display: block;">
                	<h1>Update account</h1>
					<?php  
					$osc_user = osc_user();
					?>
					<form action="<?php echo osc_base_url(true); ?>" method="post">
                	<ul>
                    	<li><label>Name</label><?php UserForm::name_text(osc_logged_user_name()); ?></li>
                    	<li><label>User Type</label> <?php UserForm::is_company_select(osc_user()); ?></li>
                    	<li><label>Cell Phone</label><?php UserForm::mobile_text(osc_user()); ?></li>
                    	<li><label>Phone</label><?php UserForm::phone_land_text(osc_user()); ?></li>
                        <li><label>Country</label><?php UserForm::country_select(osc_get_countries(), osc_user()); ?></li>
                        <li><label>Region</label> <?php UserForm::region_select(osc_get_regions(), osc_user()); ?></li>
                        <li><label>City</label>  <?php UserForm::city_select(osc_get_cities(), osc_user()); ?></li>
                    	<li><label>City Area</label> <?php UserForm::city_area_text(osc_user()); ?></li>
                    	<li><label>Address</label><?php UserForm::address_text(osc_user()); ?></li>
                    	<li><label>Website</label><?php UserForm::website_text(osc_user()); ?></li>
                    	<li><label>Description</label> <?php UserForm::info_textarea('s_info', osc_locale_code(), @$osc_user['locale'][osc_locale_code()]['s_info']); ?></li>
                        <li><input type="button" value="Update" class="Update apply"></li>
						 <?php osc_run_hook('user_form'); ?>
                    </ul>
					</form>
					<?php 
            if(osc_is_web_user_logged_in()){
            $userSettings = ModelPM::newInstance()->getUserPmSettings(osc_logged_user_id());
            ?>
                    <h1>PM Settings</h1>
					 <form action="<?php echo osc_base_url() . 'oc-content/plugins/osclass_pm/user-proc.php'; ?>" method="POST">
					  <input type="hidden" name="page" value="custom" />
      <input type="hidden" name="file" value="osclass_pm/user-proc.php" />
      <input type="hidden" name="option" value="userSettings" />
      <input type="hidden" name="user_id" value="<?php echo osc_logged_user_id(); ?>" />
                	<ul class="pm">
                    	<li><label>Notify by email every time you get a new personal message?</label>
                        	 <select name="emailAlert">
                  <option value="1" <?php if($userSettings['send_email'] == 1) { echo 'selected';}?>><?php _e('Always','osclass_pm'); ?></option>
                  <option value="0" <?php if($userSettings['send_email'] == 0) { echo 'selected';}?>><?php _e('Never','osclass_pm'); ?></option>
               </select>
                        </li>
                    	<li><label>Show a flash message when you have new personal messages?</label>
                        	 <select name="flashAlert">
                  <option value="1" <?php if($userSettings['flash_alert'] == 1) { echo 'selected';}?>><?php _e('Always','osclass_pm'); ?></option>
                  <option value="0" <?php if($userSettings['flash_alert'] == 0) { echo 'selected';}?>><?php _e('Never','osclass_pm'); ?></option>
               </select>
                        </li>
                    	<li><label>Notify by email every time you get a new personal message?</label>
                        	<select name="saveSent">
                  <option value="1" <?php if($userSettings['save_sent'] == 1) { echo 'selected';}?>><?php _e('Always','osclass_pm'); ?></option>
                  <option value="0" <?php if($userSettings['save_sent'] == 0) { echo 'selected';}?>><?php _e('Never','osclass_pm'); ?></option>
               </select>
                        </li>
						 <?php if( pmSent() ) { ?>
						 <li><label>Save a copy of each personal message in your outbox by default?</label>
                        	<select name="saveSent">
                  <option value="1" <?php if($userSettings['save_sent'] == 1) { echo 'selected';}?>><?php _e('Always','osclass_pm'); ?></option>
                  <option value="0" <?php if($userSettings['save_sent'] == 0) { echo 'selected';}?>><?php _e('Never','osclass_pm'); ?></option>
               </select>
                        </li>
						 <?php } ?>
                        <li><input type="button" value="Save Settings" class="settings apply"></li>
                    </ul>
					 </form>
					<?php } ?>
					  <form action="<?php echo osc_base_url(true); ?>" method="post">
                    <h1>Change your Username</h1>
					 <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="change_username_post" />
                	<ul>
                    	<li><label>User Name</label><input type="text" name="s_username" id="s_username" value="" /></li>
						<li><input type="button" value="Update" class="Update apply"></li>
                    </ul>
					</form>
					<h1>Change your Email</h1>
					 <form action="<?php echo osc_base_url(true); ?>" method="post">
					 <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="change_email_post" />
                	<ul>
                    	<li><label>Current Email</label><?php echo osc_logged_user_email(); ?></li>
                    	<li><label>New Email*</label><input type="text" name="new_email" id="new_email" value="" /></li>
                    	
                        <li><input type="button" value="Update" class="Update apply"></li>
                    </ul>
					</form>
					<h1>Change your Password</h1>
					 <form action="<?php echo osc_base_url(true); ?>" method="post">
					  <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="change_password_post" />
                	<ul>
					    <li><label>Current Password*</label><input type="password" name="password" id="password" value="" /></li>
                    	<li><label>New Password*</label><input type="password" name="new_password" id="new_password" value="" /></li>
                    	<li><label>Repeat New Password*</label><input type="password" name="new_password2" id="new_password2" value="" /></li>
                        <li><input type="button" value="Update" class="Update apply"></li>
                    </ul>
					</form>
                    <h1><?php _e('Delete Account', 'bender') ; ?></h1>
                    <?php $options = array();
      $options[] = array('name'  => __('Delete account', 'bender'),
                         'url'   => '#',
                         'class' => 'opt_delete_account');
      $options = osc_apply_filter('user_menu_filter', $options);
      echo '<ul><li class="' . $options[0]['class'] . '" ><a href="' . $options[0]['url'] . '" >' . $options[0]['name'] . '</a></li></ul>';                            
?>
                    <div class="clear"></div>
                </div>
            </li> 
        </ul>
    </section>
    </section>
<?php osc_current_web_theme_path('footer.php') ; ?>
