<?php
/**
 * Template Name: Buy Page
 */

get_header(); 
$postId = get_the_ID();
?>
<div id="primary" class="content-area-full repeatable-layout ">
	<main id="main" class="site-main" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

    <div class="titlediv typical nomb">
      <div class="wrapper">
        <h1 class="page-title"><span><?php the_title(); ?></span></h1>
      </div>
    </div>
			
      <?php if( have_rows('item_details') ) { ?>
      <div class="item-details-blocks">
        <?php $n=1; while( have_rows('item_details') ): the_row(); 
          $section_class = ($n % 2==0) ? 'even':'odd'; ?>
          <?php if( get_row_layout() == 'details' ) { ?>
            <?php  
            $image = get_sub_field('image');
            $title = get_sub_field('title');
            //$format = get_sub_field('format');
            $two_column = get_sub_field('two_column');
            $format = ( isset($two_column) && $two_column ) ? 'two' : 'one';
            $options = get_sub_field('options');
            $includes = get_sub_field('includes');
            $additional_info = get_sub_field('additional_info');
            $singleButton = get_sub_field('single_button');
            if( $image && ($title || $options) ) { ?>
            <section class="item-details column-<?php echo $format ?> <?php echo $section_class ?>">
              <div class="flexwrap">
                <?php if ($image) { ?>
                <div class="flexcol imageCol">
                  <figure>
                    <img src="<?php echo $image['url'] ?>" alt="<?php echo $image['title'] ?>">
                  </figure>
                </div> 
                <?php } ?>

                <div class="flexcol detailsCol">
                  <div class="inner">
                    <?php if ($title || $options) { ?>
                      <h2 class="itemName"><?php echo $title ?></h2>

                      <?php 
                      $inc_title = ( isset($includes['title']) && $includes['title'] ) ? $includes['title'] : '';
                      $inc_text = ( isset($includes['text']) && $includes['text'] ) ? $includes['text'] : '';
                      $has_includes = ($inc_title || $inc_text) ? 'has-includes':'no-includes';
                      if($inc_title || $inc_text) { ?>
                      <div class="includes-info centered">
                        <?php if ($inc_title) { ?>
                        <div class="inc-title"><?php echo $inc_title ?></div> 
                        <?php } ?>
                        <?php if ($inc_text) { ?>
                        <div class="inc-text"><?php echo $inc_text ?></div> 
                        <?php } ?>
                      </div>
                      <?php } ?>

                      <?php if ($options) { ?>
                      <div class="options">
                        <?php foreach ($options as $v) { 
                          $v_name = $v['name'];
                          $v_age = $v['age'];
                          $v_description = $v['description'];
                          $v_price = $v['price'];
                          $v_margin = ( isset($v['no_margin_bottom']) && $v['no_margin_bottom'] ) ? 'no-spacing':'spacing-default';

                          $v_btn_html = $v['button_html'];
                          $v_btn = $v['button'];
                          $btnTarget = ( isset($v_btn['target']) && $v_btn['target'] ) ? $v_btn['target'] : '_self';
                          $btnTitle = ( isset($v_btn['title']) && $v_btn['title'] ) ? $v_btn['title'] : '';
                          $btnLink = ( isset($v_btn['url']) && $v_btn['url'] ) ? $v_btn['url'] : '';
                          if( $v_name ) { ?>
                          <div class="inforow <?php echo $v_margin ?>">

                            <?php if ( $format== 'one' ) { ?>
                            <div class="itemcol left">
                              <div class="info name">
                                <span class="big"><?php echo $v_name ?></span>
                                <?php if ($v_age) { ?>
                                <span class="age">(<?php echo $v_age ?>)</span>
                                <?php } ?>
                              </div>
                              <?php if ($v_description) { ?>
                              <div class="info description"><?php echo $v_description ?></div>
                              <?php } ?>
                            </div>

                            <?php if ($v_price) { ?>
                            <div class="itemcol right">
                              <span class="price">$<?php echo $v_price ?></span>
                            </div>
                            <?php } ?>
                            

                            <?php } else { ?>

                              <div class="info name"><?php echo $v_name ?></div>
                              <?php if ($v_age) { ?>
                              <div class="info age">(<?php echo $v_age ?>)</div>
                              <?php } ?>

                              <?php if ($v_description) { ?>
                              <div class="info description"><?php echo $v_description ?></div>
                              <?php } ?>
                              <?php if ($v_price) { ?>
                              <div class="info price">$<?php echo $v_price ?></div>
                              <?php } ?>

                            <?php } ?>


                            <?php if ($v_btn_html) { ?>
                            <div class="info buttonwrap">
                              <?php echo $v_btn_html ?>
                            </div>
                            <?php } ?>
                          </div>
                          <?php } ?>
                        <?php } ?>
                      </div>
                      <?php } ?>
                    <?php } ?>

                      <?php if($additional_info) { ?>
                      <div class="disclosure <?php echo $has_includes ?>"><?php echo $additional_info ?></div>
                      <?php } ?>

                      <?php if($singleButton) { ?>
                      <div class="single-button buttonwrap">
                        <?php echo $singleButton ?>
                      </div>
                      <?php } ?>
                    </div>
                  </div> 
              </div>
            </section>
            <?php } ?>
          <?php } ?>
        <?php $n++; endwhile; ?>
      </div>
      <?php } ?>
		<?php endwhile; ?>


	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
