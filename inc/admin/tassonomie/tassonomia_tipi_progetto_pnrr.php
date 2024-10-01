<?php

/**
 * Definisce la tassonomia Tipi di Progetto PNRR
 */
add_action('init', 'dci_register_taxonomy_tipi_progetto_pnrr', -10);
function dci_register_taxonomy_tipi_progetto_pnrr()
{

    $labels = array(
        'name'              => _x('Tipi di Progetto PNRR', 'taxonomy general name', 'design_comuni_italia'),
        'singular_name'     => _x('Tipo di Progetto PNRR', 'taxonomy singular name', 'design_comuni_italia'),
        'search_items'      => __('Cerca Tipo di Progetto PNRR', 'design_comuni_italia'),
        'all_items'         => __('Tutti i Tipi di Progetto PNRR ', 'design_comuni_italia'),
        'edit_item'         => __('Modifica il Tipo di Progetto PNRR', 'design_comuni_italia'),
        'update_item'       => __('Aggiorna il Tipo di Progetto PNRR', 'design_comuni_italia'),
        'add_new_item'      => __('Aggiungi un Tipo di Progetto PNRR', 'design_comuni_italia'),
        'new_item_name'     => __('Nuovo Tipo di Progetto PNRRo', 'design_comuni_italia'),
        'menu_name'         => __('Tipi di Progetto PNRR', 'design_comuni_italia'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'public'            => true, //enable to get term archive page
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'has_archive'           => false,    //archive page
        //'rewrite'           => array( 'slug' => 'tipi_progetto_pnrr' ),
        'capabilities'      => array(
            'manage_terms'  => 'manage_tipi_progetto_pnrr',
            'edit_terms'    => 'edit_tipi_progetto_pnrr',
            'delete_terms'  => 'delete_tipi_progetto_pnrr',
            'assign_terms'  => 'assign_tipi_progetto_pnrr'
        ),
        'show_in_rest'          => true,
        'rest_base'             => 'tipi_progetto_pnrr',
        'rest_controller_class' => 'WP_REST_Terms_Controller',
    );

    register_taxonomy('tipi_progetto_pnrr', array('progetto_pnrr'), $args);
}
