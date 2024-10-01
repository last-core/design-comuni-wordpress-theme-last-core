<?php

/**
 * Definisce post type Progetto PNRR
 */
add_action('init', 'dci_register_post_type_progetto_pnrr', 60);
function dci_register_post_type_progetto_pnrr()
{
    /** scheda **/
    $labels = array(
        'name'          => _x('Progetti PNRR', 'Post Type General Name', 'design_comuni_italia'),
        'singular_name' => _x('Progetto PNRR', 'Post Type Singular Name', 'design_comuni_italia'),
        'add_new'       => _x('Aggiungi un Progetto PNRR', 'Post Type Singular Name', 'design_comuni_italia'),
        'add_new_item'  => _x('Aggiungi un nuovo Progetto PNRR', 'Post Type Singular Name', 'design_comuni_italia'),
        'edit_item'       => _x('Modifica il Progetto PNRR', 'Post Type Singular Name', 'design_comuni_italia'),
        'featured_image' => __('Immagine di riferimento del Progetto PNRR', 'design_comuni_italia'),
    );

    $args   = array(
        'label'         => __('Progetto PNRR', 'design_comuni_italia'),
        'labels'        => $labels,
        'supports'      => array('title', 'editor'),
        'hierarchical'  => false,
        'public'        => true,
        'menu_position' => 5,
        'menu_icon'     => 'dashicons-slides',
        'has_archive'   => false,
        'rewrite' => array('slug' => 'attuazione-misura-pnrr/progetto_pnrr', 'with_front' => false),
        'capability_type' => array('progetto_pnrr', 'progetti_pnrr'),
        'map_meta_cap'    => true,
        'description'    => __('Questa Tipologia descrive il contenuto del progetto PNRR', 'design_comuni_italia'),
        'show_in_rest'       => true,
        'rest_base'          => 'progetti_pnrr',
        'rest_controller_class' => 'WP_REST_Posts_Controller',
    );

    register_post_type('progetto_pnrr', $args);

    remove_post_type_support('progetto_pnrr', 'editor');
}

/**
 * Aggiungo label sotto il titolo
 */
add_action('edit_form_after_title', 'dci_progetto_pnrr_add_content_after_title');
function dci_progetto_pnrr_add_content_after_title($post)
{
    if ($post->post_type == "progetto_pnrr")
        _e('<span><i>il <b>Titolo</b> è il <b>Nome del Progetto PNRR</b>.</i></span><br><br>', 'design_comuni_italia');
}

/**
 * Crea i metabox del post type Progetto PNRR
 */
