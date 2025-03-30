<?php

/**
 * Custom template tags for this theme
 *
 * @package ecommerce_online_store
 */

if ( ! function_exists( 'ecommerce_online_store_posted_on_single' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time on single posts.
     */
    function ecommerce_online_store_posted_on_single() {
        if ( get_theme_mod( 'ecommerce_online_store_single_post_hide_date', true ) ) {
            $ecommerce_online_store_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                $ecommerce_online_store_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }
    
            $ecommerce_online_store_time_string = sprintf(
                $ecommerce_online_store_time_string,
                esc_attr( get_the_date( DATE_W3C ) ),
                esc_html( get_the_date() ),
                esc_attr( get_the_modified_date( DATE_W3C ) ),
                esc_html( get_the_modified_date() )
            );
    
            $ecommerce_online_store_posted_on = '<span class="post-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="far fa-clock"></i>' . $ecommerce_online_store_time_string . '</a></span>';
    
            echo $ecommerce_online_store_posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'ecommerce_online_store_posted_on' ) ) :
    /**
     * Prints HTML with meta information for the current post-date/time.
     */
    function ecommerce_online_store_posted_on() {
        if ( get_theme_mod( 'ecommerce_online_store_post_hide_date', true ) ) {
            $ecommerce_online_store_time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
            if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
                $ecommerce_online_store_time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
            }

            $ecommerce_online_store_time_string = sprintf(
                $ecommerce_online_store_time_string,
                esc_attr( get_the_date( DATE_W3C ) ),
                esc_html( get_the_date() ),
                esc_attr( get_the_modified_date( DATE_W3C ) ),
                esc_html( get_the_modified_date() )
            );

            $ecommerce_online_store_posted_on = '<span class="post-date"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark"><i class="far fa-clock"></i>' . $ecommerce_online_store_time_string . '</a></span>';

            echo $ecommerce_online_store_posted_on; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;


if ( ! function_exists( 'ecommerce_online_store_posted_by_single' ) ) :
    /**
     * Prints HTML with meta information for the current author on single posts.
     */
    function ecommerce_online_store_posted_by_single() {
        if ( get_theme_mod( 'ecommerce_online_store_single_post_hide_author', true ) ) {
            $ecommerce_online_store_byline = '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fas fa-user"></i>' . esc_html( get_the_author() ) . '</a>';

            echo '<span class="post-author"> ' . $ecommerce_online_store_byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'ecommerce_online_store_posted_by' ) ) :
    /**
     * Prints HTML with meta information for the current author.
     */
    function ecommerce_online_store_posted_by() {
        if ( get_theme_mod( 'ecommerce_online_store_post_hide_author', true ) ) {
            $ecommerce_online_store_byline = '<a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '"><i class="fas fa-user"></i>' . esc_html( get_the_author() ) . '</a>';

            echo '<span class="post-author"> ' . $ecommerce_online_store_byline . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'ecommerce_online_store_posted_comments_single' ) ) :
    /**
     * Prints HTML with meta information for the current comment count on single posts.
     */
    function ecommerce_online_store_posted_comments_single() {
        if ( get_theme_mod( 'ecommerce_online_store_single_post_hide_comments', true ) ) {
            $ecommerce_online_store_comment_count = get_comments_number();
            $ecommerce_online_store_comment_text  = sprintf(
                /* translators: %s: comment count */
                _n( '%s Comment', '%s Comments', $ecommerce_online_store_comment_count, 'ecommerce-online-store' ),
                number_format_i18n( $ecommerce_online_store_comment_count )
            );

            echo '<span class="post-comments"><i class="fas fa-comments"></i> ' . esc_html( $ecommerce_online_store_comment_text ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'ecommerce_online_store_posted_comments' ) ) :
    /**
     * Prints HTML with meta information for the current comment count.
     */
    function ecommerce_online_store_posted_comments() {
        if ( get_theme_mod( 'ecommerce_online_store_post_hide_comments', true ) ) {
            $ecommerce_online_store_comment_count = get_comments_number();
            $ecommerce_online_store_comment_text  = sprintf(
                /* translators: %s: comment count */
                _n( '%s Comment', '%s Comments', $ecommerce_online_store_comment_count, 'ecommerce-online-store' ),
                number_format_i18n( $ecommerce_online_store_comment_count )
            );

            echo '<span class="post-comments"><i class="fas fa-comments"></i> ' . esc_html( $ecommerce_online_store_comment_text ) . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'ecommerce_online_store_posted_time_single' ) ) :
    /**
     * Prints HTML with meta information for the current post time on single posts.
     */
    function ecommerce_online_store_posted_time_single() {
        if ( get_theme_mod( 'ecommerce_online_store_single_post_hide_time', true ) ) {
            $ecommerce_online_store_posted_on = sprintf(
                /* translators: %s: post time */
                esc_html__( 'Posted at %s', 'ecommerce-online-store' ),
                '<a href="' . esc_url( get_permalink() ) . '"><time datetime="' . esc_attr( get_the_time( 'c' ) ) . '">' . esc_html( get_the_time() ) . '</time></a>'
            );

            echo '<span class="post-time"><i class="fas fa-clock"></i> ' . $ecommerce_online_store_posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

if ( ! function_exists( 'ecommerce_online_store_posted_time' ) ) :
    /**
     * Prints HTML with meta information for the current post time.
     */
    function ecommerce_online_store_posted_time() {
        if ( get_theme_mod( 'ecommerce_online_store_post_hide_time', true ) ) {
            $ecommerce_online_store_posted_on = sprintf(
                /* translators: %s: post time */
                esc_html__( 'Posted at %s', 'ecommerce-online-store' ),
                '<a href="' . esc_url( get_permalink() ) . '"><time datetime="' . esc_attr( get_the_time( 'c' ) ) . '">' . esc_html( get_the_time() ) . '</time></a>'
            );

            echo '<span class="post-time"><i class="fas fa-clock"></i> ' . $ecommerce_online_store_posted_on . '</span>'; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
            return;
        }
    }
endif;

	/**
	 * Prints HTML with meta information for the categories.
	 */

if ( ! function_exists( 'ecommerce_online_store_categories_single_list' ) ) :
    function ecommerce_online_store_categories_single_list( $ecommerce_online_store_with_background = false ) {
        if ( is_singular( 'post' ) ) {
            $ecommerce_online_store_hide_category = get_theme_mod( 'ecommerce_online_store_single_post_hide_category', true );

            if ( $ecommerce_online_store_hide_category ) {
                $ecommerce_online_store_categories = get_the_category();
                $ecommerce_online_store_separator  = '';
                $ecommerce_online_store_output     = '';
                if ( ! empty( $ecommerce_online_store_categories ) ) {
                    foreach ( $ecommerce_online_store_categories as $ecommerce_online_store_category ) {
                        $ecommerce_online_store_output .= '<a href="' . esc_url( get_category_link( $ecommerce_online_store_category->term_id ) ) . '">' . esc_html( $ecommerce_online_store_category->name ) . '</a>' . $ecommerce_online_store_separator;
                    }
                    echo trim( $ecommerce_online_store_output, $ecommerce_online_store_separator );
                }
            }
        }
    }
endif;

if ( ! function_exists( 'ecommerce_online_store_categories_list' ) ) :
    function ecommerce_online_store_categories_list( $ecommerce_online_store_with_background = false ) {
        $ecommerce_online_store_hide_category = get_theme_mod( 'ecommerce_online_store_post_hide_category', true );

        if ( $ecommerce_online_store_hide_category ) {
            $ecommerce_online_store_categories = get_the_category();
            $ecommerce_online_store_separator  = '';
            $ecommerce_online_store_output     = '';
            if ( ! empty( $ecommerce_online_store_categories ) ) {
                foreach ( $ecommerce_online_store_categories as $ecommerce_online_store_category ) {
                    $ecommerce_online_store_output .= '<a href="' . esc_url( get_category_link( $ecommerce_online_store_category->term_id ) ) . '">' . esc_html( $ecommerce_online_store_category->name ) . '</a>' . $ecommerce_online_store_separator;
                }
                echo trim( $ecommerce_online_store_output, $ecommerce_online_store_separator );
            }
        }
    }
endif;

if ( ! function_exists( 'ecommerce_online_store_entry_footer' ) ) :
	/**
	 * Prints HTML with meta information for the tags and comments.
	 */
	function ecommerce_online_store_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() && is_singular() ) {
			$ecommerce_online_store_hide_tag = get_theme_mod( 'ecommerce_online_store_post_hide_tags', true );

			if ( $ecommerce_online_store_hide_tag ) {
				/* translators: used between list items, there is a space after the comma */
				$ecommerce_online_store_tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', 'ecommerce-online-store' ) );
				if ( $ecommerce_online_store_tags_list ) {
					/* translators: 1: list of tags. */
					printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', 'ecommerce-online-store' ) . '</span>', $ecommerce_online_store_tags_list ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				}
			}
		}

		edit_post_link(
			sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Edit <span class="screen-reader-text">%s</span>', 'ecommerce-online-store' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				wp_kses_post( get_the_title() )
			),
			'<span class="edit-link">',
			'</span>'
		);
	}
endif;


if ( ! function_exists( 'ecommerce_online_store_post_thumbnail' ) ) :
    /**
     * Display the post thumbnail.
     */
    function ecommerce_online_store_post_thumbnail() {
        // Return early if the post is password protected, an attachment, or does not have a post thumbnail.
        if ( post_password_required() || is_attachment() ) {
            return;
        }

        // Display post thumbnail for singular views.
        if ( is_singular() ) :
            // Check theme setting to hide the featured image in single posts.
            if ( get_theme_mod( 'ecommerce_online_store_single_post_hide_feature_image', false ) ) {
                return;
            }
            ?>
            <div class="post-thumbnail">
                <?php 
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail(); 
                } else {
                    // URL of the default image
                    $ecommerce_online_store_default_image_url = get_template_directory_uri() . '/resource/img/default.png';
                    echo '<img src="' . esc_url( $ecommerce_online_store_default_image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                }
                ?>
            </div><!-- .post-thumbnail -->
        <?php else :
            // Check theme setting to hide the featured image in non-singular posts.
            if ( !get_theme_mod( 'ecommerce_online_store_post_hide_feature_image', true ) ) {
                return;
            }
            ?>
            <a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true">
                <?php
                if ( has_post_thumbnail() ) {
                    the_post_thumbnail(
                        'post-thumbnail',
                        array(
                            'alt' => the_title_attribute(
                                array(
                                    'echo' => false,
                                )
                            ),
                        )
                    );
                } else {
                    // URL of the default image
                    $ecommerce_online_store_default_image_url = get_template_directory_uri() . '/resource/img/default.png';
                    echo '<img src="' . esc_url( $ecommerce_online_store_default_image_url ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                }
                ?>
            </a>
        <?php endif; // End is_singular().
    }
endif;

if ( ! function_exists( 'wp_body_open' ) ) :
	function wp_body_open() {
		do_action( 'wp_body_open' );
	}
endif;