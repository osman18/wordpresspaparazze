<?php

/***** Add CSS classes to body tag *****/

if (!function_exists('mh_magazine_lite_body_class')) {
	function mh_magazine_lite_body_class($classes) {
		$mh_magazine_lite_options = mh_magazine_lite_theme_options();
		$classes[] = 'mh-' . $mh_magazine_lite_options['sb_position'] . '-sb';
		return $classes;
	}
}
add_filter('body_class', 'mh_magazine_lite_body_class');

/***** Add HTML markup for main site container *****/

if (!function_exists('mh_magazine_boxed_container_open')) {
	function mh_magazine_boxed_container_open() {
		echo '<div class="mh-container mh-container-outer">' . "\n";
	}
}
add_action('mh_before_header', 'mh_magazine_boxed_container_open');

if (!function_exists('mh_magazine_boxed_container_close')) {
	function mh_magazine_boxed_container_close() {
		mh_before_container_close();
		echo '</div><!-- .mh-container-outer -->' . "\n";
	}
}
add_action('mh_after_footer', 'mh_magazine_boxed_container_close');

/***** Custom Header *****/

if (!function_exists('mh_magazine_lite_custom_header')) {
	function mh_magazine_lite_custom_header() {
		echo '<div class="mh-custom-header clearfix">' . "\n";
			if (get_header_image()) {
				echo '<a class="mh-header-image-link" href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" rel="home">' . "\n";
					echo '<img class="mh-header-image" src="' . esc_url(get_header_image()) . '" height="' . esc_attr(get_custom_header()->height) . '" width="' . esc_attr(get_custom_header()->width) . '" alt="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";
				echo '</a>' . "\n";
			}
			if (function_exists('has_custom_logo') && has_custom_logo() || display_header_text()) {
				echo '<div class="mh-site-identity">' . "\n";
					echo '<div class="mh-site-logo" role="banner" itemscope="itemscope" itemtype="http://schema.org/Brand">' . "\n";
						if (function_exists('the_custom_logo')) {
							the_custom_logo();
						}
						if (display_header_text()) {
							if (get_header_textcolor() != get_theme_support('custom-header', 'default-text-color')) {
								echo '<style type="text/css" id="mh-header-css">';
									echo '.mh-header-title, .mh-header-tagline { color: #' . esc_attr(get_header_textcolor()) . '; }';
								echo '</style>' . "\n";
							}
							echo '<div class="mh-header-text">' . "\n";
								if (is_front_page()) {
									$header_title_before = '<h1 class="mh-header-title">';
									$header_title_after = '</h1>' . "\n";
									$header_tagline_before = '<h2 class="mh-header-tagline">';
									$header_tagline_after = '</h2>' . "\n";
								} else {
									$header_title_before = '<h2 class="mh-header-title">';
									$header_title_after = '</h2>' . "\n";
									$header_tagline_before = '<h3 class="mh-header-tagline">';
									$header_tagline_after = '</h3>' . "\n";
								}
								echo '<a class="mh-header-text-link" href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name')) . '" rel="home">' . "\n";
									if (get_bloginfo('name')) {
										echo $header_title_before . esc_attr(get_bloginfo('name')) . $header_title_after;
									}
									if (get_bloginfo('description')) {
										echo $header_tagline_before . esc_attr(get_bloginfo('description')) . $header_tagline_after;
									}
								echo '</a>' . "\n";
							echo '</div>' . "\n";
						}
					echo '</div>' . "\n";
				echo '</div>' . "\n";
			}
		echo '</div>' . "\n";
	}
}

/***** Modify Prefix of Titles on Archives *****/

if (!function_exists('mh_magazine_lite_archive_title_prefix')) {
	function mh_magazine_lite_archive_title_prefix($title) {
		if (is_category()) {
            $title = single_cat_title('', false);
        } elseif (is_tag()) {
            $title = single_tag_title('', false);
        } elseif (is_author()) {
	        $title = sprintf(esc_html__('Articles by %s', 'mh-magazine-lite'), '<span class="vcard">' . get_the_author() . '</span>');
        }
		return $title;
	}
}
add_filter('get_the_archive_title', 'mh_magazine_lite_archive_title_prefix');

/***** Display Posts on Archives *****/

if (!function_exists('mh_magazine_lite_loop_layout')) {
	function mh_magazine_lite_loop_layout() {
		while (have_posts()) : the_post();
			get_template_part('content', 'loop');
		endwhile;
	}
}

/***** Post Meta *****/

