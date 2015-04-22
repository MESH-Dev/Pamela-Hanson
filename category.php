<?php get_header(); ?>
<?php get_header('interior'); ?>

<div class="container">
  <div class="twelve columns category-title">  
    <h1 data-id="<?php $category_id = get_query_var('cat'); echo $category_id;?>" ><?php single_cat_title(); ?> &raquo;</h1> 
  </div>
</div>

<div class="fluid-category">
 
  <?php
   
    query_posts($query_string . '&post_type=photography&posts_per_page=-10' );
    ?>
    <div class="one-half">
    <?php 
    $i= 0;
    //LEFT COLUMN
    if (have_posts()) : while(have_posts()) : $i++; if(($i % 2) == 0) : $wp_query->next_post(); else : the_post(); ?>
      
        <?php
        
        while(has_sub_field('photography'))
        { 
          $imageArray  = get_sub_field('photo');
          $imageAlt = $imageArray['alt'];
          $imageURL = $imageArray['sizes']['single-photo'];
          break;
        }


        ?>
         
        <a href="<?php the_permalink();?>" class="single-cat-photo" title="<?php echo get_the_title(); ?>">
          <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageAlt; ?>">
          <h2 class="project-title"><?php the_title(); ?></h2>
          <span class="project-desc"><?php the_field('project_information'); ?></span>
        </a>
      


    <?php 
 
    endif; endwhile;  endif; ?>

    </div>

    <?php $i = 0; rewind_posts(); ?>
    <div class="one-half last">

     <?php 
    //RIGHT COLUMN
    if (have_posts()) : while(have_posts()) : $i++; if(($i % 2) !== 0) : $wp_query->next_post(); else : the_post(); ?>
    
      <?php
      
      while(has_sub_field('photography'))
      { 
        $imageArray  = get_sub_field('photo');
        $imageAlt = $imageArray['alt'];
        $imageURL = $imageArray['sizes']['single-photo'];
        break;
      }


      ?>
       
      <a href="<?php the_permalink();?>" class="single-cat-photo" title="<?php echo get_the_title(); ?>">
        <img src="<?php echo $imageURL; ?>" alt="<?php echo $imageAlt; ?>">
        <h2 class="project-title"><?php the_title(); ?></h2>
        <span class="project-desc"><?php the_content();?></span>
      </a>
   

      <?php endif; endwhile;  endif; ?>

    </div> 
    

</div>
<br class="clear" /> 
<div class="container">
    <a id="load-more-photos">LOAD MORE</a>
    <span id="loader" style="display:none;"><img src="<?php bloginfo('template_directory'); ?>/assets/img/ajax-loader.gif" alt="Loading"></span>
</div>
 



<?php get_footer(); ?>