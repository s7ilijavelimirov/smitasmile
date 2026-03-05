<?php
/**
 * Slide Push Menu NavWalker
 * Custom Walker for the slide push navigation menu
 * @package smitasmile
 */

class Slide_Push_Menu_Walker extends Walker_Nav_Menu {

	/**
	 * Start Level - Submenu
	 */
	public function start_lvl(&$output, $depth = 0, $args = null) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n{$indent}<ul class=\"slide-push-menu__submenu\">\n";
	}

	/**
	 * End Level
	 */
	public function end_lvl(&$output, $depth = 0, $args = null) {
		$indent = str_repeat("\t", $depth);
		$output .= "{$indent}</ul>\n";
	}

	/**
	 * Start Element (Menu Item)
	 */
	public function start_el(&$output, $item, $depth = 0, $args = null, $id = 0) {
		$indent = str_repeat("\t", $depth);

		// Check if item has children
		$has_children = !empty($item->classes) && in_array('menu-item-has-children', $item->classes);

		// Build classes for li
		$li_classes = array();
		if ($depth === 0) {
			$li_classes[] = 'slide-push-menu__item';
			if ($has_children) {
				$li_classes[] = 'has-submenu';
			}
		} else {
			$li_classes[] = 'slide-push-menu__subitem';
		}

		// Check for current item
		if (in_array('current-menu-item', $item->classes)) {
			$li_classes[] = 'current';
		}

		$li_class_string = implode(' ', $li_classes);
		$output .= "{$indent}<li class=\"{$li_class_string}\">";

		// Build link classes
		$link_classes = array();
		if ($depth === 0) {
			$link_classes[] = 'slide-push-menu__link';
		} else {
			$link_classes[] = 'slide-push-menu__sublink';
		}

		if (in_array('current-menu-item', $item->classes)) {
			$link_classes[] = 'active';
		}

		$link_class_string = implode(' ', $link_classes);

		// Build link attributes
		$attributes = '';
		$attributes .= !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
		$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
		$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';

		// For parent items with children, use # as href to prevent navigation
		if ($has_children && $depth === 0) {
			$attributes .= ' href="#"';
			$attributes .= ' aria-expanded="false"';
		} else {
			$attributes .= !empty($item->url) ? ' href="' . esc_url($item->url) . '"' : '';
		}

		$title = apply_filters('the_title', $item->title, $item->ID);
		$title = apply_filters('nav_menu_item_title', $title, $item, $args, $depth);

		// Build link HTML
		$output .= '<a class="' . esc_attr($link_class_string) . '"' . $attributes . '>';
		$output .= $title;

		// Add chevron icon for items with children (only at depth 0)
		if ($has_children && $depth === 0) {
			$output .= '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><polyline points="6 9 12 15 18 9"></polyline></svg>';
		}

		$output .= '</a>';
	}

	/**
	 * End Element
	 */
	public function end_el(&$output, $item, $depth = 0, $args = null) {
		$output .= "</li>\n";
	}
}
