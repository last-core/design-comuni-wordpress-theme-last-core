jQuery( document ).ready(function() {
    ufficio_check(jQuery('[name="_dci_unita_organizzativa_tipo_organizzazione"]:checked').val());
        jQuery('[name="_dci_unita_organizzativa_tipo_organizzazione"]').on('change', function(){ 
            ufficio_check(this.value);
    });
});

function ufficio_check(val){
    if(val === 'ufficio'){ 
        jQuery('#_dci_unita_organizzativa_elenco_servizi_offerti').prop('required', 'required'); 
        jQuery('label[for="_dci_unita_organizzativa_elenco_servizi_offerti"]').text('Elenco servizi offerti *'); 
    } else {
        jQuery('#_dci_unita_organizzativa_elenco_servizi_offerti').prop('required', ''); 
        jQuery('label[for="_dci_unita_organizzativa_elenco_servizi_offerti"]').text('Elenco servizi offerti'); 
    }
}