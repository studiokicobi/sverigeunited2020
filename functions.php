<?php
/*
 *  Author: Todd Motto | @toddmotto
 *  URL: theme_base.com | @theme_base
 *  Custom functions, support, custom post types and more.
 */

/* Remove the WP Custom Fields meta box for faster admin load times
	 https://www.advancedcustomfields.com/blog/acf-pro-5-5-13-update/
   ------------------------------------------------------------------ */
add_filter('acf/settings/remove_wp_meta_box', '__return_true');

/*------------------------------------*\
	External Modules/Files
\*------------------------------------*/

// Load external files here

/*------------------------------------*\
	Theme Support
\*------------------------------------*/

if (!isset($content_width)) {
    $content_width = 1080;
}

if (function_exists('add_theme_support')) {
    // Add Menu Support
    add_theme_support('menus');

    // Add Thumbnail Theme Support
    add_theme_support('post-thumbnails');
    add_image_size('large', 700, '', true); // Large Thumbnail
    add_image_size('medium', 250, '', true); // Medium Thumbnail
    add_image_size('small', 120, '', true); // Small Thumbnail
    add_image_size('custom-size', 700, 200, true); // Custom Thumbnail Size call using the_post_thumbnail('custom-size');

    // Enables post and comment RSS feed links to head
    // add_theme_support('automatic-feed-links');

}

/*------------------------------------*\
	Disable fullscreen editor
\*------------------------------------*/

$user = wp_get_current_user();

if ($user = 'Colin Lewis') {
    function disable_editor_fullscreen_by_default()
    {
        $script = "jQuery( window ).load(function() { const isFullscreenMode = wp.data.select( 'core/edit-post' ).isFeatureActive( 'fullscreenMode' ); if ( isFullscreenMode ) { wp.data.dispatch( 'core/edit-post' ).toggleFeature( 'fullscreenMode' ); } });";
        wp_add_inline_script('wp-blocks', $script);
    }
    add_action('enqueue_block_editor_assets', 'disable_editor_fullscreen_by_default');
}


/*------------------------------------*\
	Functions
\*------------------------------------*/

// Theme_Base navigation
function theme_base_nav()
{
    wp_nav_menu(
        array(
            'theme_location'  => 'header-menu',
            'menu'            => '',
            'container'       => 'div',
            'container_class' => 'menu-{menu slug}-container',
            'container_id'    => '',
            'menu_class'      => 'menu',
            'menu_id'         => '',
            'echo'            => true,
            'fallback_cb'     => 'wp_page_menu',
            'before'          => '',
            'after'           => '',
            'link_before'     => '',
            'link_after'      => '',
            'items_wrap'      => '<ul>%3$s</ul>',
            'depth'           => 0,
            'walker'          => ''
        )
    );
}

// Add search icon to  nav
function add_search_icon($items, $args)
{
    if ($args->theme_location == 'header-menu') {
        $items .= '<li class="search-icon"><img class="open" alt="Search" src="' . get_template_directory_uri()  . '/img/search.svg"></li>';
    }
    return $items;
}
add_filter('wp_nav_menu_items', 'add_search_icon', 10, 2);

// Load Theme_Base scripts (header.php)
function theme_base_header_scripts()
{
    if ($GLOBALS['pagenow'] != 'wp-login.php' && !is_admin()) {

        // wp_register_script('conditionizr', get_template_directory_uri() . '/js/lib/conditionizr-4.3.0.min.js', array(), '4.3.0'); // Conditionizr
        // wp_enqueue_script('conditionizr'); // Enqueue it!

        // wp_register_script('modernizr', get_template_directory_uri() . '/js/lib/modernizr-2.7.1.min.js', array(), '2.7.1'); // Modernizr
        // wp_enqueue_script('modernizr'); // Enqueue it!

        wp_register_script('responsive-nav', get_template_directory_uri() . '/js/lib/responsive-nav.min.js', array(), '1.0.0'); // Responsive Nav
        wp_enqueue_script('responsive-nav'); // Enqueue it!

        wp_register_script('theme_basescripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0.0'); // Custom scripts
        wp_enqueue_script('theme_basescripts'); // Enqueue it!
    }
}

// Load Theme_Base conditional scripts
// function theme_base_conditional_scripts()
// {
//     if (is_page('pagenamehere')) {
//         wp_register_script('scriptname', get_template_directory_uri() . '/js/scriptname.js', array('jquery'), '1.0.0'); // Conditional script(s)
//         wp_enqueue_script('scriptname'); // Enqueue it!
//     }
// }

