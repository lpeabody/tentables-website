<?php
/**
 * The Header for our theme.
 *
 * @package WordPress
 * @subpackage Tentables
 * @since Tentables 2.0
 */

?><!DOCTYPE HTML>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=0">
<title><?php wp_title(''); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<link rel="shortcut icon" href="<?php bloginfo('url'); ?>/favicon.ico">
<?php if ( is_singular() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' ); ?>
<?php 
	wp_head(); 
	$url = 'http://' . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'];
	$page_careers = get_page( 222 );
	$page_food_ethics = get_page( 9 );
	$page_about = get_page( 166 );
	$page_founder = get_page( 212 );
	$page_reservations = get_page( 5 );
	$page_gift_cards = get_page( 175 );
	$page_partners = get_page( 219 );
	//$page_contact = get_page( 25 );

	$careers = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower(str_replace (" ", "-", $page_careers->post_title)));
	$food_ethics = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower(str_replace (" ", "-", $page_food_ethics->post_title)));
	$reservations = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower(str_replace (" ", "-", $page_reservations->post_title)));
	$about = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower(str_replace (" ", "-", $page_about->post_title)));
	$giftcards = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower(str_replace (" ", "-", $page_gift_cards->post_title)));
	$founder = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower(str_replace (" ", "-", $page_founder->post_title)));
	$partners = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower(str_replace (" ", "-", $page_partners->post_title)));
	//$contact = preg_replace('/[^a-zA-Z0-9-]/', '', strtolower(str_replace (" ", "-", $page_contact->post_title)));


