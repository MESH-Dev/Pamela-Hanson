<?php get_header(); ?>
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


<div class="bg-container" style="background-image: url(<?php echo $imageURL[$rand_pic]; ?>)">
		<div class="centered <?php echo $text_color[$rand_pic]; ?>">
		 	<h1>Pamela Hanson</h1>
 
		</div> 
</div>
 
 
	
 
<?php get_footer(); ?>