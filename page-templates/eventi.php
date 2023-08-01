<?php
/* Template Name: Eventi
 *
 * eventi template file
 *
 * @package Design_Comuni_Italia
 */
global $post, $with_shadow, $data_element;
$search_url = esc_url(home_url('/'));

get_header();
?>
<main>
    <?php
    while (have_posts()) :
        the_post();

        $with_shadow = true;
        $data_element = 'data-element="page-name"'
    ?>
        <?php get_template_part("template-parts/hero/hero"); ?>
        <?php get_template_part("template-parts/evento/tutti-eventi"); ?>
        <?php get_template_part("template-parts/evento/argomenti"); ?>
        <?php get_template_part("template-parts/common/valuta-servizio"); ?>
        <?php get_template_part("template-parts/common/assistenza-contatti"); ?>
    <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
