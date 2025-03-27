<?php

/**
 * Estendo Wordpress Rest Api
 */
function dci_register_sedi_route()
{
    register_rest_route('wp/v2', '/sedi/ufficio/', array(
        'methods' => 'GET',
        'callback' => 'dci_get_sedi_ufficio'
    ));
}
add_action('rest_api_init', 'dci_register_sedi_route');

/**
 * restituisce i luoghi che sono referenziati come sedi dell'Unità Organizzativa passata come parametro (id o title)
 * @param WP_REST_Request $request
 * @return array[]
 */
function dci_get_sedi_ufficio(WP_REST_Request $request)
{

    $params = $_GET;
    if (array_key_exists('title', $params)) {
        $ufficio  = get_page_by_title($params['title'], OBJECT, 'unita_organizzativa');
        $id = $ufficio->ID;
    } else if (array_key_exists('id', $params)) {
        $id = $params['id'];
    }

    $sedi_ids = array();
    $sede_principale = dci_get_meta('sede_principale', '_dci_unita_organizzativa_', $id);

    if ($sede_principale != '') {
        $sedi_ids[] = $sede_principale;
    }

    $altre_sedi[] = dci_get_meta('altre_sedi', '_dci_unita_organizzativa_', $id);

    if (!empty($altre_sedi[0])) {
        foreach ($altre_sedi[0] as $sede) {
            if ($sede != $sede_principale) {
                $sedi_ids[] = $sede;
            }
        }
    }

    if (!isset($id)) {
        return array(
            "error" => array(
                "code" =>  400,
                "message" => "Oops, qualcosa è andato storto!"
            )
        );
    }

    $sedi = array();

    $sedi = get_posts([
        'post_type' => 'luogo',
        'post_status' => 'publish',
        'numberposts' => -1,
        'post__in' => $sedi_ids,
        'order_by' => 'post__in'
    ]);

    foreach ($sedi as $sede) {
        $sede->indirizzo = dci_get_meta('indirizzo', '_dci_luogo_', $sede->ID);
        $sede->apertura = dci_get_wysiwyg_field('orario_pubblico', '_dci_luogo_', $sede->ID);
        $sede->identificativo = dci_get_meta('id', '_dci_luogo_', $sede->ID);
    }

    return $sedi;
}


/**
 * Estendo Wordpress Rest Api
 */
function dci_register_servizi_ufficio_route()
{
    register_rest_route('wp/v2', '/servizi/ufficio/', array(
        'methods' => 'GET',
        'callback' => 'dci_get_servizi_ufficio'
    ));
}
add_action('rest_api_init', 'dci_register_servizi_ufficio_route');

/**
 * restituisce i servizi che sono disponibili presso l'Unità Organizzativa passata come parametro (id o title)
 * @param WP_REST_Request $request
 * @return array[]
 */
function dci_get_servizi_ufficio(WP_REST_Request $request)
{

    $params = $_GET;
    if (array_key_exists('title', $params)) {
        $ufficio  = get_page_by_title($params['title'], OBJECT, 'unita_organizzativa');
        $id = $ufficio->ID;
    } else if (array_key_exists('id', $params)) {
        $id = $params['id'];
    }

    if (!isset($id)) {
        return array(
            "error" => array(
                "code" =>  400,
                "message" => "Oops, qualcosa è andato storto!"
            )
        );
    }

    $servizi_ids = array();
    $servizi_ids = dci_get_meta('elenco_servizi_offerti', '_dci_unita_organizzativa_', $id);

    $servizi = array();

    if (!empty($servizi_ids)) {
        $servizi = get_posts([
            'post_type' => 'servizio',
            'post_status' => 'publish',
            'numberposts' => -1,
            'post__in' => $servizi_ids,
            'order_by' => 'post__in'
        ]);
    }

    return $servizi;
}
function dci_register_servizi_featured_route()
{
    register_rest_route('wp/v2', '/servizi/featured/', array(
        'methods' => 'GET',
        'callback' => 'dci_get_servizi_featured'
    ));
}
add_action('rest_api_init', 'dci_register_servizi_featured_route');

/**
 * @param WP_REST_Request $request
 * @return array[]
 */
