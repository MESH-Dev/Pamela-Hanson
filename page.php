<?php get_header(); ?>
<?php get_header('interior'); ?>
<?php
 
$ctr = 0;
	while(has_sub_field('photographs'))
	{ 
		$ctr++;
		$text_color[$ctr] = get_sub_field('text_color');
        $imageArray  = get_sub_field('photograph');
	    $imageAlt[$ctr]  = $imageArray['alt'];
	    $imageURL[$ctr]  = $imageArray['sizes']['home-bg'];
	}
	$rand_pic = rand(1,$ctr);

?>


<div class="page-bg-container" style="background-image: url(<?php echo $imageURL[$rand_pic]; ?>)"></div> 

	<div class="container">
 		
		<br class="clear" />

		<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
		<div class="seven columns offset-by-five ">
			<div class="page-content">
				<h1><i class="fa fa-caret-right"></i> <?php the_title();?></h1>
				<?php the_content(); ?>
			</div>	
		</div>
		<?php endwhile; ?>
 
	</div>
 
 
 
 
<?php get_footer(); ?>