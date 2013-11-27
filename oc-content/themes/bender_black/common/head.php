<?php
    $js_lang = array(
        'delete' => __('Delete', 'bender'),
        'cancel' => __('Cancel', 'bender')
    );

    osc_enqueue_script('jquery');
    osc_enqueue_script('jquery-ui');
    osc_register_script('global-theme-js', osc_current_web_theme_js_url('global.js'), 'jquery');
    osc_register_script('delete-user-js', osc_current_web_theme_js_url('delete_user.js'), 'jquery-ui');
    osc_enqueue_script('global-theme-js');
?>
<meta http-equiv="Content-type" content="text/html; charset=utf-8" />

<title><?php echo meta_title() ; ?></title>
<meta name="title" content="<?php echo osc_esc_html(meta_title()); ?>" />
<?php if( meta_description() != '' ) { ?>
<meta name="description" content="<?php echo osc_esc_html(meta_description()); ?>" />
<?php } ?>
<?php if( meta_keywords() != '' ) { ?>
<meta name="keywords" content="<?php echo osc_esc_html(meta_keywords()); ?>" />
<?php } ?>
<?php if( osc_get_canonical() != '' ) { ?>
<!-- canonical -->
<link rel="canonical" href="<?php echo osc_get_canonical(); ?>"/>
<!-- /canonical -->
<?php } ?>
<meta http-equiv="Cache-Control" content="no-cache" />
<meta http-equiv="Expires" content="Fri, Jan 01 1970 00:00:00 GMT" />

<meta name="viewport" content="initial-scale = 1.0,maximum-scale = 1.0" />

<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black">

<!-- favicon -->
<link rel="shortcut icon" href="<?php echo osc_current_web_theme_url('favicon/favicon-48.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo osc_current_web_theme_url('favicon/favicon-144.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo osc_current_web_theme_url('favicon/favicon-114.png'); ?>">
<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo osc_current_web_theme_url('favicon/favicon-72.png'); ?>">
<link rel="apple-touch-icon-precomposed" href="<?php echo osc_current_web_theme_url('favicon/favicon-57.png'); ?>">
<!-- /favicon -->

<link href="<?php echo osc_current_web_theme_url('js/jquery-ui/jquery-ui-1.10.2.custom.min.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" rel="stylesheet" type="text/css" />

<script type="text/javascript">
    var bender = window.bender || {};
    bender.base_url = '<?php echo osc_base_url(true); ?>';
    bender.langs = <?php echo json_encode($js_lang); ?>
</script>
<!-- Including css files -->
<link href="<?php echo osc_current_web_theme_url('css/style.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/browser.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" media="only screen and (max-width:1024px), (max-device-width:1024px) and (orientation:landscape)" />
<link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/ipad-landscape-width.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" media="only screen and (max-width:1024px), (max-device-width:1024px) and (orientation:landscape)" />
<link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/ipad-portrait-width.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" media="only screen and (max-width:768px), (max-device-width:768px) and (orientation:portrait)" />
<link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/browser.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" media="only screen and (max-width:600px)" />
<link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/iphone-landscape-width.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" media="only screen and (max-width:480px), (max-device-width:480px)" />
<link rel="stylesheet" type="text/css" href="<?php echo osc_current_web_theme_url('css/iphone-portrait-width.css') ; ?>?<?php echo rand(0, pow(10, 5)); ?>" media="only screen and (max-width:320px), (max-device-width:320px)" />
<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->
<!--[if IE 7]>
	<style>
    	input[type=button].search_btn
        {
        	padding:10px 15px;
        }
    </style>
<![endif]-->
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
<script type="text/javascript">
$(document).ready(function(){
$( ".search-btn" ).click(function() {
  $( ".search_box" ).slideToggle( "slow", function() {
    // Animation complete.
  });
});
});
</script>
    </head>
<body>

