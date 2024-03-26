<?php
$posts_per_page = 8;
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
  'post_type'              => 'upcoming-events', // your event post type slug
  'post_status'            => 'publish', // only show published events
  'orderby'                => 'meta_value', // order by date
  'meta_key'               => 'start_date', // your ACF Date & Time Picker field
  'meta_value'             => $time, // Use the current time from above
  'meta_compare'           => '>=', // Compare today's datetime with our event datetime
  'order'                  => 'DESC', // Show earlier events first
  'posts_per_page'         => 3,
  'paged'                  => $paged
);
$events = new WP_Query($args);
if ( $events->have_posts() ) {  ?>
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