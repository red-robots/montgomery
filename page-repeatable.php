<?php
/**
 * Template Name: Repeatable Blocks
 */

get_header(); 
?>
<div id="primary" class="content-area-full repeatable-layout ">
	<main id="main" class="site-main" role="main">
		<?php while ( have_posts() ) : the_post(); ?>

    <div class="titlediv typical nomb">
      <div class="wrapper">
        <h1 class="page-title"><span><?php the_title(); ?></span></h1>
      </div>
    </div>
			
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
            <div class="repeatable fullwidth <?php echo ($title) ? 'has-subtitle':'no-subtitle' ?>">
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
          <?php } else if ( get_row_layout() == 'image_and_text' ) { 
            $title = get_sub_field('title');
            $content = get_sub_field('content');
            $image = get_sub_field('image'); 
            $imageSize = get_sub_field('image_size'); 
            $text_alignment = get_sub_field('text_alignment'); 

            $col = ( ($title || $content) && $image ) ? 'half':'full';
            $col .= ($n % 2==0) ? ' even':' odd';
            $col .= ($imageSize) ? ' orig-size':' crop-size';
            $col .= ($text_alignment) ? ' text-'.$text_alignment:' text-left';

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
          <?php $n++; } else if ( get_row_layout() == 'grid_layout' ) {  
            $blocks = get_sub_field('blocks'); ?> 
            <div class="repeatable grid-layout">
              <div class="wrapper">
                <div class="flexwrap blocks">
                  <?php foreach ($blocks as $b) { 
                    $title = $b['title'];
                    $text = $b['text'];
                    $btn = $b['button'];
                    $btnTitle = (isset($btn['title']) && $btn['title']) ? $btn['title'] : '';
                    $btnLink = (isset($btn['url']) && $btn['url']) ? $btn['url'] : '';
                    $btnTarget = (isset($btn['target']) && $btn['target']) ? $btn['target'] : '_self';
                    $image = $b['image'];
                    ?>
                    <div class="block">
                      <div class="inside">
                        <?php if ($image) { ?>
                        <div class="bImage">
                          <figure style="background-image:url('<?php echo $image['url'] ?>')">
                            <img src="<?php echo get_stylesheet_directory_uri() ?>/images/rectangle-lg.png" alt="">
                          </figure>
                        </div>
                        <div class="desc">
                          <?php } ?>
                          <?php if ($title) { ?>
                          <div class="bTitle"><?php echo $title ?></div>
                          <?php } ?>
                          <?php if ($text) { ?>
                          <div class="bText"><?php echo $text ?></div>
                          <?php } ?>
                          <?php if ($btnTitle && $btnLink) { ?>
                          <div class="buttondiv">
                            <a href="<?php echo $btnLink ?>" target="<?php echo $btnTarget ?>" class="button"><?php echo $btnTitle ?></a>
                          </div>
                          <?php } ?>
                        </div>
                      </div>
                    </div>
                  <?php } ?>
                </div>
              </div>
            </div>
          <?php } ?>

        <?php endwhile; ?>
      </div>
      <?php } ?>

		<?php endwhile; ?>
	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
