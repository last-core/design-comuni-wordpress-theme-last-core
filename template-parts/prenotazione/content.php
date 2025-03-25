<?php
if($_GET["servizio"]){
    $_servizio = get_posts(array(
        "name" => $_GET["servizio"],
        'posts_per_page' => 1,
        'post_type' => 'servizio'
    ));
}
$servizio = $_GET["servizio"] && count($_servizio) > 0 ? $_servizio[0] : null;
$uffici = get_posts(array(
    'posts_per_page' => -1,
    'post_type' => 'unita_organizzativa'
));

$months = array();
$currentMonth = intval(date('m'));

for ($i = 0; $i < 12; $i++) {
    array_push($months, $currentMonth);
    if ($currentMonth >= 12) $currentMonth = 0;
    $currentMonth++;
}
?>

<div class="it-page-sections-container">

    <!-- Step 1 -->
    <section class="firstStep page-step active it-page-section" data-steps="1">
        <div class="row justify-content-center mt-4">
            <div class="col-12 col-lg-8 px-40 px-lg-80">
                <p class="text-paragraph mb-lg-4">
                    <?php
                    echo $nome_comune; ?> gestisce i dati personali forniti e liberamente comunicati sulla base dell’articolo 13
                    del Regolamento (UE) 2016/679 General data protection regulation (Gdpr) e degli articoli 13 e successive
                    modifiche e integrazione del decreto legislativo (di seguito d.lgs) 267/2000 (Testo unico enti locali).
                </p>
                <p class="text-paragraph mb-0">
                    Per i dettagli sul trattamento dei dati personali consulta l’
                    <a href="<?php echo get_privacy_policy_url(); ?>" class="t-primary">informativa sulla privacy.</a>
                </p>

                <div class="form-check mt-4 mb-3 mt-md-40 mb-lg-40">
                    <div class="checkbox-body d-flex align-items-center">
                        <input type="checkbox" id="privacy" name="privacy" value="1" required>
                        <label class="title-small-semi-bold pt-1" for="privacy">Ho letto e compreso l’informativa sulla
                            privacy</label>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Step 1 -->
    <section class="d-none page-step it-page-section" data-steps="2">
        <div class="cmp-card mb-40" id="office">
            <div class="card has-bkg-grey shadow-sm p-big">
                <div class="card-header border-0 p-0 mb-lg-30">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-0">Ufficio*</h2>
                    </div>
                    <p class="subtitle-small mb-0">
                        Scegli l’ufficio a cui vuoi richiedere l’appuntamento
                    </p>
                </div>
                <div class="card-body p-0">
                    <div class="select-wrapper p-0 select-partials">
                        <label for="office-choice" class="visually-hidden">
                            Tipo di ufficio
                        </label>
                        <select id="office-choice" class="">
                            <option selected="selected" value="">
                                Seleziona opzione
                            </option>
                            <?php foreach ($uffici as $ufficio) {
                                $servizi_offerti = dci_get_meta("elenco_servizi_offerti", '_dci_unita_organizzativa_', $ufficio->ID);
                                $prenota = dci_get_meta("prenota_appuntamento", '_dci_unita_organizzativa_', $ufficio->ID);
                                if (is_array($servizi_offerti) && count($servizi_offerti) && $prenota && ($servizio === null || in_array($servizio->ID, $servizi_offerti))) {
                                    echo '<option value="' . $ufficio->ID . '">' . $ufficio->post_title . '</option>';
                                }
                            } ?>
                        </select>
                    </div>
                    <fieldset id="place-cards-wrapper"></fieldset>
                </div>
            </div>
        </div>
    </section>

    <!-- Step 2 -->
    <section class="d-none page-step it-page-section" data-steps="3">
        <div class="cmp-card mb-40" id="appointment-available">
            <div class="card has-bkg-grey shadow-sm p-big">
                <div class="card-header border-0 p-0 mb-lg-30">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-2">
                            Appuntamenti disponibili*
                        </h2>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="select-wrapper p-0 mt-1 select-partials">
                        <label for="appointment" class="visually-hidden">
                            Seleziona un mese
                        </label>
                        <select id="appointment" class="">
                            <option selected="selected" value="">
                                Seleziona un mese
                            </option>
                            <?php foreach ($months as $month) {
                                echo '<option value="' . $month . '">' . date_i18n('F', mktime(0, 0, 0, $month, 10)) . '</option>';
                            } ?>
                        </select>
                    </div>
                    <fieldset id="date-appointment-div">
                    </fieldset>
                    <fieldset id="hour-appointment-div">
                        <div class="card-body p-0">
                            <div class="form-check m-0">
                                Nessun appuntamento disponibile.
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="cmp-card mb-40" id="office-2">
            <div class="card has-bkg-grey shadow-sm p-big">
                <div class="card-header border-0 p-0 mb-lg-30">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-0">Ufficio</h2>
                    </div>
                </div>
                <div class="card-body p-0" id="selected-place-card"></div>
            </div>
        </div>
    </section>

    <!-- Step 3 -->
    <section class="d-none page-step it-page-section" data-steps="4">
        <div class="cmp-card mb-40" id="reason">
            <div class="card has-bkg-grey shadow-sm p-big">
                <div class="card-header border-0 p-0 mb-lg-30 mb-3">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-0">Motivo*</h2>
                    </div>
                    <p class="subtitle-small mb-0">
                        Scegli il motivo dell’appuntamento
                    </p>
                </div>
                <div class="card-body p-0">
                    <div class="select-wrapper p-0 select-partials">
                        <label for="motivo-appuntamento" class="visually-hidden">
                            Motivo dell&#x27;appuntamento
                        </label>
                        <select id="motivo-appuntamento" class=""></select>
                    </div>
                </div>
            </div>
        </div>

        <div class="cmp-card mb-40" id="details">
            <div class="card has-bkg-grey shadow-sm p-big">
                <div class="card-header border-0 p-0 mb-lg-30 m-0">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-0">
                            Dettagli*
                        </h2>
                    </div>
                    <p class="subtitle-small mb-0 mb-3">
                        Aggiungi ulteriori dettagli
                    </p>
                </div>
                <div class="card-body p-0">
                    <div class="cmp-text-area p-0">
                        <div class="form-group">
                            <label for="form-details" class="visually-hidden">
                                Aggiungi ulteriori dettagli
                            </label>
                            <textarea class="text-area" id="form-details" rows="2"></textarea>
                            <span class="label">
                                Inserire massimo 200 caratteri
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Step 4 -->
    <section class="d-none page-step it-page-section" data-steps="5">
        <p class="subtitle-small pb-40 mb-0 d-lg-none">
            Hai un’identità digitale SPID o CIE?
            <a class="title-small-semi-bold t-primary underline" href="./iscrizione-graduatoria-accedere-servizio.html">
                Accedi
            </a>
        </p>
        <div class="cmp-card" id="applicant">
            <div class="card has-bkg-grey shadow-sm p-big">
                <div class="card-header border-0 p-0 mb-lg-30 m-0">
                    <div class="d-flex">
                        <h2 class="title-xxlarge mb-3">
                            Richiedente
                        </h2>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="form-wrapper bg-white p-4">
                        <div class="form-group cmp-input mb-0">
                            <label class="cmp-input__label" for="name">
                                Nome*
                            </label>
                            <input type="text" class="form-control" id="name" name="name" required />
                            <div class="d-flex">
                                <span class="form-text cmp-input__text">
                                    Inserisci il tuo nome
                                </span>
                            </div>
                        </div>

                        <div class="form-group cmp-input mb-0">
                            <label class="cmp-input__label" for="surname">
                                Cognome*
                            </label>
                            <input type="text" class="form-control" id="surname" name="surname" required />
                            <div class="d-flex">
                                <span class="form-text cmp-input__text">
                                    Inserisci il tuo cognome
                                </span>
                            </div>
                        </div>

                        <div class="form-group cmp-input mb-0">
                            <label class="cmp-input__label" for="email">
                                Email*
                            </label>
                            <input type="email" class="form-control" id="email" name="email" required />
                            <div class="d-flex">
                                <span class="form-text cmp-input__text">
                                    Inserisci la tua email
                                </span>
                            </div>
                        </div>

                        <div class="form-group cmp-input mb-0">
                            <label class="cmp-input__label" for="telefono">
                                Telefono
                            </label>
                            <input type="text" class="form-control" id="telefono" name="telefono" />
                            <div class="d-flex">
                                <span class="form-text cmp-input__text">
                                    Inserisci il tuo numero di telefono
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Step 5 -->
    <section class="d-none page-step it-page-section" data-steps="6">
        <div class="mt-2">
            <h2 class="visually-hidden">Dettagli dell'appuntamento</h2>
            <div class="cmp-card mb-4">
                <div class="card has-bkg-grey shadow-sm mb-0">
                    <div class="card-header border-0 p-0 mb-lg-30">
                        <div class="d-flex">
                            <h3 class="subtitle-large mb-0">Riepilogo</h3>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="cmp-info-summary bg-white mb-3 mb-lg-4 p-3 p-lg-4">
                            <div class="card">
                                <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                    <h4 class="title-large-semi-bold mb-3">
                                        Ufficio
                                    </h4>
                                    <a href="#" class="text-decoration-none" title="Modifica Ufficio" aria-label="Modifica Ufficio" onclick="goBackTo(4)">
                                        <span class="text-button-sm-semi t-primary">
                                            Modifica
                                        </span>
                                    </a>
                                </div>

                                <div class="card-body p-0">
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">
                                            Tipologia ufficio
                                        </div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-office"></p>
                                        </div>
                                    </div>
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">
                                            Municipalità
                                        </div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-place"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0"></div>
                            </div>
                        </div>
                        <div class="cmp-info-summary bg-white mb-3 mb-lg-4 p-3 p-lg-4">
                            <div class="card">
                                <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                    <h4 class="title-large-semi-bold mb-3">
                                        Data e orario
                                    </h4>
                                    <a href="#" class="text-decoration-none" title="Modifica Data e orario" aria-label="Modifica Data e orario" onclick="goBackTo(3)">
                                        <span class="text-button-sm-semi t-primary">
                                            Modifica
                                        </span>
                                    </a>
                                </div>

                                <div class="card-body p-0">
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Data</div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-date"></p>
                                        </div>
                                    </div>
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Ora</div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-hour"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0"></div>
                            </div>
                        </div>
                        <div class="cmp-info-summary bg-white mb-3 mb-lg-4 p-3 p-lg-4">
                            <div class="card">
                                <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                    <h4 class="title-large-semi-bold mb-3">
                                        Dettagli appuntamento
                                    </h4>
                                    <a href="#" class="text-decoration-none" title="Modifica Dettagli appuntamento" aria-label="Modifica Dettagli appuntamento" onclick="goBackTo(2)">
                                        <span class="text-button-sm-semi t-primary">
                                            Modifica
                                        </span>
                                    </a>
                                </div>

                                <div class="card-body p-0">
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Motivo</div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-service"></p>
                                        </div>
                                    </div>
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Dettagli</div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-details"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0"></div>
                            </div>
                        </div>
                        <div class="cmp-info-summary bg-white p-3 p-lg-4 mb-0">
                            <div class="card">
                                <div class="card-header border-bottom border-light p-0 mb-0 d-flex justify-content-between d-flex justify-content-end">
                                    <h4 class="title-large-semi-bold mb-3">
                                        Richiedente
                                    </h4>
                                    <a href="#" class="text-decoration-none" title="Modifica Richiedente" aria-label="Modifica Richiedente" onclick="goBackTo(1)">
                                        <span class="text-button-sm-semi t-primary">
                                            Modifica
                                        </span>
                                    </a>
                                </div>

                                <div class="card-body p-0">
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Nome</div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-name"></p>
                                        </div>
                                    </div>
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Cognome</div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-surname"></p>
                                        </div>
                                    </div>
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Email</div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-email"></p>
                                        </div>
                                    </div>
                                    <div class="single-line-info border-light">
                                        <div class="text-paragraph-small">Telefono</div>
                                        <div class="border-light">
                                            <p class="data-text" id="review-telefono"></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer p-0"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

</div>