add_action('cmb2_init', 'dci_add_progetto_pnrr_metaboxes');
function dci_add_progetto_pnrr_metaboxes()
{
    $prefix = '_dci_progetto_pnrr_';
    $cmb_apertura = new_cmb2_box(array(
        'id'           => $prefix . 'box_apertura',
        'title'        => __('Apertura', 'design_comuni_italia'),
        'object_types' => array('progetto_pnrr'),
        'context'      => 'normal',
        'priority'     => 'high',
    ));

    $cmb_apertura->add_field(array(
        'id'         => $prefix . 'descrizione_e_scopo',
        'name'       => __('Descrizione e scopo *', 'design_comuni_italia'),
        'desc' => __('Inserire la descrizione e scopo del progetto PNRR.', 'design_comuni_italia'),
        'type'       => 'textarea',
        'attributes'    => array(
            'maxlength'  => '255',
            'required'    => 'required'
        ),
    ));

    //DETTAGLI
    $cmb_dettagli = new_cmb2_box(array(
        'id'           => $prefix . 'box_dettagli',
        'title'        => __('Dettagli', 'design_comuni_italia'),
        'object_types' => array('progetto_pnrr'),
        'context'      => 'normal',
        'priority'     => 'high',
    ));

    $cmb_dettagli->add_field(array(
        'id' => $prefix . 'missione',
        'name'        => __('Missione *', 'design_comuni_italia'),
        'desc' => __('Missione di cui fa parte il progetto PNRR*', 'design_comuni_italia'),
        'type'             => 'taxonomy_select',
        'taxonomy'       => 'tipi_progetto_pnrr',
        'show_option_none' => false,
        'remove_default' => 'true',
        'query_args' => array('parent' => 0),
        'attributes'    => array(
            'required'    => 'required',
        )        
    ));
    $cmb_dettagli->add_field(array(
        'id' => $prefix . 'componente',
        'name'        => __('Componente *', 'design_comuni_italia'),
        'desc' => __('Componente di cui fa parte il progetto PNRR', 'design_comuni_italia'),
        'type'             => 'taxonomy_select',
        'taxonomy'       => 'tipi_progetto_pnrr',
        'show_option_none' => false,
        'remove_default' => 'true',
        'attributes'    => array(
            'required'    => 'required',
        )
    ));

    $cmb_dettagli->add_field(array(
        'id' => $prefix . 'investimento',
        'name'    => __('Investimento *', 'design_comuni_italia'),
        'type'    => 'text',
        'attributes'    => array(
            'required'    => 'required',
        )
    ));

    $cmb_dettagli->add_field(array(
        'id' => $prefix . 'titolare',
        'name'    => __('Titolare', 'design_comuni_italia'),
        'type'    => 'text'
    ));
    $cmb_dettagli->add_field(array(
        'id' => $prefix . 'soggetto_attuatore',
        'name'    => __('Soggetto attuatore', 'design_comuni_italia'),
        'type'    => 'text'
    ));
    $cmb_dettagli->add_field(array(
        'id' => $prefix . 'cup',
        'name'    => __('CUP', 'design_comuni_italia'),
        'type'    => 'text'
    ));

    $cmb_dettagli->add_field(array(
        'id' => $prefix . 'cup',
        'name'    => __('CUP', 'design_comuni_italia'),
        'type'    => 'text'
    ));

    $cmb_importo = new_cmb2_box(array(
        'id'           => $prefix . 'box_importo',
        'title'        => __('Importo', 'design_comuni_italia'),
        'object_types' => array('progetto_pnrr'),
        'context'      => 'normal',
        'priority'     => 'high',
    ));


    $cmb_importo->add_field(array(
        'id' => $prefix . 'importo',
        'name'    => __('Importo *', 'design_comuni_italia'),
        'description'    => __('Importo dell\'investimento del PNRR', 'design_comuni_italia'),
        'type' => 'text_money',
        'before_field' => '€', // Replaces default '$'
        'attributes'    => array(
            'required'    => 'required',
        )
        ));

        $cmb_accesso = new_cmb2_box(array(
            'id'           => $prefix . 'box_accesso',
            'title'        => __('Accesso al finanziamento', 'design_comuni_italia'),
            'object_types' => array('progetto_pnrr'),
            'context'      => 'normal',
            'priority'     => 'high',
        ));
    
        $cmb_accesso->add_field(array(
            'id'         => $prefix . 'modalita_accesso',
            'name'       => __('Modalità di accesso al finanziamento *', 'design_comuni_italia'),
            'desc' => __('Inserire la Modalità di accesso al finanziamento del progetto PNRR.', 'design_comuni_italia'),
            'type'       => 'textarea',
            'attributes'    => array(
                'maxlength'  => '255',
                'required'    => 'required'
            ),
        ));
        $cmb_attivita = new_cmb2_box(array(
            'id'           => $prefix . 'box_attivita',
            'title'        => __('Attività finanziate', 'design_comuni_italia'),
            'object_types' => array('progetto_pnrr'),
            'context'      => 'normal',
            'priority'     => 'high',
        ));
    
        $cmb_attivita->add_field(array(
            'id'         => $prefix . 'attivita_finanziate',
            'name'       => __('Attività finanziate', 'design_comuni_italia'),
            'desc' => __('Inserire la attività finanziate del progetto PNRR.', 'design_comuni_italia'),
            'type'       => 'text',
            'repeatable' => true,
            'attributes'    => array(
                'maxlength'  => '255'
            ),
        ));
    //CONTATTI
    $cmb_contatti = new_cmb2_box(array(
        'id'           => $prefix . 'box_contatti',
        'title'        => __('Contatti', 'design_comuni_italia'),
        'object_types' => array('progetto_pnrr'),
        'context'      => 'normal',
        'priority'     => 'high',
    ));

    $cmb_contatti->add_field(array(
        'id' => $prefix . 'contatti',
        'name'        => __('Contatti *', 'design_comuni_italia'),
        'desc' => __('Contatti del Progetto PNRR', 'design_comuni_italia'),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('punto_contatto'),
        'attributes'    => array(
            'required'    => 'required',
            'placeholder' =>  __(' Seleziona i Punti di Contatto', 'design_comuni_italia'),
        ),
    ));


    //DOCUMENTI
    $cmb_documenti = new_cmb2_box(array(
        'id'           => $prefix . 'box_documenti',
        'title'        => __('Documenti', 'design_comuni_italia'),
        'object_types' => array('progetto_pnrr'),
        'context'      => 'normal',
        'priority'     => 'high',
    ));

    $cmb_documenti->add_field(array(
        'id' => $prefix . 'avanzamento_progetto',
        'name'        => __('Avanzamento del progetto *', 'design_comuni_italia'),
        'desc' => __('Documento di avanzamento del progetto PNRR', 'design_comuni_italia'),
        'type'    => 'pw_select',
        'options' => dci_get_posts_options('documento_pubblico'),

    ));

    $cmb_documenti->add_field(array(
        'id' => $prefix . 'atti_legislativi',
        'name'        => __('Atti legislativi e amministrativi', 'design_comuni_italia'),
        'desc' => __('Elenco degli atti legislativi e amministrativi del progetto PNRR', 'design_comuni_italia'),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('documento_pubblico'),
        'attributes' => array(
            'placeholder' =>  __('Seleziona i Documenti Pubblici', 'design_comuni_italia'),
        )
    ));

    $cmb_documenti->add_field(array(
        'id' => $prefix . 'altri_allegati',
        'name'        => __('Altri allegati', 'design_comuni_italia'),
        'desc' => __('Elenco degli altri allegati relativi al progetto PNRR', 'design_comuni_italia'),
        'type'    => 'pw_multiselect',
        'options' => dci_get_posts_options('documento_pubblico'),
        'attributes' => array(
            'placeholder' =>  __('Seleziona i Documenti Pubblici', 'design_comuni_italia'),
        )
    ));

    //ULTERIORI INFORMAZIONI
    $cmb_ulteriori_informazioni = new_cmb2_box(array(
        'id'           => $prefix . 'box_ulteriori_informazioni',
        'title'        => __('Ulteriori informazioni', 'design_comuni_italia'),
        'object_types' => array('progetto_pnrr'),
        'context'      => 'normal',
        'priority'     => 'low',
    ));
    $cmb_ulteriori_informazioni->add_field(array(
        'id' => $prefix . 'ulteriori_informazioni',
        'name'        => __('Ulteriori informazioni', 'design_comuni_italia'),
        'desc' => __('Ulteriori informazioni sul progetto PNRR', 'design_comuni_italia'),
        'type' => 'wysiwyg',
        'options' => array(
            'media_buttons' => false,
            'textarea_rows' => 10,
            'teeny' => false,
        ),
    ));
}

