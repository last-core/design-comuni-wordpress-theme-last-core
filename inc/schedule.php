<?php
function dci_unpublish_scheduled_posts()
{
  $args = array('numberposts' => -1, 'post_status' => 'publish', 'post_type' => 'notizia', 'meta_query' => array(
    array('key' => '_dci_notizia_data_scadenza', 'value' => time(), 'compare' => '<=', 'NUMERIC')
  ));
  $notizie = get_posts($args);
  foreach($notizie as $notizia){
    $notizia->post_status = 'private';
    wp_update_post($notizia);
  }
}

// Schedule Cron Job Event
if (!wp_next_scheduled('dci_unpublish_event')) {
  wp_schedule_event(time(), 'daily', 'dci_unpublish_event');
}
add_action('dci_unpublish_event', 'dci_unpublish_scheduled_posts');