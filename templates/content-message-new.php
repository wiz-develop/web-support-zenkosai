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
        <div class="page-content-innerwrap">
            <h3>代表理事について</h3>
            <div class="page-content-div director_about">
                <div class="biography">
                    <table>
                        <tbody>
                            <?php
                                $page_data = get_page_by_path('message');
                                $page_id = $page_data->ID;
                                foreach( CFS()->get('director_career', $page_id) as $director_career ) :
                            ?>
                                <tr>
                                    <td class="yaer">
                                        <p class="mb-0 border-0"><b><?php echo $director_career['career_year']; ?>年</b></p>
                                    </td>
                                    <td class="detail">
                                        <p class="mb-0"><?php echo $director_career['career_detail']; ?></p>
                                    </td>
                                </tr>
                            <?php
                                endforeach;
                            ?>
                        </tbody>
                    </table>
                    <div class="biography__note">
                        <p class="mb-0">
                            <?php
                                echo CFS()->get('career_note', $page_id);
                            ?>
                        </p>
                    </div>
                    <table>
                        <tbody>
                            <tr>
                                <td>
                                    <p class="mb-0"><b>主な受章</b></p>
                                </td>
                                <td class="detail">
                                    <?php
                                        foreach( CFS()->get('award_list', $page_id) as $award_list ) :
                                    ?>
                                        <p class="mb-0"><?php echo $award_list['award_detail']; ?></p>
                                    <?php
                                        endforeach;
                                    ?>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <h3>代表理事あいさつ</h3>
            <div class="message">
                <div class="message__image">
                    <div class="director">
                        <img src="<?php 
                                echo CFS()->get('director_img', $page_id);
                            ?>" alt="高井 利夫">
                    </div>
                    <p class="mb-0">一般財団法人全国福利厚生共済会</p>
                    <div class="director-detail">
                        <p class="mb-0">代表理事</p>
                            <div class="director-name">
                                <img src="/cms/wp-content/themes/zenkosai/assets/images/about/message/director_name.png" alt="高井 利夫">
                            </div>
                    </div>
                </div>
                <div class="message__detail">
                    <?php 
                        echo CFS()->get('director_message', $page_id);
                    ?>
                </div>

            </div>
        </div>
        <?php get_template_part('templates/about-nav_new');?>
    </div>
</div>
