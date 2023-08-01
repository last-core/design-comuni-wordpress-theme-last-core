<?php

/**
 * Persona pubblica template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 * Developer : Andrea bersi
 */

global $immagini, $with_border;

get_header();
/**
 * inserimento variabili
 */
$user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);
$prefix = "_dci_persona_pubblica_";

setlocale(LC_ALL, 'it_IT');
$nome = dci_get_meta("nome", $prefix, $post->ID);
$cognome = dci_get_meta("cognome", $prefix, $post->ID);
$descrizione_breve = dci_get_meta("descrizione_breve", $prefix, $post->ID);
$incarichi = dci_get_meta("incarichi", $prefix, $post->ID);
$organizzazioni = dci_get_meta("organizzazioni", $prefix, $post->ID);
$responsabile_di = dci_get_meta("responsabile_di", $prefix, $post->ID);
$data_conclusione_incarico = strftime("%d %B %Y", DateTime::createFromFormat('d-m-Y', dci_get_meta("data_conclusione_incarico", $prefix, $post->ID)));
$competenze = dci_get_wysiwyg_field("competenze", $prefix, $post->ID);
$deleghe = dci_get_wysiwyg_field("deleghe", $prefix, $post->ID);
$biografia = dci_get_wysiwyg_field("biografia", $prefix, $post->ID);
$immagini = get_post_meta($post->ID, "_dci_persona_pubblica_gallery", false);
$punti_contatto = dci_get_meta("punti_contatto", $prefix, $post->ID);
$url_curriculum_vitae = dci_get_meta("curriculum_vitae", $prefix, $post->ID);
$situazione_patrimoniale = dci_get_wysiwyg_field("situazione_patrimoniale", $prefix, $post->ID);
$urls_dichiarazione_redditi = get_post_meta($post->ID, "_dci_persona_pubblica_dichiarazione_redditi", false);
$urls_spese_elettorali = get_post_meta($post->ID, "_dci_persona_pubblica_spese_elettorali", false);
$urls_variazione_situazione_patrimoniale = get_post_meta($post->ID, "_dci_persona_pubblica_variazione_situazione_patrimoniale", false);
$urls_altre_cariche = get_post_meta($post->ID, "_dci_persona_pubblica_altre_cariche", false);
$ulteriori_informazioni =  dci_get_wysiwyg_field("ulteriori_informazioni", $prefix, $post->ID);
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

                                <!-- quale data element?? -->
                                <p class="subtitle-small mb-3" data-element="persona-description">
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
                <hr class="d-none d-lg-block mt-2" />
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
                                                                    <a class="nav-link" href="#incarico">
                                                                        <span class="title-medium">Incarico</span>
                                                                    </a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#tipo_incarico">
                                                                        <span class="title-medium">Tipo di incarico</span>
                                                                    </a>
                                                                </li>
                                                                <?php if (trim($data_conclusione_incarico) !== "") { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#data_conclusione_incarico">
                                                                            <span class="title-medium">Data conclusione incarico</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if ($organizzazioni && is_array($organizzazioni) && count($organizzazioni) > 0) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#organizzazioni">
                                                                            <span class="title-medium">Organizzazione</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <li class="nav-item">
                                                                    <a class="nav-link" href="#responsabile_di">
                                                                        <span class="title-medium">Responsabile</span>
                                                                    </a>
                                                                </li>

                                                                <?php if (trim($competenze) !== "") { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#competenze">
                                                                            <span class="title-medium">Competenze</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if (trim($deleghe) !== "") { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#deleghe">
                                                                            <span class="title-medium">Deleghe</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if (trim($biografia) !== "") { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#biografia">
                                                                            <span class="title-medium">Biografia</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if ($immagini && is_array($immagini) && count($immagini) > 0) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#galleria">
                                                                            <span class="title-medium">Galleria immagini</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if ($punti_contatto && is_array($punti_contatto) && count($punti_contatto) > 0) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#contatti">
                                                                            <span class="title-medium">Contatti</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if ($url_curriculum_vitae) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#curriculum_vitae">
                                                                            <span class="title-medium">Curriculum Vitae</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if ($situazione_patrimoniale) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#situazione_patrimoniale">
                                                                            <span class="title-medium">Situazione Patrimoniale</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if ($urls_dichiarazione_redditi) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#dichiarazione_redditi">
                                                                            <span class="title-medium">Dichiarazione dei redditi</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if ($urls_spese_elettorali) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#spese_elettorali">
                                                                            <span class="title-medium">Spese elettorali</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if ($urls_variazione_situazione_patrimoniale) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#variazione_situazione_patrimoniale">
                                                                            <span class="title-medium">Variazione situazione patrimoniale</span>
                                                                        </a>
                                                                    </li>
                                                                <?php } ?>

                                                                <?php if ($urls_altre_cariche) { ?>
                                                                    <li class="nav-item">
                                                                        <a class="nav-link" href="#altre_cariche">
                                                                            <span class="title-medium">Altre cariche</span>
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

                            <?php if (is_array($incarichi) && count($incarichi)) { ?>
                                <section id="incarico" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Incarichi</h3>
                                    <?php
                                    //creo un array degli incarichi in modo da poterlo implodere mettendo le virgole
                                    $lista_incarichi = $tipo_incarichi = [];
                                    foreach ($incarichi as $incarico) {
                                        $incarico_ = get_post($incarico);
                                        $lista_incarichi[] = $incarico_->post_title;
                                        $a = get_the_terms($incarico_, 'tipi_incarico');
                                        $tipo_incarichi[] = $a[0]->name;
                                    }
                                    //stampo elenco
                                    echo implode(" - ", $lista_incarichi);
                                    ?>
                                </section>

                                <section id="tipo_incarico" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Tipo incarico</h3>
                                    <?php
                                    echo implode(" - ", $tipo_incarichi);
                                    ?>
                                </section>
                            <?php } ?>

                            <?php if (trim($data_conclusione_incarico) !== "") { ?>
                                <section id="data_conclusione_incarico" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Data conclusione incarico</h3>
                                    <div class="richtext-wrapper lora">
                                        <?php echo $data_conclusione_incarico; ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php
                            if ($organizzazioni && is_array($organizzazioni) && count($organizzazioni) > 0) { ?>
                                <section id="organizzazioni" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Organizzazione</h3>
                                    <div class="richtext-wrapper lora">
                                        <?php foreach ($organizzazioni as $organizzazioni_id) {
                                            $servizio = get_post($organizzazioni_id);
                                            $with_border = true;
                                            get_template_part("template-parts/servizio/card");
                                        } ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php
                            if ($responsabile_di) { ?>
                                <section id="responsabile_di" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Struttura responsabile</h3>
                                    <div class="richtext-wrapper lora">
                                        <?php
                                        $servizio = get_post($responsabile_di);
                                        $with_border = true;
                                        get_template_part("template-parts/servizio/card");
                                        ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if (trim($competenze) !== "") { ?>
                                <section id="competenze" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Competenze</h3>
                                    <div class="richtext-wrapper lora">
                                        <?php echo $competenze; ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if (trim($deleghe) !== "") { ?>
                                <section id="deleghe" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Competenze</h3>
                                    <div class="richtext-wrapper lora">
                                        <?php echo $deleghe; ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if (trim($biografia) !== "") { ?>
                                <section id="biografia" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Biografia</h3>
                                    <div class="richtext-wrapper lora">
                                        <?php echo $biografia; ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if ($immagini) { ?>
                                <section id="immagini" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Galleria immagini</h2>
                                        <?php
                                        get_template_part("template-parts/persona/galleria");
                                        ?>
                                </section>
                            <?php } ?>

                            <?php if ($punti_contatto && is_array($punti_contatto) && count($punti_contatto) > 0) { ?>
                                <section id="contatti" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Contatti</h3>
                                    <div class="row">
                                        <?php foreach ($punti_contatto as $pc_id) { ?>
                                            <div class="col-xl-6 col-lg-8 col-md-12 ">
                                                <?php
                                                $with_border = true;
                                                get_template_part("template-parts/punto-contatto/card"); ?>
                                            </div>
                                        <?php  } ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if ($url_curriculum_vitae) { ?>
                                <section id="curriculum_vitae" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Curriculum vitae</h3>
                                    <div class="cmp-card-latest-messages mb-3 mb-30">
                                        <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                            <svg class="icon" aria-hidden="true">
                                                <use xlink:href="#it-clip"></use>
                                            </svg>
                                            <div class="card-body">
                                                <h5 class="card-title">
                                                    <a class="text-decoration-none" href="<?php echo $url_curriculum_vitae; ?>" aria-label="Scarica il curriculum vitae di <?php echo $post->post_title; ?>" title="Scarica il curriculum vitae di <?php echo $post->post_title; ?>" target="_blank">
                                                        CV <?php echo $post->post_title; ?> (<?php echo getFileSize($url_curriculum_vitae); ?>)
                                                    </a>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if ($situazione_patrimoniale) { ?>
                                <section id="situazione_patrimoniale" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Situazione patrimoniale</h3>
                                    <div class="richtext-wrapper lora">
                                        <?php echo $situazione_patrimoniale; ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if ($urls_dichiarazione_redditi) { ?>
                                <section id="situazione_patrimoniale" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Dichiarazione dei redditi</h3>
                                    <div class="cmp-card-latest-messages mb-3 mb-30">
                                        <?php foreach ($urls_dichiarazione_redditi[0] as $url_dichiarazione_redditi) {
                                            $dichiarazione_redditi = wp_parse_url($url_dichiarazione_redditi);
                                            $nome_file_ext = wp_basename($url_dichiarazione_redditi);
                                            $filetype = wp_check_filetype_and_ext($url_dichiarazione_redditi, $nome_file_ext);
                                            $estensione = $filetype["ext"];
                                            $nome_file = substr($nome_file_ext, 0, -strlen($estensione) - 1);
                                        ?>
                                            <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                                <svg class="icon" aria-hidden="true">
                                                    <use xlink:href="#it-clip"></use>
                                                </svg>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a class="text-decoration-none" href="<?php echo $url_dichiarazione_redditi; ?>" aria-label="Download di <?php echo $nome_file; ?> di <?php echo $post->post_title; ?>" title="Download di <?php echo $nome_file; ?> di <?php echo $post->post_title; ?>" target="_blank">
                                                            <?php echo $nome_file; ?> (<?php echo getFileSize($url_dichiarazione_redditi); ?>)
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if ($urls_spese_elettorali) { ?>
                                <section id="situazione_patrimoniale" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Spese elettorali</h3>
                                    <div class="cmp-card-latest-messages mb-3 mb-30">
                                        <?php foreach ($urls_spese_elettorali[0] as $url_spese_elettorali) {
                                            $spese_elettorali = wp_parse_url($url_spese_elettorali);
                                            $nome_file_ext = wp_basename($url_spese_elettorali);
                                            $filetype = wp_check_filetype_and_ext($url_spese_elettorali, $nome_file_ext);
                                            $estensione = $filetype["ext"];
                                            $nome_file = substr($nome_file_ext, 0, -strlen($estensione) - 1);
                                        ?>
                                            <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                                <svg class="icon" aria-hidden="true">
                                                    <use xlink:href="#it-clip"></use>
                                                </svg>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a class="text-decoration-none" href="<?php echo $url_spese_elettorali; ?>" aria-label="Download di <?php echo $nome_file; ?> di <?php echo $post->post_title; ?>" title="Download di <?php echo $nome_file; ?> di <?php echo $post->post_title; ?>" target="_blank">
                                                            <?php echo $nome_file; ?> (<?php echo getFileSize($url_spese_elettorali); ?>)
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if ($urls_dichiarazione_redditi) { ?>
                                <section id="situazione_patrimoniale" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Variazione situazione patrimoniale</h3>
                                    <div class="cmp-card-latest-messages mb-3 mb-30">
                                        <?php foreach ($urls_variazione_situazione_patrimoniale[0] as $url_variazione_situazione_patrimoniale) {
                                            $variazione_situazione_patrimoniale = wp_parse_url($url_variazione_situazione_patrimoniale);
                                            $nome_file_ext = wp_basename($url_variazione_situazione_patrimoniale);
                                            $filetype = wp_check_filetype_and_ext($url_spese_elettorali, $nome_file_ext);
                                            $estensione = $filetype["ext"];
                                            $nome_file = substr($nome_file_ext, 0, -strlen($estensione) - 1);
                                        ?>
                                            <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                                <svg class="icon" aria-hidden="true">
                                                    <use xlink:href="#it-clip"></use>
                                                </svg>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a class="text-decoration-none" href="<?php echo $url_variazione_situazione_patrimoniale; ?>" aria-label="Download di <?php echo $nome_file; ?> di <?php echo $post->post_title; ?>" title="Download di <?php echo $nome_file; ?> di <?php echo $post->post_title; ?>" target="_blank">
                                                            <?php echo $nome_file; ?> (<?php echo getFileSize($url_variazione_situazione_patrimoniale); ?>)
                                                        </a>
                                                    </h5>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </section>
                            <?php } ?>

                            <?php if ($urls_altre_cariche) { ?>
                                <section id="altre_cariche" class="it-page-section mb-4">
                                    <h3 class="my-2 title-large-semi-bold">Altre cariche</h3>
                                    <div class="cmp-card-latest-messages mb-3 mb-30">
                                        <?php foreach ($urls_altre_cariche[0] as $url_altre_cariche) {
                                            $altre_cariche = wp_parse_url($url_altre_cariche);
                                            $nome_file_ext = wp_basename($url_altre_cariche);
                                            $filetype = wp_check_filetype_and_ext($url_spese_elettorali, $nome_file_ext);
                                            $estensione = $filetype["ext"];
                                            $nome_file = substr($nome_file_ext, 0, -strlen($estensione) - 1);
                                        ?>
                                            <div class="card card-teaser shadow-sm p-4 mt-3 rounded border border-light flex-nowrap">
                                                <svg class="icon" aria-hidden="true">
                                                    <use xlink:href="#it-clip"></use>
                                                </svg>
                                                <div class="card-body">
                                                    <h5 class="card-title">
                                                        <a class="text-decoration-none" href="<?php echo $url_altre_cariche; ?>" aria-label="Download di <?php echo $nome_file; ?> di <?php echo $post->post_title; ?>" title="Download di <?php echo $nome_file; ?> di <?php echo $post->post_title; ?>" target="_blank">
                                                            <?php echo $nome_file; ?> (<?php echo getFileSize($url_altre_cariche); ?>)
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
