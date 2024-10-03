const missioneChange = (e) => {
    const sector = e.slice(0, 2).toLowerCase() + 'c';
    jQuery('#_dci_progetto_pnrr_componente option:not([value^="' + sector + '"])').hide();
    jQuery('#_dci_progetto_pnrr_componente option[value^="' + sector + '"]').show();
     if(!jQuery('#_dci_progetto_pnrr_componente').val().startsWith(sector)){
        jQuery('#_dci_progetto_pnrr_componente').val(jQuery('#_dci_progetto_pnrr_componente option[value^="' + sector + '"]')[0].value);
    }
};
jQuery( document ).ready(function() {
    missioneChange(jQuery('#_dci_progetto_pnrr_missione option[value="'+ jQuery('#_dci_progetto_pnrr_missione').val() + '"]').text());
    jQuery('#_dci_progetto_pnrr_missione').on('change', (e) => {
        const index = e.target.selectedIndex;
        missioneChange(e.target[index].text)});
}); 