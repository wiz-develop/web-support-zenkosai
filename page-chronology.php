<?php
/*
 * Template Name: 全厚済とは 沿革
 */

get_header();
?>

<div id="page-new-company" class="page-company page-wrapper page-company-chronology <?php echo $display_type; ?> <?php echo $login; ?>">
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
                    <?php if ($history['events']) : ?>
                        <ul class="history-events">
                        <?php foreach ($history['events'] as $event) : ?>
                            <li class="history-event">
                                <?php if ($event['month']) : ?>
                                <div class="history-month"><?php echo $event['month']; ?><span>月</span></div>
                                <?php endif; ?>
                                <div class="history-content"><?php echo $event['content']; ?></div>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        <div class="history-current">現在</div>
        </div>
        <?php endif; ?>
        </div>
    </div>
</div>
<?php get_footer(); ?>
