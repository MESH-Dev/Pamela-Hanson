<?php get_header(); ?>
<?php get_header('interior'); ?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
<div class="container">
  <div class="twelve columns project-nav"> 
  <?php $category = get_the_category(); 
 ?>
    <a href="<?php echo get_category_link($category[0]->term_id ) ?>"><i class="fa fa-caret-left"></i> Back To <?php echo  $category[0]->cat_name; ?> </a> 
  </div>
</div>

<?php 
  $photos = get_field('photography');
    $num_photos = count($photos);
    if($num_photos > 1){
      $image_size = 'multiple-photos';
      $divid = 'slider';
      
    }
    else{
      $image_size = 'single-photo';
      $divid = 'single-img';
    }
      
?>

<div class="wrap">
  <div class="frame" id="<?php echo $divid; ?>">	 
    <ul class="clearfix">
            
  	<?php 
  
  	while(has_sub_field('photography'))
      	{ 
            $imageArray  = get_sub_field('photo');
      	    $imageAlt = $imageArray['alt'];
      	    $imageURL = $imageArray['sizes'][$image_size]; ?>
      	   
      	    <li><img src="<?php echo $imageURL;?>" alt="<?php echo $imageAlt;?>"> </li>
      	
      	<?php
      	}

      	?>
    </ul>
  </div>

  <div class="scrollbar <?php echo $divid; ?>">
      <div class="handle">
        <div class="mousearea"></div>
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