<?php
/* Template Name: Sottopagina amministrazione
 *
 * amministrazione-sub template file
 *
 * @package Design_Comuni_Italia
 */
global $obj, $title, $description, $data_element, $the_query, $load_posts, $load_card_type, $additional_filter;
$obj = get_queried_object();
$max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 3;
$load_posts = 3;
$query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
$tipi_organizzazione = array('aree-amministrative' => 'area', 'enti-e-fondazioni' => 'ente,fondazione', 'organi-di-governo' => 'struttura politica', 'uffici' => 'ufficio');
$args = array(
    'posts_per_page' => $max_posts,
    'post_type'      => 'unita_organizzativa',
    'tipi_unita_organizzativa' => $tipi_organizzazione[$obj->post_name],
    'orderby'        => 'post_title',
    'order'          => 'ASC'
);
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
        <?php get_template_part("template-parts/amministrazione/cards-list-sub"); ?>
        <?php get_template_part("template-parts/common/valuta-servizio"); ?>
        <?php get_template_part("template-parts/common/assistenza-contatti"); ?>

    <?php
    endwhile; // End of the loop.
    ?>
</main>

<?php
get_footer();
