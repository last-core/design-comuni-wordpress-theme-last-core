<?php
global $luogo, $luoghi;
$prefix = '_dci_luogo_';
$indirizzo = dci_get_meta('indirizzo', $prefix, $luogo->ID);
$img = dci_get_meta('immagine', $prefix, $luogo->ID);
$orario_pubblico = dci_get_wysiwyg_field('orario_pubblico', $prefix, $luogo->ID);
?>

<div class="card card-teaser card-teaser-info shadow mt-3 rounded">
    <svg class="icon">
        <use xlink:href="#it-pin" aria-hidden="true"></use>
    </svg>
    <div class="card-body">
        <h3 class="card-title h5">
            <a class="text-decoration-none" href="<?php echo get_permalink($luogo->ID); ?>">
                <?php echo $luogo->post_title; ?>
            </a>
        </h3>
        <div class="card-text">
            <p><?php echo $indirizzo; ?></p>
            <?php if (trim($orario_pubblico) !== '') { ?>
                <p class="mt-3"><?php echo $orario_pubblico ?></p>
            <?php } ?>
        </div>
    </div>
    <?php if (trim($img) !== '') { ?>
        <img src="<?php echo $img; ?>" class="avatar size-xl float-end" alt="<?php echo $luogo->post_ttile; ?>">
    <?php } ?>
</div>