if (!function_exists('mh_magazine_lite_post_meta')) {
	function mh_magazine_lite_post_meta() {
		echo '<p class="mh-meta entry-meta">' . "\n";
			echo '<span class="entry-meta-date updated"><i class="fa fa-clock-o"></i><a href="' . esc_url(get_month_link(get_the_time('Y'), get_the_time('m'))) . '">' . get_the_date() . '</a></span>' . "\n";
			echo '<span class="entry-meta-author author vcard"><i class="fa fa-user"></i><a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>' . "\n";
			echo '<span class="entry-meta-categories"><i class="fa fa-folder-open-o"></i>' . get_the_category_list(', ', '') . '</span>' . "\n";
			echo '<span class="entry-meta-comments"><i class="fa fa-comment-o"></i><a class="mh-comment-scroll" href="' . esc_url(get_permalink() . '#mh-comments') . '">' . get_comments_number() . '</a></span>' . "\n";
		echo '</p>' . "\n";
	}
}
add_action('mh_post_header', 'mh_magazine_lite_post_meta');

/***** Post Meta (Loop) *****/

if (!function_exists('mh_magazine_lite_loop_meta')) {
	function mh_magazine_lite_loop_meta() {
		echo '<span class="mh-meta-date updated"><i class="fa fa-clock-o"></i>' . get_the_date() . '</span>' . "\n";
		if (in_the_loop()) {
			echo '<span class="mh-meta-author author vcard"><i class="fa fa-user"></i><a class="fn" href="' . esc_url(get_author_posts_url(get_the_author_meta('ID'))) . '">' . esc_html(get_the_author()) . '</a></span>' . "\n";
		}
		echo '<span class="mh-meta-comments"><i class="fa fa-comment-o"></i>';
			mh_magazine_lite_comment_count();
		echo '</span>' . "\n";
	}
}

/***** Featured Image on Posts *****/

if (!function_exists('mh_magazine_lite_featured_image')) {
	function mh_magazine_lite_featured_image() {
		global $page, $post;
		if (has_post_thumbnail() && $page == '1' && !is_attachment()) {
			$thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(), 'mh-magazine-lite-content');
			echo "\n" . '<figure class="entry-thumbnail">' . "\n";
				echo '<img src="' . esc_url($thumbnail[0]) . '" alt="' . esc_attr(get_post_meta(get_post_thumbnail_id(), '_wp_attachment_image_alt', true)) . '" title="' . esc_attr(get_post(get_post_thumbnail_id())->post_title) . '" />' . "\n";
				if (get_post(get_post_thumbnail_id())->post_excerpt) {
					echo '<figcaption class="wp-caption-text">' . wp_kses_post(get_post(get_post_thumbnail_id())->post_excerpt) . '</figcaption>' . "\n";
				}
			echo '</figure>' . "\n";
		}
	}
}

/***** Author box *****/

if (!function_exists('mh_magazine_lite_author_box')) {
	function mh_magazine_lite_author_box() {
		$mh_magazine_lite_options = mh_magazine_lite_theme_options();
		$mh_author_box_ID = get_the_author_meta('ID');
		if ($mh_magazine_lite_options['author_box'] == 'enable' && get_the_author_meta('description', $mh_author_box_ID) && !is_attachment()) {
			get_template_part('content', 'author-box');
		}
	}
}
add_action('mh_after_post_content', 'mh_magazine_lite_author_box');

/***** Post / Attachment Navigation *****/