// Load Theme_Base styles
function theme_base_styles()
{
    wp_register_style('theme_base', get_template_directory_uri() . '/style.css', filemtime(), array(), 'all');
    wp_enqueue_style('theme_base'); // Enqueue it!
}

add_action('enqueue_block_editor_assets', 'add_block_editor_assets', 10, 0);
function add_block_editor_assets()
{
    wp_enqueue_style('block_editor_css', get_template_directory_uri() . '/css/editor-blocks-min.css');
}

// Register Theme_Base Navigation
function register_theme_base_menu()
{
    register_nav_menus(array( // Using array to specify more menus if needed
        'header-menu'   => __('Sidhuvud', 'theme_base'), // Main Navigation
        'sidebar-menu'  => __('Sidebar', 'theme_base'), // Sidebar Navigation
        'footer-menu'   => __('Sidfoten', 'theme_base'), // Footer Navigation
        'social-menu'   => __('Social Media', 'theme_base'), // Social Navigation
        'extra-menu'    => __('Extra', 'theme_base') // Extra Navigation if needed
    ));
}

// Remove the <div> surrounding the dynamic navigation to cleanup markup
function my_wp_nav_menu_args($args = '')
{
    $args['container'] = false;
    return $args;
}

// Remove Injected classes, ID's and Page ID's from Navigation <li> items
function my_css_attributes_filter($var)
{
    return is_array($var) ? array() : '';
}

// Remove invalid rel attribute values in the categorylist
function remove_category_rel_from_category_list($thelist)
{
    return str_replace('rel="category tag"', 'rel="tag"', $thelist);
}

// Add page slug to body class
function add_slug_to_body_class($classes)
{
    global $post;
    if (is_home()) {
        $key = array_search('blog', $classes);
        if ($key > -1) {
            unset($classes[$key]);
        }
    } elseif (is_page()) {
        $classes[] = sanitize_html_class($post->post_name);
    } elseif (is_singular()) {
        $classes[] = sanitize_html_class($post->post_name);
    }

    return $classes;
}

// Remove meta boxes from page screen
add_action('admin_menu', 'wpdocs_remove_page_fields');

function wpdocs_remove_page_fields()
{
    remove_meta_box('commentstatusdiv', 'page', 'normal'); //removes comments status
    remove_meta_box('commentsdiv', 'page', 'normal'); //removes comments
}

// If Dynamic Sidebar Exists
if (function_exists('register_sidebar')) {
    // Define Sidebar Widget Area 1
    register_sidebar(array(
        'name' => __('Widget Area 1', 'theme_base'),
        'description' => __('Description for this widget-area...', 'theme_base'),
        'id' => 'widget-area-1',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));

    // Define Sidebar Widget Area 2
    register_sidebar(array(
        'name' => __('Widget Area 2', 'theme_base'),
        'description' => __('Description for this widget-area...', 'theme_base'),
        'id' => 'widget-area-2',
        'before_widget' => '<div id="%1$s" class="%2$s">',
        'after_widget' => '</div>',
        'before_title' => '<h3>',
        'after_title' => '</h3>'
    ));
}

// Remove wp_head() injected Recent Comment styles
function my_remove_recent_comments_style()
{
    global $wp_widget_factory;
    remove_action('wp_head', array(
        $wp_widget_factory->widgets['WP_Widget_Recent_Comments'],
        'recent_comments_style'
    ));
}

// Pagination for paged posts
function theme_base_wp_pagination()
{
    global $wp_query;
    $big = 10;
    echo paginate_links(array(
        'base' => str_replace($big, '%#%', get_pagenum_link($big)),
        'format' => '?paged=%#%',
        'current' => max(1, get_query_var('paged')),
        'total' => $wp_query->max_num_pages
    ));
}

// Custom Excerpts
function theme_base_wp_index($length) // Create 20 Word Callback for Index page Excerpts, call using theme_base_wp_excerpt('theme_base_wp_index');
{
    return 20;
}

// Create 40 Word Callback for Custom Post Excerpts, call using theme_base_wp_excerpt('theme_base_wp_custom_post');
function theme_base_wp_custom_post($length)
{
    return 40;
}

// Create 55 Word Callback for Search result Excerpts
function theme_base_search_result($length)
{
    return 55;
}

