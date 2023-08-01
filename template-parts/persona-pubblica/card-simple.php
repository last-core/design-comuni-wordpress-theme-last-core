<?php
global $persona_id;
$prefix = "_dci_persona_pubblica_";
$incarichi = dci_get_meta("incarichi", $prefix, $persona_id);
$img = dci_get_meta("foto", $prefix, $persona_id);

?>
<div class="card card-teaser card-teaser-image card-flex no-after rounded shadow">
    <div class="card-image-wrapper">
        <div class="card-body p-4">
            <h4 class="green-title-big t-primary"><a href="<?php echo get_permalink($persona_id); ?>" class="text-decoration-none"><?php echo get_the_title($persona_id); ?></a></h4>
            <?php if (is_array($incarichi) && count($incarichi)) { ?>
                <p><?php echo get_post($incarichi[0])->post_title; ?></p>
            <?php } ?>
        </div>
        <?php if ($img) { ?>
            <div class="card-image card-image-rounded">
                <img src="<?php echo $img; ?>" alt="<?php echo esc_attr(get_the_title($persona_id)); ?>">
            </div>
        <?php  } ?>
    </div>
</div>
<?php