function dci_get_servizi_featured()
{

    $servizi_ids = array();
    $servizi_ids = dci_get_option('servizi_evidenziati','servizi');
    $servizi = array();
    if (!empty($servizi_ids)) {
        $servizi = get_posts([
            'post_type' => 'servizio',
            'post_status' => 'publish',
            'numberposts' => -1,
            'post__in' => $servizi_ids,
            'order_by' => 'post__in'
        ]);
    }
    return $servizi;
}

function dci_register_prenotazioni_date_route()
{
    register_rest_route('wp/v2', '/prenotazioni/date/', array(
        'methods' => 'GET',
        'callback' => 'dci_get_prenotazioni_date'
    ));
}
add_action('rest_api_init', 'dci_register_prenotazioni_date_route');

/**
 * restituisce i servizi che sono disponibili presso l'Unità Organizzativa passata come parametro (id o title)
 * @param WP_REST_Request $request
 * @return array[]
 */
function dci_get_prenotazioni_date(WP_REST_Request $request)
{
    $params = $_GET;
    if (array_key_exists('month', $params)) {
        $month  = $params['month'];
    }
    if (array_key_exists('office', $params)) {
        $office_id = $params['office'];
    }
    if (!isset($month) || $month == '' || !isset($office_id) || $office_id == '') {
        return array(
            "error" => array(
                "code" =>  400,
                "message" => "Oops, qualcosa è andato storto!"
            )
        );
    }
    $fasce_orarie = dci_get_meta("fasce_orarie", '_dci_unita_organizzativa_', $office_id);
    $giorni_apertura = is_array($fasce_orarie) ? array_reduce($fasce_orarie, function ($p, $v) {
        return array_merge($p, $v['_dci_unita_organizzativa_giorni_apertura']);
    }, array()) : [];
    $giorni_chiusura = dci_get_meta("giorni_chiusura", '_dci_unita_organizzativa_', $office_id);
    $giorni_chiusura = is_array($giorni_chiusura) ? array_map(function ($a) {
        return $a['giorno_chiusura'];
    }, $giorni_chiusura) : [];
    $cur_month = date('m');
    $start_date = $cur_month == $month ? date('d') : '01';

    if ($cur_month <= $month) {
        $year = intval(date('Y'));
    } else {
        $year = intval(date('Y')) + 1;
    }

    $end_date = date('t', strtotime($year . '-' . $month . '-' . $start_date));

    $dates =
        new DatePeriod(
            new DateTime($year . '-' . $month . '-' . $start_date),
            new DateInterval('P1D'),
            new DateTime($year . '-' . $month . '-' . $end_date)
        );
    $res = array();
    foreach ($dates as $date) {
        if (!in_array($date->format('N'), $giorni_apertura)) continue;
        if (in_array($date->format('d-m-Y'), $giorni_chiusura)) continue;
        $res[] = $date->format('Y-m-d');
    }

    return $res;
}
function dci_register_prenotazioni_orari_route()
{
    register_rest_route('wp/v2', '/prenotazioni/orari/', array(
        'methods' => 'GET',
        'callback' => 'dci_get_prenotazioni_orari'
    ));
}
add_action('rest_api_init', 'dci_register_prenotazioni_orari_route');

/**
 * restituisce i servizi che sono disponibili presso l'Unità Organizzativa passata come parametro (id o title)
 * @param WP_REST_Request $request
 * @return array[]
 */
