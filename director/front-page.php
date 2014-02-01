<?php get_header(); ?>

<?php
	$args= array(
				'post_type' => 'businesses',
				'posts_per_page' => 1,
				'tax_query' => array(
									array(
										'taxonomy' => 'business-type',
										'field' => 'slug',
										'terms' => 'featured'
									)
								)
			);
	$featuredBusiness= get_posts($args);
	
	foreach ($featuredBusiness as $post) :  setup_postdata($post); ?>
	
	<div id="featured" class="group">
    	<div class="business-info right-col">
        	 <hr/>
        	
        	 <h3>Featured Business:</h3>
        	 <h2><?php the_title(); ?></h2>
		
			<p><?php the_excerpt(); ?></p>
		</div>

   
   		<div class="impact-image">
         	<?php print get_the_post_thumbnail($post->ID, 'storefront'); ?>
    	</div>
	</div>
	
	<?php endforeach; ?>
	
	<div id="main" class="group">
		<div id="posts" class="left-col">
		
		<?php 
		
			$posts= get_posts('posts_per_page=3');
		
			foreach ($posts as $post) :  setup_postdata($post); 
		?>
			
			<div class="post group">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<div class="byline">by <?php the_author_posts_link(); ?> on <a href="<?php the_permalink(); ?>"><?php the_time('l F d, Y'); ?></a></div>
				<p><?php the_excerpt(); ?></p>
			</div>
			
			<?php endforeach; ?>
			
			<?php 
				$blogID= get_page_by_path('blog');
				$blogLink= get_page_link($blogID->ID); 
			?>
			
			<a class="visit" href="<?php print $blogLink; ?>">Visit the Blog</a>
			
			</div>
	<?php get_sidebar(); ?>
</div>
		

<?php get_footer(); ?>