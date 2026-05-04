<?php
/*
 * Template Name: FAQ
 */
get_header();
$faq_post_type = 'ufaq';
$faq_cat_slug = 'ufaq-category';
$faq_tag_slug = 'ufaq-tag';
?>

<div id="page-<?php echo $cfs->get('css'); ?>" class="page-<?php echo $cfs->get('css'); ?> page-wrapper <?php echo $display_type; ?> <?php echo $login; ?>">
    <div class="page-header">
        <div class="container">
            <?php
                /*-------------------------------------------*/
                /* BreadCrumb
                /*-------------------------------------------*/
                do_action( 'lightning_breadcrumb_before' );
                $old_file_name[] = 'module_panList.php';
                if ( locate_template( $old_file_name, false, false ) ) {
                    locate_template( $old_file_name, true, false );
                } else {
                    get_template_part( 'template-parts/breadcrumb' );
                }
                do_action( 'lightning_breadcrumb_after' );
            ?>
        </div>
        <div class="page-top mb-0">
            <div class="page-top__back">
                <img src="<?php echo $cfs->get('header_image'); ?>" class="pc-bnr">
                <img src="<?php echo $cfs->get('header_image_sp'); ?>" class="sp-bnr">
            </div>
            <div class="page-top__icon">
                <?php if($cfs->get('title_icon') ): ?>
                    <div class="icon-image">
                        <img src="<?php echo $cfs->get('title_icon'); ?>">
                    </div>
                <?php endif; ?>
                <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="page-content-wrapper">
        <?php get_template_part('/templates/searchform-faq');?>
        <?php
            // $qa_cat_cancel = get_term_by('slug', 'qa_cat_cancel', $faq_cat_slug );
            $first_args = array(
                'parent' => 0,
            );
            $terms = get_terms($faq_cat_slug, $first_args);
            if ($terms) :
        ?>
        <section class="top-category">
            <div id="search-cat" class="columns">
                <div class="container">
                    <div class="page-content-innerwrap">
                        <h2>カテゴリーから探す</h2>
                        <div class="row">
                            <?php
                                foreach ( $terms as $term ) :
                                    $term_id = $term->term_id;
                                    $term_name = $term->name;
                                    $term_image = get_field('faq_category_icon', $term);
                            ?>
                            <div class="col-12 col-md-6 mb-3">
                                <article class="faq-category">
                                    <div class="faq-category__title acor-menu d-flex align-items-center">
                                        <div class="faq-category__title__image">
                                            <?php if ($term_image) : ?>
                                                <img src="<?php echo $term_image; ?>" alt="<?php echo $term_name; ?>">
                                            <?php else : ?>
                                                <img src="/cms/wp-content/themes/zenkosai/assets/images/faq/faq-zenkosai.png" alt="<?php echo $term_name; ?>">
                                            <?php endif; ?>
                                            </div>
                                        <div class="faq-category__title__name">
                                            <?php echo $term_name; ?>
                                        </div>
                                    </div>
                                    <div class="faq-category__list-wrapper acor-menu-child d-md-block">
                                        <ul class="faq-category__list">
                                            <?php
                                                $second_args = array(
                                                    'parent' => $term_id,
                                                    'number' => 5,
                                                );
                                                $second_terms = get_terms($faq_cat_slug, $second_args);
                                                $second_term_count = count($second_terms);

                                                if ($second_terms) :
                                                    // 子カテゴリーがあるとき
                                                    foreach ( $second_terms as $second_term ) :
                                                        $second_term_id = $second_term->term_id;
                                            ?>
                                                <li>
                                                    <a href="<?php echo get_term_link($second_term_id); ?>">
                                                        <p class="mb-0"><?php echo esc_html($second_term->name); ?></p>
                                                    </a>
                                                </li>
                                            <?php
                                                    endforeach;
                                                endif;

                                                if ($second_term_count < 5) :
                                                $post_count = 5 - $second_term_count;
                                                    $faq_cat_post_args = array(
                                                        'post_type' => 'ufaq',
                                                        'post_status' => 'publish',
                                                        'posts_per_page' => $post_count,
                                                        'tax_query' => array(
                                                            array(
                                                                'taxonomy' => $faq_cat_slug,
                                                                'field' => 'id',
                                                                'terms' => $term_id,
                                                                'include_children' => false,
                                                            ),
                                                        ),
                                                        'meta_query' => array(
                                                            array(
                                                                'key' => 'pa_incompany',
                                                                'value' => '0',
                                                                'compare' => '=',
                                                            ),
                                                        ),
                                                        'order' => 'ASC',
                                                        'orderby' => 'meta_value_num',
                                                        'meta_key' => 'qa_number',
                                                    );
                                                    if ($_SESSION['member_info']['member_id'] == '000000000000') {
                                                        $faq_cat_post_args = array(
                                                            'post_type' => 'ufaq',
                                                            'post_status' => 'publish',
                                                            'posts_per_page' => $post_count,
                                                            'tax_query' => array(
                                                                array(
                                                                    'taxonomy' => $faq_cat_slug,
                                                                    'field' => 'id',
                                                                    'terms' => $term_id,
                                                                    'include_children' => false,
                                                                ),
                                                            ),
                                                            'order' => 'ASC',
                                                            'orderby' => 'meta_value_num',
                                                            'meta_key' => 'qa_number',
                                                        );
                                                    }
                                                    $faq_cat_posts = get_posts($faq_cat_post_args);
                                                    foreach ( $faq_cat_posts as $faq_cat_post ) :
                                                        setup_postdata( $faq_cat_post );
                                            ?>
                                                <li>
                                                    <a href="/<?php echo $faq_post_type; ?>/<?php echo $faq_cat_post->post_name; ?>">
                                                        <p class="mb-0"><?php echo $faq_cat_post->post_title; ?></p>
                                                    </a>
                                                </li>
                                            <?php
                                                    endforeach; wp_reset_postdata();
                                                endif;
                                            ?>
                                        </ul>
                                        <a href="<?php echo get_term_link($term_id); ?>" class="faq-category__all rounded-pill">
                                            すべて表示<i class="fas fa-angle-right pl-3"></i>
                                        </a>
                                    </div>
                                </article>
                            </div>
                            <?php
                                endforeach;
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
            endif;

            $faq_args = array(
                'post_type' => $faq_post_type,
                'posts_per_page' => -1,
                'post_status' => 'publish',
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'qa_pickup',
                        'value' => 1,
                        'compare' => '=',
                    ),
                    array(
                        'key' => 'pa_incompany',
                        'value' => 0,
                        'compare' => '=',
                    ),
                ),
            );
            $faq_posts = get_posts( $faq_args );
            if ($faq_posts) :
        ?>
        <section class="top-pickup">
            <div class="columns">
                <div class="container">
                    <div class="page-content-innerwrap">
                        <h2>Pick Up</h2>
                        <ul>
                            <?php
                                foreach($faq_posts as $faq_post) : setup_postdata( $post );
                                    $faq_id = $faq_post->ID;
                                    $faq_title = $faq_post->post_title;

                                    $terms = get_the_terms($faq_id, $faq_cat_slug);
                                    $term_id = $terms[0]->term_id;
                                    $term_name = $terms[0]->name;
                                    $term_image = get_field('faq_category_icon');
                            ?>
                            <li>
                                <a href="<?php the_permalink($faq_id); ?>" class="d-block">
                                    <div class="faq-nextanswer">
                                        <div class="pickup-faq__cat">
                                            <div class="pickup-faq__cat__icon">
                                                <?php if ($term_image) : ?>
                                                    <img src="<?php echo $term_image; ?>" alt="<?php echo $term_name; ?>">
                                                <?php else : ?>
                                                    <img src="/cms/wp-content/themes/zenkosai/assets/images/faq/faq-zenkosai.png" alt="<?php echo $term_name; ?>">
                                                <?php endif; ?>
                                            </div>
                                            <p class="pickup-faq__cat__name"><?php echo $term_name; ?></p>
                                        </div>
                                        <p class="pickup-faq__title"><?php echo $faq_title; ?></p>
                                    </div>
                                </a>
                            </li>
                            <?php
                                endforeach;
                                wp_reset_postdata();
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <?php endif; ?>
    </div>
</div>

<?php get_footer(); ?>