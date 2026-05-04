<div class="page-header">
    <div class="container">
        <div class="section breadSection">
            <div class="container">
                <div class="row">
                    <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                        <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="<?php echo home_url();?>">
                                <span itemprop="name"><i class="fa fa-home"></i> HOME</span>
                            </a>
                        </li>
                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <span itemprop="name"><?php the_title(); ?></span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="page-top">
        <div class="page-top__title">
            <div class="page-top__title__icon">
                <h1 class="mb-0"><?php the_title(); ?></h1>
            </div>
        </div>
        <div class="page-top__nav">
            <?php get_template_part('templates/about-pagetop-nav');?>
        </div>
    </div>
</div><!-- page-header -->
<div class="page-content-wrapper columns">
    <div class="container">
        <?php if(is_user_loggedin()) :?>
            <?php
            $histories = CFS()->get('history_timeline');
            if ($histories) :
        ?>
        <div class="history-timeline">
            <?php foreach ($histories as $history) : ?>
                <?php
                    $block_has_month = false;
                    if (!empty($history['events'])) {
                        foreach ($history['events'] as $event) {
                            if (!empty($event['month'])) {
                                $block_has_month = true;
                                break;
                            }
                        }
                    }
                ?>
                <div class="history-block<?php echo $block_has_month ? ' has-months' : ''; ?>">
                    <h3 class="history-year"><?php echo $history['year']; ?><span>年</span></h3>
                    <?php if (!empty($history['events_tit'])): ?>
                        <div class="events_name">
                            <p class="mb-0"><?php echo esc_html($history['events_tit']); ?></p>
                        </div>
                    <?php endif; ?>
                    <?php if ($history['events']) : ?>
                        <div class="history-item">
                            <?php
                                $monthCount = 0;
                                foreach ($history['events'] as $event) {
                                    if (!empty($event['month'])) {
                                        $monthCount++;
                                    }
                                }
                            ?>
                            <ul class="history-events">
                            <?php
                                $currentMonthIndex = 0;
                                foreach ($history['events'] as $event) :
                            ?>
                                <li class="history-event">
                                    <?php if (!empty($event['month'])) : ?>
                                        <?php
                                            $currentMonthIndex++;
                                            $monthClass = '';
                                            if ($monthCount === 1) {
                                                $monthClass = 'only-month';
                                            } elseif ($currentMonthIndex === $monthCount) {
                                                $monthClass = 'last-month';
                                            }
                                        ?>
                                        <div class="history-month <?php echo $monthClass; ?>"><?php echo $event['month']; ?></div>
                                    <?php endif; ?>
                                    <div class="history-content"><?php echo $event['content']; ?></div>
                                </li>
                            <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>
        <?php else: ?>
        <div class="page-content-innerwrap">
            <ul class="nav nav-tabs history-list">
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
        <?php endif; ?>
        <?php get_template_part('templates/about-nav_new');?>
    </div>
</div>
