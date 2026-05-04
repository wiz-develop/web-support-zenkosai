<?php
/*
 * Template Name: FAQ カテゴリーページ
 */
if (!is_user_loggedin()) {
    wp_redirect(home_url('/'));
    exit;
}
get_header();
$faq_post_type = 'ufaq';
$faq_cat_slug = 'ufaq-category';
?>

<div id="page-ufaq"
    class="single-ufaq page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
    <div class="page-header container">
        <!-- <div class="container"> -->
        <?php
        /*-------------------------------------------*/
        /* BreadCrumb
        /*-------------------------------------------*/
        do_action('lightning_breadcrumb_before');
        $old_file_name[] = 'module_panList.php';
        if (locate_template($old_file_name, false, false)) {
            locate_template($old_file_name, true, false);
        } else {
            get_template_part('template-parts/breadcrumb');
        }
        do_action('lightning_breadcrumb_after');
        ?>
        <!-- </div> -->
    </div><!-- page-header -->
    <div class="page-content-wrapper">
        <div class="container mb-5">
            <div class="flame-body">
                <div class="page-content-innerwrap">
                    <div class="page-content-div">
                        <h1 class="faq-title pl-2 px-md-3">
                            <p class="mb-0"><?php echo single_term_title('', true); ?></p>
                        </h1>
                        <?php
                        $term_description = term_description();
                        if ($term_description):
                            ?>
                            <div class="cat-description">
                                <?php echo $term_description; ?>
                            </div>
                        <?php endif; ?>
                        <ul class="faq-cat-list">
                            <?php
                            $term_object = get_queried_object();
                            $first_args = array(
                                'parent' => $term_object->term_id,
                            );

                            /*
                             * 子カテゴリーがある時
                             */
                            $terms = get_terms($faq_cat_slug, $first_args);
                            if ($terms):
                                foreach ($terms as $term):
                                    $link_url = get_term_link($term);
                                    $link_title = $term->name;

                                    $term_id = $term->term_id;
                                    $has_child_term = get_term_children($term_id, $faq_cat_slug);
                                    $child_args = array(
                                        'posts_per_page' => -1,
                                        'post_type' => $faq_post_type,
                                        'tax_query' => array(
                                            'relation' => 'AND',
                                            array(
                                                'taxonomy' => $faq_cat_slug,
                                                'field' => 'id',
                                                'terms' => $term_id,
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
                                        $child_args = array(
                                            'posts_per_page' => -1,
                                            'post_type' => $faq_post_type,
                                            'tax_query' => array(
                                                array(
                                                    'taxonomy' => $faq_cat_slug,
                                                    'field' => 'id',
                                                    'terms' => $term_object->term_id,
                                                ),
                                            ),
                                            'order' => 'ASC',
                                            'orderby' => 'meta_value_num',
                                            'meta_key' => 'qa_number',
                                        );
                                    }
                                    $child_faqs = get_posts($child_args);
                                    $child_faqs_count = count($child_faqs);

                                    // 子カテゴリーがない、かつカテゴリーに属する回答が１つの場合　回答ページへのリンクを表示
                                    ?>
                                    <a href="<?php echo $link_url; ?>">
                                        <li class="faq-nextanswer"><?php echo $link_title; ?></li>
                                    </a>
                                    <?php
                                endforeach;

                                // カテゴリー直下の回答へのリンクを表示
                                $args_faqpost = array(
                                    'posts_per_page' => -1,
                                    'post_type' => $faq_post_type,
                                    'tax_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'taxonomy' => $faq_cat_slug,
                                            'field' => 'id',
                                            'terms' => $term_object->term_id,
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
                                    $args_faqpost = array(
                                        'posts_per_page' => -1,
                                        'post_type' => $faq_post_type,
                                        'tax_query' => array(
                                            'relation' => 'AND',
                                            array(
                                                'taxonomy' => $faq_cat_slug,
                                                'field' => 'id',
                                                'terms' => $term_object->term_id,
                                                'include_children' => false,
                                            ),
                                        ),
                                        'order' => 'ASC',
                                        'orderby' => 'meta_value_num',
                                        'meta_key' => 'qa_number',
                                    );
                                }
                                $query_faqposts = get_posts($args_faqpost);
                                foreach ($query_faqposts as $query_faqpost):
                                    setup_postdata($query_faqpost);
                                    ?>
                                    <a href="<?php the_permalink($query_faqpost->ID); ?>">
                                        <li class="faq-nextanswer"><?php echo $query_faqpost->post_title; ?></li>
                                    </a>
                                    <?php
                                endforeach;
                                wp_reset_postdata();

                            else:

                                /*
                                 * 子カテゴリーがない場合、投稿の一覧を表示
                                 */
                                $args = array(
                                    'posts_per_page' => -1,
                                    'post_type' => $faq_post_type,
                                    'tax_query' => array(
                                        'relation' => 'AND',
                                        array(
                                            'taxonomy' => $faq_cat_slug,
                                            'field' => 'id',
                                            'terms' => $term_object->term_id,
                                        ),
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
                                    $args = array(
                                        'posts_per_page' => -1,
                                        'post_type' => $faq_post_type,
                                        'tax_query' => array(
                                            array(
                                                'taxonomy' => $faq_cat_slug,
                                                'field' => 'id',
                                                'terms' => $term_object->term_id,
                                            ),
                                        ),
                                        'order' => 'ASC',
                                        'orderby' => 'meta_value_num',
                                        'meta_key' => 'qa_number',
                                    );
                                }
                                $faqs = get_posts($args);
                                foreach ($faqs as $faq):
                                    setup_postdata($faq);
                                    ?>
                                    <a href="<?php the_permalink($faq->ID); ?>">
                                        <li class="faq-nextanswer">
                                            <p class="faq-cat mb-0">
                                                <?php
                                                // カテゴリ階層を表示
                                                $terms = get_the_terms($faq->ID, $faq_cat_slug);
                                                if (!empty($terms) && !is_wp_error($terms)) {
                                                    $term = $terms[0];
                                                    $hierarchy = [$term->name];

                                                    while ($term->parent != 0) {
                                                        $term = get_term($term->parent, $faq_cat_slug);
                                                        if (is_wp_error($term)) break;
                                                        array_unshift($hierarchy, $term->name);
                                                    }

                                                    echo esc_html(implode(' ＞ ', $hierarchy));
                                                }
                                                ?>
                                            </p>
                                            <?php echo $faq->post_title; ?>
                                        </li>
                                    </a>
                                    <?php
                                endforeach;
                                wp_reset_postdata();
                                ?>
                            <?php endif; ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <?php get_template_part('/templates/searchform-faq'); ?>
    </div>
</div>

<?php get_footer(); ?>