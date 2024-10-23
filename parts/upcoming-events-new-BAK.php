<?php  
$displayNum = 6;
$event_title = 'Upcoming Events';
$today = date('Y-m-d H:i:s');
$arg = array(
  'post_type'     =>'upcoming-events',
  'post_status'   =>'publish',
  'posts_per_page'=> $displayNum,
  'order'       => 'ASC',
  'meta_key'      => 'start_date',
  'orderby'       => 'start_date',
  'meta_query'    => array(
      array(
        'key'   => 'start_date',
        'compare' => '>=',
        'value'   => $today,
      ),    
    )
  );

$events = new WP_Query($arg);
if ($events->have_posts())  { 
   $count = $events->found_posts; ?>
  <section id="events_section" class="section homerow5 events-count-<?php echo $count?>">
    <div class="wrapper">
      <?php if ($event_title ) { ?>
      <div class="titlediv">
        <h2 class="h2"><?php echo $event_title ?></h2> 
      </div>
      <?php } ?>

      <div class="blocks">
        <div class="flexwrap <?php echo ($count>5) ? 'has-view-more':'no-more-button'; ?><?php echo ($count<=4) ? ' normal-columns':'' ?>">
        <?php 
          $ctr=1;
          while ($events->have_posts()) : $events->the_post(); 
          $photo  = get_field('main_photo');
          $style = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
          $first = ($ctr==1) ? ' first':'';
          if($count>4) {

            if($ctr==1) { ?>
            <div class="leftColumn">
              <a href="<?php echo get_permalink(); ?>" class="block<?php echo $first ?>">
                <span class="inner">
                  <span class="title"><span><?php the_title(); ?></span></span>
                  <figure<?php echo $style ?>>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/square.png" alt="" class="helper">
                  </figure>
                </span>
              </a>
            </div>
            <div class="rightColumn">
              <?php } else { ?>
              <a href="<?php echo get_permalink(); ?>" class="block<?php echo $first ?>">
                <span class="inner">
                  <span class="title"><span><?php the_title(); ?></span></span>
                  <figure<?php echo $style ?>>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/square.png" alt="" class="helper">
                  </figure>
                </span>
              </a>
              <?php } ?>
              <?php if ($ctr==$count) { ?>
                  <?php if ($count>5) { ?>
                  <div class="more">
                    <a href="/events/" class="moreBtn button">View all upcoming events</a>
                  </div>  
                  <?php } ?>
            </div>  
            <?php } ?>

          <?php } else { ?>

            <a href="<?php echo get_permalink(); ?>" class="block<?php echo $first ?>">
              <span class="inner">
                <span class="title"><span><?php the_title(); ?></span></span>
                <figure<?php echo $style ?>>
                  <img src="<?php echo get_stylesheet_directory_uri()?>/images/square.png" alt="" class="helper">
                </figure>
              </span>
            </a>
          <?php } ?>


        <?php $ctr++; endwhile; wp_reset_postdata(); ?>
        </div>
      </div>
    </div>
  </section>
<?php } ?>