<header>
	<section class="header_midbox wrapper">
    	<a href="#"><img src="<?php echo osc_current_web_theme_url('images/logo.png')?>" alt="Logo Here" class="logo"/></a>
         
        <nav class="navigation">
        	<ul class="nav" >
            	<li class="current" ><a href="#home" ><img src="<?php echo osc_current_web_theme_url('images/home_icon.png'); ?>" alt="Home_icon" class="active_icon" /><img src="<?php echo osc_current_web_theme_url('images/home_icon_normal.png');?>" alt="Home_icon" class="normal_icon" /><p>Home</p></a></li>
            	<li><a href="#login_register"><img src="<?php echo osc_current_web_theme_url('images/login_icon.png');?>" alt="Home_icon" class="active_icon" /><img src="<?php echo osc_current_web_theme_url('images/login_icon_normal.png');?>" alt="Home_icon" class="normal_icon" /><p>Login</p></a></li>
            	<li><a href="#login_register"><img src="<?php echo osc_current_web_theme_url('images/register_icon.png')?>" alt="Home_icon" class="active_icon" /><img src="<?php echo osc_current_web_theme_url('images/register_icon_normal.png')?>" alt="Home_icon" class="normal_icon" /><p>Register</p></a></li>
            	<li><a href="#listing"><img src="<?php echo osc_current_web_theme_url('images/list_icon.png')?>" alt="Home_icon" class="active_icon" /><img src="<?php echo osc_current_web_theme_url('images/list_icon_normal.png')?>" alt="Home_icon" class="normal_icon" /><p>Listing</p></a></li>
            	<li><a href="#contact"><img src="<?php echo osc_current_web_theme_url('images/contact_icon.png')?>" alt="Home_icon" class="active_icon" /><img src="<?php echo osc_current_web_theme_url('images/contact_icon_normal.png');?>" alt="Home_icon" class="normal_icon" /><p>Contact Us</p></a></li>
                <li><a href="#no"><img src="<?php echo osc_current_web_theme_url('images/publish-icon.png')?>" alt="Home_icon" class="active_icon" /><img src="<?php echo osc_current_web_theme_url('images/publish-icon-normal.png')?>" alt="Home_icon" class="normal_icon" /><p>Publish Your ad</p></a></li>
            </ul>
        </nav>
      
       
        <nav class="navigation2">
        	<ul class="nav" >
            	<li><a href="#home" class="active"><img src="<?php echo osc_current_web_theme_url('images/home_icon.png');?>" alt="Home_icon" /><p>Home</p></a></li>
            	<li><a href="#login_register" ><img src="<?php echo osc_current_web_theme_url('images/login_icon.png');?>" alt="Home_icon" /><p>Login</p></a></li>
            	<li><a href="#login_register" ><img src="<?php echo osc_current_web_theme_url('images/register_icon.png');?>" alt="Home_icon" /><p>Register</p></a></li>
            	<li><a href="#listing" ><img src="<?php echo osc_current_web_theme_url('images/list_icon.png');?>" alt="Home_icon" /><p>Listing</p></a></li>
            	<li><a href="#contact" ><img src="<?php echo osc_current_web_theme_url('images/contact_icon.png');?>" alt="Home_icon" /><p>Contact Us</p></a></li>
                <li><a href="#no" ><img src="<?php echo osc_current_web_theme_url('images/contact_icon.png');?>" alt="Home_icon" /><p>Publish Your ad</p></a></li>
            </ul>
        </nav>
         
    </section>

</header>

<article class="search_box">
		<section class="search_midbox wrapper">
        	<div class="search_area">
            	<div class="input_outer_area">
                	<input type="text" value="" placeholder="" />
                    <select>
                    	<option>Select a Category</option>
                    	<option>Select a Category</option>
                        <option>Select a Category</option>
                    </select>
                    <div class="clear"></div>
                </div>
                <input type="button" class="search_btn" value="Search" />
                <div class="clear"></div>
               
            </div>
        </section>
         
</article>
<?php osc_run_hook('header') ; ?>