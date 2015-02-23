<?php get_header(); ?>
<?php get_header('interior'); ?>
<?php

global $wp_query;
$s = $_GET['s'];
?>

<div class="container">
  <div class="twelve columns filters">  
    <ol id="filters">
      <li data-filter="all"><i class="fa fa-caret-right"></i> Search Results: <?php echo get_search_query();?> </li>
 
    </ol>
  </div>
</div>


 <div role="main">
      <ul id="container" class="tiles-wrap animated">
        <?php

        $args = array(
			'post_type' => array( 'photography', 'video' ),
			'posts_per_page' => '-1',
		 	's' => $s,

		);
        query_posts($args);
      	
      	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 
      	<?php
      		$post_type = get_post_type( get_the_ID() );
      		if($post_type == 'video'){
            	$imageArray  = get_field('thumbnail_image');
            }
            if($post_type == 'photography'){
            	while(has_sub_field('photography'))
		      	{ 
		            $imageArray  = get_sub_field('photo');
		      	    break;
		      	}
            }

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
 
</div>


<?php get_footer(); ?>