function dci_get_prenotazioni_orari(WP_REST_Request $request)
{

    $params = $_GET;
    if (array_key_exists('date', $params)) {
        $date  = $params['date'];
    }
    if (array_key_exists('office', $params)) {
        $office_id = $params['office'];
    }

    if (!isset($date) || $date == '' || !isset($office_id) || $office_id == '') {
        return array(
            "error" => array(
                "code" =>  400,
                "message" => "Oops, qualcosa è andato storto!"
            )
        );
    }
    $week_day = new DateTime($date);
    $week_day = $week_day->format('N');
    $fasce_orarie = dci_get_meta("fasce_orarie", '_dci_unita_organizzativa_', $office_id);
    $fasce_orarie = array_filter($fasce_orarie, function ($item) use ($week_day) {
        return in_array($week_day, $item['_dci_unita_organizzativa_giorni_apertura']);
    });
    $fasce_orarie = count($fasce_orarie) !== 0 ? array_values($fasce_orarie)[0] : [];
    $has_mattina = is_array($fasce_orarie['_dci_unita_organizzativa_periodo_apertura']) && in_array('1', $fasce_orarie['_dci_unita_organizzativa_periodo_apertura']) || $fasce_orarie['_dci_unita_organizzativa_periodo_apertura'] == '1';
    $has_pomeriggio = is_array($fasce_orarie['_dci_unita_organizzativa_periodo_apertura']) && in_array('2', $fasce_orarie['_dci_unita_organizzativa_periodo_apertura']) || $fasce_orarie['_dci_unita_organizzativa_periodo_apertura'] == '2';
    $orari_apertura_mattina = $has_mattina &&  $fasce_orarie['_dci_unita_organizzativa_orari_apertura_mattina'] ? $fasce_orarie['_dci_unita_organizzativa_orari_apertura_mattina'] : null;
    $orari_chiusura_mattina = $has_mattina && $fasce_orarie['_dci_unita_organizzativa_orari_chiusura_mattina'] ? $fasce_orarie['_dci_unita_organizzativa_orari_chiusura_mattina'] : null;
    $orari_apertura_pomeriggio = $has_pomeriggio && $fasce_orarie['_dci_unita_organizzativa_orari_apertura_pomeriggio'] ? $fasce_orarie['_dci_unita_organizzativa_orari_apertura_pomeriggio']  : null;
    $orari_chiusura_pomeriggio = $has_pomeriggio && $fasce_orarie['_dci_unita_organizzativa_orari_chiusura_pomeriggio']  ? $fasce_orarie['_dci_unita_organizzativa_orari_chiusura_pomeriggio']  : null;
    $durata_appuntamento = dci_get_meta("durata_appuntamento", '_dci_unita_organizzativa_', $office_id) ? dci_get_meta("durata_appuntamento", '_dci_unita_organizzativa_', $office_id) : 30;
    $max_per_appuntamento = dci_get_meta("max_per_appuntamento", '_dci_unita_organizzativa_', $office_id) ? intval(dci_get_meta("max_per_appuntamento", '_dci_unita_organizzativa_', $office_id)) : 1;
    $args = array('numberposts' => -1, 'post_status' => 'any', 'post_type' => 'appuntamento', 'meta_query' => array(
        array('key' => '_dci_appuntamento_unita_organizzativa_id', 'value' => $office_id),
        array('key' => '_dci_appuntamento_data_ora_inizio_appuntamento', 'value' =>  $date, 'compare' => 'LIKE')
    ));
    $prenotazioni = get_posts($args);
    $prenotazioni_selected = [];
    foreach ($prenotazioni as &$prenotazione) {
        $prenotazione = dci_get_meta("data_ora_inizio_appuntamento", '_dci_appuntamento_', $prenotazione->ID);
        $prenotazioni_selected[$prenotazione] = isset($prenotazioni_selected[$prenotazione]) ? $prenotazioni_selected[$prenotazione] + 1 : 1;
    }

    if ($orari_apertura_mattina && $orari_chiusura_mattina) {
        $dates =
            new DatePeriod(
                new DateTime($date . 'T' . $orari_apertura_mattina . ':00'),
                new DateInterval('PT' . $durata_appuntamento . 'M'),
                new DateTime($date . 'T' . $orari_chiusura_mattina . ':01')
            );
        $dates = iterator_to_array($dates);
    } else {
        $dates = [];
    }
    if ($orari_apertura_pomeriggio && $orari_chiusura_pomeriggio) {
        $datesP =  new DatePeriod(
            new DateTime($date . 'T' . $orari_apertura_pomeriggio . ':00'),
            new DateInterval('PT' . $durata_appuntamento . 'M'),
            new DateTime($date . 'T' . $orari_chiusura_pomeriggio . ':01')
        );
        $datesP = iterator_to_array($datesP);
    } else {
        $datesP = [];
    }
    $res = array();
    $count = count($dates);
    $countP = count($datesP);
    foreach ($dates as $i => $date) {
        $d = $date->format('Y-m-d\TH:i');
        if (isset($res[$i - 1]) && $i !== 0) {
            $res[$i - 1]['end_time'] = $d;
        }
        if (isset($prenotazioni_selected[$d]) && $prenotazioni_selected[$d] >= $max_per_appuntamento) continue;
        if ($count - 2 >= $i) {
            $res[$i] = array('start_time' => $d);
        }
    }
    foreach ($datesP as $i => $date) {
        $d = $date->format('Y-m-d\TH:i');
        $offset = $count === 0 ? 0 : $count - 1;
        if (isset($res[ $offset + $i - 1]) && $i !== 0) {
            $res[$offset + $i - 1]['end_time'] = $d;
        }
        if (isset($prenotazioni_selected[$d]) && $prenotazioni_selected[$d] >= $max_per_appuntamento) continue;
        if ($countP - 2 >= $i) {
            $res[$offset + $i] = array('start_time' => $d);
        }
    }
    return array_slice($res, 0);
}


