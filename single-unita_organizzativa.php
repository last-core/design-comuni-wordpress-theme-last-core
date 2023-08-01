<?php

/**
 * Unita organizzativa template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */
global $post, $persona_id, $uo_id, $with_border, $servizio, $no_map;
get_header();
/**
 * inserimento variabili
 */
$user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);
$prefix = "_dci_unita_organizzativa_";

setlocale(LC_ALL, 'it_IT');
$descrizione_breve = dci_get_meta("descrizione_breve", $prefix, $post->ID);
$competenze = dci_get_wysiwyg_field("competenze", $prefix, $post->ID);
$organizzazioni = dci_get_meta("organizzazioni", $prefix, $post->ID);
$unita_organizzative_genitori = dci_get_meta("unita_organizzativa_genitore", $prefix, $post->ID);
$responsabili = dci_get_meta("responsabile", $prefix, $post->ID);
$tipo_organizzazione = ucfirst(get_the_terms($post->ID, 'tipi_unita_organizzativa')[0]->name);
$assessore_riferimento = dci_get_meta("assessore_riferimento", $prefix, $post->ID);
$persone_struttura = dci_get_meta("persone_struttura", $prefix, $post->ID);
$elenco_servizi_offerti = dci_get_meta("elenco_servizi_offerti", $prefix, $post->ID);
$sede_principale = dci_get_meta("sede_principale", $prefix, $post->ID);
$altre_sedi = dci_get_meta("altre_sedi", $prefix, $post->ID);
$contatti = dci_get_meta("contatti", $prefix, $post->ID);
$allegati = dci_get_meta("allegati", $prefix, $post->ID);
$ulteriori_informazioni = dci_get_wysiwyg_field("ulteriori_informazioni", $prefix, $post->ID);
$argomenti = dci_get_meta("argomenti", $prefix, $post->ID);
?>
<main>
    <?php
    while (have_posts()) :
        the_post();
    ?>
        <div class="container" id="main-container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <?php get_template_part("template-parts/common/breadcrumb"); ?>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-lg-10">
                    <div class="cmp-heading pb-3 pb-lg-4">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="titolo-sezione">
                                    <h1><?php the_title(); ?></h1>
                                </div>
                                <p class="subtitle-small mb-3">
                                    <?php echo $descrizione_breve ?>
                                </p>
                            </div>
                            <div class="col-lg-3 offset-lg-1 mt-5 mt-lg-0">
                                <?php
                                $inline = true;
                                get_template_part('template-parts/single/actions');
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row justify-content-center">
                    <?php get_template_part('template-parts/single/image-large'); ?>
                    <hr class="d-none d-lg-block mt-2" />
                </div>
            </div>
            <div class="container">
                <div class="row row-column-menu-left pb-lg-80 pb-40">
                    <div class="col-12 col-lg-3 mb-4 border-col">
                        <div class="cmp-navscroll sticky-top" aria-labelledby="accordion-title-one">
                            <nav class="navbar it-navscroll-wrapper navbar-expand-lg" aria-label="Indice della pagina" data-bs-navscroll>
                                <div class="navbar-custom" id="navbarNavProgress">
                                    <div class="menu-wrapper">
                                        <div class="link-list-wrapper">
                                            <div class="accordion">
                                                <div class="accordion-item">
                                                    <span class="accordion-header" id="accordion-title-one">
                                                        <button class="accordion-button pb-10 px-3 text-uppercase" type="button" data-bs-toggle="collapse" data-bs-target="#collapse-one" aria-expanded="true" aria-controls="collapse-one">
                                                            Indice della pagina
                                                            <svg class="icon icon-xs right">
                                                                <use href="#it-expand"></use>
                                                            </svg>
                                                        </button>
                                                    </span>
                                                    <div class="progress">
                                                        <div class="progress-bar it-navscroll-progressbar" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>
                                                    <div id="collapse-one" class="accordion-collapse collapse show" role="region" aria-labelledby="accordion-title-one">
                                                        <div class="accordion-body">
                                                            <ul class="link-list" data-element="page-index">
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#competenze">
                                                                        <span class="title-medium">Competenze</span>
                                                                    </a>
                                                                </li>
                                                                <?php if (is_array($unita_organizzative_genitori) && count($unita_organizzative_genitori)) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#area-di-riferimento">
                                                                            <span class="title-medium">Area di riferimento</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if (is_array($responsabili) && count($responsabili)) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#responsabile">
                                                                            <span class="title-medium">Responsabile</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#persone">
                                                                        <span class="title-medium">Persone</span>
                                                                    </a>
                                                                </li>
                                                                <?php if (is_array($elenco_servizi_offerti) && count($elenco_servizi_offerti)) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#servizi-offerti">
                                                                            <span class="title-medium">Servizi offerti</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#sede-principale">
                                                                        <span class="title-medium">Sede principale</span>
                                                                    </a>
                                                                </li>

                                                                <?php if (is_array($altre_sedi) && count($altre_sedi)) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#altre-sedi">
                                                                            <span class="title-medium">Altre sedi</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if (is_array($contatti) && count($contatti)) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#contatti">
                                                                            <span class="title-medium">Contatti</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if (trim($ulteriori_informazioni) !== "") { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#ulteriori_informazioni">
                                                                            <span class="title-medium">Ulteriori informazioni</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </nav>
                        </div>
                    </div>

                    <div class="col-12 col-lg-8 offset-lg-1">
                        <div class="it-page-sections-container">
                            <section id="competenze" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Competenze</h3>
                                <div class="richtext-wrapper lora">
                                    <?php echo $competenze; ?>
                                </div>
                            </section>
                            <section class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Tipologia di organizzazione</h3>
                                <div class="richtext-wrapper lora">
                                    <?php echo $tipo_organizzazione; ?>
                                </div>
                            </section>
                            <?php if (is_array($unita_organizzative_genitori) && count($unita_organizzative_genitori)) {
                                $uo_id = $unita_organizzative_genitori[0];
                                $with_border = true;
                            ?>
                                <section id="area-di-riferimento" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Area di riferimento</h3>
                                    <div class="row">
                                        <div class="col-12 col-lg-8">
                                            <?php get_template_part("template-parts/unita-organizzativa/card") ?>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>
                            <?php if (is_array($responsabili) && count($responsabili)) { ?>
                                <section id="responsabile" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold"><?php echo count($responsabili) === 1 ? 'Responsabile' : 'Responsabili' ?></h3>
                                    <div class="row">
                                        <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-2">
                                            <?php foreach ($responsabili as $persona_id) {
                                                get_template_part("template-parts/persona-pubblica/card-simple");
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>
                            <?php if (is_array($persone_struttura) && count($persone_struttura)) { ?>
                                <section id="persone" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Persone</h3>
                                    <div class="row">
                                        <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-2">
                                            <?php foreach ($persone_struttura as $persona_id) {
                                                get_template_part("template-parts/persona-pubblica/card-simple");
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>
                            <?php if (is_array($elenco_servizi_offerti) && count($elenco_servizi_offerti)) { ?>
                                <section id="servizi-offerti" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Servizi offerti</h3>
                                    <div class="row g-4">
                                        <?php foreach ($elenco_servizi_offerti as $servizio_id) {
                                            $servizio = get_post($servizio_id); ?>
                                            <div class="col-12 col-lg-6">
                                                <?php
                                                get_template_part("template-parts/servizio/card");
                                                ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <section id="sede-principale" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Sede principale</h3>
                                <div class="row">
                                    <div class="col-12">
                                        <?php
                                        $luogo = get_post($sede_principale);
                                        get_template_part("template-parts/luogo/card-simple");
                                        ?>
                                    </div>
                                </div>
                            </section>

                            <?php if (is_array($altre_sedi) && count($altre_sedi)) { ?>
                                <section id="altre-sedi" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Altre sedi</h3>
                                    <div class="row g-4">
                                        <?php foreach ($altre_sedi as $luogo_id) { ?>
                                            <div class="col-12">
                                                <?php
                                                $luogo = get_post($luogo_id);
                                                get_template_part("template-parts/luogo/card-simple");
                                                ?>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            <?php } ?>


                            <?php if ($contatti && is_array($contatti) && count($contatti) > 0) { ?>
                                <section id="contatti" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Contatti</h3>
                                    <div class="row">
                                        <?php foreach ($contatti as $pc_id) { ?>
                                            <div class="col-xl-6 col-lg-8 col-md-12 ">
                                                <?php
                                                $with_border = true;
                                                get_template_part("template-parts/punto-contatto/card"); ?>
                                            </div>
                                        <?php  } ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if (is_array($allegati) && count($allegati)) { ?>
                                <section id="allegati" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Allegati</h3>
                                    <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                        <?php foreach ($allegati as $all_url) {
                                            $all_id = attachment_url_to_postid($all_url);
                                            $allegato = get_post($all_id);
                                        ?>
                                            <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                                <svg class="icon" aria-hidden="true">
                                                    <use xlink:href="#it-clip"></use>
                                                </svg>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a class="text-decoration-none" href="<?php echo get_the_guid($allegato); ?>" aria-label="Scarica l'allegato <?php echo $allegato->post_title; ?>" title="Scarica l'allegato <?php echo $allegato->post_title; ?>">
                                                            <?php echo $allegato->post_title; ?>
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if (trim($ulteriori_informazioni) !== "") { ?>
                                <section id="ulteriori_informazioni" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Ulteriori informazioni</h3>
                                    <div class="richtext-wrapper lora">
                                        <?php echo $ulteriori_informazioni; ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php get_template_part('template-parts/single/page_bottom', "simple"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php get_template_part("template-parts/common/valuta-servizio"); ?>
        <?php get_template_part("template-parts/common/assistenza-contatti"); ?>

    <?php
    endwhile; // End of the loop.
    ?>
</main>
<?php
get_footer();
