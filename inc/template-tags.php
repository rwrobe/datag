<?php
/**
 * Template tag(s) for Da Tag
 *
 * @package datag
 * @since 0.2
 */

/**
 * Get the tag and return it escaped but unformatted.
 *
 * This can only be used inside the loop.
 *
 * @return string   The highlighted tag
 */
if ( ! function_exists( 'datag_get_tag' ) ) :
	function datag_get_tag() {

		global $post;

		$datag = get_post_meta( $post->ID, '_datag_highlighted_tag', true );

		return esc_attr( $datag );

	}
endif;

/**
 * Print the highlighted tag
 *
 * This can only be used inside the loop.
 */
if ( ! function_exists( 'datag_the_tag' ) ) :
	function datag_the_tag() {

		global $post;

		$output = '';
		$datag = get_post_meta( $post->ID, '_datag_highlighted_tag', true );

		$output .= '<div class="datag"><h1>' . esc_attr( $datag ) . '</h1></div>';

		echo $output;

	}
endif;


?>