/**
 * enqueue script dci-rating
 */
function dci_enqueue_dci_rating_script()
{
    wp_enqueue_script('dci-rating', get_template_directory_uri() . '/assets/js/rating.js', array('jquery'), null, true);
    $variables = array(
        'ajaxurl' => admin_url('admin-ajax.php')
    );
    wp_localize_script('dci-rating', "data", $variables);
}
add_action('wp_enqueue_scripts', 'dci_enqueue_dci_rating_script');

/**
 * crea contenuto di tipo Rating
 */
function dci_save_rating()
{

    $params = json_decode(json_encode($_POST), true);

    if ((array_key_exists("title", $params)) && ($params['title'] != null)) {
        $postId = wp_insert_post(array(
            'post_type' => 'rating',
            'post_title' =>  $params['title']
        ));
    }

    if ($postId == 0) {
        echo json_encode(array(
            "success" => false,
            "error" => array(
                "code" =>  400,
                "message" => "Oops, qualcosa è andato storto!"
            )
        ));
        wp_die();
    }

    if (array_key_exists("star", $params) && $params['star'] != "null") {
        wp_set_object_terms($postId, $params['star'], "stars");
        update_post_meta($postId, '_dci_rating_stelle',  $params['star']);
    }

    if (array_key_exists("radioResponse", $params) && $params['radioResponse'] != "null") {
        update_post_meta($postId, '_dci_rating_risposta_chiusa',  $params['radioResponse']);
    }

    if (array_key_exists("freeText", $params) && $params['freeText'] != "null") {
        update_post_meta($postId, '_dci_rating_risposta_aperta',  $params['freeText']);
    }

    if (array_key_exists("page", $params) && $params['page'] != "null") {
        update_post_meta($postId, '_dci_rating_url',  $params['page']);
        wp_set_object_terms($postId, $params['page'], "page_urls");
    }

    echo json_encode(array(
        "success" => true,
        "rating" => array(
            "id" => $postId
        )
    ));
    wp_die();
}
function dci_save_rating_rest(WP_REST_Request $request)
{

    $params = json_decode($request->get_body(), true);

    if ((array_key_exists("title", $params)) && ($params['title'] != null)) {
        $postId = wp_insert_post(array(
            'post_type' => 'rating',
            'post_title' =>  $params['title']
        ));
    }

    if ($postId == 0) {
        return new WP_Error('client_error', "Oops, qualcosa è andato storto!", array('status' => 400));
    }

    if (array_key_exists("star", $params) && $params['star'] != "null") {
        wp_set_object_terms($postId, $params['star'], "stars");
        update_post_meta($postId, '_dci_rating_stelle',  $params['star']);
    }

    if (array_key_exists("radioResponse", $params) && $params['radioResponse'] != "null") {
        update_post_meta($postId, '_dci_rating_risposta_chiusa',  $params['radioResponse']);
    }

    if (array_key_exists("freeText", $params) && $params['freeText'] != "null") {
        update_post_meta($postId, '_dci_rating_risposta_aperta',  $params['freeText']);
    }

    if (array_key_exists("page", $params) && $params['page'] != "null") {
        update_post_meta($postId, '_dci_rating_url',  $params['page']);
        wp_set_object_terms($postId, $params['page'], "page_urls");
    }

    return array(
        "success" => true,
        "rating" => array(
            "id" => $postId
        )
    );
}
add_action("wp_ajax_save_rating", "dci_save_rating");
add_action("wp_ajax_nopriv_save_rating", "dci_save_rating");
function dci_register_rating_route()
{
    register_rest_route('wp/v2', '/rating/', array(
        'methods' => 'POST',
        'callback' => 'dci_save_rating_rest'
    ));
}
add_action('rest_api_init', 'dci_register_rating_route');


/**
 * crea contenuto di tipo Richiesta Assistenza
 */
