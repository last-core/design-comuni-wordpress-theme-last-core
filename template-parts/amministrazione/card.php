<?php
$prefix = '_dci_unita_organizzativa_';
$descrizione = dci_get_meta('competenze', $prefix, $post->ID);
?>
<div class="col-12 col-md-6 col-lg-4">
    <div class="cmp-card-simple card-wrapper pb-0 rounded border border-light">
        <div class="card shadow-sm rounded">
            <div class="card-body">
                <a class="text-decoration-none" href="<?php echo get_permalink($post->ID); ?>" data-element="management-category-link">
                    <h3 class="card-title t-primary"><?php echo $post->post_title; ?></h3>
                </a>
                <p class="text-paragraph mb-0">
                    <?php echo $descrizione; ?>
                </p>
            </div>
        </div>
    </div>
</div>