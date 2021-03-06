<?php  
//enqueue scripts and styles *use production assets. Dev assets are located in assets/css and assets/js
function loadup_scripts() {
    wp_enqueue_script('imgwait-js', get_template_directory_uri().'/assets/libs/waitforimages.min.js',array( 'jquery' ), null, true);
    wp_enqueue_script('sly-js', get_template_directory_uri().'/assets/libs/sly-dev.js',array( 'jquery' ), null, true);
    wp_enqueue_script('masonry-js', get_template_directory_uri().'/assets/libs/jquery.masonry.min.js',array( 'jquery' ), null, true);
    wp_enqueue_script('infinite-scroll-js', get_template_directory_uri().'/assets/libs/jquery.infinitescroll.min.js',array( 'jquery' ), null, true);
    wp_enqueue_script('theme-js', get_template_directory_uri().'/assets/js/pamela_hanson.js',array( 'jquery' ), null, true);
 
}
add_action( 'wp_enqueue_scripts', 'loadup_scripts' );

// Add Thumbnail Theme Support
add_theme_support('post-thumbnails');
add_image_size('large', 700, '', true); // Large Thumbnail
add_image_size('medium', 250, '', true); // Medium Thumbnail
add_image_size('small', 120, '', true); // Small Thumbnail
add_image_size('home-bg', 1600, 9999, false);
add_image_size('grid-photo', 310, '', true);
add_image_size('single-photo', 940, 9999, false);
add_image_size('multiple-photos', 9999, 600, false);


 
add_filter( 'jpeg_quality', 'tgm_image_full_quality' );
add_filter( 'wp_editor_set_quality', 'tgm_image_full_quality' );
/**
 * Filters the image quality for thumbnails to be at the highest ratio possible.
 *
 * Supports the new 'wp_editor_set_quality' filter added in WP 3.5.
 *
 * @since 1.0.0
 *
 * @param int $quality  The default quality (90).
 * @return int $quality Amended quality (100).
 */
function tgm_image_full_quality( $quality ) {

    return 100;

}





//Register WP Menus
register_nav_menus(
    array(
        'main_nav' => 'Main Navigation'
    )
);

// Register Widget Area for the Sidebar
register_sidebar( array(
    'name' => __( 'Primary Widget Area', 'Sidebar' ),
    'id' => 'primary-widget-area',
    'description' => __( 'The primary widget area', 'Sidebar' ),
    'before_widget' => '',
    'after_widget' => '',
    'before_title' => '<h3>',
    'after_title' => '</h3>',
) );
 
//disable code editors
add_theme_support('html5');
add_theme_support('automatic-feed-links');

//Security and header clean-ups
remove_action( 'wp_head', 'wlwmanifest_link');
remove_action( 'wp_head', 'rsd_link');
remove_action( 'wp_head', 'index_rel_link' ); // index link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 ); // prev link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 ); // start link
remove_action( 'wp_head', 'wp_generator'); // remove WP version from header
remove_action( 'wp_head','wp_shortlink_wp_head');


//CLEAN UP FUNCTIONS ---------------------------------------- 
  
// admin part cleanups //
add_action('admin_menu', 'delete_menu_items'); // deleting menu items from admin area
add_action('admin_menu','remove_dashboard_widgets'); // remove some dashboard widgets
add_action('login_head', 'my_custom_login_logo'); //Add custom logo to admin
  
  
//Clean up Dashboard
function remove_dashboard_widgets(){

    //remove_meta_box('dashboard_right_now','dashboard','core'); // right now overview box
    //remove_meta_box('dashboard_incoming_links','dashboard','core'); // incoming links box
    //remove_meta_box('dashboard_quick_press','dashboard','core'); // quick press box
    //remove_meta_box('dashboard_plugins','dashboard','core'); // new plugins box
    //remove_meta_box('dashboard_recent_drafts','dashboard','core'); // recent drafts box
    //remove_meta_box('dashboard_recent_comments','dashboard','core'); // recent comments box
    //remove_meta_box('dashboard_primary','dashboard','core'); // wordpress development blog box
    //remove_meta_box('dashboard_secondary','dashboard','core'); // other wordpress news box
} 