// Create the Custom Excerpts callback
function theme_base_wp_excerpt($length_callback = '', $more_callback = '')
{
    global $post;
    if (function_exists($length_callback)) {
        add_filter('excerpt_length', $length_callback);
    }
    if (function_exists($more_callback)) {
        add_filter('excerpt_more', $more_callback);
    }
    $output = get_the_excerpt();
    $output = apply_filters('wptexturize', $output);
    $output = apply_filters('convert_chars', $output);
    $output = '<p>' . $output . '</p>';
    echo $output;
}

// Filter the excerpt "read more" string. Add link and replace default text.
function theme_base_excerpt_more($more)
{
    if (!is_single()) {
        $more = sprintf(
            ' <a class="read-more" href="%1$s">%2$s</a>',
            get_permalink(get_the_ID()),
            __('Fortsätt läs…', 'textdomain')
        );
    }

    return $more;
}
add_filter('excerpt_more', 'theme_base_excerpt_more');

// Custom View Article link to Post
function theme_base_blank_view_article($more)
{
    global $post;
    return '... <a class="view-article" href="' . get_permalink($post->ID) . '">' . __('View Article', 'theme_base') . '</a>';
}

// Remove 'text/css' from our enqueued stylesheet
function theme_base_style_remove($tag)
{
    return preg_replace('~\s+type=["\'][^"\']++["\']~', '', $tag);
}

// Remove thumbnail width and height dimensions that prevent fluid images in the_thumbnail
function remove_thumbnail_dimensions($html)
{
    $html = preg_replace('/(width|height)=\"\d*\"\s/', "", $html);
    return $html;
}

// Custom Gravatar in Settings > Discussion
// function theme_base_gravatar($avatar_defaults)
// {
//     $myavatar = get_template_directory_uri() . '/img/gravatar.jpg';
//     $avatar_defaults[$myavatar] = "Custom Gravatar";
//     return $avatar_defaults;
// }

/*------------------------------------*\
	Actions + Filters + ShortCodes
\*------------------------------------*/

// Add Actions
add_action('init', 'theme_base_header_scripts'); // Add Custom Scripts to wp_head
// add_action('wp_print_scripts', 'theme_base_conditional_scripts'); // Add Conditional Page Scripts
// add_action('get_header', 'enable_threaded_comments'); // Enable Threaded Comments
add_action('wp_enqueue_scripts', 'theme_base_styles'); // Add Theme Stylesheet
add_action('init', 'register_theme_base_menu'); // Add Theme_Base Menu
// add_action('init', 'create_post_type_theme_base'); // Add our Theme_Base Custom Post Type
add_action('widgets_init', 'my_remove_recent_comments_style'); // Remove inline Recent Comment Styles from wp_head()
add_action('init', 'theme_base_wp_pagination'); // Add our theme_base Pagination

// Remove Actions
remove_action('wp_head', 'feed_links_extra', 3); // Display the links to the extra feeds such as category feeds
remove_action('wp_head', 'feed_links', 2); // Display the links to the general feeds: Post and Comment Feed
remove_action('wp_head', 'rsd_link'); // Display the link to the Really Simple Discovery service endpoint, EditURI link
remove_action('wp_head', 'wlwmanifest_link'); // Display the link to the Windows Live Writer manifest file.
remove_action('wp_head', 'index_rel_link'); // Index link
remove_action('wp_head', 'parent_post_rel_link', 10, 0); // Prev link
remove_action('wp_head', 'start_post_rel_link', 10, 0); // Start link
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0); // Display relational links for the posts adjacent to the current post.
remove_action('wp_head', 'wp_generator'); // Display the XHTML generator that is generated on the wp_head hook, WP version
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0);

