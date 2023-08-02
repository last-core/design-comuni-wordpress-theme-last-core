<?php
global $post;
$prefix = '_dci_persona_pubblica_';
$img = dci_get_meta('foto', $prefix, $post->ID);
$descrizione = dci_get_meta('descrizione_breve', $prefix, $post->ID);
$incarichi = dci_get_meta('incarichi', $prefix, $post->ID);
?>
<div class="card card-teaser card-teaser-image card-flex no-after rounded shadow">
    <div class="card-image-wrapper with-read-more pb-5">
        <div class="card-body p-4">
            <h3 class="card-title text-paragraph-medium u-grey-light"> <?php echo $post->post_title ?> </h3>
            <div class="text-paragraph-card u-grey-light m-0">
                <div class="mt-1"> </div>
                <?php if ($descrizione !== '') { ?>
                    <div class="mt-1">
                        <p><?php echo $descrizione; ?></p>
                    </div>
                <?php
                }
                if (is_array($incarichi) && count($incarichi)) {
                ?>
                    <div class="mt-1">
                        <ul class="list-unstyled">
                            <?php
                            $i_prefix = '_dci_incarico_';
                            foreach ($incarichi as $_incarico) {
                                $incarico = get_post($_incarico);
                                $unita_organizzativa = dci_get_meta('unita_organizzativa', $i_prefix, $incarico->ID);
                            ?>
                                <li>
                                    <?php echo $incarico->post_title; ?>
                                    <?php if ($unita_organizzativa !== '') {
                                        $unita_organizzativa = get_post($unita_organizzativa);
                                    ?>
                                        presso <a href="<?php echo get_permalink($unita_organizzativa->ID); ?>"><?php echo $unita_organizzativa->post_title ?></a>
                                    <?php } ?>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php if ($img !== '') { ?>
            <div class="card-image card-image-rounded pb-5">
                <?php dci_get_img($img) ?>
            </div>
        <?php } ?>
        <a class="read-more ps-4" href="<?php echo get_permalink($post->ID); ?>"> <span class="text">Ulteriori dettagli</span> <svg class="icon">
                <use xlink:href="#it-arrow-right"></use>
            </svg> </a>
    </div>
</div>