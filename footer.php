			<footer class="footer full-bleed" role="contentinfo">
				<div class="wrapper">

					<div class="footer-branding">
						<img class="footer-branding__img" src="<?php echo get_template_directory_uri(); ?>/img/sverige-united-logo.svg" alt="Sverige United" class="logo-img">
						<span class="footer-branding__text">&copy; <?php echo date('Y'); ?> SVERIGE UNITED</span>
					</div>

					<nav class="footer-nav">
						<?php wp_nav_menu(array('menu' => 'Sidfoten')); ?>
					</nav>

					<nav class="footer-social-nav">
						<?php wp_nav_menu(array('menu' => 'Social Media')); ?>
					</nav>

				</div>
			</footer>


			</div>
			<!-- /wrapper -->

			<?php wp_footer(); ?>

			<!-- analytics -->
			<script>
				(function(f, i, r, e, s, h, l) {
					i['GoogleAnalyticsObject'] = s;
					f[s] = f[s] || function() {
						(f[s].q = f[s].q || []).push(arguments)
					}, f[s].l = 1 * new Date();
					h = i.createElement(r),
						l = i.getElementsByTagName(r)[0];
					h.async = 1;
					h.src = e;
					l.parentNode.insertBefore(h, l)
				})(window, document, 'script', '//www.google-analytics.com/analytics.js', 'ga');
				ga('create', 'UA-XXXXXXXX-XX', 'yourdomain.com');
				ga('send', 'pageview');
			</script>

			<script>
				var nav = responsiveNav(".nav-collapse", { // Selector
					animate: true,
					transition: 0, // ms
					label: "MENY", // String: Label for the navigation toggle
					insert: "before", // String: Insert the toggle before or after the navigation
					customToggle: "", // Selector: Specify the ID of a custom toggle
					closeOnNavClick: false, // Boolean: Close the navigation when one of the links are clicked
					openPos: "relative", // String: Position of the opened nav, relative or static
					navClass: "nav-collapse", // String: Default CSS class. If changed, you need to edit the CSS too!
					navActiveClass: "js-nav-active", // String: Class that is added to <html> element when nav is active
					jsClass: "js", // String: 'JS enabled' class which is added to <html> element
					init: function() {}, // Function: Init callback
					open: function() {}, // Function: Open callback
					close: function() {} // Function: Close callback
				});
			</script>

			</body>

			</html>