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
                <h1 class="mb-0">サービス利用件数・<span class="sp-br">決算報告</span></h1>
            </div>
        </div>
        <div class="page-top__nav">
            <?php get_template_part('templates/about-pagetop-nav');?>
        </div>
    </div>
</div><!-- page-header -->
<div class="page-content-wrapper columns">
    <div class="container py-0">
        <div class="page-content-innerwrap service-use-list">
            <h3>サービス利用件数</h3>
                <div class="use-list">
                    <?php
                        foreach( CFS()->get('use_list') as $use_list ) :
                    ?>
                        <div class="performance">
                            <a href="<?php echo $use_list['file']; ?>" target="_blank">
                                <div class="performance__link">
                                    <?php echo $use_list['title']; ?>
                                </div>
                                <div class="target-link-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 27.917 27.846">
                                        <g transform="translate(-0.11)">
                                            <path d="M20,22H2a2,2,0,0,1-2-2V2A2,2,0,0,1,2,0H14.222L9.992,4.231H5.231a1,1,0,0,0-1,1V16.77a1,1,0,0,0,1,1H16.769a1,1,0,0,0,1-1V12.01L22,7.778V20A2,2,0,0,1,20,22Z" transform="translate(0.11 5.845)"></path>
                                            <path d="M10.488,11.126H8.679a.889.889,0,0,1-.888-.888V1.056A1.057,1.057,0,0,0,6.734,0H4.385A1.057,1.057,0,0,0,3.329,1.056v9.182a.889.889,0,0,1-.888.888H.632a.609.609,0,0,0-.589.274.61.61,0,0,0,.138.635l4.725,6.228a.784.784,0,0,0,1.309,0l4.725-6.228a.61.61,0,0,0,.138-.635A.609.609,0,0,0,10.488,11.126Z" transform="translate(14.864 21.026) rotate(-135)"></path>
                                        </g>
                                    </svg>
                                </div>
                            </a>
                        </div>
                    <?php
                        endforeach;
                    ?>
                </div>
        </div>
    </div>
</div>
<?php get_template_part('templates/content-settlement-report-new');?>
