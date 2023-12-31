<?php
/**
 * Content Background - Dynamic CSS
 *
 * @package astra
 * @since 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

add_filter( 'astra_dynamic_theme_css', 'astra_content_background_css', 11 );

/**
 * Content Background - Dynamic CSS
 *
 * @param  string $dynamic_css          Astra Dynamic CSS.
 * @return String Generated dynamic CSS for content background.
 *
 * @since 3.2.0
 */
function astra_content_background_css( $dynamic_css ) {

	if ( ! astra_has_gcp_typo_preset_compatibility() ) {
		return $dynamic_css;
	}

	$content_bg_obj          = astra_get_option( 'content-bg-obj-responsive' );
	$blog_layout             = astra_get_option( 'blog-layout' );
	$blog_grid               = astra_get_option( 'blog-grid' );
	$sidebar_default_css     = $content_bg_obj;
	$is_boxed                = astra_is_content_style_boxed();
	$is_sidebar_boxed        = astra_is_sidebar_style_boxed();
	$current_layout          = astra_get_content_layout();
	$narrow_dynamic_selector = 'narrow-width-container' === $current_layout && $is_boxed ? ', .ast-narrow-container .site-content' : '';

	$author_box_extra_selector = ( true === astra_check_is_structural_setup() ) ? '.site-main' : '';

	// Apply unboxed container with sidebar boxed look by changing background color to site background color.
	$content_bg_obj = astra_apply_unboxed_container( $content_bg_obj, $is_boxed, $is_sidebar_boxed, $current_layout );

	// Container Layout Colors.
	$container_css = array(
		'.ast-separate-container .ast-article-single:not(.ast-related-post), .ast-separate-container .comments-area .comment-respond,.ast-separate-container .comments-area .ast-comment-list li, .woocommerce.ast-separate-container .ast-woocommerce-container, .ast-separate-container .error-404, .ast-separate-container .no-results, .single.ast-separate-container ' . esc_attr( $author_box_extra_selector ) . ' .ast-author-meta, .ast-separate-container .related-posts-title-wrapper,.ast-separate-container .comments-count-wrapper, .ast-box-layout.ast-plain-container .site-content,.ast-padded-layout.ast-plain-container .site-content, .ast-separate-container .comments-area .comments-title, .ast-separate-container .ast-archive-description' . $narrow_dynamic_selector => astra_get_responsive_background_obj( $content_bg_obj, 'desktop' ),
	);
	// Container Layout Colors.
	$container_css_tablet = array(
		'.ast-separate-container .ast-article-single:not(.ast-related-post), .ast-separate-container .comments-area .comment-respond,.ast-separate-container .comments-area .ast-comment-list li, .woocommerce.ast-separate-container .ast-woocommerce-container, .ast-separate-container .error-404, .ast-separate-container .no-results, .single.ast-separate-container ' . esc_attr( $author_box_extra_selector ) . ' .ast-author-meta, .ast-separate-container .related-posts-title-wrapper,.ast-separate-container .comments-count-wrapper, .ast-box-layout.ast-plain-container .site-content,.ast-padded-layout.ast-plain-container .site-content, .ast-separate-container .comments-area .comments-title, .ast-separate-container .ast-archive-description' . $narrow_dynamic_selector => astra_get_responsive_background_obj( $content_bg_obj, 'tablet' ),
	);

	// Container Layout Colors.
	$container_css_mobile = array(
		'.ast-separate-container .ast-article-single:not(.ast-related-post), .ast-separate-container .comments-area .comment-respond,.ast-separate-container .comments-area .ast-comment-list li, .woocommerce.ast-separate-container .ast-woocommerce-container, .ast-separate-container .error-404, .ast-separate-container .no-results, .single.ast-separate-container ' . esc_attr( $author_box_extra_selector ) . ' .ast-author-meta, .ast-separate-container .related-posts-title-wrapper,.ast-separate-container .comments-count-wrapper, .ast-box-layout.ast-plain-container .site-content,.ast-padded-layout.ast-plain-container .site-content, .ast-separate-container .comments-area .comments-title, .ast-separate-container .ast-archive-description' . $narrow_dynamic_selector => astra_get_responsive_background_obj( $content_bg_obj, 'mobile' ),
	);

	// Sidebar specific css.
	$sidebar_css = array(
		'.ast-separate-container.ast-two-container #secondary .widget' => astra_get_responsive_background_obj( $sidebar_default_css, 'desktop' ),
	);

	// Sidebar specific css.
	$sidebar_css_tablet = array(
		'.ast-separate-container.ast-two-container #secondary .widget' => astra_get_responsive_background_obj( $sidebar_default_css, 'tablet' ),
	);

	// Sidebar specific css.
	$sidebar_css_mobile = array(
		'.ast-separate-container.ast-two-container #secondary .widget' => astra_get_responsive_background_obj( $sidebar_default_css, 'mobile' ),
	);

	// Apply Content BG Color for Narrow Unboxed Container.
	if ( ! astra_is_content_style_boxed() ) {
		$container_css        = array_merge(
			$container_css,
			array( '.ast-narrow-container .site-content' => astra_get_responsive_background_obj( $content_bg_obj, 'desktop' ) ),
		);
		$container_css_tablet = array_merge(
			$container_css_tablet,
			array( '.ast-narrow-container .site-content' => astra_get_responsive_background_obj( $content_bg_obj, 'tablet' ) ),
		);
		$container_css_mobile = array_merge(
			$container_css_mobile,
			array( '.ast-narrow-container .site-content' => astra_get_responsive_background_obj( $content_bg_obj, 'mobile' ) ),
		);
	}


	// Blog Pro Layout Colors.
	if ( 'blog-layout-1' == $blog_layout && 1 != $blog_grid ) {
		$blog_layouts        = array(
			'.ast-separate-container .blog-layout-1, .ast-separate-container .blog-layout-2, .ast-separate-container .blog-layout-3' => astra_get_responsive_background_obj( $content_bg_obj, 'desktop' ),
		);
		$blog_layouts_tablet = array(
			'.ast-separate-container .blog-layout-1, .ast-separate-container .blog-layout-2, .ast-separate-container .blog-layout-3' => astra_get_responsive_background_obj( $content_bg_obj, 'tablet' ),
		);
		$blog_layouts_mobile = array(
			'.ast-separate-container .blog-layout-1, .ast-separate-container .blog-layout-2, .ast-separate-container .blog-layout-3' => astra_get_responsive_background_obj( $content_bg_obj, 'mobile' ),
		);
	} else {
		$blog_layouts        = array(
			'.ast-separate-container .ast-article-post' => astra_get_responsive_background_obj( $content_bg_obj, 'desktop' ),
		);
		$blog_layouts_tablet = array(
			'.ast-separate-container .ast-article-post' => astra_get_responsive_background_obj( $content_bg_obj, 'tablet' ),
		);
		$blog_layouts_mobile = array(
			'.ast-separate-container .ast-article-post' => astra_get_responsive_background_obj( $content_bg_obj, 'mobile' ),
		);
		$inner_layout        = array(
			'.ast-separate-container .blog-layout-1, .ast-separate-container .blog-layout-2, .ast-separate-container .blog-layout-3' => array(
				'background-color' => 'transparent',
				'background-image' => 'none',
			),
		);
		$dynamic_css        .= astra_parse_css( $inner_layout );
	}

	$dynamic_css .= astra_parse_css( $blog_layouts );
	/** @psalm-suppress InvalidArgument */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
	$dynamic_css .= astra_parse_css( $blog_layouts_tablet, '', astra_get_tablet_breakpoint() );
	/** @psalm-suppress InvalidArgument */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
	$dynamic_css .= astra_parse_css( $blog_layouts_mobile, '', astra_get_mobile_breakpoint() );
	$dynamic_css .= astra_parse_css( $container_css );
	/** @psalm-suppress InvalidArgument */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
	$dynamic_css .= astra_parse_css( $container_css_tablet, '', astra_get_tablet_breakpoint() );
	/** @psalm-suppress InvalidArgument */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
	$dynamic_css .= astra_parse_css( $container_css_mobile, '', astra_get_mobile_breakpoint() );
	$dynamic_css .= astra_parse_css( $sidebar_css );
	/** @psalm-suppress InvalidArgument */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
	$dynamic_css .= astra_parse_css( $sidebar_css_tablet, '', astra_get_tablet_breakpoint() );
	/** @psalm-suppress InvalidArgument */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
	$dynamic_css .= astra_parse_css( $sidebar_css_mobile, '', astra_get_mobile_breakpoint() );

	if ( astra_apply_content_background_fullwidth_layouts() ) {
		$fullwidth_layout        = array(
			'.ast-plain-container, .ast-page-builder-template' => astra_get_responsive_background_obj( $content_bg_obj, 'desktop' ),
		);
		$fullwidth_layout_tablet = array(
			'.ast-plain-container, .ast-page-builder-template' => astra_get_responsive_background_obj( $content_bg_obj, 'tablet' ),
		);
		$fullwidth_layout_mobile = array(
			'.ast-plain-container, .ast-page-builder-template' => astra_get_responsive_background_obj( $content_bg_obj, 'mobile' ),
		);

		$dynamic_css .= astra_parse_css( $fullwidth_layout );
		/** @psalm-suppress InvalidArgument */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
		$dynamic_css .= astra_parse_css( $fullwidth_layout_tablet, '', astra_get_tablet_breakpoint() );
		/** @psalm-suppress InvalidArgument */ // phpcs:ignore Generic.Commenting.DocComment.MissingShort
		$dynamic_css .= astra_parse_css( $fullwidth_layout_mobile, '', astra_get_mobile_breakpoint() );
	}

	return $dynamic_css;
}

/**
 * Applies an unboxed container to the content.
 *
 * @since 4.2.0
 * @param array $content_bg_obj The background object for the content.
 * @param bool  $is_boxed Container style is boxed or not.
 * @param bool  $is_sidebar_boxed Sidebar style is boxed or not.
 * @param mixed $current_layout The current container layout applied.
 * @return array $content_bg_obj The updated background object for the content.
 */
function astra_apply_unboxed_container( $content_bg_obj, $is_boxed, $is_sidebar_boxed, $current_layout ) {
	if ( 'plain-container' === $current_layout && ! $is_boxed && $is_sidebar_boxed ) {
		$content_bg_obj = astra_get_option( 'site-layout-outside-bg-obj-responsive' );
	}
	return $content_bg_obj;
}
