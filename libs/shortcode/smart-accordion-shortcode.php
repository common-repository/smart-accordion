<?php
	if ( ! defined('ABSPATH')) exit;  // if direct access 	

	function saf_ac_shortcode_attr( $atts = array() ) {
		global $post, $paged, $query;
		ob_start();
		extract( shortcode_atts( array('id' => ''), $atts ) );
		$postid = $atts['id'];
		
		$sf_ac_categories_list   					= get_post_meta($postid, 'sf_ac_categories_list', true);
		$sf_ac_style_list   						= get_post_meta($postid, 'sf_ac_style_list', true);
		$sf_ac_orderby_list   						= get_post_meta($postid, 'sf_ac_orderby_list', true);
		$sf_ac_order_list   						= get_post_meta($postid, 'sf_ac_order_list', true);

		// title options settings
		$sf_ac_title_fontsize   					= get_post_meta($postid, 'sf_ac_title_fontsize', true);
		$sf_ac_title_font_color   					= get_post_meta($postid, 'sf_ac_title_font_color', true);
		$sf_ac_title_background_color   			= get_post_meta($postid, 'sf_ac_title_background_color', true);
		$sf_ac_title_text_transform   				= get_post_meta($postid, 'sf_ac_title_text_transform', true);
		$sf_ac_title_font_style   					= get_post_meta($postid, 'sf_ac_title_font_style', true);
		$sf_ac_title_alignment   					= get_post_meta($postid, 'sf_ac_title_alignment', true);

		// Accordion content options
		$sf_ac_content_padding   					= get_post_meta($postid, 'sf_ac_content_padding', true);
		$sf_ac_content_fonts_size   				= get_post_meta($postid, 'sf_ac_content_fonts_size', true);
		$sf_ac_content_fonts_color   				= get_post_meta($postid, 'sf_ac_content_fonts_color', true);
		$sf_ac_content_background_color   			= get_post_meta($postid, 'sf_ac_content_background_color', true);

		$sf_ac_item_icons_color  			 		= get_post_meta($postid, 'sf_ac_item_icons_color', true);
		$sf_ac_closeother_ac  			 			= get_post_meta($postid, 'sf_ac_closeother_ac', true);
		$sf_ac_items_autoopen  			 			= get_post_meta($postid, 'sf_ac_items_autoopen', true);
		$sf_ac_items_plusicons  			 		= get_post_meta($postid, 'sf_ac_items_plusicons', true);
		$sf_ac_items_minusicons  			 		= get_post_meta($postid, 'sf_ac_items_minusicons', true);

		$sf_ac_icon_showhide  			 			= get_post_meta($postid, 'sf_ac_icon_showhide', true);
		$sf_ac_icon_positions  			 			= get_post_meta($postid, 'sf_ac_icon_positions', true);
		$sf_ac_header_closeable  			 		= get_post_meta($postid, 'sf_ac_header_closeable', true);
		$sf_ac_slide_speeds  			 			= get_post_meta($postid, 'sf_ac_slide_speeds', true);
		$sf_ac_margin_btn_items   					= get_post_meta($postid, 'sf_ac_margin_btn_items', true);
		$sf_ac_icon_showhide   						= get_post_meta($postid, 'sf_ac_icon_showhide', true);

		if( is_array( $sf_ac_categories_list ) ){
			$sfmult_query_cats =  array();
			$num = count($sf_ac_categories_list);
			for($j=0; $j<$num; $j++){
				array_push($sfmult_query_cats, $sf_ac_categories_list[$j]);
			}
			$args = array(
				'post_type' 	 	=> 'smartaccordion',
				'post_status'	 	=> 'publish',
				'posts_per_page'	=> 8,
				'orderby'	   	   	=> $sf_ac_orderby_list,
				'order'			 	=> $sf_ac_order_list,
			    'tax_query' => [
			        'relation' => 'OR',
			        [
			            'taxonomy' => 'smartaccordion-tax',
			            'field' => 'id',
			            'terms' => $sfmult_query_cats,
			        ],
			        // [
			        //     'taxonomy' => 'smartaccordion-tax',
			        //     'field' => 'id',
			        //     'operator' => 'NOT EXISTS',
			        // ],
			    ],
			);
        }else{
			$args = array(
				'post_type' => 'smartaccordion',
				'post_status' => 'publish',
				'posts_per_page' => 8,
				'orderby'	   	   	=> $sf_ac_orderby_list,
				'order'			 	=> $sf_ac_order_list,
			);
        }

		$sfacsquery = new WP_Query( $args );

		switch ($sf_ac_style_list) {
		    case 1: 

				include saf_version_wp_plugin_dir.'/template/theme-1.php';

		    break;
		    case 2:

		    	include saf_version_wp_plugin_dir.'/template/theme-2.php';

		    break;
		    case 3:

		    	include saf_version_wp_plugin_dir.'/template/theme-3.php';

		    break;

		}
		$myvariable_pages = ob_get_clean();
		wp_reset_postdata();
		return $myvariable_pages;
    }
	add_shortcode( 'safaccordion', 'saf_ac_shortcode_attr' );