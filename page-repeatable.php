<?php
/**
 * Template Name: Repeatable Blocks
 */

get_header(); ?>
<div id="primary" class="content-area-full repeatable-layout ">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>
			
      <?php if( have_rows('repeatable_blocks') ) { ?>
      <div class="repeatable-blocks">
        <?php $n=1; while( have_rows('repeatable_blocks') ): the_row(); ?>
          <?php if( get_row_layout() == 'fullwidth_content' ) { 
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            $button = get_sub_field('button'); 
            $btn_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
            $btn_title = (isset($button['title']) && $button['title']) ? $button['title'] : '';
            $btn_url = (isset($button['url']) && $button['url']) ? $button['url'] : '';
            if($title || $content) { ?>
            <div class="repeatable fullwidth">
              <div class="wrapper">
              <?php if ($title) { ?><h2 class="h2"><?php echo $title ?></h2><?php } ?>
              <?php if ($content) { ?><div class="text font16"><?php echo anti_email_spam($content) ?></div><?php } ?>
              <?php if ($btn_title && $btn_url) { ?>
              <div class="buttondiv">
                <a href="<?php echo $btn_url ?>" target="<?php echo $btn_target ?>" class="button"><?php echo $btn_title ?></a>
              </div>  
              <?php } ?>
              </div>
            </div>
            <?php } ?> 
          <?php } elseif ( get_row_layout() == 'image_and_text' ) { 
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            $image = get_sub_field('image'); 
            $col = ( ($title || $content) && $image ) ? 'half':'full';
            $col .= ($n % 2==0) ? ' even':' odd';

            $button = get_sub_field('button'); 
            $btn_target = (isset($button['target']) && $button['target']) ? $button['target'] : '_self';
            $btn_title = (isset($button['title']) && $button['title']) ? $button['title'] : '';
            $btn_url = (isset($button['url']) && $button['url']) ? $button['url'] : '';
            ?>
            <div class="repeatable text-image <?php echo $col ?>">
              <div class="wrapper">
                <div class="flexwrap">
                  <?php if ($title || $content) { ?>
                  <div class="textcol">
                    <?php if ($title) { ?><h2 class="h2"><?php echo $title ?></h2><?php } ?>
                    <?php if ($content) { ?><div class="text font16"><?php echo anti_email_spam($content) ?></div><?php } ?>

                    <?php if ($btn_title && $btn_url) { ?>
                    <div class="buttondiv">
                      <a href="<?php echo $btn_url ?>" target="<?php echo $btn_target ?>" class="button"><?php echo $btn_title ?></a>
                    </div>  
                    <?php } ?>
                  </div>  
                  <?php } ?>

                  <?php if ($image) { ?>
                  <div class="imagecol">
                    <figure style="background-image:url(<?php echo $image['url'] ?>)">
                      <img src="<?php echo get_stylesheet_directory_uri() ?>/images/rectangle.png" alt="" class="helper">
                      <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>" class="actual">
                    </figure>
                  </div>  
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php $n++; } ?> 
        <?php endwhile; ?>
      </div>
      <?php } ?>

		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