function dci_save_richiesta_assistenza()
{

    $params = json_decode(json_encode($_POST), true);

    date_default_timezone_set('Europe/Rome');
    $start = date('Y-m-d H:i:s');
    $timestamp = date_create($start, new DateTimeZone('Z'))->format('Y-m-d\TH:i:s.ve');

    if (array_key_exists("nome", $params) && array_key_exists("cognome", $params) && array_key_exists("email", $params) && array_key_exists("servizio", $params)) {
        $ticket_title = 'ticket_' . $timestamp;
        $postId = wp_insert_post(array(
            'post_type' => 'richiesta_assistenza',
            'post_title' =>  $ticket_title
        ));
    }

    if ($postId == 0) {
        echo json_encode(array(
            "success" => false,
            "error" => array(
                "code" =>  400,
                "message" => "Oops, qualcosa è andato storto!"
            )
        ));
        wp_die();
    }

    if (array_key_exists("nome", $params) && $params['nome'] != "null") {
        update_post_meta($postId, '_dci_richiesta_assistenza_nome',  $params['nome']);
    }

    if (array_key_exists("cognome", $params) && $params['cognome'] != "null") {
        update_post_meta($postId, '_dci_richiesta_assistenza_cognome',  $params['cognome']);
    }

    if (array_key_exists("email", $params) && $params['email'] != "null") {
        update_post_meta($postId, '_dci_richiesta_assistenza_email',  $params['email']);
    }

    if (array_key_exists("categoria_servizio", $params) && $params['categoria_servizio'] != "null") {
        $categoria = get_term_by('term_id', $params['categoria_servizio'], 'categorie_servizio');
        update_post_meta($postId, '_dci_richiesta_assistenza_categoria_servizio', $categoria->name);
    }

    if (array_key_exists("servizio", $params) && $params['servizio'] != "null") {
        update_post_meta($postId, '_dci_richiesta_assistenza_servizio',  $params['servizio']);
    }

    if (array_key_exists("dettagli", $params) && $params['dettagli'] != "null") {
        update_post_meta($postId, '_dci_richiesta_assistenza_dettagli',  $params['dettagli']);
    }

    $email_assistenza = dci_get_option('email_assistenza', 'assistenza');
    $body_user = "Gentile {$params['cognome']} {$params['nome']} la sua richiesta d'assistenza è stata correttamente inviata.";
    $body_admin = "Gentile gestore, è stata inoltrata una nuova richiesta di assistenza, di seguente i dati: <br>";
    $body_admin .= "<ul>";
    $labels = array(
        'title' => 'Titolo',
        'nome' => 'Nome',
        'cognome' => 'Cognome',
        'email' => 'Email',
        'categoria_servizio' => 'Categoria servizio',
        'servizio' => 'Servizio',
        'dettagli' => 'Dettagli'
    );
    foreach ($params as $key => $value) {
        switch ($key) {
            case 'action':
            case 'privacyChecked':
                break;
            case 'categoria_servizio':
                $category_name = get_term($value)->name;
                $body_admin .= "<li><strong>{$labels[$key]}:</strong> {$category_name}</li>";
                break;
            default:
                $body_admin .= "<li><strong>{$labels[$key]}:</strong> {$value}</li>";
                break;
        }
    }
    $body_admin .= "</ul>";
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($params['email'], 'Ricevuta richiesta assistenza n.' . $ticket_title, $body_user, $headers);
    wp_mail($email_assistenza, 'Nuova richiesta assistenza n.' . $ticket_title, $body_admin, $headers);

    echo json_encode(array(
        "success" => true,
        "richiesta_assistenza" => array(
            "id" => $postId
        ),
        "title" => $ticket_title
    ));
    wp_die();
}
add_action("wp_ajax_save_richiesta_assistenza", "dci_save_richiesta_assistenza");
add_action("wp_ajax_nopriv_save_richiesta_assistenza", "dci_save_richiesta_assistenza");

/**
 * crea contenuto di tipo Appuntamento
 */
