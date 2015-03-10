<header> 
	<div class="container">
		<div class="row">
			<div class="twelve columns search">
				<a id="search-btn" href="#"><img src="<?php bloginfo('template_directory'); ?>/assets/img/search.png" alt="Search"></a>
			</div>
		</div>

		<div class="row">
			<div class="twelve columns logo">
 
			 	<a href="<?php bloginfo( 'url' );?>" title="<?php bloginfo( 'name' );?>">
			 		<img src="<?php bloginfo('template_directory'); ?>/assets/img/logo.png" alt="Pamela Hanson">
			 		 
			 	</a>

			</div>
		</div>
 
		<div class="row">
			<div class="twelve columns interior-menu">
				<div class="main-navigation">
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
									'depth'           => 2,
									'walker'          => ''
								); wp_nav_menu( $defaults );
							}else{
								echo "<p><em>main_nav</em> doesn't exist! Create it and it'll render here.</p>";
							} ?>
				</div>
			</div> 
		</div>
	</div>  
	<div id="search">
	    <button type="button" class="close">×</button>
	    <div class="search-title">> Search Pamela's Work: </div>
	    <form  role="search" method="get" class="search-form" action="<?php echo home_url( '/' ); ?>">
	        <input type="search" value="<?php echo get_search_query() ?>" name="s" placeholder="search here" />
	        <!--<button type="submit" class="btn btn-primary">Search</button>-->
	    </form>
	</div>
</header> 