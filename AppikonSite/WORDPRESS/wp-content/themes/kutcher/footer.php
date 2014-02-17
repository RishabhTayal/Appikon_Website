	
	
	<div class="copyright-wrapper">
		<div class="copyright">
			<?php if( of_get_option('footer_copyright') != '') : ?>
			<p><?php echo of_get_option('footer_copyright'); ?> <span><?php if( of_get_option('wpml_footer') ) language_selector_flags(); ?></span>
			</p>
			<?php endif; ?>

		</div>
	</div>

	<?php if( of_get_option('gcode') != '' ) : ?>
	<script type="text/javascript">
		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', '<?php echo of_get_option('gcode'); ?>']);
		_gaq.push(['_trackPageview']);

		(function() {
			var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();
	</script>
	<?php endif; ?>

	<?php wp_footer(); ?>
</body>
</html>