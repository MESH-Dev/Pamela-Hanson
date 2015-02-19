<?php get_header(); ?>
<?php get_header('interior'); ?>

<div class="container">
  <div class="twelve columns filters">  
    <ol id="filters">
      <li data-filter="all"><i class="fa fa-caret-right"></i> <a href="<?php echo site_url() ?>/photography/">Work: </a></li>

        <?php 
        $args = array(
          'orderby' => 'name',
          'order' => 'ASC'
        );
        $categories = get_categories( $args ); 
        foreach($categories as $category) { 
          echo "<li><a href='".site_url()."/photography/?filter=$category->slug'>$category->name</a></li>";
        }
        ?>
 
    </ol>
  </div>
</div>
<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

	<div class="slides">
		<div class="container">
			<div class="twelve columns slides-wrap">
		<?php 
		$photos = get_field('photography');
		$num_photos = count($photos);
		if($num_photos > 1){
			$image_size = 'multiple-photos';
		}
		else
			$image_size = 'single-photo';
		while(has_sub_field('photography'))
      	{ 
            $imageArray  = get_sub_field('photo');
      	    $imageAlt = $imageArray['alt'];
      	    $imageURL = $imageArray['sizes'][$image_size]; ?>
      	   
      	   <div class="image-content"><img src="<?php echo $imageURL;?>" alt="<?php echo $imageAlt;?>"></div>
      	
      	<?php
      	}

      	?>
      		</div>
		</div>
	</div>
 
	<div class="container">
		<div class="six columns single-title">
			<?php the_title(); ?>
		</div>
		<div class="six columns single-info">
			<?php the_field('project_information'); ?>
		</div>
	</div>

<?php endwhile; ?>

<?php get_footer(); ?>