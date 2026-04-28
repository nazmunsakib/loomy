<?php get_header(); ?>

<main id="primary" class="site-main py-12">
    <div class="container mx-auto px-4">
        <?php if ( have_posts() ) : ?>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                <?php while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class( 'bg-white rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow' ); ?>>
                        <?php if ( has_post_thumbnail() ) : ?>
                            <div class="post-thumbnail">
                                <a href="<?php the_permalink(); ?>">
                                    <?php the_post_thumbnail( 'loomy-card', ['class' => 'w-full h-48 object-cover'] ); ?>
                                </a>
                            </div>
                        <?php endif; ?>
                        
                        <div class="p-6">
                            <h2 class="text-xl font-bold mb-2">
                                <a href="<?php the_permalink(); ?>" class="hover:text-accent transition-colors">
                                    <?php the_title(); ?>
                                </a>
                            </h2>
                            <div class="text-sm text-gray-500 mb-4">
                                <?php echo get_the_date(); ?>
                            </div>
                            <div class="prose prose-sm max-w-none">
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>
            
            <div class="pagination mt-12">
                <?php the_posts_pagination(); ?>
            </div>
            
        <?php else : ?>
            <p class="text-center text-gray-500"><?php esc_html_e( 'No posts found.', 'loomy' ); ?></p>
        <?php endif; ?>
    </div>
</main>

<?php get_footer(); ?>