function dci_save_appuntamento()
{

    $params = json_decode(json_encode($_POST), true);

    date_default_timezone_set('Europe/Rome');
    $data = date('Y-m-d\TH:i:s');

    if (array_key_exists("name", $params) && array_key_exists("privacy", $params) && array_key_exists("email", $params) &&  array_key_exists("surname", $params) && array_key_exists("moreDetails", $params) && array_key_exists("service", $params)  && array_key_exists("office", $params) && $params['office'] != "null" && array_key_exists("appointment", $params)) {
        $office_obj = json_decode(stripslashes($params['office']), true);
        $office_id = $office_obj['id'];
        $appointment_obj = json_decode(stripslashes($params['appointment']), true);
        $startDate = $appointment_obj['startDate'];
        $endDate = $appointment_obj['endDate'];

        $max_per_appuntamento = dci_get_meta("max_per_appuntamento", '_dci_unita_organizzativa_', $office_id) || 1;

        $args = array('numberposts' => -1, 'post_status' => 'any', 'post_type' => 'appuntamento', 'meta_query' => array(
            array('key' => '_dci_appuntamento_unita_organizzativa_id', 'value' => $office_id),
            array('key' => '_dci_appuntamento_data_ora_inizio_appuntamento', 'value' =>  $startDate, 'compare' => 'LIKE')
        ));
        $prenotazioni = get_posts($args);
        $current = 0;
        foreach ($prenotazioni as $prenotazione) {
            $current += 1;
        }
        if ($current >= $max_per_appuntamento) {
            wp_send_json_error(array(
                "message" => "L'orario che hai selezionato è stato già prenotato da qualcun'altro, si prega di scegliere un altro orario",
                "code" => 1
            ), 400);
            wp_die();
            return;
        }

        $appuntamento_title = $params['surname'] . ' ' . $params['name'] . '';

        $postId = wp_insert_post(array(
            'post_type' => 'appuntamento',
            'post_title' =>  $appuntamento_title
        ));
    }

    if ($postId == 0) {
        wp_send_json_error(array(
            "success" => false,
            "error" => array(
                "message" => "Oops, qualcosa è andato storto!",
            ),

        ), 400);
        wp_die();
    }

    update_post_meta($postId, '_dci_appuntamento_data_ora_prenotazione',  $data);

    if (array_key_exists("telefono", $params) && $params['telefono'] != "null") {
        update_post_meta($postId, '_dci_appuntamento_telefono_richiedente',  $params['telefono']);
    }

    if (array_key_exists("email", $params) && $params['email'] != "null") {
        update_post_meta($postId, '_dci_appuntamento_email_richiedente',  $params['email']);
    }

    if (array_key_exists("moreDetails", $params) && $params['moreDetails'] != "null") {
        update_post_meta($postId, '_dci_appuntamento_dettaglio_richiesta',  $params['moreDetails']);
    }

    if (array_key_exists("service", $params) && $params['service'] != "null") {
        $service_obj = json_decode(stripslashes($params['service']), true);
        //$service_id = $service_obj['id'];
        update_post_meta($postId, '_dci_appuntamento_servizio', $service_obj['name']);
    }

    if (array_key_exists("office", $params) && $params['office'] != "null") {
        $office_obj = json_decode(stripslashes($params['office']), true);
        $office_id = $office_obj['id'];
        $ufficio_email = dci_get_meta("email_prenotazione", "_dci_unita_organizzativa_", $office_id);
        $testo_email = dci_get_meta("testo_email_prenotazione", "_dci_unita_organizzativa_", $office_id);
        update_post_meta($postId, '_dci_appuntamento_unita_organizzativa', $office_obj['name']);
        update_post_meta($postId, '_dci_appuntamento_unita_organizzativa_id', $office_id);
    }

    if (array_key_exists("appointment", $params) && $params['appointment'] != "null") {

        $startDateObj = DateTime::createFromFormat('Y-m-d\\TH:i', $startDate);
        $endDateObj = DateTime::createFromFormat('Y-m-d\\TH:i', $endDate);
        $startDateF = $startDateObj->format('d/m/Y H:i');
        $endDateF = $endDateObj->format('d/m/Y H:i');
        update_post_meta($postId, '_dci_appuntamento_data_ora_inizio_appuntamento',  $startDate);
        update_post_meta($postId, '_dci_appuntamento_data_ora_fine_appuntamento',  $endDate);
    }

    $email_assistenza = dci_get_option('email_assistenza', 'assistenza');
    $body_user = "Gentile {$params['surname']} {$params['name']} il suo appuntamento è confermato per {$startDateF}.";
    if($testo_email) {
        $body_user .= "<br>";
        $body_user .= $testo_email;
    }
    $body_admin = "Gentile gestore, è stata inoltrata una nuova richiesta di appuntamento, di seguente i dati: <br>";
    $body_admin .= "<ul>";
    $labels = array(
        'name' => 'Nome',
        'surname' => 'Cognome',
        'email' => 'Email',
        'telefono' => 'Telefono',
        'service' => 'Servizio',
        'office' => 'Ufficio',
        'appointment' => 'Appuntamento',
        'moreDetails' => 'Dettagli'
    );
    foreach ($params as $key => $value) {
        switch ($key) {
            case 'action':
            case 'privacy':
            case 'place':
                break;
            case 'service':
                $body_admin .= "<li><strong>{$labels[$key]}:</strong> {$service_obj['name']}</li>";
                break;
            case 'office':
                $body_admin .= "<li><strong>{$labels[$key]}:</strong> {$office_obj['name']}</li>";
                break;
            case 'appointment':
                $body_admin .= "<li>Appuntamento:</li><ul><li><strong>Inizio:</strong>{$startDateF}</li><li><strong>Fine:</strong>{$endDateF}</li></ul>";
                break;
            default:
                $body_admin .= "<li><strong>{$labels[$key]}:</strong> {$value}</li>";
                break;
        }
    }
    $body_admin .= "</ul>";
    $headers = array('Content-Type: text/html; charset=UTF-8');

    wp_mail($params['email'], "Ricevuta richiesta appuntamento per {$service_obj['name']} il {$startDateF}", $body_user, $headers);
    wp_mail($ufficio_email ? $ufficio_email : $email_assistenza, "Nuova richiesta appuntamento per {$service_obj['name']} il {$startDateF}", $body_admin, $headers);

    echo json_encode(array(
        "success" => true,
        "message" => 'Contenuto creato con successo: ' . $postId,
        "appuntamento" => array(
            "id" => $postId
        ),
        "title" => $appuntamento_title
    ));
    wp_die();
}
add_action("wp_ajax_save_appuntamento", "dci_save_appuntamento");
add_action("wp_ajax_nopriv_save_appuntamento", "dci_save_appuntamento");


