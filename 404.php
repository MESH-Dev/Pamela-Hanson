<?php get_header(); ?>
<?php get_header('interior'); ?>
<?php
 
    $imageArray  = get_field('background_image',5);
    $imageAlt  = $imageArray['alt'];
    $imageURL = $imageArray['sizes']['home-bg'];

?>


<div class="page-bg-container" style="background-image: url(<?php echo $imageURL; ?>)"></div> 

	<div class="container">
 		
 
		<div class="seven columns offset-by-five ">
			<div class="page-content">
				<h1><i class="fa fa-caret-right"></i> Page Not Found</h1>
				<p>The page you requested could not be found. Perhaps searching will help.</p>
			</div>	
		</div>
 
 
	</div>
 
 
 
 
<?php get_footer(); ?>