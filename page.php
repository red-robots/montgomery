<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
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
		<?php while ( have_posts() ) : the_post(); ?>

        <?php if ($show_title) { ?>
        <div class="titlediv typical">
          <h1 class="page-title"><span><?php the_title(); ?></span></h1>
        </div>
        <?php } ?>
			
      <div class="entry-content">
        <?php the_content(); ?>
      </div>
    </div>  

		<?php endwhile; ?>

	</main><!-- #main -->
</div><!-- #primary -->

<?php
get_footer();
