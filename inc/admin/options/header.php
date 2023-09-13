<?php

function dci_register_header_options()
{
    $prefix = '';

    /**
     * Opzioni Header
     */
    $args = array(
        'id'           => 'dci_options_header',
        'title'        => esc_html__('Header', 'design_comuni_italia'),
        'object_types' => array('options-page'),
        'option_key'   => 'header',
        'tab_title'    => __('Header', "design_comuni_italia"),
        'parent_slug'  => 'dci_options',
        'tab_group'    => 'dci_options',
        'capability'   => 'manage_options',
    );

    // 'tab_group' property is supported in > 2.4.0.
    if (version_compare(CMB2_VERSION, '2.4.0')) {
        $args['display_cb'] = 'dci_options_display_with_tabs';
    }

    $header_options = new_cmb2_box($args);

    $header_options->add_field(array(
        'id' => $prefix . 'header_options',
        'name'        => __('Header', 'design_comuni_italia'),
        'desc' => __('Area di configurazione del header.', 'design_comuni_italia'),
        'type' => 'title',
    ));

    $header_options->add_field(array(
        'id'   => $prefix . 'area_riservata_hide',
        'name' => __('Nascondi pulsante area riservata', 'design_comuni_italia'),
        'desc' => __('scegli se nascondere o meno il pulsante di area riservata', 'design_comuni_italia'),
        'type'    => 'radio_inline',
        'options' => array(
            '0' => __('Mostra', 'cmb2'),
            '1'   => __('Nascondi', 'cmb2'),
        ),
        'default' => '0',

    ));

    $header_options->add_field(array(
        'id' => $prefix . 'area_riservata_link',
        'name'        => __('URL Area riservata', 'design_comuni_italia'),
        'desc'        => __('Link alla Area riservata', 'design_comuni_italia'),
        'type' => 'text_url',
    ));
}
