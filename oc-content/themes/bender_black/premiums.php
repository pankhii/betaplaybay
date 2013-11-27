<!-- tryout premiums -->
<?php
osc_get_premiums();
if(osc_count_premiums() > 0) { ?>
<?php while(osc_has_premiums()) { ?>
<li class="listing-card <?php echo $class; ?>">
                <?php if( osc_images_enabled_at_items() ) { ?>
                    <?php if(osc_count_premium_resources()) { ?>
                        <a class="listing-thumb" href="<?php echo osc_premium_url() ; ?>" title="<?php echo osc_premium_title() ; ?>"><img src="<?php echo osc_resource_thumbnail_url(); ?>" title="" alt="<?php echo osc_premium_title() ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>"></a>
                    <?php } else { ?>
                        <a class="listing-thumb" href="<?php echo osc_premium_url() ; ?>" title="<?php echo osc_premium_title() ; ?>"><img src="<?php echo osc_current_web_theme_url('images/no_photo.gif'); ?>" title="" alt="<?php echo osc_premium_title() ; ?>" width="<?php echo $size[0]; ?>" height="<?php echo $size[1]; ?>"></a>
                    <?php } ?>
                <?php } ?>
                <div class="listing-detail">
                    <div class="listing-cell">
                        <div class="listing-data">
                            <div class="listing-basicinfo">
                                <a href="<?php echo osc_premium_url() ; ?>" class="title" title="<?php echo osc_premium_title() ; ?>"><?php echo osc_highlight( strip_tags( osc_premium_title() ) ); ?></a></span><span style="float:right;"><?php _e("Sponsored ad", "bender"); ?></span>
                                <div class="listing-attributes">
                                    <span class="category"><?php echo osc_premium_category() ; ?></span> -
                                    <span class="location"><?php echo osc_premium_city(); ?> (<?php echo osc_premium_region(); ?>)</span> <span class="g-hide">-</span> <?php echo osc_format_date(osc_premium_pub_date()); ?>
                                    <?php if( osc_price_enabled_at_items() ) { ?><span class="currency-value"><?php echo osc_format_price(osc_premium_price()); ?></span><?php } ?>
                                </div>
                                <p><?php echo osc_highlight( strip_tags( osc_premium_description()) ,250) ; ?></p>
                            </div>
                            <?php if($admin){ ?>
                                <span class="admin-options">
                                    <a href="<?php echo osc_premium_edit_url(); ?>" rel="nofollow"><?php _e('Edit premium', 'bender'); ?></a>
                                    <span>|</span>
                                    <a class="delete" onclick="javascript:return confirm('<?php echo osc_esc_js(__('This action can not be undone. Are you sure you want to continue?', 'bender')); ?>')" href="<?php echo osc_premium_delete_url();?>" ><?php _e('Delete', 'bender'); ?></a>
                                    <?php if(osc_premium_is_inactive()) {?>
                                    <span>|</span>
                                    <a href="<?php echo osc_premium_activate_url();?>" ><?php _e('Activate', 'bender'); ?></a>
                                    <?php } ?>
                                </span>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </li>
<?php } ?>
<?php } ?>
<!-- end of tryout -->