if (!function_exists('mh_magazine_lite_postnav')) {
	function mh_magazine_lite_postnav() {
		$mh_magazine_lite_options = mh_magazine_lite_theme_options();
		if ($mh_magazine_lite_options['post_nav'] === 'enable') {
			global $post;
			$parent_post = get_post($post->post_parent);
			$attachment = is_attachment();
			$prev_post = get_previous_post();
			$next_post = get_next_post();
			if (!empty($prev_post) || !empty($next_post) || $attachment) {
				echo '<nav class="mh-post-nav mh-row clearfix" itemscope="itemscope" itemtype="http://schema.org/SiteNavigationElement">' . "\n";
					if (!empty($prev_post) || $attachment) {
						echo '<div class="mh-col-1-2 mh-post-nav-item mh-post-nav-prev">' . "\n";
							if ($attachment) {
								if (wp_attachment_is_image()) {
									$attachments = get_children(array('post_type' => 'attachment', 'post_mime_type' => 'image', 'post_parent' => $parent_post->ID));
									$count = count($attachments);
									if ($count == 1) {
										echo '<a href="' . esc_url(get_permalink($parent_post)) . '">' . '<span>' . esc_html__('Back to article', 'mh-magazine-lite') . '</span>' . '</a>';
									} else {
										previous_image_link('%link', '<span>' . esc_html__('Previous', 'mh-magazine-lite') . '</span>');
									}
								} else {
									echo '<a href="' . esc_url(get_permalink($parent_post)) . '">' . '<span>' . esc_html__('Back to article', 'mh-magazine-lite') . '</span>' . '</a>';
								}
							} else {
								$prev_thumb = get_the_post_thumbnail($prev_post->ID, 'mh-magazine-lite-small');
								previous_post_link('%link', $prev_thumb . '<span>' . esc_html__('Previous', 'mh-magazine-lite') . '</span>' . '<p>%title</p>');
							}
						echo '</div>' . "\n";
					}
					if (!empty($next_post) || $attachment) {
						echo '<div class="mh-col-1-2 mh-post-nav-item mh-post-nav-next">' . "\n";
							if ($attachment) {
								next_image_link('%link', '<span>' . esc_html__('Next', 'mh-magazine-lite') . '</span>');
							} else {
								$next_thumb = get_the_post_thumbnail($next_post->ID, 'mh-magazine-lite-small');
								next_post_link('%link', $next_thumb . '<span>' . esc_html__('Next', 'mh-magazine-lite') . '</span>' . '<p>%title</p>');
							}
						echo '</div>' . "\n";
					}
				echo '</nav>' . "\n";
			}
		}
	}
}
add_action('mh_after_post_content', 'mh_magazine_lite_postnav');

/***** Custom Excerpts *****/

if (!function_exists('mh_magazine_lite_excerpt_length')) {
	function mh_magazine_lite_excerpt_length($length) {
		$mh_magazine_lite_options = mh_magazine_lite_theme_options();
		$excerpt_length = absint($mh_magazine_lite_options['excerpt_length']);
		return $excerpt_length;
	}
}
add_filter('excerpt_length', 'mh_magazine_lite_excerpt_length', 999);

if (!function_exists('mh_magazine_lite_excerpt_more')) {
	function mh_magazine_lite_excerpt_more($more) {
		global $post;
		$mh_magazine_lite_options = mh_magazine_lite_theme_options();
		return ' <a class="mh-excerpt-more" href="' . esc_url(get_permalink($post->ID)) . '" title="' . the_title_attribute('echo=0') . '">' . esc_attr($mh_magazine_lite_options['excerpt_more']) . '</a>';
	}
}
add_filter('excerpt_more', 'mh_magazine_lite_excerpt_more');

if (!function_exists('mh_magazine_lite_excerpt_markup')) {
	function mh_magazine_lite_excerpt_markup($excerpt) {
		$markup = '<div class="mh-excerpt">' . $excerpt . '</div>';
		return $markup;
	}
}
add_filter('the_excerpt', 'mh_magazine_lite_excerpt_markup');

/***** Custom Commentlist *****/

if (!function_exists('mh_magazine_lite_comments')) {
	function mh_magazine_lite_comments($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment; ?>
		<li id="comment-<?php comment_ID() ?>" <?php comment_class('mh-comment-item'); ?>>
			<article id="div-comment-<?php comment_ID(); ?>" class="mh-comment-body">
				<footer class="mh-comment-footer clearfix">
					<figure class="mh-comment-gravatar">
						<?php echo get_avatar($comment->comment_author_email, 80); ?>
					</figure>
					<div class="mh-meta mh-comment-meta">
						<div class="vcard author mh-comment-meta-author">
							<span class="fn"><?php echo get_comment_author_link(); ?></span>
						</div>
						<a class="mh-comment-meta-date" href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>">
							<?php printf(esc_html__('%1$s at %2$s', 'mh-magazine-lite'), get_comment_date(),  get_comment_time()); ?>
						</a>
					</div>
				</footer>
				<?php if ($comment->comment_approved == '0') { ?>
					<div class="mh-comment-info">
						<?php esc_html_e('Your comment is awaiting moderation.', 'mh-magazine-lite') ?>
					</div>
				<?php } ?>
				<div class="entry-content mh-comment-content">
					<?php comment_text() ?>
				</div>
				<div class="mh-meta mh-comment-meta-links"><?php
					edit_comment_link(esc_html__('Edit', 'mh-magazine-lite'), '  ', '');
					if (comments_open() && $args['max_depth'] != $depth) {
						comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth'])));
					} ?>
                </div>
			</article><?php
	}
}

