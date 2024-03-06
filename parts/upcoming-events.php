<?php
$posts_per_page = 8;
$paged = ( get_query_var( 'pg' ) ) ? absint( get_query_var( 'pg' ) ) : 1;
$args = array(
  'posts_per_page'  => -1,
  'post_type'       => 'upcoming-events',
  'orderby'         => 'date',
  'order'           => 'desc',
  'post_status'     => 'publish',
  'paged'           => $paged
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
    <div class="eventBox">
      <div class="inside">
        <?php if ($is_completed) { ?>
        <div class="status">Event Complete</div>  
        <?php } ?>
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
      </div>
    </div>
  <?php $i++; endwhile; wp_reset_postdata(); ?>
</div>
<?php } ?>