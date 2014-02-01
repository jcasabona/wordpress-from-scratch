<?php
/*
* Template Name: Archives
*/
?>

<?php get_header(); ?>

<div id="main" class="group">
	<div id="blog" class="left-col archives">
		
		<h2>Archives by Month:</h2>
			<ul>
				<?php wp_get_archives('type=monthly'); ?>
			</ul>
		
		<h2>Archives by Subject:</h2>
			<ul>
				 <?php wp_list_categories('hierarchical=0&title_li='); ?>
			</ul>		
	</div>
	<?php get_sidebar(); ?>
</div>

<?php get_footer(); ?>