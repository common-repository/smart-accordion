<?php 

	if ( ! defined('ABSPATH')) exit;  // if direct access 	

	// Register Smart Accordion Custom Post Type
	function sf_ac_custompost_register() {

		$labels = array(
			'name'                  => _x( 'Smart Accordion', 'Post Type General Name', 'smart-accordion' ),
			'singular_name'         => _x( 'Accordion', 'Post Type Singular Name', 'smart-accordion' ),
			'menu_name'             => __( 'Smart Accordion', 'smart-accordion' ),
			'name_admin_bar'        => __( 'Accordion', 'smart-accordion' ),
			'archives'              => __( 'Accordion Archives', 'smart-accordion' ),
			'attributes'            => __( 'Accordion Attributes', 'smart-accordion' ),
			'parent_item_colon'     => __( 'Parent Accordion:', 'smart-accordion' ),
			'all_items'             => __( 'All Accordion', 'smart-accordion' ),
			'add_new_item'          => __( 'Add New Accordion', 'smart-accordion' ),
			'add_new'               => __( 'Add New Accordion', 'smart-accordion' ),
			'new_item'              => __( 'New Accordion', 'smart-accordion' ),
			'edit_item'             => __( 'Edit Accordion', 'smart-accordion' ),
			'update_item'           => __( 'Update Accordion', 'smart-accordion' ),
			'view_item'             => __( 'View Accordion', 'smart-accordion' ),
			'view_items'            => __( 'View Accordion', 'smart-accordion' ),
			'search_items'          => __( 'Search Accordion', 'smart-accordion' ),
			'not_found'             => __( 'Accordion Not found', 'smart-accordion' ),
			'not_found_in_trash'    => __( 'Accordion Not found in Trash', 'smart-accordion' ),
			'featured_image'        => __( 'Accordion Item Background Image', 'smart-accordion' ),
			'set_featured_image'    => __( 'Set Accordion Item Background image', 'smart-accordion' ),
			'remove_featured_image' => __( 'Remove Accordion Item Background image', 'smart-accordion' ),
			'use_featured_image'    => __( 'Use as Accordion Item Background image', 'smart-accordion' ),
			'insert_into_item'      => __( 'Insert into Accordion', 'smart-accordion' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'smart-accordion' ),
			'items_list'            => __( 'Accordion list', 'smart-accordion' ),
			'items_list_navigation' => __( 'Accordion list navigation', 'smart-accordion' ),
			'filter_items_list'     => __( 'Filter Accordion list', 'smart-accordion' ),
		);
		$args = array(
			'label'                 => __( 'Accordion', 'smart-accordion' ),
			'description'           => __( 'Accordion Post Description.', 'smart-accordion' ),
			'labels'                => $labels,
			'supports'              => array( 'title', 'editor'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu'          => true,
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'smartaccordion', $args );
	}
	add_action('init', 'sf_ac_custompost_register');
	
	// Register Smart Accordion Custom Taxonomy
	function sf_ac_custompost_taxonomy() {
		$labels = array(
			'name'                       => _x( 'Accordion Categories', 'Taxonomy General Name', 'smart-accordion' ),
			'singular_name'              => _x( 'Accordion Categories', 'Taxonomy Singular Name', 'smart-accordion' ),
			'menu_name'                  => __( 'Accordion Categories', 'smart-accordion' ),
			'all_items'                  => __( 'All Categories', 'smart-accordion' ),
			'parent_item'                => __( 'Parent Categories', 'smart-accordion' ),
			'parent_item_colon'          => __( 'Parent Categories:', 'smart-accordion' ),
			'new_item_name'              => __( 'New Categories Name', 'smart-accordion' ),
			'add_new_item'               => __( 'Add New Categories', 'smart-accordion' ),
			'edit_item'                  => __( 'Edit Categories', 'smart-accordion' ),
			'update_item'                => __( 'Update Categories', 'smart-accordion' ),
			'view_item'                  => __( 'View Categories', 'smart-accordion' ),
			'separate_items_with_commas' => __( 'Separate groups with commas', 'smart-accordion' ),
			'add_or_remove_items'        => __( 'Add or remove Categories', 'smart-accordion' ),
			'choose_from_most_used'      => __( 'Choose from the most used', 'smart-accordion' ),
			'popular_items'              => __( 'Popular Categories', 'smart-accordion' ),
			'search_items'               => __( 'Search Categories', 'smart-accordion' ),
			'not_found'                  => __( 'Not Categories Found', 'smart-accordion' ),
			'no_terms'                   => __( 'No Categories', 'smart-accordion' ),
			'items_list'                 => __( 'Categories list', 'smart-accordion' ),
			'items_list_navigation'      => __( 'Items list navigation', 'smart-accordion' ),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'query_var' => true,
			'rewrite' => true
		);
		register_taxonomy( 'smartaccordion-tax', array( 'smartaccordion' ), $args );
	}

	add_action( 'init', 'sf_ac_custompost_taxonomy', 0);

	/*----------------------------------------------------------------------
		Smart Accordion Columns Declaration Function
	----------------------------------------------------------------------*/
	function sf_ac_info_rows($sf_ac_info_rows){
		$order='asc';
		if($_GET['order']=='asc') {
			$order='desc';
		}

		$sf_ac_info_rows = array(
			"cb" 				=> 	"<input type=\"checkbox\" />",
			"title" 			=> __('Accordion Title', 'smart-accordion'),
			"sfinofscats" 		=> __('Accordion Categories', 'smart-accordion'),
			"date" 				=> __('Date', 'smart-accordion'),
		);
		return $sf_ac_info_rows;
	}

	/*----------------------------------------------------------------------
		Smart Accordion Value Function
	----------------------------------------------------------------------*/
	function sf_ac_info_cols($sf_ac_info_rows, $post_id){
		global $post;
		if ( 'sfinofscats' == $sf_ac_info_rows ) {
			$terms = get_the_terms( $post_id , 'smartaccordion-tax');
			$count = count($terms);

			if ( $terms ){
				$i = 0;
				foreach ( $terms as $term ) {
					echo '<a href="'.admin_url( 'edit.php?post_type=smartaccordion&smartaccordion-tax='.$term->slug ).'">'.$term->name.'</a>';
					if($i+1 != $count) {
						echo " , ";
					}
					$i++;
				}
			}
		}
	}

	add_filter( 'manage_smartaccordion_posts_columns', 'sf_ac_info_rows' );
	add_action( 'manage_smartaccordion_posts_custom_column', 'sf_ac_info_cols', 10, 2 );

	function sf_ac_register_shortcode_menu(){
		add_submenu_page('edit.php?post_type=smartaccordion', __('Create Shortcode', 'smart-accordion'), __('Create Shortcode', 'smart-accordion'), 'manage_options', 'post-new.php?post_type=sfaccordioncode');
	}
	add_action('admin_menu', 'sf_ac_register_shortcode_menu');

	// Register Smart Accordion Custom shortcode Post Type
	function sf_ac_register_shortcode_post() {
		$labels = array(
			'name'                  => _x( 'Accordion Shortcode', 'Post Type General Name', 'smart-accordion' ),
			'singular_name'         => _x( 'Accordion Shortcode', 'Post Type Singular Name', 'smart-accordion' ),
			'menu_name'             => __( 'Accordion Shortcode', 'smart-accordion' ),
			'name_admin_bar'        => __( 'Accordion Shortcode', 'smart-accordion' ),
			'archives'              => __( 'Accordion Archives', 'smart-accordion' ),
			'attributes'            => __( 'Accordion Attributes', 'smart-accordion' ),
			'parent_item_colon'     => __( 'Parent Shortcode:', 'smart-accordion' ),
			'all_items'             => __( 'All Shortcode', 'smart-accordion' ),
			'add_new_item'          => __( 'Add New Shortcode', 'smart-accordion' ),
			'add_new'               => __( 'Add New Shortcode', 'smart-accordion' ),
			'new_item'              => __( 'New Shortcode', 'smart-accordion' ),
			'edit_item'             => __( 'Edit Shortcode', 'smart-accordion' ),
			'update_item'           => __( 'Update Shortcode', 'smart-accordion' ),
			'view_item'             => __( 'View Shortcode', 'smart-accordion' ),
			'view_items'            => __( 'View Shortcode', 'smart-accordion' ),
			'search_items'          => __( 'Search Shortcode', 'smart-accordion' ),
			'not_found'             => __( 'Shortcode Not found', 'smart-accordion' ),
			'not_found_in_trash'    => __( 'Shortcode Not found in Trash', 'smart-accordion' ),
			'insert_into_item'      => __( 'Insert into Shortcode', 'smart-accordion' ),
			'uploaded_to_this_item' => __( 'Uploaded to this item', 'smart-accordion' ),
			'items_list'            => __( 'Shortcode list', 'smart-accordion' ),
			'items_list_navigation' => __( 'Shortcode list navigation', 'smart-accordion' ),
			'filter_items_list'     => __( 'Filter Shortcode list', 'smart-accordion' ),
		);
		$args = array(
			'label'                 => __( 'Accordion Settings', 'smart-accordion' ),
			'description'           => __( 'Accordion Settings Post Description.', 'smart-accordion' ),
			'labels'                => $labels,
			'supports'              => array( 'title'),
			'hierarchical'          => false,
			'public'                => true,
			'show_ui'               => true,
			'show_in_menu' 		  => 'edit.php?post_type=smartaccordion',
			'show_in_admin_bar'     => false,
			'show_in_nav_menus'     => false,
			'can_export'            => true,
			'has_archive'           => true,
			'exclude_from_search'   => true,
			'publicly_queryable'    => true,
			'capability_type'       => 'page',
		);
		register_post_type( 'sfaccordioncode', $args );
	}
	add_action('init', 'sf_ac_register_shortcode_post');