?>
<script src="<?php bloginfo('template_directory'); ?>/scripts/libs/modernizr.custom.34340.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
<script>

	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	})(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	ga('create', 'UA-42476168-1', 'tentables.net');
	ga('send', 'pageview');

</script>
<!--[if lte IE 9]>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/styles/stylesheets/ie.css" />
<![endif]-->
<!--[if lte IE 7]>
	<link rel="stylesheet" type="text/css" media="screen" href="<?php bloginfo('template_directory'); ?>/styles/stylesheets/ie7.css" />
<![endif]-->
</head>
<body <?php body_class(); ?>>
<div class="loading">
	<div class="loading-content">
		Loading
		<span class="loader">
			<span>.</span><span>.</span><span>.</span>
		</span>
	</div>
</div>
<span style="display:none;"><?php 
	include_once(get_template_directory().'/includes/forms/form-private-event.php');?></span>
	<div class="darken"></div>
	<div class="chalkboard top">
		<a href="#" name="chalkboard"></a>
		<div class="social">
			<a href="https://www.facebook.com/TENTABLES" target="_blank" class="fb"></a>
			<a href="https://twitter.com/tentables" target="_blank" class="tw"></a>
		</div>
		<nav class="page-width">
			<h1 class="screenreader">Top Navigation</h1>
			<a href="/" class="logo-mini">Ten Tables</a>
			<?php wp_nav_menu( array('menu' => 'Chalkboard', 'items_wrap' => '%3$s', 'container' => '' )); ?>
		</nav>
		<div class="chalkboard-content">
			<div class="page-width">
				<a href="#" class="close-chalkboard">x</a>
				<section id="<?php echo $reservations; ?>">
					<h1 class="screenreader">Reservations + Private Events</h1>
					<?php echo apply_filters('the_content', $page_reservations->post_content); ?>
					<div class="column">
						<div id="OT_searchWrapperAll">

							<script type="text/javascript" src="//www.opentable.com/ism/?rid=29368,30976"></script>

							<noscript id="OT_noscript">

							<a href="//www.opentable.com/single.aspx?rid=29368&restref=29368&rtype=ism">Reserve Now for Ten Tables Cambridge on OpenTable.com</a>

							<a href="//www.opentable.com/single.aspx?rid=30976&restref=30976&rtype=ism">Reserve Now for Ten Tables JP on OpenTable.com</a>

							</noscript>

						</div>
					</div>
					<div class="column">
						<h2>Book a Private Event</h2>
						<form class="formValidate" action="/#reservations--private-events" id="formEvent" method="post">

							<?php if (isset($_POST['email'])) { ?>
								<?php if ($failed == true) { ?> 
									<p class="error">We're sorry, but there were error(s) found with the form you submitted.</p>
									<ul class="error"><?php echo $message; ?></ul>
								<?php } else { ?>
									<p class="success">Thank you for your message. We will get back to you soon.</p>
								<?php } ?>
							<?php } ?>
							<div class="row">
								<label for="restaurant">Restaurant:*</label>
								<select class="required" id="restaurant" name="restaurant">
									<option value="">Select a Restaurant</option>
									<option value="jp" <?php if($_POST['restaurant'] == 'jp') { ?>selected="selected"<?php } ?>>Jamaica Plain</option>
									<option value="cambridge" <?php if($_POST['restaurant'] == 'cambridge') { ?>selected="selected"<?php } ?>>Cambridge</option>
									<option value="provincetown" <?php if($_POST['restaurant'] == 'provincetown') { ?>selected="selected"<?php } ?>>Provincetown</option>
								</select>
							</div>
							<div class="row">
								<label for="realname">Name:*</label>
								<input type="text" name="realname" id="realname" class="required">
							</div>
							<div class="row">
								<label for="email">Email Address:*</label>
								<input type="text" name="email" id="email" class="required">
							</div>
							<div class="row">
								<label for="phone">Phone Number:*</label>
								<input type="text" name="phone" id="phone" class="required">
							</div>
							<div class="row">
								<label for="guests">Number of Guests:*</label>
								<select class="required" id="guests" name="guests">
									<option value="">Select a Number</option>
									<option value="5-10" <?php if($_POST['guests'] == '5-10') { ?>selected="selected"<?php } ?>>5-10</option>
									<option value="10-20" <?php if($_POST['guests'] == '10-20') { ?>selected="selected"<?php } ?>>10-20</option>
									<option value="20-30" <?php if($_POST['guests'] == '20-30') { ?>selected="selected"<?php } ?>>20-30</option>
								</select>
							</div>
							<div class="row">
								<label for="eventtype">Event Type:*</label>
								<select class="required" id="eventtype" name="eventtype">
									<option value="">Select a Type</option>
									<option value="birthday" <?php if($_POST['eventtype'] == 'birthday') { ?>selected="selected"<?php } ?>>Birthday</option>
									<option value="anniversary" <?php if($_POST['eventtype'] == 'anniversary') { ?>selected="selected"<?php } ?>>Anniversary</option>
									<option value="wedding" <?php if($_POST['eventtype'] == 'wedding') { ?>selected="selected"<?php } ?>>Wedding Party</option>
									<option value="graduation" <?php if($_POST['eventtype'] == 'graduation') { ?>selected="selected"<?php } ?>>Graduation</option>
									<option value="other" <?php if($_POST['eventtype'] == 'other') { ?>selected="selected"<?php } ?>>Other</option>
								</select>
							</div>
							<div class="row">
								<label for="eventdate">Event Date:*</label>
								<input type="text" name="eventdate" id="eventdate" class="required">
							</div>
							<?php 
								require_once('includes/forms/recaptchalib.php');
								$publickey = "6LcB-uYSAAAAAFd-JMMMRXSsYJrfkRdFNR6L1YK3"; // you got this from the signup page
								echo recaptcha_get_html($publickey); 
							?>
							<div class="row">
								<input type="submit" value="Book an Event">
							</div>
						</form>
					</div>
					<div class="clear"></div>
				</section>
				<section id="<?php echo $about; ?>">
					<h2 class="about-header">About Ten Tables</h2>
					<nav class="about-nav">
						<a href="#" class="active">What We Believe</a>
						<a href="#">Our Founder</a>
						<a href="#">Partners</a>
						<a href="#">Careers</a>
						<?php /* <a href="#">Reviews</a> */ ?>
					</nav>
					<div class="switch-content">
						<div class="tab active">
							<div class="wrap">
								<?php echo apply_filters('the_content', $page_food_ethics->post_content); ?>
							</div>
							<div class="icon-wrap">
								<span class="icon neighborhood"></span>
								<span class="icon farmhouse"></span>
								<span class="icon leaf"></span>
							</div>
						</div>
						<div class="tab">
							<div class="wrap">
								<?php echo apply_filters('the_content', $page_founder->post_content); ?>
							</div>
						</div>
						<div class="tab">
							<div class="wrap">
								<?php echo apply_filters('the_content', $page_partners->post_content); ?>
							</div>
						</div>
						<div class="tab">
							<div class="wrap">
								<?php echo apply_filters('the_content', $page_careers->post_content); ?>
							</div>
						</div>
						<?php /*  <div class="tab">
							<?php echo apply_filters('the_content', $page_reviews->post_content); ?>
						</div>*/ ?>
					</div>	
				</section>
				<section id="<?php echo $giftcards; ?>">
					<h2>Gift Cards</h2>
					<div class="tab">
						<div class="wrap">
							<?php echo apply_filters('the_content', $page_gift_cards->post_content); ?>
						</div>
					</div>
				</section>
			</div>
		</div>
	</div>
	<?php if(is_home()) { ?>
	<div class="locations fresh">
		<span class="title"><strong>Our 3 locations: </strong> menus, specials, directions, contact info...</span>
		<div class="top-nav-wrap">
			<div class="page-width">
				<div class="column"><a href="#jp" id="location-jp">Jamaica Plain</a></div>
				<div class="column"><a href="#cambridge" id="location-cambridge">Cambridge</a></div>
				<div class="column"><a href="#provincetown" id="location-provincetown">Provincetown</a></div>
				<div class="clear"></div>
				<a href="#" id="close-faders"><span>x</span></a>
			</div>
		</div>
		<div class="page-width mega-wrap">
			<nav class="mega location-jp">
				<a href="#menu-jp" id="menu-jp-link">Menu</a>
				<a href="#drinks-jp" id="drinks-jp-link">Drinks</a>
				<a href="#parking--directions-jp" id="parking--directions-jp-link">Parking+Directions</a>
				<a href="#contact-jp" id="contact-jp-link">Contact</a>
				<a href="#team-jp" id="team-jp-link">Team</a>
			</nav>
			<nav class="mega location-provincetown">
				<a href="#menu-provincetown" id="menu-provincetown-link">Menu</a>
				<a href="#drinks-provincetown" id="drinks-provincetown-link">Drinks</a>
				<a href="#parking--directions-provincetown" id="parking--directions-provincetown-link">Parking + Directions</a>
				<a href="#contact-provincetown" id="contact-provincetown-link">Contact</a>
				<a href="#team-provincetown" id="team-provincetown-link">Team</a>
			</nav>
			<nav class="mega location-cambridge">
				<a href="#menu-cambridge" id="menu-cambridge-link">Menu</a>
				<a href="#drinks-cambridge" id="drinks-cambridge-link">Drinks</a>
				<a href="#parking--directions-cambridge" id="parking--directions-cambridge-link">Parking + Directions</a>
				<a href="#contact-cambridge" id="contact-cambridge-link">Contact</a>
				<a href="#team-cambridge" id="team-cambridge-link">Team</a>
			</nav>
		</div>
	</div>
	<?php } ?>