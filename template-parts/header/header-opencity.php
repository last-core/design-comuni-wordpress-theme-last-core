<?php
$oc_base_url = dci_get_option("area_riservata_oc_base_url", "header") || '';
$oc_auth_url = dci_get_option("area_riservata_oc_auth_url", "header") || '';
$oc_spid_button = dci_get_option("area_riservata_oc_spid_button", "header") || 'false';
$oc_auth_label = dci_get_option("area_riservata_oc_auth_label", "header") || '';
?>
<div id="oc-login-box" data-element="personal-area-login"></div>
<script>
window.OC_BASE_URL = '<?php echo $oc_base_url; ?>';
window.OC_AUTH_URL = '<?php echo $oc_auth_url; ?>';
window.OC_SPID_BUTTON = '<?php echo $oc_spid_button; ?>';
window.OC_AUTH_LABEL = '<?php echo $oc_auth_label; ?>';
</script>

<script src="https://servizi.comune.bugliano.pi.it/widgets/login-box/bootstrap-italia@2/js/login-box.js"></script>