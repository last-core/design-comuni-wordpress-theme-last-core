<?php

/**
 * Design Comuni Italia functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Design_Comuni_Italia
 */

/**
 * Funzionalità Trasversali
 */
require get_template_directory() . '/inc/funzionalita_trasversali.php';

/**
 * Load more posts
 */
require get_template_directory() . '/inc/load_more.php';

/**
 * Vocabolario
 */
require get_template_directory() . '/inc/vocabolario.php';

/**
 * Extend User Taxonomy
 */
require get_template_directory() . '/inc/extend-tax-to-user.php';

/**
 * Implement Plugin Activations Rules
 */
require get_template_directory() . '/inc/theme-dependencies.php';

/**
 * Implement CMB2 Custom Field Manager
 */
if (!function_exists('dci_get_tipologia_articoli_options')) {
    require get_template_directory() . '/inc/cmb2.php';
    require get_template_directory() . '/inc/backend-template.php';
}

/**
 * Utils functions
 */
require get_template_directory() . '/inc/utils.php';

/**
 * Breadcrumb class
 */
require get_template_directory() . '/inc/breadcrumb.php';

/**
 * Activation Hooks
 */
require get_template_directory() . '/inc/activation.php';

/**
 * Actions & Hooks
 */
require get_template_directory() . '/inc/actions.php';

/**
 * Gutenberg editor rules
 */
require get_template_directory() . '/inc/gutenberg.php';

/**
 * Welcome page
 */
require get_template_directory() . '/inc/welcome.php';

/**
 * main menu walker
 */
require get_template_directory() . '/walkers/main-menu.php';

/**
 * menu header right walker
 */
require get_template_directory() . '/walkers/menu-header-right.php';

/**
 * footer info walker
 */
require get_template_directory() . '/walkers/footer-info.php';

/**
 * Filters
 */
require get_template_directory() . '/inc/filters.php';

if (!function_exists('dci_setup')) :
    /**
     * Sets up theme defaults and registers support for various WordPress features.
     *
     * Note that this function is hooked into the after_setup_theme hook, which
     * runs before the init hook. The init hook is too late for some features, such
     * as indicating support for post thumbnails.
     */
    function dci_setup()
    {
        /*
         * Make theme available for translation.
         * Translations can be filed in the /languages/ directory.
         * If you're building a theme based on Design Comuni Italia, use a find and replace
         * to change 'design_comuni_italia' to the name of your theme in all the template files.
         */
        load_theme_textdomain('design_comuni_italia', get_template_directory() . '/languages');

        load_theme_textdomain('easy-appointments', get_template_directory() . '/languages');

        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        // image size
        if (function_exists('add_image_size')) {
            add_image_size('article-simple-thumb', 500, 384, true);
            add_image_size('item-thumb', 280, 280, true);
            add_image_size('item-gallery', 730, 485, true);
            add_image_size('vertical-card', 190, 290, true);

            add_image_size('banner', 600, 250, false);
        }
    }
endif;
add_action('after_setup_theme', 'dci_setup');

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function dci_widgets_init()
{
}
add_action('widgets_init', 'dci_widgets_init');

/**
 * Enqueue scripts and styles.
 */