// Remove menus froms the admin area 
function delete_menu_items() {
  
    /*** Remove menu http://codex.wordpress.org/Function_Reference/remove_menu_page 
    syntaxe : remove_menu_page( $menu_slug )  **/
    //remove_menu_page('index.php'); // Dashboard
    remove_menu_page('edit.php'); // Posts
    //remove_menu_page('upload.php'); // Media
    //remove_menu_page('link-manager.php'); // Links
    //remove_menu_page('edit.php?post_type=page'); // Pages
    remove_menu_page('edit-comments.php'); // Comments
    //remove_menu_page('themes.php'); // Appearance
    //remove_menu_page('plugins.php'); // Plugins
    //remove_menu_page('users.php'); // Users
    //remove_menu_page('tools.php'); // Tools
    //remove_menu_page('options-general.php'); // Settings
}


//Custon wp-admin logo
function my_custom_login_logo() {
    echo '<style type="text/css">
        h1 a {
          background-size: 227px 85px !important;
          margin-bottom: 20px !important;
          background-image:url('.get_bloginfo('template_directory').'/images/logo.png) !important; }
    </style>';
}

 


add_action('wp_head','pluginname_ajaxurl');
function pluginname_ajaxurl() {
?>
<script type="text/javascript">
var ajaxurl = '<?php echo admin_url('admin-ajax.php'); ?>';
</script>
<?php
}

add_action('wp_ajax_get_photos', 'get_photos');
add_action('wp_ajax_nopriv_get_photos', 'get_photos');

function get_photos() {  


    $last_count = $_POST['last_count'];
    $cat_id = $_POST['category'];

    $published_posts = wp_count_posts('photography')->publish;
    if($published_posts <= $last_count){
        return 0;
    }


    $args = array(
        'post_type' => 'photography',
        'cat' => $cat_id,
        'posts_per_page' => 10,
        'offset' => $last_count

    );

    //query_posts( $args );
    $the_query = new WP_Query( $args );
    $total = $the_query->max_num_pages *10;
    echo $total;
    if ($last_count > $last_count){
        return false;
    }
    $i= 0;
 
 
    if ($the_query->have_posts()) : while($the_query->have_posts()) : $the_query->the_post();  
        while(has_sub_field('photography'))
        { 
          $imageArray  = get_sub_field('photo');
          $imageAlt = $imageArray['alt'];
          $imageURL = $imageArray['sizes']['single-photo'];
          break;
        }
        $link = get_permalink();
        $title = get_the_title();
        $info = get_field('project_information');
    echo '<div class="item">';
    echo '<a href="' . $link   .'" class="single-cat-photo" title="'. $title .'">';
    echo '      <img src="'.$imageURL .'" alt="'. $imageAlt.'">';
    echo '    <h2 class="project-title">'. $title .'</h2>';
    echo '     <span class="project-desc">'. $info .'</span>';
    echo '</a>';
    echo "</div>";

    endwhile;  endif;   
 
    die();
}


add_action('wp_ajax_get_videos', 'get_videos');
add_action('wp_ajax_nopriv_get_videos', 'get_videos');
function get_videos() {  

    $last_count = $_POST['last_count'];
    

    $published_posts = wp_count_posts('video')->publish;
    if($published_posts <= $last_count){
        return 0;
    }

    $args = array(
        'post_type' => 'video',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'offset' => $last_count

    );

    //query_posts( $args );
    $the_query = new WP_Query( $args );
    $total = $the_query->max_num_pages *10;
    echo $total;
    if ($last_count > $last_count){
        return false;
    }

    $i= 0;

    //LEFT COLUMN
    if ($the_query->have_posts()) : while($the_query->have_posts()) : $the_query->the_post();  
 
        $imageArray  = get_field('thumbnail_image');
        $imageAlt = $imageArray['alt'];
        $imageURL = $imageArray['sizes']['single-photo'];
 
        $link = get_permalink();
        $title = get_the_title();
        $info = get_field('project_information');

    echo "<div class='item'>";
    echo '<a href="' . $link   .'" class="single-cat-photo" title="'. $title .'">';
    echo '      <img src="'.$imageURL .'" alt="'. $imageAlt.'">';
    echo '    <h2 class="project-title">'. $title .'</h2>';
    echo '     <span class="project-desc">'. $info .'</span>';
    echo '</a>';
    echo "</div>";

     endwhile;  endif;   
 
 
    die();
}
 

?>