/***** Custom Comment Fields *****/

if (!function_exists('mh_magazine_lite_comment_fields')) {
	function mh_magazine_lite_comment_fields($fields) {
		$commenter = wp_get_current_commenter();
		$req = get_option('require_name_email');
		$aria_req = ($req ? " aria-required='true'" : '');
		$fields =  array(
			'author'	=>	'<p class="comment-form-author"><label for="author">' . esc_html__('Name ', 'mh-magazine-lite') . '</label>' . ($req ? '<span class="required">*</span>' : '') . '<br/><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30"' . $aria_req . ' /></p>',
			'email' 	=>	'<p class="comment-form-email"><label for="email">' . esc_html__('Email ', 'mh-magazine-lite') . '</label>' . ($req ? '<span class="required">*</span>' : '' ) . '<br/><input id="email" name="email" type="text" value="' . esc_attr($commenter['comment_author_email']) . '" size="30"' . $aria_req . ' /></p>',
			'url' 		=>	'<p class="comment-form-url"><label for="url">' . esc_html__('Website', 'mh-magazine-lite') . '</label><br/><input id="url" name="url" type="text" value="' . esc_attr($commenter['comment_author_url']) . '" size="30" /></p>'
		);
		return $fields;
	}
}
add_filter('comment_form_default_fields', 'mh_magazine_lite_comment_fields');

/***** Comment Count Output *****/

if (!function_exists('mh_magazine_lite_comment_count')) {
	function mh_magazine_lite_comment_count() {
		echo '<a class="mh-comment-count-link" href="' . esc_url(get_permalink() . '#mh-comments') . '">' . get_comments_number() . '</a>';
	}
}

/***** Pagination *****/

if (!function_exists('mh_magazine_lite_pagination')) {
	function mh_magazine_lite_pagination() {
		global $wp_query;
	    $big = 9999;
	    $paginate_links = paginate_links(array(
	    	'base' 		=> str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
	    	'format' 	=> '?paged=%#%',
	    	'current' 	=> max(1, get_query_var('paged')),
	    	'prev_next' => true,
	    	'prev_text' => esc_html__('&laquo;', 'mh-magazine-lite'),
	    	'next_text' => esc_html__('&raquo;', 'mh-magazine-lite'),
	    	'total' 	=> $wp_query->max_num_pages)
	    );
		if ($paginate_links) {
	    	echo '<div class="mh-loop-pagination clearfix">';
				echo $paginate_links;
			echo '</div>';
		}
	}
}

/***** Pagination for paginated Posts *****/

if (!function_exists('mh_magazine_lite_paginated_posts')) {
	function mh_magazine_lite_paginated_posts($content) {
		if (is_singular() && in_the_loop()) {
			$content .= wp_link_pages(array('before' => '<div class="pagination clearfix">', 'after' => '</div>', 'link_before' => '<span class="pagelink">', 'link_after' => '</span>', 'nextpagelink' => __('&raquo;', 'mh-magazine-lite'), 'previouspagelink' => __('&laquo;', 'mh-magazine-lite'), 'pagelink' => '%', 'echo' => 0));
		}
		return $content;
	}
}
add_filter('the_content', 'mh_magazine_lite_paginated_posts', 1);

/***** Modify Appearance of WP Tag Cloud Widget *****/

if (!function_exists('mh_magazine_lite_custom_tag_cloud')) {
	function mh_magazine_lite_custom_tag_cloud($args) {
		$args['smallest'] = 12;
		$args['largest'] = 12;
		$args['unit'] = 'px';
		return $args;
	}
}
add_filter('widget_tag_cloud_args', 'mh_magazine_lite_custom_tag_cloud');

/***** Add Featured Image Size to Media Gallery Selection *****/

if (!function_exists('mh_magazine_lite_media_selection')) {
	function mh_magazine_lite_media_selection($sizes) {
		$custom_sizes = array('mh-magazine-lite-content' => 'Featured Image');
		return array_merge($sizes, $custom_sizes);
	}
}
add_filter('image_size_names_choose', 'mh_magazine_lite_media_selection');

/***** Add CSS3 Media Queries Support for older versions of IE *****/

function mh_magazine_lite_media_queries() {
	echo '<!--[if lt IE 9]>' . "\n";
	echo '<script src="' . get_template_directory_uri() . '/js/css3-mediaqueries.js"></script>' . "\n";
	echo '<![endif]-->' . "\n";
}
add_action('wp_head', 'mh_magazine_lite_media_queries');

?>