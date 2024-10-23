<?php
$posts_per_page = -1;
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$time = current_time( 'timestamp' );

// $args = array(
//   'posts_per_page'  => -1,
//   'post_type'       => 'upcoming-events',
//   'meta_key'        => 'start_date',
//   'orderby'         => 'meta_value_num',
//   'order'           => 'DESC',
//   'post_status'     => 'publish',
//   'paged'           => $paged
// );
$args = array (
  'post_type'              => 'upcoming-events', 
  'post_status'            => 'publish', 
  'orderby'                => 'meta_value', 
  'meta_key'               => 'start_date', 
  'meta_value'             => $time,
  'meta_compare'           => '>=', 
  'order'                  => 'ASC',
  'posts_per_page'         => $posts_per_page,
  'paged'                  => $paged,
  'facetwp'                => true
);
$events = new WP_Query($args);
if ( $events->have_posts() ) {  ?>
  <div class="event-filter">
    <div class="filterby">Filter By:</div> <div><?php echo do_shortcode('[facetwp facet="event_categories"]'); ?></div>
    <?php
      // Define the taxonomy slug
      // $taxonomy = 'event-type'; // Replace with your actual taxonomy slug

      // // Fetch all terms for the 'event_category' taxonomy
      // $terms = get_terms(array(
      //     'taxonomy' => $taxonomy,
      //     'hide_empty' => false, // Set to true if you only want terms with events
      // ));

      // if ( !empty($terms) && !is_wp_error($terms) ) {
      //     echo '<ul>';
      //     foreach ($terms as $term) {
      //         // Get the term link
      //         $term_link = get_term_link($term);
              
      //         if (!is_wp_error($term_link)) {
      //             // Output the term name with a link to the term archive page
      //             echo '<li><a href="' . esc_url($term_link) . '">' . esc_html($term->name) . '</a></li>';
      //         }
      //     }
      //     echo '</ul>';
      // } else {
      //     echo 'No terms found.';
      // }
      ?>

  </div>
<div class="events-list-wrapper">

  <?php $i=1; while ( $events->have_posts() ) : $events->the_post();  
    $photo = get_field('main_photo');
    $start_date = get_field('start_date');
    $end_date = get_field('end_date');
    $description = get_field('description');
    $imageHelper = get_stylesheet_directory_uri() . '/images/square.png';
    $imageBg = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';

    $current_date = strtotime(date('Y-m-d'));
    $start_date = ($start_date) ? strtotime(date('Y-m-d', strtotime($start_date))) : '';
    $end_date = ($end_date) ? strtotime(date('Y-m-d', strtotime($end_date))) : '';
    $is_completed = false;
    if($end_date) {
      if($current_date>$end_date) {
        $is_completed = true;
      }
    } else {
      if($start_date) {
        if($current_date>$start_date) {
          $is_completed = true;
        }
      }
    }
    ?>
    <div class="eventBox <?php echo ($is_completed) ? 'completed':'ongoing' ?>">
      
      <div class="inside">
        
        <figure<?php echo $imageBg ?>>
          <img src="<?php echo $imageHelper ?>" alt="" class="resizer">
        </figure>
        <div class="description">
          <h4><?php the_title() ?></h4>
          
          <?php if ($description) { ?>
          <div class="summary"><?php echo $description ?></div>  
          <?php } ?>
          <div class="buttondiv">
            <a href="<?php echo get_permalink() ?>" class="button">Learn More</a>
          </div>
        </div>

        <?php if ($is_completed) { ?>
        <div class="status stat-bottom">Event Complete</div>  
        <?php } ?>
      </div>
    </div>
  <?php $i++; endwhile; wp_reset_postdata(); ?>
  <?php
    $total_pages = $events->max_num_pages;
    if ($total_pages > 1){ ?>
        <div id="pagination" class="pagination">
            <?php
                $pagination = array(
                    'base' => @add_query_arg('pg','%#%'),
                    'format' => '?paged=%#%',
                    'current' => $paged,
                    'total' => $total_pages,
                    'prev_text' => __( '&laquo;', 'bellaworks' ),
                    'next_text' => __( '&raquo;', 'bellaworks' ),
                    'type' => 'plain'
                );
                echo paginate_links($pagination);
            ?>
        </div>
        <?php
    }
   ?>
</div>
<?php } ?>