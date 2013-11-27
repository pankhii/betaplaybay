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

    bender_black_add_boddy_class('user user-profile');
    osc_add_hook('before-main','sidebar');
    function sidebar(){
        osc_current_web_theme_path('user-sidebar.php');
    }
    osc_current_web_theme_path('header.php') ;
    $osc_user = osc_user();
?>
<h1><?php _e('Update your profile', 'bender_black'); ?></h1>
<?php UserForm::location_javascript(); ?>
<div class="form-container form-horizontal">
    <div class="resp-wrapper">
        <ul id="error_list"></ul>
        <form action="<?php echo osc_base_url(true); ?>" method="post">
            <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="profile_post" />
            <div class="control-group">
                <label class="control-label" for="name"><?php _e('Name', 'bender_black'); ?></label>
                <div class="controls">
                    <?php UserForm::name_text(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="user_type"><?php _e('User type', 'bender_black'); ?></label>
                <div class="controls">
                    <?php UserForm::is_company_select(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="phoneMobile"><?php _e('Cell phone', 'bender_black'); ?></label>
                <div class="controls">
                    <?php UserForm::mobile_text(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="country"><?php _e('Country', 'bender_black'); ?></label>
                <div class="controls">
                    <?php UserForm::country_select(osc_get_countries(), osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="region"><?php _e('Region', 'bender_black'); ?></label>
                <div class="controls">
                    <?php UserForm::region_select(osc_get_regions(), osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="city"><?php _e('City', 'bender_black'); ?></label>
                <div class="controls">
                    <?php UserForm::city_select(osc_get_cities(), osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="city_area"><?php _e('City area', 'bender_black'); ?></label>
                <div class="controls">
                    <?php UserForm::city_area_text(osc_user()); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="s_info"><?php _e('Description', 'bender_black'); ?></label>
                <div class="controls">
                    <?php UserForm::info_textarea('s_info', osc_locale_code(), $osc_user['locale'][osc_locale_code()]['s_info']); ?>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php _e("Update", 'bender_black');?></button>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <?php osc_run_hook('user_form'); ?>
                </div>
            </div>
  <!--PM messages settingssss-->
  <h1><?php _e('PM Settings', 'osclass_pm'); ?></h1>
    <div id="main">
    <form action="<?php echo osc_base_url() . 'oc-content/plugins/osclass_pm/user-proc.php'; ?>" method="POST">
      <input type="hidden" name="page" value="custom" />
      <input type="hidden" name="file" value="osclass_pm/user-proc.php" />
      <input type="hidden" name="option" value="userSettings" />
      <input type="hidden" name="user_id" value="<?php echo osc_logged_user_id(); ?>" />
      <table class="pmSettings">
         <tr>
            <td><?php _e('Notify by email every time you get a new personal message','osclass_pm'); ?>?</td>
            <td>
               <select name="emailAlert">
                  <option value="1" <?php if($userSettings['send_email'] == 1) { echo 'selected';}?>><?php _e('Always','osclass_pm'); ?></option>
                  <option value="0" <?php if($userSettings['send_email'] == 0) { echo 'selected';}?>><?php _e('Never','osclass_pm'); ?></option>
               </select>
            </td>
         </tr>
         <tr>
            <td><?php _e('Show a flash message when you have new personal messages','osclass_pm'); ?>?</td>
            <td>
               <select name="flashAlert">
                  <option value="1" <?php if($userSettings['flash_alert'] == 1) { echo 'selected';}?>><?php _e('Always','osclass_pm'); ?></option>
                  <option value="0" <?php if($userSettings['flash_alert'] == 0) { echo 'selected';}?>><?php _e('Never','osclass_pm'); ?></option>
               </select>
            </td>
         </tr>
         <?php if( pmSent() ) { ?>
         <tr>
            <td><?php _e('Save a copy of each personal message in your outbox by default','osclass_pm'); ?>?</td>
            <td>
               <select name="saveSent">
                  <option value="1" <?php if($userSettings['save_sent'] == 1) { echo 'selected';}?>><?php _e('Always','osclass_pm'); ?></option>
                  <option value="0" <?php if($userSettings['save_sent'] == 0) { echo 'selected';}?>><?php _e('Never','osclass_pm'); ?></option>
               </select>
            </td>
         </tr>
         <?php } ?>
         </table>
         <div class="control-group">
           <div class="controls">
             <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php _e('Save Settings','osclass_pm'); ?></button>
           </div>
         </div>
      
      </form>
    </div>
  <!--change user name-->
  <h1><?php _e('Change your username', 'bender_black'); ?></h1>
  <div class="form-container form-horizontal">
    <div class="resp-wrapper">
        <ul id="error_list"></ul>
        <form action="<?php echo osc_base_url(true); ?>" method="post">
            <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="change_username_post" />
            <div class="control-group">
                <label class="control-label" for="s_username"><?php _e('Username', 'bender_black'); ?></label>
                <div class="controls">
                    <input type="text" name="s_username" id="s_username" value="" />
                    <div id="available"></div>
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php _e("Update", 'bender_black');?></button>
                </div>
            </div>
        </form>
    </div>
</div>
  <!--E-mail changing-->
  <h1><?php _e('Change your e-mail', 'bender_black'); ?></h1>
  <div class="form-container form-horizontal">
    <div class="resp-wrapper">
        <ul id="error_list"></ul>
        <form action="<?php echo osc_base_url(true); ?>" method="post">
            <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="change_email_post" />
            <div class="control-group">
                <label for="email"><?php _e('Current e-mail', 'bender_black'); ?></label>
                <div class="controls">
                    <?php echo osc_logged_user_email(); ?>
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="new_email"><?php _e('New e-mail', 'bender_black'); ?> *</label>
                <div class="controls">
                    <input type="text" name="new_email" id="new_email" value="" />
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php _e("Update", 'bender_black');?></button>
                </div>
            </div>
        </form>
    </div>
</div>
  <!--Password changing-->
  <h1><?php _e('Change your password', 'bender_black'); ?></h1>
<div class="form-container form-horizontal">
    <div class="resp-wrapper">
        <ul id="error_list"></ul>
        <form action="<?php echo osc_base_url(true); ?>" method="post">
            <input type="hidden" name="page" value="user" />
            <input type="hidden" name="action" value="change_password_post" />
            <div class="control-group">
                <label class="control-label" for="password"><?php _e('Current password', 'bender_black'); ?> *</label>
                <div class="controls">
                    <input type="password" name="password" id="password" value="" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="new_password"><?php _e('New password', 'bender_black'); ?> *</label>
                <div class="controls">
                    <input type="password" name="new_password" id="new_password" value="" />
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="new_password2"><?php _e('Repeat new password', 'bender_black'); ?> *</label>
                <div class="controls">
                    <input type="password" name="new_password2" id="new_password2" value="" />
                </div>
            </div>
            <div class="control-group">
                <div class="controls">
                    <button type="submit" class="ui-button ui-button-middle ui-button-main"><?php _e("Update", 'bender_black');?></button>
                </div>
            </div>
        </form>
    </div>
</div>
<!--delete account-->
<h1><?php _e('Delete account', 'bender_black'); ?></h1>
<?php $options = array();
      $options[] = array('name'  => __('Delete account', 'bender_black'),
                         'url'   => '#',
                         'class' => 'opt_delete_account');
      $options = osc_apply_filter('user_menu_filter', $options);
      echo '<li class="' . $options[0]['class'] . '" ><a href="' . $options[0]['url'] . '" >' . $options[0]['name'] . '</a></li>';                            
?>
        </form>
    </div>
</div>
<?php osc_current_web_theme_path('footer.php') ; ?>