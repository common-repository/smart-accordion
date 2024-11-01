<?php 

	if ( ! defined('ABSPATH')) exit;  // if direct access 	

	function saf_ac_metaboxes_register(){
		add_meta_box(
			'sf_acsall_scode_post_message', 							# Metabox
			__( 'Smart Accordion Settings', 'smart-accordion' ),  		# Title
			'sf_ac_inner_custom_metaboxess', 							# $callback
			'sfaccordioncode', 											# $page
			'normal'
		);
		add_meta_box(
			'sf_acs_scode_display_message', 							# Metabox
			__( 'Smart Accordion Shortcode', 'smart-accordion' ),  		# Title
			'sf_ac_shortcode_display', 									# $callback
			'sfaccordioncode', 											# $page
			'side'
		);
		add_meta_box(
			'sf_acs_scode_display_support', 							# Metabox
			__( 'Need Support', 'smart-accordion' ),  					# Title
			'sf_ac_items_support', 										# $callback
			'sfaccordioncode', 											# $page
			'side'
		);
	}
	add_action('add_meta_boxes', 'saf_ac_metaboxes_register');


	# Accordion Shortcode Page MetaBox Options
	function sf_ac_inner_custom_metaboxess( $post, $args ) {

		$sf_ac_categories_list 		= get_post_meta($post->ID, 'sf_ac_categories_list', true);
		if(empty($sf_ac_categories_list)){
			$sf_ac_categories_list = array();
		}
		$sf_ac_style_list				= get_post_meta($post->ID, 'sf_ac_style_list', true);
		$sf_ac_orderby_list				= get_post_meta($post->ID, 'sf_ac_orderby_list', true);
		$sf_ac_order_list				= get_post_meta($post->ID, 'sf_ac_order_list', true);

		# Title 
		$sf_ac_title_fontsize			= get_post_meta($post->ID, 'sf_ac_title_fontsize', true);
		$sf_ac_title_font_color			= get_post_meta($post->ID, 'sf_ac_title_font_color', true);
		$sf_ac_title_background_color	= get_post_meta($post->ID, 'sf_ac_title_background_color', true);
		$sf_ac_title_text_transform		= get_post_meta($post->ID, 'sf_ac_title_text_transform', true);
		$sf_ac_title_font_style			= get_post_meta($post->ID, 'sf_ac_title_font_style', true);
		$sf_ac_title_alignment			= get_post_meta($post->ID, 'sf_ac_title_alignment', true);

		# Content
		$sf_ac_content_fonts_size		= get_post_meta($post->ID, 'sf_ac_content_fonts_size', true);
		$sf_ac_content_padding			= get_post_meta($post->ID, 'sf_ac_content_padding', true);
		$sf_ac_content_fonts_color		= get_post_meta($post->ID, 'sf_ac_content_fonts_color', true);
		$sf_ac_content_background_color	= get_post_meta($post->ID, 'sf_ac_content_background_color', true);
		$sf_ac_item_icons_color			= get_post_meta($post->ID, 'sf_ac_item_icons_color', true);
		$sf_ac_items_autoopen			= get_post_meta($post->ID, 'sf_ac_items_autoopen', true);

		$sf_ac_items_plusicons			= get_post_meta($post->ID, 'sf_ac_items_plusicons', true);
		$sf_ac_items_minusicons			= get_post_meta($post->ID, 'sf_ac_items_minusicons', true);
		$sf_ac_icon_showhide			= get_post_meta($post->ID, 'sf_ac_icon_showhide', true);
		$sf_ac_icon_positions			= get_post_meta($post->ID, 'sf_ac_icon_positions', true);
		$sf_ac_header_closeable			= get_post_meta($post->ID, 'sf_ac_header_closeable', true);
		$sf_ac_slide_speeds				= get_post_meta($post->ID, 'sf_ac_slide_speeds', true);
		$sf_ac_margin_btn_items			= get_post_meta($post->ID, 'sf_ac_margin_btn_items', true);
		$sf_ac_closeother_ac			= get_post_meta($post->ID, 'sf_ac_closeother_ac', true);
		$sf_ac_tabs						= get_post_meta($post->ID, 'sf_ac_tabs', true);

		?>

		<div class="smart-accordion-settings post-grid-metabox">
			<!-- <div class="wrap"> -->
			<ul class="tab-nav">
				<li nav="1" class="nav1 <?php if($sf_ac_tabs == 1){echo "active";}?>"><?php _e('Accordion Query','smart-accordion'); ?></li>
				<li nav="2" class="nav2 <?php if($sf_ac_tabs == 2){echo "active";}?>"><?php _e('General Settings ','smart-accordion'); ?></li>
				<li nav="3" class="nav3 <?php if($sf_ac_tabs == 3){echo "active";}?>"><?php _e('Accordion Settings ','smart-accordion'); ?></li>
			</ul> <!-- tab-nav end -->
			<?php
				$getNavValue = "";
				if(!empty($sf_ac_tabs)){ $getNavValue = $sf_ac_tabs; } else { $getNavValue = 1; }
			?>
			<input type="hidden" name="sf_ac_tabs" id="sf_ac_tabs" value="<?php echo $getNavValue; ?>">

			<ul class="box">
				<!-- Tab 2  -->
				<li style="<?php if($sf_ac_tabs == 1){echo "display: block;";} else{ echo "display: none;"; }?>" class="box1 tab-box <?php if($sf_ac_tabs == 1){echo "active";}?>">

					<div class="option-box">
						<p class="option-title"><?php _e('Accordion Settings','smart-accordion'); ?></p>

						<div class="wrap">
							<div class="smart-accordion-customize-area">
								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Choose Categories', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Select Categories to display Smart Accordion, if you not select any Categories it not display anything. At the same time you can select multiple Categories.', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<ul>
											<?php
												$args = array(
													'taxonomy'     => 'smartaccordion-tax',
													'orderby'      => 'name',
													'show_count'   => 1,
													'pad_counts'   => 1,
													'hierarchical' => 1,
													'echo'         => 0
												);
												$acpluscats = get_categories( $args );
											?>
											<?php
												foreach( $acpluscats as $category ):
												    $cat_id = $category->cat_ID;
												    $checked = ( in_array($cat_id,(array)$sf_ac_categories_list)? ' checked="checked"': "" );
												    echo'<li id="cat-'.$cat_id.'"><input type="checkbox" name="sf_ac_categories_list[]" id="'.$cat_id.'" value="'.$cat_id.'"'.$checked.'> <label for="'.$cat_id.'">'.__( $category->cat_name, 'smart-accordion' ).'</label></li>';
												endforeach;
											?>
										</ul>
									</div>
								</div><!-- End Categories -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Accordion Style', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose your accordion style. total 3 different style available (accordion, list, multi column)', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_style_list" id="sf_ac_style_list" class="timezone_string">
											<option value="1" <?php if ( isset ( $sf_ac_style_list ) ) selected( $sf_ac_style_list, '1' ); ?>><?php _e('Accordion', 'smart-accordion');?></option>
											<option disabled value="2" <?php if ( isset ( $sf_ac_style_list ) ) selected( $sf_ac_style_list, '2' ); ?>><?php _e('Accordion List (Only Pro)', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Style -->


								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Order By', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion order By: Date, Menu Order or Random. Drag & Drop order only for Pro Version', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_orderby_list" id="sf_ac_orderby_list" class="timezone_string">
											<option value="date" <?php if ( isset ( $sf_ac_orderby_list ) ) selected( $sf_ac_orderby_list, 'date' ); ?>><?php _e('Publish Date', 'smart-accordion');?></option>
											<option value="menu_order" <?php if ( isset ( $sf_ac_orderby_list ) ) selected( $sf_ac_orderby_list, 'menu_order' ); ?>><?php _e('Order', 'smart-accordion');?></option>
											<option value="rand" <?php if ( isset ( $sf_ac_orderby_list ) ) selected( $sf_ac_orderby_list, 'rand' ); ?>><?php _e('Random', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Order By -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Order', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion order: Descending or Ascending. Drag & Drop order only for Pro Version', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_order_list" id="sf_ac_order_list" class="timezone_string">
											<option value="DESC" <?php if ( isset ( $sf_ac_order_list ) ) selected( $sf_ac_order_list, 'DESC' ); ?>><?php _e('Descending', 'smart-accordion');?></option>
											<option value="ASC" <?php if ( isset ( $sf_ac_order_list ) ) selected( $sf_ac_order_list, 'ASC' ); ?>><?php _e('Ascending', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Order -->

							</div>
						</div>
					</div>
				</li>
				<!-- Tab 2  -->
				<li style="<?php if($sf_ac_tabs == 2){echo "display: block;";} else{ echo "display: none;"; }?>" class="box2 tab-box <?php if($sf_ac_tabs == 2){echo "active";}?>">

					<div class="option-box">
						<p class="option-title"><?php _e('General Settings','smart-accordion'); ?></p>

						<div class="wrap">
							<div class="smart-accordion-customize-area">
								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Title Font Size', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion title font size. default font size:16px ', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="number" name="sf_ac_title_fontsize" id="sf_ac_title_fontsize" maxlength="4" class="timezone_string" value="<?php  if($sf_ac_title_fontsize !=''){echo $sf_ac_title_fontsize; }else{ echo '16';} ?>">
									</div>
								</div><!-- End Accordion Title Font Size -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Title Font Color', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion title text color. default color: #333333', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="text" name="sf_ac_title_font_color" id="sf_ac_title_font_color" class="timezone_string" value="<?php  if($sf_ac_title_font_color !=''){echo $sf_ac_title_font_color; }else{ echo '#333333';} ?>">
									</div>
								</div><!-- End Accordion Title Text Color -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Title Background Color', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion title Background color. default color: #dddddd', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="text" name="sf_ac_title_background_color" id="sf_ac_title_background_color" class="timezone_string" value="<?php  if($sf_ac_title_background_color !=''){echo $sf_ac_title_background_color; }else{ echo '#dddddd';} ?>">
									</div>
								</div><!-- End Accordion Title background Color -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Title Text Transform', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion title text transform. default text transform: Capitalize', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_title_text_transform" id="sf_ac_title_text_transform" class="timezone_string">
											<option value="unset" <?php if ( isset ( $sf_ac_title_text_transform ) ) selected( $sf_ac_title_text_transform, 'unset' ); ?>><?php _e('Default', 'smart-accordion');?></option>
											<option disabled value="capitalize" <?php if ( isset ( $sf_ac_title_text_transform ) ) selected( $sf_ac_title_text_transform, 'capitalize' ); ?>><?php _e('Capitilize (Only Pro)', 'smart-accordion');?></option>
											<option disabled value="lowercase" <?php if ( isset ( $sf_ac_title_text_transform ) ) selected( $sf_ac_title_text_transform, 'lowercase' ); ?>><?php _e('Lowercase (Only Pro)', 'smart-accordion');?></option>
											<option disabled value="uppercase" <?php if ( isset ( $sf_ac_title_text_transform ) ) selected( $sf_ac_title_text_transform, 'uppercase' ); ?>><?php _e('Uppercase (Only Pro)', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Accordion Title Text Transform -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Title Font Style', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion title text Style. default: Normal', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_title_font_style" id="sf_ac_title_font_style" class="timezone_string">
											<option value="normal" <?php if ( isset ( $sf_ac_title_font_style ) ) selected( $sf_ac_title_font_style, 'normal' ); ?>><?php _e('Normal', 'smart-accordion');?></option>
											<option disabled value="italic" <?php if ( isset ( $sf_ac_title_font_style ) ) selected( $sf_ac_title_font_style, 'italic' ); ?>><?php _e('Italic  (Only Pro)', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Accordion Title Text Style -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Title Text Position', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion title text position. default: Left', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_title_alignment" id="sf_ac_title_alignment" class="timezone_string">
											<option value="left" <?php if ( isset ( $sf_ac_title_alignment ) ) selected( $sf_ac_title_alignment, 'left' ); ?>><?php _e('Left', 'smart-accordion');?></option>
											<option disabled value="center" <?php if ( isset ( $sf_ac_title_alignment ) ) selected( $sf_ac_title_alignment, 'center' ); ?>><?php _e('Center  (Only Pro)', 'smart-accordion');?></option>
											<option disabled value="right" <?php if ( isset ( $sf_ac_title_alignment ) ) selected( $sf_ac_title_alignment, 'right' ); ?>><?php _e('Right  (Only Pro)', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Accordion Title Text Position -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Content Area Padding', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion content area padding. padding options only works if you use Background image or color.', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="number" name="sf_ac_content_padding" id="sf_ac_content_padding" maxlength="4" class="timezone_string" value="<?php if($sf_ac_content_padding !=''){echo $sf_ac_content_padding; }else{ echo '0';} ?>">
									</div>
								</div><!-- End Accordion area padding -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Content Font Size', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion content font size. default size:14px', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="number" name="sf_ac_content_fonts_size" id="sf_ac_content_fonts_size" maxlength="4" class="timezone_string" value="<?php if($sf_ac_content_fonts_size !=''){echo $sf_ac_content_fonts_size; }else{ echo '14';} ?>">
									</div>
								</div><!-- End Accordion Content Font Size -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Content Text Color', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion content text color. default color: #000', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="text" name="sf_ac_content_fonts_color" id="sf_ac_content_fonts_color" class="timezone_string" value="<?php  if($sf_ac_content_fonts_color !=''){echo $sf_ac_content_fonts_color; }else{ echo '#000';} ?>">
									</div>
								</div><!-- End Accordion Content Text Color -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Content Background Color', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion content Background color. default color: #fff', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="text" name="sf_ac_content_background_color" id="sf_ac_content_background_color" class="timezone_string" value="<?php  if($sf_ac_content_background_color !=''){echo $sf_ac_content_background_color; }else{ echo '#fff';} ?>">
									</div>
								</div><!-- End Accordion Content Background Color -->
							</div>
						</div>
					</div>
				</li>

				<!-- Tab 4  -->
				<li style="<?php if($sf_ac_tabs == 3){echo "display: block;";} else{ echo "display: none;"; }?>" class="box3 tab-box <?php if($sf_ac_tabs == 3){echo "active";}?>">
					<div class="option-box">
						<p class="option-title"><?php _e('Accordion Settings', 'smart-accordion');?></p>

						<div class="wrap">
							<div class="smart-accordion-customize-area">

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Accordion Icon', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('show/hide accordion icon, if you do not want to show accordion icon select (hide) and update. default: Show', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_icon_showhide" id="sf_ac_icon_showhide" class="timezone_string">
											<option value="1" <?php if ( isset ( $sf_ac_icon_showhide ) ) selected( $sf_ac_icon_showhide, '1' ); ?>><?php _e('Show', 'smart-accordion');?></option>
											<option disabled value="2" <?php if ( isset ( $sf_ac_icon_showhide ) ) selected( $sf_ac_icon_showhide, '2' ); ?>><?php _e('Hide (Only Pro)', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Icon -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Accordion Plus Icon', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Click input field to Choose your Accordion plus icons', 'smart-accordion');?> </span>
										<span style="color:red;font-weight: bold" class="pro-hints-ac">Only For Pro version</span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="text" name="sf_ac_items_plusicons" id="sf_ac_items_plusicons" class="input timezone_string" value="<?php  if($sf_ac_items_plusicons !=''){echo $sf_ac_items_plusicons; }else{ echo 'fa-plus';} ?>">
										<script type="text/javascript">
											jQuery(document).ready(function($){
												$('.input').iconpicker(".input");
											});
										</script>
									</div>
								</div><!-- End Icon -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Accordion Minus Icon', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Click input field to Choose your Accordion Minus icons', 'smart-accordion');?> </span>
										<span style="color:red;font-weight: bold" class="pro-hints-ac">Only For Pro version</span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="text" name="sf_ac_items_minusicons" id="sf_ac_items_minusicons" class="input2 timezone_string" value="<?php  if($sf_ac_items_minusicons !=''){echo $sf_ac_items_minusicons; }else{ echo 'fa-minus';} ?>">

										<script type="text/javascript">
											jQuery(document).ready(function($){
												$('.input2').iconpicker(".input2");
											});
										</script>
									</div>
								</div><!-- End Icon -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Accordion Icon Position', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion icon position left or right. default: Left', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_icon_positions" id="sf_ac_icon_positions" class="timezone_string">
											<option value="1" <?php if ( isset ( $sf_ac_icon_positions ) ) selected( $sf_ac_icon_positions, '1' ); ?>><?php _e('Left', 'smart-accordion');?></option>
											<option disabled value="2" <?php if ( isset ( $sf_ac_icon_positions ) ) selected( $sf_ac_icon_positions, '2' ); ?>><?php _e('Right (Only Pro)', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Icon Position -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Icon Color', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion icon color. default color: #000', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="text" name="sf_ac_item_icons_color" id="sf_ac_item_icons_color" class="timezone_string" value="<?php  if($sf_ac_item_icons_color !=''){echo $sf_ac_item_icons_color; }else{ echo '#000';} ?>">
									</div>
								</div><!-- End Icon Color -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Accordion CloseAble', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose Accordion header closeAble True or False. default: True', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_header_closeable" id="sf_ac_header_closeable" class="timezone_string">
											<option value="true" <?php if ( isset ( $sf_ac_header_closeable ) ) selected( $sf_ac_header_closeable, 'true' ); ?>><?php _e('True', 'smart-accordion');?></option>
											<option disabled value="false" <?php if ( isset ( $sf_ac_header_closeable ) ) selected( $sf_ac_header_closeable, 'false' ); ?>><?php _e('False (Only Pro)', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Accordion CloseAble -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Close Other Accordion', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose close other accordion off options when you click accordion. default: True', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<select name="sf_ac_closeother_ac" id="sf_ac_closeother_ac" class="timezone_string">
											<option value="false" <?php if ( isset ( $sf_ac_closeother_ac ) ) selected( $sf_ac_closeother_ac, 'false' ); ?>><?php _e('False', 'smart-accordion');?></option>
											<option disabled value="true" <?php if ( isset ( $sf_ac_closeother_ac ) ) selected( $sf_ac_closeother_ac, 'true' ); ?>><?php _e('True (Only Pro)', 'smart-accordion');?></option>
										</select>
									</div>
								</div><!-- End Accordion Clos Other Items -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Slide Speed (Miliseconds)', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose Expand/collapse Slide speed of Animation. default: 200', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="number" name="sf_ac_slide_speeds" id="sf_ac_slide_speeds" maxlength="4" class="timezone_string" value="<?php if($sf_ac_slide_speeds !=''){echo $sf_ac_slide_speeds; }else{ echo '200';} ?>">
									</div>
								</div><!-- End Slide Speed (Miliseconds) -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Auto Open Items', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose which items you want to open automatically(1,2,3 etc). if you do not want open any items just type (false) and update it.', 'smart-accordion');?> </span>
										<span style="color:red;font-weight: bold" class="pro-hints-ac">Only For Pro version</span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="text" name="sf_ac_items_autoopen" id="sf_ac_items_autoopen" maxlength="4" class="timezone_string" value="<?php if($sf_ac_items_autoopen !=''){echo $sf_ac_items_autoopen; }else{ echo 'false';} ?>">
									</div>
								</div><!-- End Auto Open Items -->

								<div class="smart-accordion-customize-inner">
									<div class="smart-accordion-heading-area">
										<span class="sub-heading"><?php _e('Accordion Items Margin', 'smart-accordion');?></span>
										<span class="sub-description"><?php _e('Choose accordion margin between items.', 'smart-accordion');?> </span>
									</div>

									<div class="smart-accordion-select-items">
										<input type="number" name="sf_ac_margin_btn_items" id="sf_ac_margin_btn_items" maxlength="4" class="timezone_string" value="<?php if($sf_ac_margin_btn_items !=''){echo $sf_ac_margin_btn_items; }else{ echo '4';} ?>">
									</div>
								</div><!-- End Accordion Items Margin -->

							</div>
						</div>
					</div>

				</li>
			</ul>
		</div>

		<script>
			jQuery(document).ready(function(){
				jQuery("#company_website_input, #sf_ac_title_font_color, #sf_ac_title_background_color, #sf_ac_content_fonts_color, #sf_ac_content_background_color, #sf_ac_item_icons_color").wpColorPicker();
			});
		</script>
	<?php
	}

	# Accordion Plus Shortcode page MetaBox Options Save
	function sf_ac_metainfo_boxes_save($post_id){

		# Doing autosave then return.
		if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
		return;


		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_categories_list'] ) ) {
			update_post_meta( $post_id, 'sf_ac_categories_list', $_POST[ 'sf_ac_categories_list' ]  );
		} else {
            update_post_meta( $post_id, 'sf_ac_categories_list', 'unchecked' );
        }

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_style_list'] ) ) {
			update_post_meta( $post_id, 'sf_ac_style_list', $_POST[ 'sf_ac_style_list' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_orderby_list'] ) ) {
			update_post_meta( $post_id, 'sf_ac_orderby_list', $_POST[ 'sf_ac_orderby_list' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_order_list'] ) ) {
			update_post_meta( $post_id, 'sf_ac_order_list', $_POST[ 'sf_ac_order_list' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_title_fontsize'] ) ) {
			update_post_meta( $post_id, 'sf_ac_title_fontsize', $_POST[ 'sf_ac_title_fontsize' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_title_font_color'] ) ) {
			update_post_meta( $post_id, 'sf_ac_title_font_color', $_POST[ 'sf_ac_title_font_color' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_title_background_color'] ) ) {
			update_post_meta( $post_id, 'sf_ac_title_background_color', $_POST[ 'sf_ac_title_background_color' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_title_text_transform'] ) ) {
			update_post_meta( $post_id, 'sf_ac_title_text_transform', $_POST[ 'sf_ac_title_text_transform' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_title_font_style'] ) ) {
			update_post_meta( $post_id, 'sf_ac_title_font_style', $_POST[ 'sf_ac_title_font_style' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_title_alignment'] ) ) {
			update_post_meta( $post_id, 'sf_ac_title_alignment', $_POST[ 'sf_ac_title_alignment' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_item_icons_color'] ) ) {
			update_post_meta( $post_id, 'sf_ac_item_icons_color', $_POST[ 'sf_ac_item_icons_color' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_icon_showhide'] ) ) {
			update_post_meta( $post_id, 'sf_ac_icon_showhide', $_POST[ 'sf_ac_icon_showhide' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_items_autoopen'] ) ) {
			update_post_meta( $post_id, 'sf_ac_items_autoopen', $_POST[ 'sf_ac_items_autoopen' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_icon_positions'] ) ) {
			update_post_meta( $post_id, 'sf_ac_icon_positions', $_POST[ 'sf_ac_icon_positions' ]  );
		}
		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_header_closeable'] ) ) {
			update_post_meta( $post_id, 'sf_ac_header_closeable', $_POST[ 'sf_ac_header_closeable' ]  );
		}
		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_slide_speeds'] ) ) {
			update_post_meta( $post_id, 'sf_ac_slide_speeds', $_POST[ 'sf_ac_slide_speeds' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_margin_btn_items'] ) ) {
			update_post_meta( $post_id, 'sf_ac_margin_btn_items', $_POST[ 'sf_ac_margin_btn_items' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_closeother_ac'] ) ) {
			update_post_meta( $post_id, 'sf_ac_closeother_ac', $_POST[ 'sf_ac_closeother_ac' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_content_fonts_size'] ) ) {
			update_post_meta( $post_id, 'sf_ac_content_fonts_size', $_POST[ 'sf_ac_content_fonts_size' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_content_padding'] ) ) {
			update_post_meta( $post_id, 'sf_ac_content_padding', $_POST[ 'sf_ac_content_padding' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_content_fonts_color'] ) ) {
			update_post_meta( $post_id, 'sf_ac_content_fonts_color', $_POST[ 'sf_ac_content_fonts_color' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_content_background_color'] ) ) {
			update_post_meta( $post_id, 'sf_ac_content_background_color', $_POST[ 'sf_ac_content_background_color' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_items_plusicons'] ) ) {
			update_post_meta( $post_id, 'sf_ac_items_plusicons', $_POST[ 'sf_ac_items_plusicons' ]  );
		}

		#Checks for input and saves if needed
		if( isset( $_POST['sf_ac_items_minusicons'] ) ) {
			update_post_meta( $post_id, 'sf_ac_items_minusicons', $_POST[ 'sf_ac_items_minusicons' ]  );
		}

		#Value check and saves if needed (Tab)
		if( isset( $_POST[ 'sf_ac_tabs' ] ) ) {
			update_post_meta( $post_id, 'sf_ac_tabs', $_POST['sf_ac_tabs'] );
		} else {
			update_post_meta( $post_id, 'sf_ac_tabs', 1 );
		}
	}
	add_action('save_post', 'sf_ac_metainfo_boxes_save');


	function sf_ac_shortcode_display( $post, $args ) { ?>
		<p class="option-info"><?php _e('Copy this shortcode and paste on page or post where you want to display accordion.','smart-accordion'); ?></p>
		<textarea cols="35" rows="1" onClick="this.select();" >[safaccordion <?php echo 'id="'.$post->ID.'"';?>]</textarea>
		<?php
	}

	function sf_ac_items_support( $post, $args ) { ?>
		<div class="support-area">
			<p>If you need any help or found any bugs in our plugin please do not hesitate to post it on plugin support section. we are happy to solve our plugin issues.</p>
			<div class="smart-review">
				<a target="_blank" class="spbtn" href="https://pickelements.com/contact">Support</a>
			</div>
		</div>
		<?php
	}