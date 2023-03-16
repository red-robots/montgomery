<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */

get_header(); 
//$parent_page_id = ( isset($_GET['pp']) && $_GET['pp'] ) ? $_GET['pp'] : '';


$obj = get_queried_object();
$current_term_id = $obj->term_id;
$current_term_slug = $obj->slug;
$current_term_name = $obj->name;
$taxonomy = $obj->taxonomy;
// Tweak #1 to get term order. See below for tweak #2
// $child_terms = get_terms( array(
// 	'child_of' => $current_term_id, 
// 	'orderby' => 'term_order',
//     'order' => 'ASC',
//     'taxonomy' => $taxonomy
// ));
$category_image = get_field("category_image",$taxonomy.'_'.$current_term_id);
$has_cat_description = ( category_description( $current_term_id ) ) ? 'has-cat-desc' : 'no-cat-desc';
if($category_image) { ?>
<div class="static-banner taxonomy-banner">
  <div class="banner-image" style="background-image:url('<?php echo $category_image['url'] ?>')"></div>
  <div class="banner-text">
    <div class="wrapper">
      <div class="title"><span><?php echo $current_term_name ?></span></div>
    </div>
  </div>
</div>
<?php	} ?>


<div id="primary" data-term="<?php echo $current_term_name ?>" class="content-area-full taxonomy-content taxonomy-<?php echo $current_term_slug ?> <?php echo $has_cat_description ?>">
  <main id="main" class="site-main" role="main">
    <?php if ( category_description( $current_term_id ) ) { ?>
    <div class="wrapper cat-description">
      <?php echo category_description( $current_term_id ); ?>
    </div>
    <?php } ?>

    <?php  
    $args = array(
      'post_type'   =>'activities',
      'post_status' =>'publish',
      'posts_per_page'  => -1,
      'tax_query' => array(
        array(
          'taxonomy'  => 'activity-type', 
          'field'   => 'term_id',
          'terms'   => array( $current_term_id ) 
        )
      )
    );
    $posts = new WP_Query($args);
    if ($posts->have_posts()) { ?>
    <div class="taxonomy-posts">
      <div class="flexwrap">
        <?php while ($posts->have_posts()) : $posts->the_post(); 
          $main_photo = get_field('main_photo');
          $imgStyle = ($main_photo) ? ' style="background-image:url('.$main_photo['url'].')"':''
          ?>
          <div class="item">
            <div class="wrap">
              <figure<?php echo $imgStyle?>>
                <img src="<?php echo get_stylesheet_directory_uri() ?>/images/rectangle-lg.png" alt="">
              </figure>
              <div class="info">
                <h3 class="name"><?php the_title(); ?></h3>
                <div class="buttondiv">
                  <a href="<?php echo get_permalink() ?>" class="button">Learn More</a>
                </div>
              </div>
            </div>
          </div>
        <?php endwhile; ?>
      </div>
    </div>
    <?php } ?>
  </main>
</div>

<?php
get_footer();
