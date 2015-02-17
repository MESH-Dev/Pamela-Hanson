<?php get_header(); ?>
<?php get_header('interior'); ?>

<div class="container">
  <div class="twelve columns filters">  
    <ol id="filters">
      <li data-filter="all">> Work: </li>

        <?php 
        $args = array(
          'orderby' => 'name',
          'order' => 'ASC'
        );
        $categories = get_categories( $args ); 
        foreach($categories as $category) { 
          echo "<li data-filter='$category->slug'>$category->name</li>";
        }
        ?>
 
    </ol>
  </div>
</div>


 <div role="main">
      <ul id="container" class="tiles-wrap animated">
        <?php
 
        query_posts($query_string . '&posts_per_page=10' );
      	
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
        $categories = get_the_category();
        $separator = ',';
        $cat_list = '';
        foreach($categories as $category) {
          $cat_list .= '"'.$category->slug.'"' . $separator;
        }
        $cat_list = trim($cat_list, $separator);

      	?>
      	<li data-filter-class='[<?php echo $cat_list; ?>]'>
          <a href="<?php the_permalink();?>">
            <img src="<?php echo $imageURL; ?>" >
            <span class="project-title"><?php the_title();?></span>
          </a>
        </li>
       

       	<?php   
      	endwhile; 
       	?>

 
    </ul>

    <a id="load-more-photos">LOAD MORE</a>
</div>


<?php get_footer(); ?>