<?php
/**
 * Template Name: Today
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package bellaworks
 */
$post_type = get_post_type();
$show_title = ($post_type=='tribe_events') ? false : true;
get_header(); ?>

<div id="primary" class="content-area-full generic-layout">
	<main id="main" class="site-main" role="main">

    <div class="wrapper">

    	<div class="titlediv typical">
          <h1 class="page-title"><span><?php the_title(); ?></span></h1>
        </div>
        <div class="entry-content">
        	<?php $anyContent = get_the_content(); ?>
	        <?php the_content(); ?>
	        <?php if( $anyContent ){ ?><br><br><?php } ?>
	        <?php

			$praams = '/hours-of-operation-' . date("m-d-y") . '/';


			$wp_query = new WP_Query();
			$wp_query->query(array(
				'post_type'=>'tribe_events',
				'pagename' => $praams
			));
			if ($wp_query->have_posts()) : ?>
		    <?php while ($wp_query->have_posts()) : $wp_query->the_post(); ?>

		    	<?php the_content(); ?>
		    	<br><br>
		    <?php endwhile; endif; ?>
	    </div>
		

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
