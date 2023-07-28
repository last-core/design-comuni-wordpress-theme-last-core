<?php

/**
 * Unità Organizzativa template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Design_Comuni_Italia
 * Developer : Daniele Moggia
 */
global $uo_id, $file_url, $hide_arguments, $luogo;

get_header();
?>
<main>
  <?php
  while (have_posts()) :
    the_post();
    /**
     * inserimento variabili
     */
    $user_can_view_post = dci_members_can_user_view_post(get_current_user_id(), $post->ID);
    $prefix = "_dci_luogo_";

    $immagine = dci_get_meta("immagine", $prefix, $post->ID);
    $descrizione_breve = dci_get_meta("descrizione_breve", $prefix, $post->ID);
    $nome_alternativo = dci_get_meta("nome_alternativo", $prefix, $post->ID);
    $descrizione = dci_get_meta("descrizione", $prefix, $post->ID);
    $descrizione_estesa = dci_get_meta("descrizione_estesa", $prefix, $post->ID);
    $box_descrizione = dci_get_meta("box_descrizione", $prefix, $post->ID);
    $luoghi_collegati = dci_get_meta("luoghi_collegati", $prefix, $post->ID);
    $servizi = dci_get_meta("servizi", $prefix, $post->ID);
    $modalita_accesso = dci_get_meta("modalita_accesso", $prefix, $post->ID);
    $luogo_indirizzo = dci_get_meta("indirizzo", $prefix, $post->ID);
    $luogo_quartiere = dci_get_meta("quartiere", $prefix, $post->ID);
    $circoscrizione =  dci_get_meta("circoscrizione", $prefix, $post->ID);
    $cap = dci_get_meta("cap", $prefix, $post->ID);
    $luogo_evento = get_post($post->ID);
    $orario_pubblico = dci_get_meta("orario_pubblico", $prefix, $post->ID);
    $punti_contatto = dci_get_meta("punti_contatto", $prefix, $post->ID);
    $struttura_responsabile = dci_get_meta("struttura_responsabile", $prefix, $post->ID);
    $sede_di = dci_get_meta("sede_di", $prefix, $post->ID);
    $ulteriori_informazioni =  dci_get_wysiwyg_field("ulteriori_informazioni", $prefix, $post->ID);
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
                <h3><?php echo $nome_alternativo ?> </h3>
                <!-- quale data element?? -->
                <p class="subtitle-small mb-3" data-element="luogo-description">
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
														<?php if ($descrizione_estesa) { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#descrizione">
                                                                    <span class="title-medium">Descrizione</span>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($luoghi_collegati) { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#luoghi-collegati">
                                                                    <span class="title-medium">Luoghi collegati</span>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if ($servizi) { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#servizi">
                                                                    <span class="title-medium">Servizi offerti</span>
                                                                </a>
                                                            </li>
														<?php } ?>
                                                        <?php if ($modalita_accesso) { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#modalita-accesso">
                                                                    <span class="title-medium">Modalità di accesso</span>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                        								<?php if ($luogo_evento) { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#indirizzo">
                                                                    <span class="title-medium">Indirizzo</span>
                                                                </a>
                                                            </li>
														<?php } ?>
                        								<?php if ($orario_pubblico) { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#orario-pubblico">
                                                                    <span class="title-medium">Orario per il pubblico</span>
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
														<?php if ($struttura_responsabile && is_array($struttura_responsabile) && count($struttura_responsabile) > 0) { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#struttura-responsabile">
                                                                    <span class="title-medium">Struttura responsabile</span>
                                                                </a>
                                                            </li>
														<?php } ?>
														<?php if( is_array($sede_di) && count($sede_di) ) { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#sede">
                                                                <span class="title-medium">Sedi</span>
                                                                </a>
                                                            </li>
                                                        <?php } ?>
                                                        <?php if(trim($ulteriori_informazioni)!=="") { ?>
                                                            <li class="nav-item">
                                                                <a class="nav-link" href="#ulteriori_informazioni">
                                                                <span class="title-medium">Ulteriori informazioni</span>
                                                                </a>
                                                            </li>
                                                        <?php }?>
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
                        <h3 class="my-2 title-large-semi-bold">Descrizione</h3>
                        <div class="richtext-wrapper lora">
							<?php echo $descrizione_estesa ?>
                        </div>
                    </section>
                    <?php if( is_array($luoghi_collegati) && count($luoghi_collegati) ) { ?>
                    <section id="luoghi-collegati" class="it-page-section mb-4">
                        <h3 class="my-2 title-large-semi-bold">Luoghi collegati</h3>
                        <div class="richtext-wrapper lora">
                          <div class="row g-2">
                          <?php foreach ($luoghi_collegati as $luoghi_collegati_id) { ?>
                            <div class="col-lg-6 col-md-12">
                            <?php
                            $post = get_post($luoghi_collegati_id);
                            $with_border = false;
                            get_template_part("template-parts/luogo/card-ico");
                            ?>
                            </div>
                            <?php } ?>
                          </div>
                        </div>
                    </section>
                    <?php } ?>
                    <section id="servizi" class="it-page-section mb-4">
                        <h3 class="my-2 title-large-semi-bold">Servizi offerti</h3>
                        <div class="richtext-wrapper lora">
						    <?php echo $servizi ?>
                        </div>
                    </section>
                    <section id="modalita-accesso" class="it-page-section mb-4">
                        <h3 class="my-2 title-large-semi-bold">Modalità di accesso</h3>
                        <div class="richtext-wrapper lora">
                            <?php echo $modalita_accesso ?>
                        </div>
                    </section>
                    <section id="indirizzo" class="it-page-section mb-4">
                        <h3 class="my-2 title-large-semi-bold">Indirizzo</h3>
                        <div class="richtext-wrapper lora">
                            <p><?php echo nl2br($luogo_indirizzo); ?> <?php echo $cap?></p>
                            <p><?php echo nl2br($luogo_quartiere); ?></p>
                            <p><?php echo nl2br($circoscrizione); ?></p>
                        </div>
                        <?php
                            $luoghi = array(get_post($post->ID));
                            get_template_part("template-parts/luogo/map");
                        ?>
                    </section>
                    <section id="orario-pubblico" class="it-page-section mb-4">
                        <h3 class="my-2 title-large-semi-bold">Orario per il pubblico</h3>
                        <div class="richtext-wrapper lora">
							 <?php echo $orario_pubblico ?>
                        </div>
                    </section>
                    <?php if ($punti_contatto && is_array($punti_contatto) && count($punti_contatto) > 0) { ?>
                    <section id="contatti" class="it-page-section mb-4">
                        <h3 class="my-2 title-large-semi-bold">Contatti</h3>
                        <div class="richtext-wrapper lora">
                          <div class="row g-2">
                          <?php foreach ($punti_contatto as $pc_id) { ?>
                            <div class="col-lg-6 col-md-12">
                              <?php get_template_part('template-parts/single/punto-contatto'); ?>
                            </div>
                           <?php } ?>
                          </>
                        </div>
                    </section>
                    <?php } ?>
                    <?php if ($struttura_responsabile && is_array($struttura_responsabile) && count($struttura_responsabile) > 0) { ?>
                    <section id="struttura-responsabile" class="it-page-section mb-4">
                        <h3 class="my-2 title-large-semi-bold">Struttura responsabile</h3>
                        <div class="richtext-wrapper lora">
						    <?php foreach ($struttura_responsabile as $struttura_responsabile_id) {
                                $servizio = get_post($struttura_responsabile_id);
                                $with_border = true;
                                get_template_part("template-parts/servizio/card");
                            } ?>
                        </div>
                    </section>
                    <?php } ?>
                    <?php if ($sede_di && is_array($sede_di) && count($sede_di) > 0) { ?>
                    <section id="sede" class="it-page-section mb-4">
                        <h3 class="my-2 title-large-semi-bold">Sede</h3>
                        <div class="richtext-wrapper lora">
                            <?php foreach ($sede_di as $uo_id) { ?>
                                <div class="col-xl-6 col-lg-8 col-md-12 ">
									<?php
									$with_border = true;
									get_template_part("template-parts/unita-organizzativa/card"); ?>
                                </div>
							<?php  } ?>
                        </div>
                    </section>
					<?php } ?>	
                    <?php if(trim($ulteriori_informazioni)!=="") { ?>
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
    
    <?php get_template_part("template-parts/common/valuta-servizio"); ?>
  	<?php get_template_part("template-parts/common/assistenza-contatti"); ?>

  <?php
  endwhile; // End of the loop.
  ?>
</main>
<?php
get_footer();
