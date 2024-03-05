jQuery(document).ready(function () {
  /*     ufficio_check(jQuery('[name="_dci_unita_organizzativa_tipo_organizzazione"]:checked').val());
        jQuery('[name="_dci_unita_organizzativa_tipo_organizzazione"]').on('change', function(){ 
            ufficio_check(this.value);
    }); */
  const orari_val = get_mc_val('[name="_dci_unita_organizzativa_periodo_apertura[]"]');
  show_orari(orari_val);
  jQuery('[name="_dci_unita_organizzativa_periodo_apertura[]"]').on('change', function () {
    const orari_val = get_mc_val('[name="_dci_unita_organizzativa_periodo_apertura[]"]');
    show_orari(orari_val);
  });
  setTimeout(() => {
    jQuery('.cmb2-id--dci-unita-organizzativa-periodo-apertura .cmb-multicheck-toggle').on(
      'click',
      function () {
        setTimeout(() => {
          const orari_val = get_mc_val('[name="_dci_unita_organizzativa_periodo_apertura[]"]');
          show_orari(orari_val);
        }, 0);
      }
    );
  }, 0);
});

function get_mc_val(query) {
  return jQuery(query + ':checked')
    .map(function (_, el) {
      return jQuery(el).val();
    })
    .get();
}

function ufficio_check(val) {
  if (val === 'ufficio') {
    jQuery('#_dci_unita_organizzativa_elenco_servizi_offerti').prop('required', 'required');
    jQuery('label[for="_dci_unita_organizzativa_elenco_servizi_offerti"]').text(
      'Elenco servizi offerti *'
    );
  } else {
    jQuery('#_dci_unita_organizzativa_elenco_servizi_offerti').prop('required', '');
    jQuery('label[for="_dci_unita_organizzativa_elenco_servizi_offerti"]').text(
      'Elenco servizi offerti'
    );
  }
}

function show_orari(val) {
  const forms = {
    1: '.cmb2-id--dci-unita-organizzativa-orari-apertura-mattina, .cmb2-id--dci-unita-organizzativa-orari-chiusura-mattina',
    2: '.cmb2-id--dci-unita-organizzativa-orari-apertura-pomeriggio, .cmb2-id--dci-unita-organizzativa-orari-chiusura-pomeriggio'
  };
  for (j in forms) {
    val.includes(j) ? jQuery(forms[j]).show() : jQuery(forms[j]).hide();
  }
}
