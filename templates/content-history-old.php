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
    <div class="page-top">
        <div class="page-top__back">
            <img src="<?php echo CFS()->get('header_image'); ?>" class="pc-bnr">
            <img src="<?php echo CFS()->get('header_image_sp'); ?>" class="sp-bnr">
        </div>
        <div class="page-top__icon">
            <?php if(CFS()->get('title_icon') ): ?>
                <div class="icon-image">
                    <img src="<?php echo CFS()->get('title_icon'); ?>">
                </div>
            <?php endif; ?>
                    <h1 class="mb-0"><?php echo get_the_title(); ?></h1>
        </div>
    </div>
</div><!-- page-header -->
<div class="page-content-wrapper columns">
    <div class="container">
        <div class="page-content-innerwrap">
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#history" class="nav-link active" data-toggle="tab">
                    <div class="history-content">
                        <p class="mb-0">全厚済の歩み</p>
                    </div>
                </a>
            </li>
            <li class="nav-item">
                <a href="#initiatives" class="nav-link" data-toggle="tab">
                    <div class="initiatives-content">
                        <p class="mb-0">社会貢献への取組み</p>
                    </div>
                </a>
            </li>
        </ul>
            <div class="page-content-div">
                <div class="tab-content">
                    <div id="history" class="tab-pane active">
                        <?php
                            $fields = CFS()->get('history_list');
                            foreach ($fields as $field) :
                        ?>
                            <div class="history">
                                <div class="history__year">
                                    <p class="mb-0">
                                        <?php echo $field['year']; ?>年
                                    </p>
                                </div>
                                <div class="history__month__list">
                                    <?php
                                        $fields = $field['month_list'];
                                        foreach ((array)$fields as $field):
                                    ?>
                                        <div class="detail">
                                            <?php if($field['month']):?>
                                                <div class="detail__month">
                                                    <p class="mb-0">
                                                        <?php echo $field['month']; ?>月
                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                            <div class="detail__text">
                                                <p class="mb-0">
                                                    <?php echo $field['detail']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                    <div id="initiatives" class="tab-pane">
                        <?php
                            $fields = CFS()->get('initiatives_list');
                            foreach ($fields as $field) :
                        ?>
                            <div class="history">
                                <div class="history__year">
                                    <p class="mb-0">
                                        <?php echo $field['initiatives_year']; ?>年
                                    </p>
                                </div>
                                <div class="history__month__list">
                                    <?php
                                        $fields = $field['initiatives_month_list'];
                                        foreach ((array)$fields as $field):
                                    ?>
                                        <div class="detail">
                                            <?php if($field['initiatives_month']):?>
                                                <div class="detail__month">
                                                    <p class="mb-0">
                                                        <?php echo $field['initiatives_month']; ?>月
                                                    </p>
                                                </div>
                                            <?php endif; ?>
                                            <div class="detail__text">
                                                <p class="mb-0">
                                                    <?php echo $field['initiatives_detail']; ?>
                                                </p>
                                            </div>
                                        </div>
                                    <?php
                                        endforeach;
                                    ?>
                                </div>
                            </div>
                        <?php
                            endforeach;
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_template_part('templates/about-nav');?>
