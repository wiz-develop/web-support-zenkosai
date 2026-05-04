<!-- 子カテゴリ用のインデックスページ -->
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
    <div class="page-top child-category__header">
        <div class="page-top__icon csr-category child">
            <h1 class="mb-0">
                <?php
                    $c_id = $_GET['cat_id'];
                    $the_t = get_term($c_id, 'csr_cat');
                    $title = $the_t->name;
                    echo $title;
                ?>
            </h1>
        </div>
    </div>
</div>
<div class="csr csr-category">
    <div class="csr-index social-nav">
        <?php
            $csr_contents = get_field('csr_contents', $the_t);
            if ($csr_contents) :
        ?>
        <div class="csr-detail child-category container">
            <?php echo $csr_contents; ?>
        </div>
        <?php endif; ?>
        <div class="page-content-wrapper">
            <div class="page-content-innerwrap csr-cats container-fluid csr-link_list">
                <div class="page-content-div">
                    <div class="csr-list csr-list_bg">
                        <div class="csr-cat-wrapper container">
                            <div class="csr-cat-name">
                                <?php $children = get_term_children($c_id, 'csr_cat'); if ($children): foreach ($children as $cid): $t = get_term_by('id', $cid, 'csr_cat'); ?>
                                    <div class="csr-cat <?php echo $t->slug; ?>">
                                    <?php if(get_field('csr_new_display', $t)) { echo '<div class="new">●</div>'; }?>
                                        <a href="<?php echo home_url('/socail-contributions/category/?csr_cat='.$t->slug); ?>">
                                            <div class="csr-cat-img">
                                                <?php $csr_cat_img = get_field('csr_cat_icon', $t); ?>
                                                <img src="<?php echo $csr_cat_img['url']; ?>" alt="<?php echo $t->name; ?>">
                                            </div>
                                            <div class="csr-cat-inner">
                                                <p class="mb-0 csr-cat-title"><?php echo $t->name; ?></p>
                                            </div>
                                            <div class="csr-next_link">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="100%" viewBox="0 0 69.414 69.415">
                                                    <g transform="translate(8176.361 -1665.095)">
                                                        <rect width="30" height="28" transform="translate(-8142 1702)" fill="#fff"/>
                                                        <path d="M69.414,69.415H0L69.414,0V69.414ZM38.909,46.479a2.442,2.442,0,0,0,0,4.884H53.29L49.7,54.9a2.416,2.416,0,0,0,0,3.453,2.506,2.506,0,0,0,3.506,0l7.713-7.6a2.689,2.689,0,0,0,0-3.671l-7.714-7.6a2.506,2.506,0,0,0-3.506,0,2.417,2.417,0,0,0,0,3.454l3.591,3.537Z" transform="translate(-8176.361 1665.095)"/>
                                                    </g>
                                                </svg>
                                            </div>
                                        </a>
                                    </div>
                                <?php endforeach; endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>