/**
 * Valorizzo il post content in base al contenuto dei campi custom
 * @param $data
 * @return mixed
 */
function dci_progetto_pnrr_set_post_content($data)
{

    if ($data['post_type'] == 'progetto_pnrr') {

        $descrizione_e_scopo = '';
        if (isset($_POST['_dci_progetto_pnrr_descrizione_e_scopo'])) {
            $descrizione_e_scopo = $_POST['_dci_progetto_pnrr_descrizione_e_scopo'];
        }

        $info = '';
        if (isset($_POST['_dci_progetto_pnrr_ulteriori_informazioni'])) {
            $info = $_POST['_dci_progetto_pnrr_ulteriori_informazioni'];
        }

        $content = $descrizione_e_scopo . '<br>' . $info;

        $data['post_content'] = $content;
    }

    return $data;
}
add_filter('wp_insert_post_data', 'dci_progetto_pnrr_set_post_content', '99', 1);
add_action('admin_print_scripts-post-new.php', 'dci_progetto_pnrr_admin_script', 11);
add_action('admin_print_scripts-post.php', 'dci_progetto_pnrr_admin_script', 11);

function dci_progetto_pnrr_admin_script()
{
    global $post_type;
    if ('progetto_pnrr' == $post_type)
        wp_enqueue_script('progetto-pnrr-admin-script', get_template_directory_uri() . '/inc/admin-js/progetto_pnrr.js');
}
