<?php
/**
 * WP Mobile NavWalker za mobilni meni
 * Sa nested submenu i BACK dugmetom
 * @package smitasmile
 */

class WP_Mobile_NavWalker extends Walker_Nav_Menu {

	/**
	 * Start Level - Kreira submenu kontejnere
	 */
	public function start_lvl( &$output, $depth = 0, $args = null ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$indent = '';
		} else {
			$indent = "\n" . str_repeat( "\t", $depth + 1 );
		}

		$classes = array( 'mobile-nav-menu', 'submenu-hidden' );
		
		// Kreiraj unique ID za svaki submenu
		$submenu_id = 'submenu-' . uniqid();
		
		$class_string = implode( ' ', $classes );
		$output .= "{$indent}<ul class=\"{$class_string}\" id=\"{$submenu_id}\">\n";
	}

	/**
	 * Start Element - Menu item sa deep-link atributima
	 */
	public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
		if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
			$indent = '';
		} else {
			$indent = "\n" . str_repeat( "\t", $depth + 1 );
		}

		$output .= $indent . '<li class="nav-item';

		// Proveri da li ima dece
		$has_children = ! empty( $item->classes ) && in_array( 'menu-item-has-children', $item->classes );
		if ( $has_children ) {
			$output .= ' has-submenu';
		}

		$output .= '">';

		// Pripremi link
		$link_class = 'mobile-nav-link';
		$link_attrs = '';

		if ( $has_children ) {
			$link_class .= ' has-submenu-trigger';
			// Pronađi i mapira na odgovarajući submenu
			$submenu_trigger = 'submenu-' . sanitize_title( $item->title );
			$link_attrs = ' data-submenu="' . esc_attr( $submenu_trigger ) . '"';
		}

		// Active link
		if ( ! empty( $item->classes ) && in_array( 'current-menu-item', $item->classes ) ) {
			$link_class .= ' active';
		}

		$title = apply_filters( 'the_title', $item->title, $item->ID );
		$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

		$output .= '<a class="' . esc_attr( $link_class ) . '" href="' . esc_url( $item->url ) . '"' . $link_attrs . '>';
		$output .= $title;
		if ( $has_children ) {
			$output .= '<span class="submenu-arrow">›</span>';
		}
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