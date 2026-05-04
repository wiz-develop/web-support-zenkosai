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
                            <span itemprop="name">一般財団法人 全国福利厚生共済会とは</span>
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="page-top">
        <div class="page-top__title">
            <div class="page-top__title__icon">
                <h1 class="mb-0"><span>一般財団法人</span>全国福利厚生共済会とは</h1>
            </div>
        </div>
        <div class="page-top__nav">
            <?php get_template_part('templates/about-pagetop-nav');?>
        </div>
    </div>
</div><!-- page-header -->
<div class="page-content-wrapper columns">
    <div class="container">
        <div class="page-content-innerwrap">
            <h3>全厚済概要</h3>
                <?php
                    $page_data = get_page_by_path('company');
                    $page_id = $page_data->ID;
                    foreach( CFS()->get('new_company', $page_id) as $company ) :
                ?>
                    <div class="page-content-div">
                        <h4><?php echo $company['new_company_item']; ?></h4>
                            <div class="page-content-innerdiv">
                                <?php echo $company['new_company_detail']; ?>
                            </div>
                    </div>
                <?php
                    endforeach;
                ?>
                <div class="page-content-div">
                    <!-- ビジネスページの情報なので -->
                    <!-- ビジネスページのID取得 -->
                    <?php
                        $page_ID = get_page_by_path('business');
                        $page_ID = $page_ID->ID;
                    ?>
                    <h4>有効会員口数</h4>
                        <div class="page-content-innerdiv">
                        <?php echo CFS()->get('business_member_number_new', $page_ID); ?>口（<?php echo date('Y年m月d日', strtotime(CFS()->get('business_member_number_update_new', $page_ID))); ?>現在）
                        </div>
                </div>
                <div class="page-content-div">
                    <h4>
                        <?php 
                            $page_data = get_page_by_path('company');
                            $page_id = $page_data->ID;
                            echo CFS()->get('new_service_item', $page_id);
                        ?>
                    </h4>
                        <div class="page-content-innerdiv">
                            <?php 
                                $page_data = get_page_by_path('company');
                                $page_id = $page_data->ID;
                                echo CFS()->get('new_service_detail', $page_id);
                            ?>
                        </div>
                </div>
        </div>
        <div class="page-content-innerwrap philosophy">
            <h3>基本理念</h3>
                <div class="page-content-div">
                    <div class="philosophy-detail">
                        <?php 
                            $page_data = get_page_by_path('company');
                            $page_id = $page_data->ID;
                            echo CFS()->get('company_philosophy', $page_id);
                        ?>
                    </div>
                    <div class="philosophy-img">
                        <img src="<?php 
                                $page_data = get_page_by_path('company');
                                $page_id = $page_data->ID;
                                echo CFS()->get('philosophy_img', $page_id);
                            ?>">
                    </div>
                </div>
                <?php
                    $page_data = get_page_by_path('company');
                    $page_id = $page_data->ID;
                    foreach( CFS()->get('philosophy_list', $page_id) as $company ) :
                ?>
                    <div class="page-content-div">
                        <h4><?php echo $company['philosophy_list_item']; ?></h4>
                            <div class="page-content-innerdiv">
                                <?php echo $company['philosophy_detail']; ?>
                            </div>
                    </div>
                <?php
                    endforeach;
                ?>
        </div>

        <?php get_template_part('templates/about-nav_new');?>

        <div class="page-content-innerwrap">
            <div class="page-content-div tokutei-div rounded07 p-3 mb-3">
                <p class="mb-0">
                    <?php 
                        $page_id = get_option( 'page_on_front' );
                        echo CFS()->get('special_commercial', $page_id);
                    ?>
                </p>
            </div>

            <div class="page-content-div questionnaire-note">
                <p class="mb-0">
                    <?php 
                        $page_data = get_page_by_path('questionnaire');
                        $page_id = $page_data->ID;
                        echo CFS()->get('solicitation_info', $page_id);
                    ?>
                </p>
                <div class="questionnaire-link">
                    <a href="/questionnaire/"><button><p class="mb-0">アンケートはこちら</p></button></a>
                </div>
            </div>
        </div>
    </div>
</div>
