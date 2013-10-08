<?php
/**
 * The main template file.
 *
 * @package WordPress
 * @subpackage Tentables
 */
get_header(); 

?>


<div class="first fullscreen-bg">
	<img src="<?php bloginfo('template_directory'); ?>/images/bg.jpg" alt="">
</div>
<div class="welcome initial overflow">
	<div class="logo"><h1>Ten Tables</h1></div>
	<?php
		if(
			//detect tiny stupid phones, bro -- for FAST LOADS!
			strstr($_SERVER['HTTP_USER_AGENT'],'iPhone') 
			|| strstr($_SERVER['HTTP_USER_AGENT'],'iPod') 
			|| strstr($_SERVER['HTTP_USER_AGENT'],'ICEbrowser')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'GT-I5510')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'SAMSUNG-SGH-I897')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'LG-GT540')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'FROYO')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'HTC_Wildfire_A3333')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'HuaweiM835')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'HuaweiM860')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'FRG83G')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'GINGERBREAD')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'Sensation_4G')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'GRJ22')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'HTC_WildfireS_A510e')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'GRK39F')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'DROID RAZR 4G')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'Nexus S Build')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'rv:1.9.2.17')
			|| strstr($_SERVER['HTTP_USER_AGENT'],'J2ME/MIDP')
		) {} else {
	?>
	<a href="#" class="jog-open"><span class="closed">gallery</span><span class="open">close gallery</span></a>
	<a href="#" class="jog-left inactive"></a>
	<a href="#" class="jog-right inactive"></a>
	<a href="#" class="close-blowup"></a>
	<div class="images-wrap-wrap">
		<div class="images-wrap">
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food4.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food4-large.jpg" alt="" class="large">
				</div>
			</div>
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food1.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food1-large.jpg" alt="" class="large">
				</div>
			</div>
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food2.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food2-large.jpg" alt="" class="large">
				</div>
			</div>
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food3.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food3-large.jpg" alt="" class="large">
				</div>
			</div>
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food5.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food5-large.jpg" alt="" class="large">
				</div>
			</div>
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food7.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food7-large.jpg" alt="" class="large">
				</div>
			</div>
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food8.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food8-large.jpg" alt="" class="large">
				</div>
			</div>
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food9.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food9-large.jpg" alt="" class="large">
				</div>
			</div>
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food10.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food10-large.jpg" alt="" class="large">
				</div>
			</div>
			<div class="image-wrap">
				<a href="#"><img src="<?php bloginfo('template_directory'); ?>/images/food6.jpg" alt=""></a>
				<div class="fullscreen-bg">
					<img src="<?php bloginfo('template_directory'); ?>/images/food6-large.jpg" alt="" class="large">
				</div>
			</div>
		</div>
	</div>	
	<?php } ?>
</div>
<?php include(get_template_directory() . '/includes/content/under.php'); ?>

<?php get_footer(); ?>