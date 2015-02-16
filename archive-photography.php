<?php get_header(); ?>
<?php get_header('interior'); ?>


<ol id="filters">
      <li data-filter="all">Reset filters</li>
      <li data-filter="amsterdam">Amsterdam</li>
      <li data-filter="tokyo">Tokyo</li>
      <li data-filter="london">London</li>
      <li data-filter="paris">Paris</li>
      <li data-filter="berlin">Berlin</li>
      <li data-filter="sport">Sport</li>
      <li data-filter="fashion">Fashion</li>
      <li data-filter="video">Video</li>
      <li data-filter="art">Art</li>
    </ol>

 <div role="main">
      <ul id="container" class="tiles-wrap animated">

      	<?php
		if ( have_posts() ) while ( have_posts() ) : the_post(); ?>


	<?php
	$ctr = 0;
	while(has_sub_field('photography'))
	{ 
        $imageArray  = get_sub_field('photo');
	    $imageAlt = $imageArray['alt'];
	    $imageURL = $imageArray['sizes']['grid-photo'];
	    break;

	}
	?>
	<li data-filter-class='["london", "art"]'>
        <img src="<?php echo $imageURL; ?>" >
        <p><?php the_title();?></p>
    </li>
 

 	<?php   
	endwhile; 
 	?>

 
    </ul>
</div>

<?php get_footer(); ?>