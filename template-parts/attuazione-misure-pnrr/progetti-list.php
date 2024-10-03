<?php
global $post, $terms;
?>
<div class="container  px-4 py-4">
<div class="row">
        <h2>Progetti finanziati dal PNRR</h2>
        <?php foreach($terms as $term) {
            $args = array(
                'author' =>  $author_id,
                'posts_per_page' => -1,
                'post_type' => 'progetto_pnrr',
                'tax_query' => array(array(
                    'taxonomy' => 'tipi_progetto_pnrr',
                    'terms' => array($term->term_id),
                    'field' => 'id',
                )),
            );
        $progetti = get_posts($args);
        ?>
        <h4 class="mb-4 mt-4"><?php echo $term->name ?></h4>
        <?php foreach($progetti as $progetto) { 
        $investimento = dci_get_meta('investimento','_dci_progetto_pnrr_', post_id: $progetto->ID);
        ?>
        <div class="mission-card mt-2">
            <a href="<?php echo get_permalink($progetto->ID); ?>" data-focus-mouse="false" style="width: 100%;">
                <div class="row">
                    <div class="col-md-11">
                        <h6><?php echo $progetto->post_title; ?></h6>
                        <p>Investimento <?php echo $investimento; ?></p>
                    </div>
                    <div class="col-md-1 mt-3 mission-icon">
                        <svg class="icon">
                            <use xlink:href="#it-arrow-right"></use>
                        </svg>
                    </div>
                </div>
            </a>
        </div>
        <?php } ?>
        <?php } ?>
</div>
</div>