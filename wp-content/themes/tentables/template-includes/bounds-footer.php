	<div id="bounds-footer">
		<footer class="page-width">
			<nav id="colophon">
				<ul>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Privacy Policy</a></li>
					<li><a href="#">Sitemap</a></li>
				</ul>
			</nav>
		</footer>
	</div>
	<script src="/wp-content/themes/tentables/scripts/libs/jquery.js"></script>
	<script src="/wp-content/themes/tentables/scripts/libs/lodash.js"></script>
	<script src="/wp-content/themes/tentables/scripts/common.js"></script>
	<script type='text/javascript'>

		//shims and fallbacks
		Modernizr.load([{
		  test: Modernizr.input.placeholder,
		  nope: '/wp-content/themes/tentables/scripts/libs/jquery.placeholder.js'
		},{
		  test: Modernizr.generatedcontent,
		  nope: '/wp-content/themes/tentables/scripts/libs/jquery.ie7.js'
		},{
		  test: Modernizr.mq('only all'),
		  nope: '/wp-content/themes/tentables/scripts/libs/respond.min.js'
		},{
		  test: Modernizr.textshadow,
		  nope: [ '/wp-content/themes/tentables/scripts/libs/jquery.textshadow.js', '/wp-content/themes/tentables/scripts/libs/jquery.ie8.js' ]
		}]);

	</script>	
</body>
</html>