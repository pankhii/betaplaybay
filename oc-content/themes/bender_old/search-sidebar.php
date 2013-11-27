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
     $category = __get("category");
     if(!isset($category['pk_i_id']) ) {
         $category['pk_i_id'] = null;
     }

?>
<aside class="refine">
<?php osc_alert_form(); ?> 
         <form action="<?php echo osc_base_url(true); ?>" method="get" class="nocsrf">
		 <input type="hidden" name="page" value="search"/>
        <input type="hidden" name="sOrder" value="<?php echo osc_search_order(); ?>" />
        <input type="hidden" name="iOrderType" value="<?php $allowedTypesForSorting = Search::getAllowedTypesForSorting() ; echo $allowedTypesForSorting[osc_search_order_type()]; ?>" />
        <?php foreach(osc_search_user() as $userId) { ?>
        <input type="hidden" name="sUser[]" value="<?php echo $userId; ?>"/>
        <?php } ?>
        <ul> 
            <li>
                <label><?php _e('Search', 'bender'); ?></label> 
                 <input class="input-text" type="text" name="sPattern"  id="query" value="<?php echo osc_esc_html(osc_search_pattern()); ?>" placeholder="Your Search Here"/> 
            </li>
            <li>
                <label><?php _e('City', 'bender'); ?></label>
                <input class="input-text" type="text" id="sCity" name="sCity" value="<?php echo osc_esc_html(osc_search_city()); ?>" placeholder="Enter City Here"/>
            </li>
			<?php if( osc_images_enabled_at_items() ) { ?>
            <li>
                <label><?php _e('Show only', 'bender') ; ?></label>
                <div class="list_picture">
                    <input type="checkbox" name="bPic" id="withPicture" value="1" <?php echo (osc_search_has_pic() ? 'checked' : ''); ?> />
                    <label for="picture">Listings with Picture</label>
               	</div>
            </li> 
			<?php }?>
            <li>
                <label>Price</label>
                <div class="range_slider"><img src="" alt=""></div>
                <span class="min_range">min</span>
                <span class="max_range">max</span>
            </li>
        </ul>
       <input type="submit" value="Appply" class="apply">
	   </form> 
       <div class="refine_category">
            <h1><?php _e('Refine category', 'bender') ; ?></h1>
            <?php bender_sidebar_category_search($category['pk_i_id']); ?>
       </div>
    </aside>