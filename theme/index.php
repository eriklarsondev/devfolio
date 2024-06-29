<?php get_header(); ?>

<div class="container">
    <div class="flex flex-col justify-center items-center h-screen">
        <img src="<?php echo dirname(get_template_directory_uri()) .
            '/public/logo-inverse.svg'; ?>" alt="<?php bloginfo('name'); ?>">
        <h1 class="mt-10 mb-0"><?php bloginfo('name'); ?></h1>
        <?php if (get_bloginfo('description')): ?>
            <span class="block mt-1"><?php bloginfo('description'); ?></span>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>
