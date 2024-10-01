<?php
/* Template Name: attuazione misure pnrr
 *
 * attuazione misure pnrr template file
 *
 * @package Design_Comuni_Italia
 */
global $post, $with_shadow, $data_element;
wp_enqueue_style('dci-mission', get_template_directory_uri() . '/assets/css/mission.css', array('dci-boostrap-italia-min', 'dci-comuni'));
get_header();

?>
	<main>
		<?php
		while ( have_posts() ) :
			the_post();
			$with_shadow = true;
			$data_element = 'data-element="page-name"';	
			?>
			<?php get_template_part("template-parts/hero/hero"); ?>
			<?php get_template_part("template-parts/attuazione-misure-pnrr/main"); ?>
			<?php get_template_part("template-parts/attuazione-misure-pnrr/progetti-list"); ?>
			<?php get_template_part("template-parts/common/valuta-servizio"); ?>
			<?php get_template_part("template-parts/common/assistenza-contatti"); ?>
							
		<?php 
			endwhile; // End of the loop.
		?>
	</main>

<?php
get_footer();



