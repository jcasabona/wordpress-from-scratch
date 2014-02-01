<?php get_header(); ?>

<div id="main" class="group">
	<div id="blog" class="left-col">
		
		<?php if (have_posts()) :  while (have_posts()) : the_post(); ?>
	
		<div class="post group">
			<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			<div class="byline">by <?php the_author_posts_link(); ?> on <a href="<?php the_permalink(); ?>"><?php the_time('l F d, Y'); ?></a></div>
				<?php the_content('Read More...'); ?>
		</div>
		
		<?php endwhile; else: ?>
			<p><?php _e('No posts were found. Sorry!'); ?></p>
		<?php endif; ?>
		
		<div class="navi">
			<div class="right">
				<?php previous_posts_link('Previous'); ?> / <?php next_posts_link('Next'); ?>
			</div>
		</div>
		
	</div>
	<?php get_sidebar(); ?>
</div>



<?php get_footer(); ?>