function dci_scripts()
{

    //wp_deregister_script('jquery');

    wp_enqueue_style('dci-boostrap-italia-min', get_template_directory_uri() . '/assets/css/bootstrap-italia.min.css');

    wp_enqueue_style('dci-comuni', get_template_directory_uri() . '/assets/css/comuni.css', array('dci-boostrap-italia-min'));

    wp_enqueue_style('dci-font', get_template_directory_uri() . '/assets/css/fonts.css', array('dci-comuni'));
    wp_enqueue_style('dci-wp-style', get_template_directory_uri() . "/style.css", array('dci-comuni'));

    wp_enqueue_script('dci-modernizr', get_template_directory_uri() . '/assets/js/modernizr.custom.js');

    // print css
    wp_enqueue_style('dci-print-style', get_template_directory_uri() . '/print.css', array(), '20190912', 'print');

    // footer
    //load Bootstrap Italia latest js if exists in node_modules
    if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . '/node_modules/bootstrap-italia/dist/js/bootstrap-italia.bundle.min.js')) {
        wp_enqueue_script('dci-boostrap-italia-min-js', get_template_directory_uri() . '/node_modules/bootstrap-italia/dist/js/bootstrap-italia.bundle.min.js', array(), false, true);
    } else {
        wp_enqueue_script('dci-boostrap-italia-min-js', get_template_directory_uri() . '/assets/js/bootstrap-italia.bundle.min.js', array(), false, true);
    }
    //load Alpinejs latest js if exists in node_modules
    if (file_exists(dirname(__FILE__) . DIRECTORY_SEPARATOR . '/node_modules/alpinejs/dist/cdn.min.js')) {
        wp_print_script_tag(
            array(
                'id' => 'alpine-min-js',
                'src' => esc_url(get_template_directory_uri() . '/node_modules/alpinejs/dist/cdn.min.js'),
                array(),
                'defer' => true,
            )
        );
    } else {
        wp_print_script_tag(
            array(
                'id' => 'alpine-min-js',
                'src' => esc_url(get_template_directory_uri() . '/assets/js/alpinejs/cdn.min.js'),
                array(),
                'defer' => true,
            )
        );
    }
    wp_enqueue_script('dci-comuni', get_template_directory_uri() . '/assets/js/comuni.js', array(), false, true);
    wp_add_inline_script('dci-comuni', 'window.wpRestApi = "' . get_rest_url() . '"', 'before');

    wp_enqueue_script('dci-jquery-easing', get_template_directory_uri() . '/assets/js/components/jquery-easing/jquery.easing.js', array(), false, true);
    wp_enqueue_script('dci-jquery-scrollto', get_template_directory_uri() . '/assets/js/components/jquery.scrollto/jquery.scrollTo.js', array(), false, true);
    wp_enqueue_script('dci-jquery-responsive-dom', get_template_directory_uri() . '/assets/js/components/ResponsiveDom/js/jquery.responsive-dom.js', array(), false, true);
    wp_enqueue_script('dci-jpushmenu', get_template_directory_uri() . '/assets/js/components/jPushMenu/jpushmenu.js', array(), false, true);
    wp_enqueue_script('dci-perfect-scrollbar', get_template_directory_uri() . '/assets/js/components/perfect-scrollbar-master/perfect-scrollbar/js/perfect-scrollbar.jquery.js', array(), false, true);
    wp_enqueue_script('dci-vallento', get_template_directory_uri() . '/assets/js/components/vallenato.js-master/vallenato.js', array(), false, true);
    wp_enqueue_script('dci-jquery-responsive-tabs', get_template_directory_uri() . '/assets/js/components/responsive-tabs/js/jquery.responsiveTabs.js', array(), false, true);
    wp_enqueue_script('dci-fitvids', get_template_directory_uri() . '/assets/js/components/fitvids/jquery.fitvids.js', array(), false, true);
    wp_enqueue_script('dci-sticky-kit', get_template_directory_uri() . '/assets/js/components/sticky-kit-master/dist/sticky-kit.js', array(), false, true);

    wp_enqueue_script('dci-jquery-match-height', get_template_directory_uri() . '/assets/js/components/jquery-match-height/dist/jquery.matchHeight.js', array(), false, true);

    if (is_singular(array("servizio", "struttura", "luogo", "evento", "scheda_progetto", "post", "circolare", "indirizzo")) || is_archive() || is_search() || is_post_type_archive("luogo")) {
        wp_enqueue_script('dci-leaflet-js', get_template_directory_uri() . '/assets/js/components/leaflet/leaflet.js', array(), false, true);
    }

    if (is_singular(array("evento", "scheda_progetto")) || is_home() || is_archive()) {
        wp_enqueue_script('dci-clndr-json2', get_template_directory_uri() . '/assets/js/components/clndr/json2.js', array(), false, false);
        wp_enqueue_script('dci-clndr-moment', get_template_directory_uri() . '/assets/js/components/clndr/moment.js', array(), false, false);
        wp_enqueue_script('dci-clndr-underscore', get_template_directory_uri() . '/assets/js/components/clndr/underscore.js', array(), false, false);
        wp_enqueue_script('dci-clndr-clndr', get_template_directory_uri() . '/assets/js/components/clndr/clndr.js', array(), false, false);
        wp_enqueue_script('dci-clndr-it', get_template_directory_uri() . '/assets/js/components/clndr/it.js', array(), false, false);
    }

    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'dci_scripts');

