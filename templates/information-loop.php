<?php
$p_type = 'news';
if(get_post_type() == 'social-contribution'){
	$p_type = 'csr_cat';
}

$terms = get_the_terms(get_the_ID(), $p_type);
foreach($terms as $t):
	$logo = get_field('n_logo', $t);
	$color = get_field('n_color', $t);
	$cat_name = $t->name;
	if($p_type == 'csr_cat'){
		$temp = get_term_by('slug', 'csr', 'news');
		$logo = get_field('n_logo', $temp);
		$color = get_field('n_color', $temp);
		$cat_name = '社会貢献活動';
	}
endforeach;

$title = mb_strimwidth( strip_tags( get_the_title() ), 0, 100, '…', 'UTF-8' );
$unread = '';
if ($_SESSION['is_unread']){
	if(in_array( get_the_ID(), $_SESSION['is_unread'] )) {
		$unread = 'unread-news';
	}
}
$days = 7; // New を表示させたい期間の日数
$today = date_i18n('U');
$entry = get_post_time();
$total = date('U', ($today - $entry)) / 86400;
?>
<article class="border-bottom">
	<a class="info-news d-block mx-auto my-1 text-body py-1 <?php //echo $important; ?> <?php echo $unread; ?> gtm-click-link" href="<?php the_permalink(); ?>" data-gtm-click="インフォメーション「<?php echo $title; ?>」">
		<div class="info-news-bar d-flex align-items-center pl-3">
			<div class="new-and-date d-flex align-items-center">
				<?php
					if ($days > $total) {
						echo '<div class="new text-danger d-inline-block"><span>NEW</span></div>';
					}
				?>
				<div class="news-date font-smaller d-inline-block">
					<time datetime="<?php the_time('Y-m-d') ?>"><?php the_time('Y.m.d') ?></time>
				</div>
			</div>
			<div class="news-cat <?php echo $t->slug; ?> d-flex flex-row align-items-center ml-0 ml-sm-3" style="background-color: <?php echo $color; ?>;">
				<div class="cat-img-div">
					<img src="<?php echo $logo['url']; ?>" alt="<?php echo $cat_name; ?>">
				</div>
				<p class="mb-0 news-cat-txt font-smaller bold text-left text-white"><?php echo $cat_name; ?></p>
			</div>
		</div>
		<h3 class="news-title mb-0 pl-3">
			<?php if(CFS()->get('important_information', get_the_ID())) : ?>
				<span class="important rounded07 px-2 text-center text-white bg-danger mr-2">重要</span>
			<?php endif; ?>
			<?php echo $title; ?>
		</h3>
	</a>
</article>