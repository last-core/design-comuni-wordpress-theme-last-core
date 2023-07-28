<?php
global $posts, $the_query, $load_posts, $luogo, $load_card_type;

$max_posts = isset($_GET['max_posts']) ? $_GET['max_posts'] : 3;
$load_posts = 3;
$query = isset($_GET['search']) ? dci_removeslashes($_GET['search']) : null;
$args = array(
    's' => $query,
    'posts_per_page' => $max_posts,
    'post_type'      => 'luogo',
    'orderby'        => 'post_title',
    'order'          => 'ASC'
);
$the_query = new WP_Query($args);

$posts = $the_query->posts;

// Per selezionare i contenuti in evidenza tramite flag

//Per selezionare i contenuti in evidenza tramite configurazione
?>

<div class="bg-grey-card">
    <form role="search" id="search-form" method="get" class="search-form">
        <button type="submit" class="d-none"></button>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h2 class="title-xxlarge mb-4 mt-5 mb-lg-10">
                        Esplora tutti i luoghi
                    </h2>
                </div>
                <div class="col-12 pt-lg-50 pb-lg-50">
                    <div class="cmp-input-search">
                        <div class="form-group autocomplete-wrapper mb-2 mb-lg-4">
                            <div class="input-group">
                                <label for="autocomplete-two" class="visually-hidden">Cerca una parola chiave</label>
                                <input type="search" class="autocomplete form-control" placeholder="Cerca una parola chiave" id="autocomplete-two" name="search" value="<?php echo $query; ?>" data-bs-autocomplete="[]" />
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit" id="button-3">
                                        Invio
                                    </button>
                                </div>
                                <span class="autocomplete-icon" aria-hidden="true"><svg class="icon icon-sm icon-primary" role="img" aria-labelledby="autocomplete-label">
                                        <use href="#it-search"></use>
                                    </svg></span>
                            </div>
                        </div>
                        <p id="autocomplete-label" class="mb-4">
                            <strong><?php echo $the_query->found_posts; ?> </strong>luoghi trovati in ordine alfabetico
                        </p>
                    </div>
                    <div id="load-more" class="row g-4">
                        <?php foreach ($posts as $post) {
                            $load_card_type = "luogo";
                            get_template_part("template-parts/luogo/card-full");
                        } ?>
                    </div>
                    <?php get_template_part("template-parts/search/more-results"); ?>
                </div>
            </div>
    </form>
</div>
<?php wp_reset_query(); ?>