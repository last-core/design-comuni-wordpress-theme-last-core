<?php

/**
 * Unita organizzativa template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 */
global $post, $uo_id;
get_header();
/**
 * inserimento variabili
 */
$user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);
$prefix = "_dci_progetto_pnrr_";

setlocale(LC_ALL, 'it_IT');
$descrizione_e_scopo = dci_get_meta("descrizione_e_scopo", $prefix, $post->ID);
$missione = ucfirst(get_term_by('term_id', dci_get_meta("missione", $prefix, $post->ID), "tipi_progetto_pnrr")->name);
$componente = ucfirst(get_the_terms($post->ID, 'tipi_progetto_pnrr')[0]->name);
$investimento = dci_get_meta("investimento", $prefix, $post->ID);
$intervento = dci_get_meta("intervento", $prefix, $post->ID);
$intervento_esteso = dci_get_meta("intervento_esteso", $prefix, $post->ID);
$titolare = dci_get_meta("titolare", $prefix, $post->ID);
$soggetto = dci_get_meta("soggetto_attuatore", $prefix, $post->ID);
$cup = dci_get_meta("cup", $prefix, $post->ID);
$importo = dci_get_meta("importo", $prefix, $post->ID);
$modalita_accesso = dci_get_meta("modalita_accesso", $prefix, $post->ID);
$attivita_finanziate = dci_get_meta("attivita_finanziate", $prefix, $post->ID);
$uo_id = intval(dci_get_meta("contatti", $prefix, $post->ID));
$avanzamento_progetto = dci_get_meta("avanzamento_progetto", $prefix, $post->ID);
$atti_legislativi = dci_get_meta("atti_legislativi", $prefix, $post->ID);
$altri_allegati = dci_get_meta("altri_allegati", $prefix, $post->ID);
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
                                    <h1 data-element="attuator-title"><?php the_title(); ?></h1>
                                    <p data-element="attuator-description"><?php echo explode(' -', $componente)[0]; ?> investimento <?php echo $intervento; ?> del PNRR</p>
                                    <p>Data di pubblicazione: <?php the_date() ?></p>
                                </div>
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
                                                                    <a class="nav-link" href="#descrizione">
                                                                        <span class="title-medium">Descrizione e scopo</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#dettagli">
                                                                        <span class="title-medium">Dettagli</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#importo">
                                                                        <span class="title-medium">Importo finanziato</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#modalita-accesso">
                                                                        <span class="title-medium">Modalità di accesso al finanziamento</span>
                                                                    </a>
                                                                </li>
                                                                <?php if(is_array($attivita_finanziate) && count($attivita_finanziate)){ ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#attivita-finanziate">
                                                                        <span class="title-medium">Attività finanziate</span>
                                                                    </a>
                                                                </li>
                                                                <?php } ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#avanzamento-progetto">
                                                                        <span class="title-medium">Avanzamento del progetto</span>
                                                                    </a>
                                                                </li>
                                                                <?php if (is_array(value: $atti_legislativi) && count($atti_legislativi)) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#atti-legislativi">
                                                                            <span class="title-medium">Atti legislativi e amministrativi</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                                <?php if (is_array($altri_allegati) && count($altri_allegati)) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#altri-allegati">
                                                                            <span class="title-medium">Altri allegati</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#contatti">
                                                                        <span class="title-medium">Contatti</span>
                                                                    </a>
                                                                </li>
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
                            <section id="descrizione" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Descrizione e scopo</h3>
                                <div class="richtext-wrapper lora">
                                    <?php echo $descrizione_e_scopo; ?>
                                </div>
                            </section>
                            <section id="dettagli" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Dettagli</h3>
                                <div class="richtext-wrapper lora">
                                    <ul>
                                        <li><strong>Missione:</strong> <?php echo $missione; ?></li>
                                        <li><strong>Componente:</strong> <?php echo $componente; ?></li>
                                        <li><strong>Investimento:</strong> <?php echo $investimento; ?></li>
                                        <li><strong>Intervento:</strong> <?php echo $intervento_esteso; ?></li>
                                        <li><strong>Titolare:</strong> <?php echo $titolare; ?></li>
                                        <li><strong>Soggetto attuatore:</strong> <?php echo $soggetto; ?></li>
                                        <li><strong>CUP:</strong> <?php echo $cup; ?></li>
                                    </ul>
                                </div>
                            </section>
                            <section id="importo" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Importo finanziato</h3>
                                <div class="row">
                                    <div class="col-12 col-lg-8">
                                        <p>
                                            <?php echo $importo; ?> €
                                        </p>
                                    </div>
                                </div>
                                <div>
                                    <img class="ue-logo" src="<?php echo esc_url(get_template_directory_uri()); ?>/assets/img/logo-eu.svg" alt="logo Unione Europea" style="max-height: 4rem;max-width: 100%;">
                                </div>
                            </section>
                            <section id="modalita-accesso" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Modalità di accesso al finanziamento</h3>
                                <div class="row">
                                    <div class="richtext-wrapper lora">
                                        <p>
                                            <?php echo $modalita_accesso; ?>
                                        </p>
                                    </div>
                                </div>
                            </section>
                            <?php if (is_array($attivita_finanziate) && count($attivita_finanziate)) { ?>
                                <section id="attivita-finanziate" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Attività finanziate</h3>
                                    <div class="row">
                                        <div class="richtext-wrapper lora">
                                            <ul>
                                                <?php foreach ($attivita_finanziate as $attivita) { ?>
                                                    <li>
                                                        <?php echo $attivita; ?>
                                                    </li>
                                                <?php  }
                                                ?>
                                            </ul>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>
                            <section id="avanzamento-progetto" class="it-page-section mb-4">
                                <h3 class="my-2 title-large-semi-bold">Avanzamento del progetto</h3>
                                <div class="row g-4">
                                    <div class="richtext-wrapper lora">
                                        <p>
                                            Consulta la documentazione per scoprire lo stato di avanzamento del progetto e il raggiungimento degli obiettivi.
                                        </p>
                                        <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                            <?php
                                            $avanzamento = get_post($avanzamento_progetto);
                                            ?>
                                            <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                                <svg class="icon" aria-hidden="true">
                                                    <use xlink:href="#it-clip"></use>
                                                </svg>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a class="text-decoration-none" href="<?php echo get_the_guid($avanzamento); ?>" aria-label="Scarica l'allegato <?php echo $avanzamento->post_title; ?>" title="Scarica l'allegato <?php echo $avanzamento->post_title; ?>">
                                                            <?php echo $avanzamento->post_title; ?>
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                            </section>
                            <?php if (is_array($atti_legislativi) && count(value: $atti_legislativi)) { ?>
                                <section id="atti-legislativi" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Atti legislativi e amministrativi</h3>
                                    <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                        <?php foreach ($atti_legislativi as $all_id) {
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
                            <?php if (is_array($altri_allegati) && count($altri_allegati)) { ?>
                                <section id="atti-legislativi" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Altri allegati</h3>
                                    <div class="card-wrapper card-teaser-wrapper card-teaser-wrapper-equal">
                                        <?php foreach ($altri_allegati as $all_id) {
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
                            <?php if ($uo_id) { ?>
                                <section id="contatti" class="it-page-section mb-4">
                                    <h2 class="mb-3" id="unita-organizzativa">Contatti</h2>
                                    <div class="row">
                                        <div class="col-12 col-md-8 col-lg-6 mb-30">
                                            <div class="card-wrapper rounded h-auto mt-10">
                                                <?php
                                                $with_border = true;
                                                get_template_part("template-parts/unita-organizzativa/card-full");
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                <?php } ?>
                        </div>
                        </section>
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
