

		
<a name="jp" id="jp"></a>
<a name="cambridge" id="cambridge"></a>
<a name="provincetown" id="provincetown"></a>
<div class="under fixed">
	<section class="page-width location-jp">
		<h1 class="screenreader">Ten Tables Jamaica Plain Location</h1>
		<h5 class="center hours"><strong>Hours:</strong> Mon-Thurs 5:30-10pm, Fri-Sat 5:30-10:30pm, Sun 5-9pm</h5>
		<?php
			//jp specials
			$post_id = 248;
			$queried_post = get_post($post_id);
			$title = $queried_post->post_title;

			$special_newsletter = get_post_meta($post_id,'_special_newsletter',true);
			$special_content = $queried_post->post_content;
		?>
		<?php if($special_content) { ?>
		<div class="specials">
			<div id="mc_embed_signup" class="newsletter">
				<p><?php echo $special_newsletter; ?></p>
				<form action="http://tentables.us7.list-manage1.com/subscribe/post?u=9cf0b589b747eebf07c6551e9&amp;id=d567cf3c0e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate=""><label for="mce-EMAIL"></label><input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required=""><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="small button">
				</form>
			</div>
			<?php
				echo $special_content;
			?>
		</div>
		<?php } ?>
		<article class="menu highlight menu-jp">
			<a href="#" name="menu-jp" id="menu-jp"></a>
			<?php
				//jp dinner menu
				$post_id = 48;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$menu_barbites = get_post_meta($post_id,'_menu_barbites',true);
				$menu_barboards = get_post_meta($post_id,'_menu_barboards',true);
				$menu_appetizer = get_post_meta($post_id,'_menu_appetizer',true);
				$menu_main = get_post_meta($post_id,'_menu_main',true);
				$menu_desert = get_post_meta($post_id,'_menu_desert',true);
				$menu_tastingmenus = get_post_meta($post_id,'_menu_tastingmenus',true);
				$menu_additionalofferings = get_post_meta($post_id,'_menu_additionalofferings',true);
				$menu_coffee = get_post_meta($post_id,'_menu_coffee',true);
				$menu_tea = get_post_meta($post_id,'_menu_tea',true);

				$dinner_intro = $queried_post->post_content;
			?>

			<h1>Dinner Menu</h1>
			<h3><?php
				echo $dinner_intro;
			?></h3>
			<hr>
			<?php if($menu_tastingmenus) { ?>
			<div class="column smaller">
			<h2>Tasting Menus</h2>
			<?php
				echo $menu_tastingmenus;
			?>
			</div>
			<?php } ?>
			<div class="column-wrap">
				<?php if($menu_barbites) {?>
				<div class="column double">
					<h2>Barbites</h2>
					<?php
						echo $menu_barbites;
					?>
				</div>
				<?php } ?>
				<?php if($menu_barboards) { ?>
				<div class="column double">
					<h2>Barboards</h2>
					<?php
						echo $menu_barboards;
					?>
				</div>
				<?php } ?>
			</div>
			<h2>Appetizers</h2>
			<?php
				echo $menu_appetizer;
			?>
			<h2>Mains</h2>
			<?php
				echo $menu_main;
			?>
			<h2>Dessert</h2>
			<?php
				echo $menu_desert;
			?>
			<?php if($menu_additionalofferings) { ?>
			<h2>Additional Offerings</h2>
			<div class="triple-column-this">
			<?php
				echo $menu_additionalofferings;
			?>
			</div>
			<?php } ?>
			<div class="column-wrap">
				<div class="column double">
					<h2>Coffee</h2>
					<?php
						echo $menu_coffee;
					?>
				</div>
				<div class="column double">
					<h2>Tea</h2>
					<?php
						echo $menu_tea;
					?>
				</div>
			</div>	
		</article>

		<article class="menu highlight drinks-jp">
			<a href="#" name="drinks-jp" id="drinks-jp"></a>
			<?php
				//jp drinks menu
				$post_id = 67;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$drink_flights = get_post_meta($post_id,'_drink_flights',true);
				$drink_cocktails = get_post_meta($post_id,'_drink_cocktails',true);
				$drink_nonalcoholic = get_post_meta($post_id,'_drink_nonalcoholic',true);
				$drink_beers = get_post_meta($post_id,'_drink_beers',true);
				$drink_wineontap = get_post_meta($post_id,'_drink_wineontap',true);
				$drink_wine = get_post_meta($post_id,'_drink_wine',true);

				$drinks_intro = $queried_post->post_content;
			?>
			<h1>Drinks Menu</h1>
			<h3><?php
				echo $drinks_intro;
			?></h3>
			<hr>
			<div class="column-wrap">
				<div class="column double">
					<h2>Cocktails</h2>
					<?php
						echo $drink_cocktails;
					?>
					<h2>Beers</h2>
					<?php
						echo $drink_beers;
					?>
					<h2>Drink Flights</h2>
					<?php
						echo $drink_flights;
					?>
					<h2>Non-Alcoholic Drinks</h2>
					<?php
						echo $drink_nonalcoholic;
					?>
					<h2>Wine by the Glass, &frac12; Bottle or Carafes</h2>
					<?php
						echo $drink_wineontap;
					?>
				</div>	
				<div class="column double">
					<h2>Wine Bottle List</h2>
					<?php
						echo $drink_wine;
					?>
				</div>	
			</div>
		</article>	

		<article class="highlight parking--directions-jp">
			<a href="#" name="parking--directions-jp" id="parking--directions-jp"></a>			
			<?php
				//jp parking + directions
				$post_id = 123;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$parking_and_directions = $queried_post->post_content;
				$parking_and_directions = apply_filters('the_content', $parking_and_directions);
			?>
			<h1>Parking + Directions</h1>
			<?php echo $parking_and_directions; ?>
			<div id="map_jp" class="map"></div>
		</article>

		<article class="highlight contact-jp">
			<a href="#" name="contact-jp" id="contact-jp"></a>
			<?php
				//jp contact
				$post_id = 112;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$contact_content = $queried_post->post_content;
				$contact_content = apply_filters('the_content', $contact_content);
			?>
			<h1>Contact Information</h1>
			<?php echo $contact_content; ?>
		</article>

		<article class="highlight team-jp">
			<?php
				//jp team
				$post_id = 102;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$team_members = $queried_post->post_content;
				$team_members = apply_filters('the_content', $team_members);
			?>
			<a href="#" name="team-jp" id="team-jp"></a>
			<h1>Team</h1>
			<?php echo $team_members; ?>
		</article>
	</section>
	<section class="page-width location-cambridge">
		<h1 class="screenreader">Ten Tables Cambridge Location</h1>
		<h5 class="center hours"><strong>Hours:</strong> Mon-Thurs 5:30-10pm, Fri-Sat 5:30-10:30pm, Sun 5-9pm</h5>
		<?php
			//cambridge specials
			$post_id = 255;
			$queried_post = get_post($post_id);
			$title = $queried_post->post_title;

			$special_newsletter = get_post_meta($post_id,'_special_newsletter',true);
			$special_content = $queried_post->post_content;
		?>
		<?php if($special_content) { ?>
		<div class="specials">
			<div id="mc_embed_signup" class="newsletter">
				<p><?php echo $special_newsletter; ?></p>
				<form action="http://tentables.us7.list-manage1.com/subscribe/post?u=9cf0b589b747eebf07c6551e9&amp;id=d567cf3c0e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate=""><label for="mce-EMAIL"></label><input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required=""><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="small button">
				</form>
			</div>
			<?php
				echo $special_content;
			?>
		</div>
		<?php } ?>
		<article class="menu highlight menu-cambridge">
			<a href="#" name="menu-cambridge" id="menu-cambridge"></a>
			<?php
				//cambridge dinner menu
				$post_id = 34;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$menu_barbites = get_post_meta($post_id,'_menu_barbites',true);
				$menu_barboards = get_post_meta($post_id,'_menu_barboards',true);
				$menu_appetizer = get_post_meta($post_id,'_menu_appetizer',true);
				$menu_main = get_post_meta($post_id,'_menu_main',true);
				$menu_tastingmenus = get_post_meta($post_id,'_menu_tastingmenus',true);
				$menu_desert = get_post_meta($post_id,'_menu_desert',true);
				$menu_additionalofferings = get_post_meta($post_id,'_menu_additionalofferings',true);
				$menu_coffee = get_post_meta($post_id,'_menu_coffee',true);
				$menu_tea = get_post_meta($post_id,'_menu_tea',true);

				$dinner_intro = $queried_post->post_content;
			?>
			<h1>Dinner Menu</h1>
			<h3><?php
				echo $dinner_intro;
			?></h3>
			<hr>
			<?php if($menu_tastingmenus) { ?>
			<div class="column smaller">
			<h2>Tasting Menus</h2>
			<?php
				echo $menu_tastingmenus;
			?>
			</div>
			<?php } ?>
			<div class="column-wrap">
				<?php if($menu_barbites) {?>
				<div class="column double">
					<h2>Barbites</h2>
					<?php
						echo $menu_barbites;
					?>
				</div>
				<?php } ?>
				<?php if($menu_barboards) { ?>
				<div class="column double">
					<h2>Barboards</h2>
					<?php
						echo $menu_barboards;
					?>
				</div>
				<?php } ?>
			</div>
			<h2>Appetizers</h2>
			<?php
				echo $menu_appetizer;
			?>
			<h2>Mains</h2>
			<?php
				echo $menu_main;
			?>
			<h2>Dessert</h2>
			<?php
				echo $menu_desert;
			?>
			<h2>Additional Offerings</h2>
			<?php
				echo $menu_additionalofferings;
			?>
			<div class="column-wrap">
				<div class="column double">
					<h2>Coffee</h2>
					<?php
						echo $menu_coffee;
					?>
				</div>
				<div class="column double">
					<h2>Tea</h2>
					<?php
						echo $menu_tea;
					?>
				</div>
			</div>	
		</article>

		<article class="menu highlight drinks-cambridge">
			<?php
				//cambridge drinks menu
				$post_id = 79;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$drink_flights = get_post_meta($post_id,'_drink_flights',true);
				$drink_cocktails = get_post_meta($post_id,'_drink_cocktails',true);
				$drink_nonalcoholic = get_post_meta($post_id,'_drink_nonalcoholic',true);
				$drink_beers = get_post_meta($post_id,'_drink_beers',true);
				$drink_wineontap = get_post_meta($post_id,'_drink_wineontap',true);
				$drink_winesbytheglass = get_post_meta($post_id,'_drink_winesbytheglass',true);
				$drink_wine = get_post_meta($post_id,'_drink_wine',true);

				$drinks_intro = $queried_post->post_content;
			?>
			<a href="#" name="drinks-cambridge" id="drinks-cambridge"></a>
			<h1>Drinks Menu</h1>
			<h3><?php
				echo $drinks_intro;
			?></h3>
			<hr>
			<div class="column-wrap">
				<div class="column double">
					<h2>Cocktails</h2>
					<?php
						echo $drink_cocktails;
					?>
					<?php if($drink_flights) { ?>
					<h2>Drink Flights</h2>
					<?php
						echo $drink_flights;
					?>
					<?php } ?>
					<h2>Beers</h2>
					<?php
						echo $drink_beers;
					?>
					<h2>Non-Alcoholic Drinks</h2>
					<?php
						echo $drink_nonalcoholic;
					?>
					<h2>Wine by the Glass, &frac12; Bottle or Carafes</h2>
					<?php
						echo $drink_wineontap;
					?>
				</div>	
				<div class="column double">
					<h2>Wine Bottle List</h2>
					<?php
						echo $drink_wine;
					?>
				</div>	
			</div>	
		</article>

		<article class="highlight parking--directions-cambridge">
			<a href="#" name="parking--directions-cambridge" id="parking--directions-cambridge"></a>
			<?php
				//cambridge parking + directions
				$post_id = 120;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$parking_and_directions = $queried_post->post_content;
				$parking_and_directions = apply_filters('the_content', $parking_and_directions);
			?>
			<h1>Parking + Directions</h1>
			<?php echo $parking_and_directions; ?>
			<div id="map_cambridge" class="map"></div>
		</article>

		<article class="highlight contact-cambridge">
			<a href="#" name="contact-cambridge" id="contact-cambridge"></a>
			<?php
				//cambridge contact
				$post_id = 118;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$contact_content = $queried_post->post_content;
				$contact_content = apply_filters('the_content', $contact_content);
			?>
			<h1>Contact Information</h1>
			<?php echo $contact_content; ?>
		</article>

		<article class="highlight team-cambridge">
			<a href="#" name="team-cambridge" id="team-cambridge"></a>
			<?php
				//cambridge team
				$post_id = 106;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$team_members = $queried_post->post_content;
				$team_members = apply_filters('the_content', $team_members);
			?>
			<h1>Team</h1>
			<?php echo $team_members; ?>
		</article>
	</section>
	<section class="page-width location-provincetown">
		<h1 class="screenreader">Ten Tables Provincetown Location</h1>
		<h5 class="center hours"><strong>Hours:</strong> Open 7 Days; Dinner 6-10pm, Bar 4:30-Close</h5>
		<?php
			//provincetown specials
			$post_id = 253;
			$queried_post = get_post($post_id);
			$title = $queried_post->post_title;

			$special_newsletter = get_post_meta($post_id,'_special_newsletter',true);
			$special_content = $queried_post->post_content;
		?>
		<?php if($special_content) { ?>
		<div class="specials">
			<div id="mc_embed_signup" class="newsletter">
				<p><?php echo $special_newsletter; ?></p>
				<form action="http://tentables.us7.list-manage1.com/subscribe/post?u=9cf0b589b747eebf07c6551e9&amp;id=d567cf3c0e" method="post" id="mc-embedded-subscribe-form" name="mc-embedded-subscribe-form" class="validate" target="_blank" novalidate=""><label for="mce-EMAIL"></label><input type="email" value="" name="EMAIL" class="email" id="mce-EMAIL" placeholder="email address" required=""><input type="submit" value="Subscribe" name="subscribe" id="mc-embedded-subscribe" class="small button">
				</form>
			</div>
			<?php
				echo $special_content;
			?>
		</div>
		<?php } ?>
		<article class="menu highlight menu-provincetown">
			<a href="#" name="menu-provincetown" id="menu-provincetown"></a>
			<?php
				//provincetown dinner menu
				$post_id = 50;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$menu_barbites = get_post_meta($post_id,'_menu_barbites',true);
				//$menu_barboards = get_post_meta($post_id,'_menu_barboards',true);
				$menu_appetizer = get_post_meta($post_id,'_menu_appetizer',true);
				$menu_main = get_post_meta($post_id,'_menu_main',true);
				$menu_tastingmenus = get_post_meta($post_id,'_menu_tastingmenus',true);
				$menu_desert = get_post_meta($post_id,'_menu_desert',true);
				$menu_additionalofferings = get_post_meta($post_id,'_menu_additionalofferings',true);
				$menu_coffee = get_post_meta($post_id,'_menu_coffee',true);
				//$menu_tea = get_post_meta($post_id,'_menu_tea',true);

				$dinner_intro = $queried_post->post_content;
			?>
			<h1>Dinner Menu</h1>
			<h3><?php
				echo $dinner_intro;
			?></h3>
			<hr>
			<?php if($menu_tastingmenus) { ?>
			<div class="column smaller">
			<h2>Tasting Menus</h2>
			<?php
				echo $menu_tastingmenus;
			?>
			</div>
			<?php } ?>
			<div class="column-wrap">
				<div class="column double">
					<h2>Table Bites</h2>
					<?php
						echo $menu_barbites;
					?>
				</div>
				<div class="column double">
					<h2>Appetizers</h2>
					<?php
						echo $menu_appetizer;
					?>
				</div>
			</div>
			<h2>Mains</h2>
			<?php
				echo $menu_main;
			?>
			<h2>Dessert</h2>
			<?php
				echo $menu_desert;
			?>
			<div class="column-wrap">
				<div class="column double">
					<h2>Additional Offerings</h2>
					<?php
						echo $menu_additionalofferings;
					?>
				</div>
				<div class="column double">
					<h2>Coffee</h2>
					<?php
						echo $menu_coffee;
					?>
				</div>
			</div>	
		</article>

		<article class="menu highlight drinks-provincetown">
			<?php
				//provincetown drinks menu
				$post_id = 77;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$drink_flights = get_post_meta($post_id,'_drink_flights',true);
				$drink_cocktails = get_post_meta($post_id,'_drink_cocktails',true);
				$drink_nonalcoholic = get_post_meta($post_id,'_drink_nonalcoholic',true);
				$drink_beers = get_post_meta($post_id,'_drink_beers',true);
				$drink_wineontap = get_post_meta($post_id,'_drink_wineontap',true);
				$drink_winesbytheglass = get_post_meta($post_id,'_drink_winesbytheglass',true);
				$drink_wine = get_post_meta($post_id,'_drink_wine',true);

				$drinks_intro = $queried_post->post_content;
			?>
			<a href="#" name="drinks-provincetown" id="drinks-provincetown"></a>
			<h1>Drinks Menu</h1>
			<h3><?php
				echo $drinks_intro;
			?></h3>
			<hr>
			<div class="column-wrap">
				<div class="column double">
					<h2>Cocktails</h2>
					<?php
						echo $drink_cocktails;
					?>
					<?php if($drink_flights) { ?>
					<h2>Drink Flights</h2>
					<?php
						echo $drink_flights;
					?>
					<?php } ?>
					<h2>Beers</h2>
					<?php
						echo $drink_beers;
					?>
					<h2>Non-Alcoholic Drinks</h2>
					<?php
						echo $drink_nonalcoholic;
					?>
					<h2>Wine by the Glass, &frac12; Bottle or Carafes</h2>
					<?php
						echo $drink_wineontap;
					?>
				</div>
				<div class="column double">
					<h2>Wine Bottle List</h2>
					<?php
						echo $drink_wine;
					?>
				</div>
			</div>	
		</article>	

		<article class="highlight parking--directions-provincetown">
			<a href="#" name="parking--directions-provincetown" id="parking--directions-provincetown"></a>
			<?php
				//provincetown parking + directions
				$post_id = 126;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$parking_and_directions = $queried_post->post_content;
				$parking_and_directions = apply_filters('the_content', $parking_and_directions);
			?>
			<h1>Parking + Directions</h1>
			<?php echo $parking_and_directions; ?>
			<div id="map_provincetown" class="map"></div>
		</article>

		<article class="highlight contact-provincetown">
			<a href="#" name="contact-provincetown" id="contact-provincetown"></a>
			<?php
				//cambridge contact
				$post_id = 115;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$contact_content = $queried_post->post_content;
				$contact_content = apply_filters('the_content', $contact_content);
			?>
			<h1>Contact Information</h1>
			<?php echo $contact_content; ?>
		</article>

		<article class="highlight team-provincetown">
			<a href="#" name="team-provincetown" id="team-provincetown"></a>
			<?php
				//provincetown team
				$post_id = 109;
				$queried_post = get_post($post_id);
				$title = $queried_post->post_title;

				$team_members = $queried_post->post_content;
				$team_members = apply_filters('the_content', $team_members);
			?>
			<h1>Team</h1>
			<?php echo $team_members; ?>
		</article>
	</section>
	<div class="fullscreen-bg location-jp">
		<img src="<?php bloginfo('template_directory'); ?>/images/jp.jpg" />
	</div>
	<div class="fullscreen-bg location-provincetown">
		<img src="<?php bloginfo('template_directory'); ?>/images/provincetown.jpg" />
	</div>
	<div class="fullscreen-bg location-cambridge">
		<img src="<?php bloginfo('template_directory'); ?>/images/cambridge.jpg" />
	</div>
</div>