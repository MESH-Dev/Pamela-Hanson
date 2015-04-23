<?php get_header(); ?>
<?php get_header('interior'); ?>

<div class="container">
  <div class="twelve columns project-nav"> 
       <a href="<?php echo site_url() ?>/video/"><i class="fa fa-caret-left"></i> Back to Video </a> 
 
    </ol>
  </div>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
 
  <?php $vimeo_id = get_field('vimeo_url');?>
	<div class="twelve columns ">
    <iframe src="//player.vimeo.com/video/<?php echo $vimeo_id;?>" width="940" height="528" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>  
  </div>

  <div class="six columns single-video-title">
  	<?php the_title(); ?>
  </div>
  <div class="six columns single-video-info">
  	<?php the_field('project_information'); ?>
  </div>
 


</div>
<?php endwhile; ?>

<?php get_footer(); ?>