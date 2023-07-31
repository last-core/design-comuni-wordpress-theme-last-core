<?php
/* Template Name: Persone pubbliche
 *
 * amministrazione-persone template file
 *
 * @package Design_Comuni_Italia
 */
global $obj, $title, $description, $data_element, $the_query, $load_posts, $load_card_type, $additional_filter;
$obj = get_queried_object();
$max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 3;
$load_posts = 3;
$query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
$politico = get_posts(array('fields' => 'ids', 'posts_per_page' => -1, 'post_type' => 'incarico', 'tipi_incarico' => 'politico'));
$amministrativo = get_posts(array('fields' => 'ids', 'posts_per_page' => -1, 'post_type' => 'incarico', 'tipi_incarico' => 'amministrativo'));
$tipi_incarico = array('politici' => $politico, 'personale-amministrativo' => $amministrativo);
$args = array(
    'posts_per_page' => $max_posts,
    'post_type'      => 'persona_pubblica',
    'meta_query' => array(
        'relation' => 'OR'
    ),
    'orderby'        => 'post_title',
    'order'          => 'ASC'
);
foreach ($tipi_incarico[$obj->post_name] as $incarico) {
    $args['meta_query'][] = array(
        'key' => '_dci_persona_pubblica_incarichi',
        'value' => '"' . $incarico . '"',
        'compare' => 'LIKE'
    );
}
$the_query = new WP_Query($args);

$posts = $the_query->posts;

get_header();

?>
<main>
    <?php
    $title = $obj->post_title;
    $description = dci_get_meta('descrizione', '_dci_page_', $obj->ID);
    $data_element = 'data-element="page-name"';
    get_template_part("template-parts/hero/hero");
    while (have_posts()) :
        the_post();
    ?>
        <?php get_template_part("template-parts/persona-pubblica/cards-list"); ?>
        <?php get_template_part("template-parts/common/valuta-servizio"); ?>
        <?php get_template_part("template-parts/common/assistenza-contatti"); ?>

    <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
