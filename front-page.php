<?php 
get_header(); 
?>
<div id="primary">
  <?php /*=== SECTION 1 ===*/ ?>
  <?php 
  $adventure_content = get_field("adventure_content");
  $featured_post = get_field("featured_activities");
  $fa_visible = get_field("featured_activities_visibility");
  $row1 = ($adventure_content && $featured_post) ? 'half':'full';
  if($fa_visible=='show') {
    if ( $adventure_content || $featured_post ) { ?>
    <section class="section homerow1 <?php echo $row1 ?>">
      <?php  
      $button = get_field('adventure_button');
      $b_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
      // $b_text = (isset($button['title']) && $button['title']) ? $button['title'] : '';
      // $b_link = (isset($button['url']) && $button['url']) ? $button['url'] : '';
      $b_text = '';
      $b_link = '';
      ?>
      <div class="flexwrap">
      <?php if ($adventure_content) { ?>
        <div class="fxcol fleft">
          <div class="inner">
            <div class="info"><?php echo $adventure_content ?></div>
            <?php if ($b_text && $b_link) { ?>
            <div class="buttondiv">
              <a href="<?php echo $b_link ?>" target="<?php echo $b_target ?>" class="button"><?php echo $b_text ?></a>
            </div>  
            <?php } ?>
            <div class="carouselNavButtons">
              <a href="javascript:void(0)" class="caroPrev" data-action=".home-carousel .owl-prev"><span>Prev</span></a>
              <a href="javascript:void(0)" class="caroNext" data-action=".home-carousel .owl-next"><span>Next</span></a>
            </div>
          </div>
        </div>
      <?php } ?>

      <?php if ($featured_post) { $count = count($featured_post); ?>
        <div class="fxcol fright">
          <div class="innerwrap">
            <div class="cover-first-item"></div>
            <div id="carousel-items-<?php echo $count ?>" class="owl-carousel owl-theme home-carousel">
              <?php foreach ($featured_post as $p) { 
                $id = $p->ID;
                $title = $p->post_title;
                $photo = get_field('main_photo',$id);
                $style = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
              ?>
              <div class="item">
                <a href="<?php echo get_permalink($id); ?>">
                  <figure<?php echo $style ?>>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/spacer-home-carousel.png" alt="" class="helper">
                  </figure>
                </a>
                <span class="item-title"><a href="<?php echo get_permalink($id); ?>"><?php echo $title ?></a><span class="arrow"></span></span>
              </div>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
      </div>
    </section>
    <?php } ?>
  <?php } else { ?>
  <style>
    body.page-template-default #primary,
    body.page-template-page-custom #primary {
      padding-top: 0;
    }
    .homerow2.section{margin-top:0;}
  </style>
  <?php } ?>
    

  <?php /*=== SECTION 2 ===*/ ?>
  <?php if( have_rows('activityinfo') ) { ?>
  <section class="section homerow2 flexible-content">
    <?php $i=1; while( have_rows('activityinfo') ): the_row(); ?>
      
      <?php if( get_row_layout() == 'activity' ) { 
      $title1 = get_sub_field('title1');
      $title2 = get_sub_field('title2');
      $text = get_sub_field('description');
      $button = get_sub_field('button');
      $soon = get_sub_field('coming_soon');
      $type = get_sub_field('type');
      $is_coming_soon = (isset($soon[0]) && $soon[0]) ? ' coming_soon' : '';

      $fc_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
      $fc_text = (isset($button['title']) && $button['title']) ? $button['title'] : '';
      $fc_link = (isset($button['url']) && $button['url']) ? $button['url'] : '';

      $image = get_sub_field('image'); 
      $fcstyle = ($image) ? ' style="background-image:url('.$image['url'].')"':'';
      $class1 = ($i % 2==0) ? ' even':' odd';
      $class2 =  ($i % 3==0) ? ' third':'';
      ?>
      <div data-type="<?php echo $type ?>" class="flex-content bg_gray<?php echo $class1.$class2.$is_coming_soon ?>">
        <div class="flexwrap">
          <div class="textcol">
            <div class="inner">
              <?php if ($title1 || $title2) { ?>
              <div class="titlediv">
                <?php if ($title1) { ?>
                <h3 class="t1"><?php echo $title1 ?></h3>  
                <?php } ?>
                <?php if ($title2) { ?>
                <h4 class="t2"><?php echo $title2 ?></h4>  
                <?php } ?>
              </div>
              <?php } ?>

              <?php if ($text || $button) { ?>
              <div class="textwrap">
                <?php if ($text) { ?>
                  <div class="text font16"><?php echo $text ?></div>
                <?php } ?>

                <?php if ($fc_text && $fc_link) { ?>
                <div class="buttondiv">
                  <a href="<?php echo $fc_link ?>" target="<?php echo $fc_target ?>" class="button"><?php echo $fc_text ?></a>
                </div>  
                <?php } ?>
              </div>
              <?php } ?>
            </div>
          </div>

          <div class="imagecol">
            <figure>
              <img src="<?php echo get_stylesheet_directory_uri()?>/images/rectangle-lg.png" alt="" class="helper">
            </figure>
          </div>
        </div>
        <div class="flex-image"<?php echo $fcstyle ?>>
          <img src="<?php echo get_stylesheet_directory_uri()?>/images/rectangle-narrow.png" alt="" class="helper">
        </div>
      </div>
      <?php } ?>

    <?php $i++; endwhile; wp_reset_postdata(); ?>
  </section>
  <?php } ?>


  <?php /*=== SECTION 3 ===*/ ?>
  <?php  
  $restaurant_image = get_field('restaurant_image');
  $restaurant_text = get_field('restaurant_content');
  $restaurant_button = get_field('restaurant_button');
  $restaurant_bg_image = get_field('restaurant_bg_image');
  $restDivStyle = ($restaurant_bg_image) ? ' style="background-image:url('.$restaurant_bg_image['url'].')"':'';
  $res_style = ($restaurant_image) ? ' style="background-image:url('.$restaurant_image['url'].')"':'';

  $res_target = (isset($restaurant_button['target']) && $restaurant_button['target']) ? $restaurant_button['target'] : '_self';
  $res_text = (isset($restaurant_button['title']) && $restaurant_button['title']) ? $restaurant_button['title'] : '';
  $res_link = (isset($restaurant_button['url']) && $restaurant_button['url']) ? $restaurant_button['url'] : '';

  ?>
  <?php if( $restaurant_text ) { ?>
  <section class="section homerow3 full-width-bg">
    <div class="inner"<?php echo $restDivStyle ?>>
      <?php if ($restaurant_image) { ?>
      <div class="feat-image"<?php echo $res_style ?>></div>
      <?php } ?>
      <div class="textwrap">
        <div class="inside">
          <div class="text font16">
            <?php echo anti_email_spam($restaurant_text) ?>
          </div>
          <?php if ($res_text && $res_link) { ?>
          <div class="buttondiv">
            <a href="<?php echo $res_link ?>" target="<?php echo $res_target ?>" class="button"><?php echo $res_text ?></a>
          </div>  
          <?php } ?>
        </div>
      </div>
    </div>
  </section>
  <?php } ?>


  <?php /*=== SECTION 4 ===*/ ?>
  <?php  
  $mc_title = get_field('mc_title');
  $mc_text = get_field('mc_text');
  $mc_image = get_field('mc_image');
  $mc_button = get_field('mc_button');
  $mc_style = ($mc_image) ? ' style="background-image:url('.$mc_image['url'].')"':'';

  $mcbtn_target = (isset($mc_button['target']) && $mc_button['target']) ? $mc_button['target'] : '_self';
  $mcbtn_text = (isset($mc_button['title']) && $mc_button['title']) ? $mc_button['title'] : '';
  $mcbtn_link = (isset($mc_button['url']) && $mc_button['url']) ? $mc_button['url'] : '';
  ?>
  <?php if( $mc_text ) { ?>
  <section class="section homerow4 full-width-gray bg_gray <?php echo ($mc_image) ? 'has-image':'no-image' ?>">
    <div class="flexwrap">
      <div class="fcol left">
        <div class="inner">
          <?php if ($mc_title) { ?>
          <h2 class="t1"><?php echo $mc_title ?></h2>
          <?php } ?>
          <?php if ($mc_text) { ?>
          <div class="text"><?php echo anti_email_spam($mc_text) ?></div>
          <?php } ?>
          <?php if ($mcbtn_text && $mcbtn_link) { ?>
          <div class="buttondiv">
            <a href="<?php echo $mcbtn_link ?>" target="<?php echo $mcbtn_target ?>" class="button"><?php echo $mcbtn_text ?></a>
          </div>  
          <?php } ?>
        </div>
      </div>

      <?php if ($mc_image) { ?>
      <div class="fcol right">
        <figure <?php echo $mc_style ?>>
          <img src="<?php echo get_stylesheet_directory_uri() ?>/images/rectangle-lg.png" alt="">
        </figure>
      </div> 
      <?php } ?>
    </div>
  </section>
  <?php } ?>


  <?php /*=== SECTION 5 ===*/ ?>
  <?php  
  $event_title = get_field('event_title');
  $event_text = get_field('event_text');
  $event_visibility = get_field('event_visibility');
  $displayNum = (get_field('eventNumDisplay')) ? get_field('eventNumDisplay') : 6;
  if($event_visibility=='show') { ?>

    <?php  
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
    if ($events->have_posts())  { ?>
      <section id="events_section" class="section homerow5">
        <div class="wrapper">
          <?php if ($event_title || $event_text) { ?>
          <div class="titlediv">
            <?php if ($event_title) { ?>
             <h2 class="h2"><?php echo $event_title ?></h2> 
            <?php } ?>
            <?php if ($event_text) { ?>
             <div class="font16"><?php echo anti_email_spam($event_text) ?></div> 
            <?php } ?>
          </div>
          <?php } ?>

          <div class="blocks">
            <div class="flexwrap">
            <?php while ($events->have_posts()) : $events->the_post(); 
              $photo  = get_field('main_photo');
              $style = ($photo) ? ' style="background-image:url('.$photo['url'].')"':'';
              ?>
              <a href="<?php echo get_permalink(); ?>" class="block">
                <span class="inner">
                  <span class="title"><span><?php the_title(); ?></span></span>
                  <figure<?php echo $style ?>>
                    <img src="<?php echo get_stylesheet_directory_uri()?>/images/square.png" alt="" class="helper">
                  </figure>
                </span>
              </a>
            <?php endwhile; wp_reset_postdata(); ?>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>
  <?php } ?>


  <?php /*=== SECTION 6 ===*/ ?>
  <?php  
  $subscribe_title = get_field('subscribe_title');
  $subscribe_text = get_field('subscribe_text');
  $subscribe_button = get_field('subscribe_button');
  $sb_target = (isset($subscribe_button['target']) && $subscribe_button['target']) ? $subscribe_button['target'] : '_self';
  $sb_text = (isset($subscribe_button['title']) && $subscribe_button['title']) ? $subscribe_button['title'] : '';
  $sb_link = (isset($subscribe_button['url']) && $subscribe_button['url']) ? $subscribe_button['url'] : '';

  if( $subscribe_title || $subscribe_text ) { ?>
  <section class="section homerow6">
    <div class="wrapper">
      <div class="textwrap">
        <?php if ($subscribe_title) { ?>
        <h2 class="h2"><?php echo $subscribe_title ?></h2>
        <?php } ?>
        
        <?php if ($subscribe_text) { ?>
        <div class="text font16"><?php echo anti_email_spam($subscribe_text) ?></text>
        <?php } ?>

        <?php if ($sb_text && $sb_link) { ?>
        <div class="buttondiv">
          <a href="<?php echo $sb_link ?>" target="<?php echo $sb_target ?>" class="button btn-white"><?php echo $sb_text ?></a>
        </div>  
        <?php } ?>
    </div>
    </div>
  </section>
  <?php } ?>

</div>
<?php
get_footer();