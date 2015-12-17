		<footer>
			<div class="footer">
				<div class="pageWidth">
					<div class="pageContent">
						<ul class="legal">
							<li id="copyright">Copyright &copy; <?php echo date("Y"); ?>,<?php bloginfo('name'); ?></li>
						</ul>
					</div>
				</div>
			</div>
	</footer>
	</div>
     <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <!-- <script type="text/javascript" src="http://platform.twitter.com/widgets.js"></script> -->
	<script src="<?php bloginfo('template_url'); ?>/assets/js/jquery.js"></script>
	<script src="<?php bloginfo('template_url'); ?>/assets/js/bootstrap/bootstrap.min.js"></script>   
	<script type="text/javascript">
		$(document).ready(function(){
			$('.dropdown-toggle').dropdown();
		});
	</script>
	<?php wp_footer();?>
	</body>
</html>