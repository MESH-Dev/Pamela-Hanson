<!--
<header class="interior"> 
	<div class="container">
		<div class="five columns interior-menu">
			<div class="logo">
				 <div class="logo-block">
				 	<a href="<?php bloginfo( 'url' );?>" title="<?php bloginfo( 'name' );?>">
				 		<img id="static-blocks" src="<?php bloginfo('template_directory'); ?>/assets/img/cbi-logo3.png" alt="static block">
				 		<img id="animated-blocks" src="<?php bloginfo('template_directory'); ?>/assets/img/cbi-logo.gif" alt="animated blocks" style="display:none">
				 	</a>
				 </div>
				 <div class="logo-name">
				 	<a href="<?php bloginfo( 'url' );?>" title="<?php bloginfo( 'name' );?>"><img src="<?php bloginfo('template_directory'); ?>/assets/img/cbi.png" alt="Capitol Business Interiors"></a>
				 </div>
			</div>
			<div class="main-navigation ">
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

	</div>  
</header> -->