<?php
global $obj, $the_query, $load_posts, $load_card_type, $additional_filter;
?>
<div class="container py-5">
    <div class="row g-4">
        <div id="load-more" class="card-wrapper px-0 card-overlapping card-teaser-wrapper card-teaser-wrapper-equal card-teaser-block-3">
            <?php foreach ($posts as $post) {
                $load_card_type = "persona-pubblica";
                get_template_part("template-parts/persona-pubblica/card");
            } ?>
        </div>
        <?php get_template_part("template-parts/search/more-results"); ?>
    </div>
</div>