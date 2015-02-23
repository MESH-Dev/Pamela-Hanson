<?php get_header(); ?>
<?php get_header('interior'); ?>

<div class="container">
  <div class="twelve columns filters">  
    <ol id="filters">
      <li data-filter="all"><i class="fa fa-caret-right"></i> <a href="<?php echo site_url() ?>/video/">Video </a></li>
 
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