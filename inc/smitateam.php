<?php
/**
 * Team Members Custom Post Type
 * 
 * @package smitasmile
 */

// ============================================
// REGISTER TEAM CPT
// ============================================

function smitasmile_register_team_cpt() {
    $labels = array(
        'name'                  => __('Team Members', 'smitasmile'),
        'singular_name'         => __('Team Member', 'smitasmile'),
        'menu_name'             => __('Smita Team', 'smitasmile'),
        'name_admin_bar'        => __('Team Member', 'smitasmile'),
        'add_new'               => __('Add New Member', 'smitasmile'),
        'add_new_item'          => __('Add New Team Member', 'smitasmile'),
        'edit_item'             => __('Edit Team Member', 'smitasmile'),
        'new_item'              => __('New Team Member', 'smitasmile'),
        'view_item'             => __('View Team Member', 'smitasmile'),
        'view_items'            => __('View Team Members', 'smitasmile'),
        'search_items'          => __('Search Team Members', 'smitasmile'),
        'not_found'             => __('No team members found', 'smitasmile'),
        'not_found_in_trash'    => __('No team members found in trash', 'smitasmile'),
        'all_items'             => __('All Team Members', 'smitasmile'),
    );

    $args = array(
        'labels'              => $labels,
        'public'              => true,
        'publicly_queryable'  => true,
        'show_ui'             => true,
        'show_in_menu'        => true,
        'show_in_nav_menus'   => true,
        'show_in_admin_bar'   => true,
        'show_in_rest'        => true,
        'rest_base'           => 'team-members',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
        'menu_position'       => 5,
        'menu_icon'           => 'dashicons-groups',
        'capability_type'     => 'post',
        'supports'            => array('title', 'thumbnail', 'excerpt', 'editor', 'custom-fields'),
        'taxonomies'          => array('team_category'),
        'has_archive'         => true,
        'rewrite'             => array(
            'slug' => 'team',
            'with_front' => false,
        ),
    );

    register_post_type('smita_team', $args);
}
add_action('init', 'smitasmile_register_team_cpt');

// ============================================
// REGISTER TEAM CATEGORY TAXONOMY
// ============================================

function smitasmile_register_team_taxonomy() {
    $labels = array(
        'name'              => __('Team Categories', 'smitasmile'),
        'singular_name'     => __('Team Category', 'smitasmile'),
        'search_items'      => __('Search Categories', 'smitasmile'),
        'all_items'         => __('All Categories', 'smitasmile'),
        'parent_item'       => __('Parent Category', 'smitasmile'),
        'parent_item_colon' => __('Parent Category:', 'smitasmile'),
        'edit_item'         => __('Edit Category', 'smitasmile'),
        'update_item'       => __('Update Category', 'smitasmile'),
        'add_new_item'      => __('Add New Category', 'smitasmile'),
        'new_item_name'     => __('New Category Name', 'smitasmile'),
        'menu_name'         => __('Categories', 'smitasmile'),
    );

    $args = array(
        'labels'            => $labels,
        'public'            => true,
        'show_ui'           => true,
        'show_in_nav_menus' => true,
        'show_in_rest'      => true,
        'hierarchical'      => true,
        'rewrite'           => array(
            'slug' => 'team-category',
            'with_front' => false,
        ),
    );

    register_taxonomy('team_category', array('smita_team'), $args);
}
add_action('init', 'smitasmile_register_team_taxonomy');

// ============================================
// CUSTOM COLUMNS - Admin List
// ============================================

function smitasmile_team_columns( $columns ) {
    // Photo kolona na kraju
    $thumbnail = isset($columns['thumbnail']) ? $columns['thumbnail'] : __('Photo', 'smitasmile');
    unset($columns['thumbnail']);
    $columns['thumbnail'] = $thumbnail;
    return $columns;
}
add_filter('manage_smita_team_posts_columns', 'smitasmile_team_columns');

// ============================================
// DISPLAY THUMBNAIL IN COLUMN
// ============================================

function smitasmile_team_column_content( $column, $post_id ) {
    if ($column === 'thumbnail') {
        if (has_post_thumbnail($post_id)) {
            echo get_the_post_thumbnail($post_id, array(60, 60), array(
                'style' => 'width: 150px; height: 150px; object-fit: cover; border-radius: 4px;'
            ));
        } else {
            echo '<span style="color: #999; font-size: 12px;">' . esc_html__('No image', 'smitasmile') . '</span>';
        }
    }
}
add_action('manage_smita_team_posts_custom_column', 'smitasmile_team_column_content', 10, 2);

// ============================================
// MAKE COLUMN SORTABLE (optional)
// ============================================

function smitasmile_team_sortable_columns( $sortable_columns ) {
    $sortable_columns['thumbnail'] = 'thumbnail';
    return $sortable_columns;
}
add_filter('manage_edit-smita_team_sortable_columns', 'smitasmile_team_sortable_columns');