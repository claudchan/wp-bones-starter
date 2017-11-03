<?php
/*
 Template Name: Homepage
 *
 * For more info: http://codex.wordpress.org/Page_Templates
*/

$GLOBALS['fullwidth'] = false;
$fullwidth = $GLOBALS['fullwidth'];

global $fullwidth;

?>

<?php get_header(); ?>

			<div id="content">

				<div id="inner-content" class="wrap cf">


						<?php // check if the flexible content field has rows of data ?>
						 
						<?php if( have_rows('flexible_content') ): ?>

							<?php // loop through the rows of data ?>
							<?php while ( have_rows('flexible_content') ) : the_row(); ?>

								<?php // check current row layout ?>
								<?php if( get_row_layout() == 'hero' ): ?>
								
									<section>
										<div class="hero" style="background-image:url(<?php the_sub_field('hero_image') ?>);background-size:cover;background-repeat:no-repeat;background-position:center;color:#fff;min-height:320px;padding:60px;text-align:center;">
											<div class="cta_container">
												<div class="cta_content">
													<div class="cta_content wrap">
														<?php the_sub_field('hero_text'); ?>

														<?php $selected = get_sub_field('display_cta_button'); ?>

														<?php if( in_array( true , [$selected]) ) : ?>

															<a class="btn btn-primary" href="<?php the_sub_field('hero_cta_button_url') ?>">
																<?php the_sub_field('hero_button_text'); ?>
															</a>

														<?php endif; ?>
													</div>
												</div>
											</div> 
										</div>
									</section> 
								
								<?php endif; ?>

								<?php // check current row layout ?>
								<?php if( get_row_layout() == 'text-image' ): ?>
								
									<section>

										<div class="row row-no-gap text-image">
											<div class="col-sm-6 text-left <?php the_sub_field('css_class')?>" style="padding:30px;">
												<?php the_sub_field('left_text'); ?>
											</div>
											<div class="col-sm-6 image-right">
												<img src="<?php the_sub_field('right_image') ?>" class="img-responsive" />
											</div>
										</div>

									</section> 
								
								<?php endif; ?>

								<?php // check current row layout ?>
								<?php if( get_row_layout() == 'image-text' ): ?>
									
									<section>

										<div class="row row-no-gap image-text">
											<div class="col-sm-6 image-left">
												<img src="<?php the_sub_field('left_image') ?>" class="img-responsive" />
											</div>
											<div class="col-sm-6 text-right <?php the_sub_field('css_class')?>" style="padding:30px;">
												<?php the_sub_field('right_text'); ?>
											</div>
										</div>

									</section> 
								
								<?php endif; ?>
							
							<?php endwhile; ?>

						<?php else : ?>


						<main id="main" class="m-all t-2of3 d-5of7 cf" role="main" itemscope itemprop="mainContentOfPage" itemtype="http://schema.org/Blog">

							<div class="js-slick" data-slick='{"dots": true, "infinite": true, "slidesToShow": 1, "slidesToScroll": 1}'>
								<div><img src="//lorempixel.com/1280/500/nightlife" style="display: block; width: 100%; max-width: 100%; height: auto;"></div>
								<div><img src="//lorempixel.com/1280/500/nightlife" style="display: block; width: 100%; max-width: 100%; height: auto;"></div>
								<div><img src="//lorempixel.com/1280/500/nightlife" style="display: block; width: 100%; max-width: 100%; height: auto;"></div>
							</div>

							<div class="container<?php if ($fullwidth) { echo '-fluid'; } ?>">

								<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

								<article id="post-<?php the_ID(); ?>" <?php post_class( 'cf' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

									<header class="article-header">

										<h1 class="page-title"><?php the_title(); ?></h1>

										<p class="byline vcard">
											<?php printf( __( 'Posted <time class="updated" datetime="%1$s" itemprop="datePublished">%2$s</time> by <span class="author">%3$s</span>', 'bonestheme' ), get_the_time('Y-m-j'), get_the_time(get_option('date_format')), get_the_author_link( get_the_author_meta( 'ID' ) )); ?>
										</p>


									</header>

									<section class="entry-content cf" itemprop="articleBody">
										<?php
											// the content (pretty self explanatory huh)
											the_content();

											/*
											 * Link Pages is used in case you have posts that are set to break into
											 * multiple pages. You can remove this if you don't plan on doing that.
											 *
											 * Also, breaking content up into multiple pages is a horrible experience,
											 * so don't do it. While there are SOME edge cases where this is useful, it's
											 * mostly used for people to get more ad views. It's up to you but if you want
											 * to do it, you're wrong and I hate you. (Ok, I still love you but just not as much)
											 *
											 * http://gizmodo.com/5841121/google-wants-to-help-you-avoid-stupid-annoying-multiple-page-articles
											 *
											*/
											wp_link_pages( array(
												'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'bonestheme' ) . '</span>',
												'after'       => '</div>',
												'link_before' => '<span>',
												'link_after'  => '</span>',
											) );
										?>
									</section>


									<footer class="article-footer">

										<?php the_tags( '<p class="tags"><span class="tags-title">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '</p>' ); ?>

									</footer>

									<?php comments_template(); ?>

								</article>

								<?php endwhile; else : ?>

										<article id="post-not-found" class="hentry cf">
												<header class="article-header">
													<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
											</header>
												<section class="entry-content">
													<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
											</section>
											<footer class="article-footer">
													<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
											</footer>
										</article>

								<?php endif; ?>

							</div>

						</main>

						<?php get_sidebar(); ?>

						<?php endif; ?>

				</div>

			</div>


<?php get_footer(); ?>