function add_menu_link_class($atts, $item, $args)
{
    if (property_exists($args, 'link_class')) {
        $atts['class'] = $args->link_class;
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'add_menu_link_class', 1, 3);

function add_menu_list_item_class($classes, $item, $args)
{
    if (property_exists($args, 'list_item_class')) {
        $classes[] = $args->list_item_class;
    }
    return $classes;
}
add_filter('nav_menu_css_class', 'add_menu_list_item_class', 1, 3);

function max_nav_items($sorted_menu_items, $args)
{
    if (property_exists($args, 'li_slice')) {
        $slice = $args->li_slice;
        $items = array();
        foreach ($sorted_menu_items as $item) {
            if ($item->menu_item_parent != 0) {
                continue;
            }
            $items[] = $item;
        }
        $items = array_slice($items, $slice[0], $slice[1]);
        foreach ($sorted_menu_items as $key => $one_item) {
            if ($one_item->menu_item_parent == 0 && !in_array($one_item, $items)) {
                unset($sorted_menu_items[$key]);
            }
        }
    }
    return $sorted_menu_items;
}
add_filter("wp_nav_menu_objects", "max_nav_items", 10, 2);

function console_log($output, $msg = "log")
{
    echo '<script> console.log("' . $msg . '",' . json_encode($output) . ')</script>';
};

function get_parent_template()
{
    return basename(get_page_template_slug(wp_get_post_parent_id()));
}

function dci_get_children_pages($parent = '', $only_direct = true)
{
    $args = array(
        'child_of' => 0
    );

    if ($parent !== '') {
        $page = my_get_page_by_title($parent);
        $args['child_of'] =  $page->ID;
        if ($only_direct) {
            $args['parent'] =  $page->ID;
        }
        $pages = get_pages($args);
    } else {
        $pages = get_pages($args); //all pages
    }

    if ($pages) {
        foreach ($pages as $page) {
            $result[$page->post_title] = array(
                'title' => $page->post_title,
                'id' => $page->ID,
                'link' =>  get_page_link($page->ID),
                'description' => dci_get_meta('descrizione', '_dci_page_', $page->ID),
                'slug' =>  $page->post_name
            );
        }
    }
    return $result;
}

function my_get_page_by_title($page_title,  $output = OBJECT, $post_type = 'page')
{

    if (is_array($post_type)) {
        $post_type           = esc_sql($post_type);
        $post_type_in_string = "'" . implode("','", $post_type) . "'";
    } else {
        $post_type_in_string = $post_type;
    }

    $query = new WP_Query(
        array(
            'post_type'              => array($post_type_in_string),
            'title'                  => $page_title,
            'post_status'            => 'all',
            'posts_per_page'         => 1,
            'no_found_rows'          => true,
            'ignore_sticky_posts'    => true,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false
        )
    );

    if (!empty($query->post)) {
        $page_got_by_title = $query->post;
    } else {
        $page_got_by_title = null;
    }
    return $page_got_by_title;
}

/**
 * ritaglia una immagine ad una certa dimensione
 * usata in persona-pubblica.php
 */
function ritagliaImmagine($immagine, $dimensione)
{
    $info_immagine = pathinfo($immagine);
    $percorso = parse_url($immagine);
    $percorso = substr($percorso["path"], 0, -strlen($info_immagine["basename"]));
    $nome_file_originale = $info_immagine["basename"];
    $nome_file_modificato = 'miniatura-' . $nome_file_originale;
    $dimensioni = getimagesize($immagine);
    if ($dimensioni["0"] > $dimensioni["1"]) { // Orizzontale
        $altezza = $dimensione;
        $ratio = $dimensioni[1] / $altezza;
        $larghezza = round($dimensioni[0] / $ratio);
    } else if ($dimensioni["0"] < $dimensioni["1"]) { // Verticale
        $larghezza = $dimensione;
        $ratio = $dimensioni[0] / $larghezza;
        $altezza = round($dimensioni[1] / $ratio);
    } else if ($dimensioni["0"] == $dimensioni["1"]) { // Quadrato
        $larghezza = $dimensione;
        $altezza = $dimensione;
    }
    $destinazione = imagecreatetruecolor($larghezza, $altezza);
    if ($dimensioni["mime"] == 'image/jpeg') {
        $sorgente = imagecreatefromjpeg($_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_originale);
        imagecopyresized($destinazione, $sorgente, 0, 0, 0, 0, $larghezza, $altezza, $dimensioni["0"], $dimensioni["1"]);
        imagejpeg($destinazione, $_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_modificato);
        $sorgente = imagecreatefromjpeg($_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_modificato);
        $img_crop = imagecrop($sorgente, ['x' => 0, 'y' => 0, 'width' => $dimensione, 'height' => $dimensione]);
        imagejpeg($img_crop, $_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_modificato);
    } else if ($dimensioni["mime"] == 'image/png') {
        $sorgente = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_originale);
        imagecopyresized($destinazione, $sorgente, 0, 0, 0, 0, $larghezza, $altezza, $dimensioni["0"], $dimensioni["1"]);
        imagepng($destinazione, $_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_modificato);
        $sorgente = imagecreatefrompng($_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_modificato);
        $img_crop = imagecrop($sorgente, ['x' => 0, 'y' => 0, 'width' => $dimensione, 'height' => $dimensione]);
        imagepng($img_crop, $_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_modificato);
    } else if ($dimensioni["mime"] == 'image/gif') {
        $sorgente = imagecreatefromgif($_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_originale);
        imagecopyresized($destinazione, $sorgente, 0, 0, 0, 0, $larghezza, $altezza, $dimensioni["0"], $dimensioni["1"]);
        imagegif($destinazione, $_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_modificato);
        $sorgente = imagecreatefromgif($_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_modificato);
        $img_crop = imagecrop($sorgente, ['x' => 0, 'y' => 0, 'width' => $dimensione, 'height' => $dimensione]);
        imagegif($img_crop, $_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_modificato);
    }
    return $percorso . $nome_file_modificato;
}

/**
 * restituisce le dimensioni (formattate) di un allegato di cui si passa la url
 * funziona solo per file locali
 */
function getFileSize(string $url)
{
    $info_file = pathinfo($url);
    $percorso = parse_url($url);
    $percorso = substr($percorso["path"], 0, -strlen($info_file["basename"]));
    $nome_file_originale = $info_file["basename"];
    $bytes = filesize($_SERVER["DOCUMENT_ROOT"] . $percorso . $nome_file_originale);
    $base = log($bytes, 1024);
    $suffixes = array('', 'Kb', 'Mb', 'Gb', 'Tb');
    return strtoupper($info_file["extension"]) . " " . round(pow(1024, $base - floor($base)), 2) . ' ' . $suffixes[floor($base)];
}
