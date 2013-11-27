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

/**

DEFINES

*/
    define('BENDER_BLACK_THEME_VERSION', '1.0');
    if( !osc_get_preference('keyword_placeholder', 'bender_black_theme') ) {
        osc_set_preference('keyword_placeholder', __('ie. PHP Programmer', 'bender_black_theme'), 'bender_black');
    }
    osc_register_script('fancybox', osc_current_web_theme_url('js/fancybox/jquery.fancybox.pack.js'), array('jquery'));
    osc_enqueue_style('fancybox', osc_current_web_theme_url('js/fancybox/jquery.fancybox.css'));
    osc_enqueue_script('fancybox');

/**

FUNCTIONS

*/

    // install update options
    if( !function_exists('bender_blackBodyClass_theme_install') ) {
        function bender_black_theme_install() {
            osc_set_preference('keyword_placeholder', __('ie. PHP Programmer', 'bender_black'), 'bender_black_theme');
            osc_set_preference('version', BENDER_BLACK_THEME_VERSION, 'bender_black_theme');
            osc_set_preference('footer_link', '1', 'bender_black_theme');
            osc_set_preference('donation', '0', 'bender_black_theme');
            osc_set_preference('default_logo', '1', 'bender_black_theme');
            osc_reset_preferences();
        }
    }

    if(!function_exists('check_install_bender_black_theme')) {
        function check_install_bender_black_theme() {
            $current_version = osc_get_preference('version', 'bender_black');
            //check if current version is installed or need an update<
            if( !$current_version ) {
                bender_black_theme_install();
            }
        }
    }

    if(!function_exists('bender_black_add_body_class_construct')) {
        function bender_black_add_body_class_construct($classes){
            $bender_blackBodyClass = bender_blackBodyClass::newInstance();
            $classes = array_merge($classes, $bender_blackBodyClass->get());
            return $classes;
        }
    }
    if(!function_exists('bender_black_boddy_class')) {
        function bender_black_boddy_class($echo = true){
            /**
            * Print body classes.
            *
            * @param string $echo Optional parameter.
            * @return print string with all body classes concatenated
            */
            osc_add_filter('bender_black_bodyClass','bender_black_add_body_class_construct');
            $classes = osc_apply_filter('bender_black_bodyClass', array());
            if($echo && count($classes)){
                echo 'class="'.implode(' ',$classes).'"';
            } else {
                return $classes;
            }
        }
    }
    if(!function_exists('bender_black_add_boddy_class')) {
        function bender_black_add_boddy_class($class){
            /**
            * Add new body class to body class array.
            *
            * @param string $class required parameter.
            */
            $bender_blackBodyClass = bender_blackBodyClass::newInstance();
            $bender_blackBodyClass->add($class);
        }
    }
    if(!function_exists('bender_black_nofollow_construct')) {
        /**
        * Hook for header, meta tags robots nofollos
        */
        function bender_black_nofollow_construct() {
            echo '<meta name="robots" content="noindex, nofollow, noarchive" />' . PHP_EOL;
            echo '<meta name="googlebot" content="noindex, nofollow, noarchive" />' . PHP_EOL;

        }
    }
    if( !function_exists('bender_black_follow_construct') ) {
        /**
        * Hook for header, meta tags robots follow
        */
        function bender_black_follow_construct() {
            echo '<meta name="robots" content="index, follow" />' . PHP_EOL;
            echo '<meta name="googlebot" content="index, follow" />' . PHP_EOL;

        }
    }
    /* logo */
    if( !function_exists('logo_header') ) {
        function logo_header() {
             $html = '<a href="'.osc_base_url().'"><img border="0" alt="' . osc_page_title() . '" src="' . osc_current_web_theme_url('images/logo.jpg') . '"></a>';
             if( file_exists( WebThemes::newInstance()->getCurrentThemePath() . 'images/logo.jpg' ) ) {
                return $html;
             } else {
                return '<a href="'.osc_base_url().'">'.osc_page_title().'</a>';
            }
        }
    }
    if( !function_exists('bender_black_draw_item') ) {
        function bender_black_draw_item($class = false,$admin = false) {
            $size = explode('x', osc_thumbnail_dimensions());
    ?>
            <li class="listing-card <?php echo $class; ?>">
                <?php if( osc_images_enabled_at_items() ) { ?>
                    <?php if(osc_count_item_resources()) { ?>
                        <a class="listing-thumb" href="<?php echo osc_item_url() ; ?>" title="<?php echo osc_item_title() ; ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_item_title() ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>"></a>
                    <?php } else { ?>
                        <a class="listing-thumb" href="<?php echo osc_item_url() ; ?>" title="<?php echo osc_item_title() ; ?>"><img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_item_title() ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>"></a>
                    <?php } ?>
                <?php } ?>
                <div class="listing-detail">
                    <div class="listing-cell">
                        <div class="listing-data">
                            <div class="listing-basicinfo">
                                <a href="<?php echo osc_item_url() ; ?>" class="title" title="<?php echo osc_item_title() ; ?>"><?php echo osc_item_title() ; ?></a>
                                <div class="listing-attributes">
                                    <span class="category"><?php echo osc_item_category() ; ?></span> -
                                    <span class="location"><?php echo osc_item_city(); ?> (<?php echo osc_item_region(); ?>)</span> <span class="g-hide">-</span> <?php echo osc_format_date(osc_item_pub_date()); ?>
                                    <?php if( osc_price_enabled_at_items() ) { ?><span class="currency-value"><?php echo osc_format_price(osc_item_price()); ?></span><?php } ?>
                                </div>
                                <p><?php echo osc_highlight( strip_tags( osc_item_description()) ,250) ; ?></p>
                            </div>
                            <?php if($admin){ ?>
                                <span class="admin-options">
                                    <a href="<?php echo osc_item_edit_url(); ?>" rel="nofollow"><?php _e('Edit item', 'bender_black'); ?></a>
                                    <span>|</span>
                                    <a class="delete" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', 'bender_black')); ?>')" href="<?php echo osc_item_delete_url();?>" ><?php _e('Delete', 'bender_black'); ?></a>
                                    <?php if(osc_item_is_inactive()) {?>
                                    <span>|</span>
                                    <a href="<?php echo osc_item_activate_url();?>" ><?php _e('Activate', 'bender_black'); ?></a>
                                    <?php } ?>
          <!-- Payment methods -->
                        <span>|</span>
                        <?php if(osc_get_preference("pay_per_post", "payment")=="1") { ?>
                            <?php if(ModelPayment::newInstance()->publishFeeIsPaid(osc_item_id())) { ?>
                                <strong><?php _e('Paid!', 'bender_black'); ?></strong>
                            <?php } else { ?>
                                <strong><a href="<?php echo osc_route_url('payment-publish', array('itemId' => osc_item_id())); ?>"><?php _e('Pay for this item', 'bender_black'); ?></a></strong>
                            <?php }; ?>
                        <?php }; ?>
                        <?php if(osc_get_preference("pay_per_post", "payment")=="1" && osc_get_preference("allow_premium", "payment")=="1") { ?>
                            <span>|</span>
                        <?php }; ?>
                        <?php if(osc_get_preference("allow_premium", "payment")=="1") { ?>
                            <?php if(ModelPayment::newInstance()->premiumFeeIsPaid(osc_item_id())) { ?>
                                <strong><?php _e('Already premium!', 'bender_black'); ?></strong>
                            <?php } else { ?>
                                <strong><a href="<?php echo osc_route_url('payment-premium', array('itemId' => osc_item_id())); ?>"><?php _e('Make premium', 'bender_black'); ?></a></strong>
                            <?php }; ?>
                        <?php }; ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </li>
<?php
        }
    }
    if( !function_exists('bender_black_draw_categories_list') ) {
        function bender_black_draw_categories_list(){ ?>
        <?php if(!osc_is_home_page()){ echo '<div class="resp-wrapper">'; } ?>
        <ul class="r-list">
         <?php
         osc_goto_first_category();
         $i= 0;
         while ( osc_has_categories() ) {
            $liClass = '';
            if($i%3 == 0){
                $liClass = 'clear';
            }
            $i++;
         ?>
             <li<?php if($liClass){ echo " class='$liClass'"; } ?>>
                 <h1><a class="category <?php echo osc_category_slug() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span></h1>
                 <?php /**/if ( osc_count_subcategories() > 0 ) { ?>
                   <ul>
                         <?php while ( osc_has_subcategories() ) { ?>
                             <li>
                             <?php if( osc_category_total_items() > 0 ) { ?><a class="category <?php echo osc_category_slug() ; ?>" href="<?php echo osc_search_category_url() ; ?>"><?php echo osc_category_name() ; ?></a> <span>(<?php echo osc_category_total_items() ; ?>)</span>
                             <?php } else { ?><span><?php echo osc_category_name() ; ?> (<?php echo osc_category_total_items() ; ?>)</span></li>
                             <?php } ?>
                         <?php } ?>
                   </ul>
                 <?php } ?>
             </li>
        <?php } ?>
        </ul>
        <?php if(!osc_is_home_page()){ echo '</div>'; } ?>
        <?php
        }
    }
    if( !function_exists('bender_black_search_number') ) {
        /**
          *
          * @return array
          */
        function bender_black_search_number() {
            $search_from = ((osc_search_page() * osc_default_results_per_page_at_search()) + 1);
            $search_to   = ((osc_search_page() + 1) * osc_default_results_per_page_at_search());
            if( $search_to > osc_search_total_items() ) {
                $search_to = osc_search_total_items();
            }

            return array(
                'from' => $search_from,
                'to'   => $search_to,
                'of'   => osc_search_total_items()
            );
        }
    }
    /*
     * Helpers used at view
     */
    if( !function_exists('bender_black_item_title') ) {
        function bender_black_item_title() {
            $title = osc_item_title();
            foreach( osc_get_locales() as $locale ) {
                if( Session::newInstance()->_getForm('title') != "" ) {
                    $title_ = Session::newInstance()->_getForm('title');
                    if( $title_[$locale['pk_c_code']] != "" ){
                        $title = $title_[$locale['pk_c_code']];
                    }
                }
            }
            return $title;
        }
    }
    if( !function_exists('bender_black_item_description') ) {
        function bender_black_item_description() {
            $description = osc_item_description();
            foreach( osc_get_locales() as $locale ) {
                if( Session::newInstance()->_getForm('description') != "" ) {
                    $description_ = Session::newInstance()->_getForm('description');
                    if( $description_[$locale['pk_c_code']] != "" ){
                        $description = $description_[$locale['pk_c_code']];
                    }
                }
            }
            return $description;
        }
    }
    if( !function_exists('related_listings') ) {
        function related_listings() {
            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addRegion(osc_item_region());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id < %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '3');

            $aItems = $mSearch->doSearch();
            if( count($aItems) == 3 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
           //--ribr 18092013--     return $iTotalItems;
            }
            unset($mSearch);

            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id < %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '3');

            $aItems = $mSearch->doSearch();
            if( count($aItems) == 3 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
            //--ribr 18092013--    return $iTotalItems;
            }
            unset($mSearch);

            $mSearch = new Search();
            $mSearch->addCategory(osc_item_category_id());
            $mSearch->addItemConditions(sprintf("%st_item.pk_i_id != %s ", DB_TABLE_PREFIX, osc_item_id()));
            $mSearch->limit('0', '3');

            $aItems = $mSearch->doSearch();
            if( count($aItems) > 0 ) {
                View::newInstance()->_exportVariableToView('items', $aItems);
            //--ribr 18092013--    return $iTotalItems;
            }
            unset($mSearch);

            return 0;
        }
    }

    if( !function_exists('osc_is_contact_page') ) {
        function osc_is_contact_page() {
            if( Rewrite::newInstance()->get_location() === 'contact' ) {
                return true;
            }

            return false;
        }
    }

    if( !function_exists('get_breadcrumb_lang') ) {
        function get_breadcrumb_lang() {
            $lang = array();
            $lang['item_add']               = __('Publish a listing', 'bender_black');
            $lang['item_edit']              = __('Edit your listing', 'bender_black');
            $lang['item_send_friend']       = __('Send to a friend', 'bender_black');
            $lang['item_contact']           = __('Contact publisher', 'bender_black');
            $lang['search']                 = __('Search results', 'bender_black');
            $lang['search_pattern']         = __('Search results: %s', 'bender_black');
            $lang['user_dashboard']         = __('Dashboard', 'bender_black');
            $lang['user_dashboard_profile'] = __("%s's profile", 'bender_black');
            $lang['user_account']           = __('Account', 'bender_black');
            $lang['user_items']             = __('My listings', 'bender_black');
            $lang['user_alerts']            = __('My searches', 'bender_black');
            $lang['user_profile']           = __('Update my profile', 'bender_black');
            $lang['user_change_email']      = __('Change my email', 'bender_black');
            $lang['user_change_username']   = __('Change my username', 'bender_black');
            $lang['user_change_password']   = __('Change my password', 'bender_black');
            $lang['login']                  = __('Login', 'bender_black');
            $lang['login_recover']          = __('Recover your password', 'bender_black');
            $lang['login_forgot']           = __('Change your password', 'bender_black');
            $lang['register']               = __('Create a new account', 'bender_black');
            $lang['contact']                = __('Contact', 'bender_black');

            return $lang;
        }
    }

    if( !function_exists('get_user_menu') ) {
        function get_user_menu() {
            $options   = array();
            $options[] = array(
                'name'  => __('Dashboard', 'bender_black'),
                'url'   => osc_user_dashboard_url(),
                'class' => 'opt_dashboard'
            );
            $options[] = array(
                'name' => __('My searches', 'bender_black'),
                'url' => osc_user_alerts_url(),
                'class' => 'opt_alerts'
            );
            $options[] = array(
                'name'  => __('Settings', 'bender_black'),
                'url'   => osc_user_profile_url(),
                'class' => 'opt_account'
            );
            /*$options[] = array(
                'name'  => __('Change email', 'bender_black'),
                'url'   => osc_change_user_email_url(),
                'class' => 'opt_account'
            );
            $options[] = array(
                'name'  => __('Change username', 'bender_black'),
                'url'   => osc_change_user_username_url(),
                'class' => 'opt_account'
            );
            $options[] = array(
                'name'  => __('Change password', 'bender_black'),
                'url'   => osc_change_user_password_url(),
                'class' => 'opt_account'
            );
            $options[] = array(
                'name'  => __('Delete account', 'bender_black'),
                'url'   => '#',
                'class' => 'opt_delete_account'
            );*/

            return $options;
        }
    }

    if( !function_exists('delete_user_js') ) {
        function delete_user_js() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();

            if( $location === 'user' && in_array($section, array('dashboard', 'profile', 'alerts', 'change_email', 'change_username',  'change_password', 'items')) ) {
                osc_enqueue_script('delete-user-js');
            }
        }
        osc_add_hook('header', 'delete_user_js', 1);
    }

    if( !function_exists('user_info_js') ) {
        function user_info_js() {
            $location = Rewrite::newInstance()->get_location();
            $section  = Rewrite::newInstance()->get_section();

            if( $location === 'user' && in_array($section, array('dashboard', 'profile', 'alerts', 'change_email', 'change_username',  'change_password', 'items')) ) { ?>
<script type="text/javascript">
    bender_black.user = {};
    bender_black.user.id = '<?php echo osc_user_id(); ?>';
    bender_black.user.secret = '<?php echo osc_user_field("s_secret"); ?>';
</script>
            <?php }
        }
        osc_add_hook('header', 'user_info_js');
    }

    function theme_bender_black_actions_admin() {
        if( Params::getParam('file') == 'oc-content/themes/bender_black/admin/settings.php' ) {
            if( Params::getParam('donation') == 'successful' ) {
                osc_set_preference('donation', '1', 'bender_black_theme');
                osc_reset_preferences();
            }
        }

        switch( Params::getParam('action_specific') ) {
            case('settings'):
                $footerLink  = Params::getParam('footer_link');
                $defaultLogo = Params::getParam('default_logo');
                osc_set_preference('keyword_placeholder', Params::getParam('keyword_placeholder'), 'bender_black_theme');
                osc_set_preference('footer_link', ($footerLink ? '1' : '0'), 'bender_black_theme');
                osc_set_preference('default_logo', ($defaultLogo ? '1' : '0'), 'bender_black_theme');

                osc_add_flash_ok_message(__('Theme settings updated correctly', 'bender_black'), 'admin');
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/bender_black/admin/settings.php'));
            break;
            case('upload_logo'):
                $package = Params::getFiles('logo');
                if( $package['error'] == UPLOAD_ERR_OK ) {
                    if( move_uploaded_file($package['tmp_name'], WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                        osc_add_flash_ok_message(__('The logo image has been uploaded correctly', 'bender_black'), 'admin');
                    } else {
                        osc_add_flash_error_message(__("An error has occurred, please try again", 'bender_black'), 'admin');
                    }
                } else {
                    osc_add_flash_error_message(__("An error has occurred, please try again", 'bender_black'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/bender_black/admin/header.php'));
            break;
            case('remove'):
                if(file_exists( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" ) ) {
                    @unlink( WebThemes::newInstance()->getCurrentThemePath() . "images/logo.jpg" );
                    osc_add_flash_ok_message(__('The logo image has been removed', 'bender_black'), 'admin');
                } else {
                    osc_add_flash_error_message(__("Image not found", 'bender_black'), 'admin');
                }
                osc_redirect_to(osc_admin_render_theme_url('oc-content/themes/bender_black/admin/header.php'));
            break;
        }
    }
    osc_add_hook('init_admin', 'theme_bender_black_actions_admin');
    osc_admin_menu_appearance(__('Header logo', 'bender_black'), osc_admin_render_theme_url('oc-content/themes/bender_black/admin/header.php'), 'header_bender_black');
    osc_admin_menu_appearance(__('Theme settings', 'bender_black'), osc_admin_render_theme_url('oc-content/themes/bender_black/admin/settings.php'), 'settings_bender_black');
/**

TRIGGER FUNCTIONS

*/
check_install_bender_black_theme();
if(osc_is_home_page()){
    osc_add_hook('inside-main','bender_black_draw_categories_list');
} else if( osc_is_static_page() || osc_is_contact_page() ){
    osc_add_hook('before-content','bender_black_draw_categories_list');
}

if(osc_is_home_page() || osc_is_search_page()){
    bender_black_add_boddy_class('has-searchbox');
}


/**

CLASSES

*/
class bender_blackBodyClass
{
    /**
    * Custom Class for add, remove or get body classes.
    *
    * @param string $instance used for singleton.
    * @param array $class.
    */
    private static $instance;
    private $class;

    private function __construct()
    {
        $this->class = array();
    }

    public static function newInstance()
    {
        if (  !self::$instance instanceof self)
        {
            self::$instance = new self;
        }
        return self::$instance;
    }

    public function add($class)
    {
        $this->class[] = $class;
    }
    public function get()
    {
        return $this->class;
    }
}
?>