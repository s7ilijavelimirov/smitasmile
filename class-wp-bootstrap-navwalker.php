<?php
/**
 * WP Bootstrap NavWalker za Bootstrap 5.3.8
 * @package smitasmile
 */

class WP_Bootstrap_NavWalker extends Walker_Nav_Menu {

	/**
	 * Start Level
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$indent = '';
		} else {
			$indent = "\n" . str_repeat( "\t", $depth + 1 );
		}

		$classes = array( 'dropdown-menu' );
		
		if ( $depth > 0 ) {
			$classes[] = 'submenu';
		}

		$class_string = implode( ' ', $classes );
		$output .= "{$indent}<ul class=\"{$class_string}\">\n";
	}

	/**
	 * Start Element (Menu Item)
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$indent = '';
		} else {
			$indent = "\n" . str_repeat( "\t", $depth + 1 );
		}

		$output .= $indent . '<li class="nav-item';

		// Dodaj 'dropdown' klasu ako je roditelj
		$has_children = ! empty( $item->classes ) && in_array( 'menu-item-has-children', $item->classes );
		if ( $has_children ) {
			$output .= ' dropdown';
		}

		$output .= '">';

		// Pripremi link
		$link_class = 'nav-link';
		$link_attrs = '';

		if ( $has_children ) {
			$link_class .= ' dropdown-toggle';
			$link_attrs = ' data-bs-toggle="dropdown" aria-expanded="false"';
		}

		// Active link
		if ( ! empty( $item->classes ) && in_array( 'current-menu-item', $item->classes ) ) {
			$link_class .= ' active';
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$output .= '<a class="' . esc_attr( $link_class ) . '" href="' . esc_url( $item->url ) . '"' . $link_attrs . '>';
		$output .= $title;
		$output .= '</a>';
	}

	/**
	 * End Element
	 */
	public function end_el( &$output, $item, $depth = 0, $args = null ) {
		$output .= "</li>\n";
	}

	/**
	 * End Level
	 */
	public function end_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$indent = '';
		} else {
			$indent = "\n" . str_repeat( "\t", $depth );
		}

		$output .= "{$indent}</ul>\n";
	}
}
?>