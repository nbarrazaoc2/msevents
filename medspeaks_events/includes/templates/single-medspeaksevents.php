<?php
/**
 *  Template Name: single-medspeaksevents
 *
 */

get_header(); ?>

	<div id="primary" class="site-content">
		<div id="content" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		
		<header class="entry-header">
			<?php the_post_thumbnail();
			 ?>

			<h1 class="entry-title"><?php the_title(); ?></h1>
			
		</header><!-- .entry-header -->

		
		<div class="entry-content">
			<?php the_content(); ?>
		</div><!-- .entry-content -->
		
	</article><!-- #post -->


			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
	</div><!-- #primary -->


		<div id="secondary" class="sidebar event-info" role="complementary">
			<h4><?php __e('Event Information'); ?></h4>
			<ul>
				<li>Host: </li>
				<li>Date Start & Time: </li>
				<li>Date End & Time: </li>
				<li>Time Zone: </li>
				<li>Price: </li>
				<li>Speaker: </li>
				<li>General Theme / Main Topic: </li>
				<li>Target Audience: </li>
				<li>Atendee Count: </li>
				<li>Location <br> City: <br> State: </li>
				<li>Address: </li>
				<li>Venue: </li>
				<li>Twitter Hashtag: </li>

			</ul>

			<h4><?php __e('Categories'); ?></h4>
			<?php $term_list = wp_get_post_terms($post->ID, 'mse_categories', array("fields" => "names")); 
				echo $categories = join(', ', $term_list);
			?>
			<h4><?php __e('Tags'); ?></h4>
			<?php $term_list = wp_get_post_terms($post->ID, 'mse_tags', array("fields" => "names")); 
				echo $categories = join(', ', $term_list);
			?>
			<h4><?php __e('Topics'); ?></h4>
			<?php $term_list = wp_get_post_terms($post->ID, 'mse_topics', array("fields" => "names")); 
				echo $categories = join(', ', $term_list);
			?>
		</div><!-- #secondary -->
	<?php endif; ?>
<?php get_footer(); ?>