<?php
/*
  Plugin Name: Meta Edit
  Plugin URI: http://oscanyon.com/products/meta-edit
  Description: Allows you to adjust the meta data.
  Version: 1.1
  Author: JChapman
  Author URI: http://oscanyon.com
  Author Email: siouxfallsrummages@gmail.com
  Short Name: meta_edit
  Plugin update URI: http://updates.oscanyon.com/upgrade.php?typeUpdate=ME&version=1
 */
function metaEdit_call_after_install() {
 	osc_set_preference('metaEdit_description', '1', 'plugin-meta_edit', 'INTEGER');
 	osc_set_preference('metaEdit_keywords', 'classifieds,ads,cars,jobs,real estate,collectibles,computers,electronics,photos,videos,services,events', 'plugin-meta_edit', 'STRING');
 	osc_set_preference('metaEdit_show_city', '1', 'plugin-meta_edit', 'INTEGER');
 	osc_set_preference('metaEdit_title_first', '0', 'plugin-meta_edit', 'INTEGER');
 	osc_set_preference('metaEdit_keywords_enabled', '1', 'plugin-meta_edit', 'INTEGER');
}

function metaEdit_call_after_uninstall() {
 	osc_delete_preference('metaEdit_description', 'plugin-meta_edit');
 	osc_delete_preference('metaEdit_keywords', 'plugin-meta_edit');
 	osc_delete_preference('metaEdit_show_city', 'plugin-meta_edit');
 	osc_delete_preference('metaEdit_title_first', 'plugin-meta_edit');
 	osc_delete_preference('metaEdit_keywords_enabled', 'plugin-meta_edit');
}