// Add Filters
// add_filter('avatar_defaults', 'theme_base_gravatar'); // Custom Gravatar in Settings > Discussion
add_filter('body_class', 'add_slug_to_body_class'); // Add slug to body class (Starkers build)
add_filter('widget_text', 'do_shortcode'); // Allow shortcodes in Dynamic Sidebar
add_filter('widget_text', 'shortcode_unautop'); // Remove <p> tags in Dynamic Sidebars (better!)
add_filter('wp_nav_menu_args', 'my_wp_nav_menu_args'); // Remove surrounding <div> from WP Navigation
// add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected classes (Commented out by default)
// add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> injected ID (Commented out by default)
// add_filter('page_css_class', 'my_css_attributes_filter', 100, 1); // Remove Navigation <li> Page ID's (Commented out by default)
add_filter('the_category', 'remove_category_rel_from_category_list'); // Remove invalid rel attribute
add_filter('the_excerpt', 'shortcode_unautop'); // Remove auto <p> tags in Excerpt (Manual Excerpts only)
add_filter('the_excerpt', 'do_shortcode'); // Allows Shortcodes to be executed in Excerpt (Manual Excerpts only)
// add_filter('excerpt_more', 'theme_base_view_article'); // Add 'View Article' button instead of [...] for Excerpts
// add_filter('show_admin_bar', 'remove_admin_bar'); // Remove Admin bar
add_filter('style_loader_tag', 'theme_base_style_remove'); // Remove 'text/css' from enqueued stylesheet
add_filter('post_thumbnail_html', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to thumbnails
add_filter('image_send_to_editor', 'remove_thumbnail_dimensions', 10); // Remove width and height dynamic attributes to post images

// Remove Filters
remove_filter('the_excerpt', 'wpautop'); // Remove <p> tags from Excerpt altogether

// Shortcodes
// add_shortcode('theme_base_shortcode_demo', 'theme_base_shortcode_demo'); // You can place [theme_base_shortcode_demo] in Pages, Posts now.

// Shortcodes above would be nested like this -
// [theme_base_shortcode_demo] [theme_base_shortcode_demo_2] Here's the page title! [/theme_base_shortcode_demo_2] [/theme_base_shortcode_demo]

/*------------------------------------*\
	ShortCode Functions
\*------------------------------------*/

// Shortcode Demo with Nested Capability
function theme_base_shortcode_demo($atts, $content = null)
{
    return '<div class="shortcode-demo">' . do_shortcode($content) . '</div>'; // do_shortcode allows for nested Shortcodes
}

// Shortcode Demo with simple <h2> tag
function theme_base_shortcode_demo_2($atts, $content = null) // Demo Heading H2 shortcode, allows for nesting within above element. Fully expandable.
{
    return '<h2>' . $content . '</h2>';
}

/*------------------------------------*\
	Responsive video embeds
\*------------------------------------*/
add_theme_support('responsive-embeds');



/*------------------------------------*\
	Remove page title option
\*------------------------------------*/


/*------------------------------------*\
	Blocks
\*------------------------------------*/

if (
    function_exists('acf_register_block_type')
) :

    acf_register_block_type(array(
        'name' => 'ensam-kort',
        'title' => 'Ensam kort (sidhuvud)',
        'description' => '',
        'category' => 'common',
        'keywords' => array(),
        'post_types' => array(),
        'mode' => 'auto',
        'align' => '',
        'align_content' => NULL,
        'render_template' => 'blocks/ensam-kort.php',
        'render_callback' => '',
        'enqueue_style' => '',
        'enqueue_script' => '',
        'enqueue_assets' => '',
        'icon' => array(
            'background' => '#fecb00',
            'foreground' => '#000000',
            'src' => 'admin-post',
        ),
        'supports' => array(
            'align' => true,
            'mode' => true,
            'multiple' => true,
            '__experimental_jsx' => false,
            'align_content' => false,
        ),
    ));

    acf_register_block_type(array(
        'name' => 'hero',
        'title' => 'Hero',
        'description' => '',
        'category' => 'common',
        'keywords' => array(),
        'post_types' => array(),
        'mode' => 'auto',
        'align' => '',
        'align_content' => NULL,
        'render_template' => 'blocks/hero.php',
        'render_callback' => '',
        'enqueue_style' => '',
        'enqueue_script' => '',
        'enqueue_assets' => '',
        'icon' => array(
            'background' => '#fecb00',
            'foreground' => '#000000',
            'src' => 'align-pull-right',
        ),
        'supports' => array(
            'align' => true,
            'mode' => true,
            'multiple' => true,
            '__experimental_jsx' => false,
            'align_content' => false,
        ),
    ));

    acf_register_block_type(array(
        'name' => 'knapp',
        'title' => 'Knapp',
        'description' => '',
        'category' => 'common',
        'keywords' => array(),
        'post_types' => array(),
        'mode' => 'auto',
        'align' => '',
        'align_content' => NULL,
        'render_template' => 'blocks/knapp.php',
        'render_callback' => '',
        'enqueue_style' => '',
        'enqueue_script' => '',
        'enqueue_assets' => '',
        'icon' => array(
            'background' => '#fecb00',
            'foreground' => '#000000',
            'src' => 'button',
        ),
        'supports' => array(
            'align' => true,
            'mode' => true,
            'multiple' => true,
            '__experimental_jsx' => false,
            'align_content' => false,
        ),
    ));

    acf_register_block_type(array(
        'name' => 'kort',
        'title' => 'Kort',
        'description' => '',
        'category' => 'common',
        'keywords' => array(
            0 => 'Kort',
            1 => 'Cards',
        ),
        'post_types' => array(),
        'mode' => 'auto',
        'align' => 'full',
        'align_content' => NULL,
        'render_template' => 'blocks/kort.php',
        'render_callback' => '',
        'enqueue_style' => '',
        'enqueue_script' => '',
        'enqueue_assets' => '',
        'icon' => array(
            'background' => '#fecb00',
            'foreground' => '#000000',
            'src' => 'columns',
        ),
        'supports' => array(
            'align' => true,
            'mode' => true,
            'multiple' => true,
            '__experimental_jsx' => false,
            'align_content' => false,
        ),
    ));

    acf_register_block_type(array(
        'name' => 'omslag',
        'title' => 'Omslag',
        'description' => '',
        'category' => 'common',
        'keywords' => array(),
        'post_types' => array(),
        'mode' => 'auto',
        'align' => '',
        'align_content' => NULL,
        'render_template' => 'blocks/omslag.php',
        'render_callback' => '',
        'enqueue_style' => '',
        'enqueue_script' => '',
        'enqueue_assets' => '',
        'icon' => array(
            'background' => '#fecb00',
            'foreground' => '#000000',
            'src' => 'format-image',
        ),
        'supports' => array(
            'align' => true,
            'mode' => true,
            'multiple' => true,
            '__experimental_jsx' => false,
            'align_content' => false,
        ),
    ));

    acf_register_block_type(array(
        'name' => 'partners',
        'title' => 'Partners',
        'description' => '',
        'category' => 'common',
        'keywords' => array(
            0 => 'partners',
        ),
        'post_types' => array(),
        'mode' => 'auto',
        'align' => '',
        'align_content' => NULL,
        'render_template' => 'blocks/partners.php',
        'render_callback' => '',
        'enqueue_style' => '',
        'enqueue_script' => '',
        'enqueue_assets' => '',
        'icon' => array(
            'background' => '#fecb00',
            'foreground' => '#000000',
            'src' => 'admin-users',
        ),
        'supports' => array(
            'align' => true,
            'mode' => true,
            'multiple' => true,
            '__experimental_jsx' => false,
            'align_content' => false,
        ),
    ));

    acf_register_block_type(array(
        'name' => 'profil',
        'title' => 'Profil',
        'description' => '',
        'category' => 'common',
        'keywords' => array(),
        'post_types' => array(),
        'mode' => 'auto',
        'align' => '',
        'align_content' => NULL,
        'render_template' => 'blocks/profil.php',
        'render_callback' => '',
        'enqueue_style' => '',
        'enqueue_script' => '',
        'enqueue_assets' => '',
        'icon' => array(
            'background' => '#fecb00',
            'foreground' => '#000000',
            'src' => 'id',
        ),
        'supports' => array(
            'align' => true,
            'mode' => true,
            'multiple' => true,
            '__experimental_jsx' => false,
            'align_content' => false,
        ),
    ));

    acf_register_block_type(array(
        'name' => 'social',
        'title' => 'Social media nyhetsflöde',
        'description' => '',
        'category' => 'common',
        'keywords' => array(),
        'post_types' => array(),
        'mode' => 'auto',
        'align' => '',
        'align_content' => NULL,
        'render_template' => 'blocks/social.php',
        'render_callback' => '',
        'enqueue_style' => '',
        'enqueue_script' => '',
        'enqueue_assets' => '',
        'icon' => array(
            'background' => '#fecb00',
            'foreground' => '#000000',
            'src' => 'share',
        ),
        'supports' => array(
            'align' => true,
            'mode' => true,
            'multiple' => true,
            '__experimental_jsx' => false,
            'align_content' => false,
        ),
    ));

    acf_register_block_type(array(
        'name' => 'text-grupp',
        'title' => 'Text Grupp',
        'description' => '',
        'category' => 'common',
        'keywords' => array(),
        'post_types' => array(),
        'mode' => 'auto',
        'align' => '',
        'align_content' => NULL,
        'render_template' => 'blocks/text-grupp.php',
        'render_callback' => '',
        'enqueue_style' => '',
        'enqueue_script' => '',
        'enqueue_assets' => '',
        'icon' => array(
            'background' => '#fecb00',
            'foreground' => '#000000',
            'src' => 'text',
        ),
        'supports' => array(
            'align' => true,
            'mode' => true,
            'multiple' => true,
            '__experimental_jsx' => false,
            'align_content' => false,
        ),
    ));

endif;
