<article class="plan-item mb-3">
    <a href="<?php the_permalink();?>" class="gtm-click-link" data-gtm-click="<?php echo strip_tags(get_the_title()); ?>">
        <div class="row">
            <div class="plan-th col-3 col-lg-4">
                <img src="<?php echo CFS()->get('aul_image'); ?>" alt="<?php echo strip_tags(get_the_title()); ?>">
            </div>
            <div class="plan-about col-9 col-lg-8">
                <h3><?php echo strip_tags(get_the_title()); ?></h3>
                <p class="mb-0"><?php echo CFS()->get('aul_overview'); ?></p>
            </div>
        </div>
    </a>
</article>