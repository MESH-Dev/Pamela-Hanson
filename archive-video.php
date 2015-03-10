<?php get_header(); ?>
<?php get_header('interior'); ?>

<div class="container">
  <div class="twelve columns filters">  
    <ol id="filters">
      <li data-filter="all"><i class="fa fa-caret-right"></i> Video </li>
 
    </ol>
  </div>
</div>


 <div role="main">
      <ul id="container" class="tiles-wrap animated">
        <?php
 
        query_posts($query_string . '&posts_per_page=-1' );
      	
      	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 
      	<?php
            $imageArray  = get_field('thumbnail_image');
      	    $imageAlt = $imageArray['alt'];
      	    $imageURL = $imageArray['sizes']['grid-photo'];
      	?>
      	<li  >
          <a href="<?php the_permalink();?>">
            <img src="<?php echo $imageURL; ?>" >
            <span class="project-title"><?php the_title();?></span>
          </a>
        </li>
       

       	<?php   
      	endwhile; 
       	?>

 
    </ul>

    <a id="load-more-videos">LOAD MORE</a>
</div>


<?php get_footer(); ?>