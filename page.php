<?php get_header(); ?>
<?php get_header('interior'); ?>

<div class="page-header">
	<?php
      $imageArray = get_field('page_banner_image');
      $imageAlt = $imageArray['alt'];
      $imageURL = $imageArray['sizes']['page-banner'];
    ?>
    <img src="<?php echo $imageURL;?>" alt="<?php echo $imageAlt; ?>">
</div>

<div class="page-title">
	<div class="container">
		<div class="eight columns offset-by-four">
			<h1><?php the_title(); ?></h1>
		</div>
	</div>
</div>

<div class="page-content">
	<div class="container">
		<div class="eight columns offset-by-four breadcrumbs">	
			<?php echo get_breadcrumb(); ?>
		</div>
		<br class="clear" />

		<div class="two columns offset-by-two">
			<?php
			if ($post->post_parent)	{
				$ancestors=get_post_ancestors($post->ID);
				$root=count($ancestors)-1;
				$parent = $ancestors[$root];
			} else {
				$parent = $post->ID;
			}

			$children = wp_list_pages("title_li=&child_of=". $parent ."&echo=0");

			if ($children) { ?>
			<ul class="subnav">
				<?php echo $children; ?>
			</ul>
			<?php } ?>
		</div>

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="eight columns">
			
			<?php if(get_field('slideshow_images')): ?>
			<div class="page-slider">
				<ul class="page-slides">

					<?php
					while(the_repeater_field('slideshow_images'))
					{?>
						<li>
							<?php
					          $imageArray = get_sub_field('image');
					          $imageAlt = $imageArray['alt'];
					          $imageURL = $imageArray['sizes']['slideshow'];
					        ?>
					        <img src="<?php echo $imageURL;?>" alt="<?php echo $imageAlt; ?>">

						</li>

					<?
					}
					?>
				</ul>

				<div class="clear"></div>
			</div>
			<?php endif;?>

			<div class="content">
				<?php the_content(); ?>
			</div>
			
				
		</div>
		<?php endwhile; ?>
 
	</div>
 
</div>
 
 
 
 
<?php get_footer(); ?>