<?php
$area_riservata_link = dci_get_option("area_riservata_link", "header");

?>

<a class="btn btn-primary btn-icon btn-full" href="<?php echo $area_riservata_link ? $area_riservata_link : '#' ?>" data-element="personal-area-login">
    <span class="rounded-icon" aria-hidden="true">
        <svg class="icon icon-primary">
            <use xlink:href="#it-user"></use>
        </svg>
    </span>
    <span class="d-none d-lg-block">Accedi all'area personale</span>
</a>