<?php get_header(); ?>
	<div id="content">
		<div class="pageWidth">
			<div class="row-fluid pageContent index">
				<div class="mainContainer span8">
					<div class="mainContent">
						<div id="recentNews">
						<?php if (have_posts()) : while (have_posts()) : the_post(); ?>	
							<div id="<?php the_ID(); ?>" class="section sectionMain recentNews">
								<div class="primaryContent leftDate">
									<h2 class="subHeading">
										<a class="newsTitle" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
									</h2>
									<div class="messageContent baseHtml">
										<div class="postedBy">
											<span class="posted"><div class="sticky"></div>bởi <?php the_author_posts_link(); ?> ,<?php time_stamp(get_post_time('U', true)); ?></span>
											<span class="views">(<?php if(function_exists('the_views')) the_views();?>)</span>
										</div>
										<div class="newsText">
											<div class="aligncenter">
											<?php if ( get_the_post_thumbnail(get_the_ID()) != '' ) {
											  echo '<a href="'; the_permalink(); echo '" class="thumbnail-wrapper">';
											   the_post_thumbnail();
											  echo '</a>';
											} else {
											 echo '<a href="'; the_permalink(); echo '" class="thumbnail-wrapper">';
											 echo '<img src="';
											 echo catch_that_image();
											 echo '" alt="" />';
											 echo '</a>';

											}?>
											</div>
											<?php echo _substr(wp_trim_excerpt(),300, get_permalink());   ?>
											<div><a class="more-link" href="<?php the_permalink();?>"> Nhấn vào để đọc thêm</a></div>
										<div class="clearFix"></div>
									</div>
									</div>
									<div class="subFooting">
									<div class="tags-and-categories">
										<?php the_tags() ?>			
									</div>
									<div class="tags-and-categories">
										Categories: <?php the_category(', ') ?>			
									</div>
									</div>
								</div>
							</div>
						<?php endwhile;?>
						<div class="navigation">
							<?php if (function_exists('iz_pagination')) iz_pagination(); ?>
						</div>
						<?php endif;?>
						</div>
					</div>
				</div>
				<?php get_sidebar();?>
			</div>
		</div>
	</div>
<?php get_footer(); ?>