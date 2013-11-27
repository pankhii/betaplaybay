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
<footer>
	<p>&copy; Copyright 2012-2013, All Rights Reseverd,www.playandbay.com</p>
</footer>
 <div class="chose-langu">
	 <a class="search-btn" href="javascript:void(0)"></a>
	 <a class="rusiian-btn" href="#"><img src="<?php echo osc_current_web_theme_url('images/russian-flag.png');?>" alt=" "></a>
	 <a class="english-btn" href="#"><img src="<?php echo osc_current_web_theme_url('images/english-flag.png');?>" alt=" "></a>
 </div>
<script type="text/javascript" >
jQuery(document).ready(function(){
	jQuery.fn.goTo = function( $thiss ) {
        jQuery('html, body').animate({
	            scrollTop: parseInt(jQuery(this).offset().top-jQuery("header").height()) + 'px' //
	        }, 'slow');
	        return this; // for chaining...
       }
	jQuery("nav.navigation ul.nav > li > a").each(function(b,c){
		var div_Id = jQuery(this).attr("href");
		jQuery(div_Id).data({"index":b});
	});
	jQuery("nav.navigation ul.nav > li > a").click(function(e){
		e.preventDefault();
		var $this = jQuery(this);
		 jQuery("nav.navigation ul.nav > li").removeClass("current");
		 $this.closest("li").addClass("current");
		 /* setTimeout( function(){
			var current_menu = jQuery('nav.navigation ul.nav > li.current');
			var old_menu_index = current_menu.index();
			current_menu.removeClass("current");
			var new_menu_index = $this.parent("li").index();
			 alert(old_menu_index);
			 alert(new_menu_index);
			var time = new Array();
			var out_time = new Array();
			if(old_menu_index < new_menu_index){
				for(var k=old_menu_index; k < new_menu_index; k++){
					 time[k] = setTimeout(function(){
						jQuery('nav.navigation ul.nav > li').eq( k ).addClass("current");
					 },1000);
					 if(new_menu_index!=k){
						out_time[k] = setTimeout(function(){  
							jQuery('nav.navigation ul.nav > li').eq( k ).removeClass("current");
						},1500);
					}
				}
			}else{
				
			}
			
		 }, 100 ); */
		var link_to = jQuery(this).attr("href");
		var $thiss = jQuery(this);
		if(link_to=='#no'){
			jQuery("#home").goTo( $thiss );
		}else{
			jQuery(link_to).goTo( $thiss );
		}
		
	});
	jQuery("nav.navigation2 ul.nav > li > a").click(function(e){
		e.preventDefault();
		jQuery("nav.navigation ul.nav > li").removeClass("current");
		jQuery(this).closest("li").addClass("current");
		var link_to = jQuery(this).attr("href");
		var $thiss = jQuery(this);
		if(link_to=='#no'){
			jQuery("#home").goTo( $thiss );
		}else{
			jQuery(link_to).goTo( $thiss );
		}
	});
});


/*** Code to scroll and select menu starts here ***/

jQuery(window).scroll(function() {	
			jQuery('.div-cont').each(function(){
			 if(appeardd(jQuery(this))){
			  var $headers = $("header");
				var b =  jQuery(this).data("index");
				$headers.each(function(f, g){
					if( $(this).length > 0 ){
						var h = $(this).find("nav ul").children( "li" );
						h.removeClass("current");
						h.eq( b ).addClass("current");
					}
				});
				 
			 }
		   });
        });
		function appeardd($element){
		   var $window = jQuery(window);
			var window_left = $window.scrollLeft();
			var window_top = $window.scrollTop();
			var offset = $element.offset();
			var left = offset.left;
			var top = offset.top;

			if (top + $element.height() >= window_top &&
				top - ($element.data('appear-top-offset') || 0) <= window_top + $window.height() &&
				left + $element.width() >= window_left &&
				left - ($element.data('appear-left-offset') || 0) <= window_left + $window.width()) {
			  return true;
			} else {
			  return false;
			}
		}
/*** Code to scroll and select menu end here ***/
</script>
<?php osc_run_hook('footer'); ?>
</body></html>