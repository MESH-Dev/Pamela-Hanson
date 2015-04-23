<?php get_header(); ?>
<?php get_header('interior'); ?>
<?php

global $wp_query;
$s = $_GET['s'];
?>

<div class="container">
  <div class="twelve columns category-title">  
    
      <h1>Search Results &raquo; <?php echo get_search_query();?> </h1>
 
    
  </div>
</div>


<div class="fluid-category">
        <?php
        $search_args = array(
          'post_type' => array( 'photography', 'video' ),
          'posts_per_page' => '-1',
          's' => $s,
        ); 
        $search_posts = get_posts( $search_args );

        $info_args = array(
          'post_type' => array( 'photography', 'video' ),
          'posts_per_page' => '-1',
          'meta_query' => array(
              array(
                'key'     => 'project_information',
                'value'   => $s,
                'compare' => 'LIKE',
              )
            )
        );
        $info_posts = get_posts( $info_args ); 

        $cat_args = array(
          'post_type' => array( 'photography', 'video' ),
          'posts_per_page' => '-1',
          'tax_query' => array(
              array(
                'taxonomy' => 'category',
                'field'    => 'slug',
                'terms'    => $s,
              )
            )
        );
        $cat_posts = get_posts( $cat_args );


        $postids = array();
        $merged_posts = array_merge($search_posts, $info_posts, $cat_posts );

        foreach( $merged_posts as $item ) {
          $postids[]=$item->ID; //create a new query only of the post ids
        }
        $uniqueposts = array_unique($postids); //remove duplicate post ids

        $posts = get_posts(array(
          'post__in' => $uniqueposts, //new query of only the unique post ids on the merged queries from above
          'post_type' => array( 'photography', 'video' ),
          'post_status' => 'publish',
          'posts_per_page' => '-1'
        ));

 


       ?> <div class="one-half"> 
       <?php
       $ctr = 0;
        foreach ($posts as $post ) : 
          if ($ctr%2==0){
          setup_postdata( $post ); 
        ?>
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
      	    $imageURL = $imageArray['sizes']['single-photo'];
      	?>
 
          <a href="<?php the_permalink();?>" class="single-cat-photo" title="<?php echo get_the_title(); ?>">
            <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageAlt; ?>" >
             <h2 class="project-title"><?php the_title(); ?></h2>
            <span class="project-desc"><?php the_field('project_information'); ?></span>
          </a>
 
       

       	<?php   
      	//endwhile;
        }
        $ctr++;
        endforeach;
 
       	?>
        </div>



        <div class="one-half last">

          <?php
           $ctr = 0;
            foreach ($posts as $post ) : 
              if ($ctr%2==1){
              setup_postdata( $post ); 
            ?>
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
                $imageURL = $imageArray['sizes']['single-photo'];
            ?>
            <a href="<?php the_permalink();?>" class="single-cat-photo" title="<?php echo get_the_title(); ?>">
              <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageAlt; ?>" >
               <h2 class="project-title"><?php the_title(); ?></h2>
              <span class="project-desc"><?php the_field('project_information'); ?></span>
            </a>
           

            <?php   
            //endwhile;
            }
            $ctr++;
            endforeach;
            $ctr=0;
            wp_reset_postdata(); 
            ?>

        </div>
  <br class="clear" /> 
</div>


<?php get_footer(); ?>