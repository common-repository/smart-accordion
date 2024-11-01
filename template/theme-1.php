<?php
    if( !defined( 'ABSPATH' ) ){
        exit;
    }

	?>

	<div class="accordion-wrapper-<?php echo $postid;?>">
		<style type="text/css">
			.smart_accordion<?php echo $postid;?>.accordionjs {
			  position: relative;
			  list-style: none;
			  margin:0px;
			  padding: <?php echo $sf_ac_content_padding;?>px;
			}
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section {
			  border: 1px solid <?php echo $sf_ac_title_background_color;?> !important;
			  position: relative;
			  z-index: 10;
			  margin-top: 0px;
			  margin-bottom: <?php echo $sf_ac_margin_btn_items;?>px !important;
			  overflow: hidden;
			}
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section .acc_head {
			  position: relative;
			  background: <?php echo $sf_ac_title_background_color;?> !important;
			  color:<?php echo $sf_ac_title_font_color;?>;
			  font-size:<?php echo $sf_ac_title_fontsize;?>px;
			  text-transform:<?php echo $sf_ac_title_text_transform;?>;
			  font-style:<?php echo $sf_ac_title_font_style;?>;
			  text-align:<?php echo $sf_ac_title_alignment;?>;
			  padding: 8px;
			  display: block;
			  cursor: pointer;
			}
			<?php if($sf_ac_icon_positions == 1){ ?>
				.smart_accordion<?php echo $postid;?> .acc_head_icons<?php echo $postid;?> {
				  color: <?php echo $sf_ac_item_icons_color;?>;
				  float: left;
				  margin-right: 8px;
				  padding: 0 10px;
				}
			<?php }elseif($sf_ac_icon_positions == 2){ ?>
				.smart_accordion<?php echo $postid;?> .acc_head_icons<?php echo $postid;?> {
				  color: <?php echo $sf_ac_item_icons_color;?>;
				  float: right;
				  margin-right: 0px;
				  margin-left: 5px;
				  padding: 0 10px;
				}
			<?php } ?>
			.smart_accordion<?php echo $postid;?> span.plusicons<?php echo $postid;?> {
			    position: absolute;
			}
			.smart_accordion<?php echo $postid;?> span.minusicons<?php echo $postid;?> {
			    position: relative;
			    overflow: hidden;
			    visibility: hidden;
			}
			.smart_accordion<?php echo $postid;?> .acc_active span.minusicons<?php echo $postid;?> {
			    visibility: visible;
			    position: relative;
			}
			.smart_accordion<?php echo $postid;?> .acc_active span.plusicons<?php echo $postid;?> {
			    visibility: hidden;
			}
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section .acc_head h3 {
			  line-height: 1;
			  margin: 5px 0;
			}
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section .acc_content {
			  padding: 10px;
			}
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section:first-of-type,
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section:first-of-type .acc_head {
			  border-top-left-radius: 0px;
			  border-top-right-radius: 0px;
			}
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section:last-of-type,
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section:last-of-type .acc_content {
			  border-bottom-left-radius: 0px;
			  border-bottom-right-radius: 0px;
			}
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section.acc_active > .acc_content {
			  display: block;
			  background: <?php echo $sf_ac_content_background_color;?> !important;
			}
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section.acc_active > .acc_content p{
			  	color: <?php echo $sf_ac_content_fonts_color;?>;
			  	font-size:<?php echo $sf_ac_content_fonts_size;?>px !important;
				margin: 0;
				padding: 0;
				margin-bottom: 10px;
				line-height: 28px;
			}
			.smart_accordion<?php echo $postid;?>.accordionjs .acc_section.acc_active > .acc_head {
			  background: <?php echo $sf_ac_title_background_color;?> !important;
			  border-bottom: 1px solid <?php echo $sf_ac_title_background_color;?> !important;
			}
			.smart_accordion<?php echo $postid;?> div#accordion-container ul {
			    padding-left: 18px;
			}
		</style>

		<script type="text/javascript">
			jQuery(document).ready(function($){
			    $(".smart_accordion<?php echo $postid; ?>").accordionjs({
			        // Allow self close.(data-close-able)
			        closeAble   : <?php echo $sf_ac_header_closeable;?>,

			        // Close other sections.(data-close-other)
			        closeOther  : false,

			        // Animation Speed.(data-slide-speed)
			        slideSpeed  : <?php echo $sf_ac_slide_speeds;?>,

			        // The section open on first init. A number from 1 to X or false.(data-active-index)
			        activeIndex : false,

			        // Callback when a section is open
			        openSection: function( section ){},

			        // Callback before a section is open
			        beforeOpenSection: function( section ){},
			    });
			});
		</script>

		<div class="smart_accordion<?php echo $postid ?>">
			<?php
				while ( $sfacsquery->have_posts() ) : $sfacsquery->the_post();
				$content 			= apply_filters( 'the_content', get_the_content() );
				?>
				<div class="accordion_in">
					<div class="acc_head">
						<?php if($sf_ac_icon_showhide == 1){ ?>
							<div class="acc_head_icons<?php echo $postid ?>">
								<span class="plusicons<?php echo $postid ?>"><i class="fa fa-plus"></i></span>
								<span class="minusicons<?php echo $postid ?>"><i class="fa fa-minus"></i></span>
							</div>
						<?php } ?>
						<?php echo the_title();?>
					</div>
					<div id="accordion-container" class="acc_content">
						<?php echo $content; ?>
					</div>
				</div>
			<?php endwhile;?>
			<?php wp_reset_query();?>
		</div>
	</div>