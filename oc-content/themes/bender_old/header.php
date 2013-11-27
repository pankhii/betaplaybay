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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="<?php echo str_replace('_', '-', osc_current_user_locale()); ?>">
    <head>
	 <?php osc_current_web_theme_path('common/head.php') ; ?>


	<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>

	<script type="text/javascript">
$(document).ready(function(){
$( ".search-btn" ).click(function() {
  $( ".search_box" ).slideToggle( "slow", function() {
    // Animation complete.
  });
});

jQuery('#yourName').attr('placeholder','Name');
	jQuery('#yourEmail').attr('placeholder','Email');
	jQuery('#phoneNumber').attr('placeholder','Phone no.');
	jQuery('#message').attr('placeholder','Message');
	jQuery('#body').attr('placeholder','Message');
	jQuery("#my_page").find("ul").addClass( "result_slide" );
	jQuery('#message').attr('rows','5');
	jQuery('a.list-last').html('[ Next >> ]');
	jQuery('a.list-first').html('[ << Previous ]');
	
	
	
});
</script>
    </head> 
<body>

<header>
	<section class="header_midbox wrapper">
    	<a href="<?php echo osc_base_url(); ?>"><img width="226" src="<?php echo osc_current_web_theme_url('images/logo.png')?>" alt="Logo Here" class="logo"/></a> 
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
			 <form action="<?php echo osc_base_url(true) ; ?>" method="get" class="search nocsrf" <?php /* onsubmit="javascript:return doSearch();"*/ ?>>
				<input type="hidden" name="page" value="search" />
            	<div class="input_outer_area">
                	   <input type="text" name="sPattern" id="query" class="input-text" value="" placeholder="<?php echo osc_get_preference('keyword_placeholder', 'bender') ; ?>" />
                   <?php osc_categories_select('sCategory', null, __('Select a category', 'bender_black')) ; ?>
                    <div class="clear"></div>
                </div>
				
                <input type="submit" class="search_btn ui-button ui-button-big js-submit" value="Search" />
                <div class="clear"></div>
               </form>
            </div>
        </section>
</article>
	<div id="home" class="div-cont" >
		
			<?php osc_run_hook('inside-main'); ?>
		

			<?php osc_run_hook('home-content'); ?>
	</div>
	<?php osc_run_hook('product');?>
	<?php osc_run_hook('login-content');?>
	<?php osc_run_hook('contact-content');?>
	