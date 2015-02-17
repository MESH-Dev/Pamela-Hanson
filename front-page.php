<?php get_header(); ?>
<?php
	$ctr = 0;
	while(has_sub_field('photographs'))
	{ 
		$ctr++;
		$text_color[$ctr] = get_sub_field('text_color');
        $imageArray  = get_sub_field('photograph');
	    $imageAlt[$ctr]  = $imageArray['alt'];
	    $imageURL[$ctr]  = $imageArray['sizes']['home-bg'];
	}
	$rand_pic = rand(1,$ctr);
	?>


<div class="bg-container" style="background-image: url(<?php echo $imageURL[$rand_pic]; ?>)">
		<div class="centered <?php echo $text_color[$rand_pic]; ?>">
		 	<h1>Pamela Hanson</h1>
		 	<?php if(has_nav_menu('main_nav')){
				$defaults = array(
					'theme_location'  => 'main_nav',
					'menu'            => 'main_nav',
					'container'       => false,
					'container_class' => '',
					'container_id'    => '',
					'menu_class'      => 'menu',
					'menu_id'         => '',
					'echo'            => true,
					'fallback_cb'     => 'wp_page_menu',
					'before'          => '',
					'after'           => '',
					'link_before'     => '',
					'link_after'      => '',
					'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
					'depth'           => 1,
					'walker'          => ''
				); wp_nav_menu( $defaults );
			}else{
				echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
			} ?>
 
		</div> 
</div>
 
 
	
 
<?php get_footer(); ?>