function dci_rating_list_add_export_button($which)
{
    global $typenow;
    if ('rating' === $typenow && 'bottom' === $which) {
?>
        <input type="submit" name="export-rating-csv" class="button button-primary" value="<?php _e('Esporta CSV'); ?>"></input>
<?php
    }
}
add_action('manage_posts_extra_tablenav', 'dci_rating_list_add_export_button', 20, 1);
function dci_export_ratings()
{
    $prefix = '_dci_rating_';
    if (isset($_GET['export-rating-csv'])) {
        $args = array(
            'post_type' => 'rating',
            'post_status' => array('publish', 'pending', 'draft', 'auto-draft', 'future', 'private', 'inherit', 'trash')
        );

        if (isset($_GET['post'])) {
            $args['post__in'] = $_GET['post'];
        } else {
            $args['posts_per_page'] = -1;
        }
        global $post;
        $arr_post = get_posts($args);
        if ($arr_post) {
            header('Content-type: text/csv');
            header('Content-Disposition: attachment; filename="valutazioni-' . time() . '.csv"');
            header('Pragma: no-cache');
            header('Expires: 0');

            $file = fopen('php://output', 'w');

            fputcsv($file, array('ID', 'Titolo', 'Url Pagina', 'Stelle', 'Risposta (scelta multipla)', 'Risposta (Domanda aperta)', 'Data'), ';');
            $count = 0;
            $totale_stelle = 0;
            foreach ($arr_post as $post) {
                setup_postdata($post);
                $url = dci_get_meta('url', $prefix, $post->ID);
                $stelle = dci_get_meta('stelle', $prefix, $post->ID);
                $risposta_chiusa = dci_get_meta('risposta_chiusa', $prefix, $post->ID);
                $risposta_aperta = dci_get_meta('risposta_aperta', $prefix, $post->ID);
                fputcsv($file, array(get_the_ID(), get_the_title(), $url, $stelle, $risposta_chiusa, $risposta_aperta, get_the_date('d/m/Y')), ';');
                $count++;
                $totale_stelle += $stelle;
            }
            fputcsv($file, array(), ';');
            fputcsv($file, array('Media stelle', $totale_stelle / $count), ';');
            exit();
        }
    }
}

add_action('admin_init', 'dci_export_ratings');