//HELPER functions
function metaCityShow(){
	if(osc_get_preference('metaEdit_show_city','plugin-meta_edit') == 1){
		return osc_item_city();
	}
	return '';
}
function metaEditTitleFirst(){
	return (osc_get_preference('metaEdit_title_first','plugin-meta_edit'));
}

 function metaEdit_title_filter($text) {

	$location = Rewrite::newInstance()->get_location();
    $section  = Rewrite::newInstance()->get_section();

    switch ($location) {
        case ('item'):
            switch ($section) {
                case 'item_add':    $text = __('Publish a listing'); break;
                case 'item_edit':   $text = __('Edit your listing'); break;
                case 'send_friend': $text = __('Send to a friend') . ' - ' . osc_item_title(); break;
                case 'contact':     $text = __('Contact seller') . ' - ' . osc_item_title(); break;
                default:            $text = osc_item_title() . ' ' . metaCityShow(); break;
            }
        break;
        case('page'):
            $text = osc_static_page_title();
        break;
        case('error'):
            $text = __('Error');
        break;
        case('search'):
            $region   = osc_search_region();
            $city     = osc_search_city();
            $pattern  = osc_search_pattern();
            $category = osc_search_category_id();
            $s_page   = '';
            $i_page   = Params::getParam('iPage');

            if($i_page != '' && $i_page > 1) {
                $s_page = ' - ' . __('page') . ' ' . $i_page ;
            }

            $b_show_all = ($region == '' && $city == '' & $pattern == '' && $category == '');
            $b_category = ($category != '');
            $b_pattern  = ($pattern != '');
            $b_city     = ($city != '');
            $b_region   = ($region != '');

            if($b_show_all) {
                $text = __('Show all listings') . ' - ' . $s_page . osc_page_title();
            }

            $result = '';
            if($b_pattern) {
                $result .= $pattern . ' &raquo; ';
            }

            if($b_category && is_array($category) && count($category) > 0) {
                $cat = Category::newInstance()->findByPrimaryKey($category[0]);
                if( $cat ) {
                    //$result .= strtolower($cat['s_name']) . ' ' ;
                    $result .= $cat['s_name'] . ' ';
                }
            }

            if($b_city && $b_region) {
                $result .= $city . ' &raquo; ';
            } else if($b_city) {
                $result .= $city . ' &raquo; ';
            } else if($b_region) {
                $result .= $region . ' &raquo; ';
            }

            $result = preg_replace('|\s?&raquo;\s$|', '', $result);

            if($result == '') {
                $result = __('Search results');
            }

            $text = '';
            if( osc_get_preference('seo_title_keyword') != '' ) {
                $text .= osc_get_preference('seo_title_keyword') . ' ';
            }
            $text .= $result . $s_page;
        break;
        case('login'):
            switch ($section) {
                case('recover'): $text = __('Recover your password');
                default:         $text = __('Login');
            }
        break;
        case('register'):
            $text = __('Create a new account');
        break;
        case('user'):
            switch ($section) {
                case('dashboard'):       $text = __('Dashboard'); break;
                case('items'):           $text = __('Manage my listings'); break;
                case('alerts'):          $text = __('Manage my alerts'); break;
                case('profile'):         $text = __('Update my profile'); break;
                case('pub_profile'):     $text = __('Public profile') . ' - ' . osc_user_name(); break;
                case('change_email'):    $text = __('Change my email'); break;
                case('change_password'): $text = __('Change my password'); break;
                case('forgot'):          $text = __('Recover my password'); break;
            }
        break;
        case('contact'):
            $text = __('Contact','meta_edit');
        break;
        default:
            $text = osc_page_title();
        break;
    }

    if( !osc_is_home_page() ) {
		if(metaEditTitleFirst() != 1) {
			$text .= ' - ' . osc_page_title();
		} else {
			$text = osc_page_title() . ' - ' . $text;
		}
    }
    return $text;
 }

 function metaEdit_description_filter($text) {
 	$text = '';
    // home page
    if( osc_is_home_page() ) {
        $text = osc_page_description();
    }
    // static page
    if( osc_is_static_page() ) {
        $text = osc_highlight(osc_static_page_text(), 140, '', '');
    }
    // search
    if( osc_is_search_page() ) {
        if( osc_has_items() ) {
            $text = osc_item_category() . ' ' . osc_item_city() . ', ' . osc_highlight(osc_item_description(), 120) . ', ' . osc_item_category() . ' ' . osc_item_city();
        }
        osc_reset_items();
    }
    // listing
    if( osc_is_ad_page() ) {
        $text = osc_item_category() . ' ' . metaCityShow() . ', ' . osc_highlight(osc_item_description(), 120) . ', ' . osc_item_category() . ' ' . metaCityShow();
    }
    return $text;
 }

 function metaEdit_keywords_filter($text) {

    $text = osc_get_preference('metaEdit_keywords','plugin-meta_edit');

    return $text;
}

 function metaEditTitle($title){
	    $file = explode('/', Params::getParam('file'));
	    if($file[0] == 'meta_edit'){
	        $title = 'Plugin - Meta Edit ';
	        /*if($file[1] == 'admin_list.php'){
	        <a class="btn ico ico-32 ico-help float-right" href="#"></a>
	        <script type="text/javascript" >
					$(document).ready(function(){
        				$("#help-box").append("<h3>Manage metaEdit Codes</h3>");
        				$("#help-box").append("<p>Some really great text will go here soon. How much text can I put here I wonder if it has a limit or if it expands more I will have to ponder that for a while. pondering!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!!! !!!!!!!!!!!!!!!!. It looks as though it can handle a lot of text well I guess we better keep filling it up with text wow my fingers are tierd of this. Just starting the 3 rd line lets see if I can read all of this text lets hope so.<br /><br /><br /> Just starting the 3 rd line lets see if I can read all of this text lets hope so.<br /><br /><br /> Just starting the 3 rd line lets see if I can read all of this text lets hope so.");
        			});
			  </script>
			  }
	        */
	    }
	    return $title;
	 }

    osc_add_filter('custom_plugin_title','metaEditTitle');

    // This is needed in order to be able to activate the plugin
    osc_register_plugin(osc_plugin_path(__FILE__), 'metaEdit_call_after_install') ;

    // This is a hack to show a Uninstall link at plugins table (you could also use some other hook to show a custom option panel)
    osc_add_hook(osc_plugin_path(__FILE__) . '_uninstall', 'metaEdit_call_after_uninstall') ;

    osc_add_filter('meta_title_filter', 'metaEdit_title_filter');

    osc_add_filter('meta_description_filter', 'metaEdit_description_filter');

    if(osc_get_preference('metaEdit_keywords_enabled', 'plugin-meta_edit') == 1) {
		osc_add_filter('meta_keywords_filter', 'metaEdit_keywords_filter');
	}

	 function meta_edit_init() {
		// 3.0 menu hooks
		osc_admin_menu_settings( __('Meta Options','meta_edit'), osc_admin_render_plugin_url(osc_plugin_folder(__FILE__) . 'config.php'), 'metaEdit_options', null, null );
	}
	osc_add_hook('init_admin', 'meta_edit_init');

	if( !function_exists('oscanyon_footer') ) {
		osc_add_hook('footer', 'oscanyon_footer', 10);

		function oscanyon_footer() {
			//echo '<div style="text-align:center">';
			//echo '<p>This site is prouldly using an <a href="http://oscanyon.com">osCanyon</a> production.</p>';
			//echo '</div> <br />';
		}
	}
?>
