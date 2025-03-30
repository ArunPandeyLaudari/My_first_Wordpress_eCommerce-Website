<?php

/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package ecommerce_online_store
 */

?>

<aside id="secondary" class="widget-area">
	<?php dynamic_sidebar( 'sidebar-1' ); ?>
</aside>

<?php 
  if ( ! is_active_sidebar( 'sidebar-1' )) { ?>
	<aside id="secondary" class="widget-area">
		<section id="Search" class="widget widget_block widget_archive " >
		    <h2 class="widget-title"><?php esc_html_e('Search', 'ecommerce-online-store'); ?></h2>
		    <?php get_search_form(); ?>
		</section>
		<section id="archives" class="widget widget_block widget_archive " >
		    <h2 class="widget-title"><?php esc_html_e('Archives', 'ecommerce-online-store'); ?></h2>
		    <ul>
		        <?php
		        wp_get_archives(array(
		            'type'            => 'monthly',
		            'show_post_count' => true,
		        ));
		        ?>
		    </ul>
		</section>
		<section id="categories" class="widget widget_categories" role="complementary">
		    <h2 class="widget-title"><?php esc_html_e('Categories', 'ecommerce-online-store'); ?></h2>
		    <ul>
		        <?php
		        wp_list_categories(array(
		            'orderby'    => 'name',
		            'title_li'   => '',
		            'show_count' => true,
		        ));
		        ?>
		    </ul>
		</section>
		<section id="tags" class="widget widget_tag_cloud" role="complementary">
		    <h2 class="widget-title"><?php esc_html_e('Tags', 'ecommerce-online-store'); ?></h2>
		    <?php
				$ecommerce_online_store_tags = get_tags();
				if ($ecommerce_online_store_tags) {
				    echo '<div class="tag-cloud">';
				    foreach ($ecommerce_online_store_tags as $tag) {
				        $ecommerce_online_store_tag_link = get_tag_link($tag->term_id);
				        echo '<a href="' . esc_url($ecommerce_online_store_tag_link) . '" style="font-size:' . esc_attr($tag->font_size) . 'px;" class="tag-link">' . esc_html($tag->name) . '</a>';
				    }
				    echo '</div>';
				} else {
				    echo '<p>No tags found.</p>';
				}
			?>
		</section>
		<section id="recent-posts" class="widget" role="complementary">
		    <h2 class="widget-title"><?php esc_html_e('Recent Posts', 'ecommerce-online-store'); ?></h2>
		    <ul class="recent-posts-list">
		        <?php
		        $ecommerce_online_store_recent_posts = get_posts(array(
		            'numberposts' => 5, // Adjust the number of posts to display
		            'post_status' => 'publish',
		        ));

		        foreach ($ecommerce_online_store_recent_posts as $post) :
		            setup_postdata($post);
		            ?>
		            <li>
		                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
		            </li>
		            <?php
		        endforeach;
		        wp_reset_postdata();
		        ?>
		    </ul>
		</section>
	</aside><!-- #secondary -->
<?php } ?>