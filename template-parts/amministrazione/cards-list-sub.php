<?php
global $obj, $the_query, $load_posts, $load_card_type, $additional_filter;
?>
<div class="container py-5">
    <div class="row g-4">
        <?php
        if (count($posts) === 0) { ?>
            <p class="text-center text-paragraph-regular-medium mt-4 mb-0" id="no-more-results">
                Nessun risultato trovato.
            </p>
        <?php
        }
        foreach ($posts as $post) {
            $load_card_type = "amministrazione-sub";
            get_template_part("template-parts/amministrazione/card");
        } ?>
    </div>
</div>