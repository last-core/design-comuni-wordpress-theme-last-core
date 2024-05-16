jQuery(document).ready(function () {
    /*     ufficio_check(jQuery('[name="_dci_unita_organizzativa_tipo_organizzazione"]:checked').val());
        jQuery('[name="_dci_unita_organizzativa_tipo_organizzazione"]').on('change', function(){ 
            ufficio_check(this.value);
    }); */
    // const orari_val = get_mc_val('[name="_dci_unita_organizzativa_periodo_apertura[]"]');
    const prenota_val = !!jQuery(
        '#_dci_unita_organizzativa_prenota_appuntamento:checked'
    ).val()
    // show_orari(orari_val);
    show_prenota(prenota_val)
    // jQuery('[name="_dci_unita_organizzativa_periodo_apertura[]"]').on('change', function () {
    //   const orari_val = get_mc_val('[name="_dci_unita_organizzativa_periodo_apertura[]"]');
    //   show_orari(orari_val);
    // });
    jQuery('[cb-pa="1"]').on('change', change_periodo)
    setTimeout(function () {
        jQuery(
            '[class*="dci-unita-organizzativa-periodo-apertura"] .cmb-multicheck-toggle'
        ).on('click', change_periodo_multi)
    }, 0)
    jQuery('#_dci_unita_organizzativa_fasce_orarie_repeat').on(
        'cmb2_add_row',
        function (evt, el) {
            jQuery('#' + el[0].id + ' [cb-pa="1"]').on('change', change_periodo)
            jQuery(
                '#' +
                    el[0].id +
                    ' [class*="dci-unita-organizzativa-periodo-apertura"] .cmb-multicheck-toggle'
            ).on('click', change_periodo_multi)
            const prenota_val = !!jQuery(
                '#_dci_unita_organizzativa_prenota_appuntamento:checked'
            ).val()
            show_prenota(prenota_val)
        }
    )
    jQuery('#_dci_unita_organizzativa_prenota_appuntamento').on(
        'change',
        function (el) {
            show_prenota(el.target.checked)
        }
    )
    setTimeout(() => {
        jQuery(
            '.cmb2-id--dci-unita-organizzativa-periodo-apertura .cmb-multicheck-toggle'
        ).on('click', function () {
            setTimeout(() => {
                const orari_val = get_mc_val(
                    '[name="_dci_unita_organizzativa_periodo_apertura[]"]'
                )
                show_orari(orari_val)
            }, 0)
        })
    }, 0)
})

function get_mc_val(query) {
    return jQuery(query + ':checked')
        .map(function (_, el) {
            return jQuery(el).val()
        })
        .get()
}

function ufficio_check(val) {
    if (val === 'ufficio') {
        jQuery('#_dci_unita_organizzativa_elenco_servizi_offerti').prop(
            'required',
            'required'
        )
        jQuery(
            'label[for="_dci_unita_organizzativa_elenco_servizi_offerti"]'
        ).text('Elenco servizi offerti *')
    } else {
        jQuery('#_dci_unita_organizzativa_elenco_servizi_offerti').prop(
            'required',
            ''
        )
        jQuery(
            'label[for="_dci_unita_organizzativa_elenco_servizi_offerti"]'
        ).text('Elenco servizi offerti')
    }
}

function show_orari(val) {
    const forms = {
        1: '.cmb2-id--dci-unita-organizzativa-orari-apertura-mattina, .cmb2-id--dci-unita-organizzativa-orari-chiusura-mattina',
        2: '.cmb2-id--dci-unita-organizzativa-orari-apertura-pomeriggio, .cmb2-id--dci-unita-organizzativa-orari-chiusura-pomeriggio',
    }
    for (j in forms) {
        val.includes(j) ? jQuery(forms[j]).show() : jQuery(forms[j]).hide()
    }
}
function show_orari_new(val, i) {
    const forms = {
        1:
            '[id="_dci_unita_organizzativa_fasce_orarie_' +
            i +
            '__dci_unita_organizzativa_orari_apertura_mattina"], [id="_dci_unita_organizzativa_fasce_orarie_' +
            i +
            '__dci_unita_organizzativa_orari_chiusura_mattina"]',
        2:
            '[id="_dci_unita_organizzativa_fasce_orarie_' +
            i +
            '__dci_unita_organizzativa_orari_apertura_pomeriggio"], [id="_dci_unita_organizzativa_fasce_orarie_' +
            i +
            '__dci_unita_organizzativa_orari_chiusura_pomeriggio"]',
    }
    for (j in forms) {
        val.includes(j)
            ? jQuery(forms[j]).parent().parent().show()
            : jQuery(forms[j]).parent().parent().hide()
    }
}

function show_prenota(val) {
    val
        ? jQuery('.cmb-row:has([data-p-group="1"])').show()
        : jQuery('.cmb-row:has([data-p-group="1"])').hide()
    if (!val) return
    jQuery('[cb-pa="1"]').each(function () {
        change_periodo({ target: this })
    })
}

function change_periodo(evt) {
    const val = get_mc_val('[name="' + evt.target.name + '"]')
    const id = evt.target.id.match(/_[0-9]+__/g)[0].replaceAll('_', '')
    console.log(id, val)
    show_orari_new(val, id)
}
function change_periodo_multi(evt) {
    const cb =
        evt.target.parentElement.parentElement.children[1].children[0]
            .children[0]
    setTimeout(function () {
        const val = get_mc_val('[name="' + cb.name + '"]')
        const id = cb.id.match(/_[0-9]+__/g)[0].replaceAll('_', '')
        show_orari_new(val, id)
    }, 1)
}
