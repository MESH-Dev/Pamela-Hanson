<?php /* Template Name: Landing Page */ ?>
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
 
			<?php if(get_field('page_blocks')): ?>
				<?php
				$ctr = 0; 
				while(the_repeater_field('page_blocks'))
				{?>
						
					<?php
			        $main_imageArray = get_sub_field('main_image');
			        $main_imageAlt = $main_imageArray['alt'];
			        $main_imageURL = $main_imageArray['sizes']['landing'];

			        $hover_imageArray = get_sub_field('hover_image');
			        $hover_imageAlt = $hover_imageArray['alt'];
			        $hover_imageURL = $hover_imageArray['sizes']['landing'];

			        $class = ($ctr%2 == 0)? 'alpha': 'omega';
			        ?>
			        <div class="four columns landing-block <?php echo $class; ?>">
			        	<h3 class="landing-subtitle"><?php the_sub_field('title'); ?></h3>
						
			
			        	<a class="<?php if($hover_imageArray){ echo "hover-img"; }?> " href="<?php the_sub_field('page_link');?>">
			        		<img src="<?php echo $main_imageURL;?>" alt="<?php echo $main_imageAlt; ?>">
			        		<?php if($hover_imageArray){ ?>
			        			<img src="<?php echo $hover_imageURL;?>" alt="<?php echo $hover_imageAlt; ?>" style="display:none;">
			        		<?php }?>
			        	</a>	
						</div>
				<?
				$ctr++;
				}
				?>
			<?php endif;?>

 
				
		</div>
		<?php endwhile; ?>
 
	</div>
 
</div>
 
 
 
 
<?php get_footer(); ?>

<?php get_footer(); ?>