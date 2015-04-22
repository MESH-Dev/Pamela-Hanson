<?php /* Template Name: Photography Landing Page */ ?>
<?php get_header(); ?>
<?php get_header('interior'); ?>

<div class="fluid-container photo-landing">
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	 

		<?php if(get_field('section')): ?>
			<?php
			$ctr = 0; 
			while(the_repeater_field('section'))
			{?>
					
				<?php
				$cat_id = get_sub_field('category');
				$category_link = get_category_link( $cat_id );
				$title = get_sub_field('title');
		        $imageArray = get_sub_field('image');
		        $imageAlt = $imageArray['alt'];
		        $imageURL = $imageArray['sizes']['single-photo'];
 
		        $class='';
		        if($ctr ==2) $class = 'last';
		        ?>

				<div class="one-third <?php echo $class;?>">
					<a href="<?php echo esc_url( $category_link ); ?>" title="<?php echo $title;?>">
						<img src="<?php echo $imageURL;?>" alt="<?php echo $imageAlt; ?>">
						<h2 class="photo-subtitle"><?php echo $title;?></h2>
					</a>
				</div>
 
			<?
			$ctr++;
			}
			?>
		<?php endif;?>


			
 
	<?php endwhile; ?>
	<br class="clear" /> 
</div>
<?php get_footer(); ?>		