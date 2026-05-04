<?php
/*
 * Template Name: あうる企画詳細
 */
if(!is_user_loggedin()){
    wp_redirect(home_url('/'));
    exit;
}
$post_type = 'aul-archive';
$post_id = get_the_ID();
get_header(); ?>

<div id="single-aul-plan" class="single-aul-plan page-wrapper <?php echo $display_type; ?> <?php echo $login; ?> <?php echo $member_type; ?>">
    <div class="page-header">
        <div class="container">
            <div class="section breadSection">
                <div class="container">
                    <div class="row">
                        <ol class="breadcrumb" itemtype="http://schema.org/BreadcrumbList">
                            <li id="panHome" itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="<?php echo home_url(); ?>">
                                    <span itemprop="name"><i class="fa fa-home"></i> HOME</span>
                                </a>
                            </li>
							<li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/aul/">
                                    <span itemprop="name">会報誌aul【あうる】専用ページ</span>
                                </a>
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="/aul-archive/">
                                    <span itemprop="name">あうる企画一覧</span>
                                </a>
                            </li>
                            <li>
                                <span><?php the_title(); ?></span>
                            </li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- page-header -->
    <div class="aul-plan-list page-content-wrapper columns">
        <div class="aul-plan_article container d-block">
			<div class="page-content-innerwrap">
				<div class="page-content-div">
					<article>
						<div class="aul-plan_header mt-3">
							<p class="mb-0"><?php the_time('Y/m/d') ?></p>
						</div>
						<!-- TODO:タイトル文字数の制限 -->
						<h1><p class="mb-0 news-title"><?php the_title(); ?></p></h1>
						<div class="article-detail mt-3">
							<?php the_content(); ?>
						</div>
					</article>
					<div class="back-button text-center mt-5">
						<a href="/aul-archive/">
							<button class="rounded-pill px-4 py-1">あうる企画一覧へ</button>
						</a>
					</div>
				</div>
			</div>
        </div>
    </div>
</div>

<?php get_footer(); ?>